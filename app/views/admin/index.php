  <h4 class="fw-bold">Beranda</h4>
  <h3>Selamat Datang</h3>
  <p>Berikut adalah peminjaman barang yang diajukan di website</p>
  <div class="search-wrapper d-flex flex-row">
      <input type="text" class="form-control" id="search" placeholder="Cari barang">
      <button class="btn btn-primary text-white d-flex flex-row">
          Cari
          <img src="<?=BASEURL?>/assets/search.svg" alt="search" class="alt-button search">
      </button>
  </div>
  <!-- SearchBar -->

  <table class="table rounded" id="table">
    <thead class="rounded-top">
      <tr class="bg-primary">
        <th style="border-top-left-radius: 5px;">ID</th>
        <th>Detail Peminjam</th>
        <th>Barang</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Pengembalian</th>
        <th style="border-top-right-radius: 5px;">Aksi</th>
      </tr>
    </thead>
  </table>
  <div class="d-flex flex-row mb-2 mt-5 entries-control">
    Show
    <input type="number" id="num-of-entries" class="form-control form-control-sm" value="10" min="1" max="100">
    entries
  </div>
  <!-- Table -->
  <table class="table table-hover">
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

<script>

    let table = new DataTable("#table", {
        ajax: "<?=BASEURL?>/Admin/getPeminjamanToApprove",
        scrollY: "270px",
        scrollX: true,
        dom: "lrtip",
        columns: [
            {
                data: "id_peminjaman",
                sortable: false,
                render: function(data, type, row) {
                    return ` <div class="td-wrapper"> ${data} </div> `;
                }
            },
            {
                data: "nama_peminjam",
                sortable: false,
                render: function(data, type, row) {
                    return `<div class="td-wrapper text-primary"> ${data} </div>`
                }
            },
            {
                data: "nama_barang",
                sortable: false,
                render: function(data, type, row) {
                    return `<div class="td-wrapper text-primary">${data}</div>`
                },
            },
            {
                data: "tanggal_peminjaman",
                sortable: false,
                render: function(data, type, row) {
                    return ` <div class="td-wrapper">${data}</div>`;
                },
            },
            {
                data: "tanggal_pengembalian",
                sortable: false,
                render: function(data, type, row) {
                    return ` <div class="td-wrapper">${data}</div>`;
                },
            },
            {
                data: null,
                sortable: false,
                render: function(data, type, row) {
                    return `
                        <div class="td-wrapper">
                          <a class="terima"><img class="alt-button terima"
                              src="<?= BASEURL; ?>/assets/check.svg" alt="Terima"></a>
                          <a class="tolak"><img class="alt-button tolak"
                              src="<?= BASEURL; ?>/assets/tolak.svg" alt="Tolak"></a>
                        </div>
                    `;
                },

            },
        ],
        initComplete: () => {
            let search = $("#search");

            search.on("keyup", () => {
                table.search(search.val(), false, true).draw();
            });

            table.on('click', 'tbody .terima', function() {
                let data = table.row($(this).parents('tr')).data();
                window.location.href = `<?=BASEURL?>/Admin/approve/${data.id_peminjaman}`;
            });

            table.on('click', 'tbody .tolak', function() {
                let data = table.row($(this).parents('tr')).data();
                window.location.href = `<?=BASEURL?>/Admin/tolak/${data.id_peminjaman}`;
            });
        }
    });

  <?php
    if (isset($_SESSION['login_success']) && $_SESSION['login_success']) {
        unset($_SESSION['login_success']); 
    ?>
        Swal.fire({
            title: 'Login Berhasil',
            text: 'Selamat Datang!',
            icon: 'success',
            timer: 2000,
            timerProgressBar: true,
        });
    <?php } ?>
</script>
<style>
  :root {
    font-family: Montserrat;
  }

  html,
  body {
    background-color: #EBEFF5;
  }

    table {
        color: var(--bs-primary) !important;
    }


  #content h3 {
    font-size: 30px;
    color: #E7AE0E;
  }

  #content h4 {
    font-size: 20px;
    color: #E7AE0E;
  }

  #content p {
    color: #3C8DBB;
    margin-bottom: 7px;
  }
    .search-wrapper {
        margin: 3px 0 21px 0;
    }


  /* Table 
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
    */

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

    .td-wrapper {
        height: 40px;
    }

</style>
