<x-app-layout>
    <div class="py-5">
        <div class="flex justify-evenly items-center">
            <p class="text-3xl">2/7</p>
            <p class="bg-secondary text-white text-2xl px-12 py-2 rounded-full shadow">Translating the object</p>
            <div>
                <p class="text-center text-xl font-bold text-text">POINTS</p>
                <p id="current-score" class="bg-input text-xl text-center px-12 py-2 border-double border-4 border-black rounded-full">{{ Auth::user()->score }}</p>
            </div>
        </div>
        <div class="mt-5">
            <div class="grid grid-cols-3 justify-items-center">
                <div class="text-center">
                    <img src="/img/translate/1.png" width="200" alt="">
                    <select id="option1" class="bg-input border-2 border-text mt-2 rounded-full">
                        <option>Choose</option>
                        <option value="Kelinci">Kelinci</option>
                        <option value="Ikan">Ikan</option>
                        <option value="Ayam">Ayam</option>
                        <option value="Burung">Burung</option>
                        <option value="Bebek">Bebek</option>
                        <option value="Kucing">Kucing</option>
                    </select>
                </div>
                <div class="text-center">
                    <img src="/img/translate/2.png" width="200" alt="">
                    <select id="option2" class="bg-input border-2 border-text mt-2 rounded-full">
                        <option>Choose</option>
                        <option value="Kelinci">Kelinci</option>
                        <option value="Ikan">Ikan</option>
                        <option value="Ayam">Ayam</option>
                        <option value="Burung">Burung</option>
                        <option value="Bebek">Bebek</option>
                        <option value="Kucing">Kucing</option>
                    </select>
                </div>
                <div class="text-center">
                    <img src="/img/translate/3.png" width="200" alt="">
                    <select id="option3" class="bg-input border-2 border-text mt-2 rounded-full">
                        <option>Choose</option>
                        <option value="Kelinci">Kelinci</option>
                        <option value="Ikan">Ikan</option>
                        <option value="Ayam">Ayam</option>
                        <option value="Burung">Burung</option>
                        <option value="Bebek">Bebek</option>
                        <option value="Kucing">Kucing</option>
                    </select>
                </div>
                <div class="text-center">
                    <img src="/img/translate/4.png" width="200" alt="">
                    <select id="option4" class="bg-input border-2 border-text mt-2 rounded-full">
                        <option>Choose</option>
                        <option value="Kelinci">Kelinci</option>
                        <option value="Ikan">Ikan</option>
                        <option value="Ayam">Ayam</option>
                        <option value="Burung">Burung</option>
                        <option value="Bebek">Bebek</option>
                        <option value="Kucing">Kucing</option>
                    </select>
                </div>
                <div class="text-center">
                    <img src="/img/translate/5.png" width="200" alt="">
                    <select id="option5" class="bg-input border-2 border-text mt-2 rounded-full">
                        <option>Choose</option>
                        <option value="Kelinci">Kelinci</option>
                        <option value="Ikan">Ikan</option>
                        <option value="Ayam">Ayam</option>
                        <option value="Burung">Burung</option>
                        <option value="Bebek">Bebek</option>
                        <option value="Kucing">Kucing</option>
                    </select>
                </div>
                <div class="text-center">
                    <img src="/img/translate/6.png" width="200" alt="">
                    <select id="option6" class="bg-input border-2 border-text mt-2 rounded-full">
                        <option>Choose</option>
                        <option value="Kelinci">Kelinci</option>
                        <option value="Ikan">Ikan</option>
                        <option value="Ayam">Ayam</option>
                        <option value="Burung">Burung</option>
                        <option value="Bebek">Bebek</option>
                        <option value="Kucing">Kucing</option>
                    </select>
                </div>
            </div>
            <div class="flex flex-col items-center mt-5">
                <button onclick="checkAnswers()" id="checkButton" class="bg-button text-white text-xl font-bold px-6 py-2 rounded-full mb-5">Check</button>
                <div id="result" class="text-xl font-semibold"></div>
            </div>
        </div>
        <div class="flex justify-between p-10 fixed bottom-0 left-0 w-full bg-transparent">
            <div>
                <hr class="h-px my-1 bg-black border-0">
                <p>1st Grade - Semester 2</p>
            </div>
            <button id="nextButton" onclick="location.href='{{ route('2ndgrade-1') }}'" class="hidden gap-2 bg-primary text-button text-xl font-bold px-6 py-2 rounded-full items-center">
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
