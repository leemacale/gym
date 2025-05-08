<x-app-layout>
    <div class="flex items-center justify-center h-screen">
        <div class="justify-center w-full px-6 py-4 mt-6 overflow-hidden bg-white shadow-md sm:max-w-md sm:rounded-lg">
            <x-slot name="header">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __('Add Event') }}
                </h2>

            </x-slot>
            <form method="POST" action="{{ route(name: 'events.store') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Name -->
                <div>
                    <x-input-label for="comment" :value="__('Event Description')" />
                    <x-text-input id="comment" class="block w-full mt-1" type="text" name="comment" :value="old('comment')"
                        required autofocus autocomplete="comment" />
                    <x-input-error :messages="$errors->get('comment')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="start_date" :value="__('Start Date')" />
                    <x-text-input id="start_date" class="block w-full mt-1" type="date" name="start_date"
                        :value="old('start_date')" required autofocus autocomplete="start_date" />
                    <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="end_date" :value="__('End Date')" />
                    <x-text-input id="end_date" class="block w-full mt-1" type="date" name="end_date"
                        :value="old('end_date')" required autofocus autocomplete="end_date" />
                    <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                </div>


                <div class="flex items-center justify-end mt-4">


                    <x-primary-button class="ms-4">
                        {{ __('Add') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
