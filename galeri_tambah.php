<?php
if(isset($_POST['judul'])){
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $id_album = $_POST['id_album'];
    $tanggal = $_POST['tanggal'];
    $id_user = $_SESSION['user']['id_user'];

    $gambar = $_FILES['gambar'];
    $nama_gambar = uniqid() . '_' . $gambar['name']; // Menghasilkan nama file unik

    // Pindahkan file gambar yang diunggah ke lokasi tujuan dengan nama yang unik
    $tujuan = "gambar/" . $nama_gambar;
    if(move_uploaded_file($gambar['tmp_name'], $tujuan)) {
        // Eksekusi kueri SQL untuk memasukkan data baru ke dalam database
        $query = mysqli_query($koneksi, "INSERT INTO foto (judul, deskripsi, id_album, tanggal, gambar, id_user) VALUES ('$judul', '$deskripsi', '$id_album', '$tanggal', '$nama_gambar', '$id_user')");

        // Periksa apakah kueri berhasil dijalankan
        if(mysqli_affected_rows($koneksi) > 0){
            echo '<script>alert("Tambah data berhasil");</script>';
        } else {
            echo '<script>alert("Tambah data gagal");</script>';
        }
    } else {
        echo '<script>alert("Gagal mengunggah gambar");</script>';
    }
}
?>


<div class="container-fluid px-4">
                        <h1 class="mt-4">Galeri Foto</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Galeri foto</li>
                        </ol>
                        <form method="post" enctype="multipart/form-data">
    <table class="table">
        <tr>
            <td width="200">Judul</td>
            <td width="1">:</td>
            <td><input type="text" name="judul" class="form-control"></td>
        </tr>
        <tr>
            <td>Deskripsi</td>
            <td>:</td>
            <td><input type="text" name="deskripsi" class="form-control"></td>
        </tr>
        <tr>    
            <td>Album</td>
            <td>:</td>
            <td>
                <select name="id_album" class="form-select form-control">
                    <?php
                        $al = mysqli_query($koneksi, "SELECT * FROM album");
                        while($album = mysqli_fetch_array($al)){
                    ?>
                    <option value="<?php echo $album['id_album'];?>"><?php echo $album['nama_album'];?></option>
                    <?php
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>:</td>
            <td><input type="date" name="tanggal" class="form-control"></td>
        </tr>
        <tr>
            <td>Gambar</td>
            <td>:</td>
            <td><input type="file" name="gambar" class="form-control"></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </td>
        </tr>
    </table>
</form>
</div>