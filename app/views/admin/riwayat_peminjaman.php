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

    tbody td {
      border-bottom: 1px solid #3C8DBB;
    }
    .nav-pills .nav-link.active {
        background-color: #E7AE0E;
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
            <a class="nav-link text-white" href="#">Menunggu</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="#">Pengambilan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="#">Terlambat</a>
        </li>
        <li class="nav-item rounded-end">
            <a class="nav-link text-white" href="#">Selesai</a>
        </li>
        </ul>
    <br>

    <!-- Search bar -->

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
            <a href="" class="icon_rincian"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 35 35" fill="none">
  <path d="M16.417 25.4167H19.417V16.4167H16.417V25.4167ZM17.917 13.4167C18.342 13.4167 18.6985 13.2727 18.9865 12.9847C19.2745 12.6967 19.418 12.3407 19.417 11.9167C19.417 11.4917 19.273 11.1357 18.985 10.8487C18.697 10.5617 18.341 10.4177 17.917 10.4167C17.492 10.4167 17.136 10.5607 16.849 10.8487C16.562 11.1367 16.418 11.4927 16.417 11.9167C16.417 12.3417 16.561 12.6982 16.849 12.9862C17.137 13.2742 17.493 13.4177 17.917 13.4167ZM17.917 32.9167C15.842 32.9167 13.892 32.5227 12.067 31.7347C10.242 30.9467 8.65449 29.8782 7.30449 28.5292C5.95449 27.1792 4.88599 25.5917 4.09899 23.7667C3.31199 21.9417 2.91799 19.9917 2.91699 17.9167C2.91699 15.8417 3.31099 13.8917 4.09899 12.0667C4.88699 10.2417 5.95549 8.65419 7.30449 7.30419C8.65449 5.95419 10.242 4.88569 12.067 4.09869C13.892 3.31169 15.842 2.91769 17.917 2.91669C19.992 2.91669 21.942 3.31069 23.767 4.09869C25.592 4.88669 27.1795 5.95519 28.5295 7.30419C29.8795 8.65419 30.9485 10.2417 31.7365 12.0667C32.5245 13.8917 32.918 15.8417 32.917 17.9167C32.917 19.9917 32.523 21.9417 31.735 23.7667C30.947 25.5917 29.8785 27.1792 28.5295 28.5292C27.1795 29.8792 25.592 30.9482 23.767 31.7362C21.942 32.5242 19.992 32.9177 17.917 32.9167Z" fill="#E7AE0E"/>
</svg></a>
            <a href="" class="icon_selesai"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
  <path d="M15 0C6.75 0 0 6.75 0 15C0 23.25 6.75 30 15 30C23.25 30 30 23.25 30 15C30 6.75 23.25 0 15 0ZM12 22.5L4.5 15L6.615 12.885L12 18.255L23.385 6.87L25.5 9L12 22.5Z" fill="#00B152"/>
</svg></a>
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
