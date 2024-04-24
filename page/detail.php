<?php 
$details=mysqli_query($conn, "SELECT * FROM foto INNER JOIN user ON foto.user_id=user.user_id WHERE foto.foto_id='$_GET[id]'");
$data=mysqli_fetch_array($details);
$likes=mysqli_num_rows(mysqli_query($conn, "SELECT * FROM like_foto WHERE foto_id='$_GET[id]'"));
$cek=mysqli_num_rows(mysqli_query($conn, "SELECT * FROM like_foto WHERE foto_id='$_GET[id]' AND user_id='".@$_SESSION['user_id']."'"));
?>
<div class="container">
   <div class="row">
      <div class="col-6">
         <div class="card">
            <img src="uploads<?= $data['lokasi_file'] ?>" alt="<?= $data['judul_foto'] ?>" class="object-fit-cover">
            <div class="card-body">
               <h3 class="card-title mb-0"><?= $data['judul_foto'] ?> <a href="<?php if(isset($_SESSION['user_id'])) {echo '?url=like&&id='.$data['foto_id'].'';}else{echo 'login.php';} ?>" class="btn btn-sm <?php if($cek==0){echo "text-secondary";}else{echo "text-danger";} ?> "><i class="fa-solid fa-fw fa-heart"></i> <?= $likes ?></a></h3>
               <small class="text-muted mb-3">by:<?= $data['username'] ?>, <?= $data['tanggal_unggah'] ?></small>
               <p><?= $data['deskripsi_foto'] ?></p>
               <?php 
               //ambil data komentar
               $komentar_id=@$_GET["komentar_id"];
               $submit=@$_POST['submit'];
               $isi_komentar=@$_POST['isi_komentar'];
               $foto_id=@$_POST['foto_id'];
               $user_id=@$_SESSION['user_id'];
               $tanggal_komentar=date('Y-m-d');
               $dataKomentar=mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM komentar_foto WHERE komentar_id='$komentar_id' AND user_id='$user_id' AND foto_id='$foto_id'"));
               if ($submit=='Kirim') {
                  $isi_komentar=mysqli_query($conn, "INSERT INTO komentar_foto VALUES('','$foto_id','$user_id','$isi_komentar','$tanggal_komentar')");
                  header("Location: ?url=detail&&id=$foto_id");
               }elseif($submit=='Edit'){
                  
               }

               ?>
               <form action="?url=detail" method="post">
                  <div class="form-group d-flex flex-row">
                     <input type="hidden" name="foto_id" value="<?= $data['foto_id'] ?>">
                     <a href="?url=home" class="btn btn-secondary">Kembali</a>
                     <?php if(isset($_SESSION['user_id'])): ?>
                        <input type="text" class="form-control" name="komentar_id" required placeholder="Masukan Komentar">
                        <input type="submit" value="Kirim" name="submit" class="btn btn-secondary">
                     <?php endif; ?>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <div class="col-6">
         <?= @$alert ?>
         <?php $user_id=@$_SESSION["user_id"]; $komen=mysqli_query($conn, "SELECT * FROM komentar_foto INNER JOIN user ON komentar_foto.user_id=user.user_id INNER JOIN foto ON komentar_foto.foto_id=foto.foto_id WHERE komentar_foto.foto_id='$_GET[id]'");
         foreach($komen as $komens): ?>
         <p class="mb-0 fw-bold"><?= $komens['username'] ?></p>
         <p class="mb-1"><?= $komens['isi_komentar'] ?></p>
         <p class="text-muted small mb-0"><?= $komens['tanggal_komentar'] ?></p>
         <hr>
         <?php endforeach; ?>
      </div>
   </div>
</div>
]