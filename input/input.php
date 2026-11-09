<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "latihan";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $nama_kdkmp = trim($_POST['nama_kdkmp'] ?? '');
    $kecamatan = trim($_POST['kecamatan'] ?? '');
    $kabupaten = trim($_POST['kabupaten'] ?? '');
    $longitude = trim($_POST['longitude'] ?? '');
    $latitude = trim($_POST['latitude'] ?? '');

    if ($nama_kdkmp === '' || $kecamatan === '' || $kabupaten === '' || $longitude === '' || $latitude === '') {
        echo "Semua field wajib diisi.";
        exit();
    }

    $longitude = (float) $longitude;
    $latitude = (float) $latitude;

    $stmt = $conn->prepare("INSERT INTO kdkmp_temanggung (nama_kdkmp, kecamatan, kabupaten, longitude, latitude) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssd", $nama_kdkmp, $kecamatan, $kabupaten, $longitude, $latitude);

    if ($stmt->execute()) {
        header("Location: ../index.php");
        exit();
    }

    echo "Error: " . $stmt->error;
    $stmt->close();
}

$conn->close();
?>