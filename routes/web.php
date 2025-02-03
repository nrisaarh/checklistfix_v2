<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\AuthController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::get('/', function () {
//     return view('welcome');
// });


Route::prefix('checklists')->middleware('auth')->group(function () {
    Route::get('/', [ChecklistController::class, 'index'])->name('checklists.index');
    Route::get('/create', [ChecklistController::class, 'create'])->name('checklists.create');
    Route::post('/', [ChecklistController::class, 'store'])->name('checklists.store');
    Route::get('{checklist}/edit', [ChecklistController::class, 'edit'])->name('checklists.edit');
    Route::put('{checklist}', [ChecklistController::class, 'update'])->name('checklists.update');
    Route::delete('{checklist}', [ChecklistController::class, 'destroy'])->name('checklists.destroy');
    Route::get('/export-pdf', [ChecklistController::class, 'exportPdf'])->name('checklists.export-pdf');
});