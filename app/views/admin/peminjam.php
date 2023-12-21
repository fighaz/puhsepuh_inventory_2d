<div class="row">
    <div class="col-lg-6">
        <?php Flasher::flash(); ?>
    </div>
</div>

    <h4 class="fw-bold">DAFTAR PEMINJAM</h4>

<!-- Tombol -->
<button type="button" class="btn btn-primary tombolTambahDataPeminjam text-white fw-semibold"
    data-bs-toggle="modal" data-bs-target="#formModalPeminjam">
    Tambah Data Peminjam
</button>

  <table class="table rounded" id="table">
    <thead class="rounded-top">
      <tr class="bg-primary">
        <th style="border-top-left-radius: 5px;">No</th>
        <th>Nama</th>
        <th>Username</th>
        <th>No Telp</th>
        <th>Email</th>
        <th style="border-top-right-radius: 5px; max-width: 200px;">Aksi</th>
      </tr>
    </thead>
  </table>


<!-- Modal Add and Edit -->
<div class="modal fade" id="formModalPeminjam" tabindex="-1" aria-labelledby="formModalPeminjamLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalPeminjamLabel">Tambah Data Peminjam</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= BASEURL; ?>/Peminjam/tambah" method="post">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="NIM/NIP"
                            autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap"
                            autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="notelp">No Telp</label>
                        <input type="text" class="form-control" id="notelp" name="notelp" placeholder="No Telepon"
                            autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email"
                            autocomplete="off" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary text-white">Tambah Data</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $(".tampilModalUbahPeminjam").on("click", function () {
            $("#formModalPeminjamLabel").html("Ubah Data Peminjam");
            $(".modal-footer button[type=submit]").html("Ubah Data");
            $(".modal-body form").attr(
                "action",
                "http://localhost/puhsepuh_inventory_2d/public/Peminjam/ubah"
            );

            const id = $(this).data("id");

            $.ajax({
                url: "http://localhost/puhsepuh_inventory_2d/public/Peminjam/getUbah",
                data: { id: id },
                method: "post",
                dataType: "json",
                success: function (data) {
                    $("#id").val(data.id);
                    $("#username").val(data.username);
                    $("#nama").val(data.nama);
                    $("#notelp").val(data.notelp);
                    $("#email").val(data.email);
                    console.log(data);
                },
            });
        });
    });

    let table = new DataTable("#table", {
        ajax: '<?= BASEURL; ?>/Peminjam/getAll',
        scrollY: "320px",
        columns: [
            {
                data: "id",
                sortable: false,
                //render: function (data, type, row, meta) {
                //    return meta.row + meta.settings._iDisplayStart + 1;
                //},
                rener: function (data, type, row) {
                    return `<div class="td-wrapper">${data}</div>`;
                },
            },
            {
                data: "nama",
                sortable: false,
                rener: function (data, type, row) {
                    return `<div class="td-wrapper">${data}</div>`;
                },
            },
            {
                data: "username",
                sortable: false,
                rener: function (data, type, row) {
                    return `<div class="td-wrapper">${data}</div>`;
                },
            },
            {
                data: "notelp",
                sortable: false,
                rener: function (data, type, row) {
                    return `<div class="td-wrapper">${data}</div>`;
                },
            },
            {
                data: "email",
                sortable: false,
                rener: function (data, type, row) {
                    return `<div class="td-wrapper">${data}</div>`;
                },
            },
            {
                data: null,
                sortable: false,
                render: function (data, type, row) {
                    return `
                        <div class="td-wrapper">
                            <a href="<?= BASEURL; ?>/Peminjam/ubah/${row.id}" class="tampilModalUbahPeminjam"
                                data-bs-toggle="modal" data-bs-target="#formModalPeminjam" data-id="${row.id}"><img
                                    src="<?= BASEURL; ?>/assets/edit.svg" title="ubah" class="alt-button edit"></a>
                            <a href="<?= BASEURL; ?>/Peminjam/hapus/${row.id}"><img
                                    src="<?= BASEURL; ?>/assets/hapus.svg" title="hapus" class="alt-button hapus"
                                    onclick="return confirm('Apakah Anda yakin untuk menghapus Data Peminjam berikut?');"></a>
                            <a href="<?= BASEURL; ?>/Peminjam/resetPassword/${row.id}"><img
                                    src="<?= BASEURL; ?>/assets/reset.svg" title="reset password" class="alt-button reset"
                                    onclick="return confirm('Apakah Anda yakin untuk mereset Password Peminjam berikut?');"></a>
                        </div>
                    `;
                },
            },
        ],
        initComplete: function () {
            table.on('click', '.hapus', function (e) {
                e.preventDefault();
                let data = table.row($(this).parents('tr')).data();
                //let href = $(this).parents('a').attr('href');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data Peminjam akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3C8DBB',
                    cancelButtonColor: '#E7AE0E',
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.location.href = "<?=BASEURL?>/Peminjam/hapus/" + data.id;
                        //console.log("<?=BASEURL?>/Peminjam/hapus/" + data.id);
                    }
                })
            });

            $('button.add-user').on('click', function (e) {
                e.preventDefault();
                let username = $('#username').val();
                let nama = $('#nama').val();
                let id_user = $('#id_user').val();
                $.ajax({
                    url: "<?= BASEURL; ?>/Peminjam/tambahUser",
                    type: "post",
                    data: {
                        username: username,
                        nama: nama,
                        id_user: id_user
                    },
                    success: function (data, _, xhr) {
                        $('#formModalPeminjam').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Data Peminjam berhasil ditambahkan!',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        })
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                        })
                    }
                });
            });
        },
    });
</script>

<!-- Style -->
<style>
    h4 {
        color: #E7AE0E;
    }

    body {
        background-color: #EBEFF5;
    }

    thead th {
        border: 2px solid #fff;
        text-align: center;
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

.dataTables_paginate {
    margin-top: 10px !important;
}

.tombolTambahDataPeminjam {
    margin-top: 10px;
    margin-bottom: 10px;
    width: 230px;
    height: 33px;
    padding: 2px 5px;
}

.td-wrapper {
    max-height: 40px;
}
</style>
