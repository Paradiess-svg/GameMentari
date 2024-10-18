<x-app-layout>
    <div class="py-5">
        <div class="flex justify-evenly items-center">
            <p class="text-3xl">1/7</p>
            <p class="bg-secondary text-white text-2xl px-12 py-2 rounded-full shadow">Complete the blank words!</p>
            <div>
                <p class="text-center text-xl font-bold text-text">POINTS</p>
                <p id="current-score" class="bg-input text-xl text-center px-12 py-2 border-double border-4 border-black rounded-full">{{ Auth::user()->score }}</p>
            </div>
        </div>
        <div class="mt-5">
            <div class="flex justify-evenly items-center">
                <div class="p-4 border-2 border-black rounded-lg">
                    <img src="/img/blank_words/1.jpg" class="rounded-lg" width="250" alt="">
                    <p class="my-4 text-center text-lg font-semibold">G__d M__n_ng</p>
                    <input type="text" id="word1" class="bg-input text-text text-center border-none rounded-full">
                </div>
                <div class="p-4 border-2 border-black rounded-lg">
                    <img src="/img/blank_words/2.jpg" class="rounded-lg" width="250" alt="">
                    <p class="my-4 text-center text-lg font-semibold">G__d E__e__ng</p>
                    <input type="text" id="word2" class="bg-input text-text text-center border-none rounded-full">
                </div>
                <div class="p-4 border-2 border-black rounded-lg">
                    <img src="/img/blank_words/3.jpg" class="rounded-lg" width="250" alt="">
                    <p class="my-4 text-center text-lg font-semibold">G__d A_tern__n</p>
                    <input type="text" id="word3" class="bg-input text-text text-center border-none rounded-full">
                </div>
            </div>
            <div class="flex flex-col items-center mt-5">
                <button onclick="checkAnswers(), cling.play();" id="checkButton" class="bg-button text-white text-xl font-bold px-6 py-2 rounded-full mb-5">Check</button>
                <script type="text/javascript">
                    const cling = new Audio();
                    cling.src = "/sound/cling.mp3";
                    </script>
                <div id="result" class="text-xl font-semibold"></div>
            </div>
        </div>
        <div class="flex justify-between p-10 fixed bottom-0 left-0 w-full bg-white">
            <div>
                <hr class="h-px my-1 bg-black border-0">
                <p>1st Grade - Semester 1</p>
            </div>
            <button id="nextButton" onclick="location.href='{{ route('1stgrade-2') }}'" class="hidden gap-2 bg-primary text-button text-xl font-bold px-6 py-2 rounded-full items-center">
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
        function checkAnswers() {
            const answers = ['Good Morning', 'Good Evening', 'Good Afternoon'];
            const userAnswers = [
                document.getElementById('word1').value,
                document.getElementById('word2').value,
                document.getElementById('word3').value
            ];

            let correctCount = 0;

            for (let i = 0; i < answers.length; i++) {
                if (userAnswers[i].toLowerCase() === answers[i].toLowerCase()) {
                    correctCount++;
                }
            }

            let resultText = `You got ${correctCount} out of ${answers.length} correct!`;

            if (correctCount === answers.length) {
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
    </script>
</x-app-layout>
