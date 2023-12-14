<div class="container">
    <form action="<?=BASEURL?>/User/tambah" method="post">
        <div class="content">
            <p class="judul fw-semibold">Proses Peminjaman</p>
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
                    <input type="text" class="form-control" id="username" name="id_user" value="<?=$_SESSION['id_user']?>" disabled>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
                <div class="mb-2 row">
                    <label for="Mulai" class="col-sm-3 col-form-label fw-normal">Mulai Pinjam</label>
                    <div class="col-sm-3">
                        <input type="date" class="form-control" id="tgl_pinjam" name="tanggal_peminjaman">
                    </div>
                    <label id="label-sampai" for="Sampai" class="col-sm-1 col-form-label fw-normal">Sampai</label>
                    <div class="col-sm-3">
                        <input type="date" class="form-control" id="tgl_kembali" name="tanggal_pengembalian">
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
                <button class="tombol pinjam" type="button">Pinjam!</button>
            </div>

        </div>
    </form>
</div>
<script>
    // Path: proses.php


    $('.kembali').click(function() {
        window.location.href = "<?=BASEURL?>/User";
    });

    let table = new DataTable('#table', {
        scrollY: '355px',
        dom: 't',
        columns: [
            { data: 'gambar', },
            { data: 'nama', },
            { data: null, },
            { data: null, },
            { data: null, },
            { data: 'id', },
        ],
        columnDefs: [

            {
                targets: 0,
                sortable: false,
                render: function(data, type, row, meta) {
                    return `<img src="<?=BASEURL?>/img/${data}" alt="Gambar" class="object-fit-cover border rounded" width="98px" height="70px">`;
                }
            },
            {
                targets: 1,
                sortable: false,
                render: function(data, type, row, meta) {
                    return `<p class="text-primary align-middle">${data}</p>`;
                }
            },
            {
                targets: 2,
                sortable: false,
                render: function(data, type, row, meta) {
                    return `<input type="number" class="jumlah form-control-sm w-25 text-center" value="1">`;
                }
            },
            {
                targets: 3,
                sortable: false,
                render: function(data, type, row, meta) {
                    return `<textarea class="catatan form-control-lg" rows="2"></textarea>`;
                }
            },
            {
                targets: 4,
                sortable: false,
                render: function(data, type, row, meta) {
                    return `<img src="<?=BASEURL?>/assets/hapus.svg" alt="hapus" class="alt-button hapus">`;
                }
            },
            {
                targets: 5,
                visible: false,
            },
        ],
        createdRow: function(row, data, dataIndex) {
            $(row).attr('id', data.id);
        }
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

    $('.pinjam').on('click', () => {
        let form = $('form');
        let data = table.rows().data();
        let barang = [];
        for (let i = 0; i < data.length; i++) {
            let item = {};
            Object.defineProperty(item, 'id_barang', {
                value: data[i].id,
                enumerable: true,
            });
            Object.defineProperty(item, 'jumlah', {
                value: $(`#${data[i].id} input.jumlah`).val(),
                enumerable: true,
            });
            Object.defineProperty(item, 'catatan', {
                value: $(`#${data[i].id} textarea.catatan`).val(),
                enumerable: true,
            });
            barang.push(item);
        }
        let barang_str = [];
        console.log(barang);
        form.append($('<input />', {
            type: "hidden",
            name: "barang",
            value: JSON.stringify(barang)
        }));
        form.submit();
    });

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
                            id: barang.id,
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
    * {
        font-family: 'Montserrat';
    }

    .judul {
        font-size: 30px;
        font-style: normal;
        font-weight: bold;
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

    .button:hover {
        background-color: #f2b91c;
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

    .tombol:hover {
        background-color: #00bd58;
    }

    .judulTabel {
        font-size: 18px;
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
</style>

