<x-app-layout>
    <div class="flex items-center justify-center h-screen">
        <div class="justify-center w-full px-6 py-4 mt-6 overflow-hidden bg-white shadow-md sm:max-w-md sm:rounded-lg">
            <x-slot name="header">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __('Equipment Edit') }}
                </h2>

            </x-slot>
            <form method="POST" action="{{ route('equipment.update', $equipments) }}">
                @csrf
                @method('patch')
                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name', $equipments->name)"
                        required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                 <div>
                    <x-input-label for="description" :value="__('Description')" />
                    <x-text-input id="description" class="block w-full mt-1" type="text" name="description"
                        :value="old('description', $equipments->description)" required autofocus autocomplete="description" />
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="quantity" :value="__('Quantity')" />
                    <x-text-input id="quantity" class="block w-full mt-1" type="number" name="quantity"
                        :value="old('quantity', $equipments->quantity)" required autofocus autocomplete="quantity" />
                    <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                </div>

                   

                <div>
                    <x-input-label for="image" :value="__('Exercise Image')" />
                    <x-text-input id="image" class="block w-full mt-1" type="file" name="image"
                        :value="old('image')" required autofocus autocomplete="image" />
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>


                <div class="flex items-center justify-end mt-4">


                    <x-primary-button class="ms-4">
                        {{ __('Update') }}
                    </x-primary-button>

                    <x-secondary-button color="gray" 
                                        onclick="window.location='{{ route('equipment.index') }}'">Cancel</x-secondary-button >
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
