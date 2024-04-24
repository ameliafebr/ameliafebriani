
<div class="container">
   <div class="row">
      <div class="col-12 py-3">
         <a href="?url=album.php" class="btn btn-dark">Kembali ke album</a>
      </div>
      <?php 
      $kategori=mysqli_query($conn, "SELECT * FROM foto INNER JOIN album_foto ON foto_id=id WHERE foto_id='{$_GET['id']}'");
      foreach($kategori as $kat):
      ?>
      <div class="col-6 col-md-4 col-lg-3 mb-4">
            <div class="card">
                <img src="uploads/<?= $kat['lokasi_file'] ?>" class="object-fit-cover" style="aspect-ratio: 16/9;">
                <div class="card-body">
                    <h5 class="card-title"><?= $kat['judul_foto'] ?></h5>
                    <p class="card-text text-muted">Album: <?= $kat['nama_album'] ?></p>
                    <a href="?url=detail&&id=<?= $kat['id'] ?>" class="btn btn-primary">Detail</a>
                </div>
            </div>
        </div>
      <?php endforeach; ?>
   </div>
</div>