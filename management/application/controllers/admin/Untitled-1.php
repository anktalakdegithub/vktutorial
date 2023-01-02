$output.='<div class="modal" id="editexamModal_'.$exam->exam_id.'">
<div class="modal-dialog modal-lg">
	<div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title">Edit Exam</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
		 </div>

	   <!-- Modal body -->
	   <div class="modal-body">
			<div class="row justify-content-md-center">
				<div class="col-12">
					
					<div class="ui search focus mt-30 lbel25">
						<label>Exam Title</label>
						<div class="ui left icon input swdh19">
							<input class="prompt srch_explore" type="text" id="etitle" value="'.$exam->Title.'">	
						</div>
					</div>
					<div class="ui search focus mt-30 lbel25">
						<label>Select course</label>
						<div class="ui left icon input swdh19">
							<select class="form-control"  id="course_id">
								<option value="'.$exam->course_name.'">'.$exam->course_name.'</option>
								<?php 
					foreach($courses as $course){
				?>
					 <option value="'.$course->Id.'">'.$course->Title.'</option> 
				<?php
					}
					?>	
							</select>							
						</div>
					</div>	
					<div class="ui search focus mt-30 lbel25">
						<label>Select subject</label>
						<div class="ui left icon input swdh19">
							<select class="form-control" id="subjects">
								<option value="'.$exam->subject.'">'.$exam->subject.'</option>
									
							</select>							
						</div>
					</div>
					<div class="ui search focus mt-30 lbel25">
						<label>Select Topic</label>
						<div class="ui left icon input swdh19">
							<select class="form-control" id="topics">
								<option value="'.$exam->Title.'">'.$exam->Title.'</option>
									
							</select>							
						</div>
					</div>
					<div class="ui search focus mt-30 lbel25">
						<label>Select Batch</label>
						<div class="ui left icon input swdh19">
							<select class="form-control w_branch"  id="batch_id">
								<option value="'.$exam->batch_name.'">'.$exam->batch_name.'</option>
																	
							</select>							
						</div>
					</div>
					<div class="ui search focus mt-30 lbel25">
						<label>Exam Type</label>
						<div class="ui left icon input swdh19">
							<select class="form-control" id="exam_type">
								<option value="oral">oral</option>
								<option value="written">written</option>
							</select>
						</div>
					</div>
					<div class="ui search focus mt-30 lbel25">
						<label>Exam Date</label>
						<div class="ui left icon input swdh19">
							<input type="date" class="form-control" id="edate" name="" value="'.$exam->exam_date.'">								
						</div>
					</div>
					<div class="ui search focus mt-30 lbel25">
						<label>Start Time</label>
						<div class="ui left icon input swdh19">
							<input type="time" class="form-control" id="stime" name="" value="'.$exam->start_time.'">
						</div>
					</div>
					<div class="ui search focus mt-30 lbel25">
						<label>End Time</label>
						<div class="ui left icon input swdh19">
							<input type="time" class="form-control" id="etime" name="" value="'.$exam->end_time.'">
						</div>
					</div>
					<div class="ui search focus mt-30 lbel25">
						<label>Total Marks</label>
						<div class="ui left icon input swdh19">
							<input type="text" class="form-control" id="tmarks" value="'.$exam->total_marks.'" placeholder="Total Marks" name="">
						</div>
					</div>
					<div class="ui search focus mt-30 lbel25">
						<label>Passing Marks</label>
						<div class="ui left icon input swdh19">
							<input type="text" class="form-control" id="pmark" value="'.$exam->passing_marks.'" placeholder="Passing Marks" name="">
						</div>
					</div>
						<br>
						<div id="msg"></div>
					<button data-direction="next" class="steps_btn" id="submit">Add</button>
				</div>		
			</div>
		</div>
	</div>
  </div>
</div>';