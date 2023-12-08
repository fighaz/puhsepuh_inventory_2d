<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="../../../public/css/style.css" rel="stylesheet">
    <link href="../../../public/css/bootstrap.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-3">
  <h3>Modal Example</h3>
  <p>Click on the button to open the modal.</p>
  
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#rincian">
    Open modal
  </button>
</div>

<!-- The Modal -->
<div class="modal" id="rincian">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="col-12 modal-title text-center">Data Barang</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="d-flex justify-content-end">
          <img class="border border-2 border-primary rounded mt-3 me-3" src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f7/Nuon-N2000-Remote-Control.jpg/800px-Nuon-N2000-Remote-Control.jpg" alt="Remote Control" style="max-width: 280px; max-height: 200px; position: absolute; top: 0; right: 0;">
        </div>
        <div class="text mt-2">
          <table class="table text-primary">
            <tr>
              <th>ID</th>
              <td>B11</td>
            </tr>
            <tr>
              <th>Nama Barang</th>
              <td>Spidol</td>
            </tr>
            <tr>
              <th>Kuantitas</th>
              <td>12</td>
            </tr>
            <tr>
              <th>Penanggung Jawab</th>
              <td>B11</td>
            </tr>
            <tr>
              <th>Asal</th>
              <td>Hibah</td>
            </tr>
            <tr>
              <th>Keterangan</th>
              <td>
                Air Conditioner dapat ditemukan dalam peminjaman, sehingga dapat
                dilakukan peminjaman kembali tanpa harus berharap dipasangin,
                jangan manja pasang sendiri ya teman teman. Terimakasih
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Style -->
<style>
    .modal-content {
    width: 774px; 
    height: 550px; 
    border-radius: 5px;
    border: 3px solid #3C8DBB;
    background: #EBEFF5;
    margin: auto; 
}

.modal-body {
    width: 696px;
    height: 409px; 
    border-radius: 5px;
    border: 3px solid #3C8DBB;
    background: #EBEFF5;
    margin: 27px 39px 46px 39px;
}

.modal-header h4 {
    color: #E7AD0E;
font-family: Montserrat;
font-size: 30px;
font-style: normal;
font-weight: 600;
}

</style>
</body>
</html>
