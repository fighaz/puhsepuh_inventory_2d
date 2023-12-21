    <h1>Ubah Barang</h1>
    <form action="<?=BASEURL?>/Barang/ubah" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?=$data['brg']['id_barang']?>">
            <div class="row">
                <section class="col-md-8 p-2">
                    <table class="table text-primary">
                        <tbody>
                            <tr>
                                <td><label for="nama_barang" class="form-label">Nama Barang</label></td>
                                <td><input value="<?=$data['brg']['nama']?>" type="text" name="nama" id="nama_barang" class="form-control-sm" required>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="qty" class="form-label">Jumlah</label></td>
                                <td><input value="<?=$data['brg']['jumlah']?>" type="number" name="jumlah" id="jumlah" class="form-control-sm" required></td>
                            </tr>
                            <tr>
                                <td><label for="qty" class="form-label">Tersedia</label></td>
                                <td><input value="<?=$data['brg']['tersedia']?>" type="number" name="tersedia" id="tersedia" class="form-control-sm" required>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="maks_pinjam" class="form-label">Kondisi</label></td>
                                <td class="d-flex justify-content-left">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="kondisi" id="inlineRadio1"
                                            value="Baik" <?= ($data['brg']['kondisi'] == "Baik" ? 'checked="checked"' : '') ?>>
                                        <label class="form-check-label" for="inlineRadio1">Baik</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="kondisi" id="inlineRadio2"
                                            value="Rusak" <?= ($data['brg']['kondisi'] == "Rusak" ? 'checked="checked"' : '') ?>>
                                        <label class="form-check-label" for="inlineRadio2">Rusak</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="asal" class="form-label">Asal</label></td>
                                <td>
                                    <select value="<?=$data['brg']['asal']?>" class="form-select-sm custom-button bg-white border-2 d-block rounded"
                                        aria-label="Default select example" name="asal" id="asalSelect" >
                                        <?php foreach ($data['asal'] as $asal): ?>
                                            <option value="<?= $asal['id'] ?>" <?= ($asal['id'] == $data['brg']['id_asal'] ? "selected" : "") ?>>
                                                <?= $asal['nama'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                        <option value="advance">
                                            advance...
                                        </option>
                                    </select>
                                </td>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="keterangan" class="form-label">Keterangan</label></td>
                                <td><textarea rows="4" cols="50" name="keterangan" id="keterangan"
                                        class="form-control-sm"><?=$data['brg']['keterangan']?></textarea></td>
                            </tr>
                            <tr>
                                <td><label for="maintainer" class="form-label">Maintainer</label></td>
                                <td><input value="<?=$data['brg']['maintainer']?>" type="text" name="maintainer" id="maintainer" class="form-control-sm" required></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td colspan="2" class="text-center"><button type="submit"
                                        class="btn btn-primary btn-lg text-white">SIMPAN</button></td>
                            </tr>
                        </tbody>
                    </table>

                </section>
                <section class="upload-gambar col-md-4 pr-4 pt-3">
                    <!-- Tambahkan class untuk area gambar -->
                    <div class="image-upload-container border border-primary rounded">
                        <input value="<?=$data['brg']['gambar']?>" type="file" name="gambar" id="gambar" class="form-control-sm" required>
                        <div class="highlight-text text-black">Drop disini</div>
                        <img id="preview" src="<?=BASEURL . '/img/' . $data['brg']['gambar']?>" alt="Upload Gambar" style="display: none;">
                        <div class="btn-close gambar" style="display: none;">
                            <i class="fas fa-times"></i>
                    </div>
                </section>
            </div>
    </form>
    <script>
        document.getElementById('gambar').addEventListener('change', function (e) {
            var preview = document.getElementById('preview');
            preview.src = URL.createObjectURL(e.target.files[0]);
            $("#gambar").css("display", "none");
            $("#preview").css("display", "block");
            $(".highlight-text").removeClass('alt-show');
            $(".btn-close.gambar").css("display", "block");
        });

        $(document).ready(function() {
            $("#gambar").css("display", "none");
            $("#preview").css("display", "block");
            $(".btn-close.gambar").css("display", "block");
            $(".image-upload-container").on('dragover', function(e) {
                e.preventDefault();
                $(this).addClass('highlight');
                $(".highlight-text").addClass('alt-show');
            });

            $(".image-upload-container").on('dragleave', function(e) {
                e.preventDefault();
                $(this).removeClass('highlight');
                $(".highlight-text").removeClass('alt-show');
            });


            $(".image-upload-container").on('drop', function(e) {
                e.preventDefault();
                $("#gambar")[0].files = e.originalEvent.dataTransfer.files;
                $("#preview").attr('src', URL.createObjectURL(e.originalEvent.dataTransfer.files[0]));
                $(this).removeClass('highlight');
                $("#gambar").css("display", "none");
                $("#preview").css("display", "block");
                $(".highlight-text").removeClass('alt-show');
                $(".btn-close.gambar").css("display", "block");
            });

            $(".btn-close.gambar").on('click', function(e) {
                e.preventDefault();
                $("#gambar")[0].files = null;
                $("#preview").attr('src', '#');
                $("#preview").css("display", "none");
                $("#gambar").css("display", "block");
                $(this).css("display", "none");
            });

            $('#asalSelect').on('change', function() {
                var selectedValue = $(this).val();

                if (selectedValue === 'advance') {
                   
                    window.location.href = '<?=BASEURL?>/Asal';
                } else {

                }
            });
        });

        $(".btn[type=submit]").on('click', function(e) {
            $("form").submit();
        });

    </script>
    <style>
        .btn-primary {
            font-size: 18px;
            color: white;
            width: 100%;
        }

        h1 {
            color: #E7AE0E;
        }

        tbody {
            background-color: inherit;
        }

        tbody > tr {
            width: 100%;
        }

        td:has(>label) {
            text-align: left;
        }

        /* Tambahkan style untuk area gambar */
        .image-upload-container {
            position: relative;
            width: 350px;
            height: 350px;
            border: 10px solid #007BFF;
            padding: 40px;
            text-align: center;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }

        .image-upload-container > * {
            position: relative;
        }

        .image-upload-container img {
            max-width: 100%;
            max-height: 200px;
            object-fit: cover;
            display: block;
            margin: 0 auto;
        }

        .highlight-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: none;
            color: var(--bs-primary);
            z-index: 2;
        }

        #preview {
            display: none;
            z-index: 1;
        }

        .form-control-sm {
            display: block;
            width: 100%;
            border: 2px solid var(--bs-primary);
        }

        .form-select-sm {
            width: 100%;
        }

        .form-label {
            text-align: left !important;
        }

        .save-button-container {
            text-align: center;
            margin-top: 20px;
        }
    .table > :not(caption) > * > * {
        border-bottom-width: 0px;
    }
#gambar::-webkit-file-upload-button {
  visibility: hidden;
}
#gambar {
    border: none;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-left: -37px;
    z-index: 0;
}
#gambar::before {
  content: 'Upload gambar';
  text-align: center;
  display: inline-block;
  width: 300px;
  height: 50px;
  background: linear-gradient(top, #f9f9f9, #e3e3e3);
  border: none;
  border-radius: 3px;
  padding: 5px 8px;
  outline: none;
  white-space: nowrap;
  cursor: pointer;
  text-shadow: 1px 1px #fff;
  font-weight: 700;
  font-size: 10pt;
}
#gambar:hover::before {
  border-color: black;
}
#gambar:active::before {
  background: linear-gradient(top, #e3e3e3, #f9f9f9);
}

.highlight {
    border-color: white;
    background-color: white;
    color: white;
}

.alt-show {
    display: unset;
}
    </style>
