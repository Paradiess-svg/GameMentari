<x-app-layout>
    <div class="py-12">
        <div class="flex justify-evenly items-center">
            <p class="text-3xl">7/7</p>
            <p class="bg-secondary text-white text-2xl px-12 py-2 rounded-full shadow">Click</p>
            <div>
                <p class="text-center text-xl font-bold text-text">POINTS</p>
                <p id="current-score" class="bg-input text-xl text-center px-12 py-2 border-double border-4 border-black rounded-full">{{ Auth::user()->score }}</p>
            </div>
        </div>
        <div class="mt-5">
            <div class="flex justify-evenly items-center">
                <div class="flex flex-col justify-center items-center p-4 border-2 border-black rounded-lg">
                    <img src="/img/click/1.png" width="200" alt="" class="mx-auto">
                    <div id="letter-container-1" class="letter-container my-5"></div>
                    <input type="text" id="answer-1" readonly>
                </div>
                <div class="flex flex-col justify-center items-center p-4 border-2 border-black rounded-lg">
                    <img src="/img/click/2.png" width="200" alt="" class="mx-auto">
                    <div id="letter-container-2" class="letter-container my-5"></div>
                    <input type="text" id="answer-2" readonly>
                </div>
            </div>
            <div class="flex flex-col items-center mt-5 mb-32">
                <button onclick="checkAnswers(), cling.play();" id="checkButton" class="bg-button text-white text-xl font-bold px-6 py-2 rounded-full mb-5">Check</button>
                <script type="text/javascript">
                    const cling = new Audio();
                    cling.src = "/sound/cling.mp3";
                    </script>
                <div id="result" class="text-xl font-semibold"></div>
            </div>
        </div>
        <div class="flex justify-between p-10 fixed bottom-0 left-0 w-full bg-transparent">
            <div>
                <hr class="h-px my-1 bg-black border-0">
                <p>3rd Grade - Semester 2</p>
            </div>
            <button id="nextButton" onclick="endGame()" class="hidden gap-2 bg-primary text-button text-xl font-bold px-6 py-2 rounded-full items-center">
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
        const correctAnswers = {
            1: 'ICE CREAM',
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
                span.className = 'cursor-pointer px-4 py-2 bg-input font-bold rounded-full';
                span.onclick = () => addToAnswer(letter, containerId, span);
                container.appendChild(span);
            });
        }

        function addToAnswer(letter, containerId, spanElement) {
            const answerInputId = containerId === 'letter-container-1' ? 'answer-1' : 'answer-2';
            const answerInput = document.getElementById(answerInputId);
            answerInput.value += letter;
            spanElement.style.visibility = 'hidden';
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

            const checkButton = document.getElementById('checkButton');
            checkButton.parentNode.removeChild(checkButton);

            document.getElementById('nextButton').style.display = 'flex';

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

        window.onload = () => {
        createLetterButtons(correctAnswers[1], 'letter-container-1');
        createLetterButtons(correctAnswers[2], 'letter-container-2');
        };

        function endGame() {
            fetch('/update-status', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    status: 'Y'
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Status updated:', data);
                window.location.href = "{{ route('result') }}";
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    </script>
</x-app-layout>
