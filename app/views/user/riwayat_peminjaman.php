<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link href="css/style.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">

    <title>Riwayat Peminjaman</title>
    <style>
        h3{
            color: #E7AE0E;
            font-size: 30px;
            font-weight: 700;
            word-wrap: break-word
        }
        /* Style untuk tabel */
.table {
  width: 1110px;
  border-collapse: collapse;
  margin-top: 20px; /* Jarak antara tabel dan elemen di atasnya */
}

/* Style untuk sel header */
.table th {
    color: white;
  background-color: #3C8DBB;
  padding: 10px;
  text-align: left;
  border: 1px solid #ddd;
}

/* Style untuk sel data */
.table td {
  padding: 10px;
  border: 1px solid #ddd;
}


/* Style untuk baris saat dihover */
.table tbody tr:hover {
  background-color: #e0e0e0;
}

/* Style untuk sel rincian (misalnya, tombol rincian) */
.table .details-btn {
  background-color: #4caf50;
  color: white;
  border: none;
  padding: 8px 12px;
  cursor: pointer;
}

/* Style untuk sel rincian saat dihover */
.table .details-btn:hover {
  background-color: #45a049;
}


        
    </style>
  </head>
  <body>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->

    <h3>Riwayat Peminjaman</h3>

    <p>show <span></span> entri</p>

    <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Status Peminjaman</th>
      <th scope="col">Barang</th>
      <th scope="col">Tanggal Peminjaman</th>
      <th scope="col">Tanggal Pengembalian</th>
      <th scope="col">Rincian</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td scope="row"></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td scope="row"></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td scope="row"></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
  </tbody>
</table>

  </body>
</html>

