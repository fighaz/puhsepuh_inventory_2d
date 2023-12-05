<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris</title>
    <link href="../../../public/css/style.css" rel="stylesheet">
    <link href="../../../public/css/bootstrap.css" rel="stylesheet">
    <!--<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">-->
    <style>
    :root {
      font-family: Montserrat;
    }         
    * {
      background-color: #EBEFF5;
    }
        /* Tambahkan style berikut */
        .btn-primary {
            font-size: 18px; /* Atur ukuran teks */
            color: white; /* Warna teks putih */
        }
        header h1 {
            color: #E7AE0E
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
                                    <td><label for="kode_barang">Kode Barang</label></td>
                                    <td><input type="text" name="kode_barang" id="kode_barang" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td><label for="nama_barang">Nama Barang</label></td>
                                    <td><input type="text" name="nama_barang" id="nama_barang" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td><label for="qty">QTY</label></td>
                                    <td><input type="number" name="qty" id="qty" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td><label for="maks_pinjam">Maks Pinjam</label></td>
                                    <td><input type="number" name="maks_pinjam" id="maks_pinjam" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td><label for="asal">Asal</label></td>
                                    <td><input type="text" name="asal" id="asal" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td><label for="keterangan">Keterangan</label></td>
                                    <td><input type="text" name="keterangan" id="keterangan" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-center"><button type="submit" class="btn btn-primary">SIMPAN</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </section>
                <section class="col-md-4 p-4">
                    <div class="form-group border rounded p-4">
                        <label for="gambar" class="mb-2">Upload Gambar</label>
                        <input type="file" name="gambar" id="gambar" class="form-control">
                        <div class="mt-3">
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
