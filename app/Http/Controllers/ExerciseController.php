<?php

namespace App\Http\Controllers;

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


    //exercicio 1: stats()
    public function statist()
    {
        
    }


    //exercicio 1: importarCSV
    public function importarCSVForm()
    {
        return view('exercises.importcsv');
    }

    public function importarCSV(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:csv,txt',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $file = $request->file('file');
        $path = $file->getRealPath();
        $data = array_map('str_getcsv', file($path));

        $header = $data[0];
        unset($data[0]);

        foreach ($data as $row) {
            $exerciseData = array_combine($header, $row);
            Exercise::create($exerciseData);
        }

        return redirect()->route('exercises.importForm')->with('success', 'CSV importado com sucesso.');
    }



    //media pulse
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
     * Export data to CSV.
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
     * Export stats to CSV.
     */
    public function stats()
    {
        // Calculate the count of values in the 'kind' column
        $counts = Exercise::groupBy('kind')->select('kind', DB::raw('count(*) as total'))->get();

        // Fetch all exercise records
        $registros = Exercise::all();

        // CSV headers
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=registros.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $callback = function() use ($registros, $counts) {
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











        














