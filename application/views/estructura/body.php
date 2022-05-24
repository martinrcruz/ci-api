

<?php
$this->load->view('estructura/header', $datalibrary);
$this->load->view('estructura/navbar');



$this->load->view('estructura/menu_admin', $datalibrary);




if (is_array($datalibrary['vista'])) {
    foreach ($datalibrary['vista'] as $vista) {
        $this->load->view($vista);
    }
}

$this->load->view('estructura/footer', $datalibrary);
?>
 


