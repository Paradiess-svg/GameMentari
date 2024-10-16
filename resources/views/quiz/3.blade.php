<x-app-layout>
    <div class="py-12">
        <div class="flex justify-evenly items-center">
            <p class="text-3xl">3/7</p>
            <p class="bg-secondary text-white text-2xl px-12 py-2 rounded-full shadow">Checklist Everything you hear</p>
            <div>
                <p class="text-center text-xl font-bold text-text">POINTS</p>
                <p id="current-score" class="bg-input text-xl text-center px-12 py-2 border-double border-4 border-black rounded-full">{{ Auth::user()->score }}</p>
            </div>
        </div>
        <div class="mt-5">
            <div class="grid grid-cols-4 gap-5 justify-items-center">
                <div>
                    <img src="/img/checklist/1.png" width="200" alt="">
                    <div class="mt-2">
                        <button class="bg-button text-white px-4 py-2 rounded-full">Play</button>
                        <input type="checkbox" id="option1" class="w-6 h-6 ml-2 text-secondary focus:ring-primary rounded-lg">
                    </div>
                </div>
                <div>
                    <img src="/img/checklist/2.png" width="200" alt="">
                    <div class="mt-2">
                        <button class="bg-button text-white px-4 py-2 rounded-full">Play</button>
                        <input type="checkbox" id="option2" class="w-6 h-6 ml-2 text-secondary focus:ring-primary rounded-lg">
                    </div>
                </div>
                <div>
                    <img src="/img/checklist/3.png" width="200" alt="">
                    <div class="mt-2">
                        <button class="bg-button text-white px-4 py-2 rounded-full">Play</button>
                        <input type="checkbox" id="option3" class="w-6 h-6 ml-2 text-secondary focus:ring-primary rounded-lg">
                    </div>
                </div>
                <div>
                    <img src="/img/checklist/4.png" width="200" alt="">
                    <div class="mt-2">
                        <button class="bg-button text-white px-4 py-2 rounded-full">Play</button>
                        <input type="checkbox" id="option4" class="w-6 h-6 ml-2 text-secondary focus:ring-primary rounded-lg">
                    </div>
                </div>
                <div>
                    <img src="/img/checklist/5.png" width="200" alt="">
                    <div class="mt-2">
                        <button class="bg-button text-white px-4 py-2 rounded-full">Play</button>
                        <input type="checkbox" id="option5" class="w-6 h-6 ml-2 text-secondary focus:ring-primary rounded-lg">
                    </div>
                </div>
                <div>
                    <img src="/img/checklist/6.png" width="200" alt="">
                    <div class="mt-2">
                        <button class="bg-button text-white px-4 py-2 rounded-full">Play</button>
                        <input type="checkbox" id="option6" class="w-6 h-6 ml-2 text-secondary focus:ring-primary rounded-lg">
                    </div>
                </div>
                <div>
                    <img src="/img/checklist/7.png" width="200" alt="">
                    <div class="mt-2">
                        <button class="bg-button text-white px-4 py-2 rounded-full">Play</button>
                        <input type="checkbox" id="option7" class="w-6 h-6 ml-2 text-secondary focus:ring-primary rounded-lg">
                    </div>
                </div>
                <div>
                    <img src="/img/checklist/8.png" width="200" alt="">
                    <div class="mt-2">
                        <button class="bg-button text-white px-4 py-2 rounded-full">Play</button>
                        <input type="checkbox" id="option8" class="w-6 h-6 ml-2 text-secondary focus:ring-primary rounded-lg">
                    </div>
                </div>
            </div>
            <div class="flex flex-col items-center mt-5">
                <button id="checkButton" onclick="checkAnswers()" class="bg-button text-white text-xl font-bold px-6 py-2 rounded-full mb-5">Check</button>
                <div id="result" class="text-xl font-semibold"></div>
            </div>
        </div>
        <div class="flex justify-between p-10 fixed bottom-0 left-0 w-full bg-transparent">
            <div>
                <hr class="h-px my-1 bg-black border-0">
                <p>2nd Grade - Semester 1</p>
            </div>
            <button id="nextButton" onclick="location.href='{{ route('2ndgrade-2') }}'" class="hidden gap-2 bg-primary text-button text-xl font-bold px-6 py-2 rounded-full items-center">
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
