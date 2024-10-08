<x-app-layout>
    <div class="py-12">
        <div>
            <p>3/7</p>
            <p>Checklist everything you hear</p>
            <div>
                <p>Poin</p>
                <p id="current-score">{{ Auth::user()->score }}</p>
            </div>
        </div>
        <div>
            <div>
                <img src="/img/checklist/1.png" width="200" alt="">
                <div>
                    <button>Play</button>
                    <input type="checkbox" id="option1">
                </div>
            </div>
            <div>
                <img src="/img/checklist/2.png" width="200" alt="">
                <div>
                    <button>Play</button>
                    <input type="checkbox" id="option2">
                </div>
            </div>
            <div>
                <img src="/img/checklist/3.png" width="200" alt="">
                <div>
                    <button>Play</button>
                    <input type="checkbox" id="option3">
                </div>
            </div>
            <div>
                <img src="/img/checklist/4.png" width="200" alt="">
                <div>
                    <button>Play</button>
                    <input type="checkbox" id="option4">
                </div>
            </div>
            <div>
                <img src="/img/checklist/5.png" width="200" alt="">
                <div>
                    <button>Play</button>
                    <input type="checkbox" id="option5">
                </div>
            </div>
            <div>
                <img src="/img/checklist/6.png" width="200" alt="">
                <div>
                    <button>Play</button>
                    <input type="checkbox" id="option6">
                </div>
            </div>
            <div>
                <img src="/img/checklist/7.png" width="200" alt="">
                <div>
                    <button>Play</button>
                    <input type="checkbox" id="option7">
                </div>
            </div>
            <div>
                <img src="/img/checklist/8.png" width="200" alt="">
                <div>
                    <button>Play</button>
                    <input type="checkbox" id="option8">
                </div>
            </div>
            <button onclick="checkAnswers()">Check</button>
            <div id="result"></div>
        </div>
        <div>
            <div>
                <p id="timer">00:00</p>
                <p>2nd Grade - Semester 1</p>
            </div>
            <button onclick="location.href='{{ route('2ndgrade-2') }}'">
                NEXT
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-8">
                        <path fill-rule="evenodd" d="M4.5 5.653c0-1.427 1.529-2.33 2.779-1.643l11.54 6.347c1.295.712 1.295 2.573 0 3.286L7.28 19.99c-1.25.687-2.779-.217-2.779-1.643V5.653Z" clip-rule="evenodd" />
                    </svg>
                </span>
            </button>
        </div>
    </div>
    <script>
        let startTime;
        let timerInterval;

        function startTimer() {
            if (localStorage.getItem('startTime')) {
                startTime = new Date(localStorage.getItem('startTime'));
            } else {
                startTime = new Date();
                localStorage.setItem('startTime', startTime);
            }

            timerInterval = setInterval(function() {
                const currentTime = new Date();
                const timeElapsed = currentTime - startTime;
                const seconds = Math.floor((timeElapsed / 1000) % 60);
                const minutes = Math.floor((timeElapsed / 1000 / 60) % 60);

                document.getElementById('timer').textContent =
                    `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            }, 1000);
        }

        window.onload = startTimer;

        function checkAnswers() {
            const correctIds = ['option2', 'option3', 'option4', 'option5', 'option6'];
            let correctCount = 0;

            correctIds.forEach(id => {
                const checkbox = document.getElementById(id);
                if (checkbox && checkbox.checked) {
                    correctCount++;
                }
            });

            let resultText = `You got ${correctCount} points!`;

            if (correctCount === correctIds.length) {
                resultText += " Excellent!";
            }

            document.getElementById('result').textContent = resultText;

            fetch('/update-score', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    correctCount: correctCount
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Score updated:', data);

                document.getElementById('current-score').textContent = `${data.newScore}`;
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        window.addEventListener('beforeunload', function() {
            clearInterval(timerInterval);
        });
    </script>
</x-app-layout>
