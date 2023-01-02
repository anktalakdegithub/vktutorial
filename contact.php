<?php
$page_title="Contact Us-VK'S Tutorial's is Sign Of Success";
$page_description="Our counsellors are trained to solve any of your problems effectively so that you only concentrate on your studies.";
$page_keywords='educational, ssc, ICSE, CBSE, Syllabus, expertise, Practical, English, Mathematics, Biology, Report, Social Science, Testing, Growth, VII, VIII, IX, Commerce';

include('header.php');?>
 <!-- Hero Start -->
    <div class="container-fluid bg-primary py-5 hero-header mb-5">
        <div class="row py-3">
            <div class="col-12 text-center">
                <h1 class="display-3 text-white animated zoomIn">Contact Us</h1>
                <a href="index.php" class="h4 text-white">Home</a>
                <i class="far fa fa-angle-double-right text-white px-2"></i>
                <a href="#" class="h4 text-white">Contact</a>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- Contact Start -->
    <div class="container-fluid py-5 my-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-xl-4 col-lg-6 wow slideInUp" data-wow-delay="0.1s">
                    <div class="bg-light rounded h-100 p-5">
                        <div class="section-title">
                            <h5 class="position-relative d-inline-block text-primary text-uppercase">Contact Us</h5>
                            <h2 class="display-6 mb-4">Feel Free To Contact Us</h2>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-geo-alt fs-1 text-primary me-3"></i>
                            <div class="text-start">
                                <h5 class="mb-0">Our Office</h5>
                                <span>2nd Floor, Vakratund Bunglow No. 3, Opposite Sayaba Hotel, Near Lokmanya Nagar Old Bus Stop, Savarkar Nagar(W), -400606.</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-envelope-open fs-1 text-primary me-3"></i>
                            <div class="text-start">
                                <h5 class="mb-0">Email Us</h5>
                                <span>vktutorialsthane@gmail.com</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-phone-vibrate fs-1 text-primary me-3"></i>
                            <div class="text-start">
                                <h5 class="mb-0">Call Us</h5>
                                <span>9769797757 / 9769829212</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 wow slideInUp" data-wow-delay="0.3s">
                    <form>
                        <div class="row g-3">
                            <h4>Contact Us</h4>
                            <div class="col-12">
                                <input type="text" class="form-control border-0 bg-light px-4 einput" name="name" id="name"  placeholder="Your Name">
                            </div>
                            <div class="col-12">
                                <input type="email" class="form-control border-0 bg-light px-4 einput" name="email" id="email"  placeholder="Your Email">
                            </div>
                            <div class="col-12">
                                <input type="text" class="form-control border-0 bg-light px-4 einput"  name="connum" id="connum"  placeholder="Your Contact Number">
                            </div>
                            <div class="col-12">
                                <textarea class="form-control border-0 bg-light px-4 py-3"  name="msg" id="msg" rows="5" placeholder="Message"></textarea>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="button" id="sendmsg">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-xl-4 col-lg-12 wow slideInUp" data-wow-delay="0.6s">
                  <iframe class="position-relative rounded w-100 h-100 mapsicon"
                        src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d3767.714095401742!2d72.95140926485341!3d19.2076859370126!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1s2nd%20Floor%2C%20Vakratund%20Bunglow%20No.%203%2C%20Opposite%20Sayaba%20Hotel%2C%20Near%20Lokmanya%20Nagar%20Old%20Bus%20Stop%2C%20Savarkar%20Nagar(W)%2C%20-400606.!5e0!3m2!1sen!2sin!4v1642844141065!5m2!1sen!2sin"
                        frameborder="0" allowfullscreen="" aria-hidden="false"
                        tabindex="0"></iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Start -->
    <?php include('footer.php');?>
    <script>
$('#sendmsg').on('click', function()
{
  var name = $('#name').val();
		var email = $('#email').val();
        var connum = $('#connum').val();
        var msg = $('#msg').val();

    $.ajax({
        url:"savecondata.php",
        data: {'name': name,'email':email,'connum':connum,'msg':msg},
        dataType: "json",
        type: "post",
        success: function(data) {
           
               debugger;
          if(data.code=="404"){
                    $('#msg').html('<div class="alert alert-danger mt-3" role="alert">'+data.msg+'</div>');
                }
                else{
                    $('#msg').html('<div class="alert alert-success mt-3" role="alert">'+data.msg+'</div>');
                    // purchase_product();
                    // window.location.href="contact.php";					

                }
          
        }
    });
});

</script>