<?php
$page_title="Enquire Now-VK'S Tutorial's is Sign Of Success";
$page_description="To become the number one institute in the heart of students and parents.";
$page_keywords='educational, ssc, ICSE, CBSE, expertise, state-of-the-art,Teaching, Report, Testing, Growth, VII, VIII, IX, Commerce';

 include('header.php');?>



<!-- Hero Start -->
<div class="container-fluid bg-primary py-5 hero-header mb-5">
    <div class="row py-3">
        <div class="col-12 text-center">
            <h1 class="display-3 text-white animated zoomIn">Enquire Now</h1>
            <a href="index.php" class="h4 text-white">Home</a>
            <i class="far fa fa-angle-double-right text-white px-2"></i>
            <a href="#" class="h4 text-white">Enquire Now</a>
        </div>
    </div>
</div>
<!-- Hero End -->


<!-- Appointment Start -->
<div class="container-fluid mb-5 pb-5 wow fadeInUp etop" data-wow-delay="0.1s">
    <div class="container">
        <div class="row gx-5">
            <div class="col-lg-6 ">
                <div class="">
                   <img src="img/vkbanner.png" class="img-fluid" alt="vk banner">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="enquire h-100 d-flex flex-column justify-content-center text-center p-5 wow zoomIn"
                    data-wow-delay="0.6s">
                    <h1 class="text-dark mb-4">Enquire Now</h1>
                    <form  method="POST">
                        <div class="row g-3">

                            <div class="col-12 col-sm-6">
                                <input type="text"  name="name" id="name" class="form-control bg-light border-0 einput" placeholder="Your Name">
                            </div>
                            <div class="col-12 col-sm-6">
                                <input type="tel"  name="contactnum" id="contactnum" class="form-control bg-light border-0 einput" placeholder="Your Contact Number">
                            </div>
                            <div class="col-12 col-sm-6">

                                <select class="form-select bg-light border-0 einput" id="board" name="class">
                                    <option selected>Select a Board</option>
                                    <option value="CBSE">CBSE</option>
                                    <option value="SSC">SSC</option>
                                    <option value="ICSE">ICSE</option>
                                </select>
                            </div>
                            <div class="col-12 col-sm-6">
                                <select class="form-select bg-light border-0 einput" name="grade" id="grade">
                                    <option selected>Select Grade</option>
                                    <option value="v">v</option>
                                    <option value="VI">VI</option>
                                    <option value="VII">VII</option>
                                    <option value="VIII">VIII</option>
                                    <option value="IX">IX</option>
                                    <option value="X">X</option>
                                    <option value="XI (Commerce)">XI (Commerce)</option>
                                    <option value="XII (Commerce)">XII (Commerce)</option>
                                </select>
                            </div>
                            <div class="col-12 col-sm-12">
                                <input type="email" name="email" id="email" class="form-control bg-light border-0 einput" placeholder="Your Mail Adddress">
                            </div>
                            <div class="col-12">
                               <button type="button" name="submit" class="btn btn-dark w-100 py-3" id="butaddresult">Make Appointment</button>
                         					  <div id="msg"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Appointment End -->

<!-- Footer Start -->
<?php include('footer.php');?>

<script>
$('#butaddresult').on('click', function()
{
  var name = $('#name').val();
		var email = $('#email').val();
        var board = $('#board').val();
        var grade = $('#grade').val();
    var contactnum = $('#contactnum').val();

    $.ajax({
        url:"savedata.php",
        data: {'name': name,'email':email,'board':board,'grade':grade,'contactnum':contactnum},
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