<x-app-layout>
    <div class="py-12">
        <div>
            <p>2/7</p>
            <p>Translating the object</p>
            <div>
                <p>Poin</p>
                <p id="current-score">{{ Auth::user()->score }}</p>
            </div>
        </div>
        <div>
            <div>
                <img src="/img/translate/1.jpg" width="200" alt="">
                <select id="option1">
                    <option>Choose</option>
                    <option value="Kelinci">Kelinci</option>
                    <option value="Ikan">Ikan</option>
                    <option value="Ayam">Ayam</option>
                    <option value="Burung">Burung</option>
                    <option value="Bebek">Bebek</option>
                    <option value="Kucing">Kucing</option>
                </select>
            </div>
            <div>
                <img src="/img/translate/2.jpg" width="200" alt="">
                <select id="option2">
                    <option>Choose</option>
                    <option value="Kelinci">Kelinci</option>
                    <option value="Ikan">Ikan</option>
                    <option value="Ayam">Ayam</option>
                    <option value="Burung">Burung</option>
                    <option value="Bebek">Bebek</option>
                    <option value="Kucing">Kucing</option>
                </select>
            </div>
            <div>
                <img src="/img/translate/3.jpg" width="200" alt="">
                <select id="option3">
                    <option>Choose</option>
                    <option value="Kelinci">Kelinci</option>
                    <option value="Ikan">Ikan</option>
                    <option value="Ayam">Ayam</option>
                    <option value="Burung">Burung</option>
                    <option value="Bebek">Bebek</option>
                    <option value="Kucing">Kucing</option>
                </select>
            </div>
            <div>
                <img src="/img/translate/4.jpg" width="200" alt="">
                <select id="option4">
                    <option>Choose</option>
                    <option value="Kelinci">Kelinci</option>
                    <option value="Ikan">Ikan</option>
                    <option value="Ayam">Ayam</option>
                    <option value="Burung">Burung</option>
                    <option value="Bebek">Bebek</option>
                    <option value="Kucing">Kucing</option>
                </select>
            </div>
            <div>
                <img src="/img/translate/5.jpg" width="200" alt="">
                <select id="option5">
                    <option>Choose</option>
                    <option value="Kelinci">Kelinci</option>
                    <option value="Ikan">Ikan</option>
                    <option value="Ayam">Ayam</option>
                    <option value="Burung">Burung</option>
                    <option value="Bebek">Bebek</option>
                    <option value="Kucing">Kucing</option>
                </select>
            </div>
            <div>
                <img src="/img/translate/6.jpg" width="200" alt="">
                <select id="option6">
                    <option>Choose</option>
                    <option value="Kelinci">Kelinci</option>
                    <option value="Ikan">Ikan</option>
                    <option value="Ayam">Ayam</option>
                    <option value="Burung">Burung</option>
                    <option value="Bebek">Bebek</option>
                    <option value="Kucing">Kucing</option>
                </select>
            </div>
            <button onclick="checkAnswers()">Check</button>
            <div id="result"></div>
        </div>
        <div>
            <div>
                <p id="timer">00:00</p>
                <p>1st Grade - Semester 2</p>
            </div>
            <button onclick="location.href='{{ route('dashboard') }}'">
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
            const answers = ['Kelinci', 'Bebek', 'Kucing', 'Ikan', 'Burung', 'Ayam'];
            const userAnswers = [
                document.getElementById('option1').value,
                document.getElementById('option2').value,
                document.getElementById('option3').value,
                document.getElementById('option4').value,
                document.getElementById('option5').value,
                document.getElementById('option6').value,
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
