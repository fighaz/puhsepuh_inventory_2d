<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="<?=BASEURL?>/js/jquery.js"></script>
    <script src="<?=BASEURL?>/js/datatables.min.js"></script>
    <link  href="<?=BASEURL?>/css/datatables.min.css" rel="stylesheet">
    <link  href="<?=BASEURL?>/css/bootstrap.css" rel="stylesheet">
    <link  href="<?=BASEURL?>/css/style.css" rel="stylesheet">
    <link  href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!--<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI/tZ1ZqjKw0BOyL8GfZ2mPAmUw/A763lSNtFqIo=" crossorigin="anonymous"></script>-->
    
    <!-- Script sweetalert -->
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

    function confirmDel() {
        Swal.fire({
            title: "Apakah Anda yakin untuk menghapus Data Barang berikut?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yakin"
        }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
            title: "Terhapus!",
            text: "Barang berhasil dihapus.",
            icon: "success"
            });
        }
        });
    }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body>