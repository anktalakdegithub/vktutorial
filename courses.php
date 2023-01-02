<?php 
$page_title="Courses-VK'S Tutorial's is Sign Of Success";
$page_description="It allows privet schools as well as Government school to follow its curriculum both Hindi & English Language are used as medium of instruction in CBSC";
$page_keywords='educational, ssc, ICSE, CBSE, Syllabus, expertise, Practical, English, Courses, Mathematics, Biology, Report, Social Science, Testing, Growth, VII, VIII, IX, Commerce';

include('header.php');?>
<style>
.border-grey {
    border: 1px solid;
    border-end-start-radius: 5px;
    border-end-end-radius: 5px;
    border-top: none;
    border-color: #fff;
}

.active {
    background-color: white
}

#myTab {
    background-color: #1bd0dd;
}

.nav-link:hover,
.nav-link:focus {
    color: #13215b !important;
}

.classes {
    color: #fff;
    font-size: 25px;
}
</style>
<!-- Full Screen Search Start -->
<div class="modal fade" id="searchModal" tabindex="-1">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content" style="background: rgba(9, 30, 62, .7);">
            <div class="modal-header border-0">
                <button type="button" class="btn bg-white btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex align-items-center justify-content-center">
                <div class="input-group" style="max-width: 600px;">
                    <input type="text" class="form-control bg-transparent border-primary p-3"
                        placeholder="Type search keyword">
                    <button class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Full Screen Search End -->


<!-- Hero Start -->
<div class="container-fluid bg-primary py-5 hero-header mb-5">
    <div class="row py-3">
        <div class="col-12 text-center">
            <h1 class="display-3 text-white animated zoomIn">Courses</h1>
            <a href="" class="h4 text-white">Home</a>
            <i class="far fa fa-angle-double-right text-white px-2"></i>
            <a href="" class="h4 text-white">Courses</a>
        </div>
    </div>
</div>
<!-- Hero End -->
<div class="container-fluid py-5 mb-5">
    <div class="container ">
        <h5 class="text-primary text-center text-uppercase">CBSC</h5>
        <h1 class="display-6 mb-4 text-center">Central Board of Secondary Education</h1>
        <p class="text-center">
            It is a Government Education Board. It is run by the Central Government of India.
            It allows privet schools as well as Government school to follow its curriculum both Hindi and English
            Language are used as medium
            of instruction in CBSC
        </p>
        <div class="row mt-2">
            <div class="col-md-3 col-sm-12"></div>
            <div class="col-md-3 col-sm-12">
                <h5 class="mb-3"><i class="fa fa-check-circle text-primary me-3"></i>Study Friendly</h5>
                <h5 class="mb-3"><i class="fa fa-check-circle text-primary me-3"></i>Flexible</h5>
            </div>
            <div class="col-md-3 col-sm-12">
                <h5 class="mb-3"><i class="fa fa-check-circle text-primary me-3"></i>Homogenous</h5>
                <h5 class="mb-3"><i class="fa fa-check-circle text-primary me-3"></i>JEE-NEET Preparation</h5>
            </div>
        </div>
        <div class="col-md-3 col-sm-12"></div>
    </div>
</div>

