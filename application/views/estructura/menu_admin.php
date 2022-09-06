<?php
$dashboard = "";


switch ($active) {
    case 'tareas':
        $tareas = "current";
        break;
}
?>


<nav class="main-nav text-center" role="navigation">

    <!-- Mobile menu toggle button (hamburger/x icon) -->
    <input id="main-menu-state" type="checkbox" />
    <label class="main-menu-btn" for="main-menu-state">
        <span class="main-menu-btn-icon"></span>
    </label>

    <!-- Sample menu definition -->
    <ul id="main-menu" class="sm sm-blue" style="display:flex; justify-content:center">
        <li>
            <a href="<?= base_url() ?>" class="border border-primary"><i class="fa-solid fa-house" style="color: #7B6F93;" aria-hidden="true"></i> HOME </a>
        </li>

        <li>
            <a href="<?= base_url() ?>cotizacion" class="border border-primary"><i class="fa-solid fa-file" style="color: #7B6F93;" aria-hidden="true"></i> COTIZACION </a>
        </li>

        <li>
            <a href="<?= base_url() ?>orden_trabajo" class="border border-primary"><i class="fa-solid fa-clipboard-list" style="color: #7B6F93;" aria-hidden="true"></i> ORDEN DE TRABAJO </a>
        </li>

        <li>
            <a href="<?= base_url() ?>proveedor" class="border border-primary"><i class="fa-solid fa-dolly" style="color: #7B6F93;" aria-hidden="true"></i> PROVEEDORES </a>
        </li>

        <li>
            <a href="<?= base_url() ?>cliente" class="border border-primary"><i class="fa-solid fa-users" style="color: #7B6F93;" aria-hidden="true"></i> CLIENTES </a>
        </li>

        <li>
            <a href="<?= base_url() ?>usuario" class="border border-primary"><i class="fa-solid fa-user-gear" style="color: #7B6F93;" aria-hidden="true"></i> USUARIOS </a>
        </li>

        <li>
            <a href="#" class="border border-primary"><i class="fa-solid fa-gears" style="color: #7B6F93;" aria-hidden="true"></i> MANTENEDOR </a>
            <ul style="background-color: #585B6A !important; padding: 0px;">
                <li class=""><a href="<?= base_url() ?>mantenedor/empresa"  style="color: #7B6F93;" class="border border-primary"><i class="ti-pencil-alt2 mx-5"></i>EMPRESAS</a>

                <li class=""><a href="<?= base_url() ?>mantenedor/formapago" style="color: #7B6F93;" class="border border-primary"><i class="ti-rocket mx-5"></i>FORMAS DE PAGO</a>

                <li class=""><a href="<?= base_url() ?>mantenedor/producto" style="color: #7B6F93;" class="border border-primary"><i class="ti-flag mx-5"></i>PRODUCTOS</a>

                <li class=""><a href="<?= base_url() ?>mantenedor/terminacion" style="color: #7B6F93;" class="border border-primary"><i class="ti-flag mx-5"></i>TERMINACIONES</a>

                <li class=""><a href="<?= base_url() ?>mantenedor/tipovalor" style="color: #7B6F93;" class="border border-primary"><i class="ti-flag mx-5"></i>TIPO DE VALOR</a>

            </ul>
        </li>


    </ul>

</nav>