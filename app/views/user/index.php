<div id="alert" class="alert alert-danger d-flex justify-content-between" role="alert" style="height: 30px; padding: 0.2rem 1.25rem;">
    <div class="message">
      Password belum diganti.
      Mohon untuk segera mengganti password.
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="max-width: 5px; max-height: 5px; margin-top: 5px;"></button>
</div>
<h5 class="fw-bold text-accent" style="margin-left: 10px">BERANDA</h5>
<div id="welcome" class="title text-accent">
    SELAMAT DATANG
    <span class="nama"> Alim </span>
</div>
<div class="subtitle mb-4">Berikut ini daftar barang yang tersedia di JTI</div>
<div class="search-wrapper d-flex flex-row">
    <input type="text" class="form-control" id="search" placeholder="Cari barang">
    <button class="btn search btn-primary text-white d-flex flex-row">
        Cari
        <img src="<?=BASEURL?>/assets/search.svg" alt="search" class="alt-button search">
    </button>
</div>
<div class="container tables">
    <div class="tabel-barang">
        <table id="table" class="table table-stripped rounded">
            <thead class="bg-primary rounded-top">
                <tr>
                    <th style="border-top-left-radius: 5px;">Gambar</th>
                    <th class="">Nama</th>
                    <th class="">Kuantitas</th>
                    <th style="border-top-right-radius: 5px;">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
    <div class="peminjaman">
        <div class="list-items">
            <table id="keranjang">
                <thead class="bg-primary rounded-top">
                    <tr>
                        <th class="rounded-top">Keranjang</th>
                    </tr>
                </thead>
            </table>
            <div class="proses">
                <button class="p-1 btn btn-success btn-lg text-white">
                    Proses
                </button>
            </div>
        </div>
    </div>
</div>


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
<!--
                  <tr>
                      <th>Penanggung Jawab</th>
                      <td class="modal-pnggjawab"></td>
                  </tr>
-->
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

    $(document).ready(() => {
        
        <?php if ($_SESSION['has_changed_password']) { ?>
            $("#alert").addClass("d-none");
        <?php }  ?>

    });

    let table = new DataTable("#table", {
        ajax: "<?=BASEURL?>/Barang/getAll",
        //data: dataBarang,
        scrollY: "40vh",
        scrollX: true,
        dom: "lrtip",
        columns: [
            {
                data: "gambar",
                sortable: false,
                className: "img-clm",
                render: function(data, type, row) {
                    return `
                        <div class="td-wrapper">
                            <img src="<?=BASEURL?>/img/${data}" alt="logo" class="img-fluid">
                        </div>
                    `;
                }
            },
            {
                data: "nama",
                sortable: false,
                render: function(data, type, row) {
                    return `<div class="td-wrapper text-primary"> ${data} </div>`
                }
            },
            {
                data: "jumlah",
                sortable: false,
                render: function(data, type, row) {
                    return `<div class="td-wrapper text-primary">loading...</div>`
                },
                createdCell: async function(cell, cellData, rowData, rowIndex, colIndex) {
                    $(cell).html(`
                        <div class="td-wrapper text-primary">` +
                            rowData.tersedia + " / " + rowData.jumlah + `
                        </div>
                    `);
                }
            },
            {
                data: null,
                sortable: false,
                render: function(data, type, row) {
                    return `
                        <div class="td-wrapper">
                            <img src="<?=BASEURL?>/assets/rincian.svg" alt="rincian" class="alt-button rincian img-fluid">
                            <img src="<?=BASEURL?>/assets/tambah.svg" alt="tambah" class="alt-button tambah img-fluid">
                        </div>
                    `;
                },
                createdCell: async function(cell, cellData, rowData, rowIndex, colIndex) {
                    if (rowData.tersedia <= 0) {
                        $(cell).find('.tambah').addClass('disabled');
                    }
                }
            },
        ],
        initComplete: initTable,
    });


    let keranjangTable = new DataTable('#keranjang',{
        scrollY: "29vh",
        scrollX: true,
        dom: "t",
        columns: [
            { data: "nama" },
        ],
        columnDefs: [
            {
                targets: 0,
                sortable: false,
                render: function(data, type, row) {
                    return `
                        <div class="keranjang-item">
                            <span> ${data} </span>
                            <img src="<?=BASEURL?>/assets/hapus.svg" alt="hapus" class="alt-button hapus">
                        </div>
                    `;
                }
            },
        ],
        initComplete: function() {
            $(this).on('click', '.alt-button.hapus', function() {
                let row = keranjangTable.row($(this).parents('tr'));
                let data = row.data();
                console.log(data);
                $.ajax({
                    url: "<?=BASEURL?>/User/removeFromCart/" + data.id,
                    success: function(_) {
                        console.log("success");
                        row.remove().draw();
                        $('th.sorting_asc').removeClass('sorting_asc');
                    },
                    error: function(err) {
                        console.log(err);
                        $('th.sorting_asc').removeClass('sorting_asc');
                    }
                });
                $('th.sorting_asc').removeClass('sorting_asc');
            });
            $(".proses button").on('click', () => {
                let $data = keranjangTable.rows().data();
                console.log($data);
                if ($data.length <= 0) {
                    alert("Keranjang kosong!");
                    return;
                }
                window.location.href = "<?=BASEURL?>/User/proses";
            });
        }
    });

    function initTable() {
        let search = $("#search");

        search.on('keyup', () => {
            table.column(1).search(search.val(), false, true).draw();
        });

        $(this).on('click', '.alt-button.tambah:not(.disabled)', function() {
            let data = table.row($(this).parents('tr')).data();
            $.ajax({
                url: "<?=BASEURL?>/User/addCart/" + data.id,
                success: function(_, _, xhr) {
                    if (xhr.status != 200) {
                        return;
                    }
                    console.log(xhr.status);
                    keranjangTable.row.add({
                        nama: data.nama,
                        id: data.id
                    }).draw(false);
                },
                error: function(err) {
                    console.log(err);
                },
            });
            $('th.sorting_asc').removeClass('sorting_asc');
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
                    //$(".modal-pnggjawab").text(response.maintainer);
                    $(".modal-asal").text(response.asal);
                    $(".modal-keterangan").text(response.keterangan);

                    // Tampilkan modal
                    $("#modal-id").modal('show');
                }
            });
        });
        
    }

    function getItem(id) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: "<?=BASEURL?>/Barang/detail/" + id,
                dataType: "json",
                success: function(data) {
                    resolve(data);
                },
                error: function(err) {
                    reject(err);
                }
            });
        });
    }

    $.ajax({
        url: "<?=BASEURL?>/User/getCart",
        dataType: "json",
        success: async function(data) {
            console.log("success");
            console.log(data);
            for (let item of data) {
                console.log(item);
                try {
                    let barang = await getItem(item.id_barang);
                    console.log(barang);
                    keranjangTable.row.add({
                        nama: barang.nama,
                        id: item.id_barang,
                    }).draw(false);
                } catch(err) {
                    console.log(err);
                }
            }
            $('th.sorting_asc').removeClass('sorting_asc');
        },
        error: function(err) {
            console.log("error");
            console.log(err);
        }
    });

    $('th.sorting_asc').removeClass('sorting_asc');


    // Flasher sweetalert
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
.dataTables_paginate {
    margin-top: -25px !important;
}

.alt-button.hapus {
    width:  30px;
    height: 30px;
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
</style>
