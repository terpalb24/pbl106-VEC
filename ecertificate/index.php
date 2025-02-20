<?php
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));
    include "../service/autoload.php";
    try {
        $font = __DIR__."/Belleza-Regular.ttf";
        $font2 = __DIR__."/OpenSans-Regular.ttf";
        $id_peserta = $db->real_escape_string($_GET['id_peserta']);
        $sql_certi = "SELECT DISTINCT `peserta`.`id_peserta`, `peserta`.`nama`, `acara`.`id_acara`, `acara`.`nama_acara`, `acara`.`event_manager`, `acara`.`event_organizer` FROM peserta JOIN acara ON `acara`.id_acara=`peserta`.id_acara WHERE `peserta`.id_peserta=$id_peserta";
        $result_certi = $db->query($sql_certi);
        $data_certi = $result_certi->fetch_assoc();
        $image = imagecreatefromjpeg("Certificate1.jpg");
        $color = imagecolorallocate($image,255,215,0);
        $color2 = imagecolorallocate($image,255,255,255);
        $nama_acara = "\"".$data_certi['nama_acara']."\"";
        $nama =  $data_certi['nama'];
        $manager =  $data_certi['event_manager'];
        $organizer =  $data_certi['event_organizer'];

        // Menghitung ukuran gambar
        $image_width = imagesx($image);

        // Menghitung ukuran teks (nama peserta)
        $font_size_nama = 80;
        $bbox_nama = imagettfbbox($font_size_nama, 0, $font, $nama);
        $text_width_nama = $bbox_nama[2] - $bbox_nama[0];
        $x_nama = (int) (($image_width - $text_width_nama) / 2); // Menentukan posisi x agar teks terpusat

        // Menggambar teks nama peserta
        imagettftext($image, $font_size_nama, 0, $x_nama, 1090, $color, $font, $nama);

        // Menghitung ukuran teks (nama acara)
        $font_size_acara = 55;
        $bbox_acara = imagettfbbox($font_size_acara, 0, $font, $nama_acara);
        $text_width_acara = $bbox_acara[2] - $bbox_acara[0];
        $x_acara = ($image_width - $text_width_acara) / 2; // Menentukan posisi x agar teks terpusat

        // Menggambar teks nama acara
        imagettftext($image, $font_size_acara, 0, $x_acara, 1380, $color2, $font, $nama_acara);

        // Menghitung ukuran teks (event organizer)
        $image_width2 = imagesx($image) / 2 + 100;
        $font_size_penye = 40;
        $bbox_penye = imagettfbbox($font_size_penye, 0, $font, $organizer);
        $text_width_penye = $bbox_penye[2] - $bbox_penye[0];
        $x_penye = ($image_width2 - $text_width_penye) / 2; // Menentukan posisi x agar teks terpusat
        // Menggambar teks nama acara
        imagettftext($image, $font_size_penye, 0, $x_penye, 1955, $color2, $font, $organizer);

        // Menghitung ukuran teks (event manager)
        $image_width3 = imagesx($image) * 1.5 - 100;
        $font_size_penye = 40;
        $bbox_penye = imagettfbbox($font_size_penye, 0, $font, $manager);
        $text_width_penye = $bbox_penye[2] - $bbox_penye[0];
        $x_penye = (int) (($image_width3 - $text_width_penye) / 2); // Menentukan posisi x agar teks terpusat
        // Menggambar teks nama acara
        imagettftext($image, $font_size_penye, 0, $x_penye, 1955, $color2, $font, $manager);

        // Menyimpan gambar sertifikat
        imagejpeg($image, "certificate/$id_peserta.jpg");
        imagedestroy($image);

    } catch (exception $e) {
        var_dump($e->getMessage());
    }
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>VEC | Virtual Event Check-in</title>

    <!-- favicon -->
    <link
    rel="shortcut icon"
    href="../assets/img/logo.ico"
    type="image/x-icon"
    />

    <!-- custom css link -->
    <link rel="stylesheet" href="../assets/css/style.css" />

    <!-- google font link -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap"
    rel="stylesheet"
    />
    </head>

    <body>
    <main>
    <article class="blog active" data-page="blog">
        <header>
            <h2 class="h2 article-title">Certificate</h2>
        </header>
        <section class="blog-posts">
            <div class="bungkus-image">
                <img src="certificate/<?php echo $id_peserta ?>.jpg">
                <div class="btnreg">
                    <p>Link Certificate : <a href="index.php?id_peserta=<?php echo $id_peserta ?>">https://pbl-vec.my.id/ecertificate/index.php?id_peserta=<?php echo $id_peserta ?></a></p>
                    <br>
                    <a href="download.php?id_peserta=<?php echo $id_peserta ?>">Download PDF</a>
                </div>
            </div>
        </section>
    </article>
    
    <?php
    include "../layout/link.php";
    //var_dump($_SESSION);
    if(isset($_SESSION['notiff'])){
        ?>
        <script>
        Swal.fire({
            position: "top-end",
            icon: "success",
            toast: true,
            title: "<p style='margin-top:10px'><?php echo $_SESSION['notiff']; ?></p>",
            showConfirmButton: false,
            background: "#212529",
            timer: 2000,
            timerProgressBar: true
        });
        </script>
        
        <?php
        unset($_SESSION['notiff']);
    }
    ?>
    </body>
</html>