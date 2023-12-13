<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <title>Document</title>
</head>
<body>
<div class="container">

<h1>Pop-up SweetAlert</h1>

<button class="btn btn-primary" onclick="berhasil()">Peminjaman berhasil</button>
<button class="btn btn-primary" onclick="gagal()">Peminjaman Gagal</button>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<script type="text/javascript">

function berhasil() {
   Swal.fire({
        title: "Berhasil!",
        text: "Peminjaman berhasil diajukan",
        icon: "success",
        button: true
    });
}
function gagal() {
   Swal.fire({
        title: "Berhasil!",
        text: "Peminjaman tidak berhasil",
        icon: "error",
        button: true
    });
}

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
