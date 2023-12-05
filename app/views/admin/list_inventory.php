<!DOCTYPE html>
<html lang="en">
<head>
    <title>List Barang</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../../../public/css/style.css" rel="stylesheet">
    <link href="../../../public/css/bootstrap.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
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

    tbody td{
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
    .container-table {
        margin-top: 20px; 
    }

    .container-tabs {
        font-size: 25px;
    }

    .nav-pills .nav-link.active {
        background-color: #E7AE0E;
        font-size: 25;
    }
    .nav-item{
        background-color: #3C8DBB !important;
    }
  </style>
</head>
<body>
<div class="content">
  <h3>List Barang</h3>
  <p>Berikut adalah list barang yang ada yang tersedia di inventaris</p>
  
  <!-- NavTabs -->
  <div class="container-tabs rounded mt-2 fs-5 fw-semibold">
    <ul class="nav nav-pills nav-fill rounded">
    <li class="nav-item rounded-start">
        <a class="nav-link active" aria-current="page" href="#">Semua</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-white" href="#">Dibeli</a>
    </li>
    <li class="nav-item rounded-end">
        <a class="nav-link text-white" href="#">Hibah</a>
    </li>
    </ul>
  </div>
  <!-- SearchBar -->


  <!-- Table -->
  <div class="container-table">
  <div class="d-flex flex-row mb-2 entries-control">
                    Show 
                    <input type="number" id="num-of-entries" class="form-control form-control-sm" value="10" min="1" max="100">
                    entries
                </div>
  <table class="table table-hover">
    <thead>
      <tr class="bg-primary">
          <th>Gambar</th>
          <th>ID</th>
          <th>Nama Barang</th>
          <th>Kuantitas</th>
          <th>Penanggung Jawab</th>
          <th>Asal</th>
          <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
    <tbody class="text-primary">
      <tr class="bg-white">
        <td>Gambar</td>
        <td>ID</td>
        <td>Nama Barang</td>
        <td>Kuantitas</td>
        <td>Penanggung Jawab</td>
        <td>Asal</td>
        <td>
          <a href="" class="icon_info"><img src="asset/info.svg" alt="Rincian"></a>
          <a href="" class="icon_edit"><img src="asset/edit.svg" alt="Edit"></a>
          <a href="" class="icon_remove"><img src="asset/remove.svg" alt="Remove"></a>
        </td>
      </tr>
    </tbody>
  </table>
  <div class="pagination-wrapper d-flex flex-row justify-content-between">
                    <div class="intries-showed mt-2 text-primary"> 
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
</div>
  </div>
</body>
</html>