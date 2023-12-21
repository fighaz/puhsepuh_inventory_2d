  <h4 class="fw-semibold text-accent">LIST BARANG</h4>
      <p>Berikut adalah list barang yang ada yang tersedia di inventaris</p>
  <div class="search-wrapper d-flex flex-row">
      <input type="text" class="form-control" id="search" placeholder="Cari barang">
      <button class="btn search btn-primary text-white d-flex flex-row">
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
  <!-- The Modal -->
  <div class="modal fade" id="modal-id">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
        <div class="col-10 text-center mx-auto">
          <h4 class="modal-title">Data Barang</h4>
        </div>
        <div class="col-2 text-end">
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        </div>

        <!-- Modal body -->
        <div class="modal-body d-flex">
              <table class="table borderless text-primary fw-semibold">
                  <tbody style="background-color: #EBEFF5;">
                  <tr>
                      <th>ID</th>
                      <td class="modal-id"></td>
                  </tr>
                  <tr>
                      <th>Nama Barang</th>
                      <td class="modal-nama"></td>
                  </tr>
                  <tr>
                      <th>Kuantitas</th>
                      <td class="modal-qty"></td>
                  </tr>
                  <tr>
                      <th>Penanggung Jawab</th>
                      <td class="modal-pnggjawab"></td>
                  </tr>
                  <tr>
                      <th>Asal</th>
                      <td class="modal-asal"></td>
                  </tr>
                  <tr>
                      <th>Keterangan</th>
                      <td class="modal-keterangan"></td>
                  </tr>
                  </tbody>
              </table>
            <div class="d-flex justify-content-end">
              <img id="modal-img" class="border border-2 border-primary rounded mt-3 me-3" src="<?= BASEURL; ?>/img/<?= $brg['gambar']; ?>" alt="Gambar Barang" style="max-width: 280px; max-height: 200px;">
            </div>
        </div>
      </div>
    </div>
  </div>


<script> 
    let table = new DataTable("table#table.table", {
        ajax: "<?=BASEURL?>/Barang/getAll",
        scrollY: "300px",
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
                            <!-- Tombol untuk memanggil modal -->
                            <a href="<?= BASEURL; ?>/Barang/detail/${row.id}" class="icon_info" data-bs-toggle="modal" data-bs-target="#modal-id"><img
                                src="<?= BASEURL; ?>/assets/rincian.svg" class="alt-button rincian" alt=""></a>
                            <a href="<?= BASEURL; ?>/Barang/getUbah/${row.id}" class="icon_edit"><img
                                src="<?= BASEURL; ?>/assets/edit.svg" class="alt-button edit" alt=""></a>
                            <a href="<?= BASEURL; ?>/Barang/hapus/${row.id}" class="icon_remove"><img
                                src="<?= BASEURL; ?>/assets/hapus.svg" class="alt-button hapus" alt=""
                                onclick="return confirm('Apakah Anda yakin untuk menghapus Data Barang berikut?');"></a>
                        </div>
                    `;
                },

            },
        ],
        initComplete: () => {
            $("div.tambah").html(`
                <a href="<?= BASEURL; ?>/Barang/viewTambah" class="btn tambah btn-primary text-white">Tambah Barang<img src="<?=BASEURL?>/assets/add.svg" alt=""></a>
            `);

            let search = $("#search");

            search.on("keyup", () => {
                table.search(search.val(), false, true).draw();
            });
            
            table.on('click', 'tbody .rincian', function () {
                let data = table.row($(this).parents('tr')).data();
                $.ajax({
                    url: "<?= BASEURL; ?>/Barang/detail/" + data.id,
                    dataType: "json",
                    success: function (response, status, xhr) {
                        if (xhr.status != 200) {
                            return;
                        }

                        console.log("", response);
                        $("#modal-img").attr("src", "<?=BASEURL?>/img/" + response.gambar);
                        $(".modal-id").text(response.id_barang);
                        $(".modal-nama").text(response.nama);
                        $(".modal-qty").text(response.jumlah);
                        $(".modal-pnggjawab").text(response.maintainer);
                        $(".modal-asal").text(response.asal);
                        $(".modal-keterangan").text(response.keterangan);

                        // Tampilkan modal
                        $("#modal-id").modal('show');
                    }
                });
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

  #content h4 {
    font-weight: 700;
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
    font-size: 14px;
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

    /* Style modal */
    .modal-body {
      width: 696px;
      height: 409px; 
      border-radius: 5px;
      border: 3px solid #3C8DBB;
      background: #EBEFF5;
      margin: 27px 39px 46px 39px;
    }

    .text {
        flex: 1;
        padding: 0 10px;
    }

    .modal-content {
        width: 774px; 
        height: 550px; 
        border-radius: 5px;
        border: 3px solid #3C8DBB;
        background: #EBEFF5;
        margin: auto; 
    }

    .modal-header h4 {
      color: #E7AD0E;
      font-family: Montserrat;
      font-size: 30px;
      font-style: normal;
      font-weight: 600;
    }

    .borderless th, .borderless td {
      border: none !important;
    }

    .modal-content {
      margin-top: auto;
      margin-bottom: auto;
    }

    .modal {
      position: fixed;
    }

    .modal-dialog {
        max-width: none !important;
    }

    .btn.tambah {
        background-color: var(--bs-success);
        width: 151px;
        height: 33px;
        font-size: 14px;
        padding: 4px 4px 4px 7px;
    }
</style>
