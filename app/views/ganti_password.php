  <style>
    :root {
      font-family: Montserrat;
    }

    .content {
        padding-top: 70px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .form-control {
      width: 300px;
      height: 35px;
      flex-shrink: 0;
      border-radius: 2px;
      border: 2px solid #3C8DBB;
      background: #FFF;
      box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.15);
      margin-bottom: 15px;
    }

    .form-group {
      margin-bottom: 1px;
    }

    .btn-primary {
      width: 300px;
      height: 40px;
      margin-top: 30px;
      align-self: center;
    }

    label {
      margin-bottom: -30px;
    }
  </style>
  <div class="content">
    <form action="<?= BASEURL; ?>/UbahPassword/ubah" method="post">
      <div class="form-group">
        <label for="pastPassword" class="form-label" text-primary>Masukkan Password Lama :</label>
        <input type="password" class="form-control" id="pastPassword" placeholder="Masukkan Password Lama"
          name="password_lama">
        <label for="inputPassword" class="form-label" text-primary>Masukkan Password Baru :</label>
        <input type="password" class="form-control" id="Masukkan Password Baru" placeholder="Masukkan Password Baru"
          name="password_baru">
        <label for="confirmPassword" class="form-label">Konfirmasi Password Baru :</label>
        <input type="password" class="form-control" id="Konfirmasi Password Baru" placeholder="Konfirmasi Password"
          name="konfirm_password">
      </div>
      <button type="submit" class="btn btn-primary text-white">Simpan</button>
  </div>
  </form>
