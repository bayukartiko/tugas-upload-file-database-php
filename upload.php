<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- harap tambahkan folder bernama 'file' terlebih dahulu agar bisa tersimpan filenya -->
    <?php 
    include 'koneksi.php';
    if($_POST['upload']){

        $allowedFileExtensions = array('png','jpg','gif');
        $name = $_FILES['file']['name']; // untuk mendapatkan nama file yang di upload
        $x = explode('.', $name);
        $extensions = strtolower(end($x));
        $size = $_FILES['file']['size']; // untuk mendapatkan ukuran file yang diupload
        $file_tmp = $_FILES['file']['tmp_name']; // untuk mendapatkan temporary file yang diupload

        if(in_array($extensions, $allowedFileExtensions) === true){
            if($size < 5044070){ // 5 mb ukuran maksimal
                move_uploaded_file($file_tmp, 'file/'.$name);
                $query = mysqli_query($conn, "INSERT INTO upload VALUES (NULL, '$name')");
                if($query){
                    echo 'file berhasil di upload';
                }else{
                    echo 'gagal upload';
                }
            }else{
                echo 'ukuran file terlalu besar';
            }
        }else{
            echo 'ekstensi tidak diizinkan';
            echo '<br>';
            echo 'extensi yang diizinkan adalah (.png, .jpg, .gif)';
        }

    }
    ?>

    <br><br>
    <a href="index.php">Upload lagi</a>
    <br><br>

    <table>
        <?php 
        $data = mysqli_query($conn, "SELECT * FROM upload");
        while($d = mysqli_fetch_array($data)){
        ?>
        <tr>
            <td>
                <img src="<?php echo "file/".$d['nama_file']; ?>">
            </td>
        </tr>
        <?php } ?>
    </table>

</body>
</html>