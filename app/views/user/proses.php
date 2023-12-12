<div class="container">
    <form action="<?=BASEURL?>/User/tambah" method="post">
        <div class="content">
            <p class="judul">Proses Peminjaman</p>
                <div class="mb-2 row">
                    <label for="Nama Peminjam" class="col-sm-3 col-form-label fw-normal">Nama Peminjam</label>
                    <div class="col-sm-6">
                    <input type="text" class="form-control" id="Nama Peminjam" value="<?=$_SESSION['nama']?>" readonly>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
                <div class="mb-2 row">
                    <label for="NIM/NIP" class="col-sm-3 col-form-label fw-normal">NIM/NIP</label>
                    <div class="col-sm-6">
                    <input type="text" class="form-control" id="NIM/NIP" name="id_user" value="<?=$_SESSION['id_user']?>" disabled>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
                <div class="mb-2 row">
                    <label for="Mulai" class="col-sm-3 col-form-label fw-normal">Mulai Pinjam</label>
                    <div class="col-sm-3">
                        <input type="date" class="form-control" id="Mulai" name="tanggal_peminjaman">
                    </div>
                    <label id="label-sampai" for="Sampai" class="col-sm-1 col-form-label fw-normal">Sampai</label>
                    <div class="col-sm-3">
                        <input type="date" class="form-control" id="Sampai" name="tanggal_pengembalian">
                    </div>
                </div>



            <p class="judulTabel fw-normal">Item Dipinjam</p>
            <table id="table" class="table table-hover">
                <thead>
                    <tr class="table-primary">
                        <th class="fw-normal">Gambar</th>
                        <th class="fw-normal">Nama</th>
                        <th class="fw-normal">Jumlah Pinjam</th>
                        <th class="fw-normal">Catatan</th>
                        <th class="fw-normal">Aksi</th>
                    </tr>
                </thead>

            </table>
            <div class="d-grid gap-2 d-md-block mt-2">
                <button class="button kembali" type="button">Kembali</button>
                <button class="tombol pinjam" type="submit">Pinjam!</button>
            </div>

        </div>
    </form>
</div>
<script>
    // Path: proses.php


    $('.kembali').click(function() {
        window.location.href = "<?=BASEURL?>/User";
    });

    $('pinjam').click(() => {

    });

    let table = new DataTable('#table', {
        scrollY: '190px',
        dom: 't',
        columns: [
            { data: 'gambar', },
            { data: 'nama', },
            { data: null, },
            { data: null, },
            { data: null, }
        ],
        columnDefs: [

            {
                targets: 0,
                sortable: false,
                render: function(data, type, row, meta) {
                    return `<img src="<?=BASEURL?>/img/${data}" alt="Gambar" width="100px">`;
                }
            },
            {
                targets: 1,
                sortable: false,
                render: function(data, type, row, meta) {
                    return `<p>${data}</p>`;
                }
            },
            {
                targets: 2,
                sortable: false,
                render: function(data, type, row, meta) {
                    return `<input type="number" class="form-control-sm w-25" id="Jumlah Pinjam" value="1" name="nama">`;
                }
            },
            {
                targets: 3,
                sortable: false,
                render: function(data, type, row, meta) {
                    return `<textarea class="form-control-lg" id="Catatan" rows="2" name="keterangan"></textarea>`;
                }
            },
            {
                targets: 4,
                sortable: false,
                render: function(data, type, row, meta) {
                    return `<img src="<?=BASEURL?>/assets/hapus.svg" alt="hapus" class="alt-button hapus">`;
                }
            }
        ]
    });

    // return object barang
    function getItem(id) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: "<?=BASEURL?>/Barang/detail/" + id,
                dataType: "json",
                success: function(data) {
                    console.log("success get item");
                    console.log(data);
                    resolve(data);
                },
                error: function(err) {
                    console.log("error get item");
                    reject(err);
                }
            });
        });
    }

    $(document).ready(function() {
        $.ajax({
        url: '<?=BASEURL?>/User/getCart',
            type: 'GET',
            dataType: 'json',
            success: async function(data) {
                console.log("success");
                console.log(data);
                for (let item of data) {
                    try {
                        let barang = await getItem(item.id_barang);
                        table.row.add({
                            gambar: barang.gambar,
                            nama: barang.nama,
                        }).draw(false);
                    } catch (err) {
                        console.log(err);
                    }
                }
            },
            error: function(err) {
                console.log("error");
                console.log(err);
            }
        });
    });


</script>
<style>
    /* Custom styles for your form and table */
    body {
        font-family: 'Arial', sans-serif;
    }

    .judul {
        font-size: 30px;
        font-style: normal;
        font-weight: 700;
        line-height: normal;
        color: #E7AE0E;
    }

    .button {
        background-color: #E7AE0E;
        width: 193px;
        height: 51px;
        flex-shrink: 0;
        border-radius: 5px;
        color: #fff;
        border: none;
    }

    .tombol {
        background-color: #3C8DBB;
        width: 918px;
        height: 51px;
        flex-shrink: 0;
        border-radius: 5px;
        background: #00B152;
        color: #fff;
        border: none;
    }

    .judulTabel {
        font-size: 20px;
        font-weight: 600;
        font-style: normal;
        line-height: normal;
        color: #3C8DBB;
    }

    #label-sampai {
        margin-top: 6px;
        margin-right: 20px;
    }

    /* Styles for the form 
    form {
        max-width: 800px;
        margin: 0 auto;
        color: #3C8DBB;
    }
    */

    /* Styles for form labels */
    label {
        font-weight: bold;
    }

    /* Styles for form inputs */
    .form-control {
        width: 100%;
        max-height: 50px;
        padding: 5px 8px;
        margin: 5px 0;
        box-sizing: border-box;
        border: 3px solid #3C8DBB;
    }

    .form-control-sm {
        border: 3px solid #3C8DBB;
    }

    .form-control-lg {
        font-size: 15px;
        width: 80%;
        min-height: 90px;
        padding: 5px 8px;
        margin: 5px 0;
        box-sizing: border-box;
        border: 3px solid #3C8DBB;
    }

    /* Styles for the table */
    .table-primary th {
        background-color: #3C8DBB;
        color: #fff;
        ;
    }

    /* Styles for table cells */
    .table td,
    .table th {
        text-align: center;
    }

    /* Styles for table actions */
    .table a {
        margin-right: 5px;
    }
</style>

