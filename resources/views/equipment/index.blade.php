<x-app-layout>
    <div class="px-8 overflow-x-auto">
        <x-slot name="header">
            <div class="flex justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __('Equipment') }}
                </h2>
                @if (Auth::user()->role == 'admin')
                    <x-bladewind::button color="gray" icon="plus"
                        onclick="window.location='{{ route('equipment.add') }}'">Add</x-bladewind::button>
                @endif
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
                                @if (Auth::user()->role == 'admin')
                                    <x-bladewind::button color="gray" icon="pencil-square" title="edit" class="w-full m-2"
                                        onclick="window.location='{{ route('equipment.edit', $equipments->id) }}'">EDIT</x-bladewind::button>
                                    <x-bladewind::button color="gray" icon="trash" title="delete" class="w-full m-2"
                                        can_submit="true">DELETE</x-bladewind::button>

                                    <x-bladewind::button color="gray" icon="" title="generate" class="w-full m-2"
                                        onclick="window.location='{{ route('equipment.qr', $equipments->id) }}'">GENERATE
                                        QR</x-bladewind::button>
                                @endif

                                <x-bladewind::button color="gray" icon="" title="exercises" class="w-full m-2"
                                    onclick="window.location='{{ route('equipment.exercises', $equipments->id) }}'">EXERCISES</x-bladewind::button>
</form>
                        </td>
                    </tr>
                @endforeach
            </x-bladewind::table>


        </div>
    </div>
</x-app-layout>
