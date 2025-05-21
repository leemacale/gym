<x-app-layout>
    <div class="px-8 overflow-x-auto">
        <x-slot name="header">
            <div class="flex justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __('Add exercises to ') }} {{ $equipments->name }}
                </h2>
                <x-bladewind::button color="gray" icon="plus"
                    onclick="window.location='{{ route('exercise.add') }}'">Add</x-bladewind::button>

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
                @foreach ($exercise as $exercises)
                    <tr>
                        <td>{{ $exercises->name }}</td>
                        <td>{{ $exercises->category->name }}</td>
                        <td><img src="{{ asset($exercises->image) }}" alt="" height="200px" width="200px">
                        </td>
                        <td>
                            <form method="POST" action="{{ route('equipment.storeexercise') }}">
                                @csrf
                                @method('PUT')

                                <input type="hidden" name="exercise_id" value="{{ $exercises->id }}">
                                <input type="hidden" name="equipment_id" value="{{ $equipments->id }}">
                                <x-bladewind::button color="gray" icon="plus" title="add" class="w-full m-2"
                                    can_submit="true">ADD</x-bladewind::button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </x-bladewind::table>


        </div>
    </div>
</x-app-layout>