<!-- About Start -->
<div class="container-fluid  wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">

        <div class="row  g-5">
            <div class="col-lg-12">

                <ul class="m-0 nav nav-fill nav-justified nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation"> <button class="active nav-link classes" id="home-tab"
                            data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home"
                            aria-selected="true"> <i class="fa fa-graduation-cap" aria-hidden="true"></i> CBSE (V to
                            VII)</button>
                    </li>
                    <li class="nav-item" role="presentation"> <button class="nav-link classes" id="profile-tab"
                            data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab"
                            aria-controls="profile" aria-selected="false"> <i class="fa fa-graduation-cap"
                                aria-hidden="true"></i>
                            CBSC (VIII to X) </button> </li>
                    <li class="nav-item" role="presentation"> <button class="nav-link classes" id="messages-tab"
                            data-bs-toggle="tab" data-bs-target="#messages" type="button" role="tab"
                            aria-controls="messages" aria-selected="false"> <i class="fa fa-graduation-cap"
                                aria-hidden="true"></i>
                            CBSC (XI to XII Commerce) </button> </li>

                </ul>
                <div class="border-grey bg-white p-3 tab-content">
                    <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th class="bg-primary text-white" colspan="3">
                                        <h5 class="pt-2 text-white">CBSE (V to VII)</h5>

                                    </th>
                                </tr>
                            </thead>
                            <tbody class="tbodyclass">
                                <tr>
                                    <td>English</td>
                                    <td>Mathematics</td>
                                    <td>Science</td>
                                </tr>
                                <tr>

                                    <td>Marathi</td>
                                    <td>Social Science</td>
                                    <td>HindiI-100</td>
                                </tr>
                                <tr>

                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th class="bg-primary text-white" colspan="4">
                                        <h5 class="pt-2 text-white">CBSC (VIII to X)</h5>

                                    </th>
                                </tr>
                            </thead>
                            <tbody class="tbodyclass">
                                <tr>
                                    <td>English</td>
                                    <td>Hindi</td>
                                    <td>Mathematics</td>
                                    <td>Science</td>
                                </tr>
                                <tr>

                                    <td>Marathi</td>
                                    <td>Social Science</td>
                                    <td>Sanskrit</td>
                                    <td>French</td>
                                </tr>
                                <tr>

                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th class="bg-primary text-white" colspan="3">
                                        <h5 class="pt-2 text-white"> CBSC (XI to XII Commerce)</h5>

                                    </th>
                                </tr>
                            </thead>
                            <tbody class="tbodyclass">
                                <tr>

                                    <td>Hindi</td>
                                    <td>Marathi</td>
                                    <td>French</td>
                                </tr>


                            </tbody>
                        </table>

                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th class="bg-primary text-white" colspan="4">
                                        <h5 class="pt-2 text-white"> Academics Electives</h5>

                                    </th>
                                </tr>
                            </thead>
                            <tbody class="tbodyclass">
                                <tr>

                                    <td>Accountancy</td>
                                    <td>Business Studies</td>
                                    <td>Economics</td>
                                    <td>Mathematics</td>

                                </tr>


                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
<!-- About End -->

<!-- Team Start -->
<div class="container-fluid py-5 mb-5">
    <div class="container ">
        <h5 class="text-primary text-center text-uppercase">Our Module</h5>
        <h1 class="display-6 mb-4 text-center">To become the number one Institute in the Heart of Students And
            Parents.</h1>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 wow slideInUp cardslide bg-light text-dark py-2" data-wow-delay="0.1s">

                    <div class="card-body">
                        <h5 class="card-title text-center">VK's Test Module</h5>
                        <ul class=" mb-0">
                            <li>Weekly two Test</li>
                            <li>Daily Question Writing Practice</li>
                            <li>MCQ Test</li>
                            <li>Topic-wise Test</li>
                            <li>Set of MOCK Prelim Test</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 wow slideInUp cardslide bg-light text-dark py-2" data-wow-delay="0.2s">

                    <div class="card-body">
                        <h5 class="card-title text-center">VK's Reporting Module</h5>
                        <ul class=" mb-0">
                            <li>Periodic Attendance report</li>
                            <li>Periodic Test Reports</li>
                            <li>Periodic Counselling Reports</li>
                            <li>Periodic Overall Progress Reports</li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 wow slideInUp cardslide bg-light text-dark py-2" data-wow-delay="0.3s">

                    <div class="card-body">
                        <h5 class="card-title text-center">VK's Teaching Module</h5>
                        <ul class=" mb-0">
                            <li>We teach according to the ability of the students because every student has different
                                ability and different capacity of understanding</li>
                            <li>We use highly animated power point presentation for teaching and revision.</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 wow slideInUp cardslide bg-light text-dark py-2" data-wow-delay="0.4s">
                    <div class="card-body">
                        <h5 class="card-title text-center">VK's giving Scope to other Activities module</h5>
                        <p class="card-text">We Are Providing Absolutely Free Of Cost Course Of Other Activities And
                            Personality Development.</p>
                        <ul class=" mb-0">
                            <li>Chess</li>
                            <li>Singing</li>
                            <li>Dancing</li>
                            <li>Caroms</li>
                            <li>Instrumental Music</li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 wow slideInUp cardslide bg-light text-dark py-2" data-wow-delay="0.4s">
                    <div class="card-body">
                        <h5 class="card-title text-center">VK's Feedback & Assignment Module</h5>
                        <p class="card-text">Taking Action Against The Weak Subject Or Topic Of Student And Allotting
                            Some Home-Work And Assignment For The Same. If Demanded By Students We Go For Re-teaching
                        </p>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 wow slideInUp cardslide bg-light text-dark py-2" data-wow-delay="0.4s">
                    <div class="card-body">
                        <h5 class="card-title text-center">VK's Counselling Module</h5>

                        <ul class=" mb-0">
                            <li>Counselling at the time of Admission</li>
                            <li>One to One Counselling of Student of their doubts and guidance for future</li>
                            <li>Counselling for How to Study</li>
                            <li>Counselling for How attend exam Fearlessly.</li>
                            <li>Counselling for How to be always Positive.</li>
                            <li>Counselling for Career guidance.</li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-4 my-3">
            <div class="col-md-4"></div>
           
            <div class="col-md-4">
                <div class="card h-100 wow slideInUp cardslide bg-light text-dark py-2" data-wow-delay="0.1s">

                    <div class="card-body">
                        <h5 class="card-title text-center">Feedback & Suggestions</h5>
                       <p>A Continuous updated is kept on every student and faculty by way of online feedbacks.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>

    </div>
