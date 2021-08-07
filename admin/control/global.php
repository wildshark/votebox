<?php

//$config = json_decode(file_get_contents("config.json"),TRUE);
//$template["header"] = $config['application'];
//$polling_box_lang = $config['lang']['en_us']['polling_box'];
//$admin_lang = $config['lang']['en_us']['administration'];

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

function profile_menu($token){

    return"
        <a class='dropdown-item' href='#'>
            <i class='fas fa-user fa-sm fa-fw mr-2 text-gray-400'></i>
                Profile
        </a>
        <a class='dropdown-item' href='#'>
            <i class='fas fa-cogs fa-sm fa-fw mr-2 text-gray-400'></i>
                Settings
        </a>
        <a class='dropdown-item' href='#'>
            <i class='fas fa-list fa-sm fa-fw mr-2 text-gray-400'></i>
                Activity Log
        </a>
        <div class='dropdown-divider'></div>
         <a class='dropdown-item' href='#' data-toggle='modal' data-target='#logoutModal'>
            <i class='fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400'></i>
            Logout
        </a>
    ";
}

function logout_modal(){

    return'
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="?_route=admin">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    ';

}
?>