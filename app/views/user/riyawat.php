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

    /* Table */
    thead {
      font-size: 16px;
      color: #fff;
      font-weight: normal;
      text-align: center;
    }

    thead th {
      border: 2px solid #fff;
    }

    tbody {
      text-align: center;
    }

    tbody td {
      border-bottom: 1px solid #3C8DBB;
    }

    /* Entries */
    #num-of-entries {
      background-color: var(--background-global);
      color: var(--bs-primary);
      max-width: 50px;
      max-height: 10px;
      height: 10px;
      margin: 0 5px;
      font-size: 12px;
      padding: 0 0 0 15px;
      border: 1px solid var(--bs-primary);
    }

  </style>
</head>
<body>
  <div class="content">
    <h3>Riwayat Peminjaman</h3>
    <br>

    <!-- HTML -->
    <div class="search">
      <input type="text" class="form-control">
      <button class="btn btn-primary">
        Search <i class="fa fa-search"></i> 
        <img src="asset/search.svg" alt="">  
      </button>
    </div>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Style -->
    <style>
      /* Search */
      .search button{
        top: 5px;
        right: 5px;
        height: 54px;
        width: 160px;
        background: #3C8DBB;
      }

      .search {
        display: flex;
        align-items: center;
      }

      .search input {
        height: 54px;
        width: 734;
        border-radius: 5px;
        border: 3px solid #3C8DBB;
        display: flex;
        align-items: center;
        margin-right: 10px;
      }
    </style>

    <!-- Table -->
    <br>
    <div class="d-flex flex-row mb-2 entries-control">
      Show 
      <input type="number" id="num-of-entries" class="form-control form-control-sm" value="10" min="1" max="100">
      entries
    </div>
    <table class="table table-hover">
      <thead>
        <tr class="bg-primary">
          <th>ID</th>
          <th>Status peminjaman</th>
          <th>Barang</th>
          <th>Tanggal Pinjam</th>
          <th>Tanggal Pengembalian</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody class="text-primary">
        <tr class="bg-white">
          <td>ID</td>
          <td><span class="badge rounded-pill bg-primary">dipinjam</span></td>
          <td>Barang</td>
          <td>Tanggal Pinjam</td>
          <td>Tanggal Pengembalian</td>
          <td>
            <a href="" class="icon_edit"><img src="asset/edit.svg" alt="edit"></a>
            <a href="" class="icon_tolak"><img src="asset/tolak.svg" alt="Tolak"></a>
            <a href="" class="icon_rincian"><img src="asset/rincian.svg" alt="rincian"></a>
          </td>
        </tr>
        <tr class="bg-white">
          <td>ID</td>
          <td><span class="badge rounded-pill bg-secondary">Menunggu Konfirmasi</span></td>
          <td>Barang</td>
          <td>Tanggal Pinjam</td>
          <td>Tanggal Pengembalian</td>
          <td>
            <a href="" class="icon_edit"><img src="asset/edit.svg" alt="edit"></a>
            <a href="" class="icon_tolak"><img src="asset/tolak.svg" alt="Tolak"></a>
            <a href="" class="icon_rincian"><img src="asset/rincian.svg" alt="rincian"></a>
          </td>
        </tr>
        </tr>
        <tr class="bg-white">
          <td>ID</td>
          <td><span class="badge rounded-pill bg-warning text-dark">Menunggu diambil</span></td>
          <td>Barang</td>
          <td>Tanggal Pinjam</td>
          <td>Tanggal Pengembalian</td>
          <td>
            <a href="" class="icon_edit"><img src="asset/edit.svg" alt="edit"></a>
            <a href="" class="icon_tolak"><img src="asset/tolak.svg" alt="Tolak"></a>
            <a href="" class="icon_rincian"><img src="asset/rincian.svg" alt="rincian"></a>
          </td>
        </tr>
        <tr class="bg-white">
          <td>ID</td>
          <td><span class="badge rounded-pill bg-danger">Ditolak</span></td>
          <td>Barang</td>
          <td>Tanggal Pinjam</td>
          <td>Tanggal Pengembalian</td>
          <td>
            <a href="" class="icon_edit"><img src="asset/edit.svg" alt="edit"></a>
            <a href="" class="icon_tolak"><img src="asset/tolak.svg" alt="Tolak"></a>
            <a href="" class="icon_rincian"><img src="asset/rincian.svg" alt="rincian"></a>
          </td>
        </tr>
        <tr class="bg-white">
          <td>ID</td>
          <td><span class="badge rounded-pill bg-success">Selesai</span></td>
          <td>Barang</td><s></s>
          <td>Tanggal Pinjam</td>
          <td>Tanggal Pengembalian</td>
          <td>
            <a href="" class="icon_edit"><img src="asset/edit.svg" alt="edit"></a>
            <a href="" class="icon_tolak"><img src="asset/tolak.svg" alt="Tolak"></a>
            <a href="" class="icon_rincian"><img src="asset/rincian.svg" alt="rincian"></a>
          </td>
        </tr>
        <tr class="bg-white">
          <td>ID</td>
          <td><span class="badge rounded-pill bg-info text-dark">Terlambat</span></td>
          <td>Barang</td><s></s>
          <td>Tanggal Pinjam</td>
          <td>Tanggal Pengembalian</td>
          <td>
            <a href="" class="icon_edit"><img src="asset/edit.svg" alt="edit"></a>
            <a href="" class="icon_tolak"><img src="asset/tolak.svg" alt="Tolak"></a>
            <a href="" class="icon_rincian"><img src="asset/rincian.svg" alt="rincian"></a>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="pagination-wrapper d-flex flex-row justify-content-between">
      <div class="intries-showed mt-2"> 
        Showing 1 to 10 of 100 entries
      </div>
      <nav class="navigation">
        <ul class="pagination">
          <li class="page-item"><a class="page-link" href="#table">Previous</a></li>
          <li class="page-item"><a class="page-link" href="#table">1</a></li>
          <li class="page-item"><a class="page-link" href="#table">2</a></li>
          <li class="page-item"><a class="page-link" href="#table">3</a></li>
          <li class="page-item"><a class="page-link" href="#table">Next</a></li>
        </ul>
      </nav>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
  </body>
</html>
