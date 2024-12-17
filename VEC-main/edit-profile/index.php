<?php 
  $active = 'buat-acara'; 
  include '../service/autoload.php';
  check_login();
  $direct = "../dashboard/logout.php";
  $logsms1 = "";
  $logsms = "";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Profile</title>

    <!-- favicon -->
    <link
      rel="shortcut icon"
      href="../assets/img/logo.ico"
      type="image/x-icon"
    />
    
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
          <h2 class="h2 article-title">Change Password</h2>
        </header>
        
        <section class="contact-form">
          <form id="cpassForm" action="index.php" method="POST">
            <div class="input-wrapper">

              <label>Username</label>
              <div class="usn">
                <ion-icon name="person-outline"></ion-icon>
                <input
                  type="text"
                  name="username"
                  class="form-input"
                  placeholder="@<?php echo $_SESSION['username']; ?>"
                  value="@<?php echo $_SESSION['username']; ?>"
                  readonly
                  data-form-input
                />
              </div>
              <label>Your Password</label>
              <div class="usn">
                <ion-icon name="lock-closed-outline"></ion-icon>
                <input
                  type="password"
                  name="password"
                  id="password"
                  class="form-input"
                  placeholder="Password"
                  required
                  data-form-input
                />
              </div>
              <label>New Password</label>
              <div class="usn">
                <ion-icon name="lock-closed-outline"></ion-icon>
                <input
                  type="password"
                  name="new-password"
                  id="newpassword"
                  class="form-input"
                  placeholder="New Password"
                  required
                  data-form-input
                />
                <div class="input-group-prepend">
                  <div class="input-group-text1">
                    <span class="password-toggle-icon"><i onclick="myFunction()" class="fas fa-eye"></i></span>
                  </div>
                </div>
              </div>
              <span id="passwordError" class="error"></span>
            </div>
            <div class="button-wrapper">
              <button id="cpass" name="cpass" class="form-btn1" type="submit" disabled data-form-btn>
                <ion-icon name="checkmark-circle-outline"></ion-icon>
                <span>Change Password</span>
              </button>
              
            </div>
          </form>
            <button onclick="window.location.href='../dashboard'"class="form-btn1" type="submit" enabled data-form-btn>
                <ion-icon name="arrow-back-outline"></ion-icon>
                <span>BACK</span>
              </button>
        </section>
      </article>
    </div>
    <!-- #link -->
    <script>
      
      document.querySelectorAll('#cpassForm input').forEach((input) => {
          input.addEventListener('input', function () {
              validateForm();
          });
      });
      function myFunction() {
        var x = document.getElementById("password");
        var x1 = document.getElementById("newpassword");
        const togglePassword = document.querySelector(".password-toggle-icon i");
        if (x.type === "password" | x1.type === "password") {
          x.type = "text";
          x1.type = "text";
          togglePassword.classList.remove("fa-eye");
          togglePassword.classList.add("fa-eye-slash");
        } else {
          x.type = "password";
          x1.type = "password";
          togglePassword.classList.remove("fa-eye-slash");
          togglePassword.classList.add("fa-eye");
        }
      }
      function validateForm() {
        const errorElement = document.getElementById('passwordError');
        const oldpassword = document.getElementById('password').value;
        const password = document.getElementById('newpassword').value;
        const submitBtn = document.getElementById('cpass');
        const uppercase = /[A-Z]/.test(password);
        const lowercase = /[a-z]/.test(password);
        const number = /[0-9]/.test(password);
        const specialChars = /[^\w]/.test(password);
        const min = 8;
        let isValid = true;
        let errorMessage = "";
        
        if (password.length < min) {
          errorMessage = "Password must at least 8 characters.";
          isValid = false;
        } 
        if(!specialChars){
          errorMessage = "Password must contain specialChars.";
          isValid = false;
        }
        if(!number){
          errorMessage = "Password must contain number.";
          isValid = false;
        }
        if(!lowercase){
          errorMessage = "Password must contain lowercase.";
          isValid = false;
        }
        if (!uppercase){
          errorMessage = "Password must contain uppercase.";
          isValid = false;
        }
        if(!uppercase&&!lowercase&&!number&&!specialChars&&password.length < min){
          errorMessage = "Password must contain uppercase, lowercase, number, specialChars, and 8 characters.";
          isValid = false;
        }
        if(!oldpassword){
          errorMessage = "Password cannot be empty!";
          isValid = false;
        }
        // Update error/success messages
        errorElement.textContent = errorMessage;
        errorElement.classList.toggle('error', !isValid);
        errorElement.classList.toggle('success', isValid);

        // Enable or disable the submit button
        submitBtn.disabled = !isValid;
        
      }
      function valid() {
          var x2 = document.forms["registrationForm"]["username"].value;
          var x = document.forms["registrationForm"]["password"].value;
          var x1 = document.forms["registrationForm"]["cpassword"].value;
          if (x2 == null || x2 == "") {
              Swal.fire({  
                position: "top-end",  
                icon: "error",  
                toast: true,  
                title: "Username cannot be empty..!!!",  
                background: "#212529",  
                showConfirmButton: false,  
                timer: 1500  
              }); 
              return false;
          }else if (x == null || x == "") {
              Swal.fire({  
                position: "top-end",  
                icon: "error",  
                toast: true,  
                title: "Password cannot be empty..!!!",  
                background: "#212529",  
                showConfirmButton: false,  
                timer: 1500  
              }); 
              return false;
          }else if (x1 == null || x1 == "") {
              Swal.fire({  
                position: "top-end",  
                icon: "error",  
                toast: true,  
                title: "Confirm cannot be empty..!!!",  
                background: "#212529",  
                showConfirmButton: false,  
                timer: 1500  
              }); 
              return false;
          }
        }
    </script>
    <?php   
