<x-app-layout>
    <div class="px-8 overflow-x-auto">
        <x-slot name="header">
            <div class="flex justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __('Members') }}
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
                    <th>Membership Type</th>
                    <th>Approve</th>
                </x-slot>
                @foreach ($member as $members)
                    <tr>
                        <td>{{ $members->name }}</td>
                        <td>{{ $members->type }}</td>

                        <td>
                            <x-bladewind::button color="gray" icon="check" title="approve" class="w-full m-2"
                                onclick="window.location='{{ route('members.approve', $members->id) }}'">Member</x-bladewind::button>
  <x-bladewind::button color="gray" icon="x-mark" title="approve" class="w-full m-2"
                                onclick="window.location='{{ route('members.disapprove', $members->id) }}'">Disapproved</x-bladewind::button>
                        </td>
                    </tr>
                @endforeach
            </x-bladewind::table>


        </div>
    </div>
</x-app-layout>
