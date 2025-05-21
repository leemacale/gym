<x-app-layout>
    <div class="px-8 overflow-x-auto">
        <x-slot name="header">
            <div class="flex justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __('Inventory') }}
                </h2>
                <x-bladewind::button color="gray" icon="plus"
                    onclick="window.location='{{ route('inventory.add') }}'">Add</x-bladewind::button>

            </div>
        </x-slot>


        <div class="mt-6 bg-white divide-y rounded-lg shadow-sm overflow-x">
            <x-bladewind::table compact="true" divider="thin" striped="true" celled="true" class="overflow-scroll"
                searchable="true">

                <x-slot name="header">
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Size</th>
                    <th></th>
                </x-slot>
                @foreach ($inventory as $inventories)
                    <tr>
                        <td>{{ $inventories->name }}</td>
                        <td>{{ $inventories->quantity }}</td>
                        <td>{{ $inventories->size }}</td>
                        <td>
                            <form method="POST" action="{{ route('inventory.destroy', $inventories->id) }}">
                                @csrf
                                @method('DELETE')
                                <x-bladewind::button color="gray" icon="pencil-square" title="edit" class="w-full m-2"
                                    onclick="window.location='{{ route('inventory.edit', $inventories->id) }}'">EDIT</x-bladewind::button>
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
