<?php
	class Home extends CI_Controller
	{
		public function index()
		{
			echo "Hello world from Controllers<br>";
			echo $this->cls_home->Test();
			echo $this->cls_library->Hello();
			echo Load_Hello();
			$this->load->view("hello");
		}
	}
?>