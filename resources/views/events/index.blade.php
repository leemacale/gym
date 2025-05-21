<x-app-layout>
    <div class="px-8 overflow-x-auto">
        <x-slot name="header">
            <div class="flex justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __('Events') }}
                </h2>
                <x-bladewind::button color="gray" icon="plus"
                    onclick="window.location='{{ route('events.add') }}'">Add</x-bladewind::button>

            </div>
        </x-slot>


        <div class="mt-6 bg-white divide-y rounded-lg shadow-sm overflow-x">
            <x-bladewind::table compact="true" divider="thin" striped="true" celled="true" class="overflow-scroll"
                searchable="true">

                <x-slot name="header">
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Description</th>
                    <th></th>
                </x-slot>
                @foreach ($event as $events)
                    <tr>
                        <td>{{ $events->start_date }}</td>
                        <td>{{ $events->end_date }}</td>
                        <td>{{ $events->comment }}</td>


                        <td>
                            <form method="POST" action="{{ route('events.destroy', $events->id) }}">
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
