<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../../../public/css/bootstrap.css" rel="stylesheet">
    <link href="../../../public/css/style.css" rel="stylesheet">
    <!--<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI/tZ1ZqjKw0BOyL8GfZ2mPAmUw/A763lSNtFqIo=" crossorigin="anonymous"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <div class="container page d-flex flex-column">
        <div id="welcome" class="title">
            SELAMAT DATANG
            <span class="nama"> Alim </span>
        </div>
        <div class="subtitle mb-4">Berikut ini daftar barang yang tersedia di JTI</div>
        <div class="search-wrapper d-flex flex-row">
            <input type="text" class="form-control" id="search" placeholder="Cari barang">
            <button class="btn btn-primary text-white d-flex flex-row">
                Cari
                <img src="../../../public/assets/search.svg" alt="search" class="alt-button search">
            </button>
        </div>
        <div class="container tables">
            <div class="tabel-barang">
                <div class="d-flex flex-row mb-2 entries-control">
                    Show 
                    <input type="number" id="num-of-entries" class="form-control form-control-sm" value="10" min="1" max="100">
                    entries
                </div>
                <table id="table" class="table rounded">
                    <thead class="bg-primary rounded-top">
                        <tr>
                            <th scope="col" style="border-top-left-radius: 5px;" class="">Gambar</th>
                            <th scope="col" class="">Nama</th>
                            <th scope="col" class="">Kuantitas</th>
                            <th scope="col" style="border-top-right-radius: 5px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="table-content" class="text-primary">
                    </tbody>
                </table>
                <div class="pagination-wrapper d-flex flex-row justify-content-between">
                    <div class="intries-showed mt-2"> 
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
            <div class="peminjaman">
                <div class="list-items">
                    <li class="list-group-item bg-primary text-white label rounded-top">Keranjang</li>
                    <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>
                            Barang 1
                        </span>
                        <span>
                            <img src="../../../public/assets/hapus.svg" alt="hapus" class="alt-button hapus">
                        </span>
                    </li>
                        <!--
                        <?php
                        foreach ($barangs as $barang) { ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>
                                    <?= $barang['nama'] ?> ( <?= $barang['id'] ?> )
                                </span>
                                <button class="btn text-danger"> 
                                    X
                                </button>
                            </li>
                        <?php } ?>
                        -->
                    </ul>
                    <div class="proses">
                        <button class="btn btn-success text-white">
                            Proses
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(() => {
            loadTable(10, 1);
        });

        $(".proses button").click(() => {
            
        });

        function loadTable(numOfEntries, page) {
            $.ajax({
                url: "barang.json",
                dataType: "json",
                success: function(result) {
                    let table = $("#table-content");
                    table.html("");
                    for (const barang of result) {
                        let $wrapper = $("<div>", {
                            class: "td-wrapper"
                        });
                        let $row = $("<tr>", {
                            class: "bg-white"
                        });

                        let imgWrapper = $wrapper.clone().append($("<img>", {
                            src: "../../../public/assets/jti-logo.png",
                            alt: "logo",
                            class: "img-fluid"
                        }));;

                        let $imgColumn = $("<td>", {
                            class: "img-clm"
                        }).append(imgWrapper);

                        //let $idColumn = $("<td>").append($wrapper.clone().text(barang.id));
                        let $namaColumn = $("<td>").append($wrapper.clone().text(barang.nama));
                        let $kuantitasColumn = $("<td>").append($wrapper.clone().text(barang.kuantitas));

                        let $tambahButton = $("<span>", {
                            class: ""
                        }).append($("<img>", {
                            class: "alt-button tambah",
                            src: "../../../public/assets/tambah.svg",
                            alt: "tambah",
                            style: `
                            `,
                        }));
                        let $rincianButton = $("<span>", {
                            class: ""
                        }).append($("<img>", {
                            class: "alt-button rincian",
                            src: "../../../public/assets/rincian.svg",
                            alt: "rincian",
                            style: `
                            `,
                        }));

                        let $actionColumn = $("<td>", {
                            class: `
                            `,
                            style: `
                                max-width: 100px;
                                gap: 3px;
                            `
                        })
                        .append($wrapper.clone()
                            .append($rincianButton)
                            .append($tambahButton)
                        );

                        $row
                            .append($imgColumn)
                            //.append($idColumn)
                            .append($namaColumn)
                            .append($kuantitasColumn)
                            .append($actionColumn);

                        table.append($row);
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    console.log(status);
                    console.log(error);
                }
            });
        }

        let keranjang = [];
        //$(".btn-pinjam").click(function() {
        //    const id = $(this).parent().parent().children()[1].innerText;
        //    const nama = $(this).parent().parent().children()[2].innerText;
        //    const barang = {
        //        id: id,
        //        nama: nama,
        //    };
        //    keranjang.push(barang);
        //});
        //$(".btn-hapus").click(function() {
        //    const id = $(this).parent().parent().children()[1].innerText;
        //    const nama = $(this).parent().parent().children()[2].innerText;
        //    const barang = {
        //        id: id,
        //        nama: nama,
        //    };
        //    keranjang.forEach((barang, index) => {
        //        if (barang.id === id) {
        //            keranjang.splice(index, 1);
        //        }
        //    });
        //});
    </script>
    <style>
        body, html {
            background-color: var(--background-global);
        }

        .container.tables {
            display: grid;
            grid-template-columns: 3fr 1fr;
            gap: 1rem;
            margin-top: 1rem;
        }

        #welcome {
            font-size: 30px;
            font-weight: 500;
            color: var(--secondary);
            margin-left: 10px;
        }

        #welcome > .nama {
            font-weight: 650;
        }

        .subtitle {
            margin-left: 10px;
            font-weight: 400;
        }

        .search-wrapper {
            margin-left: 10px;
            gap: 7px;
        }

        #search {
            border: 2px solid var(--bs-primary);
        }

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

        .label-daftar-barang {
            font-size: 20px;
            font-weight: 600;
        }

        table {
            text-align: center;
        }

        thead>tr>th {
            border-right: 1px solid var(--background-global);
            color: white;
            font-weight: 650;
        }

        tbody>tr {
            width: 100%;
            height: var(--table-row-height);
        }

        .td-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: var(--table-row-height);
        }

        #table-content {
            font-weight: 500;
        }

        .img-clm > .td-wrapper > img {
            max-width: 75px;
            max-height: var(--table-row-height);
        }

        .peminjaman {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .peminjaman>.list-items {
            position: sticky;
            top: 20px;
            margin-top: 36px;
        }

        .list-items>.list-group {
            max-height: 65vh;
            overflow-y: scroll;
        }

        .list-group>.label {
            font-size: 15px;
            font-weight: 650;
        }

        .list-items > .label {
            font-size: 15px;
            font-weight: 650;
        }

        /*
            .peminjaman > .proses {
                position: sticky;
                bottom: 20px;
                margin-top: 29px;
            }
*/
        .proses {
            margin-top: 29px;
        }

        .proses>button {
            width: 100%;
        }

        .alt-button {
            padding: 0;
            background-color: white;
            border: 3px solid transparent;
            border-radius: 40px;
            width:  50px;
            height: 50px;
        }

        .alt-button:active {
            background-color: var(--bs-primary);
        }

        .alt-button.tambah:hover {
            border: 3px solid #00B152;
        }

        .alt-button.rincian:hover {
            border: 3px solid #E7AE0E;
        }

        .alt-button.search {
            width:  25px;
            height: 25px;
            background-color: transparent;
        }

        .alt-button.hapus {
            width:  30px;
            height: 30px;
        }

        .alt-button.hapus:hover {
            background-color: #f6a5a8;
        }

        .alt-button.hapus:active {
            background-color: red;
        }
    </style>
</body>

</html>
