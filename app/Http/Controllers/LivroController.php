<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro;


class LivroController extends Controller
{


    public function create()
    {
        return view('livros.create');
    }

    public function store()
    {
        $livro = new Livro();
        $livro->titulo = request()->titulo;
        $livro->autor = request()->autor;
        $livro->isbn = request()->isbn;
        $livro->save();
        return redirect('/livros/create');
        //request()->titulo
        //dd(request()->titulo);
    }



}
