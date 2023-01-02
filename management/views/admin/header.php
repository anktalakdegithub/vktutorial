<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, shrink-to-fit=9">
		<title>LMS</title>
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500' rel='stylesheet'>
		<link href='<?=base_url();?>assets/vendor/unicons-2.0.1/css/unicons.css' rel='stylesheet'>
		<link href="<?=base_url();?>assets/css/vertical-responsive-menu1.min.css" rel="stylesheet">
		<link href="<?=base_url();?>assets/css/instructor-dashboard.css" rel="stylesheet">
		<link href="<?=base_url();?>assets/css/instructor-responsive.css" rel="stylesheet">
		<link href="<?=base_url();?>assets/css/night-mode.css" rel="stylesheet">
		<link href="<?=base_url();?>assets/css/jquery-steps.css" rel="stylesheet">
		<link href="<?=base_url();?>/assets/css/style.css" rel="stylesheet">
		<link href="<?=base_url();?>/assets/css/responsive.css" rel="stylesheet">
		<link href="<?=base_url();?>/assets/css/night-mode.css" rel="stylesheet">
		<link href="<?=base_url();?>assets/vendor/bootstrap/css/bootstrap-datepicker.min.css" rel="stylesheet">
		<!-- Vendor Stylesheets -->
		<link href="<?=base_url();?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
		<link href="<?=base_url();?>assets/vendor/OwlCarousel/assets/owl.carousel.css" rel="stylesheet">
		<link href="<?=base_url();?>assets/vendor/OwlCarousel/assets/owl.theme.default.min.css" rel="stylesheet">
		<link href="<?=base_url();?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?=base_url();?>assets/js/jquery-ui.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/vendor/semantic/semantic.min.css">	
		<script src="<?=base_url();?>assets/js/vertical-responsive-menu.min.js"></script>
		<script src="<?=base_url();?>assets/js/jquery-3.3.1.min.js"></script>
		<script src="<?=base_url();?>assets/js/jquery-ui.min.js"></script>
		<script src="<?=base_url();?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="<?=base_url();?>assets/vendor/OwlCarousel/owl.carousel.js"></script>
		<script src="<?=base_url();?>assets/vendor/semantic/semantic.min.js"></script>
		<script src="<?=base_url();?>assets/js/custom.js"></script>
		<script src="<?=base_url();?>assets/js/night-mode.js"></script>
		<script src="<?=base_url();?>assets/js/jquery-steps.min.js"></script>
		<script src="<?=base_url();?>assets/tinymce/tinymce.min.js"></script>
	 	<link rel="stylesheet" href="<?=base_url()?>assets/vendor/bootstrap/css/sweetalert.min.css">
	 	<script src="<?=base_url();?>assets/vendor/bootstrap/js/bootstrap-datepicker.min.js"></script>
	    <script src="<?=base_url()?>assets/vendor/bootstrap/js/sweetalert.min.js"></script>  
	    <link href="https://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/css/bootstrap-multiselect.css"
    rel="stylesheet" type="text/css" />
