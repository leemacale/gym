<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('TDEE Calculator') }}-> Step 2: BMI Result
        </h2>
    </x-slot>


    <div class="flex items-center justify-center ">



        <div class="justify-center w-full px-6 py-4 mt-6 overflow-hidden bg-white shadow-md sm:max-w-md sm:rounded-lg">
            <form method="POST" action="{{ route(name: 'calculator.store2') }}">
                @csrf
                @method('PUT')

                <input id="user_id" class="block w-full mt-1" type="hidden" name="user_id" value="{{ $userprof->id }}" />
                <input id="gender" class="block w-full mt-1" type="hidden" name="gender"
                    value="{{ $userprof->gender }}" />
                <br>
                <input id="age" class="block w-full mt-1" type="hidden" name="age"
                    value="{{ $userprof->age }}" />
                <br>
                <input id="height" class="block w-full mt-1" type="hidden" name="height"
                    value="{{ $userprof->height }}" />
                <br>
                <input id="weight" class="block w-full mt-1" type="hidden" name="weight"
                    value="{{ $userprof->weight }}" />
                <br>
                <input id="activity" class="block w-full mt-1" type="hidden" name="activity"
                    value="{{ $userprof->activity }}" />

                     <input id="tdee" class="block w-full mt-1" type="hidden" name="tdee"
                     />

                <img src="{{ asset('assets/meter.png') }}" alt="">

                <br>

                <b>Your BMI is : <span id="bmi"></span><br></b>
                <b>You are: <span id="bmi2"></span><br><br></b>
                <b>You're Total Daily Energy Expendeture(TDEE) is: <span id="tdee"></span><br></b>


                <hr>

                <br>
                What is your Goal?
                <br>
                <select name="goaltype"class="block w-full mt-1" id="goaltype" onchange="selection();">
                    <option value="" selected></option>
                    <option value="Lose Weight">Lose Weight</option>
                    <option value="Gain Weight">Gain Weight</option>
                </select>
                <br>

                <div id="selection" class="hidden">
                    <div>
                        <x-input-label for="goal" :value="__('Goal Weight')" />
                        <x-text-input id="goal" class="block w-full mt-1" type="number" name="goal"
                            :value="old('goal')" required autofocus autocomplete="goal" />
                        <x-input-error :messages="$errors->get('goal')" class="mt-2" />
                    </div>
                    <br>

                    <div>
                        <x-input-label for="date" :value="__('Date of Goal')" />
                        <x-text-input id="date" class="block w-full mt-1" type="date" name="date"
                            :value="old('date')" required autofocus autocomplete="goal" />
                        <x-input-error :messages="$errors->get('date')" class="mt-2" />
                    </div>
                    <br>
                    <x-primary-button class="ms-4">
                        {{ __('Confirm') }}
                    </x-primary-button>
                </div>
            </form>
        </div>


    </div>
    <script>
        function selection() {

            document.getElementById('selection').style.display = 'block';
        }



        calculate();

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
            document.getElementById('tdee').value = tdee;

            var bm = bmi.toFixed(2);
            var act = '';
            if (bm <= 18.4) {
                act = "Underweight";
            } else if (bm >= 18.5 && bm <= 24.9) {
                act = "Normal";
            } else if (bm >= 25 && bm <= 29.9) {
                act = "Overweight";
            } else if (bm >= 30 && bm <= 34.9) {
                act = "Obese";
            } else if (bm >= 35) {
                act = "Extremely Obese";
            }

            document.getElementById('bmi2').innerHTML = act;
            document.getElementById('tdee').innerHTML = tdee + " cals";
            document.getElementById('tdee2').innerHTML = (tdee - 500) + " cals";
            document.getElementById('tdee3').innerHTML = (tdee + 500) + " cals";


        }
    </script>
</x-app-layout>
