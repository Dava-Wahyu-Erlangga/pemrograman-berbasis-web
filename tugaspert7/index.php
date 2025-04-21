<?php
include 'koneksi.php';

$query = "SELECT k.id, m.nama AS mahasiswa_nama, mk.nama AS matakuliah_nama
          FROM krs k
          JOIN mahasiswa m ON k.mahasiswa_npm = m.npm
          JOIN matakuliah mk ON k.matakuliah_kodemk = mk.kodemk";
$result = $koneksi->query($query);

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $koneksi->query("DELETE FROM krs WHERE id = '$id'");
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data KRS</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f0f8ff; 
            padding: 40px;
        }

        h2 {
            color: #333;
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            border: 1px solid #ccc;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ccc;
        }

        th {
            background-color: #4a90e2; 
            color: white;
        }

        button {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background-color: #c0392b; 
        }

        a {
            color: #3498db; 
            text-decoration: none;
            font-size: 14px;
            margin-top: 20px;
            display: block;
            text-align: center;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <h2>Data KRS Mahasiswa</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Mahasiswa</th>
                <th>Mata Kuliah</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $counter = 1;
            while ($row = $result->fetch_assoc()):
            ?>
                <tr>
                    <td><?= $counter++ ?></td>  
                    <td><?= $row['mahasiswa_nama'] ?></td>
                    <td><?= $row['matakuliah_nama'] ?></td>
                    <td>
                        <a href="index.php?delete=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this record?');">
                            <button>Delete</button>
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <a href="tambah.php">Tambah Data KRS</a>

</body>
</html>
