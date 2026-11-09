<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Input KDKMP</title>
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
        .btn-submit {
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
        .btn-submit:hover {
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
        <h2>Form Input Data KDKMP</h2>

        <form action="input.php" method="POST">
            <label for="nama_kdkmp">Nama KDKMP</label>
            <input type="text" id="nama_kdkmp" name="nama_kdkmp" required>

            <label for="kecamatan">Kecamatan</label>
            <input type="text" id="kecamatan" name="kecamatan" required>

            <label for="kabupaten">Kabupaten</label>
            <input type="text" id="kabupaten" name="kabupaten" value="KABUPATEN TEMANGGUNG" required>

            <label for="longitude">Longitude</label>
            <input type="text" id="longitude" name="longitude" required>

            <label for="latitude">Latitude</label>
            <input type="text" id="latitude" name="latitude" required>

            <button type="submit" name="submit" class="btn-submit">Simpan Data</button>
        </form>

        <a href="../index.php" class="back-link">Kembali ke Halaman Utama</a>
    </div>
</body>
</html>