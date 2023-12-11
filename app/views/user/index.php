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

    $(".proses button").on('click', () => {
        window.location.href = "<?=BASEURL?>/User/proses";
    });

    let table = new DataTable("#table", {
        ajax: "<?=BASEURL?>/Barang/getAll",
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
                    url: "<?=BASEURL?>/User/removeFromCart/" + data.id,
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
                url: "<?=BASEURL?>/User/addCart/" + data.id,
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
                url: "<?=BASEURL?>/Barang/detail/" + id,
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
        url: "<?=BASEURL?>/User/getCart",
        dataType: "json",
        success: async function(data) {
            console.log("success");
            console.log(data);
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
