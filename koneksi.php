<?php
    try{
        $getkoneksi = new PDO("mysql:host=localhost;dbname=tugas_upload_file_php","root","");
        // echo "koneksi berhasil";
    }catch(PDOException $e){
        echo $e->getMessage();
        // echo "koneksi gagal";
    }
?>