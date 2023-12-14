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
      padding: 14px 42px;
    }

    .content h3 {
      font-size: 30px;
      color: #E7AE0E;
    }

    .AsalList .text-primary td:nth-child(1) {
      text-align: center;
      width: 17%;
      padding: 8px;
    }

    .AsalList .bg-white td:nth-child(2),
    .AsalList .bg-white td:nth-child(3) {
      width: 50%;
      height: 100%;
      background: white;
      border-radius: 5px;
      border: 3px #3C8DBB solid;
    }

    .table-tambah {
      background-color: #EBEFF5;
    }

    .form-control {
      width: 100%;
      height: 100%;
      border-radius: 5px;
      border: 3px #3C8DBB solid;
    }
  </style>
</head>
<body>
  <div class="content">
    <h3>List Asal</h3>
    <br>
    <table class="AsalList text-primary">
      <tbody class="text-primary">
        <tr>
          <td>Asal:</td>
          <td class="bg-white">a</td>
          <td>
            <a href="" class="icon_hapus"><img src="asset/hapus,.svg" alt="hapus"></a>
          </td>
        </tr>
        <tr class="bg-white">
          <td></td>
          <td class="bg-white">b</td>
          <td>
            <a href="" class="icon_hapus"><img src="asset/hapus,.svg" alt="hapus"></a>
          </td>
        </tr>
        <tr class="bg-white">
          <td></td>
          <td class="bg-white">c</td>
          <td>
            <a href="" class="icon_hapus"><img src="asset/hapus,.svg" alt="hapus"></a>
          </td>
        </tr>
      </tbody>
    </table>

    <div>
      <br>
      <h3>Tambah Asal</h3>
      <br>
      <table class="table-tambah text-primary">
        <tbody>
          <tr>
            <td><label for="Asal_Barang" class="form-label">Asal Barang:</label></td>
            <td><input type="text" name="nama" id="nama_barang" class="form-control"></td>
          </tr>
          <tr>
            <td><label for="keterangan" class="form-label">Keterangan:</label></td>
            <td><textarea rows="4" cols="50" name="keterangan" id="keterangan" class="form-control"></textarea></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
