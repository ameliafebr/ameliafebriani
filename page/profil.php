<div class="container">
    <div class="row justify-content-center">
        <div class="col-7">
            <div class="card">
                <div class="card-body">
                    <h2>Halaman Profile</h2>
                    <?php
                    $user = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM user WHERE user_id='{$_SESSION['user_id']}'"));
                    if (isset($_POST['editprofile'])) {
                        $namalengkap = $_POST['namalengkap'];
                        $email = $_POST['email'];
                        $username = $_POST['username'];
                        $alamat = $_POST['alamat'];
                        if (isset($username) && isset($email)) {
                            if ($username == $user['username'] && $email == $user['email'] && $alamat == $user['alamat']) {
                                $ubah = mysqli_query($conn, "UPDATE user SET namalengkap='$namalengkap' WHERE user_id='$_SESSION[user_id]'");
                                $session = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM user WHERE user_id='$_SESSION[user_id]'"));
                                if ($ubah) {
                                    $_SESSION['user_id'] = $session['user_id'];
                                    $_SESSION['username'] = $session['username'];
                                    $_SESSION['namalengkap'] = $session['namalengkap'];
                                    $_SESSION['email'] = $session['email'];
                                    $alert = 'Ubah nama berhasil';
                                    echo '<meta http-equiv="refresh" content="0.8; url=?url=profil&&proses=editprofile">';
                                } else {
                                    $alert = 'Ubah nama gagal';
                                    echo '<meta http-equiv="refresh" content="0.8; url=?url=profil&&proses=editprofile">';
                                }
                            } else if ($username == $user['username'] && $email == $user['email'] && $namalengkap == $user['namalengkap']) {
                                $ubah = mysqli_query($conn, "UPDATE user SET alamat='$alamat' WHERE user_id='$_SESSION[user_id]'");
                                if ($ubah) {
                                    $alert = 'Ubah alamat berhasil';
                                    echo '<meta http-equiv="refresh" content="0.8; url=?url=profil&&proses=editprofile">';
                                } else {
                                    $alert = 'Ubah alamat berhasil';
                                    echo '<meta http-equiv="refresh" content="0.8; url=?url=profil&&proses=editprofile">';
                                }
                            } else if ($username == $user['username'] && $alamat == $user['alamat'] && $namalengkap == $user['namalengkap']) {
                                $ubah = mysqli_query($conn, "UPDATE user SET email='$email' WHERE user_id='$_SESSION[user_id]'");
                                $session = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM user WHERE user_id='$_SESSION[user_id]'"));
                                if ($ubah) {
                                    $_SESSION['user_id'] = $session['use_id'];
                                    $_SESSION['username'] = $session['username'];
                                    $_SESSION['namalengkap'] = $session['namalengkap'];
                                    $_SESSION['email'] = $session['email'];
                                    $alert = 'Ubah email berhasil';
                                    echo '<meta http-equiv="refresh" content="0.8; url=?url=profil&&proses=editprofile">';
                                } else {
                                    $alert = 'Ubah email berhasil';
                                    echo '<meta http-equiv="refresh" content="0.8; url=?url=profil&&proses=editprofile">';
                                }
                            } else if ($email == $user['email'] && $alamat == $user['alamat'] && $namalengkap == $user['namalengkap']) {
                                $ubah = mysqli_query($conn, "UPDATE user SET username='$username' WHERE user_id='$_SESSION[user_id]'");
                                $session = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM user WHERE user_id='$_SESSION[user_id]'"));
                                if ($ubah) {
                                    $_SESSION['user_id'] = $session['user_id'];
                                    $_SESSION['username'] = $session['username'];
                                    $_SESSION['namalengkap'] = $session['namalengkap'];
                                    $_SESSION['email'] = $session['email'];
                                    $alert = 'Ubah username berhasil';
                                    echo '<meta http-equiv="refresh" content="0.8; url=?url=profil&&proses=editprofile">';
                                } else {
                                    $alert = 'Ubah username berhasil';
                                    echo '<meta http-equiv="refresh" content="0.8; url=?url=profil&&proses=editprofile">';
                                }
                            }
                        }
                    } else if (isset($_POST['editpassword'])) {
                        $password = md5($_POST['password']);
                        if ($password != $user['password']) {
                            $ubah = mysqli_query($conn, "UPDATE user SET password='$password' WHERE user_id='$_SESSION[user_id]'");
                            if ($ubah) {
                                $alert = 'Ubah password berhasil';
                                echo '<meta http-equiv="refresh" content="0.8; url=?url=profile&&proses=editpassword">';
                            } else {
                                $alert = 'Ubah password gagal';
                                echo '<meta http-equiv="refresh" content="0.8; url=?url=profile&&proses=editpassword">';
                            }
                        }
                    }
                    ?>
                    <?php echo @$alert; if (@$_GET['proses'] == 'editprofile') : ?>
                        <form action="?url=profil&&proses=editprofile" method="post">
                            <div class="input-group mb-3">
                                <label for="nama" class="input-group-text"><i class="fa-solid fa-circle-user fa-fw fa-lg"></i></label>
                                <input type="text" class="form-control" value="<?= $user['namalengkap'] ?>" id="namalengkap" name="namalengkap" required placeholder="Masukan Nama Lengkap">
                            </div>
                            <div class="input-group mb-3">
                                <label for="email" class="input-group-text"><i class="fa-solid fa-envelope fa-fw fa-lg"></i></label>
                                <input type="email" class="form-control" value="<?= $user['email'] ?>" id="email" name="email" required placeholder="Masukan Email Anda">
                            </div>
                            <div class="input-group mb-3">
                                <label for="username" class="input-group-text"><i class="fa-solid fa-at fa-fw fa-lg"></i></label>
                                <input type="text" class="form-control" value="<?= $user['username'] ?>" id="username" name="username" required placeholder="Masukan Username">
                            </div>
                            <div class="input-group mb-4">
                                <label for="alamat" class="input-group-text"><i class="fa-solid fa-address-book fa-fw fa-lg"></i></label>
                                <input type="text" class="form-control" id="alamat" value="<?= $user['alamat'] ?>" name="alamat" required placeholder="Masukan Alamat Lengkap">
                            </div>
                            <a href="?url=profil" class="btn btn-dark fw-semibold">Kembali</a>
                            <input type="submit" value="Simpan Perubahan" name="editprofile" class="btn btn-primary fw-semibold">
                        </form>
                    <?php elseif (@$_GET['proses'] == 'editpassword') : ?>
                        <form action="?url=profil&&proses=editpassword" method="post">
                            <div class="input-group mb-4">
                                <label for="password" class="input-group-text"><i class="fa-solid fa-lock fa-fw fa-lg"></i></label>
                                <input type="password" class="form-control" id="password" name="password" required placeholder="Masukan Password Baru">
                            </div>
                            <a href="?url=profil" class="btn btn-dark fw-semibold">Kembali</a>
                            <input type="submit" value="Simpan Perubahan" name="editpassword" class="btn btn-primary fw-semibold">
                        </form>
                    <?php else : ?>
                        <div class="table-responsive">
                            <table class="table table-white table-hover">
                                <tr>
                                    <th style="width: 20%;" class="py-3">Nama Lengkap</th>
                                    <td class="py-3 text-muted"><?= $user['namalengkap'] ?></td>
                                </tr>
                                <tr>
                                    <th style="width: 20%;" class="py-3">Email</th>
                                    <td class="py-3 text-muted"><?= $user['email'] ?></td>
                                </tr>
                                <tr>
                                    <th style="width: 20%;" class="py-3">Username</th>
                                    <td class="py-3 text-muted"><?= $user['username'] ?></td>
                                </tr>
                                <tr>
                                    <th style="width: 20%;" class="py-3">Alamat</th>
                                    <td class="py-3 text-muted"><?= $user['alamat'] ?></td>
                                </tr>
                            </table>
                        </div>
                        <a href="?url=profil&&proses=editprofile" class="btn btn-danger">Edit Profil</a>
                        <a href="?url=profil&&proses=editpassword" class="btn btn-primary">Edit Password</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>