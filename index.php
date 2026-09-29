<?php
// Inisialisasi variabel
$angka1 = '';
$angka2 = '';
$operator = '';
$hasil = '';
$error = '';

// Proses ketika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $angka1   = $_POST['angka1'] ?? '';
    $angka2   = $_POST['angka2'] ?? '';
    $operator = $_POST['operator'] ?? '';

    // Validasi input
    if ($angka1 === '' || $angka2 === '') {
        $error = "Kedua angka harus diisi!";
    } elseif (!is_numeric($angka1) || !is_numeric($angka2)) {
        $error = "Input harus berupa angka!";
    } else {
        $a = (float)$angka1;
        $b = (float)$angka2;

        // Hitung berdasarkan operator
        switch ($operator) {
            case '+':
                $hasil = $a + $b;
                break;
            case '-':
                $hasil = $a - $b;
                break;
            case '*':
                $hasil = $a * $b;
                break;
            case '/':
                if ($b == 0) {
                    $error = "Tidak bisa dibagi dengan nol!";
                } else {
                    $hasil = $a / $b;
                }
                break;
            case '%':
                if ($b == 0) {
                    $error = "Tidak bisa dimodulo dengan nol!";
                } else {
                    $hasil = $a % $b;
                }
                break;
            case '^':
                $hasil = pow($a, $b);
                break;
            default:
                $error = "Operator tidak valid!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Aritmatika</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Kalkulator Aritmatika</h1>

        <form method="POST" action="">
            <div class="form-group">
                <label for="angka1">Angka Pertama</label>
                <input type="text" 
                       name="angka1" 
                       id="angka1" 
                       placeholder="Masukkan angka..."
                       value="<?= htmlspecialchars($angka1) ?>" 
                       autofocus>
            </div>

            <div class="form-group">
                <label for="operator">Operator</label>
                <select name="operator" id="operator">
                    <option value="+" <?= $operator === '+' ? 'selected' : '' ?>>+ (Penjumlahan)</option>
                    <option value="-" <?= $operator === '-' ? 'selected' : '' ?>>- (Pengurangan)</option>
                    <option value="*" <?= $operator === '*' ? 'selected' : '' ?>>× (Perkalian)</option>
                    <option value="/" <?= $operator === '/' ? 'selected' : '' ?>>÷ (Pembagian)</option>
                    <option value="%" <?= $operator === '%' ? 'selected' : '' ?>>% (Modulo)</option>
                    <option value="^" <?= $operator === '^' ? 'selected' : '' ?>>^ (Pangkat)</option>
                </select>
            </div>

            <div class="form-group">
                <label for="angka2">Angka Kedua</label>
                <input type="text" 
                       name="angka2" 
                       id="angka2" 
                       placeholder="Masukkan angka..."
                       value="<?= htmlspecialchars($angka2) ?>">
            </div>

            <button type="submit" name="hitung">Hitung</button>
        </form>

        <?php if ($error): ?>
            <div class="error">⚠️ <?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if ($hasil !== '' && !$error): ?>
            <div class="hasil">
                <span class="label">Hasil:</span>
                <span class="value">
                    <?= htmlspecialchars($angka1) ?> 
                    <?= htmlspecialchars($operator) ?> 
                    <?= htmlspecialchars($angka2) ?> 
                    = 
                    <strong><?= htmlspecialchars($hasil) ?></strong>
                </span>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>