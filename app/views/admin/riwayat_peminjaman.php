  <style>
    :root {
      font-family: Montserrat;
    }         
    html, body {
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
      background-color: #3C8DBB;
      font-weight: normal;
      text-align: center;

    }

    thead th {
      border: 2px solid #fff;
      color: #3C8DBB;
    }

    tbody {
      text-align: center;
    }
    /* td, th {
      color: #3C8DBB;
    }

    tbody tr:nth-child(odd) {
    background-color: #EBEFF5;
    }

    tbody tr:nth-child(even) {
    background-color: #fff; 
    } */

    tbody td {
      border-bottom: 1px solid #3C8DBB;
    }
    .nav-pills .nav-link.active {
        background-color: #E7AE0E;
        font-size: 25;
    }
    .nav-item  {
        background-color: #3C8DBB !important;
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

  <div class="content">
    <h3>Peminjaman</h3>
    <br>
      <!-- NavTabs -->
      <div class="container-tabs rounded mt-2 fs-5 fw-semibold">
    <ul class="nav nav-pills primary nav-fill rounded">
    <li class="nav-item rounded-start">
        <a class="nav-link active bg-accent" aria-current="page" href="#">Semua</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-white" href="#">Barang Diminta</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-white" href="#">Sedang Dipinjam</a>
    </li>
    <li class="nav-item rounded-end">
        <a class="nav-link text-white" href="#">Segera Diikembalikan</a>
    </li>
    </ul>
    <br>

    <!-- HTML -->
    <div class="search">
      <input type="text" class="form-control">
      <button class="btn btn-primary">
        Search <i class="fa fa-search"></i> 
        <img src="asset/search.svg" alt="">  
      </button>
    </div>

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
<table class="table table-hover table-bordered">
  <thead class="">
    <tr class="bg-primary">
      <th>ID</th>
      <th>Nama Peminjam</th>
      <th>Status peminjaman</th>
      <th>Barang</th>
      <th>Tanggal Pinjam</th>
      <th>Aksi</th>
    </tr>
  </thead>
      <tbody class="text-primary">
        <tr class="bg-white">
          <td>ID</td>
          <td>Alim</td>
          <td><span class="badge rounded-pill bg-secondary">Menunggu</span></td>
          <td>Remote</td>
          <td>19/10/2023</td>
          <td>
            <a href="" class="icon_rincian"><img src="asset/rincian.svg" alt="rincian"></a>
            <a href="" class="icon_selesai"><img src="asset/selesai.svg" alt="Selesai"></a>
          </td>
        </tr>
        <tr class="bg-white">
          <td>ID</td>
          <td>Febiola Lidya S.</td>
          <td><span class="badge rounded-pill bg-warning">Pengambilan</span></td>
          <td>Proyektor Remote Laptop Charger</td>
          <td>20/10/2023</td>
          <td>
            <a href="" class="icon_rincian"><img src="asset/rincian.svg" alt="rincian"></a>
            <a href="" class="icon_selesai"><img src="asset/selesai.svg" alt="Selesai"></a>
          </td>
        </tr>
        </tr>
        <tr class="bg-white">
          <td>ID</td>
          <td>Fighaz</td>
          <td><span class="badge rounded-pill bg-danger">Terlambat</span></td>
          <td>Remote</td>
          <td>19/10/2023</td>
          <td>
            <a href="" class="icon_rincian"><img src="asset/rincian.svg" alt="rincian"></a>
            <a href="" class="icon_selesai"><img src="asset/selesai.svg" alt="Selesai"></a>
          </td>
        </tr>
        <tr class="bg-white">
          <td>ID</td>
          <td>Dhio Atlon</td>
          <td><span class="badge rounded-pill bg-success">Selesai</span></td>
          <td>Proyektor Remote</td>
          <td>20/10/2023</td>
          <td>
            <a href="" class="icon_rincian"><img src="asset/rincian.svg" alt="rincian"></a>
            <a href="" class="icon_selesai"><img src="asset/selesai.svg" alt="Selesai"></a>
          </td>
        </tr>
        <tr class="bg-white">
          <td>ID</td>
          <td>Denny Malik</td>
          <td><span class="badge rounded-pill bg-success">Selesai</span></td>
          <td>Remote</td><s></s>
          <td>19/10/2023</td>
          <td>
            <a href="" class="icon_rincian"><img src="asset/rincian.svg" alt="rincian"></a>
            <a href="" class="icon_selesai"><img src="asset/selesai.svg" alt="Selesai"></a>
          </td>
        </tr>
        <tr class="bg-white">
          <td>ID</td>
          <td>Lenka Mleinda</td>
          <td><span class="badge rounded-pill bg-success">Selesai</span></td>
          <td>Remote</td><s></s>
          <td>19/10/2023</td>
          <td>
            <a href="" class="icon_rincian"><img src="asset/rincian.svg" alt="rincian"></a>
            <a href="" class="icon_selesai"><img src="asset/selesai.svg" alt="Selesai"></a>
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
