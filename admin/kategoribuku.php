<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" >
	<title>KATEGORI BUKU</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
  integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
	<div class ="container text-center">
	<div class="content mt-3">
        <div class="card-body text-center">
		<div class="card bg-success bg-gradient">
			<div class="card-body">
					
            <a href="http://localhost/digitallibrary/admin/" class ="btn text-light">HOME</a>
				<a href="http://localhost/digitallibrary/admin/kategoribuku.php" class ="btn text-light">KATEGORI BUKU</a>
				<a href="http://localhost/digitallibrary/admin/tampil_buku.php" class ="btn text-light">BUKU</a>
				<a href="http://localhost/digitallibrary/admin/user/tampil_user.php" class ="btn text-light" >USERS</a>
                <a href="http://localhost/digitallibrary/peminjam/form_peminjaman.php/" class ="btn text-light">PEMINJAMAN</a>
				<a href="http://localhost/digitallibrary/peminjam/laporanpeminjam.php" class ="btn text-light">LAPORAN PEMINJAMAN</a>
				<a href="../logout.php" class ="btn text-light">LOGOUT</a>
			</div>
		</div>
	</div>
</div>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Buku</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h2 {
            color: #333;
        }

        #categoryForm {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            font-size: 16px;
            margin-bottom: 10px;
        }

        input {
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        button {
            padding: 10px;
            font-size: 16px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color:  #3498db;
        }

        table {
            width: 50%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;

            text-align: left;
        }

        th {
            background-color: #3498db;
            color: white;
        }

        .deleteButton {
            background-color: #f44336;
        }

        .deleteButton:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <div class="card-body text-center"><h2><b>KATEGORI BUKU<b></h2>

    <form id="formKategori">
        <label for="NamaKategori">Nama Kategori:</label>
        <input type="text" id="NamaKategori" name="NamaKategori" placeholder="Masukkan Nama Kategori">
        <button type="submit" onclick="tambahKategori()">Tambah Kategori</button>
    </form>
    </div>

    
    
    <table id="tableKategori">
        <tr>
            <th>Kategori ID</th>
            <th>Nama Kategori</th>
            <th>Aksi</th>
        </tr>
    </table>
    
    <script>
        function tambahKategori() {
            var NamaKategori = document.getElementById("NamaKategori").value;

            if (NamaKategori) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "tambah_kategori.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        alert(xhr.responseText);
                        if (xhr.responseText.includes("berhasil")) {
                            tampilkanData();
                        }
                    }
                };
                xhr.send("NamaKategori=" + NamaKategori);
            } else {
                alert("Mohon isi Nama Kategori");
            }
        }

        function hapusKategori(KategoriID) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "hapus_kategori.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert(xhr.responseText);
                    if (xhr.responseText.includes("berhasil")) {
                        tampilkanData();
                    }
                }
            };
            xhr.send("KategoriID=" + KategoriID);
        }

        function tampilkanData() {
            var table = document.getElementById("tableKategori");
            table.innerHTML = "<tr><th>Kategori ID</th><th>Nama Kategori</th><th>Aksi</th></tr>";

            var xhr = new XMLHttpRequest();
            xhr.open("GET", "data_kategori.php", true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var dataKategori = JSON.parse(xhr.responseText);

                    dataKategori.forEach(function (kategori) {
                        var newRow = table.insertRow(-1);
                        var cell1 = newRow.insertCell(0);
                        var cell2 = newRow.insertCell(1);
                        var cell3 = newRow.insertCell(2);
                        cell1.innerHTML = kategori.KategoriID;
                        cell2.innerHTML = kategori.NamaKategori;

                        var deleteButton = document.createElement("button");
                        deleteButton.innerHTML = "Hapus";
                        deleteButton.className = "deleteButton";
                        deleteButton.onclick = function () {
                            hapusKategori(kategori.KategoriID);
                        };

                        cell3.appendChild(deleteButton);
                    });

                    
                }
            };
            xhr.send();
        }

        tampilkanData();
    </script>

</body>
</html>
