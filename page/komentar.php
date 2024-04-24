<?php 
$foto_id=@$_GET['id'];
$user_id=@$_SESSION['user_id'];
$komentar_id=@$_GET['komentar_id'];
$cek=mysqli_num_rows(mysqli_query($conn, "SELECT * FROM komentar_foto WHERE user_id='$user_id' AND foto_id='$foto_id' AND komentar_id='$komentar_id'"));
if ($cek > 0) {
   $delete=mysqli_query($conn, "DELETE FROM komentar_foto WHERE komentar_id='$komentar_id'");
   echo '<script>alert("Anda berhasil menghapus komentar ini");</script>';
   echo '<meta http-equiv="refresh" content="0; url=?url=detail&&id='.@$foto_id.'">';
} else {
   // User is not allowed to delete the comment
   $alert='Gagal hapus komentar';
   echo '<script>alert("Anda tidak berhak menghapus komentar ini");</script>';
   echo '<meta http-equiv="refresh" content="0; url=?url=detail&&id='.@$foto_id.'">';
}
?>