<div class="container">
   <div class="row">
      <div class="col-5">
         <div class="card">
            <div class="card-body">
               <h4>Halaman Album</h4>
               <?php 
               //ambil data yang di kirim oleh <form>
               $submit=@$_POST['submit'];
               $id=@$_GET['id'];
               if ($submit=='Simpan') {
                  $nama_album=@$_POST['nama_album'];
                  $deskripsi_album=@$_POST['deskripsi_album'];
                  $tanggal=date('Y-m-d');
                  $user_id=@$_SESSION['user_id'];
                  $insert=mysqli_query($conn, "INSERT INTO album_foto VALUES('','$nama_album','$deskripsi_album','$tanggal','$user_id')");
                  if ($insert) {
                     echo 'Berhasil Membuat Album';
                     echo '<meta http-equiv="refresh" content="0.8; url=?url=album">';
                  }else{
                     echo 'Gagal Membuat Album';
                     echo '<meta http-equiv="refresh" content="0.8; url=?url=album">';
                  }
               }elseif(isset($_GET['edit'])){
                  if($submit=='Ubah'){
                  $nama_album=@$_POST['nama_album'];
                  $deskripsi_album=@$_POST['deskripsi_album'];
                  $tanggal=date('Y-m-d');
                  $user_id=@$_SESSION['user_id'];
                  $update=mysqli_query($conn, "UPDATE album_foto SET nama_album='$nama_album', Deskripsi='$deskripsi_album' WHERE id='$id'");
                     if($update){
                        echo 'Berhasil Mengubah Album';
                        echo '<meta http-equiv="refresh" content="0.8; url=?url=album">';
                     }else{
                        echo 'Gagal Mengubah Album';
                        echo '<meta http-equiv="refresh" content="0.8; url=?url=album">';
                     }
                  }
               }elseif(isset($_GET['hapus'])){
                  $hapus=mysqli_query($conn, "DELETE FROM album_foto WHERE id='$id'");
                  if($hapus){
                     echo 'Berhasil Hapus Album';
                     echo '<meta http-equiv="refresh" content="0.8; url=?url=album">';
                  }else{
                     echo 'Gagal Hapus Album';
                     echo '<meta http-equiv="refresh" content="0.8; url=?url=album">';
                  }
               }
               $val=mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM album_foto WHERE id='$id' "));
               ?>
               <?php if(!isset($_GET['edit'])): ?>
               <form action="?url=album" method="post">
                  <div class="form-group">
                     <label>Nama Album</label>
                     <input type="text" class="form-control" required name="nama_album">
                  </div>
                  <div class="form-group">
                     <label>Deskripsi Album</label>
                     <textarea name="deskripsi_album" class="form-control" required cols="30" rows="5"></textarea>
                  </div>
                  <input type="submit" value="Simpan" name="submit" class="btn btn-danger my-3">
               </form>
               <?php elseif(isset($_GET['edit'])): ?>
               <form action="?url=album&&edit&&id=<?= $val['id'] ?>" method="post">
                  <div class="form-group">
                     <label>Nama Album</label>
                     <input type="text" class="form-control" value="<?= $val['nama_album'] ?>" required name="nama_album">
                  </div>
                  <div class="form-group">
                     <label>Deskripsi Album</label>
                     <textarea name="deskripsi_album" class="form-control" required cols="30" rows="5"><?= $val['deskripsi_album'] ?></textarea>
                  </div>
                  <input type="submit" value="Ubah" name="submit" class="btn btn-danger my-3">
               </form>
               <?php endif; ?>
            </div>
         </div>
      </div>
      <div class="col-7">
         <div class="card">
            <div class="card-body">
               <table class="table table-hovered">
                  <thead>
                     <tr>
                        <th>No</th>
                        <th>Nama Album</th>
                        <th>Deskripsi Album</th>
                        <th>Tanggal Dibuat</th>
                        <th>Aksi</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php 
                     $i=1;
                     $user_id=@$_SESSION['user_id'];
                     $albums=mysqli_query($conn, "SELECT * FROM album_foto WHERE user_id='$user_id'");
                     foreach($albums as $album):
                     ?>
                     <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $album['nama_album'] ?></td>
                        <td><?= $album['deskripsi_album'] ?></td>
                        <td><?= $album['tanggal'] ?></td>
                        <td>
                           <a href="?url=album&&edit&&aid=<?= $album['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                           <a href="?url=album&&hapus&&id=<?= $album['id'] ?>" class="btn btn-sm btn-danger">Hapus</a>
                           <a href="?url=kategori&&id=<?= $album['id'] ?>" class="btn btn-sm btn-success">Lihat Foto</a>
                        </td>
                     </tr>
                     <?php endforeach; ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>