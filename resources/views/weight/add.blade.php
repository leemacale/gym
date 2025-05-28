<x-app-layout>
    <div class="flex items-center justify-center h-screen">
        <div class="justify-center w-full px-6 py-4 mt-6 overflow-hidden bg-white shadow-md sm:max-w-md sm:rounded-lg">
            <x-slot name="header">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __('Add Weight Progress') }}
                </h2>

            </x-slot>
            <form method="POST" action="{{ route(name: 'weight.store') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Name -->
                <div>
                    <x-input-label for="weight" :value="__('Weight in kg')" />
                    <x-text-input id="weight" class="block w-full mt-1" type="number" name="weight" step=".01" :value="old('weight')"
                        required autofocus autocomplete="weight" />
                    <x-input-error :messages="$errors->get('weight')" class="mt-2" />
                </div>
         

 <!-- Remarks -->
                <div>
                    <x-input-label for="remarks" :value="__('Remarks')" />
                    <x-text-input id="remarks" class="block w-full mt-1" type="text" name="remarks" :value="old('remarks')"
                         autofocus autocomplete="remarks" />
                    <x-input-error :messages="$errors->get('remarks')" class="mt-2" />
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
