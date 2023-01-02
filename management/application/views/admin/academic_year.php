<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">		
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, shrink-to-fit=9">
		<meta name="description" content="Gambolthemes">
		<meta name="author" content="Gambolthemes">
		<title>Academic Year</title>
		
		<!-- Favicon Icon -->
		<link rel="icon" type="image/png" href="images/fav.png">
		
		<!-- Stylesheets -->
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500' rel='stylesheet'>
		<link href='<?=base_url();?>assets/vendor/unicons-2.0.1/css/unicons.css' rel='stylesheet'>
		<link href="<?=base_url();?>assets/css/vertical-responsive-menu.min.css" rel="stylesheet">
		<link href="<?=base_url();?>assets/css/style.css" rel="stylesheet">
		<link href="<?=base_url();?>assets/css/responsive.css" rel="stylesheet">
		<link href="<?=base_url();?>assets/css/night-mode.css" rel="stylesheet">
		
		<!-- Vendor Stylesheets -->
		<link href="<?=base_url();?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
		<link href="<?=base_url();?>assets/vendor/OwlCarousel/assets/owl.carousel.css" rel="stylesheet">
		<link href="<?=base_url();?>assets/vendor/OwlCarousel/assets/owl.theme.default.min.css" rel="stylesheet">
		<link href="<?=base_url();?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/vendor/semantic/semantic.min.css">	
		
	</head> 

<body>
	<!-- Signup Start -->
	<div class="sign_in_up_bg">
		<div class="container">
			<div class="row justify-content-lg-center justify-content-md-center">
				<div class="col-lg-12">
					<div class="main_logo25" id="logo">
						<a href="index.html"><img src="images/logo.svg" alt=""></a>
						<a href="index.html"><img class="logo-inverse" src="images/ct_logo.svg" alt=""></a>
					</div>
				</div>
			
				<div class="col-lg-6 col-md-8">
					<div class="sign_form">
						<h2>Welcome To VKtutorials</h2>
						<form action="<?=base_url();?>admin/academic_year/selectacademic" method="post">
							<div class="ui search focus mt-15">
								<div class="ui left icon input swdh95">
									<select class="form-control" name="ayear">
										<option value="">Select academic year</option>
										<?php 
										foreach($ayears as $ayear){
											?>
											<option value="<?=$ayear->year_id;?>"><?=$ayear->academic_year;?></option>
											<?php
										}
										?>
									</select>
								</div>
							</div>
							 <input type="submit" class="login-btn" name="loginSubmit" value="SELECT">
						</form>
					</div>
				</div>				
			</div>				
		</div>				
	</div>
	<!-- Signup End -->	

	<script src="<?=base_url();?>assets/js/jquery-3.3.1.min.js"></script>
	<script src="<?=base_url();?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?=base_url();?>assets/vendor/OwlCarousel/owl.carousel.js"></script>
	<script src="<?=base_url();?>assets/vendor/semantic/semantic.min.js"></script>
	<script src="<?=base_url();?>assets/js/custom.js"></script>	
	<script src="<?=base_url();?>assets/js/night-mode.js"></script>	
	
</body>
</html>