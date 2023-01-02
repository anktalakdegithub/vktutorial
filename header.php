<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="title" content="<?php echo htmlspecialchars($page_title); ?>">
    <title><?php echo htmlspecialchars($page_title); ?> </title>
    <meta name="description" content="<?php echo htmlspecialchars($page_description); ?>">
    <?php 
      $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    ?>
      <link href="img/fav.png" rel="icon">
    <link rel="canonical" href="<?=$actual_link;?>"  />


    <meta name="keywords" content="<?php echo htmlspecialchars($page_keywords); ?>">
    <meta property="og:type" content="<?php echo htmlspecialchars($page_title); ?>" />
    <meta property="og:site_name" content="<?php echo htmlspecialchars($page_title); ?>" />
    <meta property="og:title" content="<?php echo htmlspecialchars($page_title); ?>" />
    <meta property="og:url" content="<?=$actual_link;?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($page_description); ?>" />
    <meta property="og:image" content="img/fav.png" alt="VK'S Tutorial's is Sign Of Success" />
    <meta property="og:image:secure_url" content="img/fav.png">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($page_title); ?>">

    <meta name="twitter:description" content="<?php echo htmlspecialchars($page_description); ?>">


    <meta content="width=device-width, initial-scale=1.0" name="viewport">
  

    <!-- Favicon -->


    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="lib/twentytwenty/twentytwenty.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
 <style type="text/css">
        .spinner-wrapper {
position: fixed;
top: 0;
left: 0;
right: 0;
bottom: 0;
background-color: #fff;
z-index: 999999;
}
.hide
{

   display: none;
}
.spinner {
   text-align: center;
}
.spinner-wrapper img{
        margin-top: 10%;
    text-align: center;
}
 </style>

</head>

<body>
   <!--CSS Spinner-->
<div class="spinner-wrapper">
<div class="spinner"><img src="img/banners/wpreloader.gif"></div>
</div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <div class="container-fluid ps-5 pe-0 d-none d-lg-block">
        <div class="row gx-0">
            <div class="col-md-5 text-center text-lg-start mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center">
                    <!-- <small class="py-2"><i class="far fa-clock text-primary me-2"></i>Opening Hours: Mon - Tues : 6.00 am - 10.00 pm, Sunday Closed </small> -->
                   
                </div>
            </div>
            <div class="col-md-7 text-center text-lg-end">
                <div class="position-relative d-inline-flex align-items-center bg-primary text-white top-shape px-5">
                    <div class="me-3 pe-3 border-end py-2">
                        <p class="m-0"><i class="fa fa-envelope-open me-2"></i>vktutorialsthane@gmail.com</p>
                    </div>
                    <div class="me-3 pe-3 border-end py-2">
                        <p class="m-0"><i class="fa fa-phone-alt me-2"></i>9769797757 / 9769829212</p>
                    </div>
                    <div class="py-2">
                    <a class="m-0 text-white" href="https://www.facebook.com/VKtutorialsthane" target="_blank"><i class="fab fa-facebook-f fw-normal"></i></a>
                        <a class="m-0 text-white" href="https://www.instagram.com/vktutorialsthane/" target="_blank"><i class="fab fa-instagram fw-normal"></i></a>
                        <a class="m-0 text-white" href="https://www.youtube.com/channel/UCUlK4uWsG11C639kBBtLpog" target="_blank"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
          
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow-sm px-md-5 px-1 py-3 py-lg-0">
    <a href="index.php" class="navbar-brand p-0">
                <!-- <h1 class="m-0 text-primary">VK'S</h1> -->
                <img src="img/VKLOGO.png" alt="Logo">
            </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
       
        <div class="collapse navbar-collapse" id="navbarCollapse">
           
            <div class="navbar-nav ms-auto py-0">
                <a href="index.php" class="nav-item nav-link">Home</a>
                <a href="about.php" class="nav-item nav-link">About</a>
                <!-- <a href="courses.php" class="nav-item nav-link">Courses</a> -->
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Courses</a>
                    <div class="dropdown-menu m-0">
                        <a href="cbse.php" class="dropdown-item">CBSE</a>
                        <a href="icse.php" class="dropdown-item">ICSE</a>
                        <a href="ssc.php" class="dropdown-item">SSC</a>
                        <!-- <a href="appointment.php" class="dropdown-item">Appointment</a> -->
                    </div>
                </div>
                <a href="contact.php" class="nav-item nav-link">Contact</a>
            </div>
            <!-- <button type="button" class="btn text-dark" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fa fa-search"></i></button> -->
            <a href="enquiry.php" class="btn btn-primary py-2 px-4 ms-3">Enquire Now</a>
        </div>
    </nav>
    <!-- Navbar End -->
