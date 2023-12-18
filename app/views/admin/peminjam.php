<div class="row">
    <div class="col-lg-6">
        <?php Flasher::flash(); ?>
    </div>
</div>

<!-- Tombol -->
<div class="row mb-3">
    <div class="col-lg-6">
        <button type="button" class="btn btn-primary tombolTambahDataPeminjam text-white fw-semibold"
            data-bs-toggle="modal" data-bs-target="#formModalPeminjam">
            Tambah Data Peminjam
        </button>
    </div>
</div>
<div class="row">
    <h3 class="fw-semibold">Daftar Peminjam</h3>

    <div class="d-flex flex-row mb-2 entries-control">
        Show
        <input type="number" id="num-of-entries" class="form-control form-control-sm" value="10" min="1" max="100">
        entries
    </div>
    <table class="table table-hover rounded">
        <thead>
            <tr class="bg-primary text-white">
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Username</th>
                <th scope="col">No Telp</th>
                <th scope="col">Email</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            if (empty($data['peminjam'])): ?>
                <tr>
                    <td colspan="7">
                        <div class="alert alert-danger" role="alert">
                            Tidak ada data terkait.
                        </div>
                    </td>
                </tr>
            <?php else:
                foreach ($data['peminjam'] as $pnj): ?>
                    <tr class="text-primary bg-white align-middle text-center">
                        <th scope="row">
                            <?= $no++; ?>
                        </th>
                        <td>
                            <?= $pnj['nama']; ?>
                        </td>
                        <td>
                            <?= $pnj['username']; ?>
                        </td>
                        <td>
                            <?= $pnj['notelp']; ?>
                        </td>
                        <td>
                            <?= $pnj['email']; ?>
                        </td>
                        <td>
                            <a href="<?= BASEURL; ?>/Peminjam/ubah/<?= $pnj['id']; ?>" class="tampilModalUbahPeminjam"
                                data-bs-toggle="modal" data-bs-target="#formModalPeminjam" data-id="<?= $pnj['id']; ?>"><img
                                    src="<?= BASEURL; ?>/assets/edit.svg" alt=""></a>
                            <a href="<?= BASEURL; ?>/Peminjam/hapus/<?= $pnj['id']; ?>"><img
                                    src="<?= BASEURL; ?>/assets/hapus.svg" alt=""
                                    onclick="return confirm('Apakah Anda yakin untuk menghapus Data Peminjam berikut?');"></a>
                            <a href="<?= BASEURL; ?>/Peminjam/resetPassword/<?= $pnj['id']; ?>"><img
                                    src="<?= BASEURL; ?>/assets/reset.svg" alt=""
                                    onclick="return confirm('Apakah Anda yakin untuk mereset Password Peminjam berikut?');"></a>
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
</div>

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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>


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
</script>
<!-- Style -->
<style>
    .row h3 {
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
</style>