<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\LivroFulanoController;








Route::get('/livros/create',[LivroController::class,'create']);
Route::post('/livros',[LivroController::class,'store']);



















//exercicio 1

Route::get('/stats', [ExerciseController::class, 'statist'])->name('exercises.stats');

Route::get('/importarCSV', [ExerciseController::class, 'importarCSVForm'])->name('exercises.importForm');
Route::post('/importarCSV', [ExerciseController::class, 'importarCSV'])->name('exercises.import');


Route::get('/mediaPulse', [ExerciseController::class, 'mediaPulse'])->name('exercises.mediaPulse');













Route::get('/sistemas', function () {
    echo "sistemas FFLCH";
        return view('sistemas');
    });



Route::resource('exercises', ExerciseController::class);
    




Route::get('/exercises/export-csv', [ExerciseController::class, 'exportCsv'])->name('exercises.exportCsv');

Route::get('/gerarCSV', [ExerciseController::class, 'gerarCSV'])->name('gerarCSV.csv');

Route::get('/stats', [ExerciseController::class, 'stats'])->name('stats.csv');

 /*   
Route::get('/livros', function () {
    echo "sistemas FFLCH";
        return view('livros');
    });    

Route::get('/livros', [LivroFulanoController::class, 'index'])->name('livros.index');
*/


Route::get('/gerar-csv', [LivroFulanoController::class, 'gerarCSV'])->name('gerar-csv.csv');

     

Route::get('/registros', [LivroFulanoController::class, 'index'])->name('registros.index');




Route::get('/livrofulano', [LivroFulanoController::class, 'index'])->name('livrofulano.index');
Route::get('/livrofulano/create', [LivroFulanoController::class, 'create'])->name('livrofulano.create');
Route::post('/livrofulano/store', [LivroFulanoController::class, 'store'])->name('livrofulano.store');





//Route::get('/livrofulano/gerar.csv', [LivroFulanoController::class, 'gerarCSV'])->name('livrofulano.gerarCSV');
/*
Route::get('/livros',[LivroFulanoController::class,'index']);
Route::get('/livrosfulano', [LivroFulanoController::class, 'index'])->name('alunos.index');
Route::get('/livrosfulano/exportCSV', [LivroFulanoController::class, 'exportCSV'])->name('livros_fulano.exportCSV');

*/