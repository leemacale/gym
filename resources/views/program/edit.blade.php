<x-app-layout>
    <div class="px-8 overflow-x-auto">
        <x-slot name="header">
            <div class="flex justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                   
                        {{ 'Customize Program ' . $program->name   }}
                  

                </h2>
         
                <x-bladewind::button color="gray" icon="plus"
                    onclick="window.location='{{ route('workout2.add', $program->id) }}'">Add</x-bladewind::button>

            </div>
        </x-slot>


        <div class="mt-6 bg-white divide-y rounded-lg shadow-sm overflow-x">
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
                            <form method="POST" action="{{ route('workout2.destroy', [$workouts->id, $program->id]) }}">
                                @csrf
                                @method('DELETE')

                                <x-bladewind::button color="gray" icon="pencil-square" title="edit" class="w-full m-2"
                                    onclick="window.location='{{ route('workout2.edit', [$workouts->id, $program->id]) }}'">EDIT</x-bladewind::button>
                                <x-bladewind::button color="gray" icon="trash" title="delete" class="w-full m-2"
                                    can_submit="true">DELETE</x-bladewind::button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </x-bladewind::table>


        </div>

  
    </div>
</x-app-layout>
