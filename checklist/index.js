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
}