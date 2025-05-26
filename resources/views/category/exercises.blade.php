<x-app-layout>
    <div class="px-8 overflow-x-auto">
        <x-slot name="header">
            <div class="flex justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __('Exercises for ') }} {{ $categories->name }}
                </h2>
              
            </div>
        </x-slot>


        <div class="mt-6 bg-white divide-y rounded-lg shadow-sm overflow-x">
            <x-bladewind::table compact="true" divider="thin" striped="true" celled="true" class="overflow-scroll"
                searchable="true">

                <x-slot name="header">
                    <th>Name</th>
                    <th>Category</th>
                    <th>Image</th>
      
                </x-slot>
                @foreach ($linkexercise as $exercises)

                @if ($exercises->exercise->category->name == $categories->name)
                    <tr>
                        <td>{{ $exercises->exercise->name }}</td>
                        <td>{{ $exercises->exercise->category->name }}</td>
                        <td><img src="{{ asset($exercises->exercise->image) }}" alt="" height="200px"
                                width="200px">
                        </td>
                       
                    </tr>
                    @endif
                @endforeach
            </x-bladewind::table>


        </div>
    </div>
</x-app-layout>
