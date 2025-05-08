<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <style>
        .slideshow-container-wrapper {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            padding: 20px;
            flex-wrap: wrap;
        }

        .slideshow-container {
            position: relative;
            margin-left: 0;
            margin-right: auto;
            width: 100%;
            /* Full width */
            max-width: 45vw;
            /* Max width is 50% of the viewport width */
            padding: 0 20px;
            /* Optional padding for spacing */
            box-sizing: border-box;
            transition: width 0.3s ease;
            /* Smooth transition for width */
        }

        .right-side {
            width: 45%;
            /* Right side div takes 40% width */
            padding: 20px;
            background: #f4f4f4;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 1024px) {
            .slideshow-container {
                width: 60%;
                /* Slightly larger on smaller tablets */
                max-width: none;
                /* Remove max-width on smaller screens */
            }

            .right-side {
                width: 35%;
                /* Adjust width on smaller tablets */
            }
        }

        @media (max-width: 768px) {
            .slideshow-container-wrapper {
                flex-direction: column;
                /* Stack vertically on mobile */
                gap: 20px;
            }

            .slideshow-container {
                width: 100%;
                /* Full width on mobile */
                padding: 0 10px;
            }

            .right-side {
                width: 100%;
                /* Full width on mobile */
            }
        }

        .mySlides {
            display: none;
            position: relative;
        }

        .mySlides img {
            border-radius: 8px;
        }

        .slide-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgb(99, 99, 99);
            color: #ffffff;
            padding: 20px 30px;
            border-radius: 8px;
            text-align: center;
            max-width: 80%;
        }

        .slide-content h2 {
            margin: 0 0 10px;
            font-size: 28px;
        }

        .slide-content p {
            margin: 0;
            font-size: 18px;
        }

        .prev,
        .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            padding: 16px;
            margin-top: -22px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            border-radius: 0 3px 3px 0;
            user-select: none;
            background-color: rgba(0, 0, 0, 0.5);
            transition: 0.6s ease;
        }

        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        .prev:hover,
        .next:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        .fade {
            animation: fade 1.5s ease-in-out;
        }

        @keyframes fade {
            from {
                opacity: .4
            }

            to {
                opacity: 1
            }
        }

        .dashboard-cards {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 30px;
        }

        .dashboard-cards .card {
            flex: 1 1 calc(25% - 20px);
            background: #ffffff;
            padding: 30px 20px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            text-align: center;
            border-left: 5px solid #4f46e5;
            /* Indigo accent */
            transition: transform 0.2s ease;
        }

        .dashboard-cards .card:hover {
            transform: translateY(-5px);
        }

        .dashboard-cards .card h4 {
            margin: 0 0 10px;
            font-size: 1.1rem;
            color: #333;
            font-weight: 600;
        }

        .dashboard-cards .metric {
            font-size: 1.8rem;
            font-weight: bold;
            color: #1e3a8a;
            /* Dark indigo */
        }

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .dashboard-cards .card {
                flex: 1 1 100%;
            }
        }
    </style>

    @php

        $users = App\Models\User::count();
        $walkin = App\Models\User::where('role', 'user')->where('type', 'Walk-In')->count();
        $members = App\Models\User::where('role', 'user')->where('type', 'Member')->count();

        $announcement = App\Models\Announcements::get();
    @endphp
    <div class="dashboard-cards">
        <div class="card">
            <h4>Users</h4>
            <p class="metric">{{ $users }}</p>
        </div>
        <div class="card">
            <h4>Walk-In</h4>
            <p class="metric">{{ $walkin }}</p>
        </div>
        <div class="card">
            <h4>Members</h4>
            <p class="metric">{{ $members }}</p>
        </div>
        <div class="card">
            <h4>Sales</h4>
            <p class="metric">1,240</p>
        </div>
    </div>


    <br>
    <div class="slideshow-container-wrapper">
        <div class="slideshow-container">

            @foreach ($announcement as $announcements)
                <div class="mySlides fade">
                    <img src="{{ asset($announcements->image) }}" style="width:100%">
                    <div class="slide-content">
                        <h2>{{ $announcements->title }}</h2>
                        <p>{{ $announcements->description }}</p>
                    </div>
                </div>
            @endforeach




            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>

        </div>
        <!-- Right Side Content -->
        <div class="right-side">
            <div id="calendar"></div>
        </div>
    </div>

    @push('scripts')
        <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core/main.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid/main.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid/main.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    slotMinTime: '8:00:00',
                    slotMaxTime: '19:00:00',


                });
                calendar.render();
                calendar.setOption('height', 'auto');
            });
        </script>
    @endpush

</x-app-layout>
<script>
    let slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function showSlides(n) {
        let i;
        const slides = document.getElementsByClassName("mySlides");

        if (n > slides.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = slides.length
        }

        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }

        slides[slideIndex - 1].style.display = "block";
    }
</script>
