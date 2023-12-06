<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris</title>
    <link href="../../../public/css/style.css" rel="stylesheet">
    <link href="../../../public/css/bootstrap.css" rel="stylesheet">
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
        <h1>Tambah Barang</h1>
    </header>
    <main>
        <div class="container text-primary">
            <div class="row">
                <section class="col-md-8 p-4">
                    <form>
                        <table class="table text-primary">
                            <tbody>
                                <tr>
                                    <td><label for="kode_barang" class="form-label">Kode Barang</label></td>
                                    <td><input type="text" name="kode_barang" id="kode_barang" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td><label for="nama_barang" class="form-label">Nama Barang</label></td>
                                    <td><input type="text" name="nama_barang" id="nama_barang" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td><label for="qty" class="form-label">QTY</label></td>
                                    <td><input type="number" name="qty" id="qty" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td><label for="maks_pinjam" class="form-label">Maks Pinjam</label></td>
                                    <td><input type="number" name="maks_pinjam" id="maks_pinjam" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td><label for="asal" class="form-label">Asal</label></td>
                                    <td><input type="text" name="asal" id="asal" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td><label for="keterangan" class="form-label">Keterangan</label></td>
                                    <td><textarea rows="4" cols="50" name="keterangan" id="keterangan" class="form-control"></textarea></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan="2" class="text-center"><button type="submit" class="btn btn-primary btn-lg text-white">SIMPAN</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </section>
                <section class="col-md-4 p-4">
                    <div class="form-group border rounded p-4">
                        <!-- Tambahkan class untuk area gambar -->
                        <div class="image-upload-container border border-primary rounded">
                            <input type="file" name="gambar" id="gambar" class="form-control">
                            <img id="preview" src="#" alt="Upload Gambar">
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>
    <script>
        document.getElementById('gambar').addEventListener('change', function(e) {
            var preview = document.getElementById('preview');
            preview.src = URL.createObjectURL(e.target.files[0]);
        });
    </script>
</body>
</html>
