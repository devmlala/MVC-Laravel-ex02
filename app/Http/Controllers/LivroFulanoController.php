<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LivroFulano;

class LivroFulanoController extends Controller
{
    /*
    public function index()
    {
        // Recupera 20 registros por página
        $registros = LivroFulano::paginate(20);

        // Passa os registros para a view
        return view('livros', compact('registros'));
    }
    */


    public function index()
    {
        $registros = LivroFulano::paginate(20);
        return view('livroFulano', compact('registros'));
    }

    public function create()
    {
        return view('livroFulano.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|max:255',
            'autor' => 'required|max:255',
            'isbn' => 'required|numeric',
        ]);

        LivroFulano::create($request->all());

        return redirect()->route('livrofulano.index')->with('success', 'Livro criado com sucesso.');
    }



    public function gerarCSV()
    {
        $registros = LivroFulano::all();
        
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=registros.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $callback = function() use ($registros) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'titulo', 'autor', 'isbn']); // Adicione os cabeçalhos CSV necessários
            
            foreach ($registros as $registro) {
                fputcsv($file, [$registro->id, $registro->titulo, $registro->autor, $registro->isbn]); // Adicione os campos que deseja exibir
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
        }

}






