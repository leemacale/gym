<x-app-layout>
    <div class="px-8 overflow-x-auto">
        <x-slot name="header">
            <div class="flex justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __('Equipment') }}
                </h2>
                <x-bladewind::button color="gray" icon="plus"
                    onclick="window.location='{{ route('equipment.add') }}'">Add</x-bladewind::button>

            </div>
        </x-slot>


        <div class="mt-6 bg-white divide-y rounded-lg shadow-sm overflow-x">
            <x-bladewind::table compact="true" divider="thin" striped="true" celled="true" class="overflow-scroll"
                searchable="true">

                <x-slot name="header">
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th></th>
                </x-slot>
                @foreach ($equipment as $equipments)
                    <tr>
                        <td>{{ $equipments->name }}</td>
                        <td>{{ $equipments->quantity }}</td>
                        <td>{{ $equipments->description }}</td>
                        <td><img src="{{ asset($equipments->image) }}" alt="" height="200px" width="200px">
                        </td>
                        <td>
                            <form method="POST" action="{{ route('equipment.destroy', $equipments->id) }}">
                                @csrf
                                @method('DELETE')
                                <x-bladewind::button color="gray" icon="pencil-square" title="edit"
                                    onclick="window.location='{{ route('equipment.edit', $equipments->id) }}'">EDIT</x-bladewind::button>
                                <x-bladewind::button color="gray" icon="trash" title="delete"
                                    can_submit="true">DELETE</x-bladewind::button>

                                <x-bladewind::button color="gray" icon="" title="generate"
                                    onclick="window.location='{{ route('equipment.qr', $equipments->id) }}'">GENERATE
                                    QR</x-bladewind::button>

                                <x-bladewind::button color="gray" icon="" title="exercises"
                                    onclick="window.location='{{ route('equipment.exercises', $equipments->id) }}'">EXERCISES</x-bladewind::button>
                        </td>
                    </tr>
                @endforeach
            </x-bladewind::table>


        </div>
    </div>
</x-app-layout>
