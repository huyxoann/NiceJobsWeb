<?php
$page =  substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1);
?>
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href=" index.php ">

      <span class="ms-1 font-weight-bold text-white"> NICE JOB </span>


    </a>
  </div>
  <hr class="horizontal light mt-0 mb-2">

  <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link text-white   <?= $page == "index.php" ? 'active bg-gradient-primary' : ''; ?> " href="index.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">dashboard</i>
          </div>
          <span class="nav-link-text ms-1">dashboard</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link text-white <?= $page == "list-jobs.php" ? 'active bg-gradient-primary' : '' ?>" href="list-jobs.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">work</i>
          </div>
          <span class="nav-link-text ms-1">list Job</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link text-white <?= $page == "list-corporation.php" ? 'active bg-gradient-primary' : '' ?>" href="list-corporation.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">business</i>
          </div>
          <span class="nav-link-text ms-1">list company</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link text-white <?= $page == "user-admin.php" ? 'active bg-gradient-primary' : ''; ?>" href="user-admin.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">person</i>
          </div>
          <span class="nav-link-text ms-1">User admin</span>
        </a>
      </li>

      <li class="nav-item">
        <a data-bs-toggle="collapse" href="#Users" class="nav-link text-white <?= $page == "users-employee.php" || $page == "users-employer.php" ? 'active collapsed' : ''; ?>" aria-controls="Users" role="button" aria-expanded="true">
          <i class="material-icons-round opacity-10">person_4</i>
          <span class="nav-link-text ms-2 ps-1">Users</span>
        </a>
        <div class="collapse show" id="Users">
          <ul class="nav ">
            <li class="nav-item ">
              <a class="nav-link text-white <?= $page == "users-employer.php" ? 'active bg-gradient-primary' : ''; ?>" href="users-employer.php">
              <i class="material-icons-round opacity-10">person_3</i>
                <span class="sidenav-normal  ms-2  ps-1"> Users Employer </span>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link text-white <?= $page == "users-employee.php" ? 'active bg-gradient-primary' : ''; ?>" href="users-employee.php">
              <i class="material-icons-round opacity-10">person_2</i>
                <span class="sidenav-normal  ms-2  ps-1"> Users Employee </span>
              </a>
            </li>

          </ul>
        </div>
      </li>


    </ul>
  </div>
  <div class="sidenav-footer position-absolute w-100 bottom-0 ">
    <div class="mx-3">
      <a class="btn bg-gradient-primary mt-4 w-100" href="../logout.php">Logout</a>
    </div>
  </div>
</aside>