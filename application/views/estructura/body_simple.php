<?php

$this->load->view('estructura/header_simple', $datalibrary);

if(is_array($datalibrary['vista'])){
    foreach ($datalibrary['vista'] as $vista){
        $this->load->view($vista);
    }
}

$this->load->view('estructura/footer_simple', $datalibrary);
?>
 


