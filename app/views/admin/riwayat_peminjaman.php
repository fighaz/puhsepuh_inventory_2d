
    <h3>Peminjaman</h3>
    <br>
      <!-- NavTabs -->
        <ul class="nav nav-pills primary nav-fill rounded">
            <li class="nav-item rounded-start">
                <a id="tab0" class="nav-link active text-white" >Semua</a>
            </li>
            <li class="nav-item">
                <a id="tab1" class="nav-link text-white" >Menunggu Konfirmasi</a>
            </li>
            <li class="nav-item">
                <a id="tab2" class="nav-link text-white" >Menunggu Diambil</a>
            </li>
            <li class="nav-item">
                <a id="tab3" class="nav-link text-white" >Dipinjam</a>
            </li>
            <li class="nav-item">
                <a id="tab4" class="nav-link text-white" >Terlambat</a>
            </li>
            <li class="nav-item">
                <a id="tab5" class="nav-link text-white" >Selesai</a>
            </li>
            <li class="nav-item rounded-end">
                <a id="tab6" class="nav-link text-white" >Ditolak</a>
            </li>
        </ul>
    <br>

  <table class="table rounded" id="table">
    <thead class="rounded-top">
      <tr class="bg-primary">
        <th style="border-top-left-radius: 5px;">ID</th>
        <th>Nama Peminjam</th>
        <th>Status</th>
        <th>Barang</th>
        <th>Tanggal Pinjam</th>
        <th style="border-top-right-radius: 5px; min-width: 200px;">Aksi</th>
      </tr>
    </thead>
  </table>

<script>

    let id_tab = "semua";
    let text_tab = "Semua";

    function getNamaUser(id) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: "<?=BASEURL?>/Peminjam/getNama/" + id,
                method: "GET",
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

    let table = new DataTable("#table", {
        ajax: "<?=BASEURL?>/Admin/getAllPeminjaman",
        order: [[0, "desc"]],
        scrollY: "310px",
        scrollX: true,
        columns: [
            {
                data: "id",
                sortable: false,
                render: function(data, type, row) {
                    return ` <div class="td-wrapper"> ${data} </div> `;
                }
            },
            {
                data: "id_user",
                sortable: false,
                render: function(data, type, row) {
                    return `<div class="td-wrapper text-primary">Loading...</div>`
                },
                createdCell: async function(td, cellData, rowData, row, col) {
                    try {
                        let nama = await getNamaUser(cellData);
                        $(td).html(`<div class="td-wrapper text-primary">${nama}</div>`);
                    } catch (err) {
                        console.log(err);
                        $(td).html(`<div class="td-wrapper text-primary">Error</div>`);
                    }
                }
            },
            {
                data: "status",
                sortable: false,
                render: function(data, type, row, meta) {
                    let badge = "";
                    if (data == 'dipinjam') {
                        badge = `<span class="badge rounded-pill bg-primary">dipinjam</span>`;
                    } else if (data == 'menunggu_konfirmasi') {
                        badge = `<span class="badge rounded-pill bg-secondary">Menunggu Konfirmasi</span>`;
                    } else if (data == 'menunggu_diambil') {
                        badge = `<span class="badge rounded-pill bg-warning text-dark">Menunggu diambil</span>`;
                    } else if (data == 'ditolak') {
                        badge = `<span class="badge rounded-pill bg-danger">Ditolak</span>`;
                    } else if (data == 'selesai') {
                        badge = `<span class="badge rounded-pill bg-success">Selesai</span>`;
                    } else if (data == 'terlambat') {
                        badge = `<span class="badge rounded-pill bg-info text-white">Terlambat</span>`;
                    } else {
                        badge = `<span class="badge rounded-pill bg-danger">Something went wrong</span>`;
                    }
                    return `
                        <div class="td-wrapper">
                            ` + badge + `
                        </div>
                    `;
                }
            },
            {
                data: null,
                sortable: false,
                render: function(data, type, row) {
                    return ` <div class="td-wrapper">Loading...</div>`;
                },
                createdCell: async function(td, cellData, rowData, row, col) {
                    $.ajax({
                        url: "<?=BASEURL?>/Admin/getBarangFromPeminjaman/" + rowData.id,
                        method: "GET",
                        dataType: "json",
                        success: function(data) {
                            $(td).html(`<div class="td-wrapper">` + data.join("<br>") + `</div>`);
                        },
                        error: function(err) {
                            console.log(err);
                            $(td).html(`<div class="td-wrapper">Something went wrong</div>`);
                        }
                    });
                }
            },
            {
                data: "tanggal_peminjaman",
                sortable: false,
                render: function(data, type, row) {
                    return ` <div class="td-wrapper">${data}</div>`;
                },
            },
            {
                data: null,
                sortable: false,
                render: function(data, type, row) {
                    const rincian_button = '<a class=""><img class="alt-button rincian" src="<?=BASEURL?>/assets/rincian.svg" alt="rincian" title="rincian"></a>';
                    let edit_button = '<a class=""><img class="alt-button edit" src="<?=BASEURL?>/assets/edit.svg" alt="edit" title="edit"></a>';
                    let approve_button = "";
                    let decline_button = "";
                    if (row.status == "menunggu_konfirmasi") {
                        approve_button = '<a class=""><img class="alt-button terima" src="<?=BASEURL?>/assets/check.svg" alt="terima" title="terima"></a>';
                        decline_button = '<a class=""><img class="alt-button tolak" src="<?=BASEURL?>/assets/tolak.svg" alt="tolak" title="tolak"></a>';
                    } else if (row.status == "menunggu_diambil") {
                        approve_button = '<a class=""><img class="alt-button ambil" src="<?=BASEURL?>/assets/check.svg" alt="ambil" title="konfirmasi ambil"></a>';
                    } else if (row.status == "dipinjam" || row.status == "terlambat") {
                        approve_button = '<a class=""><img class="alt-button selesai" src="<?=BASEURL?>/assets/check.svg" alt="selesai" title="selesai"></a>';
                        edit_button = "";
                    } else {
                        edit_button = "";
                    }

                    return `
                        <div class="td-wrapper">
                            ${rincian_button}
                            ${edit_button}
                            ${decline_button}
                            ${approve_button}
                        </div>
                    `;
                },

            },
        ],
        initComplete: () => {
            let search = $("#search");

            search.on("keyup", () => {
                table.search(search.val(), false, true).draw();
            });

            $(".nav .nav-link").on('click', (ev) => {
                let id = ev.target.id;
                let text = ev.target.textContent;
                $(".nav .nav-link").removeClass("active");
                console.log(text);
                if (text == "Semua") {
                    table.search("", false, true).draw();
                } else {
                    table.search(text, false, true).draw();
                }
                $("#"+id).addClass("active");
                id_tab = id;
                text_tab = text;
            });

            table.on('click', 'tbody .alt-button.edit', (event) => {
                let data = table.row(event.target.closest('tr')).data();
                window.location.href = "<?=BASEURL?>/Admin/ubahPeminjaman/" + data.id;
            });

            table.on('click', 'tbody .alt-button.rincian', (event) => {
                let data = table.row(event.target.closest('tr')).data();
                window.location.href = "<?=BASEURL?>/Admin/detailPeminjaman/" + data.id;
            });

            table.on('click', 'tbody .alt-button.terima', function() {
                let data = table.row($(this).parents('tr')).data();
                const encodedIdTab = encodeURIComponent(id_tab);
                const encodedTextTab = encodeURIComponent(text_tab);
                window.location.href = `<?=BASEURL?>/Admin/approve/${data.id}?id_tab=${encodedIdTab}&text_tab=${encodedTextTab}`;
            });

            table.on('click', 'tbody .alt-button.tolak', function() {
                let data = table.row($(this).parents('tr')).data();
                const encodedIdTab = encodeURIComponent(id_tab);
                const encodedTextTab = encodeURIComponent(text_tab);
                window.location.href = `<?=BASEURL?>/Admin/tolak/${data.id}/${encodedIdTab}/${encodedTextTab}`;
            });

            table.on('click', 'tbody .alt-button.ambil', function() {
                let data = table.row($(this).parents('tr')).data();
                const encodedIdTab = encodeURIComponent(id_tab);
                const encodedTextTab = encodeURIComponent(text_tab);
                window.location.href = `<?=BASEURL?>/Admin/approveAmbil/${data.id}/${encodedIdTab}/${encodedTextTab}`;
            });

            table.on('click', 'tbody .alt-button.selesai', function() {
                let data = table.row($(this).parents('tr')).data();
                const encodedIdTab = encodeURIComponent(id_tab);
                const encodedTextTab = encodeURIComponent(text_tab);
                window.location.href = `<?=BASEURL?>/Admin/pinjamSelesai/${data.id}/${encodedIdTab}/${encodedTextTab}`;
            })
        }
    });

    $(document).ready(function() {
        let id = "<?=isset($data['id_tab']) ? $data['id_tab'] : "tab0"?>";
        let text = "<?=isset($data['text_tab']) ? $data['text_tab'] : "Semua"?>";
        $(".nav .nav-link").removeClass("active");
        console.log("id_tab: ", id);
        console.log("text_tab: ", text);
        if (text == "Semua") {
            table.search("", false, true).draw();
        } else {
            table.search(text, false, true).draw();
        }
        $("#"+id).addClass("active");
        id_tab = id;
        text_tab = text;
    });


