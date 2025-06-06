<x-app-layout>
    <div class="px-8 overflow-x-auto">
        <x-slot name="header">
            <div class="flex justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    @if ($date != '')
                        {{ __($date . ' Workout') }}
                    @else
                        {{ __('Todays Workout') }}
                    @endif
                </h2>
                <x-bladewind::button color="gray" onclick="window.location='{{ route('calendar.index') }}'">Workout Calendar</x-bladewind::button>
                <x-bladewind::button color="gray" icon="plus" onclick="window.location='{{ route('workout.add') }}'">Add</x-bladewind::button>
            </div>
        </x-slot>

        <div class="flex gap-6 mt-6">
            <!-- Left: Programs List (1/3) -->
            <div class="w-1/3 max-h-[80vh] overflow-y-auto space-y-4">
                @if (Auth::user()->role == 'admin' || Auth::user()->type == 'Member')
                    @foreach ($program as $programs)
                        <div class="flex flex-col p-4 bg-white rounded-lg shadow">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="text-lg font-bold">{{ $programs->name }}</h3>
                                <div class="flex gap-1">
    @if(
        Auth::user()->role == 'admin' &&
        !(($programs->user_id == 1) || (Str::contains(strtolower($programs->name), 'recommended')))
    )
        <x-bladewind::button color="gray" icon="pencil-square" title="edit"
            onclick="window.location='{{ route('program.edit', $programs->id) }}'">Customize</x-bladewind::button>
    @endif
