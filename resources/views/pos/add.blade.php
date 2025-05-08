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
                    <x-input-label for="description" :value="__('Entry Description')" />
                    <x-text-input id="description" class="block w-full mt-1" type="text" name="description"
                        :value="old('description')" required autofocus autocomplete="description" />
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="amount" :value="__('Amount')" />
                    <x-text-input id="amount" class="block w-full mt-1" type="number" name="amount"
                        :value="old('amount')" required autofocus autocomplete="amount" />
                    <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="type" :value="__('Type')" />
                    <select name="type" id="type" class="block w-full mt-1">
                        <option value="Income">Income</option>
                        <option value="Expense">Expense</option>
                    </select>
                    <x-input-error :messages="$errors->get('type')" class="mt-2" />
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
