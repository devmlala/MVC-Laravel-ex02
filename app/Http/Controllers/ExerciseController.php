<?php

namespace App\Http\Controllers;



use Illuminate\Support\Facades\Response;
use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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
            'time' => 'required', // Adiciona a validação para o campo time
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
            'time' => 'required', // Adiciona a validação para o campo time
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


  /*  public function exportCsv()
    {
    $exercises = Exercise::all();

    $filename = 'exercises.csv';
    $handle = fopen('php://output', 'w');
    $headers = ['Content-Type' => 'text/csv', 'Content-Disposition' => "attachment; filename=\"$filename\""];

    // Adiciona os cabeçalhos das colunas ao CSV
    fputcsv($handle, ['ID', 'Diet', 'Pulse', 'Kind', 'Created At', 'Updated At']);

    // Adiciona os dados dos exercícios ao CSV
    foreach ($exercises as $exercise) {
        fputcsv($handle, [
            $exercise->id,
            $exercise->diet,
            $exercise->pulse,
            $exercise->kind,
            $exercise->created_at,
            $exercise->updated_at
        ]);
    }

    fclose($handle);

    return response()->streamDownload(function() use ($handle) {
        readfile($handle);
    }, $filename, $headers);
}
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
            fputcsv($file, ['ID', 'diet', 'pulse', 'kind','time']); // Adicione os cabeçalhos CSV necessários
            
            foreach ($registros as $registro) {
                fputcsv($file, [$registro->id, $registro->diet, $registro->pulse, $registro->kind]); // Adicione os campos que deseja exibir
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
        }


    




        public function stats()
    {
    // Calcular a contagem de valores na coluna 'kind'
    $counts = Exercise::groupBy('kind')->select('kind', DB::raw('count(*) as total'))->get();

    // Dados dos registros
    $registros = Exercise::all();

    // Cabeçalhos CSV
    $headers = array(
        "Content-type" => "text/csv",
        "Content-Disposition" => "attachment; filename=registros.csv",
        "Pragma" => "no-cache",
        "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
        "Expires" => "0"
    );

    $callback = function() use ($registros, $counts) {
        $file = fopen('php://output', 'w');

        // Escrever cabeçalhos CSV
        fputcsv($file, ['count_of_kind']);

        // Adicionar dados dos registros ao CSV
        foreach ($registros as $registro) {
            // Encontrar a contagem correspondente do valor 'kind'
            $count = $counts->firstWhere('kind', $registro->kind)->total ?? 0;
            fputcsv($file, [$registro->kind, $count]);
        }

        fclose($file);
    };

    // Retornar a resposta HTTP com o CSV gerado
    return response()->stream($callback, 200, $headers);
}





    }







        














