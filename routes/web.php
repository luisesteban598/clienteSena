
<?php
// Pega esto en routes/web.php de clienteBlog

use App\Http\Controllers\ApprenticeController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\ComputerController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TrainingCenterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/nosotros', function () {
    return view('nosotros');
})->name('nosotros');

Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

Route::get('/instructores', function () {
    return redirect()->route('teacher.index');
})->name('instructores');

Route::get('/cursos', function () {
    return redirect()->route('curso.index');
})->name('cursos');

// AreaController
Route::get('area/list', [AreaController::class, 'index'])->name('area.index');
Route::get('area/create', [AreaController::class, 'create'])->name('area.create');
Route::post('area/store', [AreaController::class, 'store'])->name('area.store');
Route::get('area/show/{area}', [AreaController::class, 'show'])->name('area.show');
Route::get('area/edit/{area}', [AreaController::class, 'edit'])->name('area.edit');
Route::put('area/update/{area}', [AreaController::class, 'update'])->name('area.update');
Route::delete('area/delete/{area}', [AreaController::class, 'destroy'])->name('area.destroy');

// ComputerController
Route::get('computer/list', [ComputerController::class, 'index'])->name('computer.index');
Route::get('computer/create', [ComputerController::class, 'create'])->name('computer.create');
Route::post('computer/store', [ComputerController::class, 'store'])->name('computer.store');
Route::get('computer/show/{computer}', [ComputerController::class, 'show'])->name('computer.show');
Route::get('computer/edit/{computer}', [ComputerController::class, 'edit'])->name('computer.edit');
Route::put('computer/update/{computer}', [ComputerController::class, 'update'])->name('computer.update');
Route::delete('computer/delete/{computer}', [ComputerController::class, 'destroy'])->name('computer.destroy');

// TrainingCenterController
Route::get('trainingCenter/list', [TrainingCenterController::class, 'index'])->name('trainingCenter.index');
Route::get('trainingCenter/create', [TrainingCenterController::class, 'create'])->name('trainingCenter.create');
Route::post('trainingCenter/store', [TrainingCenterController::class, 'store'])->name('trainingCenter.store');
Route::get('trainingCenter/show/{trainingCenter}', [TrainingCenterController::class, 'show'])->name('trainingCenter.show');
Route::get('trainingCenter/edit/{trainingCenter}', [TrainingCenterController::class, 'edit'])->name('trainingCenter.edit');
Route::put('trainingCenter/update/{trainingCenter}', [TrainingCenterController::class, 'update'])->name('trainingCenter.update');
Route::delete('trainingCenter/delete/{trainingCenter}', [TrainingCenterController::class, 'destroy'])->name('trainingCenter.destroy');

// TeacherController
Route::get('teacher/list', [TeacherController::class, 'index'])->name('teacher.index');
Route::get('teacher/create', [TeacherController::class, 'create'])->name('teacher.create');
Route::post('teacher/store', [TeacherController::class, 'store'])->name('teacher.store');
Route::get('teacher/show/{teacher}', [TeacherController::class, 'show'])->name('teacher.show');
Route::get('teacher/edit/{teacher}', [TeacherController::class, 'edit'])->name('teacher.edit');
Route::put('teacher/update/{teacher}', [TeacherController::class, 'update'])->name('teacher.update');
Route::delete('teacher/delete/{teacher}', [TeacherController::class, 'destroy'])->name('teacher.destroy');

// CursoController
Route::get('curso/list', [CursoController::class, 'index'])->name('curso.index');
Route::get('curso/create', [CursoController::class, 'create'])->name('curso.create');
Route::post('curso/store', [CursoController::class, 'store'])->name('curso.store');
Route::get('curso/show/{curso}', [CursoController::class, 'show'])->name('curso.show');
Route::get('curso/edit/{curso}', [CursoController::class, 'edit'])->name('curso.edit');
Route::put('curso/update/{curso}', [CursoController::class, 'update'])->name('curso.update');
Route::delete('curso/delete/{curso}', [CursoController::class, 'destroy'])->name('curso.destroy');

// ApprenticeController
Route::get('apprentice/list', [ApprenticeController::class, 'index'])->name('apprentice.index');
Route::get('apprentice/create', [ApprenticeController::class, 'create'])->name('apprentice.create');
Route::post('apprentice/store', [ApprenticeController::class, 'store'])->name('apprentice.store');
Route::get('apprentice/show/{apprentice}', [ApprenticeController::class, 'show'])->name('apprentice.show');
Route::get('apprentice/edit/{apprentice}', [ApprenticeController::class, 'edit'])->name('apprentice.edit');
Route::put('apprentice/update/{apprentice}', [ApprenticeController::class, 'update'])->name('apprentice.update');
Route::delete('apprentice/delete/{apprentice}', [ApprenticeController::class, 'destroy'])->name('apprentice.destroy');

// NewsController
Route::get('noticias/create', [NewsController::class, 'create'])->name('news.create.localized');
Route::get('news/list', [NewsController::class, 'index'])->name('news.index');
Route::get('news/create', [NewsController::class, 'create'])->name('news.create');
Route::post('news/store', [NewsController::class, 'store'])->name('news.store');
Route::get('news/show/{news}', [NewsController::class, 'show'])->name('news.show');
Route::get('news/edit/{news}', [NewsController::class, 'edit'])->name('news.edit');
Route::put('news/update/{news}', [NewsController::class, 'update'])->name('news.update');
Route::delete('news/delete/{news}', [NewsController::class, 'destroy'])->name('news.destroy');
