<?php
include 'koneksi.php';

// Ambil data mahasiswa dan matakuliah
$mhs = $koneksi->query("SELECT npm, nama FROM mahasiswa ORDER BY nama");
$mk = $koneksi->query("SELECT kodemk, nama FROM matakuliah ORDER BY nama");

// Handle submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $npm = $_POST['npm'];
    $kodemk = $_POST['kodemk'];

    $cek = $koneksi->query("SELECT * FROM krs WHERE mahasiswa_npm='$npm' AND matakuliah_kodemk='$kodemk'");
    if ($cek->num_rows == 0) {
        $koneksi->query("INSERT INTO krs (mahasiswa_npm, matakuliah_kodemk) VALUES ('$npm', '$kodemk')");
        header("Location: index.php");
        exit;
    } else {
        $error = "Mahasiswa sudah mengambil mata kuliah tersebut.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah KRS</title>
    <style>
        /* Global reset and font */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #e9f0f7;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* Container for the form */
        .container {
            background-color: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }

        /* Heading */
        h2 {
            color: #333;
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 30px;
            text-align: center;
        }

        /* Form style */
        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-top: 12px;
            font-size: 16px;
            color: #555;
        }

        select,
        button {
            padding: 12px;
            margin-top: 8px;
            font-size: 16px;
            border-radius: 8px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
            outline: none;
        }

        select:focus,
        button:focus {
            border-color: #4CAF50;
        }

        select {
            height: 40px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Error message */
        .error {
            color: #e74c3c;
            font-size: 14px;
            margin-top: 15px;
            text-align: center;
        }

        /* Link */
        a {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #4CAF50;
            font-size: 16px;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .container {
                padding: 20px;
                width: 90%;
            }

            h2 {
                font-size: 24px;
            }

            select, button {
                font-size: 14px;
                padding: 10px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Tambah Data KRS</h2>

        <?php if (isset($error)): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>

        <form method="post">
            <label for="npm">Nama Mahasiswa</label>
            <select name="npm" required>
                <option value="">-- Pilih Mahasiswa --</option>
                <?php while ($row = $mhs->fetch_assoc()): ?>
                    <option value="<?= $row['npm'] ?>"><?= $row['nama'] ?></option>
                <?php endwhile; ?>
            </select>

            <label for="kodemk">Mata Kuliah</label>
            <select name="kodemk" required>
                <option value="">-- Pilih Mata Kuliah --</option>
                <?php while ($row = $mk->fetch_assoc()): ?>
                    <option value="<?= $row['kodemk'] ?>"><?= $row['nama'] ?></option>
                <?php endwhile; ?>
            </select>

            <button type="submit">Simpan</button>
        </form>

        <a href="index.php">← Kembali ke Data KRS</a>
    </div>

</body>
</html>
