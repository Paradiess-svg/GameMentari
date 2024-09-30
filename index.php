<?php
include 'config.php'; ?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mentari</title>
    <style>
        body {
            font-family: 'Comic Sans MS', cursive, sans-serif;
            background-color: #fff;
            text-align: center;
            margin: 0;
            padding: 0;
        }
    </style>
    <script type="text/javascript" src="index.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

    <header class="bg-[#EECEB9] p-[20px]">
        <div class="flex justify-between items-center">
            <img src="/img/title.png" alt="title" width="250" height="250">
            <p class="bg-[#3F1451] text-white text-xl font-semibold px-8 py-2 rounded-full"><b> <?php echo $_SESSION['nama'];?> </b></p>
        </div>
    </header>

    <div class="flex justify-between items-center px-10 pt-5">
        <p class="text-3xl text-[#3F1451] font-bold">4/7</p>
        <div>
            <p class="text-2xl font-bold text-[#3F1451]">
                POIN
            </p>
            <div class="bg-[#FBF4CD] text-2xl text-center px-20 py-2 border-2 border-[#3F1451] rounded-full">10</div>
        </div>
    </div>

    <div class="container max-w-[1500px] mx-auto">
        <h2 class="bg-[#DBAFA0] text-white text-2xl w-fit mx-auto mb-5 py-4 px-20 rounded-full">"She" or "He" ?</h2>
        <div class="container grid grid-cols-2 gap-5">
            <div class="w-1/3 flex items-center gap-5">
                <img src="/img/she_or_he/1.png" alt="Image 1">
                <div>
                    <p class="bg-[#FBF4CD] text-2xl text-nowrap px-4 rounded-full border-2 border-[#3F1451]">___ is my father.</p>
                    <select id="option1" class="bg-[#FBF4CD] text-2xl rounded-full py-2 px-4 my-2 text-center border-2 border-[#3F1451]">
                        <option>Choose</option>
                        <option value="She">She</option>
                        <option value="He">He</option>
                    </select>
                </div>
            </div>
            <div class="w-1/3 flex items-center gap-5">
                <img src="/img/she_or_he/2.png" alt="Image 2">
                <div>
                    <p class="bg-[#FBF4CD] text-2xl text-nowrap px-4 rounded-full border-2 border-[#3F1451]">___ is Steven.</p>
                    <select id="option2" class="bg-[#FBF4CD] text-2xl rounded-full py-2 px-4 my-2 text-center border-2 border-[#3F1451]">
                        <option>Choose</option>
                        <option value="She">She</option>
                        <option value="He">He</option>
                    </select>
                </div>
            </div>
            <div class="w-1/3 flex items-center gap-5">
                <img src="/img/she_or_he/3.png" alt="Image 3">
                <div>
                    <p class="bg-[#FBF4CD] text-2xl text-nowrap px-4 rounded-full border-2 border-[#3F1451]">___ is my sister.</p>
                    <select id="option3" class="bg-[#FBF4CD] text-2xl rounded-full py-2 px-4 my-2 text-center border-2 border-[#3F1451]">
                        <option>Choose</option>
                        <option value="She">She</option>
                        <option value="He">He</option>
                    </select>
                </div>
            </div>
            <div class="w-1/3 flex items-center gap-5">
                <img src="/img/she_or_he/4.png" alt="Image 4">
                <div>
                    <p class="bg-[#FBF4CD] text-2xl text-nowrap px-4 rounded-full border-2 border-[#3F1451]">___ is my friend.</p>
                    <select id="option4" class="bg-[#FBF4CD] text-2xl rounded-full py-2 px-4 my-2 text-center border-2 border-[#3F1451]">
                        <option>Choose</option>
                        <option value="She">She</option>
                        <option value="He">He</option>
                    </select>
                </div>
            </div>
        </div>
        <form method="post" action="proses.php" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $_SESSION['id'];?>"> <!-- ID pengguna -->
        <input type="hidden" name="nama" value="<?php echo $_SESSION['nama'];?>"> <!-- Nama pengguna -->
    <input type="text" id="option1" name="option1" placeholder="Your answer 1" required>
    <input type="text" id="option2" name="option2" placeholder="Your answer 2" required>
    <input type="text" id="option3" name="option3" placeholder="Your answer 3" required>
    <input type="text" id="option4" name="option4" placeholder="Your answer 4" required>
    
    <input type="hidden" name="nilai" id="nilai" value="">
    <button type="submit">Check</button>
</form>


<div id="result"></div> <!-- Untuk menampilkan hasil -->

        <!-- <button class="bg-[#5F374B] text-white rounded-full py-2 px-8 mx-auto text-3xl mt-10" onclick="checkAnswers()">Check</button> -->
        <!-- <div class="text-2xl mt-5" id="result"></div> -->
    </div>

    <footer class="flex justify-between px-10 mx-auto items-center">
        <div class="">
            <p class="text-2xl font-semibold">00:00:15</p>
            <p class="text-xl">Kelas 2 - Semester 2</p>
        </div>
        <button class="bg-[#EECEB9] text-[#5F374B] text-3xl font-bold py-2 px-8 flex flex-row items-center gap-2 rounded-full" onclick="" type="submit" name="aksi" value="nilai">
            NEXT
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-8">
                    <path fill-rule="evenodd" d="M4.5 5.653c0-1.427 1.529-2.33 2.779-1.643l11.54 6.347c1.295.712 1.295 2.573 0 3.286L7.28 19.99c-1.25.687-2.779-.217-2.779-1.643V5.653Z" clip-rule="evenodd" />
                </svg>                      
            </span>
        </button>
    </footer>
    <script>
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
}
</script>


</body>
</html>