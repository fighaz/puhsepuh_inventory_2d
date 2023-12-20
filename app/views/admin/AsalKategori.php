  <div class="content">
    <h3>List Asal</h3>
    <br>
    <div id="list-asal" class="d-flex flex-direction-column"> 
        <label style="margin-right: 85px;">Asal:</label>
        <table class="table-sm AsalList text-primary rounded">
            <thead class="text-white bg-primary rounded-top">
                <tr class="rounded-top">
                    <th style="border-top-left-radius: 5px;">Asal</th>
                    <th>Keterangan</th>
                    <th style="border-top-right-radius: 5px; max-width: 40px !important;">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-primary" style="max-height: 10px !important;">
                <?php 
                foreach ($data['asal'] as $asal) { ?>
                    <tr>
                        <td class=""><?=$asal['nama']?></td>
                        <td><?=$asal['keterangan']?></td>
                        <td> <a href="" id="<?=$asal['id']?>" class="btn-hapus"><img src="<?=BASEURL?>/assets/hapus.svg" title="hapus" class="alt-button hapus"></a> </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div>
      <br>
      <h3>Tambah Asal</h3>
      <br>
      <form action="<?=BASEURL?>/Asal/tambah" method="post">
      <table class="table-tambah text-primaryk" style="max-width: 39vw;">
        <tbody style="background-color: var(--background-global);">
          <tr>
            <td><label for="Asal_Barang" class="form-label" style="min-width: 115px;">Asal Barang:</label></td>
            <td colspan="2"><input type="text" name="nama" id="nama_barang" class="form-control-sm" required></td>
          </tr>
          <tr>
            <td><label for="keterangan" class="form-label">Keterangan:</label></td>
            <td colspan="2"><textarea rows="4" cols="50" name="keterangan" id="keterangan" class="form-control-sm"></textarea></td>
          </tr>
          <tr>
            <td></td>
            <td><button type="submit" class="btn btn-primary w-100 text-white">Tambah</button></td>
          </tr>
        </tbody>
      </table>
      </form>
    </div>
  </div>

<script> 
    $(".alt-button.hapus").on('click', function(e) {
        e.preventDefault();
        var id = $(this).parent().attr("id");
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3C8DBB',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?=BASEURL?>/Asal/hapus/" + id;
            }
        })
    });
</script>

  <style>

    .alt-button {
        width:  35px;
        height: 35px;
    }
    
    td:has(label) {
        text-align: left;
        display: flex;
        justify-content: left;
        align-items: flex-start;
    }


    .content h3 {
      font-size: 30px;
      color: #E7AE0E;
    }

    .AsalList .text-primary td:nth-child(1) {
      text-align: center;
      width: 17%;
      padding: 8px;
    }

    .AsalList .bg-white td:nth-child(2),
    .AsalList .bg-white td:nth-child(3) {
      width: 50%;
      height: 100%;
      background: white;
      border-radius: 5px;
      border: 3px #3C8DBB solid;
    }

    .table-tambah {
      background-color: #EBEFF5;
    }

    .form-control-sm {
      display: block;
      border-radius: 5px;
      border: 2px #3C8DBB solid;
      width: 100%;
    }

    table.AsalList {
        display: block;
        max-width: 30vw;
        max-height: 170px;
        overflow-y: scroll;
    }
    
    th {
        padding: 0.3rem 0.5rem !important;
    }
  </style>
