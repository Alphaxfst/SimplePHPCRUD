<?php
    function koneksi() {
        $conn = mysqli_connect('localhost', 'root', '', 'db_pw') or die('Koneksi ke database GAGAL!');
        return $conn;
    }

    function query($query) {
        $conn = koneksi();
        $result = mysqli_query($conn, $query) or die('Query gagal : ' . mysqli_error($conn));

        $rows = [];
        while($row = mysqli_fetch_assoc($result)){
            $rows[] = $row;
        }
        return $rows;
    }

    function tambah($data){
        $conn = koneksi();
        $judul = mysqli_real_escape_string($conn, htmlspecialchars($data['judul']));
        $penulis = mysqli_real_escape_string($conn, htmlspecialchars($data['penulis']));
        $penerbit = mysqli_real_escape_string($conn, htmlspecialchars($data['penerbit']));
        $kategori = mysqli_real_escape_string($conn, htmlspecialchars($data['kategori']));
        // $gambar = mysqli_real_escape_string($conn, htmlspecialchars($data['gambar']));

        $gambar = upload();
        if(!$gambar){
            return false;
        }
    
        $query = "INSERT INTO buku VALUES(
                    null,
                    '$judul',
                    '$penulis',
                    '$penerbit',
                    '$kategori',
                    '$gambar'
                )";
    
        mysqli_query($conn, $query) or die('Query Gagal' . mysqli_error($conn));
    
        return mysqli_affected_rows($conn);
    }

    function ubah($data){
        $conn = koneksi();
    
        $id = $data['id'];
        $judul = mysqli_real_escape_string($conn, htmlspecialchars($data['judul']));
        $penulis = mysqli_real_escape_string($conn, htmlspecialchars($data['penulis']));
        $penerbit = mysqli_real_escape_string($conn, htmlspecialchars($data['penerbit']));
        $kategori = mysqli_real_escape_string($conn, htmlspecialchars($data['kategori']));
        $gambarLama = mysqli_real_escape_string($conn, htmlspecialchars($data['gambarLama']));

        $gambar = upload();

        if($gambar === 'default.jpeg'){
            $gambar = $gambarLama;
        } else {
            if($gambarLama !== 'default.jpeg'){
                unlink('images/' . $gambarLama);
            }
        }
    
        $query = "UPDATE buku SET
                    judul = '$judul',
                    penulis = '$penulis',
                    penerbit = '$penerbit',
                    kategori = '$kategori',
                    gambar = '$gambar'
                        WHERE id = $id
                    ";
    
        mysqli_query($conn, $query) or die('Query Gagal' . mysqli_error($conn));
        return mysqli_affected_rows($conn);
    }

    function hapus($id){
        $conn = koneksi();
        $buku = query("SELECT * FROM buku WHERE id = $id")[0];
        if($buku['gambar'] !== 'default.jpeg'){
            unlink('images/' . $buku['gambar']);
        }
    
        mysqli_query($conn, "DELETE FROM buku WHERE id = $id") or die('Query Gagal' . mysqli_error($conn));
    
        return mysqli_affected_rows($conn);
    }
    
    function upload(){
        $namaFile = $_FILES['gambar']['name'];
        $tipeFile = $_FILES['gambar']['type'];
        $ukuranFile = $_FILES['gambar']['size'];
        $error = $_FILES['gambar']['error'];
        $tmpName = $_FILES['gambar']['tmp_name'];
        $ekstensiFile = pathinfo($namaFile, PATHINFO_EXTENSION);
    
        if($error === 4){
            return 'default.jpeg';
        }
    
        $tipeGambarValid = ['image/jpg','image/jpeg','image/png'];
        if(!in_array($tipeFile, $tipeGambarValid)){
          echo "<script>
                  alert('Tipe Gambar Tidak Sesuai');
                  document.location.href = 'index.php';
                </script>";
          return false;
        }

        if($ukuranFile > 1000000){
            echo "<script>
                  alert('Ukuran gambar terlalu besar');
                  document.location.href = 'index.php';
                </script>";
          return false;
        }

        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiFile;

        move_uploaded_file($tmpName, 'images/' . $namaFileBaru);
        return $namaFileBaru;
    }

?>