</div>
                            </div>
                            <table class="min-w-full text-xs border">
                                <thead>
                                    <tr class="bg-gray-100">
                                        @php
                                            // Check if first exercise is cardio for header
                                            $firstExercise = $programs->exercises->first();
                                            $isCardio = $firstExercise && $firstExercise->exercise->category && strtolower($firstExercise->exercise->category->name) === 'cardio';
                                        @endphp
                                        <th class="px-2 py-1 border">Exercise</th>
                                        @if($isCardio)
                                            <th class="px-2 py-1 border">Resistance</th>
                                            <th class="px-2 py-1 border">Time</th>
                                        @else
                                            <th class="px-2 py-1 border">Weight</th>
                                            <th class="px-2 py-1 border">Reps</th>
                                        @endif
                                        <th class="px-2 py-1 border">Remarks</th>
                                        <th class="px-2 py-1 border"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php 
                                        $lastExerciseName = null; 
                                        $lastIsCardio = null;
                                    @endphp
                                    @forelse ($programs->exercises as $exercises)
                                        @php
                                            $isCardioRow = $exercises->exercise->category && strtolower($exercises->exercise->category->name) === 'cardio';
                                        @endphp

                                        {{-- Insert new header row if cardio/strength type changes --}}
                                        @if($lastIsCardio !== null && $lastIsCardio !== $isCardioRow)
                                            <tr class="font-bold bg-gray-100">
                                                <td class="px-2 py-1 border">Exercise</td>
                                                @if($isCardioRow)
                                                    <td class="px-2 py-1 border">Resistance</td>
                                                    <td class="px-2 py-1 border">Time</td>
                                                @else
                                                    <td class="px-2 py-1 border">Weight</td>
                                                    <td class="px-2 py-1 border">Reps</td>
                                                @endif
                                                <td class="px-2 py-1 border">Remarks</td>
                                                <td class="px-2 py-1 border"></td>
                                            </tr>
                                        @endif

                                        @if ($lastExerciseName !== null && $lastExerciseName !== $exercises->exercise->name)
                                            <tr>
                                                <td colspan="5" class="border-t-2 border-b-0 border-l-0 border-r-0"></td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td class="px-2 py-1 border">{{ $exercises->exercise->name }}</td>
                                            @if($isCardioRow)
                                                <td class="px-2 py-1 border">{{ $exercises->weight }}</td>
                                                <td class="px-2 py-1 border">{{ $exercises->reps }}</td>
                                            @else
                                                <td class="px-2 py-1 border">{{ $exercises->weight }}</td>
                                                <td class="px-2 py-1 border">{{ $exercises->reps }}</td>
                                            @endif
                                            <td class="px-2 py-1 border">{{ $exercises->remarks }}</td>
                                            <td class="px-2 py-1 border">
                                                <x-bladewind::button color="gray" icon="plus" title="add"
                                                    onclick="window.location='{{ route('workout.addlog', $exercises->exercise->id) }}'">Add</x-bladewind::button>
                                            </td>
                                        </tr>
                                        @php 
                                            $lastExerciseName = $exercises->exercise->name; 
                                            $lastIsCardio = $isCardioRow;
                                        @endphp
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-2 py-1 text-center text-gray-400 border">No exercises</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                @else
                    <div class="flex flex-col items-center justify-center h-full p-8 bg-white rounded-lg shadow">
                        <span class="mb-2 text-lg font-semibold text-gray-700">This feature is for members only.</span>
                        <span class="mb-4 text-gray-500">Please avail membership to get this feature unlocked.</span>
                    </div>
                @endif
            </div>

            <!-- Right: Existing Workout Table (2/3) -->
            <div class="w-2/3">
                <div class="bg-white divide-y rounded-lg shadow-sm overflow-x">
                    <x-bladewind::table compact="true" divider="thin" striped="true" celled="true" class="overflow-scroll">
                        @php 
                            $lastExerciseName = null; 
                            $lastIsCardio = null;
                            $firstWorkout = $workout->first();
                            $isCardio = $firstWorkout && $firstWorkout->exercise->category && strtolower($firstWorkout->exercise->category->name) === 'cardio';
                        @endphp
                        <x-slot name="header">
                            <tr class="bg-gray-100">
                                <th>Exercise</th>
                                @if($isCardio)
                                    <th>Resistance</th>
                                    <th>Time</th>
                                @else
                                    <th>Weight</th>
                                    <th>Reps</th>
                                @endif
                                <th>Remarks</th>
                                <th></th>
                            </tr>
                        </x-slot>
                        @foreach ($workout as $workouts)
                            @php
                                $isCardioRow = $workouts->exercise->category && strtolower($workouts->exercise->category->name) === 'cardio';
                            @endphp

                            {{-- Insert new header row if cardio/strength type changes --}}
                            @if($lastIsCardio !== null && $lastIsCardio !== $isCardioRow)
                                <tr class="font-bold bg-gray-100">
                                    <td>Exercise</td>
                                    @if($isCardioRow)
                                        <td>Resistance</td>
                                        <td>Time</td>
                                    @else
                                        <td>Weight</td>
                                        <td>Reps</td>
                                    @endif
                                    <td>Remarks</td>
                                    <td></td>
                                </tr>
                            @endif

                            @if ($lastExerciseName !== null && $lastExerciseName !== $workouts->exercise->name)
                                <tr>
                                    <td colspan="5" class="border-t-2 border-b-0 border-l-0 border-r-0"></td>
                                </tr>
                            @endif
                            <tr>
                                <td>{{ $workouts->exercise->name }}</td>
                                @if($isCardioRow)
                                    <td>{{ $workouts->weight }}</td>
                                    <td>{{ $workouts->reps }}</td>
                                @else
                                    <td>{{ $workouts->weight }}</td>
                                    <td>{{ $workouts->reps }}</td>
                                @endif
                                <td>{{ $workouts->remarks }}</td>
                                <td>
                                    <form method="POST" action="{{ route('workout.destroy', $workouts->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <x-bladewind::button color="gray" icon="pencil-square" title="edit" class="w-full m-2"
                                            onclick="window.location='{{ route('workout.edit', $workouts->id) }}'">EDIT</x-bladewind::button>
                                        <x-bladewind::button color="gray" icon="trash" title="delete" class="w-full m-2"
                                            can_submit="true">DELETE</x-bladewind::button>
                                    </form>
                                </td>
                            </tr>
                            @php 
                                $lastExerciseName = $workouts->exercise->name; 
                                $lastIsCardio = $isCardioRow;
                            @endphp
                        @endforeach
                    </x-bladewind::table>
                </div>
                <br>
                <hr><br>
                @if ($date != '')
                    <form method="POST" action="{{ route('workout.copy') }}">
                        @csrf
                        @method('put')
                        Copy Workout to:
                        <x-text-input id="old" class="mt-1" type="hidden" name="old" value="{{ $date }}" />
                        <x-text-input id="date" class="mt-1" type="date" name="date" />
                        <x-bladewind::button color="gray" icon="copy" title="delete" can_submit="true">Copy</x-bladewind::button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
