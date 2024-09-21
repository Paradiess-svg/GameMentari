function checkAnswers() {
    const answers = ['GoodMorning', 'GoodEvening', 'GoodAfternoon'];
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
}