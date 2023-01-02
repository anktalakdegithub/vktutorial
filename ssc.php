<?php 
$page_title="SSC Board-VK'S Tutorial's is Sign Of Success";
$page_description="The state secondary education board functions in all the states and union territories under the Ministry of Education";
$page_keywords='educational, ssc, ICSE, CBSE, Syllabus, expertise, Practical, English, Mathematics, Biology, Report, Social Science, Testing, Growth, VII, VIII, IX, Commerce';

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
    /* font-size: 25px;
    color: #fff; */
    font-size: 20px;
    font-weight: 700;
}
</style>

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
        <h5 class="text-primary text-center text-uppercase">SSC Board</h5>
        <h1 class="display-6 mb-4 text-center">Secondary School Certificate Board</h1>
        <p class="text-center">
            The state secondary education board functions in all the states
            and union territories under the Ministry of Education each state is allowed
            to design the syllabus according to their liking making the syllabus
            different across the country
        </p>

        <div class="row mt-2">
            <div class="col-md-2 col-sm-12"></div>
            <div class="col-md-4 col-sm-12">
                <h5 class="mb-3"><i class="fa fa-check-circle text-primary me-3"></i>Priority to Regional Language</h5>
                <h5 class="mb-3"><i class="fa fa-check-circle text-primary me-3"></i>Affordable Education</h5>
            </div>
            <div class="col-md-4 col-sm-12">
                <h5 class="mb-3"><i class="fa fa-check-circle text-primary me-3"></i>Flexible Choice of Medium</h5>
                <h5 class="mb-3"><i class="fa fa-check-circle text-primary me-3"></i>In-Depth Syllabus</h5>
            </div>
        </div>
        <div class="col-md-2 col-sm-12"></div>
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
                            aria-selected="true"> <i class="fa fa-graduation-cap" aria-hidden="true"></i> SSC (V to
                            VII)</button>
                    </li>
                    <li class="nav-item" role="presentation"> <button class="nav-link classes" id="profile-tab"
                            data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab"
                            aria-controls="profile" aria-selected="false"> <i class="fa fa-graduation-cap"
                                aria-hidden="true"></i>
                            SSC (VIII to X) </button> </li>
                    <li class="nav-item" role="presentation"> <button class="nav-link classes" id="messages-tab"
                            data-bs-toggle="tab" data-bs-target="#messages" type="button" role="tab"
                            aria-controls="messages" aria-selected="false"> <i class="fa fa-graduation-cap"
                                aria-hidden="true"></i>
                            SSC (XI to XII Commerce) </button> </li>

                </ul>
                <div class="border-grey bg-white p-3 tab-content">
                    <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div  class="icses">
                            <table class="table table-bordered text-center table-responsive">
                                <thead>
                                    <tr>
                                        <th class="bg-primary text-white" colspan="3">
                                            <h5 class="pt-2 text-white">SSC (V to VII)</h5>

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
                                        <td>Hindi</td>
                                    </tr>
                                    <tr>

                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div  class="icses">
                            <table class="table table-bordered text-center table-responsive">
                                <thead>
                                    <tr>
                                        <th class="bg-primary text-white" colspan="5">
                                            <h5 class="pt-2 text-white">SSC (VIII to X)</h5>

                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="tbodyclass text-dark">
                                    <tr>
                                        <td>English</td>
                                        <td>Marathi</td>
                                        <td>Mathematics</td>
                                        <td>Science</td>
                                        <td>Geography</td>
                                    </tr>
                                    <tr>

                                        <td>History & Civics</td>
                                        <td>Sanskrit-100</td>
                                        <td>Hindi</td>
                                        <td colspan="2">SANK./ HIN. / GER./ FRE.-50</td>
                                    </tr>
                                    <tr>

                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                        <div  class="icses">
                            <table class="table table-bordered text-center table-responsive">
                                <thead>
                                    <tr>
                                        <th class="bg-primary text-white" colspan="5">
                                            <h5 class="pt-2 text-white"> SSC (XI to XII Commerce)</h5>

                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="tbodyclass text-warning">
                                    <tr>
                                        <td>Book Keeping</td>
                                        <td>Economics</td>
                                        <td>Organisation of commerce & management</td>
                                        <td>Secretarial practice</td>
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
</div>
<!-- About End -->

