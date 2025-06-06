@php
    use Carbon\Carbon;
    use App\Models\Exercise;
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('TDEE Calculator') }}-> Step 3: Workout Recommendation
        </h2>
    </x-slot>


    <br><br>
<div class="w-full max-w-2xl p-6 mx-auto bg-white rounded-lg shadow-md card">
    <h3>🎯 Calorie Goal</h3>

    <p><strong>Current Weight:</strong> {{ $userprof->weight}} kg</p>
    <p><strong>Goal Weight:</strong> {{ $userprof->goal }} kg</p>
    <p><strong>Target Date:</strong> {{ $userprof->date }}</p>

    @php
        // Calculate days remaining
    $daysLeft = round(Carbon::now()->diffInDays($userprof->date , false));

    // Assume 7700 kcal = 1 kg fat loss
    $caloriesToBurn = ($userprof->weight - $userprof->goal ) * 7700;

    // Calculate daily adjustment needed
    $caloriesPerDay = $daysLeft > 0 ? round($caloriesToBurn / $daysLeft) : 0;
    @endphp

    <hr>
    <br>
    <br>
        <p><strong>Days Left:</strong> {{ $daysLeft }}</p>

        @if ($userprof->goal > $userprof->weight)
            <p><strong>Total Calories to Consume:</strong> {{ number_format($caloriesToBurn * -1) }} kcal</p>
        <p><strong>Calories to Add per Day:</strong> {{ number_format($caloriesPerDay * -1) }} kcal/day</p>
         @else
 <p><strong>Total Calories to Burn:</strong> {{ number_format($caloriesToBurn) }} kcal</p>
        <p><strong>Calories to Cut per Day:</strong> {{ number_format($caloriesPerDay) }} kcal/day</p>
        @endif
       
        <p><strong>TDEE:</strong> {{ number_format($userprof->tdee) }} kcal/day</p>
    

        <hr>
    <br>
    <br>
     <h1><strong>Total Calories to Consume per Day:</strong> {{ number_format($userprof->tdee - $caloriesPerDay)  }} kcal/day</h1>
    
</div>


    

    <h1><b> Workout Recommendation </b></h1>
<div class="grid w-full grid-cols-1 gap-6 mt-6 cards-wrapper md:grid-cols-2 lg:grid-cols-3">
    @foreach ($program as $programs)
        <div class="flex flex-col w-full h-full p-6 bg-white rounded-lg shadow card">
            <div class="flex flex-col items-center mb-4">
                <h3 class="w-full text-lg font-bold text-center">{{ $programs->name }}</h3>
                <div class="flex gap-2 mt-2">
                    <x-bladewind::button color="gray" icon="pencil-square" title="edit"
                        onclick="window.location='{{ route('program.edit', $programs->id) }}'">CUSTOMIZE</x-bladewind::button>
                </div>
            </div>
            <table class="min-w-full text-sm border">
                <thead>
                    @php
                        $firstExercise = $programs->exercises->first();
                        $isCardio = $firstExercise && $firstExercise->exercise->category && strtolower($firstExercise->exercise->category->name) === 'cardio';
                    @endphp
                    <tr class="bg-gray-100">
                        <th class="px-2 py-1 border">Exercise</th>
                        @if($isCardio)
                            <th class="px-2 py-1 border">Resistance</th>
                            <th class="px-2 py-1 border">Time (Seconds)</th>
                        @else
                            <th class="px-2 py-1 border">Weight</th>
                            <th class="px-2 py-1 border">Reps</th>
                        @endif
                        <th class="px-2 py-1 border">Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                        $lastExerciseName = null; 
                        $lastIsCardio = null;
                    @endphp
                    @forelse ($programs->exercises as $exercise)
                        @php
                            $isCardioRow = $exercise->exercise->category && strtolower($exercise->exercise->category->name) === 'cardio';
                        @endphp

                        {{-- Insert new header row if cardio/strength type changes --}}
                        @if($lastIsCardio !== null && $lastIsCardio !== $isCardioRow)
                            <tr class="font-bold bg-gray-100">
                                <td class="px-2 py-1 border">Exercise</td>
                                @if($isCardioRow)
                                    <td class="px-2 py-1 border">Resistance</td>
                                    <td class="px-2 py-1 border">Time (Seconds)</td>
                                @else
                                    <td class="px-2 py-1 border">Weight</td>
                                    <td class="px-2 py-1 border">Reps</td>
                                @endif
                                <td class="px-2 py-1 border">Remarks</td>
                            </tr>
                        @endif

                        @if ($lastExerciseName !== null && $lastExerciseName !== $exercise->exercise->name)
                            <tr>
                                <td colspan="5" class="border-t-2 border-b-0 border-l-0 border-r-0"></td>
                            </tr>
                        @endif
                        <tr>
                            <td class="px-2 py-1 border">{{ $exercise->exercise->name }}</td>
                            @if($isCardioRow)
                                <td class="px-2 py-1 border">{{ $exercise->weight }}</td>
                                <td class="px-2 py-1 border">{{ $exercise->reps }}</td>
                            @else
                                <td class="px-2 py-1 border">{{ $exercise->weight }}</td>
                                <td class="px-2 py-1 border">{{ $exercise->reps }}</td>
                            @endif
                            <td class="px-2 py-1 border">{{ $exercise->remarks }}</td>
                        </tr>
                        @php 
                            $lastExerciseName = $exercise->exercise->name; 
                            $lastIsCardio = $isCardioRow;
                        @endphp
                    @empty
                        <tr>
                            <td colspan="5" class="px-2 py-1 text-center text-gray-400 border">No exercises</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="flex justify-center mt-4">
                <x-bladewind::button color="primary" icon="check-circle"
                    onclick="window.location='{{ route('workout.useprogram', $programs->id) }}'">
                    Use This Program
                </x-bladewind::button>
            </div>
        </div>
    @endforeach
</div>

<style>
    h1 {
        text-align: center;
        margin: 30px 0;
        font-size: larger;
    }

    .cards-wrapper {
        width: 100%;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    @media (min-width: 768px) {
        .cards-wrapper {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    @media (min-width: 1024px) {
        .cards-wrapper {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    .card {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
    }

    .card h2 {
        margin-top: 0;
        color: #333;
    }

    .exercise-list {
        list-style: none;
        padding-left: 0;
    }

    .exercise-list li {
        position: relative;
        padding-left: 20px;
        margin-bottom: 10px;
    }

    .exercise-list li::before {
        content: '';
        position: absolute;
        top: 7px;
        left: 0;
        width: 8px;
        height: 8px;
        background-color: #007BFF;
        border-radius: 50%;
    }

    .add-button {
        margin-top: 15px;
        padding: 10px 15px;
        background-color: #007BFF;
        color: #fff;
        border: none;
        border-radius: 4px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .add-button:hover {
        background-color: #0056b3;
    }

    .message {
        color: green;
        font-size: 14px;
        margin-top: 10px;
        display: none;
    }
</style>
</x-app-layout>
