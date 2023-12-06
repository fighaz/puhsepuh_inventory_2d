<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="../../../public/css/style.css" rel="stylesheet">
  <link href="../../../public/css/bootstrap.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  
  <style>
    :root {
      font-family: Montserrat;
    }         
    * {
      background-color: #EBEFF5;
    }
    
    .content {
      padding: 35px 90px 45px 90px;
      border: 2px solid #3C8DBB;
      color: #3C8DBB;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    #num-of-entries {
      background-color: var(--background-global);
      color: var(--bs-primary);
      max-width: 50px;
      max-height: 10px;
      height: 10px;
      margin: 0.5px;
      font-size: 12px;
      padding: 0 0 0 15px;
      border: 1px solid var(--bs-primary);
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
</head>
<body>
  <div class="content">
    <div class="form-group">
      <label for="pastPassword" class="form-label" text-primary>Masukkan Password Lama :</label>
      <input type="password" class="form-control" id="pastPassword" placeholder="Masukkan Password Lama">
      <label for="inputPassword" class="form-label" text-primary>Masukkan Password Baru :</label>
      <input type="password" class="form-control" id="Masukkan Password Baru" placeholder="Masukkan Password Baru">
      <label for="confirmPassword" class="form-label">Konfirmasi Password Baru :</label>
      <input type="password" class="form-control" id="Konfirmasi Password Baru" placeholder="Konfirmasi Password">
    </div>
    <button type="button" class="btn btn-primary text-white" >Simpan</button>
  </div>
</body>
</html>
