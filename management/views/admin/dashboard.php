<style type="text/css">
	.card{
		border: none;
	}
</style>
<div class="sa4d25">
  <div class="container-fluid">   
    <div class="row">
      <div class="col-md-10 col-6"> 
        <h2 class="st_title"><i class="uil uil-analysis"></i>Dashboard</h2><br>
      </div>        
    </div>  
	 <div class="row">
    
    <div class="col-md-3">
      <div class="card_dash text-center">
        <div class="card_dash_center">
          <p>Total Courses</p>
          <h3><?=$teachers;?></h3>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card_dash text-center">
        <div class="card_dash_center">
          <p>Total students</p>
          <h2><?=$students;?></h2>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card_dash text-center">
        <div class="card_dash_center">
          <p>Total Sales(<span>yearly</span>)</p>
          <h2>&#8377;&nbsp;154002<?php //echo $income; ?></h2>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card_dash text-center">
        <div class="card_dash_center">
          <p>Total Course Enroll</p>
          <h2><?=$cenroll;?></h2>
        </div>
      </div>
    </div>
    <?php 
    $access=$this->session->userdata('access');
        $course=$access->courses;
        $tseries=$access->tseries;
        if(in_array("add", $course) || in_array("all", $course)){
          ?>
    <div class="col-md-12">
      <div class="card_dash1">
        <div class="card_dash_left1">
          <i class="uil uil-book-alt"></i>
          <h1>Jump Into Course Creation</h1>
        </div>
        <div class="card_dash_right1">
          <button class="create_btn_dash" onclick="window.location.href = '<?=base_url();?>/admin/course/newcourse';">Create Course</button>
        </div>
      </div>
    </div>
    <?php
    }
  ?>
	</div>
	<br>
  <!--
	<div class="row">
  <div class="col-md-6">
    <div class="card">
     <div class="card-header">
 
  <h4>Today's lectures</h4>
      </div> <div class="card-body" style="height: 400px;overflow: auto;">
  <?php
  if(count($lectures['lectures'])>0){
  $i=0;
  foreach ($lectures['lectures'] as $row) {
  	 ?>
    <div class="row">
    <div class="col-md-12">
    <h4 class="text-primary"><?=$row->Title;?></h4>
    <p><i class="far fa-clock"></i>&nbsp; <?=$row->Start_time;?>-<?=$row->End_time;?> &nbsp; &nbsp; <span>Batches: 
      <?php
      foreach ($lectures['batches'][$i] as $batch) {
      	if(count($batch)>0){
       ?>
       <?=$batch[0]->Name;?>,
       <?php
      }
  }
      ?></span></p>
    <p></p>
    </div>
  </div>
   
   <hr>
    <?php
    $i++;
  }
}
else{
  echo '<div class="card card-default" style="padding: 30px;"><div class="row"><div class="col-md-4"></div><div class="col-md-4 text-center"><p>no lectures today!!</p></div><div class="col-md-4"></div></div></div>';
  
}
 ?>
</div>
</div>
</div>
<div class="col-md-6">
    <div class="card">
      <div class="card-header">
  <h4>Today's absents</h4>
      </div>
      <div class="card-body" style="height: 400px;overflow: auto;">
  <?php
  if(count($absents['lectures'])>0){
  $i=0;
  foreach ($absents['lectures'] as $lect) {
  	foreach ($absents['students'][$i] as $row) {
  	 ?>
    <div class="row">
    <div class="col-md-12">
    <h4 class="text-primary"><?=$row[0]->FirstName.' '.$row[0]->LastName;?></h4>
    <p><i class="fas fa-phone"></i>&nbsp;  <?=$row[0]->Phone;?><span> &nbsp; &nbsp;Lecture:&nbsp;  <?=$lect->Title;?>
</span></p>
    </div>
  </div>
   
   <hr>
    <?php
   
  }
   $i++;
}
}
else{
  echo '<div class="card card-default" style="padding: 30px;"><div class="row"><div class="col-md-4"></div><div class="col-md-4 text-center"><p>no lectures today!!</p></div><div class="col-md-4"></div></div></div>';
  
}
 ?>
</div>
</div>
</div>
</div>-->
</div>