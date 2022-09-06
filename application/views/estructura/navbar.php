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
					<div class="col-4 start-header">





						<div class="container">

							<div class="row">

								<div class="col-2">
									<img src=" <?= base_url() ?>/assets/images/logo-graficag.png" alt="" style="width:60px">
								</div>

								<div class="col-6">
									<p class="hour"> <?php echo date('H:s') ?></p>
									<p class="date"> <?php echo date('d-m-Y') ?></p>

								</div>
							</div>
						</div>





					</div>



					<div class="col-4 center-header">

						<div>
							<h1>Hola, <strong>Usuario</strong></h1>
						</div>

					</div>

					<div class="col-4 end-header">
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
	


										<button class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="height: 36px; width: 36px; border:none; background-color:transparent; margin-top:13px;">
										<img src="<?= base_url() ?>/assets/images/profile-img.png" class="float-left rounded-circle" alt="User Image">
									</button>


										<ul class="dropdown-menu">
											<!-- User image -->
											<li class="user-header bg-img" data-overlay="3">
												<div class="flexbox align-self-center">
													<img src="<?= base_url() ?>/assets/images/profile-img.png" class="float-left rounded-circle" alt="User Image">
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
												<!-- <div class="dropdown-divider"></div> -->
												<!-- <div class="p-10"><a href="javascript:void(0)" class="btn btn-sm btn-rounded btn-success">View Profile</a></div>-->
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