<x-app-layout>
    <div class="px-8 overflow-x-auto">
        <x-slot name="header">
            <div class="flex justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __('Exercises You can do using ') }} {{ $equipments->name }}
                </h2>
                <x-bladewind::button color="gray" icon="plus"
                    onclick="window.location='{{ route('equipment.addexercises', $equipments->id) }}'">Add</x-bladewind::button>

            </div>
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
                        <td>
                            <form method="POST" action="{{ route('equipment.destroy2', $exercises->id) }}">
                                @csrf
                                @method('DELETE')
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
