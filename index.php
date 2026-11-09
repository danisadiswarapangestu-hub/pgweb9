<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "latihan";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM kdkmp_temanggung ORDER BY id ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Web GIS KDKMP Temanggung</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background-color: #f9f9f9;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            background: #fff;
            margin-top: 10px;
            box-shadow: 0px 0px 5px rgba(0,0,0,0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .btn-input {
            text-decoration: none;
            background-color: #333;
            color: white;
            padding: 6px 12px;
            border-radius: 4px;
            display: inline-block;
            margin-bottom: 15px;
        }
        .btn-input:hover {
            background-color: #555;
        }
        .btn-edit {
            color: #28a745;
            text-decoration: none;
            font-weight: bold;
        }
        .btn-hapus {
            color: #dc3545;
            text-decoration: none;
            font-weight: bold;
        }
        .btn-edit:hover, .btn-hapus:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <h2 style="text-align: center;">Data KDKMP Kabupaten Temanggung</h2>

    <a href="input/index.php" class="btn-input">➕ Input Data</a>

    <?php
    if ($result && $result->num_rows > 0) {
        echo "<table><tr>
        <th>ID</th>
        <th>Nama KDKMP</th>
        <th>Kecamatan</th>
        <th>Kabupaten</th>
        <th>Longitude</th>
        <th>Latitude</th>
        <th>Aksi</th>
        </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
            <td>" . htmlspecialchars($row["id"]) . "</td>
            <td>" . htmlspecialchars($row["nama_kdkmp"]) . "</td>
            <td>" . htmlspecialchars($row["kecamatan"]) . "</td>
            <td>" . htmlspecialchars($row["kabupaten"]) . "</td>
            <td>" . htmlspecialchars($row["longitude"]) . "</td>
            <td>" . htmlspecialchars($row["latitude"]) . "</td>
            <td>
                <a href='edit/edit.php?id=" . (int)$row["id"] . "' class='btn-edit'>Edit</a> |
                <a href='delete.php?id=" . (int)$row["id"] . "' class='btn-hapus' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'>Hapus</a>
            </td>
            </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>0 results</p>";
    }

    $conn->close();
    ?>

</body>
</html>
