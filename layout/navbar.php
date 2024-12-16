<?php if(isset($_SESSION['isLogin'])) { ?>
<nav class="navbar">
  <ul class="navbar-list">
    <li class="navbar-item">
      <a href="../dashboard/"
          class="navbar-link <?php if($active === 'dashboard'){ echo 'active';}?>" 
          data-nav-link>Dashboard
      </a>
    </li>
    <div class="btnreg">
    <p>|</p>
    </div>
    <li class="navbar-item">
      <a href="../create-event/"
          class="navbar-link <?php if($active === 'create-event'){ echo 'active';}?>" 
          data-nav-link>Create Event
      </a>
    </li>
  </ul>
</nav>
<?php } else { ?>
  <nav class="navbar">
        <ul class="navbar-list">
          <li class="navbar-item">
            <a href="./login/"
                class="navbar-link <?php if($active === 'home'){ echo 'active';}?>" 
                data-nav-link>Login
            </a>
          </li>
        </ul>
      </nav>
<?php } ?>