<!-- Team Start -->
<div class="container-fluid py-5 mb-5">
    <div class="container ">
        <h5 class="text-primary text-center text-uppercase">Our Module</h5>
        <h3 class="mb-4 text-center">Our Educational Modules Are Carved By Experts To Fully Satisfy Every Academic Need
        </h3>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 wow slideInUp cardslide bg-light text-dark py-2" data-wow-delay="0.1s">
                    <div class="card-body">
                        <h5 class="card-title text-center">VK's Course Module</h5>
                        <div  class="icses">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="row">V to VII</th>
                                        <td>CBSE</td>
                                        <td>ICSE</td>
                                        <td>SSC</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">VIII to X</th>
                                        <td>CBSE</td>
                                        <td>ICSE</td>
                                        <td>SSC</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">XI to XII Commerce</th>
                                        <td>CBSE</td>
                                        <td>ICSE</td>
                                        <td>SSC</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 wow slideInUp cardslide bg-light text-dark py-2" data-wow-delay="0.1s">

                    <div class="card-body">
                        <h5 class="card-title text-center">VK's Test Module</h5>
                        <ul class=" mb-0">
                            <li>Weekly two test</li>
                            <li>Daily question writing practice</li>
                            <li>MCQ test</li>
                            <li>Topic-wise test</li>
                            <li>Set of MOCK prelim test</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 wow slideInUp cardslide bg-light text-dark py-2" data-wow-delay="0.2s">

                    <div class="card-body">
                        <h5 class="card-title text-center">VK's Reporting Module</h5>
                        <ul class=" mb-0">
                            <li>Periodic attendance report</li>
                            <li>Periodic test reports</li>
                            <li>Periodic counselling reports</li>
                            <li>Periodic overall progress reports</li>

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
                                ability and different capacity of understanding.</li>
                            <li>We use highly animated power point presentation for teaching and revision.</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 wow slideInUp cardslide bg-light text-dark py-2" data-wow-delay="0.4s">
                    <div class="card-body">
                        <h5 class="card-title text-center">Vk’s Vocational Activities Module</h5>

                        <p class="card-text">We are providing absolutely free of cost course of other activities and
                            personality development.</p>
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
                        <p class="card-text">Taking action against the weak subject or topic of student and allotting
                            some home-work and assignment for the same. If demanded by students we go for re-teaching.
                        </p>
                    </div>
                </div>
            </div>

        </div>
        <div class="row g-4 my-3">
            <div class="col-md-2"></div>

            <div class="col-md-4">
                <div class="card h-100 wow slideInUp cardslide bg-light text-dark py-2" data-wow-delay="0.4s">
                    <div class="card-body">
                        <h5 class="card-title text-center">VK's Counselling Module</h5>

                        <ul class=" mb-0">
                            <li>Counselling at the time of Admission.</li>
                            <li>One to One Counselling of Student of their doubts and guidance for future</li>
                            <li>Counselling for how to study</li>
                            <li>Counselling for how attend exam fearlessly.</li>
                            <li>Counselling for how to be always positive.</li>
                            <li>Counselling for career guidance.</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 wow slideInUp cardslide bg-light text-dark py-2" data-wow-delay="0.1s">

                    <div class="card-body">
                        <h5 class="card-title text-center">Feedback & Suggestions</h5>
                        <p>A Continuous updated is kept on every student and faculty by way of online feedbacks.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</div>


<?php include('footer.php');?>
<script>
var firstTabEl = document.querySelector('#myTab li:last-child a')
var firstTab = new bootstrap.Tab(firstTabEl)

firstTab.show()
</script>