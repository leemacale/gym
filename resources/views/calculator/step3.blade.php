<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('TDEE Calculator') }}-> Step 3: Workout Recommendation
        </h2>
    </x-slot>

    <h1><b> Push-Pull-Legs Workout Split </b></h1>
    <div class="cards-wrapper">
        <div class="card">
            <h2>Day 1 – Push</h2>
            <strong>Warm-up:</strong>
            <ul class="exercise-list">
                <li>5–10 min light cardio</li>
                <li>Shoulder mobility drills or band work</li>
            </ul>
            <strong>Workout:</strong>
            <ul class="exercise-list">
                <li>Barbell Bench Press – 4x6–8</li>
                <li>Incline Dumbbell Press – 3x8–10</li>
                <li>Standing Overhead Press – 3x6–8</li>
                <li>Lateral Raises – 3x12–15</li>
                <li>Cable Triceps Pushdowns – 3x10–12</li>
                <li>Overhead DB Triceps Extension – 2x12–15</li>
            </ul>
            <button class="add-button" onclick="addToWorkout('Push')">Add to Workout</button>
            <div class="message" id="msg-Push">Added Push workout!</div>
        </div>

        <div class="card">
            <h2>Day 2 – Pull</h2>
            <strong>Warm-up:</strong>
            <ul class="exercise-list">
                <li>5–10 min rowing or light cardio</li>
                <li>Shoulder activation/mobility</li>
            </ul>
            <strong>Workout:</strong>
            <ul class="exercise-list">
                <li>Deadlifts or Rack Pulls – 4x5–6</li>
                <li>Pull-Ups or Lat Pulldown – 3x8–10</li>
                <li>Bent Over Barbell Rows – 3x8–10</li>
                <li>Seated Cable Rows – 3x10–12</li>
                <li>Face Pulls – 3x15–20</li>
                <li>EZ Bar Curls or DB Curls – 3x10–12</li>
            </ul>
            <button class="add-button" onclick="addToWorkout('Pull')">Add to Workout</button>
            <div class="message" id="msg-Pull">Added Pull workout!</div>
        </div>

        <div class="card">
            <h2>Day 3 – Legs</h2>
            <strong>Warm-up:</strong>
            <ul class="exercise-list">
                <li>5–10 min cycling or light jog</li>
                <li>Dynamic leg stretches (leg swings, lunges)</li>
            </ul>
            <strong>Workout:</strong>
            <ul class="exercise-list">
                <li>Barbell Back Squats – 4x6–8</li>
                <li>Romanian Deadlifts – 3x8–10</li>
                <li>Leg Press – 3x10–12</li>
                <li>Walking Lunges – 2x12/leg</li>
                <li>Leg Curls (Machine) – 3x12–15</li>
                <li>Standing Calf Raises – 4x15–20</li>
            </ul>
            <button class="add-button" onclick="addToWorkout('Legs')">Add to Workout</button>
            <div class="message" id="msg-Legs">Added Legs workout!</div>
        </div>
    </div>

    <style>
        h1 {
            text-align: center;
            margin: 30px 0;
            font-size: larger;
        }

        /* Flex container for cards */
        .cards-wrapper {
            display: flex;
            flex-direction: column;
            gap: 20px;
            align-items: center;
            /* Center horizontally on mobile */
            justify-content: center;
            /* Center vertically (optional) */
            padding: 20px;
            max-width: 1200px;
            /* Limit max width on large screens */
            margin: 0 auto;
            /* Center container on large screens */
        }

        @media (min-width: 768px) {
            .cards-wrapper {
                flex-direction: row;
                justify-content: center;
                align-items: stretch;
                /* Stretch cards on large screens to equal height */
            }
        }

        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 350px;
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            flex: 1;
        }

        .card h2 {
            margin-top: 0;
            color: #333;
        }

        .exercise-list {
            list-style: none;
            padding-left: 0;
        }

        .exercise-list li {
            position: relative;
            padding-left: 20px;
            margin-bottom: 10px;
        }

        .exercise-list li::before {
            content: '';
            position: absolute;
            top: 7px;
            left: 0;
            width: 8px;
            height: 8px;
            background-color: #007BFF;
            border-radius: 50%;
        }

        .add-button {
            margin-top: 15px;
            padding: 10px 15px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .add-button:hover {
            background-color: #0056b3;
        }

        .message {
            color: green;
            font-size: 14px;
            margin-top: 10px;
            display: none;
        }
    </style>
</x-app-layout>
