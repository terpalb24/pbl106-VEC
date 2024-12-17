<?php $active = 'home'; ?>
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
      href="assets/img/logo.ico"
      type="image/x-icon"
    />

    <!-- custom css link -->
    <link rel="stylesheet" href="assets/css/style.css" />

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
    <!-- #sidebar -->
    <?php include "layout/sidebar.php" ?>
    <!-- #main-content -->
    <div class="main-content">
    <!-- #NAVBAR -->
    <?php include "layout/navbar.php" ?>

        <!--
        - #ABOUT
      -->

        <article class="about active" data-page="about">
          <header>
            <h2 class="h2 article-title"><span>Home</span></h2>
          </header>

          <section class="about-text">
            <p>
            Simplify your event attendance process with our intuitive and reliable solution.
            Designed for ease of use, it ensures a smooth experience for both organizers and participants.
            </p>

            <p>
            Our support team is always on hand to help you with any questions or issues, ensuring your event runs efficiently and stress-free.
            </p>
          </section>

          <!--
          - service
        -->

          <section class="service">
            <h3 class="h3 service-title">VEC</h3>

            <ul class="service-list">
              <li class="service-item">
                <div class="service-icon-box">
                  <img
                    src="assets/img/icon-design.svg
                "
                    alt="design icon"
                    width="40"
                  />
                </div>

                <div class="service-content-box">
                  <h4 class="h4 service-item-title">Absence</h4>

                  <p class="service-item-text">
                  Can take attendance for any event, with easy management!
                  </p>
                </div>
              </li>

              <li class="service-item">
                <div class="service-icon-box">
                  <img
                    src="assets/img/icon-dev.svg"
                    alt="Web development icon"
                    width="40"
                  />
                </div>

                <div class="service-content-box">
                  <h4 class="h4 service-item-title">Simple design</h4>

                  <p class="service-item-text">
                  Design that makes it easier for users to use the application.
                  </p>
                </div>
              </li>

              <li class="service-item">
                <div class="service-icon-box">
                  <img
                    src="assets/img/icon-photo.svg"
                    alt="camera icon"
                    width="40"
                  />
                </div>

                <div class="service-content-box">
                  <h4 class="h4 service-item-title">Features</h4>

                  <p class="service-item-text">
                  Can filter absence groups.
                  Can recap attendance data into Excel format.
                  </p>
                </div>
              </li>
            </ul>
          </section>

          <!--
          - clients
        -->

          <section class="clients">
            <h3 class="h3 clients-title">Clients</h3>

              <li class="clients-item">
                <a href="https://www.instagram.com/polibatamofficial/">
                  <img
                    src="assets/img/logo-3-color.png"
                    alt="client logo"
                  />
                </a>
              </li>

              
            </ul>
          </section>
        </article>

    <!--
    - custom js link
  -->
    <!-- #link -->
    <?php
    include "layout/link.php";
    ?>
  </body>
</html>
