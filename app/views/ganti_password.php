  <style>
    :root {
      font-family: Montserrat;
    }

    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .content {
      padding-top: 70px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    

    .btn-primary {
      width: 300px;
      height: 40px;
      margin-top: 30px;
    }

    #login-form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
  </style>
  
  <div class="container d-flex align-items-center justify-content-center vh-100">
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
  </form>
