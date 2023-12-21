  <h4 class="fw-bold">BERANDA</h4>
  <h3>Selamat Datang
      <span id="nama_user">
          <?=$_SESSION['nama']?>
      </span>
  </h3>
  <p>Berikut adalah peminjaman barang yang diajukan di website</p>
  <div class="search-wrapper d-flex flex-row">
      <input type="text" class="form-control" id="search" placeholder="Cari barang">
      <button class="btn search btn-primary text-white d-flex flex-row">
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
<script>

    let table = new DataTable("#table", {
        ajax: "<?=BASEURL?>/Admin/getPeminjamanToApprove",
        order: [[0, "desc"]],
        scrollY: "260px",
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
                          <a class="terima"><img class="alt-button terima" title="Terima"
                              src="<?= BASEURL; ?>/assets/check.svg" alt="Terima"></a>
                          <a class="tolak"><img class="alt-button tolak" title="Tolak"
                              src="<?= BASEURL; ?>/assets/tolak.svg" alt="Tolak"></a>
                          <a class="edit"><img class="alt-button edit" title="Edit"
                              src="<?= BASEURL; ?>/assets/edit.svg" alt="Edit"></a>
                          <a class="rincian"><img class="alt-button rincian" title="Rincian"
                              src="<?= BASEURL; ?>/assets/rincian.svg" alt="Rincian"></a>
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

            table.on('click', 'tbody .edit', function() {
                let data = table.row($(this).parents('tr')).data();
                window.location.href = `<?=BASEURL?>/Admin/ubahPeminjaman/${data.id_peminjaman}/1`;
            });

            table.on('click', 'tbody .rincian', function() {
                let data = table.row($(this).parents('tr')).data();
                window.location.href = `<?=BASEURL?>/Admin/detailPeminjaman/${data.id_peminjaman}/1`;
            });
        }
    });
  
  // Sweet Alert
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
          }).then(function () {
              <?php $_SESSION['login_success'] = false; ?>
          });
      </script>
  <?php } ?>
</script>
<style>
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
.alt-button {
    width:  35px;
    height: 35px;
}

#nama_user {
    font-weight: 900;
}

</style>
