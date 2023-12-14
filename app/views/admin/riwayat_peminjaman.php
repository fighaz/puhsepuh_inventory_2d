
    <h3>Peminjaman</h3>
    <br>
      <!-- NavTabs -->
        <ul class="nav nav-pills primary nav-fill rounded">
        <li class="nav-item rounded-start">
            <a id="semua" class="nav-link active text-white" >Semua</a>
        </li>
        <li class="nav-item">
            <a id="menunggu_konfirmasi" class="nav-link text-white" >Menunggu Konfirmasi</a>
        </li>
        <li class="nav-item">
            <a id="menunggu_diambil" class="nav-link text-white" >Menunggu Diambil</a>
        </li>
        <li class="nav-item">
            <a id="dipinjam" class="nav-link text-white" >Dipinjam</a>
        </li>
        <li class="nav-item">
            <a id="terlambat" class="nav-link text-white" >Terlambat</a>
        </li>
        <li class="nav-item rounded-end">
            <a id="selesai" class="nav-link text-white" >Selesai</a>
        </li>
        <li class="nav-item rounded-end">
            <a id="ditolak" class="nav-link text-white" >Ditolak</a>
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
        <th style="border-top-right-radius: 5px;">Aksi</th>
      </tr>
    </thead>
  </table>
<script>
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
        scrollY: "290px",
        scrollX: true,
        dom: "lrtip",
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
                        badge = `<span class="badge rounded-pill bg-info text-dark">Terlambat</span>`;
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
                    return `
                        <div class="td-wrapper">
                            <a href="" class=""><img class="alt-button rincian" src="<?=BASEURL?>/assets/rincian.svg" alt="rincian"></a>
                            <a href="" class=""><img class="alt-button terima" src="<?=BASEURL?>/assets/check.svg" alt="Selesai"></a>
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
                let id = ev.target.textContent;
                $(".nav .nav-link").removeClass("active");
                console.log(id);
                if (id == "Semua") {
                    table.search("", false, true).draw();
                    $("#semua").addClass("active");
                    return;
                }
                table.search(id, false, true).draw();
                $("#"+ev.target.id).addClass("active");
            });
        }
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
  </style>
