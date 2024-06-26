<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use League\Csv\Reader;

class ExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exercises = Exercise::all();
        return view('exercises.index', compact('exercises'));
    }

    /**
     * Show the form for importing CSV.
     */
    public function importarCSVForm()
    {
        return view('exercises.importcsv');
    }

    /**
     * Process the imported CSV file and calculate the average pulse.
     */
    public function importCSV(Request $request)
    {
        // Validar se o arquivo foi enviado corretamente
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt|max:2048' // máximo de 2MB
        ]);

        // Obter o arquivo enviado
        $file = $request->file('csv_file');

        // Ler o arquivo CSV
        $reader = Reader::createFromPath($file->getPathname(), 'r');
        $reader->setHeaderOffset(0); // pular a primeira linha (cabeçalho)

        $records = $reader->getRecords();

        $totalPulse = 0;
        $count = 0;

        foreach ($records as $record) {
            // Calcular a média do campo 'pulse'
            $totalPulse += (int) $record['pulse'];
            $count++;
        }

        // Calcular a média
        $mediaPulse = ($count > 0) ? $totalPulse / $count : 0;

        // Retornar para a view com a média calculada
        return view('exercises.result', ['mediaPulse' => $mediaPulse]);
    }

    /**
     * Process the imported CSV file and store the data in the database.
     */


    
    public function importarCSV(Request $request)
    {
        // Verificar se o arquivo foi enviado corretamente
        if (!$request->hasFile('file') || !$request->file('file')->isValid()) {
            return redirect()->back()->withErrors(['error' => 'O arquivo enviado não é válido.']);
        }

        // Validar o arquivo CSV
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:csv,txt|max:2048', // máximo de 2MB
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        // Processar o arquivo CSV
        $file = $request->file('file');
        $path = $file->getRealPath();
        $data = array_map('str_getcsv', file($path));

        // Obtendo o cabeçalho do CSV
        $header = $data[0];
        unset($data[0]); // Remove o cabeçalho do array de dados

        // Iterando sobre os dados e criando registros no banco de dados
        foreach ($data as $row) {
            // Combinando o cabeçalho com os dados de cada linha
            $exerciseData = array_combine($header, $row);

            // Criando um novo registro de Exercise no banco de dados
            Exercise::create([
                'diet' => $exerciseData['diet'],
                'pulse' => $exerciseData['pulse'],
                'kind' => $exerciseData['kind'],
                'time' => $exerciseData['time'],
            ]);
        }

        return redirect()->route('exercises.importarCSVForm')->with('success', 'CSV importado com sucesso.');
    }







    /**
     * Calculate average pulse values for different kinds of exercises.
     */
    public function mediaPulse()
    {
        $mediaRest = Exercise::where('kind', 'rest')->avg('pulse');
        $mediaWalking = Exercise::where('kind', 'walking')->avg('pulse');
        $mediaRunning = Exercise::where('kind', 'running')->avg('pulse');

        return view('exercises.media', compact('mediaRest', 'mediaWalking', 'mediaRunning'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('exercises.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'diet' => 'required|string|max:255',
            'pulse' => 'required|integer',
            'kind' => 'required|string|max:255',
            'time' => 'required|string', // Ensure the time field is a string
        ]);

        Exercise::create($request->all());

        return redirect()->route('exercises.index')->with('success', 'Exercise created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Exercise $exercise)
    {
        return view('exercises.show', compact('exercise'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exercise $exercise)
    {
        return view('exercises.edit', compact('exercise'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exercise $exercise)
    {
        $request->validate([
            'diet' => 'required|string|max:255',
            'pulse' => 'required|integer',
            'kind' => 'required|string|max:255',
            'time' => 'required|string', // Ensure the time field is a string
        ]);

        $exercise->update($request->all());

        return redirect()->route('exercises.index')->with('success', 'Exercise updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exercise $exercise)
    {
        $exercise->delete();

        return redirect()->route('exercises.index')->with('success', 'Exercise deleted successfully.');
    }


    /**
     * Remover todos os registros.
     */

    public function destroyAll()
    {
        Exercise::truncate(); // Remove all records from the table
    
        return redirect()->route('exercises.index')->with('success', 'All exercises deleted successfully.');
    }
    
    



    /**
     * Export all exercises data to CSV file.
     */
    public function gerarCSV()
    {
        $registros = Exercise::all();

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=registros.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $callback = function() use ($registros) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'diet', 'pulse', 'kind', 'time']); // Include time in headers
            
            foreach ($registros as $registro) {
                fputcsv($file, [$registro->id, $registro->diet, $registro->pulse, $registro->kind, $registro->time]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Export statistics (count of each kind) to CSV file.
     */
    public function stats()
    {
        // Calculate the count of values in the 'kind' column
        $counts = Exercise::groupBy('kind')->select('kind', DB::raw('count(*) as total'))->get();

        // CSV headers
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=registros.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $callback = function() use ($counts) {
            $file = fopen('php://output', 'w');

            // Write CSV headers
            fputcsv($file, ['kind', 'count_of_kind']);

            // Add record data to the CSV
            foreach ($counts as $count) {
                fputcsv($file, [$count->kind, $count->total]);
            }

            fclose($file);
        };

        // Return the HTTP response with the generated CSV
        return response()->stream($callback, 200, $headers);
    }
}





        














