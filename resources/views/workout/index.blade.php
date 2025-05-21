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
                <x-bladewind::button color="gray" onclick="window.location='{{ route('calendar.index') }}'">Workout
                    Calendar</x-bladewind::button>

                <x-bladewind::button color="gray" icon="plus"
                    onclick="window.location='{{ route('workout.add') }}'">Add</x-bladewind::button>

            </div>
        </x-slot>


        <div class="mt-6 bg-white divide-y rounded-lg shadow-sm overflow-x">
            <x-bladewind::table compact="true" divider="thin" striped="true" celled="true" class="overflow-scroll">

                <x-slot name="header">
                    <th>Exercise</th>
                    <th>Weight</th>
                    <th>Reps</th>
                    <th></th>
                </x-slot>
                @foreach ($workout as $workouts)
                    <tr>
                        <td>{{ $workouts->exercise->name }}</td>
                        <td>{{ $workouts->weight }}</td>
                        <td>{{ $workouts->reps }}</td>
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
                <x-text-input id="old" class="mt-1" type="hidden" name="old"
                    value="{{ $date }}" />
                <x-text-input id="date" class="mt-1" type="date" name="date" />
                <x-bladewind::button color="gray" icon="copy" title="delete"
                    can_submit="true">Copy</x-bladewind::button>
            </form>
        @endif
    </div>
</x-app-layout>