<script src="https://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/js/bootstrap-multiselect.js"></script>
	    <style type="text/css">
	    	html, body{
	    		position: relative;
	    	}
	    </style>
	</head>
	<body>

		<!-- Header Start -->
		<header class="header clearfix">
			<button type="button" id="toggleMenu" class="toggle_menu">
			  <i class='uil uil-bars'></i>
			</button>
			<button id="collapse_menu" class="collapse_menu">
				<i class="uil uil-bars collapse_menu--icon "></i>
				<span class="collapse_menu--label"></span>
			</button>
			<div class="main_logo" id="logo">
				<h2>LMS</h2>
			</div>
			<div class="header_right">
			</div>
		</header>
		<?php 
        $access=$this->session->userdata('access');
        ?>
		<!-- Header End -->
		<!-- Left Sidebar Start -->
		<nav class="vertical_nav">
			<div class="left_section menu_left" id="js-menu" >
				<div class="left_section">
					<ul>
						<li class="menu--item">
							<a href="<?=base_url();?>admin/dashboard" class="menu--link active" title="Home">
								<i class='menu--icon'></i>
								<span class="menu--label">Dashboard</span>
							</a>
						</li>
						<li class="menu--item menu--item__has_sub_menu">
							<label class="menu--link" title="Categories">
								<i class="menu--icon"></i>
								<span class="menu--label">Institute</span>
							</label>
							<ul class="sub_menu">
								<li class="sub_menu--item">
									<a href="<?=base_url();?>admin/batch" class="sub_menu--link">Batches</a>
								</li>
								<li class="sub_menu--item">
									<a href="<?=base_url();?>admin/category" class="sub_menu--link">Course Category</a>
								</li>
								<li class="sub_menu--item">
									<a href="<?=base_url();?>admin/course" class="sub_menu--link">Courses</a>
								</li>
								<li class="sub_menu--item">
									<a href="<?=base_url();?>admin/faculty" class="sub_menu--link">Faculties</a>
								</li>
								<li class="sub_menu--item">
									<a href="<?=base_url();?>admin/student" class="sub_menu--link">Students</a>
								</li>
								<li class="sub_menu--item">
									<a href="<?=base_url();?>admin/schedule" class="sub_menu--link">Live Lectures</a>
								</li>
							</ul>
						</li>
								<li class="menu--item">
									<a href="<?=base_url();?>admin/earnings" class="menu--link"><i class='menu--icon'></i>Earnings</a>
								</li>
						<li class="menu--item menu--item__has_sub_menu">
							<label class="menu--link" title="Categories">
								<i class="menu--icon"></i>
								<span class="menu--label">Communications</span>
							</label>
							<ul class="sub_menu">
								<li class="sub_menu--item">
									<a href="<?=base_url();?>admin/notifications" class="sub_menu--link">Notifications</a>
								</li>
								<!--<li class="sub_menu--item">
									<a href="<?=base_url();?>admin/sms" class="sub_menu--link">SMS</a>
								</li>-->
							</ul>
						</li>
						<?php
						/*
						if($access->tseries!=""){
						?>
						<li class="menu--item">
							<a href="<?=base_url();?>admin/test" class="menu--link" title="Saved Courses">
							  <i class="menu--icon"></i>
							  <span class="menu--label">Test series</span>
							</a>
						</li>
						<?php
						}*/
						?>
						<li class="menu--item">
							<a href="<?=base_url();?>admin/coupons" class="menu--link" title="Live Streams">
								<i class='menu--icon'></i>
								<span class="menu--label">Coupons</span>
							</a>
						</li>
						<li class="menu--item">
							<a href="<?=base_url();?>admin/blogs" class="menu--link" title="Live Streams">
								<i class='menu--icon'></i>
								<span class="menu--label">Blogs</span>
							</a>
						</li>
						<li class="menu--item menu--item__has_sub_menu">
							<label class="menu--link" title="Categories">
								<i class="menu--icon"></i>
								<span class="menu--label">Settings</span>
							</label>
							<ul class="sub_menu">
								<?php 
								if($access->users!=""){
								?>
								<li class="sub_menu--item">
									<i class=' menu--icon'></i>
									<a href="<?=base_url();?>admin/users" class="menu--link" title="Live Streams">
										<span class="menu--label">Users</span>
									</a>
								</li>
								<?php 
								}
								if($access->setting!=""){
								?>
								<!--<li class="sub_menu--item menu--item menu--item__has_sub_menu">
									<label class="menu--link" title="Categories">
										<i class=' menu--icon'></i>
										<span class="menu--label">Website</span>
									</label>
									<ul class="sub_menu">
										<li class="sub_menu--item">
											<a href="http://localhost/lms-website/admin/home" class="sub_menu--link" style="padding-left: 100px;">Slider</a>
										</li>
										<li class="sub_menu--item">
											<a href="http://localhost/lms-website/admin/announcement" class="sub_menu--link" style="padding-left: 100px;">Slider Text</a>
										</li>
									</ul>
								</li>-->
								<li class="sub_menu--item menu--item menu--item__has_sub_menu">
									<label class="menu--link" title="Categories">
										<i class=' menu--icon'></i>
										<span class="menu--label">Application</span>
									</label>
									<ul class="sub_menu">
										<li class="sub_menu--item">
											<a href="<?=base_url();?>admin/slider" class="sub_menu--link" style="    padding-left: 100px;">Slider</a>
										</li>
									</ul>
								</li>
							<?php 
							}
							?>
							</ul>
						</li>
				<div class="left_section pt-2">
					<ul>
						<li class="menu--item">
							<a href="<?=base_url();?>admin/login/logout" class="menu--link" title="Setting">
								<i class='menu--icon'></i>
								<span class="menu--label">Logout</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	<div class="wrapper">