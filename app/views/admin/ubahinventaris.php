<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris</title>
    <link href="<?= BASEURL; ?>/css/style.css" rel="stylesheet">
    <link href="<?= BASEURL; ?>/css/bootstrap.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        :root {
            font-family: Montserrat, sans-serif;
        }

        * {
            background-color: #EBEFF5;
            font-family: inherit;
        }

        .btn-primary {
            font-size: 18px;
            color: white;
            width: 100%;
        }

        header h1 {
            color: #E7AE0E;
        }

        /* Tambahkan style untuk area gambar */
        .image-upload-container {
            border: 10px solid #007BFF;
            padding: 40px;
            text-align: center;
            position: relative;
        }

        .image-upload-container img {
            max-width: 100%;
            max-height: 200px;
            display: block;
            margin: 0 auto;
        }

        .form-control {
            border: 2px solid #007BFF;
        }

        .save-button-container {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <header>
        <h1>Ubah Barang</h1>
    </header>
    <form action="tambah" method="POST" enctype="multipart/form-data">
        <div class="container text-primary">
            <div class="row">
                <section class="col-md-8 p-4">

                    <table class="table text-primary">
                        <tbody>
                            <tr>
                                <td><label for="nama_barang" class="form-label">
                                        Nama Barang
                                    </label></td>
                                <td><input type="text" name="nama" id="nama_barang" class="form-control"
                                        value="<?= $data['brg']['nama'] ?>">
                                </td>
                            </tr>
                            <tr>
                                <td><label for="qty" class="form-label">Jumlah</label></td>
                                <td><input type="number" name="jumlah" id="qty" class="form-control"
                                        value="<?= $data['brg']['jumlah'] ?>"></td>
                            </tr>
                            <tr>
                                <td><label for="maks_pinjam" class="form-label">Kondisi</label></td>
                                <td>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="kondisi" id="inlineRadio1"
                                            value="Baik" <?= ($data['brg']['kondisi'] == "Baik" ? 'checked="checked"' : '') ?>>
                                        <label class="form-check-label" for="inlineRadio1">Baik</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="kondisi" id="inlineRadio2"
                                            value="Rusak" <?= ($data['brg']['kondisi'] == "Rusak" ? 'checked="checked"' : '') ?>>
                                        <label class="form-check-label" for="inlineRadio2">Rusak</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="asal" class="form-label">Asal</label></td>
                                <td><input type="text" name="asal" id="asal" class="form-control"
                                        value="<?= $data['brg']['asal'] ?>"></td>
                            </tr>
                            <tr>
                                <td><label for="keterangan" class="form-label">Keterangan</label></td>
                                <td><textarea rows="4" cols="50" name="keterangan" id="keterangan"
                                        class="form-control"><?= $data['brg']['keterangan'] ?></textarea></td>
                            </tr>
                            <tr>
                                <td><label for="maintainer" class="form-label">Maintainer</label></td>
                                <td><input type="text" name="maintainer" id="maintainer" class="form-control"
                                        value="<?= $data['brg']['keterangan'] ?>"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td colspan="2" class="text-center"><button type="submit"
                                        class="btn btn-primary btn-lg text-white">SIMPAN</button></td>
                            </tr>
                        </tbody>
                    </table>

                </section>
                <section class="col-md-4 p-4">
                    <div class="form-group border rounded p-4">
                        <!-- Tambahkan class untuk area gambar -->
                        <div class="image-upload-container border border-primary rounded">
                            <input type="file" name="gambar" id="gambar" class="form-control"
                                value="<?= $data['brg']['gambar'] ?>">
                            <img id="preview" src="<?= BASEURL; ?>'/img/'<?= $data['brg']['gambar'] ?>"
                                alt="Upload Gambar">
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </form>
    <script>
        document.getElementById('gambar').addEventListener('change', function (e) {
            var preview = document.getElementById('preview');
            preview.src = URL.createObjectURL(e.target.files[0]);
        });
    </script>
</body>

</html>