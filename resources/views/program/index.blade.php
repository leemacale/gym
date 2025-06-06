<x-app-layout>
    <div class="px-8 overflow-x-auto">
        <x-slot name="header">
            <div class="flex justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __('My Programs') }}
                </h2>
                    <x-bladewind::button color="gray" icon="plus"
                        onclick="window.location='{{ route('program.add') }}'">Add</x-bladewind::button>
            </div>
        </x-slot>


        <div class="grid grid-cols-3 gap-6 mt-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($program as $programs)
                <div class="flex flex-col p-6 bg-white rounded-lg shadow">
                    <div class="flex flex-col items-center mb-4">
                        <h3 class="w-full text-lg font-bold text-center">{{ $programs->name }}</h3>
                        <div class="flex gap-2 mt-2">
                            <x-bladewind::button color="gray" icon="pencil-square" title="edit"
                                onclick="window.location='{{ route('program.edit', $programs->id) }}'">CUSTOMIZE</x-bladewind::button>
                            <form method="POST" action="{{ route('program.destroy', $programs->id) }}">
                                @csrf
                                @method('DELETE')
                                <x-bladewind::button color="gray" icon="trash" title="delete" can_submit="true">DELETE</x-bladewind::button>
                            </form>
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

                                {{-- Separator only when the exercise is different --}}
                                @if($lastExerciseName !== null && $lastExerciseName !== $exercise->exercise->name)
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
    </div>
</x-app-layout>
