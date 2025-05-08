<x-app-layout>
    <div class="px-8 overflow-x-auto">
        <x-slot name="header">
            <div class="flex justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __('Exercise') }}
                </h2>
                @if (Auth::user()->role == 'admin')
                    <x-bladewind::button color="gray" icon="plus"
                        onclick="window.location='{{ route('exercise.add') }}'">Add</x-bladewind::button>
                @endif
            </div>
        </x-slot>


        <div class="mt-6 bg-white divide-y rounded-lg shadow-sm overflow-x">
            <x-bladewind::table compact="true" divider="thin" striped="true" celled="true" class="overflow-scroll"
                searchable="true">

                <x-slot name="header">
                    <th>Name</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Equipments</th>
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
                            <form method="POST" action="{{ route('exercise.destroy', $exercises->id) }}">
                                @csrf
                                @method('DELETE')
                                @if (Auth::user()->role == 'admin')
                                    <x-bladewind::button color="gray" icon="pencil-square" title="edit"
                                        onclick="window.location='{{ route('exercise.edit', $exercises->id) }}'">EDIT</x-bladewind::button>
                                    <x-bladewind::button color="gray" icon="trash" title="delete"
                                        can_submit="true">DELETE</x-bladewind::button>
                                @endif
                            </form>
                        </td>
                    </tr>
                @endforeach
            </x-bladewind::table>


        </div>
    </div>
</x-app-layout>
