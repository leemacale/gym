<x-app-layout>
    <div class="flex items-center justify-center ">
        <div class="justify-center w-full px-6 py-4 mt-6 overflow-hidden bg-white shadow-md sm:max-w-md sm:rounded-lg">
            <x-slot name="header">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __('Edit Exercise') }}
                </h2>

            </x-slot>
            <form method="POST" action="{{ route('workout.update', $workouts->id) }}">
                @csrf
                @method('patch')


                <h1><b>{{ $workouts->exercise->name }}</b></h1>
                <hr><br>
                <!-- Name -->
                <div>
                    <input type="hidden" name="exercise_id" value="{{ $workouts->exercise->id }}">

                    <x-input-label for="weight" :value="__('Weight (kg)')" />
                    <x-text-input id="weight" class="block w-full mt-1" type="number" name="weight"
                        :value="old('weight', $workouts->weight)" required autofocus autocomplete="weight" />
                    <x-input-error :messages="$errors->get('weight')" class="mt-2" />

                    <x-input-label for="reps" :value="__('Reps')" />
                    <x-text-input id="reps" class="block w-full mt-1" type="number" name="reps"
                        :value="old('reps', $workouts->reps)" required autofocus autocomplete="reps" />
                    <x-input-error :messages="$errors->get('reps')" class="mt-2" />

                      <x-input-label for="remarks" :value="__('Remarks')" />
                    <x-text-input id="remarks" class="block w-full mt-1" type="text" name="remarks"
                        :value="old('remarks', $workouts->remarks)" required autofocus autocomplete="remarks" />
                    <x-input-error :messages="$errors->get('remarks')" class="mt-2" />
                </div>


                <div class="flex items-center justify-end mt-4">


                    <x-primary-button class="ms-4">
                        {{ __('Update') }}
                    </x-primary-button>
                    <x-secondary-button color="gray" 
                                        onclick="window.location='{{ route('workout.index') }}'">Cancel</x-secondary-button >
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
