<?php   
include "service/autoload.php";  
$id_acara = $db->real_escape_string($_GET['id']);  
$absensms = "";  
$absensms2 = "";  

$acara_sql = "SELECT * FROM acara WHERE id_acara='$id_acara'";  
$result_acara = $db->query($acara_sql);  
$data_acara = $result_acara->fetch_assoc();  

$group_sql = "SELECT * FROM `group` WHERE id_acara='$id_acara'";  
$result_group = $db->query($group_sql);  

if(isset($_POST['absent'])){  
    $name = trim($db->real_escape_string($_POST['name']));  
    $id_group = $db->real_escape_string($_POST['id_group']);  
    
    $errors = [];  
    if(empty($name)){  
        $errors[] = "Name cannot be empty.";  
    }  
    if($id_group === 'Choose...') {  
        $errors[] = "Please select a group.";  
    }  

    if(empty($errors)){  
        $sql = "INSERT INTO peserta (nama, id_group, id_acara) VALUES ('$name', '$id_group', '$id_acara')";  
            
        if($db->query($sql)){  
            $last_id = $db->insert_id;  
            
            setcookie('absent_event_'.$id_acara, true, time() + (86400 * 30), "/");  
            
            $_SESSION['notiff'] = "User Presents Successfully";  
            
            header("Location: ecertificate/index.php?id_peserta=$last_id");  
            exit;  
        } else {  
            $errors[] = "User Presents Failed";  
        }  
    }  
    
    if(!empty($errors)){  
        $absensms2 = implode('<br>', $errors);  
    }  
}  
?>  

<!-- Tambahkan di bagian HTML untuk menampilkan pesan error -->  


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Attendance | <?php echo $data_acara['nama_acara']; ?></title>
    <link rel="shortcut icon" href="assets/img/logo.ico" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet" />
</head>

<body>
<main>
    <div class="main-content">
        <article class="formlg active" data-page="login">
            <header>
                <h2 class="h2 article-title"><?php echo $data_acara['nama_acara']; ?></h2>
            </header>
            <form id="AbsentForm" action="absent.php?id=<?php echo $data_acara['id_acara']; ?>" method="POST" onsubmit="return validateForm()">
                <section class="contact-form">
                    <?php if(isset($_COOKIE['absent_event_'.$id_acara])): ?>
                        <p class="about-text">You have already submitted attendance for this event.</p>
                        <?php exit(); ?>
                    <?php else: ?>
                        <p class="about-text"><?php echo $data_acara['deskripsi_acara']; ?></p>
                    <?php endif; ?>
                    <div class="input-wrapper">
                        <span class="success"><?php echo $absensms; ?></span>
                        <span class="error"><?php echo $absensms2; ?></span>
                        <label>Name</label>
                        <input type="text" name="name" class="form-input" placeholder="Input Your Name" required data-form-input />
                    </div>
                    
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Choose Group</label>
                        </div>
                        <select name="id_group" class="custom-select" id="inputGroupSelect01">
                            <option selected>Choose...</option>
                            <?php if($result_group->num_rows > 0): ?>
                                <?php while($data_group = $result_group->fetch_assoc()): ?>
                                    <option value="<?php echo $data_group['id_group']; ?>"><?php echo $data_group['nama_group']; ?></option>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="button-wrapper">
                        <button name="absent" class="form-btn11" type="submit" enabled data-form-btn>
                            <ion-icon name="checkmark-circle-outline"></ion-icon>
                            <span>Present</span>
                        </button>
                    </div>
                </section>
            </form>
        </article>
    </div>

    <?php include "./layout/link.php"; ?>

    <script>
        function validateForm() {
            const selectGroup = document.getElementById('inputGroupSelect01');
            if (selectGroup.value === "Choose...") {
                Swal.fire({
                    position: "top",
                    icon: "warning",
                    title: "<p style='margin-top:10px'>Please select a group.</p>",
                    showConfirmButton: false,
                    background: "#212529",
                    timer: 1000,
                    timerProgressBar: true
                });
                
                return false; // Prevent form submission
            }
            return true; // Allow form submission
        }
    </script>
</body>
</html>
