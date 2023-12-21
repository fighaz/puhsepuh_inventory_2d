<form action="<?=BASEURL?>/User/tambah" method="post">
    <p class="judul fw-semibold">PROSES PEMINJAMAN</p>
    <div class="mb-1 row">
        <label for="Nama Peminjam" class="col-sm-2 col-form-label fw-normal">Nama Peminjam</label>
        <div class="col-sm-6">
        <input type="text" class="form-control" id="Nama Peminjam" value="<?=$_SESSION['nama']?>" readonly>
        </div>
        <div class="col-sm-3"></div>
    </div>
    <div class="mb-1 row">
        <label for="NIM/NIP" class="col-sm-2 col-form-label fw-normal">NIM/NIP</label>
        <div class="col-sm-6">
        <input type="text" class="form-control" id="username" name="id_user" value="<?=$_SESSION['id_user']?>" disabled>
        </div>
        <div class="col-sm-3"></div>
    </div>
    <div class="mb-1 row">
        <label for="Mulai" class="col-sm-2 col-form-label fw-normal">Mulai Pinjam</label>
        <div class="col-sm-3">
            <input type="date" class="form-control" id="tgl_pinjam" name="tanggal_peminjaman" onchange="on_change_tgl_pinjam_kembali(this)">
        </div>
        <label id="label-sampai" for="Sampai" class="col-sm-1 col-form-label fw-normal">Sampai</label>
        <div class="col-sm-3">
            <input type="date" class="form-control" id="tgl_kembali" name="tanggal_pengembalian" onchange="on_change_tgl_pinjam_kembali(this)">
        </div>
    </div>

    <p class="d-block judulTabel fw-normal text-center">Item Dipinjam:</p>
    <table id="table" class="table rounded">
        <thead class="rounded-top">
            <tr class="table-primary">
                <th class="fw-normal" style="border-top-left-radius: 5px;">Gambar</th>
                <th class="fw-normal">Nama</th>
                <th class="fw-normal">Jumlah Pinjam</th>
                <th class="fw-normal">Catatan</th>
                <th class="fw-normal" style="border-top-right-radius: 5px;">Aksi</th>
            </tr>
        </thead>

    </table>
    <div class="aksi-page mt-3">
        <button class="button kembali" type="button">Kembali</button>
        <button class="tombol pinjam" type="button">Pinjam!</button>
    </div>
