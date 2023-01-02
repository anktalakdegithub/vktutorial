 <div class="container">
    <div class="row">
      <div class="col-md-8 col-6">  
        <h2 class="st_title"><i class="uil uil-analysis"></i>View Assignment</h2><br>
      </div>       
    </div>  
 <div class="row">
  <?php 
  if($issubmitted[0]->Type!="link"){
  ?>
    <div class="col-md-8">
	 <iframe src="<?=$issubmitted[0]->Assignments;?>" style="width: 100%;height: 800px;"></iframe>
</div>
<?php 
}
?>
<div class="col-md-4">
<div class="card">
  <div class="card-body">
  <div class="row">
    <div class="col-md-5">
      <strong>Student Name:</strong>
    </div>
    <div class="col-md-7">
     <p><?=$student[0]->FirstName.' '.$student[0]->LastName;?></p><br>
    </div>
  </div>
  <?php 
  if($issubmitted[0]->Type=="link"){
  ?>
   <a href="<?=$issubmitted[0]->Assignments;?>" style="text-decoration: underline;">click here to view assignment</a>
<br><?php 
}
?>
<br>
	<div class="row">
		<div class="col-md-5">
			<p>Check points:</p>
		</div>
		<div class="col-md-7">
      <?php 
      if($issubmitted[0]->Points>0){
        ?>
			<input type="number" id="points" value="<?=$issubmitted[0]->Points;?>" class="form-control"><br>
      <?php 
    }
    else{
        ?>
      <input type="number" id="points" value="10" class="form-control"><br>
      <?php 
    }
    ?>
		</div>
	</div>
  <div class="row">
    <div class="col-md-5">
      <p>Comment:</p>
    </div>
    <div class="col-md-7">
     <textarea id="comment" class="form-control" placeholder="Enter comments..."><?=$issubmitted[0]->Comments;?></textarea>
    </div>
  </div>
	<div class="row">
		<div class="col-md-12">
			<button type="button" class="steps_btn" id="save" value="<?=$assignment[0]->Id;?>">Return</button>
			<br><br>
			<div id="msg"></div>
		</div>
	</div>
</div>
</div>
</div>

</div>
</div>
<script type="text/javascript">

	 $("#save").click(function(){
    var aid=$(this).val();
     var sid = '<?=$student[0]->Id;?>';
     var marks = $('#total').val();
     var points=$('#points').val();
     var comment=$('#comment').val();
   $.ajax({
     url:'<?= base_url()?>admin/assignment/addpoints',
     method: 'post',
     data: {aid:aid,sid:sid,points:points,comment:comment},
     success: function(response){
       swal("Points and comments added successfully!", "", "success");
            setTimeout(function () {
                    swal.close();
        window.location.href = "<?= base_url()?>admin/assignment/assignmentdetails/"+aid;
                }, 2000);
     }
   });
  
});
</script>