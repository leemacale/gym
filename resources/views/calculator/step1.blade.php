<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('TDEE Calculator') }}-> Step 1: Basic Information
        </h2>
    </x-slot>


    <div class="flex items-center justify-center ">

        <div class="justify-center w-full px-6 py-4 mt-6 overflow-hidden bg-white shadow-md sm:max-w-md sm:rounded-lg">
            <form method="POST" action="{{ route(name: 'calculator.store') }}">
                @csrf
                @method('PUT')


                <div>
                    <input id="user_id" class="block w-full mt-1" type="hidden" name="user_id"
                        value="{{ Auth::user()->id }}" />

                    <x-input-label for="gender" :value="__('Gender')" />
                    <select name="gender" id="gender" class="block w-full mt-1" autofocus>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                </div>
                <br>
                <div>
                    <x-input-label for="age" :value="__('Age')" />
                    <x-text-input id="age" class="block w-full mt-1" type="number" name="age"
                        :value="old('age')" required autofocus autocomplete="age" />
                    <x-input-error :messages="$errors->get('age')" class="mt-2" />
                </div>
                <br>
                <div>
                    <x-input-label for="height" :value="__('Height (cm)')" />
                    <x-text-input id="height" class="block w-full mt-1" type="number" name="height"
                        :value="old('height')" required autofocus autocomplete="height" />
                    <x-input-error :messages="$errors->get('height')" class="mt-2" />
                </div>
                <br>
                <div>
                    <x-input-label for="weight" :value="__('Weight (kg)')" />
                    <x-text-input id="weight" class="block w-full mt-1" type="number" name="weight"
                        :value="old('weight')" required autofocus autocomplete="weight" />
                    <x-input-error :messages="$errors->get('weight')" class="mt-2" />
                </div>
                <br>
                <div>
                    <x-input-label for="activity" :value="__('Activity Factor')" />
                    <select name="activity" id="activity" class="block w-full mt-1">
                        <option value="1.2">Sedentary(Office Job)</option>
                        <option value="1.375">Lightly Active(1-2 days/Week Exercise)</option>
                        <option value="1.55">Moderately Active(3-5 days/Week Exercise)</option>
                        <option value="1.725">Very Active(6-7 days/Week Exercise)</option>
                        <option value="1.9">Super Active(2x per Day)</option>
                    </select>
                    <x-input-error :messages="$errors->get('activity')" class="mt-2" />
                </div>



                <div class="flex items-center justify-end mt-4">


                    <x-primary-button class="ms-4">
                        {{ __('Calculate') }}
                    </x-primary-button>
                </div>

                <br>
                <hr>
                <br>

            </form>
        </div>


    </div>

</x-app-layout>
