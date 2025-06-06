<?php

use App\Models\UserProf;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PosController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\WeightController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\UserProfController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\AnnouncementsController;
use App\Http\Controllers\ProgramController;

Route::get('/', function () {
    return view('landing.index');
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
    Route::get('/members/{members}/disapprove', [ProfileController::class, 'disapprove'])->name('members.disapprove');
});

// category
Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::get('/category/add', [CategoryController::class, 'add'])->name('category.add');
Route::put('/category/store', [CategoryController::class, 'store'])->name('category.store');
Route::get('/category/{categories}/edit', [CategoryController::class, 'edit'])->name('category.edit');
Route::delete('/category/{categories}', [CategoryController::class, 'destroy'])->name('category.destroy');
Route::patch('/category/{categories}', [CategoryController::class, 'update'])->name('category.update');
Route::get('/category/{categories}/exercises', [CategoryController::class, 'exercises'])->name('category.exercises');



// inventory
Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
Route::get('/inventory/add', [InventoryController::class, 'add'])->name('inventory.add');
Route::put('/inventory/store', [InventoryController::class, 'store'])->name('inventory.store');
Route::get('/inventory/{inventories}/edit', [InventoryController::class, 'edit'])->name('inventory.edit');
Route::delete('/inventory/{inventories}', [InventoryController::class, 'destroy'])->name('inventory.destroy');
Route::patch('/inventory/{inventories}', [InventoryController::class, 'update'])->name('inventory.update');

// weight
Route::get('/weight', [WeightController::class, 'index'])->name('weight.index');
Route::get('/weight/add', [WeightController::class, 'add'])->name('weight.add');
Route::put('/weight/store', [WeightController::class, 'store'])->name('weight.store');
Route::delete('/weight/{weights}', [WeightController::class, 'destroy'])->name('weight.destroy');
Route::get('/chart/weights', [WeightController::class, 'weightChartData']);



// equipment
Route::get('/equipment', [EquipmentController::class, 'index'])->name('equipment.index');
Route::get('/equipment/add', [EquipmentController::class, 'add'])->name('equipment.add');
Route::put('/equipment/store', [EquipmentController::class, 'store'])->name('equipment.store');
Route::get('/equipment/{equipments}/edit', [EquipmentController::class, 'edit'])->name('equipment.edit');
Route::delete('/equipment/{equipments}', [EquipmentController::class, 'destroy'])->name('equipment.destroy');
Route::patch('/equipment/{equipments}', [EquipmentController::class, 'update'])->name('equipment.update');

Route::get('/equipment/{equipments}/qr', [EquipmentController::class, 'qr'])->name('equipment.qr');


Route::get('/scanner', [EquipmentController::class, 'scanner'])->name('scanner.index');


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


// announcement
Route::get('/announcement', [AnnouncementsController::class, 'index'])->name('announcement.index');
Route::get('/announcement/add', [AnnouncementsController::class, 'add'])->name('announcement.add');
Route::put('/announcement/store', [AnnouncementsController::class, 'store'])->name('announcement.store');
Route::get('/announcement/{announcements}/edit', [AnnouncementsController::class, 'edit'])->name('announcement.edit');
Route::delete('/announcement/{announcements}', [AnnouncementsController::class, 'destroy'])->name('announcement.destroy');
Route::patch('/announcement/{announcements}', [AnnouncementsController::class, 'update'])->name('announcement.update');

// events
Route::get('/events', [EventsController::class, 'index'])->name('events.index');
Route::get('/events/add', [EventsController::class, 'add'])->name('events.add');
Route::put('/events/store', [EventsController::class, 'store'])->name('events.store');
Route::get('/events/{events}/edit', [EventsController::class, 'edit'])->name('events.edit');
Route::delete('/events/{events}', [EventsController::class, 'destroy'])->name('events.destroy');
Route::patch('/events/{events}', [EventsController::class, 'update'])->name('events.update');


// pos
Route::get('/pos', [PosController::class, 'index'])->name('pos.index');
Route::get('/pos/add', [PosController::class, 'add'])->name('pos.add');
Route::put('/pos/store', [PosController::class, 'store'])->name('pos.store');
Route::get('/pos/{pos}/edit', [PosController::class, 'edit'])->name('pos.edit');
Route::delete('/pos/{pos}', [PosController::class, 'destroy'])->name('pos.destroy');
Route::patch('/pos/{pos}', [PosController::class, 'update'])->name('pos.update');


// workout
Route::get('/workout', [WorkoutController::class, 'index'])->name('workout.index');

Route::get('/workout/add', [WorkoutController::class, 'add'])->name('workout.add');
Route::put('/workout/store', [WorkoutController::class, 'store'])->name('workout.store');
Route::put('/workout/copy', [WorkoutController::class, 'copy'])->name('workout.copy');
Route::get('/workout/{exercises}/addlog', [WorkoutController::class, 'addlog'])->name('workout.addlog');
Route::get('/workout/{workouts}/edit', [WorkoutController::class, 'edit'])->name('workout.edit');
Route::delete('/workout/{workouts}', [WorkoutController::class, 'destroy'])->name('workout.destroy');
Route::patch('/workout/{workouts}', [WorkoutController::class, 'update'])->name('workout.update');

Route::get('/workout/userprogram/{programs}', [WorkoutController::class, 'userprogram'])->name('workout.useprogram');

// program
Route::get('/program', [ProgramController::class, 'index'])->name('program.index');
Route::get('/program/add', [ProgramController::class, 'add'])->name('program.add');
Route::put('/program/store', [ProgramController::class, 'store'])->name('program.store');
Route::delete('/program/{programs}', [ProgramController::class, 'destroy'])->name('program.destroy');
Route::get('/program/{programs}/edit', [ProgramController::class, 'edit'])->name('program.edit');


//programexercise
Route::get('/workout2/add/{program}', [WorkoutController::class, 'add2'])->name('workout2.add');
Route::put('/workout2/store', [WorkoutController::class, 'store2'])->name('workout2.store');
Route::get('/workout2/{exercises}/addlog/{program}', [WorkoutController::class, 'addlog2'])->name('workout2.addlog');
Route::get('/workout2/{workouts}/edit/{program}', [WorkoutController::class, 'edit2'])->name('workout2.edit');
Route::delete('/workout2/{workouts}/{program}', [WorkoutController::class, 'destroy2'])->name('workout2.destroy');
Route::patch('/workout2/{workouts}', [WorkoutController::class, 'update2'])->name('workout2.update');



// calendar
Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');


// tdee
Route::get('/step1', [UserProfController::class, 'step1'])->name('calculator.index');
Route::put('/step1/store', [UserProfController::class, 'store'])->name('calculator.store');
Route::get('/step2/{userprof}', [UserProfController::class, 'step2'])->name('calculator.step2');
Route::put('/step2/store2', [UserProfController::class, 'store2'])->name('calculator.store2');
Route::get('/step3/{userprof}', [UserProfController::class, 'step3'])->name('calculator.step3');



require __DIR__ . '/auth.php';
