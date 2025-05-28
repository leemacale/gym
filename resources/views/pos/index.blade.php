<x-app-layout>
    <div class="px-8 overflow-x-auto">
        <x-slot name="header">
            <div class="flex justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __('POS') }}
                </h2>
                <x-bladewind::button color="gray" icon="plus"
                    onclick="window.location='{{ route('pos.add') }}'">Add</x-bladewind::button>

            </div>
        </x-slot>


        <div class="mt-6 bg-white divide-y rounded-lg shadow-sm overflow-x">
            <x-bladewind::table compact="true" divider="thin" striped="true" celled="true" class="overflow-scroll"
                searchable="true">

                <x-slot name="header">
                    <th>Description</th>
                    <th>Date</th>
                    <th>Amount</th>
 
                    <th></th>
                </x-slot>
                @foreach ($pos as $pos)
                    <tr>
                        <td>{{ $pos->description }}</td>
                        <td>{{ $pos->created_at }}</td>
                        <td>{{ $pos->amount }}</td>
        



                        <td>
                            <form method="POST" action="{{ route('pos.destroy', $pos->id) }}">
                                @csrf
                                @method('DELETE')

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
