<style>
  :root {
    font-family: Montserrat;
  }

  html,
  body {
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
<div class="content">
  <h3 class="fw-bold">Beranda</h3>
  <h2>Selamat Datang</h2>
  <p>Berikut adalah peminjaman barang yang diajukan di website</p>
  <!-- SearchBar -->


  <div class="d-flex flex-row mb-2 entries-control">
    Show
    <input type="number" id="num-of-entries" class="form-control form-control-sm" value="10" min="1" max="100">
    entries
  </div>
  <!-- Table -->
  <table class="table table-hover" id="table">
    <thead>
      <tr class="bg-primary">
        <th>ID</th>
        <th>Detail Peminjam</th>
        <th>Barang</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Pengembalian</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody class="text-primary">
      <?php if (empty($data['pnj'])): ?>
        <tr>
          <td colspan="7">
            <div class="alert alert-danger" role="alert">
              Tidak ada data terkait.
            </div>
          </td>
        </tr>
      <?php else:
        foreach ($data['pnj'] as $pnj): ?>
          <tr class="bg-white align-middle">
            <td>
              <?= $pnj['id_peminjaman']; ?>
            </td>
            <td>
              <?= $pnj['nama_peminjam']; ?>
            </td>
            <td>
              <?= $pnj['nama_barang']; ?>
            </td>
            <td>
              <?= $pnj['tanggal_peminjaman']; ?>
            </td>
            <td>
              <?= $pnj['tanggal_pengembalian']; ?>
            </td>
            <td>
              <a href="<?= BASEURL; ?>/Admin/approve/<?= $pnj['id_peminjaman']; ?>" class="icon_terima"><img
                  src="<?= BASEURL; ?>/assets/terima.svg" alt="Terima"></a>
              <a href="<?= BASEURL; ?>/Admin/tolak/<?= $pnj['id_peminjaman']; ?>" class="icon_tolak"><img
                  src="<?= BASEURL; ?>/assets/tolak.svg" alt="Tolak"></a>
            </td>
          </tr>
        <?php endforeach;
      endif; ?>
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