<?php
$tareas = "";

   
$menu_corizador="";
$precio="";

$solicitud = "";

switch ($active) {
   case 'tareas':
       $tareas = "current";
       break;
    case 'solicitud':
        $solicitud = "current";
        break;
  
   

}
?>

<nav class="main-nav" role="navigation">

    <!-- Mobile menu toggle button (hamburger/x icon) -->
    <input id="main-menu-state" type="checkbox" />
    <label class="main-menu-btn" for="main-menu-state">
        <span class="main-menu-btn-icon"></span>
    </label>

    <!-- Sample menu definition -->
    <ul id="main-menu" class="sm sm-blue">
        <li>
            <a href="<?= base_url() ?>tareas" class="border border-primary <?=$tareas?>">
                <i class="ti-dashboard mx-5"></i>TAREAS
            </a>
        </li>
        <li>
            <a href="<?= base_url() ?>solicitud" class="border border-primary <?=$solicitud?>">
                <i class="ti-write mx-5"></i>SOLICITUDES
            </a>
        </li>
    </ul>

            



</nav>