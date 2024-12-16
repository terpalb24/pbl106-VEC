<aside class="sidebar" data-sidebar>
  <div class="sidebar-info">
    <figure class="avatar-box">
      <?php if (isset($_SESSION['isLogin'])) { ?>
        <img src="../assets/img/avatar.png" alt="VEC" width="80" />
      <?php } else { ?>
        <img src="assets/img/logo.png" alt="Whelmyran Bima Adhienirma" width="80" />
      <?php } ?>
    </figure>

    <div class="info-content">
      <h1 class="name" title="">
        <?php if (isset($_SESSION['isLogin'])) {
          echo '@' . $_SESSION['username'];
        } else {
          echo "Virtual Event Check-in";
        } ?>
      </h1>
      <p class="title">
        <?php if (isset($_SESSION['isLogin'])) {
          echo "Event Organizer";
        } else {
          echo "VEC | Attendance Management App";
        } ?>
      </p>
    </div>

    <button class="info_more-btn" data-sidebar-btn>
      <span>Show</span>
      <ion-icon name="chevron-down"></ion-icon>
    </button>
  </div>

  <?php if (isset($_SESSION['isLogin'])) { ?>
    <div class="sidebar-info_more">
      <div class="separator"></div>
      <ul class="contacts-list">
        <li class="contact-item">
          <div class="icon-box">
            <ion-icon name="key-outline"></ion-icon>
          </div>
          <div class="contact-info">
            <a href="../edit-profile" class="contact-title">Tap here to change Password!</a>
          </div>
        </li>
          <li class="contact-item">
            <div class="icon-box">
              <ion-icon name="log-out-outline"></ion-icon>
            </div>
            <div class="contact-info">
              <a href="../dashboard/logout.php" id="logout" name="logout" class="contact-title logout" onclick="logout(event, this);">Tap here to Log Out</a>
            </div>
          </li>
      </ul>
      <div class="separator"></div>
    </div>
  <?php } else { ?>
    <div class="sidebar-info_more">
      <div class="separator"></div>
      <li class="contact-item">
        <div class="icon-box">
          <ion-icon name="mail-outline"></ion-icon>
        </div>
        <div class="contact-info">
          <p class="contact-title">Email</p>
          <a href="mailto:vec@gmail.com" class="contact-link">vec@gmail.com</a>
        </div>
      </li>
      <li class="contact-item">
        <div class="icon-box">
          <ion-icon name="phone-portrait-outline"></ion-icon>
        </div>
        <div class="contact-info">
          <p class="contact-title">Phone</p>
          <a href="tel:+6282222222222" class="contact-link">+62 822-2222-2222</a>
        </div>
      </li>
      <div class="separator"></div>
    </div>
  <?php } ?>
</aside>
<script>
    function logout(event, element) {
        event.preventDefault(); // Cegah tindakan default elemen <a>
        console.log("Fungsi logout dipanggil!"); // Debugging untuk memastikan fungsi dipanggil
        const href = element.getAttribute('href');
        console.log("Logout URL:", href); // Debugging untuk memastikan URL didapatkan

        Swal.fire({
            title: "Are you sure to Logout?",
            icon: "warning",
            showCancelButton: true,
            cancelButtonColor: "#d33",
            confirmButtonColor: "var(--eerie-black-2)",
            background: "#212529",
            confirmButtonText: "<p style='color:var(--orange-yellow-crayola)'>Yes, Logout!</p>"
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Logout!",
                    text: "You have been logged out.",
                    icon: "success",
                    background: "#212529",
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = href;
                });
            }
        });
    }
</script>
