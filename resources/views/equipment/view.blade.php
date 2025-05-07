<x-app-layout>
    <div class="flex items-center justify-center ">
        <div class="justify-center w-full px-6 py-4 mt-6 overflow-hidden bg-white ">
            <x-slot name="header">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __('Exercises You can do using ') }} {{ $equipments->name }}
                </h2>

                Description: {{ $equipments->description }}
                <img src="{{ asset($equipments->image) }}" alt="{{ $equipments->image }}" height="300px" width="300px">

            </x-slot>

            <div class="mt-6 bg-white divide-y rounded-lg shadow-sm overflow-x">
                <x-bladewind::table compact="true" divider="thin" striped="true" celled="true" class="overflow-scroll"
                    searchable="true">

                    <x-slot name="header">
                        <th>Name</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th></th>

                    </x-slot>
                    @foreach ($linkexercise as $exercises)
                        <tr>
                            <td>{{ $exercises->exercise->name }}</td>
                            <td>{{ $exercises->exercise->category->name }}</td>
                            <td><img src="{{ asset($exercises->exercise->image) }}" alt="" height="200px"
                                    width="200px">
                            </td>
                            <td> <x-bladewind::button color="gray" icon="plus" title="add"
                                    onclick="window.location='{{ route('workout.addlog', $exercises->exercise->id) }}'">Add</x-bladewind::button>
                            </td>

                        </tr>
                    @endforeach
                </x-bladewind::table>


            </div>
        </div>
    </div>
</x-app-layout>
