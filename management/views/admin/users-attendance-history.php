<title>Attendance history</title> <br>
<div class="sa4d25">
<div class="container">
  <div class="row">
    <div class="col-md-8">
      <h3 style="text-align: left !important;" id="attendancemonth">This month attedance
      </h3>
    </div>
    <div class="col-md-4 text-center">
      <a href="<?=base_url();?>admin/users/take_attendance" class="btn steps_btn" style="padding-top: 10px !important;margin-bottom: 10px !important;">Take Attendance</a>
    </div>
  </div>
  	<div class="row">
      <div class="col-md-9 order-12 order-md-1">
      <?php 
      date_default_timezone_set('Asia/Kolkata');
      		$year=date("Y");
      $month  = date("m");
      $dateObj   = DateTime::createFromFormat('!m', $month);
      $monthName = $dateObj->format('F');
      ?>
			<div class="card card-default">
				<div class="card-body" id="attendance"><br>
						<div id="attedancereport">
							<?php
							$i=0;
							foreach ($adates as $adate) {
								?>
								<div class="row">
									<div class="col-md-8">
                    <h3 class="text-primary">
                    <a href="<?=base_url();?>admin/users/attendance_details/<?=$adate;?>"><?=$adate;?></a></h3>
									</div>
									<div class="col-md-4">
										<p><span class="badge badge-success"><?=$presents[$i];?> presents</span>
										<span class="badge badge-danger"><?=$absents[$i];?> absents</span></p>
									</div>
								</div><hr>
								<?php
								$i++;
							}
							?>
        		
        	</div>
				</div>
			</div>
		</div>
		   <div class="col-md-3 order-1 order-md-12">
			<div class="card card-default">
				<div class="card-body"><br>
						<div class="date-own" id="datepicker">
								</div>
  <script type="text/javascript">
     
      $(function() {
     $('.date-own').datepicker({
         minViewMode: 1,
         format: 'MM'
       });
       $('#datepicker').on('changeDate', function (ev) {
    var date = $(this).datepicker('getDate'),
            day  = date.getDate(),  
            month = date.getMonth() + 1,              
            year =  date.getFullYear();
            const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"
				];
        $.ajax({
        url: "<?= base_url()?>admin/users/filterattendance",
        data: {month:month,year:year},
        type: "post",
        success: function(data){
        	$('#attendancemonth').html(monthNames[date.getMonth()]+" month attendance")
          $('#attendance').html(data);
      }
    });
});
});
  </script>   
</div>
</div>
</div>
	</div>
</div>
</div>