<x-app-layout>
    <div class="flex items-center justify-center h-screen">
        <div class="justify-center w-full px-6 py-4 mt-6 overflow-hidden bg-white shadow-md sm:max-w-md sm:rounded-lg">
            <x-slot name="header">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __('Add POS Entry') }}
                </h2>

            </x-slot>
            <form method="POST" action="{{ route(name: 'pos.store') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Name -->
                <div>
                    <x-input-label for="description" :value="__('Item')" />
                    <select name="description" class="block w-full mt-1">
                        @foreach ($inventory as $inventorys)
                            <option value="{{ $inventorys->id }}">{{ $inventorys->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="quantity" :value="__('Quantity')" />
                    <x-text-input id="quantity" class="block w-full mt-1" type="number" name="quantity"
                        :value="old('quantity')" required autofocus autocomplete="quantity" />
                    <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="amount" :value="__('Price')" />
                    <x-text-input id="amount" class="block w-full mt-1" type="number" name="amount"
                        :value="old('amount')" required autofocus autocomplete="amount" />
                    <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                </div>

                <div>
                 
                    <input type="hidden" name="type" value="Income" />
                </div>


                <div class="flex items-center justify-end mt-4">


                    <x-primary-button class="ms-4">
                        {{ __('Add') }}
                    </x-primary-button>
                    <x-secondary-button color="gray" 
                                        onclick="window.location='{{ route('pos.index') }}'">Cancel</x-secondary-button >
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
