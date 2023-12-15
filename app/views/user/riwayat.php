    <h3>Riwayat Peminjaman</h3>
    <br>

    <div class="search-wrapper d-flex flex-row mb-3">
        <input type="text" class="form-control" id="search" placeholder="Cari barang">
        <button class="btn btn-primary text-white d-flex flex-row">
            Cari
            <img src="<?=BASEURL?>/assets/search.svg" alt="search" class="alt-button search">
        </button>
    </div>

    <table id="table" class="table table-hover rounded mt-2">
      <thead class="bg-primary rounded-top">
        <tr>
          <th style="border-top-left-radius: 5px;">ID</th>
          <th>Status peminjaman</th>
          <th>Barang</th>
          <th>Tanggal Pinjam</th>
          <th>Tanggal Pengembalian</th>
          <th style="border-top-right-radius: 5px;">Aksi</th>
        </tr>
      </thead>
    </table>

<script> 

    function getBarangs(id) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: '<?=BASEURL?>/User/getBarangFromPeminjaman/' + id,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    resolve(data);
                },
                error: function(err) {
                    console.log(err);
                    reject(err);
                }
            });
        });
    }

    let table = new DataTable("#table", {
        ajax: "<?=BASEURL?>/User/getAllPeminjaman",
        dom: "lrtip",
        scrollY: '300px',
        columns: [
            {
                data: "id",
                sortable: false,
            },
            {
                data: "status",
                sortable: false,
                render: function(data, type, row, meta) {
                    if (data == 'dipinjam') {
                        return `<span class="badge rounded-pill bg-primary">dipinjam</span>`;
                    } else if (data == 'menunggu_konfirmasi') {
                        return `<span class="badge rounded-pill bg-secondary">Menunggu Konfirmasi</span>`;
                    } else if (data == 'menunggu_diambil') {
                        return `<span class="badge rounded-pill bg-warning text-dark">Menunggu diambil</span>`;
                    } else if (data == 'ditolak') {
                        return `<span class="badge rounded-pill bg-danger">Ditolak</span>`;
                    } else if (data == 'selesai') {
                        return `<span class="badge rounded-pill bg-success">Selesai</span>`;
                    } else if (data == 'terlambat') {
                        return `<span class="badge rounded-pill bg-info text-dark">Terlambat</span>`;
                    } else {
                        return `<span class="badge rounded-pill bg-danger">Something went wrong</span>`;
                    }
                }
            },
            {
                data: null,
                sortable: false,
                render: function(data, type, row, meta) {
                    return `<span>loading...</span>`;
                },
                createdCell: async function(cell, cellData, rowData, rowIndex, colIndex) {
                    try {
                        let barangs = [];
                        barangs = await getBarangs(rowData.id);
                        let barangs_str = barangs.length == 0 ? "Something went wrong" :
                            barangs.join("<br>");
                        $(cell).html(barangs_str);
                    } catch (err) {
                        console.log(err);
                        $(cell).text("Something went wrong");
                    }
                }
            },
            {
                data: "tanggal_peminjaman",
                sortable: false,
            },
            {
                data: "tanggal_pengembalian",
                sortable: false,
            },
            {
                data: null,
                sortable: false,
                className: "aksi",
                render: function(data, type, row, meta) {
                    return `
                        <a class="icon_edit"><img src="<?=BASEURL?>/assets/edit.svg" class="alt-button" alt="edit"></a>
                        <a class="icon_tolak"><img src="<?=BASEURL?>/assets/tolak.svg" class="alt-button" alt="Tolak"></a>
                        <a class="icon_rincian"><img src="<?=BASEURL?>/assets/rincian.svg" class="alt-button" alt="rincian"></a>
                    `;
                }
            }
        ],
    });
</script>

  <style>
    :root {
      font-family: Montserrat;
    }         
    html, body {
      background-color: #EBEFF5;
    }

    .content {
      padding: 14px 42px 14px 42px;
    }
    .content h2 {
      font-size: 40px;
      color: #E7AE0E;
    }

    .content h3 {
      font-size: 30px;
      color: #E7AE0E;
    }

    .content p {
      color: #3C8DBB;
    }

    .search-wrapper {
        margin-left: 0;
    }

    /* Table */
    thead {
      font-size: 16px;
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


    .alt-button {
        margin: 0;
        border: none;
        border-radius: 40px;
        width:  35px;
        height: 35px;
    }
  </style>

