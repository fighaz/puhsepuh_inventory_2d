<div id="welcome" class="title text-accent">
    SELAMAT DATANG
    <span class="nama"> Alim </span>
</div>
<div class="subtitle mb-4">Berikut ini daftar barang yang tersedia di JTI</div>
<div class="search-wrapper d-flex flex-row">
    <input type="text" class="form-control" id="search" placeholder="Cari barang">
    <button class="btn btn-primary text-white d-flex flex-row">
        Cari
        <img src="<?=BASEURL?>/assets/search.svg" alt="search" class="alt-button search">
    </button>
</div>
<div class="container tables">
    <div class="tabel-barang">
        <table id="table" class="table table-stripped rounded">
            <thead class="bg-primary rounded-top">
                <tr class="text-primary">
                    <th style="border-top-left-radius: 5px; text-primary">Gambar</th>
                    <th class="text-primary">Nama</th>
                    <th class="text-primary">Kuantitas</th>
                    <th style="border-top-right-radius: 5px; text-primary">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
    <div class="peminjaman">
        <div class="list-items">
            <table id="keranjang">
                <thead class="bg-primary rounded-top">
                    <tr>
                        <th class="rounded-top">Keranjang</th>
                        <th>Id</th>
                    </tr>
                </thead>
            </table>
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
        
    });

    $(".proses button").click(() => {
    });

    let table = new DataTable("#table", {
        ajax: "<?=BASEURL?>/barang/getAll",
        //data: dataBarang,
        scrollY: "43vh",
        scrollX: true,
        dom: "lrtip",
        columns: [
            { data: "gambar" },
            { data: "nama" },
            { data: "jumlah" },
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
                            <img src="<?=BASEURL?>/img/${data}" alt="logo" class="img-fluid">
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
                            <img src="<?=BASEURL?>/assets/rincian.svg" alt="rincian" class="alt-button rincian img-fluid">
                            <img src="<?=BASEURL?>/assets/tambah.svg" alt="tambah" class="alt-button tambah img-fluid">
                        </div>
                    `;
                }
            },
        ],
        initComplete: initTable,
    });


    let keranjangTable = new DataTable('#keranjang',{
        scrollY: "33vh",
        scrollX: true,
        dom: "t",
        columns: [
            { data: "nama" },
            { data: "id" },
        ],
        columnDefs: [
            {
                targets: 0,
                sortable: false,
                render: function(data, type, row) {
                    return `
                        <div class="keranjang-item">
                            <span> ${data} </span>
                            <img src="<?=BASEURL?>/assets/hapus.svg" alt="hapus" class="alt-button hapus">
                        </div>
                    `;
                }
            },
            {
                targets: 1,
                sortable: false,
                visible: false,
            },
        ],
        initComplete: function() {
            $(this).on('click', '.alt-button.hapus', function() {
                let row = keranjangTable.row($(this).parents('tr'));
                let data = row.data();
                $.ajax({
                    url: "<?=BASEURL?>/user/removeFromCart/" + data.id,
                    success: function(_) {
                        console.log("success");
                        row.remove().draw();
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            });
            $('thead th').removeClass('sorting_asc');
        }
    });

    function initTable() {
        let search = $("#search");

        search.on('keyup', () => {
            table.column(1).search(search.val(), false, true).draw();
        });

        $(this).on('click', '.alt-button.tambah', function() {
            let data = table.row($(this).parents('tr')).data();
            $.ajax({
                url: "<?=BASEURL?>/user/addCart/" + data.id,
                success: function(_, _, xhr) {
                    if (xhr.status != 200) {
                        return;
                    }
                    console.log(xhr.status);
                    keranjangTable.row.add({
                        nama: data.nama,
                        id: data.id
                    }).draw(false);
                },
                error: function(err) {
                    console.log(err);
                },
            });
            $('thead th').removeClass('sorting_asc');
        });
        
    }

    function getItem(id) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: "<?=BASEURL?>/barang/detail/" + id,
                dataType: "json",
                success: function(data) {
                    resolve(data);
                },
                error: function(err) {
                    reject(err);
                }
            });
        });
    }

    $.ajax({
        url: "<?=BASEURL?>/user/getCart",
        dataType: "json",
        success: async function(data) {
            for (let key in data) {
                try {
                    let barang = await getItem(key);
                    keranjangTable.row.add({
                        nama: barang.nama,
                        id: barang.id
                    }).draw(false);
                } catch(err) {
                    console.log(err);
                }
            }
            $('thead th').removeClass('sorting_asc');
        },
        error: function(err) {
            console.log("error");
            console.log(err);
        }
    });

    $('thead th').removeClass('sorting_asc');

</script>
<style>
    body, html {
        background-color: var(--background-global);
    }

    .container.tables {
        display: grid;
        grid-template-columns: 3fr 1fr;
        min-width: 100%;
        gap: 1rem;
        margin-top: 1rem;
        margin-right: 0;
        margin-left: 0;
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

    .label-daftar-barang {
        font-size: 20px;
        font-weight: 600;
    }

    table {
        text-align: center;
        width: 100% !important;
    }

    .dataTables_scrollHead {
        width: 100% !important;
    }

    .dataTables_scrollHeadInner {
        width: 100% !important;
    }

    .dataTables_wrapper > div > label {
        color: var(--bs-primary);
        font-weight: 500 !important;
        font-size: 14px;
    }

    select {
        border: 1px solid var(--bs-primary) !important;
        color: var(--bs-primary) !important;
        background-color: var(--background-global) !important;
    }

    thead>tr>th {
        border-right: 1px solid var(--background-global);
        color: white;
        font-weight: 650;
        text-align: center !important;
    }

    tbody {
        background-color: white;
    }

    .td-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        height: var(--table-row-height);
    }

    #table-content {
        font-weight: 500;
    }

    .img-clm img {
        max-width: 75px;
        max-height: var(--table-row-height);
    }

    .dataTables_info {
        margin-top: 10px !important;
    }

    .dataTables_paginate {
        margin-top: -25px !important;
    }

    .dataTables_info, .dataTables_paginate {
        font-size: 14px;
    }

    #keranjang_wrapper .dataTables_scrollHead thead {
        height: 40px;
    }

    #keranjang_wrapper .dataTables_scrollBody tbody tr {
        padding: 10px;
        height: 50px;
    }

    .keranjang-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 30px;
        min-width: none !important;
        padding: 0 9px;
    }

    .peminjaman>.list-items {
        margin-top: 31px;
    }

    /*
        .peminjaman > .proses {
            position: sticky;
            bottom: 20px;
            margin-top: 29px;
        }
*/
    .proses {
        margin-top: 23px;
    }

    .proses>button {
        width: 100%;
        height: 41px;
        text-align: center;
        text-justify: center;
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