</form>
<script>
    // Path: proses.php

    //function on_change_tgl_pinjam_kembali(obj) {
    //    let today = new Date();
    //    let date = new Date(obj.value);
    //    if (date < today) {
    //        obj.value = today.toISOString().substr(0, 10);
    //        alert("Tanggal tidak boleh lebih awal dari hari ini");
    //        return;
    //    }

    //    let $tgl_pinjam = $('#tgl_pinjam');
    //    let $tgl_kembali = $('#tgl_kembali');
    //    console.log($tgl_pinjam.val(), $tgl_kembali.val());
    //}

    $("#tgl_pinjam").on("change", function() {
        let today = new Date();
        let $tgl_pinjam = $('#tgl_pinjam');
        let $tgl_kembali = $('#tgl_kembali');
        let date = new Date($tgl_pinjam.val());
        if ($tgl_kembali.val() < $tgl_pinjam.val() && $tgl_kembali.val() != "") {
            alert("Tanggal kembali tidak boleh lebih awal dari tanggal pinjam");
            $tgl_pinjam.val("");
            return;
        }
        if (date < today) {
            $tgl_pinjam.val(today.toISOString().substr(0, 10));
            alert("Tanggal tidak boleh lebih awal dari hari ini");
            return;
        }
    });

    $("#tgl_kembali").on("change", function() {
        let today = new Date();
        let $tgl_pinjam = $('#tgl_pinjam');
        let $tgl_kembali = $('#tgl_kembali');
        let date = new Date($tgl_kembali.val());
        if ($tgl_kembali.val() < $tgl_pinjam.val() && $tgl_pinjam.val() != "") {
            alert("Tanggal kembali tidak boleh lebih awal dari tanggal pinjam");
            $tgl_kembali.val("");
            return;
        }
        if (date < today) {
            $tgl_kembali.val(today.toISOString().substr(0, 10));
            alert("Tanggal tidak boleh lebih awal dari hari ini");
            return;
        }
    });

    $('.kembali').click(function() {
        window.location.href = "<?=BASEURL?>/User";
    });

    let table = new DataTable('#table', {
        scrollY: '235px',
        dom: 't',
        columns: [
            { data: 'gambar', },
            { data: 'nama', },
            { data: null, },
            { data: null, },
            { data: null, },
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
                    return `
                        <div class="td-wrapper">
                            <p class="text-primary align-middle">${data}</p>
                        </div>
                    `;
                }
            },
            {
                targets: 2,
                sortable: false,
                render: function(data, type, row, meta) {
                    return `
                        <div class="td-wrapper">
                            <input type="number" class="jumlah form-control-sm w-25 text-center" value="1">
                        </div>
                    `;
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
                    return `
                        <div class="td-wrapper">
                            <img src="<?=BASEURL?>/assets/hapus.svg" alt="hapus" class="alt-button hapus">
                        </div>
                    `;
                }
            },
        ],
        createdRow: function(row, data, dataIndex) {
            $(row).attr('id', data.id);
        },
        initComplete: function() {
        }
    });

    // return object barang
    function getItem(id) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: "<?=BASEURL?>/Barang/detail/" + id,
                dataType: "json",
                success: function(data) {
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
        let alert_arr = [];
        if ($("input#tgl_pinjam").val() == "") {
            alert_arr.push("Tanggal peminjaman tidak boleh kosong");
        }
        if ($("input#tgl_kembali").val() == "") {
            alert_arr.push("Tanggal pengembalian tidak boleh kosong");
        }

        let data = table.rows().data();
        if (data.length == 0) {
            alert_arr.push("Tidak ada barang yang dipinjam");
        }

        if (alert_arr.length > 0) {
            alert(alert_arr.join("\n"));
            return;
        }
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
                for (let item of data) {
                    try {
                        let barang = await getItem(item.id_barang);
                        table.row.add({
                            id: item.id_barang,
                            gambar: barang.gambar,
                            nama: barang.nama,
                            tersedia: barang.tersedia,
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
        table.on('keyup', 'tbody input.jumlah', (ev) => {
            let input = ev.target;
            let data = table.row($(input).parents('tr')).data();
            if ($(input).val() > data.tersedia) {
                $(input).val(data.tersedia);
            } else if ($(input).val() < 1) {
                $(input).val(1);
            }
        });
        table.on('change', 'tbody input.jumlah', (ev) => {
            let input = ev.target;
            let data = table.row($(input).parents('tr')).data();
            if ($(input).val() > data.tersedia) {
                $(input).val(data.tersedia);
            } else if ($(input).val() < 1) {
                $(input).val(1);
            }
        });
        table.on('change', 'tbody input#tgl_pinjam', (ev) => {
            // limit date of borrowing to not earlier than today
            let $input = $(ev.target);
            $input.attr('min', new Date().toISOString().substr(0, 10));
            console.log($input.val());
            let today = new Date();
            let date = new Date($input.val());
            if (date < today) {
                $input.val(today.toISOString().substr(0, 10));
            }
        });

        table.on('click', 'tbody .alt-button.hapus', (ev) => {
            let $button = $(ev.target);
            let $row = $button.parents('tr');
            let data = table.row($row).data();
            $.ajax({
                url: '<?=BASEURL?>/User/removeFromCart/' + $row.attr('id'),
                type: 'GET',
                dataType: 'json',
                success: function(_) {
                    console.log("success");
                    $row.remove().draw();
                },
                error: function(err) {
                    console.log("error");
                    console.log(err);
                }
            });
        });
    });

</script>
<style>
    * {
        font-family: 'Montserrat';
    }

    #content {
        font-size: 14px !important;
    }

    .judul {
        font-size: 20px;
        font-style: normal;
        font-weight: bold;
        color: #E7AE0E;
    }

    .button {
        background-color: #E7AE0E;
        height: 100%;
        flex-shrink: 0;
        border-radius: 5px;
        color: #fff;
        border: none;
    }

    .button:hover {
        background-color: #f2c92c;
        box-shadow: 0px 0px 10px #f2c92c;
    }

    .tombol {
        background-color: #3C8DBB;
        height: 100%;
        flex-shrink: 0;
        border-radius: 5px;
        background: #00B152;
        color: #fff;
        border: none;
    }

    .tombol:hover {
        background-color: #00bd58;
        box-shadow: 0px 0px 10px #00bd58;
    }

    .judulTabel {
        font-size: 18px;
        line-height: normal;
        color: #3C8DBB;
        margin: 12px 0 5px 0;
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

    .table_wrapper {
        border: 3px solid #3C8DBB;
        border-radius: 3px;
    }

    /* Styles for the table */
    .table-primary th {
        background-color: #3C8DBB;
        color: #fff; ;
    }

    .dataTables_scrollHead thead th {
        padding: 6px !important;
    }

    thead th {
      border: 1px solid #fff;
    }

    .aksi-page {
        height: 41px;
        display: grid;
        grid-template-columns: 1fr 4fr;
        gap: 10px;
    }

    img {
        object-fit: cover;
    }
</style>

