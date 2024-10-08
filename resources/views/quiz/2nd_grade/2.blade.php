<x-app-layout>
    <div class="py-12">
        <div>
            <p>4/7</p>
            <p>"She" or "He" ?</p>
            <div>
                <p>Poin</p>
                <p id="current-score">{{ Auth::user()->score }}</p>
            </div>
        </div>
        <div>
            <div>
                <img src="/img/she_or_he/1.png" width="200" alt="">
                <div>
                    <p>___ is my father.</p>
                    <select id="option1">
                        <option>Choose</option>
                        <option value="She">She</option>
                        <option value="He">He</option>
                    </select>
                </div>
            </div>
            <div>
                <img src="/img/she_or_he/2.png" width="200" alt="">
                <div>
                    <p>___ is Steven.</p>
                    <select id="option2">
                        <option>Choose</option>
                        <option value="She">She</option>
                        <option value="He">He</option>
                    </select>
                </div>
            </div>
            <div>
                <img src="/img/she_or_he/3.png" width="200" alt="">
                <div>
                    <p>___ is my sister.</p>
                    <select id="option3">
                        <option>Choose</option>
                        <option value="She">She</option>
                        <option value="He">He</option>
                    </select>
                </div>
            </div>
            <div>
                <img src="/img/she_or_he/4.png" width="200" alt="">
                <div>
                    <p>___ is my friend.</p>
                    <select id="option4">
                        <option>Choose</option>
                        <option value="She">She</option>
                        <option value="He">He</option>
                    </select>
                </div>
            </div>
            <button onclick="checkAnswers()">Check</button>
            <div id="result"></div>
        </div>
        <div>
            <div>
                <p id="timer">00:00</p>
                <p>2nd Grade - Semester 2</p>
            </div>
            <button onclick="location.href='{{ route('2ndgrade-3') }}'">
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
            const answers = ['He', 'He', 'She', 'She'];
            const userAnswers = [
                document.getElementById('option1').value,
                document.getElementById('option2').value,
                document.getElementById('option3').value,
                document.getElementById('option4').value,
            ];

            let correctCount = 0;

            for (let i = 0; i < answers.length; i++) {
                if (userAnswers[i] === answers[i]) {
                    correctCount++;
                }
            }

            let resultText = `You got ${correctCount} out of ${answers.length} correct!`;

            if (correctCount === answers.length) {
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
