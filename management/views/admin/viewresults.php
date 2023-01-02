<div class="container">
	<div class="panel">
		<div class="panel-body">
		  <div class="row"><br>
		  	<h4>Student Name:  <?=$student[0]->FirstName.' '.$student[0]->MiddleName.' '.$student[0]->LastName;?></h4>
		  </div><br>
		  <div class="row">
		  	<div class="col-md-3 text-center">
		  		<div class="alert alert-primary row">
		  			<div class="col-6">
		  				<h4><?=count($results)-1;?></h4>
		  				<p>retakes</p>
		  			</div>
		  			<div class="col-6">
		  				<h4><?=$results[0]->Percentage;?> %</h4>
		  				<p>First Attempt</p>
		  			</div>
		  		</div>
		  	</div>
		  </div>
		 
		  <?php 
		  $i=0;
		  foreach ($results as $res) {
		  	if($i==0){
		  		?>
		  		 <h4>First Attempt Score: </h4>
	
		  <br>
		  <br>
		  		<?php
		  	}
		  	else{
		  		?>
		  		 <h4>Retake <?=$i;?> Score: </h4>
	
		  <br>
		  <br>
		  		<?php
		  	}
		  	?>
		  	  <div class="row">
		  	<div class="col-md-3 text-center">
		  		<br>
		  		<h4><?=$res->Percentage;?> %</h4>
		  		<?php 
		  		if($test[0]->PassingPercent>$res->Percentage){
		  			?>
		  			<p class="text-danger">Fail</p>
		  			<?php
		  		}
		  		else{
		  			?>
		  			<p class="test-success">Pass</p>
		  			<?php
		  		}
		  		?>
		  		<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#answerModel_<?=$res->Id;?>">view answer sheet</button>
		  	</div>
		  	<div class="col-md-9">
		  		<br>
		  		<div class="row">
		  			<div class="col-md-2">
		  				<p>Attempted</p>
		  			</div>
		  			<div class="col-md-1">
		  				<p>:</p>
		  			</div>
		  			<div class="col-md-3">
		  				<p><?=$res->Attempted;?></p>
		  			</div>
		  		</div>
		  		<div class="row">
		  			<div class="col-md-2">
		  				<p>Not Attempted</p>
		  			</div>
		  			<div class="col-md-1">
		  				<p>:</p>
		  			</div>
		  			<div class="col-md-3">
		  				<p><?=$res->NotAttempted;?></p>
		  			</div>
		  		</div>
		  		<div class="row">
		  			<div class="col-md-2">
		  				<p>Correct Answered</p>
		  			</div>
		  			<div class="col-md-1">
		  				<p>:</p>
		  			</div>
		  			<div class="col-md-3">
		  				<p><?=$res->RightAnswered;?></p>
		  			</div>
		  		</div>
		  		<div class="row">
		  			<div class="col-md-2">
		  				<p>Wrong Amswered</p>
		  			</div>
		  			<div class="col-md-1">
		  				<p>:</p>
		  			</div>
		  			<div class="col-md-3">
		  				<p><?=$res->WrongAnswered;?></p>
		  			</div>
		  		</div>
		  	</div>
		  </div>
		   <div class="modal" id="answerModel_<?=$res->Id;?>">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <?php 
        $j=0;
        foreach($studans[$i] as $answer)
        {
        	?>
        	<div class="row">
    <div class="col-md-12"><div class="row">
    <div class="col-md-12">
      <p>Q. <?=($j+1);?>) <?=$questions[$j]->Questions;?> <span>(Marks <?=$questions[$j]->Marks;?>)</span></p>
      </div>
      </div>
      <br>
      <ol type="A">
      	<?php 
      $ans=explode(",", $questions[$j]->AnswerId);
      $sans=explode(",", $answer->AnswerId);
      foreach ($options[$j] as $option) {
      	?>
       <li> <?=$option->Options;?></li>
       <?php
      }
      ?>
  	</ol>
  		<p><strong>Student answer:</strong> </p>
  	<?php
  	foreach ($options[$j] as $option) {
  	 	if(in_array($option->Id, $sans)){
  	 		?>
        <p><?=$option->Options;?></p>
        <?php
    	}
    	
      }
      ?>
  	<p><strong>Correct answer:</strong> </p>
  	<?php
  	foreach ($options[$j] as $option) {
  	 	if(in_array($option->Id, $ans)){
  	 		?>
        <p><?=$option->Options;?></p>
        <?php
    	}
    	
      }
      ?>
      <a href="#" data-toggle="collapse" data-target="#col_<?=$questions[$j]->Id;?>">Correct answer&nbsp;<i class="fas fa-chevron-down"></i></a>
<div id="col_<?=$questions[$j]->Id;?>" class="collapse">
  <?php 
     foreach ($options[$j] as $option) {
      if(in_array($option->Id, $ans)){
        ?>
         <p><?=$option->Options;?></p>
        <?php
      }
      }
    ?>
  </div><br>
  <a href="#" data-toggle="collapse" data-target="#aexp_<?=$questions[$j]->Id;?>">Explaination&nbsp;<i class="fas fa-chevron-down"></i></a>
<div id="aexp_<?=$questions[$j]->Id;?>" class="collapse">
  <p><?=$questions[$j]->AnsExplaination;?></p>
  </div>
    </div>
  </div><hr>
        	<?php
        	$j++;
        }
        ?>
      </div>
    </div>
  </div>
</div>
		  	<?php
		  	$i++;
		  }
		  ?>
		</div>
	</div>
</div>