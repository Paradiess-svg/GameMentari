<x-app-layout>
    <div class="py-12">
        <div class="flex justify-evenly items-center">
            <p class="text-3xl">6/7</p>
            <p class="bg-secondary text-white text-2xl px-12 py-2 rounded-full shadow">Drag the right name</p>
            <div>
                <p class="text-center text-xl font-bold text-text">POINTS</p>
                <p id="current-score" class="bg-input text-xl text-center px-12 py-2 border-double border-4 border-black rounded-full">{{ Auth::user()->score }}</p>
            </div>
        </div>
        <div class="grid grid-cols-4 gap-5 mx-auto bg-white w-fit border-2 border-text rounded-lg mt-5 p-2">
            <div id="fried-chicken" class="draggable-item bg-input w-[200px] py-2 px-4 text-center border-2 border-text rounded-full mt-2">Fried Chicken</div>
            <div id="meatball" class="draggable-item bg-input w-[200px] py-2 px-4 text-center border-2 border-text rounded-full mt-2">Meatball</div>
            <div id="banana" class="draggable-item bg-input w-[200px] py-2 px-4 text-center border-2 border-text rounded-full mt-2">Banana</div>
            <div id="noodle" class="draggable-item bg-input w-[200px] py-2 px-4 text-center border-2 border-text rounded-full mt-2">Noodle</div>
            <div id="milk" class="draggable-item bg-input w-[200px] py-2 px-4 text-center border-2 border-text rounded-full mt-2">Milk</div>
            <div id="bread" class="draggable-item bg-input w-[200px] py-2 px-4 text-center border-2 border-text rounded-full mt-2">Bread</div>
            <div id="rice" class="draggable-item bg-input w-[200px] py-2 px-4 text-center border-2 border-text rounded-full mt-2">Rice</div>
            <div id="fried-rice" class="draggable-item bg-input w-[200px] py-2 px-4 text-center border-2 border-text rounded-full mt-2">Fried Rice</div>
        </div>
        <div class="mt-5">
            <div class="grid grid-cols-4 gap-5 justify-items-center">
                <div>
                    <img src="/img/dragdrop/1.png" width="200" alt="">
                    <div class="drop-item bg-input text-xl w-[200px] py-4 px-6 border-2 border-text rounded-full mt-2"></div>
                </div>
                <div>
                    <img src="/img/dragdrop/2.png" width="200" alt="">
                    <div class="drop-item bg-input text-xl w-[200px] py-4 px-6 border-2 border-text rounded-full mt-2"></div>
                </div>
                <div>
                    <img src="/img/dragdrop/3.png" width="200" alt="">
                    <div class="drop-item bg-input text-xl w-[200px] py-4 px-6 border-2 border-text rounded-full mt-2"></div>
                </div>
                <div>
                    <img src="/img/dragdrop/4.png" width="200" alt="">
                    <div class="drop-item bg-input text-xl w-[200px] py-4 px-6 border-2 border-text rounded-full mt-2"></div>
                </div>
                <div>
                    <img src="/img/dragdrop/5.png" width="200" alt="">
                    <div class="drop-item bg-input text-xl w-[200px] py-4 px-6 border-2 border-text rounded-full mt-2"></div>
                </div>
                <div>
                    <img src="/img/dragdrop/6.png" width="200" alt="">
                    <div class="drop-item bg-input text-xl w-[200px] py-4 px-6 border-2 border-text rounded-full mt-2"></div>
                </div>
                <div>
                    <img src="/img/dragdrop/7.png" width="200" alt="">
                    <div class="drop-item bg-input text-xl w-[200px] py-4 px-6 border-2 border-text rounded-full mt-2"></div>
                </div>
                <div>
                    <img src="/img/dragdrop/8.png" width="200" alt="">
                    <div class="drop-item bg-input text-xl w-[200px] py-4 px-6 border-2 border-text rounded-full mt-2"></div>
                </div>
            </div>
            <div class="flex flex-col items-center mt-5 mb-32">
                <button id="checkButton" onclick="checkAnswers()" class="bg-button text-white text-xl font-bold px-6 py-2 rounded-full mb-5">Check</button>
                <div id="result" class="text-xl font-semibold"></div>
            </div>
        </div>
        <div class="flex justify-between p-10 fixed bottom-0 left-0 w-full bg-white">
            <div>
                <hr class="h-px my-1 bg-black border-0">
                <p>3rd Grade - Semester 1</p>
            </div>
            <button id="nextButton" onclick="location.href='{{ route('3rdgrade-2') }}'" class="hidden gap-2 bg-primary text-button text-xl font-bold px-6 py-2 rounded-full items-center">
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
        document.addEventListener('DOMContentLoaded', () => {
            const draggables = document.querySelectorAll('[id^="fried-chicken"], [id^="meatball"], [id^="banana"], [id^="noodle"], [id^="milk"], [id^="bread"], [id^="rice"], [id^="fried-rice"]');
            const droppables = document.querySelectorAll('.drop-item');

            draggables.forEach(draggable => {
                draggable.setAttribute('draggable', true);
                draggable.addEventListener('dragstart', handleDragStart);
            });

            droppables.forEach(droppable => {
                droppable.addEventListener('dragover', handleDragOver);
                droppable.addEventListener('drop', handleDrop);
            });
        });

        let draggedItem = null;

        function handleDragStart(e) {
            draggedItem = e.target;
        }

        function handleDragOver(e) {
            e.preventDefault();
        }

        function handleDrop(e) {
            e.preventDefault();
            if (draggedItem) {
                const droppedId = draggedItem.id;
                e.target.textContent = draggedItem.textContent;
                e.target.setAttribute('data-dropped-id', droppedId);

                draggedItem.style.display = 'none';

                draggedItem = null;
            }
        }

        function checkAnswers() {
            const correctAnswers = {
                0: 'fried-chicken',
                1: 'noodle',
                2: 'rice',
                3: 'milk',
                4: 'fried-rice',
                5: 'meatball',
                6: 'banana',
                7: 'bread'
            };

            let correctCount = 0;

            document.querySelectorAll('.drop-item').forEach((dropItem, index) => {
                const droppedId = dropItem.getAttribute('data-dropped-id');

                if (droppedId && droppedId === correctAnswers[index]) {
                    correctCount++;
                }
            });

            let resultText = `You got ${correctCount} correct!`;

            if (correctCount === Object.keys(correctAnswers).length) {
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
