<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../../../../public/css/style.css" rel="stylesheet">
    <link href="../../../../public/css/bootstrap.css" rel="stylesheet">
    <!--<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI/tZ1ZqjKw0BOyL8GfZ2mPAmUw/A763lSNtFqIo=" crossorigin="anonymous"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="tabel-barang">
            <label class="label-daftar-barang">Daftar Barang</label>
            <table class="table rounded">
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
        </div>
        <div class="peminjaman">
            <div class="list-items">
                <li class="list-group-item bg-primary text-white label rounded-top">Keranjang</li>
                <ul class="list-group">
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
                            src: "../../../../public/assets/jti-logo.png",
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
                            src: "../../../../public/assets/tambah.svg",
                            alt: "tambah",
                            style: `
                            `,
                        }));
                        let $rincianButton = $("<span>", {
                            class: ""
                        }).append($("<img>", {
                            class: "alt-button rincian",
                            src: "../../../../public/assets/rincian.svg",
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
        .container {
            display: grid;
            grid-template-columns: 3fr 1fr;
            gap: 1rem;
            margin-top: 5rem;
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
            margin-top: 29px;
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
        }

        .alt-button:hover {
        }

        img.alt-button {
            padding: 0;
            background-color: white;
            border: 3px solid transparent;
            border-radius: 40px;
            width:  50px;
            height: 50px;
        }

        img.alt-button:hover {
            background-color: white;
        }

        img.alt-button.tambah:hover {
            border: 3px solid #00B152;
        }

        img.alt-button.rincian:hover {
            border: 3px solid #E7AE0E;
        }
    </style>
</body>

</html>
