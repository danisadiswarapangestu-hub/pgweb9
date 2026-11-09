<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "latihan";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_GET['id'])) {
    header("Location: ../index.php");
    exit();
}

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($id === false || $id === null) {
    header("Location: ../index.php");
    exit();
}

$stmt = $conn->prepare("SELECT * FROM kdkmp_temanggung WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    echo "Data tidak ditemukan!";
    exit();
}

if (isset($_POST['submit'])) {
    $nama_kdkmp = trim($_POST['nama_kdkmp'] ?? '');
    $kecamatan = trim($_POST['kecamatan'] ?? '');
    $kabupaten = trim($_POST['kabupaten'] ?? '');
    $longitude = trim($_POST['longitude'] ?? '');
    $latitude = trim($_POST['latitude'] ?? '');

    if ($nama_kdkmp === '' || $kecamatan === '' || $kabupaten === '' || $longitude === '' || $latitude === '') {
        $error = "Semua field wajib diisi.";
    } else {
        $longitude = (float) $longitude;
        $latitude = (float) $latitude;

        $update = $conn->prepare("UPDATE kdkmp_temanggung SET nama_kdkmp = ?, kecamatan = ?, kabupaten = ?, longitude = ?, latitude = ? WHERE id = ?");
        $update->bind_param("ssssdi", $nama_kdkmp, $kecamatan, $kabupaten, $longitude, $latitude, $id);

        if ($update->execute()) {
            header("Location: ../index.php");
            exit();
        }

        $error = "Gagal mengubah data: " . $update->error;
        $update->close();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data KDKMP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 50px;
        }
        .container {
            max-width: 450px;
            background: #ffffff;
            padding: 30px;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
            color: #555;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .btn-update {
            width: 100%;
            background-color: #222;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            margin-top: 20px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn-update:hover {
            background-color: #444;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            text-decoration: none;
            color: #007bff;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Data KDKMP</h2>

        <?php if (isset($error)): ?>
            <p style="color: red; text-align: center;"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form action="" method="POST">
            <label for="nama_kdkmp">Nama KDKMP</label>
            <input type="text" id="nama_kdkmp" name="nama_kdkmp" value="<?php echo htmlspecialchars($data['nama_kdkmp']); ?>" required>

            <label for="kecamatan">Kecamatan</label>
            <input type="text" id="kecamatan" name="kecamatan" value="<?php echo htmlspecialchars($data['kecamatan']); ?>" required>

            <label for="kabupaten">Kabupaten</label>
            <input type="text" id="kabupaten" name="kabupaten" value="<?php echo htmlspecialchars($data['kabupaten']); ?>" required>

            <label for="longitude">Longitude</label>
            <input type="text" id="longitude" name="longitude" value="<?php echo htmlspecialchars($data['longitude']); ?>" required>

            <label for="latitude">Latitude</label>
            <input type="text" id="latitude" name="latitude" value="<?php echo htmlspecialchars($data['latitude']); ?>" required>

            <button type="submit" name="submit" class="btn-update">Update Data</button>
        </form>

        <a href="../index.php" class="back-link">Kembali ke Halaman Utama</a>
    </div>
</body>
</html>