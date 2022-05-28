<!-- <?php
		// $usuario = new stdClass();
		// $usuario->nombre = "no disponible";
		// $usuario->avatar = base_url()."assets/images/default.png"; 
		// $usuario->correo = "no disponible";
		// if ($this->input->cookie('usuario')) {
		//     $this->session->set_userdata('usuario', unserialize($this->input->cookie('usuario')));
		// }


		// if ($session = $this->session->userdata('usuario')) {
		//     $usuario->nombre = $session->NOMBRE;
		//     $usuario->avatar = $session->AVATAR;
		//     $usuario->correo = $session->CORREO;
		// }
		?> -->




<body class="layout-top-nav light-skin theme-oceansky onlyfull">

	<div class="wrapper">



		<header class="main-header">
			<div class="inside-header">
				<!-- Logo -->
				<div class="row">
					<div class="col-10">

						<div>
							<span> <?php echo date('H:s') ?></span>
							<span> <?php echo date('d-m-Y') ?></span>
						</div>

					</div>















					<div class="col-2">

						<nav class="navbar navbar-static-top">
							<div class="navbar-custom-menu r-side">
								<ul class="nav navbar-nav">
									<!-- full Screen -->
									<li class="full-screen-btn">
										<a href="#" data-provide="fullscreen" title="Full Screen">
											<i class="mdi mdi-crop-free" style="color:#34274b"></i>
										</a>
									</li>
									<!-- User Account-->
									<li class="dropdown user user-menu">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" title="User">
											<!-- <img src="<?= base_url() ?>assets/images/fotoperfiles/ " class="float-left rounded-circle" alt="User Image">					   -->
											<img src="" class="float-left rounded-circle" alt="User Image">
										</a>
										<ul class="dropdown-menu animated flipInX">
											<!-- User image -->
											<li class="user-header bg-img" data-overlay="3">
												<div class="flexbox align-self-center">
													<img src="" class="float-left rounded-circle" alt="User Image">
													<h4 class="user-name align-self-center">
														<span>Nombre usuario</span>
														<br>
														<small>Correo usuario</small>
													</h4>
												</div>
											</li>
											<!-- Menu Body -->
											<li class="user-body">
												<a class="dropdown-item" href="javascript:void(0)"><i class="ion ion-person"></i> My Profile</a>
												<a class="dropdown-item" href="javascript:void(0)"><i class="ion ion-bag"></i> My Balance</a>
												<a class="dropdown-item" href="javascript:void(0)"><i class="ion ion-email-unread"></i> Inbox</a>
												<div class="dropdown-divider"></div>
												<a class="dropdown-item" href="javascript:void(0)"><i class="ion ion-settings"></i> Account Setting</a>
												<div class="dropdown-divider"></div>
												<a class="dropdown-item manito" onclick="signOut();"><i class="ion-log-out"></i> Cerrar Sesión</a>
												<!--						<div class="dropdown-divider"></div>
						<div class="p-10"><a href="javascript:void(0)" class="btn btn-sm btn-rounded btn-success">View Profile</a></div>-->
											</li>
										</ul>
									</li>
								</ul>
							</div>
						</nav>
					</div>
				</div>
				<!-- Header Navbar -->
			</div>
		</header>