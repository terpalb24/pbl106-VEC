<?php
$active = 'dashboard';
include '../service/autoload.php';
check_login();
$id_user = $_SESSION['id_user'];

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page_next = $page + 1;
$page_pv = $page - 1;
$limit = 6;
$start = ($page - 1) * $limit;

$sql_total = "SELECT * FROM `acara` WHERE `id_user`='$id_user'";
$total = $db->query($sql_total)->num_rows;
$total_hal = ceil($total / $limit);

$sql = "SELECT * FROM `acara` WHERE `id_user`='$id_user' ORDER BY `id_acara` DESC LIMIT $start, $limit";
$result = $db->query($sql);
//var_dump($_POST);
if (isset($_GET['delete'])) {
    $acara_id = $db->real_escape_string($_GET['acara_id']);
    //var_dump("Acara ID to delete: " . $acara_id);
    $delete_acara_sql = "DELETE FROM acara WHERE id_acara = '$acara_id' AND id_user = '$id_user'";
    if(!isset($_SESSION['isLogin'])) {
        header("location: ../login");
    } else{
        if ($db->query($delete_acara_sql)) {
            header("Location: index.php");
            exit;
        } else {
            echo "An error occurred while deleting the event.";
        }
    }
}

?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <title>Dashboard</title>
    
    <!-- favicon -->
    <link rel="shortcut icon" href="../assets/img/logo.ico" type="image/x-icon" />
    
    <!-- custom css link -->
    
    <!-- google font link -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet" />
</head>
<body>
    <!-- #MAIN -->
    <main>
        <!-- #sidebar -->
        <?php include "../layout/sidebar.php"; ?>
        <!-- #main-content -->
        <div class="main-content">
            <!-- #NAVBAR -->
            <?php include "../layout/navbar.php"; ?>
            
            <!-- #BLOG -->
            <article class="blog active" data-page="blog">
                <header>
                    <h2 class="h2 article-title">Dashboard</h2>
                </header>
                <section class="blog-posts">
                    <ul class="blog-posts-list">
                        <?php $txtt = ""; if ($result->num_rows > 0){ ?>
                        <?php while ($data = $result->fetch_assoc()): ?>
                            <li class="blog-post-item">
                                <a href="../acara.php?id=<?php echo $data['id_acara']; ?>">
                                <div class="blog-content">
                                    <h3 class="h3 blog-item-title"><?php echo htmlspecialchars($data['nama_acara']); ?></h3>
                                    <form method="GET" action="index.php" onsubmit="valid(event, this);">
                                        <input type="hidden" name="acara_id" value="<?php echo $data['id_acara']; ?>">
                                        <div class="button-remove">
                                            <button type="submit" name="delete"><ion-icon name="trash-outline"></ion-icon></button>
                                        </div>
                                    </form>
                                </div>
                                </a>
                            </li>
                        <?php endwhile; ?>
                        <?php }else{ ?>
                            <div class="contact-info"> <a  class="contact-title">You haven't created any event yet!</a></div>
                        <?php } ?>
                    </ul>
                </section>
                <?php
                    if($total > $limit){
                ?>
                <nav>
                    <ul class="pagination justify-content-center">
                        <li class="page-item">
                            <a class="page-link" <?php if ($page > 1) echo "href='?page=$page_pv'"; ?>>Previous</a>
                        </li>
                        <?php for ($x = 1; $x <= $total_hal; $x++): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?php echo $x; ?>"><?php echo $x; ?></a>
                            </li>
                        <?php endfor; ?>
                        <li class="page-item">
                            <a class="page-link" <?php if ($page < $total_hal) echo "href='?page=$page_next'"; ?>>Next</a>
                        </li>
                    </ul>
                </nav>
                <?php
                    }
                ?>
            </article>
        </div>
    </main>
    
    <!-- #link -->
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
    <script>
        function valid(event, form) {
            event.preventDefault(); // Mencegah submit otomatis
            console.log("Delete button clicked!"); // Debug log
            const acara_id = form.querySelector('input[name="acara_id"]').value; // Ambil ID acara dari form
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                cancelButtonColor: "#d33",
                confirmButtonColor: "var(--eerie-black-2)",
                background: "#212529",
                confirmButtonText: "<p style='color:var(--orange-yellow-crayola)'>Yes, delete it!</p>"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Tampilkan konfirmasi sukses
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your event has been deleted.",
                        icon: "success",
                        background: "#212529",
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        //form.submit();
                        window.location.href = 'index.php?delete&acara_id=' + acara_id;
                    });
                }
            });
        }
    </script>
    <link rel="stylesheet" href="../assets/css/style.css" />
</body>
</html>