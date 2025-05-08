<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('TDEE Calculator') }}-> Step 1: Basic Information
        </h2>
    </x-slot>


    <div class="flex items-center justify-center ">

        <div class="justify-center w-full px-6 py-4 mt-6 overflow-hidden bg-white shadow-md sm:max-w-md sm:rounded-lg">


            <div>
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
                <x-text-input id="age" class="block w-full mt-1" type="number" name="age" :value="old('age')"
                    required autofocus autocomplete="age" />
                <x-input-error :messages="$errors->get('age')" class="mt-2" />
            </div>
            <br>
            <div>
                <x-input-label for="height" :value="__('Height (cm)')" />
                <x-text-input id="height" class="block w-full mt-1" type="number" name="height" :value="old('height')"
                    required autofocus autocomplete="height" />
                <x-input-error :messages="$errors->get('height')" class="mt-2" />
            </div>
            <br>
            <div>
                <x-input-label for="weight" :value="__('Weight (kg)')" />
                <x-text-input id="weight" class="block w-full mt-1" type="number" name="weight" :value="old('weight')"
                    required autofocus autocomplete="weight" />
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


                <x-primary-button class="ms-4" onclick="calculate();">
                    {{ __('Calculate') }}
                </x-primary-button>
            </div>

            <br>
            <hr>
            <br>

            Your BMI is : <span id="bmi"></span><br>
            You are: <span id="bmi2"></span><br><br>
            You're Total Daily Energy Expendeture(TDEE) is: <span id="tdee"></span><br>
            To Lose Weight you should Consume: <span id="tdee2"></span><br>
            To Gain Weight you should Consume: <span id="tdee3"></span><br>
            <br><br>
            <hr>
            This is in consideration of Lose/Gain of 1 lb per Week as recommended by WHO and CDC
        </div>


    </div>
    <script>
        function calculate() {
            var age = document.getElementById('age').value;
            var height = document.getElementById('height').value;
            var weight = document.getElementById('weight').value;
            var activity = document.getElementById('activity').value;

            var bmr = 0;

            bmr = 10 * weight + height * 6.25 - 5 * age + 5;
            tdee = bmr * activity;
            bmi = weight / ((height / 100) * (height / 100));
            console.log(bmi);
            console.log(bmr);
            console.log(tdee);

            document.getElementById('bmi').innerHTML = bmi.toFixed(2);

            var bm = bmi.toFixed(2);
            var act = '';
            if (bm <= 18.4) {
                act = "Underweight";
            } else if (bm >= 18.5 && bm <= 24.9) {
                act = "Normal";
            } else if (bm >= 25 && bm <= 39.9) {
                act = "Overweight";
            } else if (bm > 40) {
                act = "Obese";
            }

            document.getElementById('bmi2').innerHTML = bm;
            document.getElementById('tdee').innerHTML = tdee + " cals";
            document.getElementById('tdee2').innerHTML = (tdee - 500) + " cals";
            document.getElementById('tdee3').innerHTML = (tdee + 500) + " cals";


        }
    </script>
</x-app-layout>
