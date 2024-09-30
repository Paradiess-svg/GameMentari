
<?php
include 'koneksi.php'; // Pastikan koneksi ke database sudah benar
session_start();

function simpan_nilai($id, $correctCount) {
    $query = "UPDATE score SET nilai='$correctCount' WHERE id='$id';";
    $sql = mysqli_query($GLOBALS['conn'], $query);
    return $sql; // Kembalikan hasil dari query
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Jawaban yang benar
    $answers = ['He', 'He', 'She', 'She'];
    
    // Mengambil jawaban dari inputan
    $userAnswers = [
        $_POST['option1'],
        $_POST['option2'],
        $_POST['option3'],
        $_POST['option4'],
    ];

    $correctCount = 0;

    // Menghitung jawaban yang benar
    for ($i = 0; $i < count($answers); $i++) {
        if ($userAnswers[$i] === $answers[$i]) {
            $correctCount++;
        }
    }

    // Menyusun pesan hasil
    $resultText = "You got $correctCount out of " . count($answers) . " correct!";
    if ($correctCount === count($answers)) {
        $resultText .= " Excellent!";
    }

    // Menampilkan hasil
    echo "<div id='result'>$resultText</div>";

    // Mengambil ID dan menyimpan nilai ke database
    $id = $_POST['id'];
    $hasilSimpan = simpan_nilai($id, $correctCount);

    if ($hasilSimpan) {
        echo "Nilai berhasil disimpan.";
        echo $_SESSION['nama'];
    } else {
        echo "Gagal menyimpan nilai.";
    }
}
?>



