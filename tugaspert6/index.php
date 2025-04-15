<?php
// Array pajak bandara asal
$bandara_asal = [
    "Soekarno Hatta" => 65000,
    "Husein Sastranegara" => 50000,
    "Abdul Rachman Saleh" => 40000,
    "Juanda" => 30000,
];

// Array pajak bandara tujuan
$bandara_tujuan = [
    "Ngurah Rai" => 85000,
    "Hasanuddin" => 70000,
    "Inanwatan" => 90000,
    "Sultan Iskandar Muda" => 60000,
];

// Mengurutkan bandara
asort($bandara_asal);
asort($bandara_tujuan);

function hitung_pajak($asal, $tujuan, $bandara_asal, $bandara_tujuan) {
    return $bandara_asal[$asal] + $bandara_tujuan[$tujuan];
}

$pajak_asal = 0;
$pajak_tujuan = 0;
$total_harga = 0;
$total_pajak = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $nama_maskapai = $_POST['nama_maskapai'];
    $nomor = $_POST['nomor'];
    $bandara_asal_input = $_POST['bandara_asal'];
    $bandara_tujuan_input = $_POST['bandara_tujuan'];
    $tanggal = $_POST['tanggal'];
    $harga_tiket = (int)$_POST['harga_tiket'];

    // Menghitung pajak
    $total_pajak = hitung_pajak($bandara_asal_input, $bandara_tujuan_input, $bandara_asal, $bandara_tujuan);
    $total_harga = $total_pajak + $harga_tiket;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Rute Penerbangan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 20px;
        }

        h1, h2 {
            text-align: center;
            color: #2c3e50;
        }

        form {
            background-color: #fff;
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="date"],
        input[type="number"],
        select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            margin-top: 15px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #2980b9;
        }

        .result {
            background-color: #ecf0f1;
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 10px;
            border: 1px solid #bdc3c7;
        }

        .result p {
            margin: 8px 0;
        }
    </style>
</head>
<body>
    <h1>Pendaftaran Rute Penerbangan</h1>
    <form method="POST" action="">
        <label>Nama Maskapai:</label>
        <input type="text" name="nama_maskapai" required>

        <label>Nomor:</label>
        <input type="text" name="nomor" required>

        <label>Bandara Asal:</label>
        <select name="bandara_asal" required>
            <?php foreach ($bandara_asal as $nama => $pajak): ?>
                <option value="<?= $nama ?>"><?= $nama ?></option>
            <?php endforeach; ?>
        </select>

        <label>Tanggal:</label>
        <input type="date" name="tanggal" required>

        <label>Bandara Tujuan:</label>
        <select name="bandara_tujuan" required>
            <?php foreach ($bandara_tujuan as $nama => $pajak): ?>
                <option value="<?= $nama ?>"><?= $nama ?></option>
            <?php endforeach; ?>
        </select>

        <label>Harga Tiket:</label>
        <input type="number" name="harga_tiket" required>

        <button type="submit">Daftar</button>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <div class="result">
            <h2>Informasi Penerbangan</h2>
            <p>Nama Maskapai: <?= htmlspecialchars($nama_maskapai) ?></p>
            <p>Nomor: <?= htmlspecialchars($nomor) ?></p>
            <p>Tanggal: <?= htmlspecialchars($tanggal) ?></p>
            <p>Asal Penerbangan: <?= htmlspecialchars($bandara_asal_input) ?></p>
            <p>Tujuan Penerbangan: <?= htmlspecialchars($bandara_tujuan_input) ?></p>
            <p>Harga Tiket: Rp <?= number_format($harga_tiket, 0, ',', '.') ?></p>
            <p>Pajak: Rp <?= number_format($total_pajak, 0, ',', '.') ?></p>
            <p>Total Harga Tiket: Rp <?= number_format($total_harga, 0, ',', '.') ?></p>
        </div>
    <?php endif; ?>
</body>
</html>