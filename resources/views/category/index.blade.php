<x-app-layout>
    <div class="px-8 overflow-x-auto">
        <x-slot name="header">
            <div class="flex justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __('Category') }}
                </h2>
                <x-bladewind::button color="gray" icon="plus"
                    onclick="window.location='{{ route('category.add') }}'">Add</x-bladewind::button>

            </div>
        </x-slot>


        <div class="mt-6 bg-white divide-y rounded-lg shadow-sm overflow-x">
            <x-bladewind::table compact="true" divider="thin" striped="true" celled="true" class="overflow-scroll"
                searchable="true">

                <x-slot name="header">
                    <th>Name</th>
                    <th></th>
                </x-slot>
                @foreach ($category as $categories)
                    <tr>
                        <td>{{ $categories->name }}</td>
                        <td>
                            <form method="POST" action="{{ route('category.destroy', $categories->id) }}">
                                @csrf
                                @method('DELETE')
                                <x-bladewind::button color="gray" icon="pencil-square" title="edit"
                                    onclick="window.location='{{ route('category.edit', $categories->id) }}'">EDIT</x-bladewind::button>
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
