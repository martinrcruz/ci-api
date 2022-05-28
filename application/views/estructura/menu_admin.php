<?php
$dashboard = "";
$tareas = "";
$usuarios = "";
$empresas = "";
$reportetareas = "";
$reportehoras = "";
$cotizador = "";
$actividad = "";
$cliente = "";
$proyecto = "";

$solicitud = "";
$solicitudes = "";
$solicitudtarea = "";
$menu_mantenedor = "";
$menu_reportes = "";
$menu_corizador = "";
$precio = "";

switch ($active) {
    case 'tareas':
        $tareas = "current";
        break;
    case 'dashboard':
        $dashboard = "current";
        break;
    case 'usuarios':
        $usuarios = "current";
        break;
    case 'empresas':
        $empresas = "current";
        break;
    case 'reportetareas':
        $reportetareas = "current";
        $menu_reportes = "current";
        break;
    case 'reportehoras':
        $reportehoras = "current";
        $menu_reportes = "current";
        break;
    case 'cotizador':
        $cotizador = "current";
        $menu_corizador = "current";
        break;
    case 'precios':
        $precio = "current";
        $menu_corizador = "current";
        break;
    case 'actividad':
        $actividad = "current";
        $menu_mantenedor = "current";
        break;
    case 'cliente':
        $cliente = "current";
        $menu_mantenedor = "current";
        break;
    case 'proyecto':
        $proyecto = "current";
        $menu_mantenedor = "current";
        break;
    case 'solicitud':
        $solicitud = "current";
        $solicitudes = "current";

        break;
    case 'solicitudtarea':
        $solicitudtarea = "current";
        $solicitudes = "current";
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
        <li><a href="#" class="border border-primary"><i class="fa fa-file pr-2" style="color: #7B6F93;" aria-hidden="true"></i> COTIZACION</a>
        </li>




    </ul>





</nav>