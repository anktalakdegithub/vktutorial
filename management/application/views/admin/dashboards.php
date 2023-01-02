<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-6">
            <div class="alert alert-primary">
                <?php 
                    if($total!=""){
                      ?>
                <h3 id="tplecturest"><?=$total;?></h3>
                <?php
                    }else{
                      ?>
                <h3 id="tplecturest">0</h3>
                <?php
                    }
                    ?>
                <p>Total Fees</p>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="alert alert-success">
                <?php 
                    if($paid!=""){
                      ?>
                <h3 id="tplecturest1"><?=$paid;?></h3>
                <?php
                    }else{
                      ?>
                <h3 id="tplecturest1">0</h3>
                <?php
                    }
                    ?>
                <p>Total Paid</p>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="alert alert-danger">
                <?php 
                    if($todayspaid!=""){
                      ?>
                <h3 id="tplecturest1"><?=$todayspaid;?></h3>
                <?php
                    }else{
                      ?>
                <h3 id="tplecturest1">0</h3>
                <?php
                    }
                    ?>
                <p>Total Unpaid</p>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-3">
            <div class="card card-body">
                <?php 
                    if($batch['totalbatch']!=""){
                      ?>
                <h3 id="tplecturest3"><?=$batch['totalbatch'];?></h3>
                <?php
                    }else{
                      ?>
                <h3 id="tplecturest4">0</h3>
                <?php
                    }
                    ?>
                <p>Total Batch</p>
            </div>
        </div>
        <div class="col-3">
            <div class="card card-body">
                <?php 
                    if($course['totalcourse']!=""){
                      ?>
                <h3 id="tplecturest3"><?=$course['totalcourse'];?></h3>
                <?php
                    }else{
                      ?>
                <h3 id="tplecturest4">0</h3>
                <?php
                    }
                    ?>
                <p>Total Course</p>
            </div>
        </div>
        <div class="col-3">
            <div class="card card-body">
                <?php 
                    if($student['totalstud']!=""){
                      ?>
                <h3 id="tplecturest2"><?=$student['totalstud'];?></h3>
                <?php
                    }else{
                      ?>
                <h3 id="tplecturest2">0</h3>
                <?php
                    }
                    ?>
                <p>Total Student</p>
            </div>
        </div>
    </div>
</div><br>
<div class="container-fluid">
    <div class="row">
         <div class="col-md-6">
            <div class="card" style="overflow-y: auto;height: 380px;">
                <div class="card-body ">
                    <h3 class="text-dark">Upcoming Fees</h3>
                    <div id="ufees">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card" style="overflow-y: auto;height: 380px;">
                <div class="card-body ">
                    <h3 class="text-dark">Overdue Fees</h3>
                    <div id="ofees">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6"><br>
            <div class="card" style="overflow-y: auto;height: 380px;">
                <div class="card-body ">
                    <h3 class="text-dark">Upcoming Lectures</h3>
                    <div id="lectures">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6"><br>
            <div class="card" style="overflow-y: auto;height: 380px;">
                <div class="card-body ">
                    <h3 class="text-dark">Upcoming Worksheets</h3>
                    <div id="worksheets">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6"><br>
            <div class="card" style="overflow-y: auto;height: 380px;">
                <div class="card-body ">
                    <h3>Upcoming Oral & Question Writings</h3>
                    <div id="qws">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6"><br>
            <div class="card" style="overflow-y: auto;height: 380px;">
                <div class="card-body ">
                    <h3>Upcoming Assignments</h3>
                    <div id="assignments">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6"><Br>
            <div class="card" style="overflow-y: auto;height: 380px;">
                <div class="card-body ">
                    <h3 class="text-dark">Upcoming Exams</h3>
                    <div id="exams">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    fetchupcomingfees();
    fetchoverduefees();
    fetchlectures();
    fetchworksheets();
    fetchqws();
    fetchassignments();
    fetchexams();
    function fetchupcomingfees(){
         $.ajax({
            url: "<?= base_url()?>admin/dashboard/upcomingfees",
            data: {},
            type: "post",
            success: function(data){
               $('#ufees').html(data);
            }
        });
    }
    function fetchoverduefees(){
         $.ajax({
            url: "<?= base_url()?>admin/dashboard/overduefees",
            data: {},
            type: "post",
            success: function(data){
               $('#ofees').html(data);
            }
        });
    }
    function fetchlectures(){
         $.ajax({
            url: "<?= base_url()?>admin/dashboard/fetchlectures",
            data: {},
            type: "post",
            success: function(data){
               $('#lectures').html(data);
            }
        });
    }
    function fetchworksheets(){
         $.ajax({
            url: "<?= base_url()?>admin/dashboard/fetchworksheets",
            data: {},
            type: "post",
            success: function(data){
               $('#worksheets').html(data);
            }
        });
    }
    function fetchqws(){
         $.ajax({
            url: "<?= base_url()?>admin/dashboard/fetchqws",
            data: {},
            type: "post",
            success: function(data){
               $('#qws').html(data);
            }
        });
    }
    function fetchassignments(){
         $.ajax({
            url: "<?= base_url()?>admin/dashboard/fetchassignments",
            data: {},
            type: "post",
            success: function(data){
               $('#assignments').html(data);
            }
        });
    }
    function fetchexams(){
         $.ajax({
            url: "<?= base_url()?>admin/dashboard/fetchexams",
            data: {},
            type: "post",
            success: function(data){
               $('#exams').html(data);
            }
        });
    }
</script>