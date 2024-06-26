<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\LivroFulanoController;








Route::get('/livros/create',[LivroController::class,'create']);
Route::post('/livros',[LivroController::class,'store']);





//exercicio 1

Route::get('/stats', [ExerciseController::class, 'statist'])->name('exercises.stats');

Route::get('/exercises/importarCSV', [ExerciseController::class, 'importarCSVForm'])->name('exercises.importarCSVForm');
Route::post('/exercises/importarCSV', [ExerciseController::class, 'importarCSV'])->name('exercises.import');

//FIM Exercicio 1

//deletar registros
Route::delete('/exercises/destroyAll', [ExerciseController::class, 'destroyAll'])->name('exercises.destroyAll');



Route::get('/media', [ExerciseController::class, 'mediaPulse'])->name('exercises.media');





//

Route::get('/exercises', [ExerciseController::class, 'index'])->name('exercises.index');
Route::get('/exercises/create', [ExerciseController::class, 'create'])->name('exercises.create');
Route::post('/exercises', [ExerciseController::class, 'store'])->name('exercises.store');
Route::get('/exercises/{exercise}', [ExerciseController::class, 'show'])->name('exercises.show');
Route::get('/exercises/{exercise}/edit', [ExerciseController::class, 'edit'])->name('exercises.edit');
Route::put('/exercises/{exercise}', [ExerciseController::class, 'update'])->name('exercises.update');
Route::delete('/exercises/{exercise}', [ExerciseController::class, 'destroy'])->name('exercises.destroy');





Route::get('/exercises/result', [ExerciseController::class, 'importarCSV'])->name('exercises.result');







/*
Route::get('/exercises/import', [ExerciseController::class, 'importarCSVForm'])->name('exercises.importarCSVForm');
Route::post('/exercises/import', [ExerciseController::class, 'importarCSV'])->name('exercises.importarCSV');
*/


Route::get('/exercises/media', [ExerciseController::class, 'mediaPulse'])->name('exercises.mediaPulse');
//Route::get('/exercises/stats', [ExerciseController::class, 'stats'])->name('exercises.statsCSV');
Route::get('/exercises/export', [ExerciseController::class, 'gerarCSV'])->name('exercises.gerarCSV');






/*


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
/*

Route::get('/gerar-csv', [LivroFulanoController::class, 'gerarCSV'])->name('gerar-csv.csv');

     

Route::get('/registros', [LivroFulanoController::class, 'index'])->name('registros.index');




Route::get('/livrofulano', [LivroFulanoController::class, 'index'])->name('livrofulano.index');
Route::get('/livrofulano/create', [LivroFulanoController::class, 'create'])->name('livrofulano.create');
Route::post('/livrofulano/store', [LivroFulanoController::class, 'store'])->name('livrofulano.store');

*/



//Route::get('/livrofulano/gerar.csv', [LivroFulanoController::class, 'gerarCSV'])->name('livrofulano.gerarCSV');
/*
Route::get('/livros',[LivroFulanoController::class,'index']);
Route::get('/livrosfulano', [LivroFulanoController::class, 'index'])->name('alunos.index');
Route::get('/livrosfulano/exportCSV', [LivroFulanoController::class, 'exportCSV'])->name('livros_fulano.exportCSV');

*/