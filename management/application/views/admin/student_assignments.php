<div class="card">
			  			<div class="card-body">
			  				<div class="row">

                      <div class="col-md-2 col-6">
                        <div class="alert alert-primary">
                         	<b>Total Assignments</b>
                          <h3><?=count($assignments['assignments']);?></h3>
                      	</div>
                      </div>
                      <div class="col-md-2 col-6">
                        <div class="alert alert-success">
                          <b>Total Submitted</b>
                          <h3><?=count($assignments['submissions']);?></h3>
                        </div>
                      </div>
                      <div class="col-md-2 col-6">
                        <div class="alert alert-danger">
                          <b>Total Not Submitted</b>
                          <h3><?=count($assignments['assignments'])-count($assignments['submissions']);?></h3>
                      </div>
                    </div>
                    </div><br>
                    <?php
                    $i=0;
                    foreach ($assignments['assignments'] as $assign) {
                    	?>
                    	<div class="row">
                    		<div class="col-md-8">
                    			<h4><?=$assign->AssignmentName;?></h4>
                    			<p>Batches:
                    			<?php 
                    			foreach ($assignments['batches'][$i] as $batch) {
                    				?>
                    				<?=$batch->Name;?>,
                    				<?php
                    			}
                    			?>
								&nbsp;&nbsp;<i class="fas fa-calendar"></i>&nbsp;<?=$assign->SubmissionDate;?></p>
                    		</div>
                    		<div class="col-md-4">
                    			<p>
                    			<?php
                    			if(!in_array($assign->Id, $assignments['submissions'])){
                    				?>
                    				<span class="btn btn-danger" style="font-size: 10px;padding: .25rem .25rem;">not submitted</span>
                    				<?php
                    			}
                    			else{
                    				?>
                    				<span class="btn btn-success" style="font-size: 10px;padding: .25rem .25rem;">submitted</span>
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