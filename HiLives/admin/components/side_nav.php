<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
    <div class="sidebar-brand-icon rotate-n-15">
    </div>
    <div class="sidebar-brand-text mx-3"><img class="img-fluid tamanho" src="img/logo.png" alt="logotipo HiLives" /></div>
  </a>

  <hr class="sidebar-divider my-0">

  <li class="nav-item active">
    <a class="nav-link" href="index.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span style="color: #FFFFFF;">Dashboard</span></a>
  </li>

  <hr class="sidebar-divider">

  <div class="sidebar-heading">
    Users management
  </div>

  <li class="nav-item active">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-user-cog"></i>
      <span style="color: #FFFFFF;">Users</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="users_jovem.php">People with IDD</a>
        <a class="collapse-item" href="users_uni.php">HEIs</a>
        <a class="collapse-item" href="users_emp.php">Companies</a>
        <a class="collapse-item" href="users_tutor.php">Tutors</a>
      </div>
    </div>
  </li>

  <hr class="sidebar-divider">

  <div class="sidebar-heading">
    Pages Management
  </div>

  <li class="nav-item active">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
      <i class="fas fa-fw fa-folder"></i>
      <span style="color: #FFFFFF;">Pages</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Visual contents:</h6>
        <a class="collapse-item" href="hilives_stories.php">HiLives Stories</a>
        <div class="collapse-divider"></div>
        <h6 class="collapse-header">Other contents:</h6>        
        <a class="collapse-item" href="UC_jovem.php">People with IDD Courses</a>
        <a class="collapse-item" href="courses_hei.php">HEIs courses</a>
        <a class="collapse-item" href="vacancies_emp.php">Companies Vacancies</a>
      </div>
    </div>
  </li>

  <hr class="sidebar-divider">

  <div class="sidebar-heading">
    Translations Management
  </div>

  <li class="nav-item active">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTranslations" aria-expanded="true" aria-controls="collapseTranslations">
      <i class="fas fa-fw fa-folder"></i>
      <span style="color: #FFFFFF;">Translations</span>
    </a>
    <div id="collapseTranslations" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Pages contents:</h6>
        <a class="collapse-item" href="courses_t.php">People with IDD Courses</a>
        <a class="collapse-item" href="courses_heis_t.php">HEIs courses</a>
        <a class="collapse-item" href="vac_t.php">Vacancies</a>
        <div class="collapse-divider"></div>
        <h6 class="collapse-header">Other contents:</h6>
        <!-- <a class="collapse-item" href="vacancies_emp.php">Companies Vacancies</a>
        <a class="collapse-item" href="UC_jovem.php">People with IDD Courses</a>
        <a class="collapse-item" href="courses_hei.php">HEIs courses</a> -->
      </div>
    </div>
  </li>

  <hr class="sidebar-divider d-none d-md-block">

  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>