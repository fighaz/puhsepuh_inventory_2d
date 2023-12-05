<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-3">

        <div class="row">
            <div class="col-lg-6">
                <?php Flasher::flash(); ?>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-6">
                <button type="button" class="btn btn-primary tombolTambahDataPeminjam" data-bs-toggle="modal"
                    data-bs-target="#formModalPeminjam">
                    Tambah Data Peminjam
                </button>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-lg-6">
                <form action="<?= BASEURL; ?>/Peminjam/cari" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Cari Peminjam" name="keyword" id="keyword"
                            autocomplete="off">
                        <button class="btn btn-primary" type="submit" id="tombolCari">Cari</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <h3>Daftar Peminjam</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Username</th>
                        <th scope="col">Action</th>
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
                            <tr>
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
                                    <a href="<?= BASEURL; ?>/Peminjam/ubah/<?= $pnj['id']; ?>"
                                        class="badge bg-success float-right tampilModalUbahAdmin" data-bs-toggle="modal"
                                        data-bs-target="#formModalPeminjam" ; ?>ubah</a>
                                    <a href="<?= BASEURL; ?>/Peminjam/hapus/<?= $pnj['id']; ?>"
                                        class="badge bg-danger float-right"
                                        onclick="return confirm('Apakah Anda yakin untuk menghapus Data Admin berikut?');">hapus</a>
                                </td>
                            </tr>
                        <?php endforeach;
                    endif; ?>
                </tbody>
            </table>
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
                        <input type="hidden" name="id_user" id="id_user">
                        <div class="form-group">
                            <label for="username_peminjam">Username</label>
                            <input type="text" class="form-control" id="username" name="username" autocomplete="off"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="email_admin">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" autocomplete="off" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>