    <div class="container page d-flex flex-column">
        <div id="welcome" class="title text-accent">
            SELAMAT DATANG
            <span class="nama"> Alim </span>
        </div>
        <div class="subtitle mb-4">Berikut ini daftar barang yang tersedia di JTI</div>
        <div class="search-wrapper d-flex flex-row">
            <input type="text" class="form-control" id="search" placeholder="Cari barang">
            <button class="btn btn-primary text-white d-flex flex-row">
                Cari
                <img src="assets/search.svg" alt="search" class="alt-button search">
            </button>
        </div>
        <div class="container tables">
            <div class="tabel-barang">
                <table id="table" class="table table-stripped rounded">
                    <thead class="bg-primary rounded-top">
                        <tr>
                            <th style="border-top-left-radius: 5px;">Gambar</th>
                            <th class="">Nama</th>
                            <th class="">Kuantitas</th>
                            <th style="border-top-right-radius: 5px;">Aksi</th>
                        </tr>
                    </thead>
                </table>
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
                            <img src="assets/hapus.svg" alt="hapus" class="alt-button hapus">
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
        });

        $(".proses button").click(() => {
        });


        let table = new DataTable("#table", {
            ajax: "assets/barang.json",
            dom: "lrtip",
            columns: [
                { data: "img" },
                { data: "nama" },
                { data: "kuantitas" },
                { data: null },
            ],
            columnDefs: [
                {
                    targets: 0,
                    sortable: false,
                    className: "img-clm",
                    render: function(data, type, row) {
                        return `
                            <div class="td-wrapper">
                                <img src="${data}" alt="logo" class="img-fluid">
                            </div>
                        `;
                    }
                },
                {
                    targets: 1,
                    sortable: false,
                    render: function(data, type, row) {
                        return `<div class="td-wrapper"> ${data} </div>`
                    }
                },
                {
                    targets: 2,
                    sortable: false,
                    render: function(data, type, row) {
                        return `<div class="td-wrapper"> ${data} </div>`
                    }
                },
                {
                    targets: 3,
                    sortable: false,
                    render: function(data, type, row) {
                        return `
                            <div class="td-wrapper">
                                <img src="assets/rincian.svg" alt="rincian" class="alt-button rincian img-fluid">
                                <img src="assets/tambah.svg" alt="tambah" class="alt-button tambah img-fluid">
                            </div>
                        `;
                    }
                },
            ],
            initComplete: function() {
                let search = $("#search");

                search.keyup(() => {
                    table.column(1).search(search.val(), false, true).draw();
                });

                table.on('click', '.alt-button.tambah', function() {
                    let data = table.row($(this).parents('tr')).data();
                    console.log(data);
                });
            },
        });

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
            max-height: 100px;
            overflow-y: scroll;
        }

        .dataTables_wrapper > div > label {
            color: var(--bs-primary);
            font-weight: 500;
            font-size: 14px;
            margin-bottom: 10px;
        }

        select {
            border: 1px solid var(--bs-primary) !important;
            color: var(--bs-primary);
        }

        thead>tr>th {
            border-right: 1px solid var(--background-global);
            color: white;
            font-weight: 650;
            text-align: center !important;
        }

        tbody>tr {
            width: 100%;
            height: var(--table-row-height);
        }

        tbody {
            background-color: white;
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

        .dataTables_paginate {
            margin-top: -29px !important;
            margin-bottom: 29px !important;
        }

        .peminjaman {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .peminjaman>.list-items {
            position: sticky;
            top: 20px;
            margin-top: 40px;
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
            background-color: transparent;
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
