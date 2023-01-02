<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
		<meta charset="utf-8">
		<!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
		<meta name="viewport" content="width=device-width, shrink-to-fit=9">
		<title>Vktutorials</title>
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
			<button id="collapse_menu" class="collapse_menu pt-3">
				<i class="fa fa-bars"></i>
				<span class="collapse_menu--label"></span>
			</button>
			<div class="main_logo" id="logo">
				<h2>Vktutorials</h2>
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
						<li class="menu--item">
							<a href="<?=base_url();?>admin/course" class="menu--link" title="">
								<i class='menu--icon'></i>
								<span class="menu--label">Courses</span>
							</a>
						</li>
						<li class="menu--item">
							<a href="<?=base_url();?>admin/Attendance?from_date=<?=date('Y-m-d');?>&to_date=<?=date('Y-m-d');?>" class="menu--link" title="">
								<i class='menu--icon'></i>
								<span class="menu--label">Attendance</span>
							</a>
						</li>
						<li class="menu--item">
							<a href="<?=base_url();?>admin/batch" class="menu--link" title="">
								<i class='menu--icon'></i>
								<span class="menu--label">Batches</span>
							</a>
						</li>
						<li class="menu--item">
							<a href="<?=base_url();?>admin/student" class="menu--link" title="">
								<i class='menu--icon'></i>
								<span class="menu--label">Students</span>
							</a>
						</li>
						<li class="menu--item">
							<a href="<?=base_url();?>admin/faculty" class="menu--link" title="">
								<i class='menu--icon'></i>
								<span class="menu--label">Faculty</span>
							</a>
						</li>
						<li class="menu--item">
							<a href="<?=base_url();?>admin/exams" class="menu--link" title="">
								<i class='menu--icon'></i>
								<span class="menu--label">Exams</span>
							</a>
						</li>
						<li class="menu--item">
							<a href="<?=base_url();?>admin/counselling" class="menu--link" title="">
								<i class='menu--icon'></i>
								<span class="menu--label">Counselling</span>
							</a>
						</li>
						<li class="menu--item">
							<a href="<?=base_url();?>admin/fees" class="menu--link" title="">
								<i class='menu--icon'></i>
								<span class="menu--label">Fees</span>
							</a>
						</li>
						<li class="menu--item">
							<a href="<?=base_url();?>admin/report" class="menu--link" title="">
								<i class='menu--icon'></i>
								<span class="menu--label">Report</span>
							</a>
						</li>
						<!-- <li class="menu--item menu--item__has_sub_menu">
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
						</li> -->
						<!-- <li class="menu--item">
							<a href="<?=base_url();?>admin/earnings" class="menu--link"><i class='menu--icon'></i>Earnings</a>
						</li> -->
						<li class="menu--item menu--item__has_sub_menu">
							<label class="menu--link" title="Categories">
								<i class="menu--icon"></i>
								<span class="menu--label">Communications</span>
							</label>
							<ul class="sub_menu">
								<li class="sub_menu--item">
									<a href="<?=base_url();?>admin/notifications" class="sub_menu--link">Notifications</a>
								</li>
								<li class="sub_menu--item">
									<a href="<?=base_url();?>admin/sms" class="sub_menu--link">Messages</a>
								</li>
								<li class="sub_menu--item">
									<a href="<?=base_url();?>admin/emails" class="sub_menu--link">Emails</a>
								</li>
							</ul>
						</li>
							</ul>
						</li>
				<div class="left_section pt-2">
					<ul>
						<li class="menu--item">
							<a href="<?=base_url();?>admin/academic_year" class="menu--link" title="Setting">
								<i class='menu--icon'></i>
								<span class="menu--label">Change Academic Year</span>
							</a>
						</li>
					</ul>
				</div>
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
