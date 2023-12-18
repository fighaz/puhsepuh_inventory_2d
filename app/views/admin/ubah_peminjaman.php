<form> <!-- action="<?=BASEURL?>/User/tambah" method="post">-->
    <p class="judul fw-semibold">DETAIL PEMINJAMAN</p>
    <table class="info display">
        <tr>
            <td>Nama Peminjam</td>
            <td>:</td>
            <td colspan="2">
                <input value="<?=$data['peminjaman']['nama_user']?>" class="form-control-sm w-100" disabled>
            </td>
        </tr>
        <tr>
            <td>NIM/NIP</td>
            <td>:</td>
            <td colspan="2">
                <input value="<?=$data['peminjaman']['username_user']?>" class="form-control-sm w-100" disabled>
            </td>
        </tr>
        <tr>
            <td>Mulai Pinjam</td>
            <td>:</td>
            <td>
                <input value="<?=$data['peminjaman']['tanggal_peminjaman']?>" class="form-control-sm w-75" type="date">
            </td>
            <td>Sampai</td>
            <td>:</td>
            <td>
                <input value="<?=$data['peminjaman']['tanggal_pengembalian']?>" class="form-control-sm w-75" type="date">
            </td>
        </tr>
    </table>

    <p class="d-block judulTabel fw-semibold text-center">ITEM DIPINJAM:</p>
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
        <div>
            <button class="btn kembali" type="button">Kembali</button>
        </div>
        <div>
            <button class="btn simpan" type="button" style="min-width: 300px;">Simpan</button>
        </div>
<!--
        <button class="button kembali" type="button">Kembali</button>
        <button class="tombol pinjam" type="button">Pinjam!</button>
-->
    </div>
</form>
<script>

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
        window.location.href = "<?php
            if (isset($_SESSION['prev_page'])) {
                echo BASEURL . $_SESSION['prev_page'];
            } else {
                echo BASEURL;
            }
        ?>";
    });

    let table = new DataTable('#table', {
        ajax: '<?=BASEURL?>/Admin/getDetailBarangFromPeminjaman/' + "<?=$data['peminjaman']['id']?>",
        scrollY: '235px',
        dom: 't',
        columns: [
            {
                data: 'gambar_barang', 
                sortable: false,
                render: function(data, type, row, meta) {
                    return `<img src="<?=BASEURL?>/img/${data}" alt="Gambar" class="object-fit-cover border rounded" width="98px" height="70px">`;
                }
            },
            { 
                data: 'nama_barang', 
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
                data: 'jumlah', 
                sortable: false,
                render: function(data, type, row, meta) {
                    return `
                        <div class="td-wrapper">
                            <input type="number" class="jumlah form-control-sm w-25 text-center" value="${data}">
                        </div>
                    `;
                }
            },
            {
                data: 'keterangan', 
                sortable: false,
                render: function(data, type, row, meta) {
                    return `
                        <div class="td-wrapper">
                            <textarea class="catatan form-control-lg" rows="2">${data}</textarea>
                        </div>
                    `;
                }
            },
            {
                data: null, 
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
        table.on('keyup', 'tbody input.jumlah', (ev) => {
            let input = ev.target;
            let data = table.row($(input).parents('tr')).data();
            if ($(input).val() > data.barang_tersedia) {
                $(input).val(data.barang_tersedia);
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

    .top-container {
        font-size: 15px !important;
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
        font-size: 17px;
        font-weight: 600;
        line-height: normal;
        color: #3C8DBB;
        margin: 12px 0 5px 0;
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
        display: flex;
        justify-content: space-between;
    }

    table.info {
        max-width: 60%;
    }

    table.info tr {
        border: none;
        background-color: var(--background-global);
        padding: 11px !important;
        text-align: left;
    }

</style>

