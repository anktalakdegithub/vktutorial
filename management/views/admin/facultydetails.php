<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-1">
							<img src="https://acceronclass.classblue.in/public/assets/images/student.png" style="width:100%;">
						</div>
						<div class="col-md-9">
							<h4><?=$faculty[0]->FirstName.' '.$faculty[0]->LastName;?></h4>
							<p><span><i class="fas fa-phone-alt"></i>&nbsp;<?=$faculty[0]->Phone;?></span>&nbsp;&nbsp;<span><i class="fas fa-envelope"></i>&nbsp;<?=$faculty[0]->Email;?></span></p>
						</div>
					</div>
				</div>
			</div>
			<style type="text/css">
				.nav-link.active{
					font-size: 14px !important;
				    font-weight: 500 !important;
				    font-family: 'Roboto', sans-serif !important;
				    color: #fff !important;
				    background: #ed2a26 !important;
				    border-radius: 25px !important;
				    border: 0 !important;
				    height: 40px !important;
				    padding-top: 10px;
				}
			</style><br>
			<ul class="nav nav-pills">
				<li class="nav-item">
			    <a class="nav-link active" data-toggle="pill" href="#lectures">Lectures</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" data-toggle="pill" href="#salaries">Salaries</a>
			  </li>
			</ul>
			<br>
			<div class="tab-content">
				<div class="tab-pane active" id="lectures">
					<div class="row">
	                <div class="col-md-2 col-6">
	                  <div class="alert alert-primary text-center">
	                    <h3 id="tplecturest"><?=count($lectures['lectures']);?></h3>
	                    <p>Total Lecture <br>(This Month)</p>
	                  </div>
	                 </div>
	             </div>
					<div class="card">
						<div class="card-body">
							<?php 
				$i=0;
				foreach ($lectures['lectures'] as $lect) {
					date_default_timezone_set('Asia/Kolkata');
					$date=date("h:i:sa");	
					?>
					<div class="row">
						<div class="col-12">
							<h4><?=$lect->Title;?></h4>
							<p><span><i class="fas fa-clock"></i> <?=$lect->Lecture_date;?> &nbsp;&nbsp;<?=date('h:s A',strtotime($lect->Start_time));?> - <?=date('h:s A',strtotime($lect->End_time));?></span></p>
							<p>Batches: 
							<?php
								foreach ($lectures['batches'][$i] as $batch) {
									if(count($batch)>0){
									?>
									<?=$batch[0]->Name;?>,
									<?php
										
									}
								}
								?>
									
								</p>
						</div>
					</div>	
					<hr>
					<?php
					$i++;
				}
				?>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="salaries">
					<div class="card">
						<div class="card-body">
							<?php 
				$i=0;
				foreach ($salaries as $sal) {
					date_default_timezone_set('Asia/Kolkata');
					$date=date("h:i:sa");	
					?>
					<div class="row">
						<div class="col-12">
							<h4><?=$sal->Salary;?>/- &#x20B9; </h4>
							<p><span><i class="fas fa-clock"></i>Salary Date: <?=$sal->SalaryDate;?> &nbsp;&nbsp;Total Lectures: <?=$sal->TotalLecture;?></span></p>
						</div>
					</div>	
					<hr>
					<?php
					$i++;
				}
				?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>