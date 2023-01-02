<div class="sa4d25">
	<div class="container">			
		<div class="row">
			<div class="col-md-10">	
				<h2 class="st_title"><i class="uil uil-analysis"></i>Lectures</h2><br>
			</div>					
		</div>	
		<div class="card">
			<div class="card-body">
				<?php 
				$i=0;
				foreach ($lectures as $lect) {
					date_default_timezone_set('Asia/Kolkata');
					$time=date("H:i:sa");	
					$date=date("Y-m-d");
					?>
					<div class="row">
						<div class="col-9">
							<h4><?=$lect->Title;?></h4>
							<p><span><i class="fas fa-clock"></i> <?=$lect->Lecture_date;?> &nbsp;&nbsp;<?=date('h:i A',strtotime($lect->Start_time));?> - <?=date('h:i A',strtotime($lect->End_time));?></span> &nbsp;&nbsp;<span><i class="fas fa-user"></i> &nbsp;
								<?php
								foreach ($faculties[$i] as $faculty) {
									if(count($faculty)>0){
									?>
									<?=$faculty[0]->FirstName.' '. $faculty[0]->LastName;?>,
									<?php
								}
								}
								?>
							</span></p>
							<p>Batches: 
							<?php
								foreach ($batches[$i] as $batch) {
									?>
									<?=$batch[0]->Name;?>,
									<?php
								}
								?>
									
								</p>
						</div>
						<div class="col-3">
							<br>
							<?php 
							if($date<=$lect->Lecture_date && $time<$lect->End_time){
							?>
							<a href="<?=$lect->Meeting_url;?>" target="_blank" class="btn btn-outline-success">join</a >
							<?php 
							}
							?>
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