include "../layout/link.php";   

$direct = "../dashboard/logout.php";

if (isset($_POST['cpass'])){  
    $username = $_SESSION['username'];  
    $password = $_POST['password'];  
    $hash_password = hash('sha256', $password);  
    $cpass = $_POST['new-password'];  
    
    $cpasslength = strlen($cpass);  
    $uppercase = preg_match('@[A-Z]@', $cpass);  
    $lowercase = preg_match('@[a-z]@', $cpass);  
    $number = preg_match('@[0-9]@', $cpass);  
    $specialChars = preg_match('@[^\w]@', $cpass);  
    $hash_cpassword = hash('sha256', $cpass);  

    $sql = "SELECT * FROM users WHERE username='$username'";  
    $result = $db->query($sql);  
    $data = $result->fetch_assoc();  
    $old_pass = $data['password'];  

    if(!$username){  
        echo '<script>  
            Swal.fire({  
                position: "top-end",  
                icon: "error",  
                toast: true,  
                title: "Username cannot be empty!",  
                background: "#212529",  
                showConfirmButton: false,  
                timer: 1500  
            });  
        </script>';  
        exit;  
    }  

    if(!$password){  
        echo '<script>  
            Swal.fire({  
                position: "top-end",  
                icon: "error",  
                toast: true,  
                title: "Current Password cannot be empty!",  
                background: "#212529",  
                showConfirmButton: false,  
                timer: 1500  
            });  
        </script>';  
        exit;  
    }  

    if(!$cpass){  
        echo '<script>  
            Swal.fire({  
                position: "top-end",  
                icon: "error",  
                toast: true,  
                title: "New Password cannot be empty!",  
                background: "#212529",  
                showConfirmButton: false,  
                timer: 1500  
            });  
        </script>';  
        exit;  
    }  

    if($hash_cpassword == $old_pass){  
        echo '<script>  
            Swal.fire({  
                position: "top-end",  
                icon: "error",  
                toast: true,  
                title: "This is the password currently used",  
                background: "#212529",  
                showConfirmButton: false,  
                timer: 1500  
            });  
        </script>';  
        exit;  
    }  
    if($hash_password != $old_pass){  
        echo '<script>  
            Swal.fire({  
                position: "top-end",  
                icon: "error",  
                toast: true,  
                title: "Current password is incorrect!",  
                background: "#212529",  
                showConfirmButton: false,  
                timer: 1500  
            });  
        </script>';  
        exit;  
    }  
    if($cpasslength < 8 || !$uppercase || !$lowercase || !$number || !$specialChars){  
        echo '<script>  
            Swal.fire({  
                position: "top-end",  
                icon: "error",  
                toast: true,  
                title: "Password must contain uppercase, lowercase, number, special characters, and be at least 8 characters long.",  
                background: "#212529",  
                showConfirmButton: false,  
                timer: 1500  
            });  
        </script>';  
        exit;  
    }  

    $sql_cpass = "UPDATE users SET password='$hash_cpassword' WHERE username='$username'";   
    
    if($db->query($sql_cpass)){  
        $_SESSION['notif'] = "Password has been changed!";  
        
        echo '<script>  
            Swal.fire({  
                position: "top-end",  
                icon: "success",  
                toast: true,  
                title: "Password has been changed!",  
                showConfirmButton: false,  
                background: "#212529",  
                timer: 2000,  
                timerProgressBar: true,  
                didClose: () => {  
                    window.location = "' . $direct . '";  
                }  
            });  
        </script>';  
        exit;  
    } else {  
        echo '<script>  
            Swal.fire({  
                position: "top-end",  
                icon: "error",  
                toast: true,  
                title: "Failed to change password. Please try again.",  
                background: "#212529",  
                showConfirmButton: false,  
                timer: 1500  
            });  
        </script>';  
        exit;  
    }  
}  
?>
  </body>
</html>
