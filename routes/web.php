<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// category
Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::get('/category/add', [CategoryController::class, 'add'])->name('category.add');
Route::put('/category/store', [CategoryController::class, 'store'])->name('category.store');
Route::get('/category/{categories}/edit', [CategoryController::class, 'edit'])->name('category.edit');
Route::delete('/category/{categories}', [CategoryController::class, 'destroy'])->name('category.destroy');
Route::patch('/category/{categories}', [CategoryController::class, 'update'])->name('category.update');


// inventory
Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
Route::get('/inventory/add', [InventoryController::class, 'add'])->name('inventory.add');
Route::put('/inventory/store', [InventoryController::class, 'store'])->name('inventory.store');
Route::get('/inventory/{inventories}/edit', [InventoryController::class, 'edit'])->name('inventory.edit');
Route::delete('/inventory/{inventories}', [InventoryController::class, 'destroy'])->name('inventory.destroy');
Route::patch('/inventory/{inventories}', [InventoryController::class, 'update'])->name('inventory.update');


// equipment
Route::get('/equipment', [EquipmentController::class, 'index'])->name('equipment.index');
Route::get('/equipment/add', [EquipmentController::class, 'add'])->name('equipment.add');
Route::put('/equipment/store', [EquipmentController::class, 'store'])->name('equipment.store');
Route::get('/equipment/{equipments}/edit', [EquipmentController::class, 'edit'])->name('equipment.edit');
Route::delete('/equipment/{equipments}', [EquipmentController::class, 'destroy'])->name('equipment.destroy');
Route::patch('/equipment/{equipments}', [EquipmentController::class, 'update'])->name('equipment.update');


// exercise
Route::get('/exercise', [ExerciseController::class, 'index'])->name('exercise.index');
Route::get('/exercise/add', [ExerciseController::class, 'add'])->name('exercise.add');
Route::put('/exercise/store', [ExerciseController::class, 'store'])->name('exercise.store');
Route::get('/exercise/{exercises}/edit', [ExerciseController::class, 'edit'])->name('exercise.edit');
Route::delete('/exercise/{exercises}', [ExerciseController::class, 'destroy'])->name('exercise.destroy');
Route::patch('/exercise/{exercises}', [ExerciseController::class, 'update'])->name('equipexerciseent.update');


require __DIR__ . '/auth.php';
