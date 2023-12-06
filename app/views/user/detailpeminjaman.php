<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="../../../public/css/style.css" rel="stylesheet">
  <link href="../../../public/css/bootstrap.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  
  <style>
    :root {
      font-family: Montserrat;
    }         
    * {
      background-color: #EBEFF5;
    }

    .content {
      padding: 14px 42px 14px 42px;
    }

    .content h3 {
      font-size: 30px;
      color: #E7AE0E;
    }

    .biodata-table {
      width: 753px;
      height: 200px;
      flex-shrink: 0;
      margin-bottom: 20px;
      border-collapse: collapse;
    }

    .biodata td {
      padding: 5px;
      border: none;
    }

    .btn-warning,
    .btn-danger {
      width: 110px;
      height: 41px;
      border-radius: 5px;
      color: #fff;
      font-size: 16px;
      margin-top: 10px;
    }

    .btn-warning {
      background: #E7AE0E;
    }

    .btn-danger {
      background: #f00;
    }

    .justify-content-right {
      justify-content: flex-end !important;
    }

    .button-container {
      display: flex;
      justify-content: flex-end;
      margin-top: 10px;
    }

    .btn-warning {
      margin-right: 10px;
    }

    .btn-danger {
      margin-right: 0; /* Adjust as needed */
    }
  </style>
</head>
<body>
  <div class="content">
    <h3>Riwayat Peminjaman</h3>
    <br>
    <table class="biodata-table text-primary">
      <tr>
        <td>Nama</td>
        <td> : </td>
        <td>Alimul</td>
      </tr>
      <tr>
        <td>NIM / NIP</td>
        <td> : </td>
        <td>1233456789</td>
      </tr>
      <tr>
        <td>Status</td>
        <td> : </td>
        <td>Menunggu Konfirmasi</td>
      </tr>
      <tr>
        <td>Mulai Dipinjam</td>
        <td> : </td>
        <td>12 / 04 / 2004</td>
        <td>Sampai</td>
        <td>12 / 04 / 2004</td>
      </tr>
    </table>

    <div class="d-flex flex-row mb-2 entries-control" style="color: #3C8DBB; font-family: Montserrat; font-size: 20px; font-style: normal; font-weight: 600; line-height: normal;">
      Item Dipinjam
    </div>

    <table class="table table-hover">
      <thead>
        <tr class="bg-primary text-white">
          <th>Gambar</th>
          <th>Nama Barang</th>
          <th>Kuantitas</th>
          <th>Catatan</th>
        </tr>
      </thead>
      <tbody class="text-primary">
        <tr class="bg-white">
          <td>Gambar</td>
          <td>Nama Barang</td>
          <td>Kuantitas</td>
          <td>Catatan</td>
        </tr>
      </tbody>
    </table>

    <div class="button-container">
      <button type="button" class="btn btn-warning">Edit</button>
      <button type="button" class="btn btn-danger ml-auto">Batal</button>
    </div>
  </div>
</body>
</html>
