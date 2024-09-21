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