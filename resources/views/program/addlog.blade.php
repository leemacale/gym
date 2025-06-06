<x-app-layout>
    <div class="flex items-center justify-center ">
        <div class="justify-center w-full px-6 py-4 mt-6 overflow-hidden bg-white shadow-md sm:max-w-md sm:rounded-lg">
            <x-slot name="header">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __('Add Exercise') }}
                </h2>

            </x-slot>
            <form method="POST" action="{{ route(name: 'workout2.store') }}">
                @csrf
                @method('PUT')


                <h1><b>{{ $exercise->name }}</b></h1>
                <hr><br>
                <!-- Name -->
                <div>
                    <input type="hidden" name="exercise_id" value="{{ $exercise->id }}">
                    <input type="hidden" name="program_id" value="{{ $program->id }}">

                    {{-- Weight/Resistance --}}
                    @if($exercise->category && strtolower($exercise->category->name) === 'cardio')
                        <x-input-label for="weight" :value="__('Resistance ')" />
                    @else
                        <x-input-label for="weight" :value="__('Weight (kg)')" />
                    @endif
                    <x-text-input id="weight" class="block w-full mt-1" type="number" name="weight"
                        :value="old('weight')" required autofocus autocomplete="weight" />
                    <x-input-error :messages="$errors->get('weight')" class="mt-2" />


                    {{-- Reps/Time --}}
                    @if($exercise->category && strtolower($exercise->category->name) === 'cardio')
                        <x-input-label for="reps" :value="__('Time (seconds)')" />
                    @else
                        <x-input-label for="reps" :value="__('Reps')" />
                    @endif
                    <x-text-input id="reps" class="block w-full mt-1" type="number" name="reps"
                        :value="old('reps')" required autofocus autocomplete="reps" />
                    <x-input-error :messages="$errors->get('reps')" class="mt-2" />


                    <x-input-label for="remarks" :value="__('Remarks')" />
                    <x-text-input id="remarks" class="block w-full mt-1" type="text" name="remarks"
                        :value="old('remarks')" required autofocus autocomplete="remarks" />
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
