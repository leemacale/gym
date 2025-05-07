<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WorkoutController;
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

    Route::get('/equipment/{equipments}/views', [EquipmentController::class, 'views'])->name('equipment.views');

    //user

    Route::get('/members', [ProfileController::class, 'members'])->name('members.index');
    Route::get('/members/{members}/approve', [ProfileController::class, 'approve'])->name('members.approve');
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

Route::get('/equipment/{equipments}/qr', [EquipmentController::class, 'qr'])->name('equipment.qr');


Route::get('/equipment/{equipments}/exercises', [EquipmentController::class, 'exercises'])->name('equipment.exercises');
Route::get('/equipment/{equipments}/addexercises', [EquipmentController::class, 'addexercises'])->name('equipment.addexercises');
Route::put('/equipment/storeexercise', [EquipmentController::class, 'storeexercise'])->name('equipment.storeexercise');
Route::delete('/equipment/{exercises}/destroy2', [EquipmentController::class, 'destroy2'])->name('equipment.destroy2');


// exercise
Route::get('/exercise', [ExerciseController::class, 'index'])->name('exercise.index');
Route::get('/exercise/add', [ExerciseController::class, 'add'])->name('exercise.add');
Route::put('/exercise/store', [ExerciseController::class, 'store'])->name('exercise.store');
Route::get('/exercise/{exercises}/edit', [ExerciseController::class, 'edit'])->name('exercise.edit');
Route::delete('/exercise/{exercises}', [ExerciseController::class, 'destroy'])->name('exercise.destroy');
Route::patch('/exercise/{exercises}', [ExerciseController::class, 'update'])->name('exercise.update');




// workout
Route::get('/workout', [WorkoutController::class, 'index'])->name('workout.index');
Route::get('/workout/add', [WorkoutController::class, 'add'])->name('workout.add');
Route::put('/workout/store', [WorkoutController::class, 'store'])->name('workout.store');
Route::get('/workout/{exercises}/addlog', [WorkoutController::class, 'addlog'])->name('workout.addlog');
Route::get('/workout/{workouts}/edit', [WorkoutController::class, 'edit'])->name('workout.edit');
Route::delete('/workout/{workouts}', [WorkoutController::class, 'destroy'])->name('workout.destroy');
Route::patch('/workout/{workouts}', [WorkoutController::class, 'update'])->name('workout.update');


// workout
Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');
require __DIR__ . '/auth.php';
