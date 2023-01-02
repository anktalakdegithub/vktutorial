<div class="card">
			  			<div class="card-body">
			  				<div class="row">

                      <div class="col-md-2 col-6">
                        <div class="alert alert-primary">
                         	<b>Total Lectures</b>
                          <h3><?=count($lectures['lectures']);?></h3>
                      	</div>
                      </div>
                      <div class="col-md-2 col-6">
                        <div class="alert alert-success">
                          <b>Total Presents</b>
                          <h3><?=count($lectures['lectures'])-count($lectures['attendance']);?></h3>
                        </div>
                      </div>
                      <div class="col-md-2 col-6">
                        <div class="alert alert-danger">
                          <b>Total Absents</b>
                          <h3><?=count($lectures['attendance']);?></h3>
                      </div>
                    </div>
                    </div><br>
                    <?php
                    $i=0;
                    foreach ($lectures['lectures'] as $lect) {
                    	?>
                    	<div class="row">
                    		<div class="col-md-8">
                    			<h4><?=$lect->Title;?></h4>
                    			<p>Batches:
                    			<?php 
                    			foreach ($lectures['batches'][$i] as $batch) {
                    				?>
                    				<?=$batch->Name;?>,
                    				<?php
                    			}
                    			?>
								&nbsp;&nbsp;<i class="fas fa-calendar"></i>&nbsp;<?=$lect->Lecture_date;?></p>
                    		</div>
                    		<div class="col-md-4">
                    			<p>
                    			<?php
                    			if(in_array($lect->Id, $lectures['attendance'])){
                    				?>
                    				<span class="btn btn-danger" style="font-size: 10px;padding: .25rem .25rem;">absent</span>
                    				<?php
                    			}
                    			else{
                    				?>
                    				<span class="btn btn-success" style="font-size: 10px;padding: .25rem .25rem;">present</span>
                    				<?php
                    			}
                    			?>
                    		</p>
                    		</div>
                    	</div><hr>
                    	<?php
                    	$i++;
                    }
                    ?>

                </div>
            </div>