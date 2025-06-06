<x-app-layout>
    <div class="px-8 overflow-x-auto">
        <div class="">
            <x-slot name="header">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __('Add Exercise') }}
                </h2>

            </x-slot>
    <div class="flex gap-6 mt-6">
            <!-- Left: Programs List (1/3) -->
            <div class="w-1/3 max-h-[80vh] overflow-y-auto space-y-4">
                @foreach ($program as $programs)
                    <div class="flex flex-col p-4 bg-white rounded-lg shadow">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-lg font-bold">{{ $programs->name }}</h3>
                            <div class="flex gap-1">
                                <x-bladewind::button color="gray" icon="pencil-square" title="edit"
                                    onclick="window.location='{{ route('program.edit', $programs->id) }}'">Customize</x-bladewind::button>
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
            </div>

 <div class="w-2/3">
                <div class="bg-white divide-y rounded-lg shadow-sm overflow-x">

            <x-bladewind::table compact="true" divider="thin" striped="true" celled="true" class="overflow-scroll"
                searchable="true">

                <x-slot name="header">
                    <th>Name</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Equipment</th>
            

                    <th></th>
                </x-slot>
                @foreach ($exercise as $exercises)
                    <tr>
                        <td>{{ $exercises->name }}</td>
                        <td>{{ $exercises->category->name }}</td>
                        <td><img src="{{ asset($exercises->image) }}" alt="" height="200px" width="200px"></td>
                        <td>
                            @foreach ($exercises->equipment as $equipment)
                                <a
                                    href="/equipment/{{ $equipment->equipment->id }}/views">{{ $equipment->equipment->name }}</a>,
                            @endforeach
                        </td>
                                   
                        <td>

                            <x-bladewind::button color="gray" icon="plus" title="add"
                                onclick="window.location='{{ route('workout.addlog', $exercises->id) }}'">Add</x-bladewind::button>


                        </td>
                    </tr>
                @endforeach
            </x-bladewind::table>
                </div>
 </div>

        </div>
    </div>
</x-app-layout>
