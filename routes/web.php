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
    //deletar registros
Route::delete('/exercises/destroyAll', [ExerciseController::class, 'destroyAll'])->name('exercises.destroyAll');

//FIM Exercicio 1



Route::get('/media', [ExerciseController::class, 'mediaPulse'])->name('exercises.media');




Route::get('/exercises', [ExerciseController::class, 'index'])->name('exercises.index');
Route::get('/exercises/create', [ExerciseController::class, 'create'])->name('exercises.create');
Route::post('/exercises', [ExerciseController::class, 'store'])->name('exercises.store');
Route::get('/exercises/{exercise}', [ExerciseController::class, 'show'])->name('exercises.show');

Route::get('/exercises/{exercise}/edit', [ExerciseController::class, 'edit'])->name('exercises.edit');
Route::put('/exercises/{exercise}', [ExerciseController::class, 'update'])->name('exercises.update');


Route::delete('/exercises/{exercise}', [ExerciseController::class, 'destroy'])->name('exercises.destroy');





Route::get('/exercises/result', [ExerciseController::class, 'importarCSV'])->name('exercises.result');







Route::get('/exercises/media', [ExerciseController::class, 'mediaPulse'])->name('exercises.mediaPulse');

Route::get('/exercises/export', [ExerciseController::class, 'gerarCSV'])->name('exercises.gerarCSV');

