<div class="container-fluid px-4">
                        <h1 class="mt-4">Galeri Foto</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Galeri foto</li>
                        </ol>
                        <a href="?page=galeri_tambah">+ Tambah Galeri</a>
                        <table class="table tavle-bordered">
                            <tr>
                            <th>Gambar</th>    
                            <th>Judul</th>
                            <th>Album</th>
                            <th>Deskripsi</th>
                            <th>Tanggal</th>
                            <th>Total Like</th>
                            <th>Aksi</th>        
                            </tr>
                            <?php
$querry = mysqli_query($koneksi, "SELECT foto.*, album.nama_album FROM foto LEFT JOIN album ON foto.id_album = album.id_album");
while($data = mysqli_fetch_array($querry)) {
?>
<tr>
    <td><img src="gambar/<?php echo $data['gambar']; ?>" width="200" alt="gambar"></td>
    <td><?php echo $data['judul']; ?></td>
    <td><?php echo $data['nama_album']; ?></td>
    <td><?php echo $data['deskripsi']; ?></td>
    <td><?php echo $data['tanggal']; ?></td>
    <td><?php echo mysqli_num_rows(mysqli_query($koneksi, "SELECT*FROM likefoto WHERE id_foto=" . $data ['id_foto'])); ?></td>
    <td>
    <?php
if(mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM likefoto WHERE id_foto=" . $data['id_foto'] . " AND id_user=" . $_SESSION['user']['id_user'])) < 1) {
?>
    <a href="?page=galeri_Like&&id=<?php echo $data['id_foto']; ?>" class="btn btn-danger">Like</a>
<?php
}
?>

        <a href="?page=galeri_ubah&&id=<?php echo $data['id_foto']; ?>" class="btn btn-primary">Ubah</a>
        <a href="?page=galeri_hapus&&id=<?php echo $data['id_foto']; ?>" class="btn btn-danger">Hapus</a>
        <a href="?page=galeri_komentar&&id=<?php echo $data['id_foto']; ?>" class="btn btn-warning">Komentar</a>
    </td>
</tr>
<?php   
}
?>
 </table>
</div>