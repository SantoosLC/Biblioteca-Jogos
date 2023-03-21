<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
        <div class="sidebar-brand-text mx-3">Senai Games</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li <?php if ($paginaAtiva == 'Dashboard') { echo ' class="nav-item active"'; } ?> class="nav-item ">
        <a class="nav-link" href="dashboard.php">
            <i class="bi bi-speedometer2"></i>
        <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Area do Professor
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li <?php if ($paginaAtiva == 'Lancar_Jogo') { echo ' class="nav-item active"'; } ?> class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="bi bi-joystick"></i>
            <span>Jogos</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Escolha:</h6>
                <a class="collapse-item" href="lancar_jogo.php">Lançar novo jogo</a>
                <a class="collapse-item" href="Jogos_edicao.php">Atualizar jogo existente</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li <?php if ($paginaAtiva == 'Jogos_Registrados') { echo ' class="nav-item active"'; } ?> class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="bi bi-app-indicator"></i>
            <span>Utilitarios</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Escolha:</h6>
                <a class="collapse-item" href="jogos_registrados.php">Jogos Registrados</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Message -->
    <div class="sidebar-card d-none d-lg-flex">
        <img class="sidebar-card-illustration mb-2" src="assets/img/undraw_rocket.svg" alt="...">
        <p class="text-center mb-2">Dashboard editado e funções desenvolvidas por <br><strong>Lucas Santos</strong> </p>
        <a class="btn btn-primary btn-sm" href="https://www.linkedin.com/in/santosluca/">Linkedin</a>
    </div>

</ul>
<!-- End of Sidebar -->