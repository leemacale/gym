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
                                    <th class="px-2 py-1 border">Exercise</th>
                                    <th class="px-2 py-1 border">Weight</th>
                                    <th class="px-2 py-1 border">Reps</th>
                                    <th class="px-2 py-1 border">Remarks</th>
                                    <th class="px-2 py-1 border"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($programs->exercises as $exercises)
                                    <tr>
                                        <td class="px-2 py-1 border">{{ $exercises->exercise->name }}</td>
                                        <td class="px-2 py-1 border">{{ $exercises->weight }}</td>
                                        <td class="px-2 py-1 border">{{ $exercises->reps }}</td>
                                        <td class="px-2 py-1 border">{{ $exercises->remarks }}</td>
                                        <td class="px-2 py-1 border">
                                            <x-bladewind::button color="gray" icon="plus" title="add"
                                                onclick="window.location='{{ route('workout.addlog', $exercises->exercise->id) }}'">Add</x-bladewind::button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-2 py-1 text-center text-gray-400 border">No exercises</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>

            <!-- Right: Existing Workout Table (2/3) -->
            <div class="w-2/3">
                <div class="bg-white divide-y rounded-lg shadow-sm overflow-x">
                    <x-bladewind::table compact="true" divider="thin" striped="true" celled="true" class="overflow-scroll">
                        <x-slot name="header">
                            <th>Exercise</th>
                            <th>Weight</th>
                            <th>Reps</th>
                            <th>Remarks</th>
                            <th></th>
                        </x-slot>
                        @foreach ($workout as $workouts)
                            <tr>
                                <td>{{ $workouts->exercise->name }}</td>
                                <td>{{ $workouts->weight }}</td>
                                <td>{{ $workouts->reps }}</td>
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
