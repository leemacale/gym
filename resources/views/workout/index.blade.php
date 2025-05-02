<x-app-layout>
    <div class="px-8 overflow-x-auto">
        <x-slot name="header">
            <div class="flex justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __('Todays Workout') }}
                </h2>
                <x-bladewind::button color="gray"
                    onclick="window.location='{{ route('calendar.index') }}'">Calendar</x-bladewind::button>

                <x-bladewind::button color="gray" icon="plus"
                    onclick="window.location='{{ route('workout.add') }}'">Add</x-bladewind::button>

            </div>
        </x-slot>


        <div class="mt-6 bg-white divide-y rounded-lg shadow-sm overflow-x">
            <x-bladewind::table compact="true" divider="thin" striped="true" celled="true" class="overflow-scroll">

                <x-slot name="header">
                    <th>Exercise</th>
                    <th>Reps</th>
                    <th></th>
                </x-slot>
                @foreach ($workout as $workouts)
                    <tr>
                        <td>{{ $workouts->exercise->name }}</td>
                        <td>{{ $workouts->reps }}</td>
                        <td>
                            <form method="POST" action="{{ route('workout.destroy', $workouts->id) }}">
                                @csrf
                                @method('DELETE')
                                <!--
                                <x-bladewind::button color="gray" icon="pencil-square" title="edit"
                                    onclick="window.location='{{ route('workout.edit', $workouts->id) }}'">EDIT</x-bladewind::button> -->
                                <x-bladewind::button color="gray" icon="trash" title="delete"
                                    can_submit="true">DELETE</x-bladewind::button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </x-bladewind::table>


        </div>
    </div>
</x-app-layout>
