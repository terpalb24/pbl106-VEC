<?php   
include '../service/autoload.php';  
check_logout();  
$regsms = "";  
$regsms2 = "";  
$direct = "../login";  
if(isset($_POST['register'])){  
    $username = $db->real_escape_string($_POST['username']);  
    $password = $_POST['password'];  
    $errors = [];  
    if(empty($username)){  
        $errors[] = 'Username cannot be empty!';  
    } elseif(strlen($username) > 50){  
        $errors[] = 'Username character max is 50!';  
    } elseif(strlen($username) < 1){  
        $errors[] = 'Username must be at least 3 characters long!';  
    }  
    if(empty($password)){  
        $errors[] = 'Password cannot be empty!';  
    } else {  
        $uppercase = preg_match('@[A-Z]@', $password);  
        $lowercase = preg_match('@[a-z]@', $password);  
        $number = preg_match('@[0-9]@', $password);  
        $specialChars = preg_match('@[^\w]@', $password);  
        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {  
            $errors[] = 'Password must contain uppercase, lowercase, number, special characters, and be at least 8 characters long.';  
        }  
    }  
    if(empty($errors)){  
        try {  
            $hash_password = hash("sha256", $password);  
            $check_query = "SELECT * FROM users WHERE username = '$username'";  
            $check_result = $db->query($check_query);  
            if($check_result->num_rows > 0){  
                $errors[] = "Username Already Used!";  
                $regsms2 = "Username Already Used!";  
            } else {  
                $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hash_password')";  
                if($db->query($sql)){  
                    $regsms = "User Registered Successfully";  
                    $_SESSION['notif'] = "User Registered Successfully!";  
                    echo "<script>window.location='$direct'</script>";  
                    exit;  
                } else {  
                    $errors[] = "User Registration Failed";  
                    $regsms2 = "User Registration Failed";  
                }  
            }  
        } catch (Exception $e) {  
            $errors[] = "Registration Error: " . $e->getMessage();  
            $regsms2 = "Registration Error: " . $e->getMessage();  
        }  
    }  
    if(!empty($errors)){  
        $regsms2 = implode('<br>', $errors);  
    }  
}  
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>

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
          <h2 class="h2 article-title">Register</h2>
        </header>

        <section class="contact-form">
          <form id="registrationForm" action="index.php" method="POST" onsubmit="return valid()">
            <div class="input-wrapper">
              <label>Username</label>
              <div class="usn">
                <ion-icon name="person-outline"></ion-icon>
                <input
                  type="text"
                  name="username"
                  id="username"
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
                  name="password"
                  id="password"
                  class="form-input"
                  placeholder="Password"
                  required
                  data-form-input
                />
              </div>
              <label>Confirm Password</label>
              <div class="usn">
                <ion-icon name="lock-closed-outline"></ion-icon>
                <input
                  type="password"
                  name="cpassword"
                  id="cpassword"
                  class="form-input"
                  placeholder="Confirm Your Password"
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
              <span id="passwordError" class="success"><?php echo $regsms; ?></span>
              <span id="passwordError" class="error"><?php echo $regsms2; ?></span>
            </div>
            <div class="button-wrapper">
              <button name="register" id="form-btn1" class="form-btn1" type="submit" disabled data-form-btn>
                <ion-icon name="checkmark-circle-outline"></ion-icon>
                <span>register</span>
              </button>
              <button onclick="window.location.href='../login'"class="form-btn1" type="submit" enabled data-form-btn>
                <ion-icon name="close-circle-outline"></ion-icon>
                <span>Cancel</span>
              </button>
            </div>
          </form>
        </section>
      </article>
    </div>
    <!-- custom js link -->
    <script>
        document.getElementById('registrationForm').addEventListener('input', function () {
            validateForm();
        });
        function validateForm() {
          const username = document.getElementById('username').value;
          const password = document.getElementById('password').value;
          const confirmPassword = document.getElementById('cpassword').value;
          const submitBtn = document.getElementById('form-btn1');
          const errorElement = document.getElementById('passwordError');
          const min = 8;
          const max = 50;

          let isValid = true;
          let errorMessage = "";

          // Validate username length
          if (username.length > max) {
              errorMessage = "Username max 50 characters.";
              isValid = false;
          } 
          if (!username) {
              errorMessage = "Username cannot be empty!.";
              isValid = false;
          } 
          // Validate password strength
          else {
              const uppercase = /[A-Z]/.test(password);
              const lowercase = /[a-z]/.test(password);
              const number = /[0-9]/.test(password);
              const specialChars = /[^\w]/.test(password);

              if (password !== confirmPassword) {
                  errorMessage = "Passwords do not match.";
                  isValid = false;
              } else {
                  errorMessage = "Passwords match.";
                  isValid = true;
              }
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
              if(!password){
                errorMessage = "Password cannot be empty!.";
                isValid = false;
              }
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
        function myFunction() {
          var x = document.getElementById("password");
          var x1 = document.getElementById("cpassword");
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
    </script>
    <!-- #link -->
    <?php include "../layout/link.php" ?>
  </body>
</html>
