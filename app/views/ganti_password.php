  <style>
    :root {
      font-family: Montserrat;
    }

    #content {
        padding: 127px;
    }

    .btn-primary {
        height: 40px;
        width: 300px;
        margin-top: 30px;
    }

    .form-group {
        margin-top: 5px;
    }

    label {
        margin-bottom: 0 !important;
    }
  </style>

  
  <div class="container d-flex align-items-center justify-content-center">
    <form action="<?= BASEURL; ?>/UbahPassword/ubah" method="post">
      <div class="form-group">
        <label for="pastPassword" class="form-label">Masukkan Password Lama :</label>
        <input type="password" class="form-control border border-primary shadow-sm border-3" id="pastPassword" placeholder="Masukkan Password Lama" name="password_lama">
      </div>
      <div class="form-group">
        <label for="inputPassword" class="form-label">Masukkan Password Baru :</label>
        <input type="password" class="form-control border border-primary shadow-sm border-3" id="inputPassword" placeholder="Masukkan Password Baru" name="password_baru">
      </div>
      <div class="form-group">
        <label for="confirmPassword" class="form-label">Konfirmasi Password Baru :</label>
        <input type="password" class="form-control border border-primary shadow-sm border-3" id="confirmPassword" placeholder="Konfirmasi Password" name="konfirm_password">
      </div>
      <button type="submit" class="btn btn-primary text-white">Simpan</button>
    </form>
  </div>
