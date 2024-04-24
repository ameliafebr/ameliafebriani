<div class="container">
    <div class="row">
        <div class="col-5">
            <div class="card">
                <div class="card-body">
                    <h4>Halaman Upload</h4>
                    <?php
                    //ambil data dari <form>
                    $submit = @$_POST['submit'];
                    $foto_id = @$_GET['foto_id'];
                    if ($submit == 'Simpan') {
                        $judul_foto = @$_POST['judul_foto'];
                        $deskripsi_foto = @$_POST['deskripsi_foto'];
                        $nama_file = @$_FILES['nama_file']['name'];
                        $tmp_foto = @$_FILES['nama_file']['tmp_name'];
                        $tanggal = date('Y-m-d');
                        $id = @$_POST['id'];
                        $user_id = @$_SESSION['user_id'];
                        if (move_uploaded_file($tmp_foto, '.../uploads' . $nama_file)) {
                            $insert = mysqli_query($conn, "INSERT INTO foto VALUES('','$judul_foto','$deskripsi_foto','$tanggal_unggah','$nama_file','$album_id','$user_id')");
                            echo 'Gambar Berhasil di simpan';
                            echo '<meta http-equiv="refresh" content="0.8; url=?url=upload">';
                        } else {
                            echo 'Gambar gagal di simpan';
                            echo '<meta http-equiv="refresh" content="0.8; url=?url=upload">';
                        }
                    } elseif (isset($_GET['edit'])) {
                        if ($submit == "Ubah") {
                            $judul_foto = @$_POST['judul_foto'];
                            $deskripsi_foto = @$_POST['deskripsi_foto'];
                            $nama_file = @$_FILES['nama_file']['name'];
                            $tmp_foto = @$_FILES['nama_file']['tmp_name'];
                            $tanggal = date('Y-m-d');
                            $album_id = @$_POST['album_id'];
                            $user_id = @$_SESSION['user_id'];
                            if (strlen($nama_file) == 0) {
                                $update = mysqli_query($conn, "UPDATE foto SET judul_foto='$judul_foto', deskripsi_foto='$deskripsi_foto', tanggal_unggah='$tanggal_unggah', user_id='$id' WHERE foto_id='$foto_id'");
                                if ($update) {
                                    echo "<script>'Gambar Berhasil di Ubah'</script>";
                                    echo '<meta http-equiv="refresh" content="0.8; url=?url=upload">';
                                } else {
                                    echo 'Gambar gagal di Ubah';
                                    echo '<meta http-equiv="refresh" content="0.8; url=?url=upload">';
                                }
                            } else {
                                if (move_uploaded_file($tmp_foto, ".../uploads/" . $nama_file)) {
                                    $update = mysqli_query($conn, "UPDATE foto SET judul_foto='$judul_foto', deskripsi_foto='$deskripsi_foto', tanggal_unggah='$tanggal_unggah', user_id='$id' WHERE foto_id='$foto_id'");
                                    if ($update) {
                                        echo 'Gambar Berhasil di Ubah';
                                        echo '<meta http-equiv="refresh" content="0.8; url=?url=upload">';
                                    } else {
                                        echo 'Gambar gagal di Ubah';
                                        echo '<meta http-equiv="refresh" content="0.8; url=?url=upload">';
                                    }
                                }
                            }
                        }
                    } elseif (isset($_GET['hapus'])) {
                        $delete = mysqli_query($conn, "DELETE FROM foto WHERE foto_id='$foto_id'");
                        if ($delete) {
                            echo 'Gambar Berhasil di Hapus';
                            echo '<meta http-equiv="refresh" content="0.8; url=?url=upload">';
                        } else {
                            echo 'Gambar gagal di Hapus';
                            echo '<meta http-equiv="refresh" content="0.8; url=?url=upload">';
                        }
                    }
                    //mencari data album
                    $album = mysqli_query($conn, "SELECT * FROM foto WHERE user_id='$_SESSION[user_id]'");
                    $val = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM foto WHERE foto_id='$foto_id'"));
                    ?>
                    <?php if (!isset($_GET['edit'])) : ?>
                        <form action="?url=upload" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Judul Foto</label>
                                <input type="text" class="form-control" required name="judul_foto">
                            </div>
                            <div class="form-group">
                                <label>Deskripsi Foto</label>
                                <textarea name="deskripsi_foto" class="form-control" required cols="30" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Pilih Gambar</label>
                                <input type="file" name="lokasi_file" class="form-control" required>
                                <small class="text-danger">File Harus Berupa: *.jpg, *.png *.gif</small>
                            </div>
                            <div class="form-group">
                                <label>Pilih Album</label>
                                <select name="id" class="form-select">
                                    <?php foreach ($album as $albums) : ?>
                                        <option value="<?= $albums['nama_album'] ?>"><?= $albums['nama_album'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <input type="submit" value="Simpan" name="submit" class="btn btn-danger my-3">
                        </form>
                    <?php elseif (isset($_GET['edit'])) : ?>
                        <form action="?url=upload&&edit&&foto_id=<?= $val['foto_id'] ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Judul Foto</label>
                                <input type="text" class="form-control" value="<?= $val['judul_foto'] ?>" required name="judul_foto">
                            </div>
                            <div class="form-group">
                                <label>Deskripsi Foto</label>
                                <textarea name="deskripsi_foto" class="form-control" required cols="30" rows="5"><?= $val['deskripsi_foto'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Pilih Gambar</label>
                                <input type="file" name="lokasi_file" class="form-control">
                                <small class="text-danger">File Harus Berupa: *.jpg, *.png *.gif</small>
                            </div>
                            <div class="form-group">
                                <label>Pilih Album</label>
                                <select name="id" class="form-select">
                                    <?php foreach ($album as $albums) : ?>
                                        <?php if ($albums['id'] == $val['id']) : ?>
                                            <option value="<?= $albums['id'] ?>" selected><?= $albums['nama_album'] ?></option>
                                        <?php else : ?>
                                            <option value="<?= $albums['id'] ?>"><?= $albums['nama_album'] ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <input type="submit" value="Ubah" name="submit" class="btn btn-danger my-3">
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-7">
            <div class="row">
                <?php
                $fotos = mysqli_query($conn, "SELECT * FROM foto WHERE user_id='" . @$_SESSION['user_id'] . "'");
                foreach ($fotos as $foto) :
                ?>
                    <div class="col-6 col-md-4 col-lg-3 mb-4">
                        <div class="card">
                            <img src="uploads/<?= $foto['lokasi_file'] ?>" class="object-fit-cover" style="aspect-ratio: 16/9;">
                            <div class="card-body">
                                <p class="small"><?= $foto['judul_foto'] ?></p>
                                <a href="?url=upload&&edit&&id=<?= $foto['foto_id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="?url=upload&&hapus&&id=<?= $foto['foto_id'] ?>" class="btn btn-sm btn-danger">Hapus</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>