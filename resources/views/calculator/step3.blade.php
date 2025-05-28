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
        <p><strong>Total Calories to Burn:</strong> {{ number_format($caloriesToBurn) }} kcal</p>
        <p><strong>Calories to Cut per Day:</strong> {{ number_format($caloriesPerDay) }} kcal/day</p>
        <p><strong>TDEE:</strong> {{ number_format($userprof->tdee) }} kcal/day</p>
    

        <hr>
    <br>
    <br>
     <h1><strong>Total Calories to Consume per Day:</strong> {{ number_format($userprof->tdee - $caloriesPerDay)  }} kcal/day</h1>
    
</div>


    

    <h1><b> Workout Recommendation </b></h1>
    <div class="cards-wrapper">
        <div class="card">
            <h2>Day 1</h2>
            <strong>Warm-up:</strong>
                <table>

                    @php
                       $warmup = Exercise::where('category_id', '9')->inRandomOrder()->first();
                    @endphp
            <tr>
                <td>• {{$warmup->name ?? ''}} 30 sec to 1-min</td>
                <td> <x-bladewind::button color="gray" icon="plus" title="add to workout"
        onclick="window.open('{{ route('workout.addlog', $warmup->id ?? '') }}')"></x-bladewind::button></td>
            </tr>
          
        </table>
            </ul>
            <strong>Workout:</strong>
            <table  cellpadding="5" cellspacing="0" class="exercise-table border-1">

                    @php
                       $chest = Exercise::where('category_id', '8')->inRandomOrder()->first();
                       $legs = Exercise::where('category_id', '2')->inRandomOrder()->first();
                       $back = Exercise::where('category_id', '4')->inRandomOrder()->first();
                       $rand1 = Exercise::inRandomOrder()->first();
                       $rand2 = Exercise::inRandomOrder()->first();
                 
                    @endphp
            <tr>
                <td>• {{$chest->name ?? ''}} 3 sets 8-10 reps</td>
                <td> <x-bladewind::button color="gray" icon="plus" title="add to workout"
        onclick="window.open('{{ route('workout.addlog', $chest->id ?? '') }}')"></x-bladewind::button></td>
            </tr>
              <tr>
                <td>• {{$legs->name ?? ''}} 3 sets 8-10 reps</td>
                <td> <x-bladewind::button color="gray" icon="plus" title="add to workout"
        onclick="window.open('{{ route('workout.addlog', $legs->id ?? '') }}')"></x-bladewind::button></td>

            </tr>
            <tr>
                <td>• {{$back->name ?? ''}} 3 sets 8-10 reps</td>
                <td> <x-bladewind::button color="gray" icon="plus" title="add to workout"
        onclick="window.open('{{ route('workout.addlog', $back->id ?? '') }}')"></x-bladewind::button></td>

            </tr>
              <tr>
                <td>• {{$rand1->name ?? ''}} 3 sets 8-10 reps</td>
                <td> <x-bladewind::button color="gray" icon="plus" title="add to workout"
        onclick="window.open('{{ route('workout.addlog', $rand1->id ?? '') }}')"></x-bladewind::button></td>

            </tr>
              <tr>
                <td>• {{$rand2->name ?? ''}} 3 sets 8-10 reps</td>
                <td> <x-bladewind::button color="gray" icon="plus" title="add to workout"
        onclick="window.open('{{ route('workout.addlog', $rand2->id ?? '') }}')"></x-bladewind::button></td>

            </tr>
            
          
        </table>
          
        </div>
   <div class="card">
            <h2>Day 2</h2>
            <strong>Warm-up:</strong>
                <table>

                    @php
                       $warmup = Exercise::where('category_id', '9')->inRandomOrder()->first();
                    @endphp
            <tr>
                <td>• {{$warmup->name ?? ''}} 30 sec to 1-min</td>
                <td> <x-bladewind::button color="gray" icon="plus" title="add to workout"
        onclick="window.open('{{ route('workout.addlog', $warmup->id ?? '') }}')"></x-bladewind::button></td>
            </tr>
          
        </table>
            </ul>
            <strong>Workout:</strong>
            <table  cellpadding="5" cellspacing="0" class="exercise-table border-1">

                    @php
                       $chest = Exercise::where('category_id', '8')->inRandomOrder()->first();
                       $legs = Exercise::where('category_id', '2')->inRandomOrder()->first();
                       $back = Exercise::where('category_id', '4')->inRandomOrder()->first();
                       $rand1 = Exercise::inRandomOrder()->first();
                       $rand2 = Exercise::inRandomOrder()->first();
                 
                    @endphp
            <tr>
                <td>• {{$chest->name ?? ''}} 3 sets 8-10 reps</td>
                <td> <x-bladewind::button color="gray" icon="plus" title="add to workout"
        onclick="window.open('{{ route('workout.addlog', $chest->id ?? '') }}')"></x-bladewind::button></td>
            </tr>
              <tr>
                <td>• {{$legs->name ?? ''}} 3 sets 8-10 reps</td>
                <td> <x-bladewind::button color="gray" icon="plus" title="add to workout"
        onclick="window.open('{{ route('workout.addlog', $legs->id ?? '') }}')"></x-bladewind::button></td>

            </tr>
            <tr>
                <td>• {{$back->name ?? ''}} 3 sets 8-10 reps</td>
                <td> <x-bladewind::button color="gray" icon="plus" title="add to workout"
        onclick="window.open('{{ route('workout.addlog', $back->id ?? '') }}')"></x-bladewind::button></td>

            </tr>
              <tr>
                <td>• {{$rand1->name ?? ''}} 3 sets 8-10 reps</td>
                <td> <x-bladewind::button color="gray" icon="plus" title="add to workout"
        onclick="window.open('{{ route('workout.addlog', $rand1->id ?? '') }}')"></x-bladewind::button></td>

            </tr>
              <tr>
                <td>• {{$rand2->name ?? ''}} 3 sets 8-10 reps</td>
                <td> <x-bladewind::button color="gray" icon="plus" title="add to workout"
        onclick="window.open('{{ route('workout.addlog', $rand2->id ?? '') }}')"></x-bladewind::button></td>

            </tr>
            
          
        </table>
          
        </div>

           <div class="card">
            <h2>Day 3</h2>
            <strong>Warm-up:</strong>
                <table>

                    @php
                       $warmup = Exercise::where('category_id', '9')->inRandomOrder()->first();
                    @endphp
            <tr>
                <td>• {{$warmup->name ?? ''}} 30 sec to 1-min</td>
                <td> <x-bladewind::button color="gray" icon="plus" title="add to workout"
        onclick="window.open('{{ route('workout.addlog', $warmup->id ?? '') }}')"></x-bladewind::button></td>
            </tr>
          
        </table>
            </ul>
            <strong>Workout:</strong>
            <table  cellpadding="5" cellspacing="0" class="exercise-table border-1">

                    @php
                       $chest = Exercise::where('category_id', '8')->inRandomOrder()->first();
                       $legs = Exercise::where('category_id', '2')->inRandomOrder()->first();
                       $back = Exercise::where('category_id', '4')->inRandomOrder()->first();
                       $rand1 = Exercise::inRandomOrder()->first();
                       $rand2 = Exercise::inRandomOrder()->first();
                 
                    @endphp
            <tr>
                <td>• {{$chest->name ?? ''}} 3 sets 8-10 reps</td>
                <td> <x-bladewind::button color="gray" icon="plus" title="add to workout"
        onclick="window.open('{{ route('workout.addlog', $chest->id ?? '') }}')"></x-bladewind::button></td>
            </tr>
              <tr>
                <td>• {{$legs->name ?? ''}} 3 sets 8-10 reps</td>
                <td> <x-bladewind::button color="gray" icon="plus" title="add to workout"
        onclick="window.open('{{ route('workout.addlog', $legs->id ?? '') }}')"></x-bladewind::button></td>

            </tr>
            <tr>
                <td>• {{$back->name ?? ''}} 3 sets 8-10 reps</td>
                <td> <x-bladewind::button color="gray" icon="plus" title="add to workout"
        onclick="window.open('{{ route('workout.addlog', $back->id ?? '') }}')"></x-bladewind::button></td>

            </tr>
              <tr>
                <td>• {{$rand1->name ?? ''}} 3 sets 8-10 reps</td>
                <td> <x-bladewind::button color="gray" icon="plus" title="add to workout"
        onclick="window.open('{{ route('workout.addlog', $rand1->id ?? '') }}')"></x-bladewind::button></td>

            </tr>
              <tr>
                <td>• {{$rand2->name ?? ''}} 3 sets 8-10 reps</td>
                <td> <x-bladewind::button color="gray" icon="plus" title="add to workout"
        onclick="window.open('{{ route('workout.addlog', $rand2->id ?? '') }}')"></x-bladewind::button></td>

            </tr>
            
          
        </table>
          
        </div>

    </div>

    <style>
        h1 {
            text-align: center;
            margin: 30px 0;
            font-size: larger;
        }

        /* Flex container for cards */
        .cards-wrapper {
            display: flex;
            flex-direction: column;
            gap: 20px;
            align-items: center;
            /* Center horizontally on mobile */
            justify-content: center;
            /* Center vertically (optional) */
            padding: 20px;
            max-width: 1200px;
            /* Limit max width on large screens */
            margin: 0 auto;
            /* Center container on large screens */
        }

        @media (min-width: 768px) {
            .cards-wrapper {
                flex-direction: row;
                justify-content: center;
                align-items: stretch;
                /* Stretch cards on large screens to equal height */
            }
        }

        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 350px;
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            flex: 1;
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
