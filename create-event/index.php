<?php
  $active = 'create-event'; 
  include "../service/autoload.php";
  check_login();
  $id_user = $_SESSION['id_user'];
  $csms = "";
  $csms2 = "";
  $direct = "../dashboard";
  if(isset($_POST['create'])){
    $nama_acara = $db->real_escape_string($_POST['nama_acara']);
    $event_manager = $db->real_escape_string($_POST['event_manager']);
    $event_organizer = $db->real_escape_string($_POST['event_organizer']);
    $deskripsi_acara = $db->real_escape_string($_POST['deskripsi_acara']);
    if(empty($nama_acara)){  
        $errors[] = 'Event Name cannot be empty!';  
    }  
    if(empty($event_manager)){  
        $errors[] = 'Event Manager cannot be empty!';  
    }  
    if(empty($event_organizer)){  
        $errors[] = 'Event Organizer cannot be empty!';  
    }  
    if(empty($deskripsi_acara)){  
        $errors[] = 'Event Description cannot be empty!';  
    }  
    if(isset($_POST['nama_group'])){  
        foreach($_POST['nama_group'] as $group){  
            if(empty(trim($group))){  
                $errors[] = 'Group cannot be empty!';  
            }  
        }
    }  
    if(!empty($errors)){  
        $csms2 = implode('<br>', $errors);  
    } else {  
      $sql = "INSERT INTO acara (id_user, nama_acara, event_manager, event_organizer, deskripsi_acara) VALUES ('$id_user', '$nama_acara', '$event_manager', '$event_organizer','$deskripsi_acara')";
      if($db->query($sql)){
        $last_id = $db->insert_id;
        foreach($_POST['nama_group'] as $group){
          $group = $db->real_escape_string($group);
          if(!$group){
            $csms2 = 'Group cannot be empty!';
          }
          $sql_group = "INSERT INTO `group` SET `nama_group`='$group', `id_acara`='$last_id'";
          if($db->query($sql_group)){
            $csms = "User Create Event Successfully";
            $_SESSION['notiff'] = "User Create Event Successfully!";
            echo "<script>window.location='$direct'</script>";
          }
        }
      }else {
          $csms2 = "Create Event Failed";
          echo '<script>Swal.fire({title: "Failed!",text: "User Registered Failed!",icon: "error"});</script>';
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
    <title>Create Event</title>
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
    <script>
        function removeInputGroup(button) {
            // Menghapus input group yang dipilih berdasarkan tombol "Remove" yang diklik
            button.parentElement.remove();
        }
        
        function addInputGroup() {
            // Menambahkan input group baru
            var groupContainer = document.getElementById('group-container');
            var newGroup = document.createElement('div');
            newGroup.innerHTML = `
                <input type="text" name="nama_group[]" placeholder="Group Name">
                <button type="button" onclick="removeInputGroup(this)">Remove</button>
            `;
            groupContainer.appendChild(newGroup);
        }
    </script>
    
  </head>
  <body>
    <!-- #MAIN -->
    <main>
      <!-- #sidebar -->
    <?php //include "../layout/sidebar.php" ?>
    <!-- #main-content -->
    <div class="main-content">
    <!-- #NAVBAR -->
    <?php include "../layout/navbar.php" ?>
    
        <!-- #BLOG -->
      <form action="index.php" method="POST" id="createform" onsubmit="return valid()">
        <article class="contact active" data-page="contact">
          <header>
            <h2 class="h2 article-title">Create Event</h2>
          </header>
          <section class="contact-form">
              <div id="input-wrapper" class="input-wrapper">
                <span id="LogError" class="error"></span>
                <span id="LogError" class="success"><?php echo $csms; ?></span>
                <span id="LogError" class="error"><?php echo $csms2; ?></span>
                <input
                  type="text"
                  name="nama_acara"
                  id="nama_acara"
                  class="form-input"
                  placeholder="Name Event"
                  required
                  data-form-input
                />
                <input
                  type="text"
                  name="event_manager"
                  id="event_manager"
                  class="form-input"
                  placeholder="Name Event Manager"
                  required
                  data-form-input
                />
                <input
                  type="text"
                  name="event_organizer"
                  id="event_organizer"
                  class="form-input"
                  placeholder="Name Event Organizer"
                  required
                  data-form-input
                />
                <textarea
                name="deskripsi_acara"
                id="deskripsi_acara"
                class="form-input"
                placeholder="Your Event Description"
                required
                data-form-input
                ></textarea>
                <input
                  name="nama_group[]"
                  id="nama_group"
                  type="text"
                  class="form-input"
                  placeholder="Your Group Event"
                  required
                  data-form-input
                />
                <div class="input-remove" id="input-remove">
                </div>
              </div>
              <div class="bungkus-button">
                <button onclick="tambahTeks()" class="form-btn" type="button" enabled data-form-btn>
                  <ion-icon name="add-outline"></ion-icon>
                  <span>Add Group</span>
                </button>
              </div>
              <br>
              <button name="create" id="form-btn1" class="form-btn11" type="submit" disabled data-form-btn>
                <ion-icon name="checkmark-circle-outline"></ion-icon>
                <span>Make Event</span>
              </button>
              <button onclick="window.location.href='../dashboard'"class="form-btn" type="submit" enabled data-form-btn>
                <ion-icon name="close-circle-outline"></ion-icon>
                <span>Back</span>
              </button>
          </section>
        </article>
      </form>
    <script>
        document.getElementById('createform').addEventListener('input', function () {
            validateForm();
        });
        function validateForm() {
          const nama_acara = document.getElementById('nama_acara').value;
          const event_manager = document.getElementById('event_manager').value;
          const event_organizer = document.getElementById('event_organizer').value;
          const deskripsi_acara = document.getElementById('deskripsi_acara').value;
          const groupInputs = document.querySelectorAll('input[name="nama_group[]"]');  
          let groupValid = true; 
          const submitBtn = document.getElementById('form-btn1');
          const errorElement = document.getElementById('LogError');
          let isValid = true;
          let errorMessage = "";
          
          if (groupValid&&nama_group&&deskripsi_acara&&event_organizer&&event_manager&&nama_acara) {
              errorMessage = "";
              isValid = true;
          }
          groupInputs.forEach(input => {  
              if (!input.value.trim()) {  
                  groupValid = false;  
              }  
          }); 
          if (!groupValid) {  
              errorMessage = "Group Name cannot be empty!";  
              isValid = false;  
          }  
          if (!deskripsi_acara) {
              errorMessage = "Event Description cannot be empty!.";
              isValid = false;
          } 
          if (!event_organizer) {
              errorMessage = "Name Event Organizer cannot be empty!.";
              isValid = false;
          } 
          if (!event_manager) {
              errorMessage = "Name Event Manager cannot be empty!.";
              isValid = false;
          } 
          if (!nama_acara) {
              errorMessage = "Name Event cannot be empty!.";
              isValid = false;
          } 
          if (!groupValid&&!deskripsi_acara&&!event_organizer&&!event_manager&&!nama_acara) {
              errorMessage = "Name Event, Name Event Manager, Name Event Organizer, Event Description, Group Name cannot be empty!.";
              isValid = false;
          } 
          errorElement.textContent = errorMessage;
          errorElement.classList.toggle('error', !isValid);
          errorElement.classList.toggle('success', isValid);
          // Enable or disable the submit button
          submitBtn.disabled = !isValid;
        }
        function tambahTeks() {
            var listItem = document.createElement("input");
            var listButton = document.createElement("button");
            listItem.setAttribute("type", "text");
            listItem.setAttribute("name", "nama_group[]");
            listItem.setAttribute("class", "form-input");
            listItem.setAttribute("placeholder", "Your Group");
            listItem.setAttribute("required", '1');
            listItem.setAttribute("data-form-input", '1');
            var newGroup = document.createElement('div');
            newGroup.className = "input-remove";
            newGroup.innerHTML = `
                <button onclick="removeTeks(this)" name="remove" class="form-btn3" type="button" enabled data-form-btn>
                  <ion-icon name="trash-outline"></ion-icon>
                </button>
                <input
                  name="nama_group[]"
                  id="nama_group"
                  type="text"
                  class="form-input"
                  placeholder="Your Group Event"
                  required
                  data-form-input
                />
            `;
            document.getElementById("input-wrapper").appendChild(newGroup);
            // Tambahkan elemen baru ke container
            validateForm();  
        }
        function removeTeks(element) {
            element.parentElement.remove();
            var inputWrapper = document.getElementById("input-remove");
            var lastInput = inputWrapper.querySelector('input[name="nama_group[]"]:last-child');
            
            if (lastInput) {
                inputWrapper.removeChild(lastInput);
            }
            validateForm();  
        }
    </script>
    <!-- #link -->
    <?php include "../layout/link.php" ?>
  </body>
</html>