</script>

  <style>
    :root {
      font-family: Montserrat;
    }         

    #content p {
      color: #3C8DBB;
        font-size: 14px;
    }


  /* Table */
  thead {
    font-size: 15px;
    color: #fff;
    font-weight: normal;
    text-align: center;
  }

  thead th {
    border: 2px solid #fff;
  }

  tbody {
    text-align: center;
  }

  tbody td {
    border-bottom: 1px solid #3C8DBB;
  }

    /* Table 
    thead {
      font-size: 16px;
      color: #fff;
      background-color: #3C8DBB;
      font-weight: normal;
      text-align: center;

    }

    tbody td {
      border-bottom: 1px solid #3C8DBB;
    }
*/

    .dataTables_scrollHead thead th {
        padding: 5px !important;
    }
    .nav-link {
        padding: 5px 5px;
    }
    .nav-pills .nav-link.active {
        background-color: var(--bs-accent);
    }
    .nav-item  {
        background-color: var(--bs-primary) !important;
        cursor: pointer;
        border: 1px solid var(--bs-primary);
    }

    .nav-item:hover {
        font-weight: bold;
        text-decoration: underline;
        text-decoration-color: white;
    }
    /* Entries */
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

      /* Search */
      .search button{
        top: 5px;
        right: 5px;
        height: 54px;
        width: 160px;
        background: #3C8DBB;
      }

      .search {
        display: flex;
        align-items: center;
      }

      .search input {
        height: 54px;
        width: 734;
        border-radius: 5px;
        border: 3px solid #3C8DBB;
        display: flex;
        align-items: center;
        margin-right: 10px;
      }

    .terima:hover {
        border: 3px solid #4ECB71;
    }

    .td-wrapper {
        height: auto;
        min-height: 40px;
    }
.alt-button {
    width:  40px;
    height: 40px;
}

.dataTables_paginate {
    margin-top: 10px !important;
}

  </style>
