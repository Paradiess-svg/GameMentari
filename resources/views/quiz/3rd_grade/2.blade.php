<x-app-layout>
    <div class="py-12">
        <div>
            <p>7/7</p>
            <p>Click</p>
            <div>
                <p>Poin</p>
                <p id="current-score">{{ Auth::user()->score }}</p>
            </div>
        </div>
        <div>
            <div>
                <img src="/img/click/1.png" width="200" alt="">
                <div id="letter-container-1" class="letter-container"></div>
                <input type="text" id="answer-1" readonly>
            </div>
            <div>
                <img src="/img/click/2.png" width="200" alt="">
                <div id="letter-container-2" class="letter-container"></div>
                <input type="text" id="answer-2" readonly>
            </div>
            <button onclick="checkAnswers()">Check</button>
            <div id="result"></div>
        </div>
        <div>
            <div>
                <p id="timer">00:00</p>
                <p>3rd Grade - Semester 2</p>
            </div>
            <button onclick="endGame()">Finish Game</button>
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

        const correctAnswers = {
            1: 'ICECREAM',
            2: 'STRAWBERRY'
        };

        function shuffleLetters(word) {
            let shuffledWord;
            do {
                shuffledWord = word.split('').sort(() => Math.random() - 0.5).join('');
            } while (shuffledWord === word);
            return shuffledWord;
        }

        function createLetterButtons(word, containerId) {
            const shuffledWord = shuffleLetters(word);
            const container = document.getElementById(containerId);

            shuffledWord.split('').forEach(letter => {
                const span = document.createElement('span');
                span.textContent = letter;
                span.className = 'cursor-pointer px-4 py-2 bg-gray-200 rounded';
                span.onclick = () => addToAnswer(span.textContent, containerId);
                container.appendChild(span);
            });
        }

        function addToAnswer(letter, containerId) {
            const answerInputId = containerId === 'letter-container-1' ? 'answer-1' : 'answer-2';
            const answerInput = document.getElementById(answerInputId);
            answerInput.value += letter;
        }

        function checkAnswers() {
            const answer1 = document.getElementById('answer-1').value;
            const answer2 = document.getElementById('answer-2').value;

            let correctCount = 0;

            if (answer1.toUpperCase() === correctAnswers[1]) {
                correctCount++;
            }

            if (answer2.toUpperCase() === correctAnswers[2]) {
                correctCount++;
            }

            let resultText = `You got ${correctCount} correct!`;

            if (correctCount === 2) {
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

        function endGame() {
            clearInterval(timerInterval);
            const endTime = new Date();
            const timeDiff = endTime - startTime;

            const timeInSeconds = Math.floor(timeDiff / 1000);

            fetch('/save-time', {
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

        window.onload = () => {
        startTimer();
        createLetterButtons(correctAnswers[1], 'letter-container-1');
        createLetterButtons(correctAnswers[2], 'letter-container-2');
        };

        window.addEventListener('beforeunload', function() {
            clearInterval(timerInterval);
        });
    </script>
</x-app-layout>
