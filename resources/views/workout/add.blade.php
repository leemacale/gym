<x-app-layout>
    <div class="px-8 overflow-x-auto">
        <div class="">
            <x-slot name="header">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __('Add Exercise') }}
                </h2>

            </x-slot>
            <x-bladewind::table compact="true" divider="thin" striped="true" celled="true" class="overflow-scroll"
                searchable="true">

                <x-slot name="header">
                    <th>Name</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Equipment</th>

                    <th></th>
                </x-slot>
                @foreach ($exercise as $exercises)
                    <tr>
                        <td>{{ $exercises->name }}</td>
                        <td>{{ $exercises->category->name }}</td>
                        <td><img src="{{ $exercises->image }}" alt="" height="200px" width="200px"></td>
                        <td>
                            @foreach ($exercises->equipment as $equipment)
                                <a
                                    href="/equipment/{{ $equipment->equipment->id }}/views">{{ $equipment->equipment->name }}</a>,
                            @endforeach
                        </td>
                        <td>

                            <x-bladewind::button color="gray" icon="plus" title="add"
                                onclick="window.location='{{ route('workout.addlog', $exercises->id) }}'">Add</x-bladewind::button>


                        </td>
                    </tr>
                @endforeach
            </x-bladewind::table>

        </div>
    </div>
</x-app-layout>
