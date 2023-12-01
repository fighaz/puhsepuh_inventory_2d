<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- <link rel="stylesheet" href="css/style.css"> -->
  
  <style>
    * {
      font-family: Montserrat;
    }
    .sidebar {
      position: fixed;
      top: 0;
      left: 0;
      height: 100%;
      width: 260px;
      background-color: #222D30;;
      padding-top: 20px;
    }
    .sidebar a {
      padding: 10px;
      text-decoration: none;
      color: white;
      display: flex;
      align-items: center;
      justify-content: space-between; 
      padding-left: 31px ;
      color: #FFF;
      font-family: Montserrat;
      font-size: 20px;
      font-style: normal;
      font-weight: 400;
      line-height: normal;
    }
    .sidebar a:hover {
        background-color: #E7AE0E;
        font-weight: bold;
    }
    .sidebar .icon {
      margin-right: 30px; 
    }
  </style>
</head>
<body>

<div class="sidebar" id="sidebar">
  <a href="#">
  <a href="javascript:void(0)" class="closebtn" onclick="toggleNav()"><span class="material-symbols-outlined">
menu
    <i class="material-icons" onclick="closeNav()">menu</i>
  </a>
  <a href="#">
    Home <i class="material-icons icon">home</i>
  </a>
  <a href="#">
    Inventaris <i class="material-icons icon">inventory</i>
  </a>
  <a href="#">
    Peminjaman <i class="material-icons icon">note_add</i>
  </a>
  <a href="#">
    Ganti Password <i class="material-icons icon">key</i>
  </a>
</div>

<div class="content" style="margin-left: 250px; padding: 20px;">
  <h2>Isi Konten Halaman</h2>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
