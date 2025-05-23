<x-app-layout>
    <div class="px-8 overflow-x-auto">
        <x-slot name="header">
            <div class="flex justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __('Announcement') }}
                </h2>
                <x-bladewind::button color="gray" icon="plus"
                    onclick="window.location='{{ route('announcement.add') }}'">Add</x-bladewind::button>

            </div>
        </x-slot>


        <div class="mt-6 bg-white divide-y rounded-lg shadow-sm overflow-x">
            <x-bladewind::table compact="true" divider="thin" striped="true" celled="true" class="overflow-scroll"
                searchable="true">

                <x-slot name="header">
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th></th>
                </x-slot>
                @foreach ($announcement as $announcements)
                    <tr>
                        <td>{{ $announcements->title }}</td>
                        <td>{{ $announcements->description }}</td>
                        <td><img src="{{ asset($announcements->image) }}" alt="" height="200px" width="200px">
                        </td>

                        <td class ="grid">
                            <form method="POST" action="{{ route('announcement.destroy', $announcements->id) }}">
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
