<?php   
$logsms = "";  
$regsms = "";  
include '../service/autoload.php';  
check_logout();  

if(isset($_POST['login'])){  
    $username = $db->real_escape_string($_POST['username']);  
    $password = $_POST['password'];  
    $hash_password = hash('sha256', $password);  
    $direct = '../dashboard';  
    $errors = [];  
    if(empty($username)){  
        $errors[] = 'Username cannot be empty!';  
    }  
    if(empty($password)){  
        $errors[] = 'Password cannot be empty!';  
    }  
    if(empty($errors)){  
        $sql = "SELECT * FROM users WHERE username='$username' AND password='$hash_password' LIMIT 1";  
        $result = $db->query($sql);  
        if($result->num_rows > 0){  
            $data = $result->fetch_assoc();  
            $_SESSION['id_user'] = $data['id_user'];  
            $_SESSION['username'] = $data['username'];  
            $_SESSION['isLogin'] = true;  
            $_SESSION['notiff'] = "Login Successfully!";  
            echo "<script>window.location='$direct'</script>";  
            exit;  
        } else {  
            $errors[] = "Login Failed, Incorrect Password or Account does not exist!";  
        }  
    }  
    if(!empty($errors)){  
        $logsms = implode('<br>', $errors);  
    }  
}  
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>

    <!-- favicon -->
    <link
      rel="shortcut icon"
      href="../assets/img/logo.ico"
      type="image/x-icon"
    />
    <!-- #link -->
    
    <!-- custom css link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
    <!-- #MAIN -->

    <main>
    <!-- #main-content -->
    <div class="main-content">
      <article class="formlg active" data-page="login">
        <header>
          <h2 class="h2 article-title">Login</h2>
        </header>

        <section class="contact-form">
          <form action="index.php" method="POST">
            <div class="input-wrapper">
                <label>Username</label>
                <div class="usn">
                  <ion-icon name="person-outline"></ion-icon>
                  <input
                    type="text"
                    name="username"
                    class="form-input"
                    placeholder="Username"
                    required
                    data-form-input
                  />
                </div>
                <label>Password</label>
                <div class="usn">
                  <ion-icon name="lock-closed-outline"></ion-icon>
                  <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-input"
                    placeholder="Password"
                    required
                    data-form-input
                  />
                  <div class="input-group-prepend">
                    <div class="input-group-text1">
                      <span class="password-toggle-icon"><i onclick="myFunction()" class="fas fa-eye"></i></span>
                    </div>
                  </div>
                </div>
                <div class="btnreg">
                  <p>Don't have an account? <a href="../register">Register</a></p>
                </div>
                <span class="error"><?php echo $logsms ?></span>
            </div>
            <div class="button-wrapper">
              <button name="login" class="form-btn1" type="submit" enabled data-form-btn>
                <ion-icon name="checkmark-circle-outline"></ion-icon>
                <span>Login</span>
              </button>
              <button onclick="window.location.href='../'"class="form-btn1" type="submit" enabled data-form-btn>
                <ion-icon name="arrow-back-outline"></ion-icon>
                <span>Back</span>
              </button>
            </div>
          </form>
        </section>
      </article>
    </div>
    <!-- custom js link -->
    <script>
        function myFunction() {
          var x = document.getElementById("password");
          const togglePassword = document.querySelector(".password-toggle-icon i");
          if (x.type === "password") {
            x.type = "text";
            togglePassword.classList.remove("fa-eye");
            togglePassword.classList.add("fa-eye-slash");
          } else {
            togglePassword.classList.remove("fa-eye-slash");
            togglePassword.classList.add("fa-eye");
            x.type = "password";
          }
        }
    </script>
    <?php 
    include "../layout/link.php" ;
      if(isset($_SESSION['notif'])){
        ?>
        <script>Swal.fire({
          position: "top-end",
          icon: "success",
          toast: true,
          title: "<p style='margin-top:10px'><?php echo $_SESSION['notif']; ?></p>",
          showConfirmButton: false,
          background: "#212529",
          timer: 2000,
          timerProgressBar: true
        });</script>
        <?php
        unset($_SESSION['notif']);
      };
      //var_dump($_SESSION);
    ?>
  </body>
</html>
