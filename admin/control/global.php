<?php

try {
    $db = new PDO('sqlite:db/votebox2021.db'); 
  }catch (Exception $e) {
    echo "Unable to connect";
    echo $e->getMessage();
    exit;
}


function menu($token){

    return"
        <li class='nav-item active'>
        <a class='nav-link' href='?_route=dashboard&token={$token}'>
            <i class='fas fa-fw fa-tachometer-alt'></i>
            <span>Dashboard</span></a>
        </li>
        
        <!-- Nav Item - Charts -->
        <li class='nav-item'>
            <a class='nav-link' href='?_route=voter&token={$token}'>
                <i class='fas fa-fw fa-chart-area'></i>
                <span>Student</span></a>
        </li>

        <!-- Nav Item - Tables -->
        <li class='nav-item'>
            <a class='nav-link' href='?_route=election&token={$token}'>
                <i class='fas fa-fw fa-table'></i>
                <span>Election</span></a>
        </li>

        <!-- Divider -->
        <hr class='sidebar-divider d-none d-md-block'>

        <!-- Sidebar Toggler (Sidebar) -->
        <div class='text-center d-none d-md-inline'>
            <button class='rounded-circle border-0' id='sidebarToggle'></button>
        </div>
    ";
}

?>