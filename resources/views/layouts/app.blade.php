<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Style -->
        <style>
            body {
                font-family: 'Comic Sans MS', cursive, sans-serif;
                background-color: #EECEB9;
                margin: 0;
                padding: 0;
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script type="text/javascript" src="/resources/js/1st_grade/script.js"></script>
        <script type="text/javascript" src="/resources/js/2nd_grade/script.js"></script>
        <script type="text/javascript" src="/resources/js/3rd_grade/script.js"></script>
    </head>
    <body>
        <div class="min-h-screen">
            <div>
                <a href="{{ route('dashboard') }}">Mentari</a>
                <p>{{ Auth::user()->name }}</p>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Quit</button>
                </form>
            </div>
            <main>
                {{ $slot }}
            </main>
        </div>

        <script>
            let startTime;

            function startGame() {
                startTime = new Date();
            }

            function endGame() {
                const endTime = new Date();
                const timeDiff = endTime - startTime;

                const timeInSeconds = Math.floor(timeDiff / 1000);

                fetch('/save-game-time', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        time: timeInSeconds
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Game time saved:', data);
                    window.location.href = '{{ route('leaderboard') }}';
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        </script>
    </body>
</html>
