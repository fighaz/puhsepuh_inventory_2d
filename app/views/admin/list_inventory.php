    <h3 class="fw-semibold text-accent">LIST BARANG</h3>
    <p>Berikut adalah list barang yang ada yang tersedia di inventaris</p>
<div class="search-wrapper d-flex flex-row">
    <input type="text" class="form-control" id="search" placeholder="Cari barang">
    <button class="btn btn-primary text-white d-flex flex-row">
        Cari
        <img src="<?=BASEURL?>/assets/search.svg" alt="search" class="alt-button search">
    </button>
</div>
  <table class="table rounded" id="table">
    <thead class="rounded-top">
      <tr class="bg-primary">
        <th style="border-top-left-radius: 5px;">ID</th>
        <th>Gambar</th>
        <th>Nama Barang</th>
        <th>Kuantitas</th>
        <th>Penanggung Jawab</th>
        <th>Asal</th>
        <th style="border-top-right-radius: 5px;">Aksi</th>
      </tr>
    </thead>
  </table>
    <!-- Table -->
    <div class="container-table">
      <div class="d-flex flex-row mb-2 entries-control">
        Show
        <input type="number" id="num-of-entries" class="form-control form-control-sm" value="10" min="1" max="100">
        entries
      </div>
      <table class=" table-hover">
        <tbody class="text-primary">
          <?php $no = 1;
          if (empty($data['brg'])): ?>
            <tr>
              <td colspan="7">
                <div class="alert alert-danger" role="alert">
                  Tidak ada data terkait.
                </div>
              </td>
            </tr>
          <?php else:
            foreach ($data['brg'] as $brg): ?>
              <tr class="bg-white text-primary align-middle">
                <td>
                  <?= $no++ ?>
                </td>
                <td>
                  <img src="<?= BASEURL; ?>/img/<?= $brg['gambar']; ?>" class="object-fit-cover border rounded" alt="" width="98px" height="70px">
                </td>

                <td>
                  <?= $brg['nama']; ?>
                </td>
                <td>
                  <?= $brg['tersedia']; ?> /
                  <?= $brg['jumlah']; ?>
                </td>
                <td>
                  <?= $brg['maintainer']; ?>
                </td>
                <td>
                  <?= $brg['asal']; ?>
                </td>
                <td>
                  <a href="/" class="icon_info"><img src="<?= BASEURL; ?>/assets/rincian.svg" alt=""></a>
                  <a href="<?= BASEURL; ?>/Barang/getUbah/<?= $brg['id']; ?>" class="icon_edit"><img
                      src="<?= BASEURL; ?>/assets/edit.svg" alt=""></a>
                  <a href="<?= BASEURL; ?>/Barang/hapus/<?= $brg['id']; ?>" class="icon_remove"><img
                      src="<?= BASEURL; ?>/assets/hapus.svg" alt=""
                      onclick="return confirm('Apakah Anda yakin untuk menghapus Data Barang berikut?');"></a>
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

<script> 
    let table = new DataTable("table#table.table", {
        ajax: "<?=BASEURL?>/Barang/getAll",
        scrollY: "280px",
        scrollX: true,
        dom: '<"top-table"l<"tambah">>rtip',
        columns: [
            {
                data: "id",
                sortable: false,
                render: function(data, type, row) {
                    return ` <div class="td-wrapper"> ${data} </div> `;
                }
            },
            {
                data: "gambar",
                sortable: false,
                render: function(data, type, row) {
                    return `
                        <div class="td-wrapper text-primary">
                        <img src="<?=BASEURL?>/img/${data}" style="object-fit: cover;" class="border rounded" alt="" width="98px" height="70px">
                        </div>
                      `;
                }
            },
            {
                data: "nama",
                sortable: false,
                render: function(data, type, row) {
                    return ` <div class="td-wrapper">${data}</div>`;
                },
            },
            {
                data: null,
                sortable: false,
                render: function(data, type, row) {
                    return `<div class="td-wrapper text-primary">${row.tersedia} / ${row.jumlah}</div>`
                },
            },
            {
                data: "maintainer",
                sortable: false,
                render: function(data, type, row) {
                    return ` <div class="td-wrapper">${data}</div>`;
                },
            },
            {
                data: "asal",
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
                          <a href="/" class="icon_info"><img src="<?= BASEURL; ?>/assets/rincian.svg" alt=""></a>
                          <a href="<?= BASEURL; ?>/Barang/getUbah/<?= $brg['id']; ?>" class="icon_edit"><img
                              src="<?= BASEURL; ?>/assets/edit.svg" alt=""></a>
                          <a href="<?= BASEURL; ?>/Barang/hapus/<?= $brg['id']; ?>" class="icon_remove"><img
                              src="<?= BASEURL; ?>/assets/hapus.svg" alt=""
                              onclick="return confirm('Apakah Anda yakin untuk menghapus Data Barang berikut?');"></a>
                        </div>
                    `;
                },

            },
        ],
        initComplete: () => {
            $("div.tambah").html(`
                <a href="<?= BASEURL; ?>/Barang/viewTambah" class="btn btn-primary text-white">Tambah</a>
            `);

            let search = $("#search");

            search.on("keyup", () => {
                table.search(search.val(), false, true).draw();
            });
        }
    });
</script>

<style>
  :root {
    font-family: Montserrat;
  }

  body {
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

    .search-wrapper {
        margin: 10px 0 21px 0;
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

  .nav-item {
    background-color: #3C8DBB !important;
  }

    .top-table {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .td-wrapper {
        color: var(--bs-primary) !important;
    }
</style>
