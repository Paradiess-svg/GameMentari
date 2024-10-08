<x-app-layout>
    <div class="py-12">
        <div>
            <p>6/7</p>
            <p>Drag the right name</p>
            <div>
                <p>Poin</p>
                <p id="current-score">{{ Auth::user()->score }}</p>
            </div>
        </div>
        <div>
            <div id="fried-chicken" class="draggable-item">Fried Chicken</div>
            <div id="meatball" class="draggable-item">Meatball</div>
            <div id="banana" class="draggable-item">Banana</div>
            <div id="noodle" class="draggable-item">Noodle</div>
            <div id="milk" class="draggable-item">Milk</div>
            <div id="bread" class="draggable-item">Bread</div>
            <div id="rice" class="draggable-item">Rice</div>
            <div id="fried-rice" class="draggable-item">Fried Rice</div>
        </div>
        <div>
            <div>
                <img src="/img/dragdrop/1.png" width="200" alt="">
                <div class="drop-item bg-[#FBF4CD] text-xl w-[200px] py-4 px-6 border-2 border-[#3F1451] rounded-full mt-2"></div>
            </div>
            <div>
                <img src="/img/dragdrop/2.png" width="200" alt="">
                <div class="drop-item bg-[#FBF4CD] text-xl w-[200px] py-4 px-6 border-2 border-[#3F1451] rounded-full mt-2"></div>
            </div>
            <div>
                <img src="/img/dragdrop/3.png" width="200" alt="">
                <div class="drop-item bg-[#FBF4CD] text-xl w-[200px] py-4 px-6 border-2 border-[#3F1451] rounded-full mt-2"></div>
            </div>
            <div>
                <img src="/img/dragdrop/4.png" width="200" alt="">
                <div class="drop-item bg-[#FBF4CD] text-xl w-[200px] py-4 px-6 border-2 border-[#3F1451] rounded-full mt-2"></div>
            </div>
            <div>
                <img src="/img/dragdrop/5.png" width="200" alt="">
                <div class="drop-item bg-[#FBF4CD] text-xl w-[200px] py-4 px-6 border-2 border-[#3F1451] rounded-full mt-2"></div>
            </div>
            <div>
                <img src="/img/dragdrop/6.png" width="200" alt="">
                <div class="drop-item bg-[#FBF4CD] text-xl w-[200px] py-4 px-6 border-2 border-[#3F1451] rounded-full mt-2"></div>
            </div>
            <div>
                <img src="/img/dragdrop/7.png" width="200" alt="">
                <div class="drop-item bg-[#FBF4CD] text-xl w-[200px] py-4 px-6 border-2 border-[#3F1451] rounded-full mt-2"></div>
            </div>
            <div>
                <img src="/img/dragdrop/8.png" width="200" alt="">
                <div class="drop-item bg-[#FBF4CD] text-xl w-[200px] py-4 px-6 border-2 border-[#3F1451] rounded-full mt-2"></div>
            </div>
            <button onclick="checkAnswers()">Check</button>
            <div id="result"></div>
        </div>
        <div>
            <div>
                <p id="timer">00:00</p>
                <p>3rd Grade - Semester 1</p>
            </div>
            <button onclick="location.href='{{ route('3rdgrade-2') }}'">
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
                e.target.appendChild(draggedItem);
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
                const droppedItem = dropItem.firstChild ? dropItem.firstChild.id : null;

                if (droppedItem && droppedItem === correctAnswers[index]) {
                    correctCount++;
                }
            });

            let resultText = `You got ${correctCount} correct!`;

            if (correctCount === Object.keys(correctAnswers).length) {
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
