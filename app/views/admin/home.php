<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  
  <style>
    * {
      font-family: Montserrat;
      background: #EBEFF5;
    }         

    .content {
      padding: 14px 42px 14px 42px;
    }
    .content h2 {
      font-size: 40px;
      color: #E7AE0E;
    }

    .content h3 {
      font-size: 30px;
      color: #E7AE0E;
    }

    .content p {
      color: #3C8DBB;
    }
  </style>
</head>
<body>
<div class="content">
  <h3>Beranda</h3>
  <h2>Selamat Datang</h2>
  <p>Berikut adalah peminjaman barang yang diajukan di website</p>
      
  <!-- SearchBar -->

  <!-- Table -->
  <table class="table table-hover">
    <thead>
      <tr class="table-primary">
          <th>ID</th>
          <th>Detail Peminjam</th>
          <th>Barang</th>
          <th>Tanggal Pinjam</th>
          <th>Tanggal Pengembalian</th>
          <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
    <tbody>
      <tr>
        <td>ID</td>
        <td>Detail Pinjam</td>
        <td>Barang</td>
        <td>Tanggal Pinjam</td>
        <td>Tanggal Pengembalian</td>
        <td>
          <a href=""><img src="asset/terima.svg" alt="Terima"></a>
          <a href=""><img src="asset/tolak.svg" alt="Tolak"></a>
        </td>
      </tr>
    </tbody>

    </tbody>
  </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>
</html>