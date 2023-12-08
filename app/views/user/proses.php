<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="content">
            <p class="judul">Proses Peminjaman</p>
            <form class="row">
                <div class="mb-3 row">
                    <label for="Nama Peminjam" class="col-sm-3 col-form-label fw-normal">Nama Peminjam</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="Nama Peminjam" disabled>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
                <div class="mb-3 row">
                    <label for="NIM/NIP" class="col-sm-3 col-form-label fw-normal">NIM/NIP</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="NIM/NIP" disabled>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
                <div class="mb-3 row">
                    <label for="Mulai" class="col-sm-3 col-form-label fw-normal">Mulai Pinjam</label>
                    <div class="col-sm-3">
                        <input type="date" class="form-control" id="Mulai">
                    </div>
                    <label id="label-sampai" for="Sampai" class="col-sm-1 col-form-label fw-normal">Sampai</label>
                    <div class="col-sm-3">
                        <input type="date" class="form-control" id="Sampai">
                    </div>
                </div>
            </form>



            <p class="judulTabel fw-normal">Item Dipinjam</p>
            <table class="table table-hover">
                <thead>
                    <tr class="table-primary">
                        <th class="fw-normal">Gambar</th>
                        <th class="fw-normal">Nama</th>
                        <th class="fw-normal">Jumlah Pinjam</th>
                        <th class="fw-normal">Catatan</th>
                        <th class="fw-normal">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <a href=""><img src="asset/hapus.svg" alt="Hapus"></a>
                        </td>
                    </tr>
                </tbody>

                </tbody>
            </table>
            <div class="d-grid gap-2 d-md-block">
                <button class="button" type="button">Kembali</button>
                <button class="tombol" type="button">Pinjam!</button>
            </div>

        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<style>
    /* Custom styles for your form and table */
    body {
        font-family: 'Arial', sans-serif;
        padding: 20px;
    }

    .judul {
        font-size: 30px;
        font-style: normal;
        font-weight: 700;
        line-height: normal;
        color: #E7AE0E;
    }

    .button {
        background-color: #E7AE0E;
        width: 193px;
        height: 51px;
        flex-shrink: 0;
        border-radius: 5px;
        color: #fff;
        border: none;
    }

    .tombol {
        background-color: #3C8DBB;
        width: 918px;
        height: 51px;
        flex-shrink: 0;
        border-radius: 5px;
        background: #00B152;
        color: #fff;
        border: none;
    }

    .judulTabel {
        font-size: 20px;
        font-weight: 600;
        font-style: normal;
        line-height: normal;
        color: #3C8DBB;
    }

    #label-sampai {
        margin-top: 6px;
        margin-right: 20px;
    }

    /* Styles for the form */
    form {
        max-width: 800px;
        margin: 0 auto;
        color: #3C8DBB;
    }

    /* Styles for form labels */
    label {
        font-weight: bold;
    }

    /* Styles for form inputs */
    .form-control {
        width: 100%;
        padding: 8px;
        margin: 5px 0;
        box-sizing: border-box;
        border: 3px solid #3C8DBB;
    }

    /* Styles for the table */
    .table-primary th {
        background-color: #3C8DBB;
        color: #fff;
        ;
    }

    /* Styles for table cells */
    .table td,
    .table th {
        text-align: center;
    }

    /* Styles for table actions */
    .table a {
        margin-right: 5px;
    }
</style>

</html>