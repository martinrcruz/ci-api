<?php
	class Home extends CI_Controller
	{
		public function index()
		{
			echo "Load models from another module<br>";
			$this->load->model("default/cls_home");
			echo $this->cls_home->Test();
		}
	}
?>