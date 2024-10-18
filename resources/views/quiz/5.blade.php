<x-app-layout>
    <div class="py-12">
        <div class="flex justify-evenly items-center">
            <p class="text-3xl">5/7</p>
            <p class="bg-secondary text-white text-2xl px-12 py-2 rounded-full shadow">"Beside", "Behind", or "In front of" ?</p>
            <div>
                <p class="text-center text-xl font-bold text-text">POINTS</p>
                <p id="current-score" class="bg-input text-xl text-center px-12 py-2 border-double border-4 border-black rounded-full">{{ Auth::user()->score }}</p>
            </div>
        </div>
        <div class="mt-5">
            <div class="grid grid-cols-2 gap-5 justify-items-center">
                <div class="w-1/4 flex items-center gap-5">
                    <img src="/img/beside_behind/1.png" alt="">
                    <div>
                        <p>The ball is ___ chair.</p>
                        <select id="option1" class="bg-input border-2 border-text mt-2 rounded-full">
                            <option>Choose</option>
                            <option value="Between">Between</option>
                            <option value="Behind">Behind</option>
                            <option value="In front of">In front of</option>
                        </select>
                    </div>
                </div>
                <div class="w-1/4 flex items-center gap-5">
                    <img src="/img/beside_behind/2.png" alt="">
                    <div>
                        <p>The ball is ___ chair.</p>
                        <select id="option2" class="bg-input border-2 border-text mt-2 rounded-full">
                            <option>Choose</option>
                            <option value="Between">Between</option>
                            <option value="Behind">Behind</option>
                            <option value="In front of">In front of</option>
                        </select>
                    </div>
                </div>
                <div class="w-1/4 flex items-center gap-5">
                    <img src="/img/beside_behind/3.png" alt="">
                    <div>
                        <p>The cat is ___ chair</p>
                        <select id="option3" class="bg-input border-2 border-text mt-2 rounded-full">
                            <option>Choose</option>
                            <option value="Between">Between</option>
                            <option value="Behind">Behind</option>
                            <option value="In front of">In front of</option>
                        </select>
                    </div>
                </div>
                <div class="w-1/4 flex items-center gap-5">
                    <img src="/img/beside_behind/4.png" alt="">
                    <div>
                        <p>The cat is ___ chair and table</p>
                        <select id="option4" class="bg-input border-2 border-text mt-2 rounded-full">
                            <option>Choose</option>
                            <option value="Between">Between</option>
                            <option value="Behind">Behind</option>
                            <option value="In front of">In front of</option>
                        </select>
                    </div>
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
        <div class="flex justify-between p-10 fixed bottom-0 left-0 w-full bg-transparent">
            <div>
                <hr class="h-px my-1 bg-black border-0">
                <p>2nd Grade - Semester 2</p>
            </div>
            <button id="nextButton" onclick="location.href='{{ route('3rdgrade-1') }}'" class="hidden gap-2 bg-primary text-button text-xl font-bold px-6 py-2 rounded-full items-center">
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
            const answers = ['In front of', 'Behind', 'In front of', 'Between'];
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
