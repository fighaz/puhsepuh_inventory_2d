$(".tombolTambahDataPeminjam").on("click", function () {
    $("#formModalPeminjamLabel").html("Tambah Data peminjam");
    $(".modal-footer button[type=submit]").html("Tambah Data");
    $("#username").val("");
    $("#nama").val("");

  });