</div>
<!-- Team End -->
<!--
<div class="container-fluid bg-primary bg-appointment mb-5 pb-5 wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-6 py-5">
                    <div class="py-5">
                        <h1 class="display-5 text-white mb-4">Welcome To VK's Tutorial's</h1>
                        <p class="text-white mb-0">A New Educational Concept Offering Powerful, Well Executed Pattern Of Modular Education For CBSE, ICSE, SSC. We Offer Best Of The Best State-of-the-art Educational Experience For Your Full Academic Growth And Be Your Backbone Of Learning Where You Can Have Stress - Free Learning & Score Higher.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="appointment-form h-100 d-flex flex-column justify-content-center text-center p-5 wow zoomIn" data-wow-delay="0.6s" style="visibility: visible; animation-delay: 0.6s; animation-name: zoomIn;">
                        <h1 class="text-white mb-4">Enquire Now</h1>
                        <form>
                            <div class="row g-3">
                             
                                <div class="col-12 col-sm-6">
                                    <input type="text" class="form-control bg-light border-0" placeholder="Your Name" style="height: 55px;">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="email" class="form-control bg-light border-0" placeholder="Your Email" style="height: 55px;">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <select class="form-select bg-light border-0" style="height: 55px;">
                                        <option selected="">Select A Service</option>
                                        <option value="1">Service 1</option>
                                        <option value="2">Service 2</option>
                                        <option value="3">Service 3</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <select class="form-select bg-light border-0" style="height: 55px;">
                                        <option selected="">Select class</option>
                                        <option value="1">class 1</option>
                                        <option value="2">class 2</option>
                                        <option value="3">class 3</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="date" id="date1" data-target-input="nearest">
                                        <input type="text" class="form-control bg-light border-0 datetimepicker-input" placeholder="Date" data-target="#date1" data-toggle="datetimepicker" style="height: 55px;">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="time" id="time1" data-target-input="nearest">
                                        <input type="text" class="form-control bg-light border-0 datetimepicker-input" placeholder="Time" data-target="#time1" data-toggle="datetimepicker" style="height: 55px;">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-dark w-100 py-3" type="submit">Enquire Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
-->

<?php include('footer.php');?>
<script>
var firstTabEl = document.querySelector('#myTab li:last-child a')
var firstTab = new bootstrap.Tab(firstTabEl)

firstTab.show()
</script>