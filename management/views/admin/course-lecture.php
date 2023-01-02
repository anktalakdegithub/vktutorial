<style type="text/css">
    .modal-content {
  position: relative;
  background-color: #fff;
  -webkit-background-clip: padding-box;
  background-clip: padding-box;
  border: 0;
  border: 0;
  border-radius: 0;
  outline: 0;
  max-height: 700px;
  overflow: scroll;
}
</style>
<script type="text/javascript">
    function initialize() {
        tinymce.init({
            selector: ".desc",
            theme: "modern",
            paste_data_images: true,
            menubar: 'edit insert format table tools',
            plugins: [
              "advlist autolink lists link image charmap print preview hr anchor pagebreak",
              "searchreplace wordcount visualblocks visualchars code fullscreen",
              "insertdatetime media nonbreaking save table contextmenu directionality",
              "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            toolbar2: "print preview media | forecolor backcolor emoticons | fontselect fontsizeselect",
            image_advtab: true,
            file_picker_callback: function(cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.onchange = function() {
                    var file = this.files[0];
                    var reader = new FileReader();
                    reader.onload = function () {
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);
                        // call the callback and populate the Title field with the file name
                        cb(blobInfo.blobUri(), { title: file.name });
                    };
                    reader.readAsDataURL(file);
                };
                input.click();
            },
            templates: [{
                title: 'Test template 1',
                content: 'Test 1'
            }, {
                title: 'Test template 2',
                content: 'Test 2'
            }]
        });
    }
</script>
<style type="text/css">
    /*
*
* ==========================================
* CUSTOM UTIL CLASSES
* ==========================================
*/
.nav-pills-custom .nav-link {
    color: #aaa;
    background: #fff;
    position: relative;
}

.nav-pills-custom .nav-link.active {
    color: #28a744;
    background: #fff;
}


/* Add indicator arrow for the active tab */
@media (min-width: 992px) {
    .nav-pills-custom .nav-link::before {
        content: '';
        display: block;
        border-top: 8px solid transparent;
        border-left: 10px solid #fff;
        border-bottom: 8px solid transparent;
        position: absolute;
        top: 50%;
        right: -10px;
        transform: translateY(-50%);
        opacity: 0;
    }
}

.nav-pills-custom .nav-link.active::before {
    opacity: 1;
}





/*
*
* ==========================================
* FOR DEMO PURPOSE
* ==========================================
*/
body {
    min-height: 100vh;
    background: linear-gradient(to left, #dce35b, #45b649);
}
#utopictitle{
    display: none;
}
#sbtns{
    display: none;
}
</style>
<div class="row" style="background-color: #fff;margin-top: -32px;padding-top: 20px;">

<?php 
// print_r($topic[0]);
// print_r($batches);
 ?>
    <div class="col-md-6">
         <a href="<?=base_url();?>admin/course/coursedetail/curriculum/<?=$topic[0]->CourseId;?>" class="title" style="display: inline-block;"><i class="fas fa-arrow-left"></i></a>&nbsp;&nbsp;
         <h4 id="sectiontitle" style="display: inline-block;"><span id="sectiontext"><?=$topic[0]->Topic;?></span>&nbsp;&nbsp;<button class="btn btn-default text-success" id="esection" style="font-size: 20px;"><i class="fas fa-edit"></i></button></h4>
        <input type="text" class="form-control" value="<?=$topic[0]->Topic;?>" id="utopictitle" style="width: 100%;" style="display: inline-block;">
    </div>
    <div class="col-md-2">
        <div id="sbtns">
            <button class="btn btn-default text-success" id="utopic" style="font-size: 20px;" value="<?=$topic[0]->Id;?>"><i class="fas fa-check-circle"></i></button>
            <button class="btn btn-default" id="csection" style="font-size: 20px;"><i class="fas fa-times-circle"></i></button>
        </div>
    </div>
    <div class="col-md-4 text-right">
        
      <!--   <?php 
        if ($topic[0]->IsAccessible>0) {
            ?>
            <button class="btn steps_btn" data-toggle="modal" data-target="#disablepreviewModal">Disable Preview</button>
            <?php
        }
        else{
            ?>
            <button class="btn steps_btn" data-toggle="modal" data-target="#previewModal">Enable Free Preview</button>
            <?php
        }
        ?> -->
    </div>
    <div class="modal" id="previewModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <h5 class="modal-title" id="previewModal">Are you sure you want to allow free preview?</h5><br>
                    <div id="spmsg"></div>
                <button class="btn steps_btn" id="allowpreview" value="<?=$topic[0]->Id;?>">Yes</button>
                <button class="btn btn-default" data-dismiss="modal">No</button>
              </div>
            </div>
        </div>
    </div>
    <div class="modal" id="disablepreviewModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <h5 class="modal-title" id="disablepreviewModal">Are you sure you want to disable free preview?</h5><br>
                    <div id="spmsg"></div>
                <button class="btn steps_btn" id="disablepreview" value="<?=$topic[0]->Id;?>">Yes</button>
                <button class="btn btn-default" data-dismiss="modal">No</button>
              </div>
            </div>
        </div>
    </div>
</div>
<!-- Demo header-->
<section class="py-5 header">
    <div class="container py-4">
        <div class="row">
            <div class="col-md-3">
                <!-- Tabs nav -->
                <div class="nav flex-column nav-pills nav-pills-custom" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link mb-3 p-3 shadow active" id="video-tab" data-toggle="pill" href="#video" role="tab" aria-controls="video" aria-selected="true">
                        <span class="font-weight-bold small text-uppercase">Add Lecture</span></a>
                    <a class="nav-link mb-3 p-3 shadow" id="ppt-tab" data-toggle="pill" href="#ppt" role="tab" aria-controls="ppt" aria-selected="false">
                        <span class="font-weight-bold small text-uppercase">Add Worksheet</span>
                    </a>
                    <a class="nav-link mb-3 p-3 shadow" id="test-tab" data-toggle="pill" href="#assignment" role="tab" aria-controls="test" aria-selected="false">
                        <span class="font-weight-bold small text-uppercase">Add Assignment</span>
                    </a>
                    <a class="nav-link mb-3 p-3 shadow" id="study-tab" data-toggle="pill" href="#study" role="tab" aria-controls="study" aria-selected="false">
                        <span class="font-weight-bold small text-uppercase">Add Question Writing</span>
                    </a>
                    <a class="nav-link mb-3 p-3 shadow" id="live-tab" data-toggle="pill" href="#test" role="tab" aria-controls="live" aria-selected="false">
                        <span class="font-weight-bold small text-uppercase">Add Exam</span>
                    </a>
                  <!--  <a class="nav-link mb-3 p-3 shadow" id="lquestions-tab" data-toggle="pill" href="#lquestions" role="tab" aria-controls="lquestions" aria-selected="false">
                        <span class="font-weight-bold small text-uppercase">Add Last Year Questions</span></a>

                    <a class="nav-link mb-3 p-3 shadow" id="forum-tab" data-toggle="pill" href="#forum" role="tab" aria-controls="forum" aria-selected="false">
                        <span class="font-weight-bold small text-uppercase">Add Question</span>
                    </a> -->
                </div>
            </div>


            <div class="col-md-9">
                <!-- Tabs content -->
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane show active" id="video" role="tabpanel" aria-labelledby="video-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Lectures:</h3>
                            </div>
                            <div class="col-md-6 text-right">
                                <button class="btn steps_btn" type="button" data-toggle="collapse" data-target="#collapseVideo" aria-expanded="false" aria-controls="collapseVideo">Add Lecture</button>
                            </div>
                        </div>  
                        <div class="collapse" id="collapseVideo"><br>
                            <div class="card shadow rounded bg-white">
                                <div class="card-body">
                                    <div class="ui search focus lbel25">
                                        <label>Lecture Title</label>
                                        <div class="ui left icon input swdh19">
                                        <input class="prompt srch_explore" type="text" placeholder="Enter title" id="ltitle">
                                      </div>
                                    </div>
                                    <div class="ui search focus mt-30 lbel25">
                                        <label>Batch</label>
                                        <div class="ui left icon input swdh19">
                                            <select class="custom-select form-control prompt srch_explore" id="batch_id">
                                                <option selected>Choose...</option>
                                                <?php
                                                foreach($batches as $btc){
                                                ?>
                                                <option value="<?=$btc->Id;?>"><?=$btc->Name?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="ui search focus mt-30 lbel25">
                                        <label>Teachers</label>
                                        <div class="ui left icon input swdh19">
                                            <select class="custom-select form-control prompt srch_explore" id="teacher_id">
                                                <option selected>Choose...</option>
                                                <?php
                                                foreach($teachers as $teach){
                                                ?>
                                                    <option value="<?=$teach->Id?>"><?=$teach->FirstName?> <?=$teach->LastName?></option>
                                                <?php
                                                }
                                                ?>
                                                <!-- <option value="3">Three</option> -->
                                            </select>
                                        </div>
                                    </div>
                                  <!--   <div class="ui search focus mt-30 lbel25">
                                        <label>Course</label>
                                        <div class="ui left icon input swdh19">
                                        <input type="text" class="prompt srch_explore" value="<?=$topic[0]->CourseId;?>" name="course_id" id="course_id"  readonly/>
                                      </div>
                                    </div>
                                    <div class="ui search focus mt-30 lbel25">
                                        <label>Subject</label>
                                        <div class="ui left icon input swdh19">
                                        <input type="text" data-plugin="dropify" data-default-file="" value="<?=$topic[0]->SectionId;?>" class="prompt srch_explore" name="subject_id" id="subject_id" readonly />
                                      </div>
                                    </div>
                                    <div class="ui search focus mt-30 lbel25">
                                        <label>Topics</label>
                                        <div class="ui left icon input swdh19">
                                        <input type="text" data-plugin="dropify" data-default-file="" value="<?=$topic[0]->Id;?>" class="prompt srch_explore" name="topic_id" id="topic_id" readonly/>
                                      </div>
                                    </div>
 -->
                                    <div class="ui search focus mt-30 lbel25">
                                        <label>Lacture Date</label>
                                        <div class="ui left icon input swdh19">
                                        <input type="date" data-plugin="dropify" data-default-file="" class="prompt srch_explore" name="lecture_date" id="lecture_date"  />
                                      </div>
                                    </div>
                                    <div class="ui search focus mt-30 lbel25">
                                        <label>Start Time</label>
                                        <div class="ui left icon input swdh19">
                                        <input type="time" data-plugin="dropify" data-default-file="" class="prompt srch_explore" name="start_time" id="start_time" />
                                      </div>
                                    </div>
                                    <div class="ui search focus mt-30 lbel25">
                                        <label>End Time</label>
                                        <div class="ui left icon input swdh19">
                                        <input type="time" data-plugin="dropify" data-default-file="" class="prompt srch_explore" name="end_time" id="end_time" />
                                      </div>
                                    </div>
                                    <div class="ui search focus mt-30 lbel25">
                                        <label>Note</label>
                                        <div class="ui left icon input swdh19">
                                        <input type="text" data-plugin="dropify" data-default-file="" class="prompt srch_explore" name="note" id="note" />
                                      </div>
                                    </div>
                                    <br>
                                    <div id="vmsg"></div>
                                    <button type="button" class="steps_btn" id="addlecture" value="<?=$topic[0]->Id;?>">Add</button>
                                </div>
                            </div>
                        </div>
                        <br>
                        <?php 
                        if(count($lecture)>0){
                            foreach ($lecture as $ppt) {

                            ?>
                                <div class="row" id="pptbody">
                                    <div class="col-md-12">
                                        <div class="card shadow rounded bg-white">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                       <a href="<?=base_url();?>admin/course/lecture_attendance?lecture_id=<?=$ppt->lecture_id;?>"> <h4 class="card-title"> <?=$ppt->lecture_title;?></h4></a>
                                                        <!-- <p><?=$ppt->lecture_title;?></p> -->
                                                    </div>
                                                    <div class="col-md-4 text-right">
                                                        <p><button class="btn btn-default" value="<?=$ppt->lecture_id;?>" data-toggle="modal" data-target="#editlecModal_<?=$ppt->lecture_id;?>"><i class="fas fa-edit"></i></button><button class="btn btn-default" data-toggle="modal" data-target="#deletelacModal_<?=$ppt->lecture_id;?>"><i class="fas fa-trash"></i></button></p>

                                                    </div>
                                                    <div class="col-md-8">
                                                        <!-- <h4 class="card-title"><?=$ppt->lecture_title;?> </h4> -->
                                                        <p><i class="fas fa-chalkboard-teacher"></i> &nbsp;&nbsp; <?=$ppt->FirstName.' '.$ppt->LastName;?> &nbsp;&nbsp;<i class='fas fa-clock'></i> &nbsp;&nbsp;<?=date("d-M-Y", strtotime($ppt->lecture_date)); ?> <?=date('h:i A', strtotime($ppt->start_time));?> - <?=date('h:i A', strtotime($ppt->end_time));?><!-- &nbsp;&nbsp; <a href="<?=base_url();?>admin/Attendance/lacture_attendance?lecture_id=<?=$ppt->lecture_id;?>" style="text-decoration: underline;"> View Attendance</a> --></p>
                                                    </div>
                                                    <div class="col-md-4 text-right">
                                                        <p>
                                                            <?php
                                                            if($ppt->is_publish == 0){
                                                            ?>
                                                              <button class="btn btn-info" data-toggle="modal" data-target="#publislacModal_<?=$ppt->lecture_id;?>"> Publish</button></p>

                                                            <?php
                                                            }else{
                                                            ?>
                                                              <button class="btn btn-danger" data-toggle="modal" data-target="#unpublislacModal_<?=$ppt->lecture_id;?>">UnPublish</button></p>

                                                            <?php
                                                            }
                                                            ?>
                                                          
                                                    </div>
                                                   
                                                </div>
                                                <!-- <p><?=strip_tags($ppt->Description);?></p> -->
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="modal" id="editlecModal_<?=$ppt->lecture_id;?>">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-body">
                                        <h5 class="modal-title" id="editpptModal">Edit Lecture</h5><br>
                                            <div class="ui search focus lbel25">
                                                <label>Lecture Title</label>
                                                <div class="ui left icon input swdh19">
                                                <textarea class="form-control" id="uctitle_<?=$ppt->lecture_id;?>"><?=$ppt->lecture_title;?></textarea>
                                              </div>
                                            </div>
                                            <div class="ui search focus mt-30 lbel25">
                                        <label>Batch</label>
                                        <div class="ui left icon input swdh19">
                                            <select class="custom-select form-control prompt srch_explore" id="ubatch_id_<?=$ppt->lecture_id;?>">
                                                <option selected>Choose...</option>
                                                <?php
                                                foreach($batches as $btc){
                                                ?>
                                                    <option value="<?=$btc->Id?>"  <?php if($btc->Id==$ppt->batch_id){ echo "selected"; }?>><?=$btc->Name?></option>
                                                <?php
                                                }
                                                ?>
                                                <!-- <option value="1">Present</option>
                                                <option value="2">Absent</option> -->
                                                <!-- <option value="3">Three</option> -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="ui search focus mt-30 lbel25">
                                        <label>Teachers</label>
                                        <div class="ui left icon input swdh19">
                                            <select class="custom-select form-control prompt srch_explore" id="uteacher_id_<?=$ppt->lecture_id;?>">
                                                <option selected>Choose...</option>
                                                <?php
                                                foreach($teachers as $teach){
                                                ?>
                                                    <option value="<?=$teach->Id?>"  <?php if($teach->Id==$ppt->teacher_id){ echo "selected"; }?>><?=$teach->FirstName?> <?=$teach->LastName?></option>
                                                <?php
                                                }
                                                ?>
                                                <!-- <option value="3">Three</option> -->
                                            </select>
                                        </div>
                                    </div>
                                 <!--    <div class="ui search focus mt-30 lbel25">
                                        <label>Course</label>
                                        <div class="ui left icon input swdh19">
                                            <input type="text" class="prompt srch_explore" value="<?=$topic[0]->CourseId;?>" name="uploadthumbnail"  readonly/>
                                        </div>
                                    </div>
                                    <div class="ui search focus mt-30 lbel25">
                                        <label>Subject</label>
                                        <div class="ui left icon input swdh19">
                                            <input type="text" data-plugin="dropify" data-default-file="" value="<?=$topic[0]->SectionId;?>" class="prompt srch_explore" name="" readonly />
                                        </div>
                                    </div>
                                    <div class="ui search focus mt-30 lbel25">
                                        <label>Topics</label>
                                        <div class="ui left icon input swdh19">
                                            <input type="text" data-plugin="dropify" data-default-file="" value="<?=$topic[0]->Id;?>" class="prompt srch_explore" name="" readonly/>
                                        </div>
                                    </div> -->

                                    <div class="ui search focus mt-30 lbel25">
                                        <label>Lacture Date</label>
                                        <div class="ui left icon input swdh19">
                                            <input type="date" data-plugin="dropify" id="ulecture_date_<?=$ppt->lecture_id;?>" data-default-file="" value="<?=$ppt->lecture_date;?>" class="prompt srch_explore" name="" />
                                        </div>
                                    </div>
                                    <div class="ui search focus mt-30 lbel25">
                                        <label>Start Time</label>
                                        <div class="ui left icon input swdh19">
                                            <input type="time" data-plugin="dropify" id="ustart_time_<?=$ppt->lecture_id;?>"  data-default-file=""  value="<?=$ppt->start_time;?>" class="prompt srch_explore" name="" />
                                        </div>
                                    </div>
                                    <div class="ui search focus mt-30 lbel25">
                                        <label>End Time</label>
                                        <div class="ui left icon input swdh19">
                                            <input type="time" data-plugin="dropify" id="uend_time_<?=$ppt->lecture_id;?>" data-default-file=""  value="<?=$ppt->end_time;?>" class="prompt srch_explore" name="" />
                                        </div>
                                    </div>
                                    <div class="ui search focus mt-30 lbel25">
                                        <label>Note</label>
                                        <div class="ui left icon input swdh19">
                                        <input type="text" data-plugin="dropify" data-default-file="" class="prompt srch_explore" name="note" id="unote_<?=$ppt->lecture_id;?>"   value="<?=$ppt->note;?>" />
                                      </div>
                                    </div>
                                            <br>
                                            <div id="cmsg"></div>
                                        <button class="updatelac btn steps_btn" id="" value="<?=$ppt->lecture_id;?>">Save</button>
                                        <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal" id="deletelacModal_<?=$ppt->lecture_id;?>">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-body">
                                        <h5 class="modal-title">Are you sure you want to delete this?</h5><br>
                                        <button class="deletelac btn steps_btn" id="" value="<?=$ppt->lecture_id;?>">Yes</button>
                                        <button class="btn btn-default" data-dismiss="modal">No</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal" id="publislacModal_<?=$ppt->lecture_id;?>">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-body">
                                        <h5 class="modal-title">Are you sure you want to publis this?</h5><br>
                                        <button class="publishlac btn steps_btn" id="" value="<?=$ppt->lecture_id;?>">Yes</button>
                                        <button class="btn btn-default" data-dismiss="modal">No</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal" id="unpublislacModal_<?=$ppt->lecture_id;?>">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-body">
                                        <h5 class="modal-title">Are you sure you want to unpublish this?</h5><br>
                                        <button class="unpublishlac btn steps_btn" id="" value="<?=$ppt->lecture_id;?>">Yes</button>
                                        <button class="btn btn-default" data-dismiss="modal">No</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <div class="modal" id="viewlacModal_<?=$ppt->lecture_id;?>">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-body">
                                      <!-- <table class="table">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">student_name</th>
                                                    <th scope="col">attendance_date</th>
                                                    <th scope="col">in_time</th>
                                                    <th scope="col">out_time</th>
                                                    <th scope="col">present/absent</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $i = 0;
                                                foreach($students as $stu){
                                                    // echo '<pre>';
                                                    // print_r(json_encode($stu,true));
                                                    $stu = json_encode($stu);
                                                    $stu = json_decode($stu,true);
                                                    // print_r($stu['FirstName']);
                                                    // echo  $stu['FirstName'];
                                                ?>
                                                <tr>
                                                    <th scope="row"><?php echo ++$i; ?></th>
                                                    <td><?php echo $stu['FirstName'].' '.$stu['MiddleName'].' '.$stu['LastName'] ; ?></td>
                                                    <td><?php  echo date('d-m-Y') ; ?></td>
                                                    <td><?php //echo $stu['FirstName'].' '.$stu['MiddleName'].' '.$stu['LastName'] ; ?></td>
                                                    <td><?php //echo $stu['FirstName'].' '.$stu['MiddleName'].' '.$stu['LastName'] ; ?></td>
                                                    <td><?php 
                                                        // if(){
                                                        //     ?>
                                                            <span class="badge badge-pill badge-success">Present</span>
                                                            <?php
                                                        // }else{
                                                        //     ?>
                                                            <span class="badge badge-pill badge-danger">Absent</span>
                                                            <?php
                                                        // }
                                                        // echo $stu['FirstName'].' '.$stu['MiddleName'].' '.$stu['LastName'] ; 
                                                        ?></td>
                                                </tr>
                                                <?php
                                                }
                                                ?>
                                                
                                                
                                            </tbody>
                                        </table> -->
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            <?php
                                }
                            }
                        ?>
                    </div>
                    <div class="tab-pane" id="ppt" role="tabpanel" aria-labelledby="ppt-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>WorkSheet:</h3>
                            </div>
                            <div class="col-md-6 text-right">
                                <button class="btn steps_btn" type="button" data-toggle="collapse" data-target="#collapseppt" aria-expanded="false" aria-controls="collapseppt">Add Worksheet</button>
                            </div>
                        </div>  
                        <div class="collapse" id="collapseppt"><br>
                            <div class="card shadow rounded bg-white">
                                <div class="card-body">
                                    <div class="ui search focus lbel25">
                                        <label>Worksheet Title</label>
                                        <div class="ui left icon input swdh19">
                                            <textarea class="form-control" id="wstitle" name="wstitle"></textarea>
                                        </div>
                                    </div>
                                    <div class="ui search focus mt-30 lbel25">
                                        <label>Select Batch</label>
                                        <div class="ui left icon input swdh19">
                                            <select class="custom-select form-control w_branch prompt srch_explore" id="wbranch_id">
                                                <!-- <option selected>Choose...</option> -->
                                                <option selected>Choose...</option>
                                                <?php
                                                foreach($batches as $btc){
                                                ?>
                                                <option value="<?=$btc->Id?>"><?=$btc->Name?></option>
                                                <?php
                                                }
                                                ?>
                                                <!-- <option value="3">Three</option> -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="ui search focus mt-30 lbel25">
                                        <label>Select Lecture</label>
                                        <div class="ui left icon input swdh19">
                                            <select class="custom-select form-control lec_id prompt srch_explore" id="lect_id">
                                                <!-- <option selected>Choose...</option> -->
                                                <option selected>Choose...</option>
                                            
                                                <!-- <option value="lect1">lect1 </option> -->
                                                <!-- <option value="lect2">lect2 </option> -->
                                                
                                                <!-- <option value="3">Three</option> -->
                                            </select>
                                        </div>
                                    </div>
                                  <!--   <div class="ui search focus mt-30 lbel25">
                                        <label>Course</label>
                                        <div class="ui left icon input swdh19">
                                        <input type="text" class="prompt srch_explore" value="<?=$topic[0]->CourseId;?>" name="course_id"  readonly/>
                                      </div>
                                    </div>
                                    <div class="ui search focus mt-30 lbel25">
                                        <label>Subject</label>
                                        <div class="ui left icon input swdh19">
                                        <input type="text" data-plugin="dropify" data-default-file="" value="<?=$topic[0]->SectionId;?>" class="prompt srch_explore" name="subject_id" readonly />
                                      </div>
                                    </div>
                                    <div class="ui search focus mt-30 lbel25">
                                        <label>Topics</label>
                                        <div class="ui left icon input swdh19">
                                        <input type="text" data-plugin="dropify" data-default-file="" value="<?=$topic[0]->Id;?>" class="prompt srch_explore" name="topic_id" readonly/>
                                      </div>
                                    </div> -->
                                    <div class="ui search focus mt-30 lbel25">
                                        <label>Submission Date</label>
                                        <div class="ui left icon input swdh19">
                                        <input type="date" data-plugin="dropify" data-default-file="" class="prompt srch_explore" id="sub_date" name="submission_date" />
                                      </div>
                                    </div>
                                    <div class="ui search focus lbel25 mt-3">
                                        <label>worksheet_document</label>
                                        <div class="ui left icon input swdh19">
                                        <input class="prompt srch_explore" type="file" placeholder="Enter title" name="work_doc" id="work_doc" accept="application/pdf">
                                      </div>
                                    </div>
                                    <br>
                                    <div id="ccmsg"></div>
                                    <button type="button" class="steps_btn" id="addworksheet" value="<?=$topic[0]->Id;?>">Add</button>
                                </div>
                            </div>
                        </div>
                        <br>
                        <?php 
                        if(count($worksheet)>0){
                            foreach ($worksheet as $ppt) {
                            ?>
                                <div class="row" id="pptbody">
                                    <div class="col-md-12">
                                        <div class="card shadow rounded bg-white">
                                            <div class="card-body">
                                                <div class="row">

                                                    <div class="col-md-8">
                                                    <a  href="<?=base_url();?>admin/course/worksheet_submit?worksheet_id=<?=$ppt->worksheet_id;?>&batch_id=<?=$ppt->batch_id;?>"> <h4 class="card-title"> <?=$ppt->worksheet_title;?></h4></a>
                                                        <!-- <p><?=$ppt->lecture_title;?></p> -->
                                                    </div>
                                                    <div class="col-md-4 text-right">
                                                        <p><button class="btn btn-default" value="<?=$ppt->worksheet_id;?>" data-toggle="modal" data-target="#editpptModal_<?=$ppt->worksheet_id;?>"><i class="fas fa-edit"></i></button><button class="btn btn-default" data-toggle="modal" data-target="#deletepptModal_<?=$ppt->worksheet_id;?>"><i class="fas fa-trash"></i></button></p>

                                                    </div>
                                                    <div class="col-md-8">
                                                        <!-- <h4 class="card-title"><?=$ppt->lecture_title;?> </h4> -->
                                                        <p><a href="<?=$ppt->worksheet_document;?>" download><i class="fas fa-file-download"></i> Document</a> &nbsp;&nbsp;<i class='fas fa-clock'></i> &nbsp;&nbsp;<?=date("d-M-Y", strtotime($ppt->submission_date)); ?>&nbsp;&nbsp; </p>
                                                    </div>
                                                    <div class="col-md-4 text-right">
                                                        <p>
                                                            <?php
                                                            if($ppt->is_publish == 0){
                                                            ?>
                                                            <button class="btn btn-info" data-toggle="modal" data-target="#publisworkModal_<?=$ppt->worksheet_id;?>"> Publish</button></p>

                                                            <?php
                                                            }else{
                                                            ?>
                                                            <button class="btn btn-danger" data-toggle="modal" data-target="#unpublisworkModal_<?=$ppt->worksheet_id;?>"> Unpublish</button></p>

                                                            <?php
                                                            }
                                                            ?>
                                                            
                                                    </div>


                                                    <!-- <div class="col-md-2">
                                                        <h4 class="card-title">Worksheet Title</h4>
                                                        <p><?=$ppt->worksheet_title;?></p>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <h4 class="card-title">Worksheet Documents</h4>
                                                        <p><?=$ppt->worksheet_document;?></p>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <h4 class="card-title">Submission Date</h4>
                                                        <p><?=$ppt->submission_date;?></p>
                                                    </div> -->
                                                    <!-- <div class="col-md-2">
                                                        <h4 class="card-title"><?=$ppt->Title;?></h4>
                                                        <p><button class="btn btn-default" value="<?=$ppt->Id;?>" data-toggle="modal" data-target="#viewpptModal_<?=$ppt->Id;?>">View PPT</button></p>
                                                    </div> -->
                                                    <!-- <div class="col-md-2 text-right">
                                                        <p><button class="btn btn-default" value="<?=$ppt->worksheet_id;?>" data-toggle="modal" data-target="#editpptModal_<?=$ppt->worksheet_id;?>"><i class="fas fa-edit"></i></button><button class="btn btn-default" data-toggle="modal" data-target="#deletepptModal_<?=$ppt->worksheet_id;?>"><i class="fas fa-trash"></i></button></p>

                                                    </div> -->
                                                </div>
                                                <!-- <p><?=strip_tags($ppt->Description);?></p> -->
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="modal" id="editpptModal_<?=$ppt->worksheet_id;?>">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-body">
                                        <h5 class="modal-title" id="editpptModal">Edit Worksheet</h5><br>
                                        <div class="ui search focus lbel25">
                                            <label>Worksheet Title</label>
                                            <div class="ui left icon input swdh19">
                                                <textarea class="form-control" id="wtitle_<?=$ppt->worksheet_id;?>"><?=$ppt->worksheet_title;?>
                                                    </textarea>
                                            </div>
                                        </div>
                                        <div class="ui search focus mt-30 lbel25">
                                            <label>Batch</label>
                                            <div class="ui left icon input swdh19">
                                                <select class="custom-select form-control w_branch prompt srch_explore" id="wbatch_id_<?=$ppt->worksheet_id;?>">
                                                    <!-- <option selected>Choose...</option> -->
                                                    <option selected>Choose Batch</option>
                                                    <?php
                                                    foreach($batches as $btc){
                                                    ?>
                                                    <option value="<?=$btc->Id?>" <?php if($ppt->batch_id==$btc->Id){ echo "selected"; } ?>><?=$btc->Name?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                    <!-- <option value="3">Three</option> -->
                                                </select>
                                            </div>
                                        </div>
                                        <div class="ui search focus mt-30 lbel25">
                                            <label>Select Lecture</label>
                                            <div class="ui left icon input swdh19">
                                                <select class="custom-select form-control lec_id prompt srch_explore" id="wlec_id_<?=$ppt->worksheet_id;?>">
                                                    <!-- <option selected>Choose...</option> -->
                                                    <option selected>Choose Lecture</option>
                                                    <?php
                                                foreach($lect as $lecs){
                                                ?>
                                                    <option value="<?=$lecs->lecture_id?>"  <?php if($lecs->lecture_id==$ppt->lecture_id){ echo "selected"; }?>><?=$lecs->lecture_title?></option>
                                                <?php
                                                }?>
                                                    <!-- <option value="3">Three</option> -->
                                                </select>
                                            </div>
                                        </div>
                                    <!--     <div class="ui search focus mt-30 lbel25">
                                            <label>Course</label>
                                            <div class="ui left icon input swdh19">
                                            <input type="text" class="prompt srch_explore" value="<?=$topic[0]->CourseId;?>" name="uploadthumbnail"  readonly/>
                                        </div>
                                        </div>
                                        <div class="ui search focus mt-30 lbel25">
                                            <label>Subject</label>
                                            <div class="ui left icon input swdh19">
                                            <input type="text" data-plugin="dropify" data-default-file="" value="<?=$topic[0]->SectionId;?>" class="prompt srch_explore" name="" readonly />
                                        </div>
                                        </div>
                                        <div class="ui search focus mt-30 lbel25">
                                            <label>Topics</label>
                                            <div class="ui left icon input swdh19">
                                            <input type="text" data-plugin="dropify" data-default-file="" value="<?=$topic[0]->Id;?>" class="prompt srch_explore" name="" readonly/>
                                        </div>
                                        </div> -->
                                        <div class="ui search focus mt-30 lbel25">
                                            <label>Submission Date</label>
                                            <div class="ui left icon input swdh19">
                                            <input type="date" data-plugin="dropify" data-default-file="" class="prompt srch_explore" id="wsub_date_<?=$ppt->worksheet_id;?>" value="<?=$ppt->submission_date;?>" name="" />
                                        </div>
                                        </div>
                                        <div class="ui search focus mt-30 lbel25">
                                            <label>worksheet_document</label>
                                            <div class="ui left icon input swdh19">
                                            <input class="prompt srch_explore" type="hidden" id="cepdf_<?=$ppt->worksheet_id;?>" value="<?=$ppt->worksheet_document;?>">
                                                <input class="prompt srch_explore" type="file" placeholder="Enter title" name="wcpdf_<?=$ppt->worksheet_id;?>" id="wcpdf_<?=$ppt->worksheet_id;?>" accept="application/pdf">
                        
                                        </div>
                                        </div>
                                            <br>
                                            <div id="cmsg"></div>
                                        <button class="updateworksheet btn steps_btn" id="" value="<?=$ppt->worksheet_id;?>">Save</button>
                                        <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal" id="deletepptModal_<?=$ppt->worksheet_id;?>">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-body">
                                        <h5 class="modal-title">Are you sure you want to delete this?</h5><br>
                                        <button class="deleteworksheet btn steps_btn" id="" value="<?=$ppt->worksheet_id;?>">Yes</button>
                                        <button class="btn btn-default" data-dismiss="modal">No</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <div class="modal" id="publisworkModal_<?=$ppt->worksheet_id;?>">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-body">
                                        <h5 class="modal-title">Are you sure you want to publish this?</h5><br>
                                        <button class="publishwork btn steps_btn" id="" value="<?=$ppt->worksheet_id;?>">Yes</button>
                                        <button class="btn btn-default" data-dismiss="modal">No</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal" id="unpublisworkModal_<?=$ppt->worksheet_id;?>">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-body">
                                        <h5 class="modal-title">Are you sure you want to publish this?</h5><br>
                                        <button class="unpublishwork btn steps_btn" id="" value="<?=$ppt->worksheet_id;?>">Yes</button>
                                        <button class="btn btn-default" data-dismiss="modal">No</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <div class="modal" id="viewwsModal_<?=$ppt->worksheet_id;?>">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-body">
                                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Submitted</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Not Submitted</button>
                                        </li>
                                        <!-- <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</button>
                                        </li> -->
                                        </ul>
                                        <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">...</div>
                                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">...</div>
                                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
                                        </div>
                                      
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            <?php
                                }
                            }
                        ?>
                    </div>

                    <div class="tab-pane" id="study" role="tabpanel" aria-labelledby="study-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Question Writing:</h3>
                            </div>
                            <div class="col-md-6 text-right">
                                <button class="btn steps_btn" type="button" data-toggle="collapse" data-target="#collapsestudy" aria-expanded="false" aria-controls="collapsestudy">Add Question Writing</button>
                            </div>
                        </div>  
                        <div class="collapse" id="collapsestudy"><br>
                            <div class="card shadow rounded bg-white">
                                <div class="card-body">

                                  
                                    <div class="ui search focus mt-30 lbel25">
                                        <label> Title</label>
                                        <div class="ui left icon input swdh19">
                                        <textarea class="form-control" id="question_title">
                                            </textarea>
                                      </div>
                                    </div>
                                    <div class="ui search focus mt-30 lbel25">
                                        <label> Description</label>
                                        <div class="ui left icon input swdh19">
                                            <textarea class="desc form-control" id="question_desc">
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="ui search focus mt-30 lbel25">
                                        <label>Batch</label>
                                        <div class="ui left icon input swdh19">
                                            <select class="custom-select form-control" id="qwbatch_id">
                                                <option value="" selected>Choose...</option>
                                                <?php
                                                foreach($batches as $btc){
                                                ?>
                                                <option value="<?=$btc->Id;?>"><?=$btc->Name?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="ui search focus mt-30 lbel25">
                                        <label>Select PDF</label>
                                        <div class="ui left icon input swdh19">
                                        <input class="prompt srch_explore" type="file" placeholder="Enter title" name="qw_pdf" id="qw_pdf" accept="application/pdf">
                                      </div>
                                    </div>
                                    <br>
                                    <div id="quesmsg"></div>
                                    <button type="button" class="steps_btn" id="addquestionwrite" value="<?=$topic[0]->Id;?>">Add</button>
                                </div>
                            </div>
                        </div>
                        <br>
                        <?php 
                        if(count($question)>0){
                            foreach ($question as $que) {
                            ?>
                                <div class="row" id="studybody">
                                    <div class="col-md-12">
                                        <div class="card shadow rounded bg-white">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                    <a  href="<?=base_url();?>admin/course/question_write_submit?question_id=<?=$que->question_id;?>&batch_id=<?=$que->batch_id;?>" >
                                                        <h4 class="card-title"><?=$que->Title;?></h4></a>
                                                        <p><?=strip_tags($que->Description);?></p>
                                                    </div>
                                                    <div class="col-md-4 text-right">
                                                        <p><button class="btn btn-default" value="<?=$que->question_id;?>" data-toggle="modal" data-target="#editstudyModal_<?=$que->question_id;?>"><i class="fas fa-edit"></i></button><button class="btn btn-default" data-toggle="modal" data-target="#deletestudyModal_<?=$que->question_id;?>"><i class="fas fa-trash"></i></button></p>
                                                    <p>    <?php
                                                            if($que->is_publish == 0){
                                                            ?>
                                                              <button class="btn btn-info" data-toggle="modal" data-target="#publisqwModal_<?=$que->question_id;?>"> Publish</button></p>

                                                            <?php
                                                            }else{
                                                            ?>
                                                              <button class="btn btn-danger" data-toggle="modal" data-target="#unpublisqwModal_<?=$que->question_id;?>">UnPublish</button></p>

                                                            <?php
                                                            }
                                                            ?>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="modal" id="editstudyModal_<?=$que->question_id;?>">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-body">
                                        <h5 class="modal-title" id="editstudyModal">Edit Question Writing</h5><br>
                                            <div class="ui search focus lbel25">
                                                <label>Title</label>
                                                <div class="ui left icon input swdh19">
                                                <textarea class="form-control" id="que_title_<?=$que->question_id;?>"><?=$que->Title;?></textarea>
                                              </div>
                                            </div>
                                            <div class="ui search focus mt-30 lbel25">
                                                <label>Description</label>
                                                <div class="ui left icon input swdh19">
                                                    <textarea class="desc form-control" id="que_desc_<?=$que->question_id;?>">
                                                    <?=$que->Description;?></textarea>
                                                </div>
                                            </div>
                                            <div class="ui search focus mt-30 lbel25">
                                            <label>Batch</label>
                                            <div class="ui left icon input swdh19">
                                                <select class="custom-select form-control quebatchid prompt srch_explore" id="quebatch_<?=$que->question_id;?>">
                                                    <!-- <option selected>Choose...</option> -->
                                                    <option selected>Choose...</option>
                                                    <?php
                                                    foreach($batches as $btc){
                                                    ?>
                                                    <option value="<?=$btc->Id?>" <?php if($que->batch_id==$btc->Id) { echo 'selected'; } ?>><?=$btc->Name?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                    <!-- <option value="3">Three</option> -->
                                                </select>
                                            </div>
                                        </div>
                                            <!-- <h3>OR</h3> -->
                                            <div class="ui search focus lbel25 mt-30">
                                                <label>Select Pdf</label>
                                                <div class="ui left icon input swdh19">
                                                <input class="prompt srch_explore" type="hidden" id="eqpdf_<?=$que->question_id;?>" value="<?=$que->question_document;?>">
                                                <input class="prompt srch_explore" type="file" placeholder="Enter title" name="qpdf_<?=$que->question_id;?>" id="qpdf_<?=$que->question_id;?>" accept="application/pdf">
                                              </div>
                                            </div>
                                            <br>
                                            <div id="qmsg"></div>
                                        <button class="updatequestionw btn steps_btn" id="" value="<?=$que->question_id;?>">Save</button>
                                        <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                
                                <div class="modal" id="publisqwModal_<?=$que->question_id;?>">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-body">
                                        <h5 class="modal-title">Are you sure you want to publis this?</h5><br>
                                        <button class="publishqw btn steps_btn" id="" value="<?=$que->question_id;?>">Yes</button>
                                        <button class="btn btn-default" data-dismiss="modal">No</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal" id="unpublisqwModal_<?=$que->question_id;?>">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-body">
                                        <h5 class="modal-title">Are you sure you want to publis this?</h5><br>
                                        <button class="unpublishqw btn steps_btn" id="" value="<?=$que->question_id;?>">Yes</button>
                                        <button class="btn btn-default" data-dismiss="modal">No</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                
                                <div class="modal" id="deletestudyModal_<?=$que->question_id;?>">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-body">
                                        <h5 class="modal-title">Are you sure you want to delete this?</h5><br>
                                        <button class="deletequew btn steps_btn" id="" value="<?=$que->question_id;?>">Yes</button>
                                        <button class="btn btn-default" data-dismiss="modal">No</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            <?php
                                }
                            }
                        ?>
                    </div>
                    <div class="tab-pane" id="assignment" role="tabpanel" aria-labelledby="test-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Assignment:</h3>
                            </div>
                            <div class="col-md-6 text-right">
                                <button class="btn steps_btn" type="button" data-toggle="collapse" data-target="#collapseassin" aria-expanded="false" aria-controls="collapseassin">Add Assignment</button>
                            </div>
                        </div>  
                        <div class="collapse" id="collapseassin"><br>
                            <div class="card shadow rounded bg-white">
                                <div class="card-body">
                                    <div class="ui search focus lbel25">
                                        <label>Assignment Title</label>
                                        <div class="ui left icon input swdh19">
                                            <textarea class="form-control" id="assin_title" name="assin_title">
                                                </textarea>
                                        </div>
                                    </div>
                                    <div class="ui search focus mt-30 lbel25">
                                        <label>Batch</label>
                                        <div class="ui left icon input swdh19">
                                            <select class="custom-select form-control prompt srch_explore" id="abatch_id" name="abatch_id">
                                                <!-- <option selected>Choose...</option> -->
                                                <option selected>Choose...</option>
                                                <?php
                                                foreach($batches as $btc){
                                                ?>
                                                <option value="<?=$btc->Id?>"><?=$btc->Name?></option>
                                                <?php
                                                }
                                                ?>
                                                <!-- <option value="3">Three</option> -->
                                            </select>
                                        </div>
                                    </div>
                                  <!--   <div class="ui search focus mt-30 lbel25">
                                        <label>Course</label>
                                        <div class="ui left icon input swdh19">
                                        <input type="text" class="prompt srch_explore" value="<?=$topic[0]->CourseId;?>" name="course_id" id="course_id"  readonly/>
                                      </div>
                                    </div>
                                    <div class="ui search focus mt-30 lbel25">
                                        <label>Subject</label>
                                        <div class="ui left icon input swdh19">
                                        <input type="text" data-plugin="dropify" data-default-file="" value="<?=$topic[0]->SectionId;?>" class="prompt srch_explore" id="subject_id" name="subject_id" readonly />
                                      </div>
                                    </div>
                                    <div class="ui search focus mt-30 lbel25">
                                        <label>Topics</label>
                                        <div class="ui left icon input swdh19">
                                        <input type="text" data-plugin="dropify" data-default-file="" value="<?=$topic[0]->Id;?>" class="prompt srch_explore" id="topic_id" name="topic_id" readonly/>
                                      </div>
                                    </div> -->
                                    <div class="ui search focus mt-30 lbel25">
                                        <label>Submission Date</label>
                                        <div class="ui left icon input swdh19">
                                        <input type="date" data-plugin="dropify" data-default-file="" class="prompt srch_explore" name="submission_date" id="assinsubmission_date" />
                                      </div>
                                    </div>
                                    <div class="ui search focus mt-30 lbel25">
                                        <label>Assignment Document</label>
                                        <div class="ui left icon input swdh19">
                                        <input class="prompt srch_explore" type="file" placeholder="Enter title" name="assin_doc" id="assin_doc" accept="application/pdf">
                                      </div>
                                    </div>
                                    <br>
                                    <div id="assinmsg"></div>
                                    <button type="button" class="steps_btn" id="addassignments" value="<?=$topic[0]->Id;?>">Add</button>
                                </div>
                            </div>
                        </div> 
                        <br>
                            <!-- <div class="row" id="testbody"> -->
                            <?php 
                        if(count($assignment)>0){
                            foreach ($assignment as $ppt) {
                            ?>
                                <div class="row" id="pptbody">
                                    <div class="col-md-12">
                                        <div class="card shadow rounded bg-white">
                                            <div class="card-body">
                                                <div class="row">

                                                    <div class="col-md-8">
                                                    <a  href="<?=base_url();?>admin/course/assignment_submit?assignment_id=<?=$ppt->id;?>&batch_id=<?=$ppt->batch_id;?>" >
                                                       
                                                    <h4 class="card-title"> <?=$ppt->assignment_title;?></h4></a>
                                                        <!-- <p><?=$ppt->document_upload;?></p> -->
                                                    </div>
                                                    <div class="col-md-4 text-right">
                                                        <p><button class="btn btn-default" value="<?=$ppt->id;?>" data-toggle="modal" data-target="#editassinModal_<?=$ppt->id;?>"><i class="fas fa-edit"></i></button><button class="btn btn-default" data-toggle="modal" data-target="#deleteassinModal_<?=$ppt->id;?>"><i class="fas fa-trash"></i></button></p>

                                                    </div>
                                                    <div class="col-md-8">
                                                        <!-- <h4 class="card-title"><?=$ppt->id;?> </h4> -->
                                                        <p><i class="fas fa-chalkboard-teacher"></i> &nbsp;&nbsp; <?=$ppt->document_upload;?>&nbsp;&nbsp;&nbsp;<i class='fas fa-clock'></i> &nbsp;&nbsp;<?=date("d-M-Y", strtotime($ppt->submission_date)); ?> </p>
                                                    </div>
                                                    <div class="col-md-4 text-right">
                                                        <p>
                                                            <?php
                                                            if($ppt->is_publish == 0){
                                                            ?>
                                                             <button class="btn btn-info" data-toggle="modal" data-target="#publisassignModal_<?=$ppt->id;?>"> Publish</button></p>

                                                            <?php
                                                            }else{
                                                            ?>
                                                             <button class="btn btn-danger" data-toggle="modal" data-target="#unpublisassignModal_<?=$ppt->id;?>"> UnPublish</button></p>

                                                            <?php
                                                            }
                                                            ?>
                                                           
                                                    </div>
                                                    <!-- <div class="col-md-4">
                                                        <p><button class="btn btn-info" data-toggle="modal" data-target="#viewwsModal_<?=$ppt->id;?>"> Worksheet Submitted</button></p>

                                                    </div> -->


                                                  
                                                </div>
                                                <!-- <p><?=strip_tags($ppt->Description);?></p> -->
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="modal" id="editassinModal_<?=$ppt->id;?>">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-body">
                                        <h5 class="modal-title" id="editassinModal">Edit Assignment</h5><br>
                                        <div class="ui search focus lbel25">
                                            <label>Assignment Title</label>
                                            <div class="ui left icon input swdh19">
                                                <textarea class="form-control" id="assigntitle_<?=$ppt->id;?>"><?=$ppt->assignment_title;?>
                                                    </textarea>
                                            </div>
                                        </div>
                                        <div class="ui search focus mt-30 lbel25">
                                            <label>Batch</label>
                                            <div class="ui left icon input swdh19">
                                                <select class="custom-select form-control assignbatchid prompt srch_explore" id="assignbatch_<?=$ppt->id;?>">
                                                    <!-- <option selected>Choose...</option> -->
                                                    <option selected>Choose...</option>
                                                    <?php
                                                    foreach($batches as $btc){
                                                    ?>
                                                    <option value="<?=$btc->Id?>" <?php if($ppt->batch_id==$btc->Id) { echo 'selected'; } ?>><?=$btc->Name?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                    <!-- <option value="3">Three</option> -->
                                                </select>
                                            </div>
                                        </div>
                                        <!-- <div class="ui search focus mt-30 lbel25">
                                            <label>Course</label>
                                            <div class="ui left icon input swdh19">
                                        
                                            <input type="text" class="prompt srch_explore" value="<?=$topic[0]->CourseId;?>" name="uploadthumbnail"  readonly/>
                                        </div>
                                        </div>
                                        <div class="ui search focus mt-30 lbel25">
                                            <label>Subject</label>
                                            <div class="ui left icon input swdh19">
                                            <input type="text" data-plugin="dropify" data-default-file="" value="<?=$topic[0]->SectionId;?>" class="prompt srch_explore" name="" readonly />
                                        </div>
                                        </div>
                                        <div class="ui search focus mt-30 lbel25">
                                            <label>Topics</label>
                                            <div class="ui left icon input swdh19">
                                            <input type="text" data-plugin="dropify" data-default-file="" value="<?=$topic[0]->Id;?>" class="prompt srch_explore" name="" readonly/>
                                        </div>
                                        </div> -->
                                        <div class="ui search focus mt-30 lbel25">
                                            <label>Submission Date</label>
                                            <div class="ui left icon input swdh19">
                                            <input type="date" data-plugin="dropify" data-default-file="" id="assignsubmitdate_<?=$ppt->id;?>" class="prompt srch_explore" name="" value="<?=$ppt->submission_date;?>"/>
                                        </div>
                                        </div>
                                        <div class="ui search focus lbel25 mt-30">
                                            <label>Assignment_document</label>
                                            <div class="ui left icon input swdh19">
                                            <input class="prompt srch_explore" type="hidden" id="cepdf_<?=$ppt->id;?>" value="<?=$ppt->document_upload;?>">
                                               
                                            <input class="prompt srch_explore" type="file" placeholder="Enter title" name="acpdf_<?=$ppt->id;?>" id="cpdf_<?=$ppt->id;?>" accept="application/pdf">
                                        </div>
                                        </div>
                                            <br>
                                            <div id="amsg"></div>
                                        <button class="updateassingmnet btn steps_btn" id="" value="<?=$ppt->id;?>">Save</button>
                                        <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal" id="deleteassinModal_<?=$ppt->id;?>">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-body">
                                        <h5 class="modal-title">Are you sure you want to delete this?</h5><br>
                                        <button class="deleteassign btn steps_btn" id="" value="<?=$ppt->id;?>">Yes</button>
                                        <button class="btn btn-default" data-dismiss="modal">No</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <div class="modal" id="publisassignModal_<?=$ppt->id;?>">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-body">
                                        <h5 class="modal-title">Are you sure you want to publis this?</h5><br>
                                        <button class="publishassin btn steps_btn" id="" value="<?=$ppt->id;?>">Yes</button>
                                        <button class="btn btn-default" data-dismiss="modal">No</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal" id="unpublisassignModal_<?=$ppt->id;?>">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-body">
                                        <h5 class="modal-title">Are you sure you want to publis this?</h5><br>
                                        <button class="unpublishassin btn steps_btn" id="" value="<?=$ppt->id;?>">Yes</button>
                                        <button class="btn btn-default" data-dismiss="modal">No</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal" id="viewwsModal_<?=$ppt->id;?>">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-body">
                                         
                                      
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            <?php
                                }
                            }
                        ?>
                            <!-- </div> -->
                      
                    </div>
                     <div class="tab-pane" id="test" role="tabpanel" aria-labelledby="lquestions-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Tests:</h3>
                            </div>
                            <div class="col-md-6 text-right">
                                <button class="btn steps_btn" type="button" data-toggle="collapse" data-target="#collapsetest" aria-expanded="false"
                                  aria-controls="collapsestest">Create Test</button>
                            </div>
                        </div>  
                        <br>
                        <div class="collapse" id="collapsetest"><br>
                                   <div class="card shadow rounded bg-white">
                                       <div class="card-body">

                                   
                                       <div class="ui search focus mt-30 lbel25">
                                                <label>Exam Title</label>
                                                <div class="ui left icon input swdh19">
                                                    <input type="text" data-plugin="dropify" data-default-file="" class="prompt srch_explore" name="exam_title"
                                                        id="exam_title" />
                                                </div>
                                            </div>
                                            <div class="ui search focus mt-30 lbel25">
                                        <label>Batch</label>
                                        <div class="ui left icon input swdh19">
                                            <select class="custom-select form-control prompt srch_explore" id="exbatch_id">
                                                <option value="" selected>Choose...</option>
                                                <?php
                                                foreach($batches as $btc){
                                                ?>
                                                <option value="<?=$btc->Id;?>"><?=$btc->Name?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                            <div class="ui search focus mt-30 lbel25">
                                                <label>Date</label>
                                                <div class="ui left icon input swdh19">
                                                    <input type="date" data-plugin="dropify" data-default-file="" class="prompt srch_explore" name="exam_date"
                                                        id="exam_date" />
                                                </div>
                                            </div>

                                            <div class="ui search focus mt-30 lbel25">
                                                <label>Start Time</label>
                                                <div class="ui left icon input swdh19">
                                                    <input type="time" data-plugin="dropify" data-default-file="" class="prompt srch_explore" name="exstart_time"
                                                        id="exstart_time" />
                                                </div>
                                            </div>
                                            <div class="ui search focus mt-30 lbel25">
                                                <label>End Time</label>
                                                <div class="ui left icon input swdh19">
                                                    <input type="time" data-plugin="dropify" data-default-file="" class="prompt srch_explore" name="exend_time"
                                                        id="exend_time" />
                                                </div>
                                            </div>
                                       <div class="ui search focus mt-30 lbel25">
                                                <label>Total Marks</label>
                                                <div class="ui left icon input swdh19">
                                                    <input type="number" data-plugin="dropify" data-default-file="" class="prompt srch_explore" name="total_marks"
                                                        id="total_marks" />
                                                </div>
                                            </div>
                                       <div class="ui search focus mt-30 lbel25">
                                                <label>Passing Marks</label>
                                                <div class="ui left icon input swdh19">
                                                    <input type="number" data-plugin="dropify" data-default-file="" class="prompt srch_explore" name="passing_marks"
                                                        id="passing_marks" />
                                                </div>
                                            </div>
                                
                                    <div id="emsg"></div>
                                    <button type="button" class="steps_btn mt-30" id="addexam" value="<?=$topic[0]->Id;?>">Add</button>
                                          
                                        </div>
                                    </div>
                          
                        </div>     
                        <br>
                     
         <?php 
         if(count($examss)>0){
             foreach ($examss as $exams) {
             ?>
                 <div class="row" id="studybody">
                     <div class="col-md-12">
                         <div class="card shadow rounded bg-white">
                             <div class="card-body">
                                 <div class="row">
                                     <div class="col-md-8">
                                     <a  href="<?=base_url();?>admin/course/exam_result?exam_id=<?=$exams->exam_id;?>&batch_id=<?=$exams->batch_id;?>" >   <h4 class="card-title"><?=$exams->Title;?></h4></a>
                                         <p><i class="fa fa-calendar"></i> <?=$exams->Date;?> <?=$exams->start_time;?>-<?=$exams->end_time;?>
                                     </div>
                                     <div class="col-md-4 text-right">
                                         <p><button class="btn btn-default" value="<?=$exams->exam_id;?>" data-toggle="modal" data-target="#editexamModal_<?=$exams->exam_id;?>"><i class="fas fa-edit"></i></button><button class="btn btn-default" data-toggle="modal" data-target="#deletexamModal_<?=$exams->exam_id;?>"><i class="fas fa-trash"></i></button></p>
                                         <p>    <?php
                                                            if($exams->is_publish == 0){
                                                            ?>
                                                              <button class="btn btn-info" data-toggle="modal" data-target="#publisexamModal_<?=$exams->exam_id;?>"> Publish</button></p>

                                                            <?php
                                                            }else{
                                                            ?>
                                                              <button class="btn btn-danger" data-toggle="modal" data-target="#unpublisexamModal_<?=$exams->exam_id;?>">UnPublish</button></p>

                                                            <?php
                                                            }
                                                            ?>
                                      </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div><br>
                 <div class="modal" id="editexamModal_<?=$exams->exam_id;?>">
                   <div class="modal-dialog" role="document">
                     <div class="modal-content">
                       <div class="modal-body">
                         <h5 class="modal-title" id="editstudyModal">Edit Exam</h5><br>
                             <div class="ui search focus lbel25">
                                 <label>Title</label>
                                 <div class="ui left icon input swdh19">
                                 <textarea class="form-control" id="exam_title_<?=$exams->exam_id;?>"><?=$exams->Title;?></textarea>
                               </div>
                             </div>
                             <div class="ui search focus lbel25 mt-30">
                                 <label>Date</label>
                                 <div class="ui left icon input swdh19">
                                 <input type="date" data-plugin="dropify" data-default-file="" class="prompt srch_explore" name="date"
                                                        id="date_<?=$exams->exam_id;?>" value="<?=$exams->Date;?>" />
                               </div>
                             </div>
                             <div class="ui search focus mt-30 lbel25">
                                        <label>Batch</label>
                                        <div class="ui left icon input swdh19">
                                            <select class="custom-select form-control prompt srch_explore" id="qexbatch_id_<?=$exams->exam_id;?>">
                                                <option value="" selected>Choose...</option>
                                                <?php
                                                foreach($batches as $btc){
                                                ?>
                                              
                                                <option value="<?=$btc->Id;?>" <?php if($exams->batch_id==$btc->Id) { echo 'selected'; } ?>><?=$btc->Name?></option>
                                            
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                             <div class="ui search focus lbel25 mt-30">
                                 <label>Start Time</label>
                                 <div class="ui left icon input swdh19">
                                 <input type="time" data-plugin="dropify" data-default-file="" class="prompt srch_explore" name="start_time"
                                                        id="start_time_<?=$exams->exam_id;?>" value="<?=$exams->start_time;?>"/>
                               </div>
                             </div>
                             <div class="ui search focus lbel25 mt-30">
                                 <label>End Time</label>
                                 <div class="ui left icon input swdh19">
                                 <input type="time" data-plugin="dropify" data-default-file="" class="prompt srch_explore" name="end_time"
                                                        id="end_time_<?=$exams->exam_id;?>" value="<?=$exams->end_time;?>"/>
                               </div>
                             </div>
                             <div class="ui search focus mt-30 lbel25">
                                                <label>Total Marks</label>
                                                <div class="ui left icon input swdh19">
                                                    <input type="number" data-plugin="dropify" data-default-file="" class="prompt srch_explore" value="<?=$exams->total_marks;?>"  name="total_marks"
                                                        id="total_marks_<?=$exams->exam_id;?>" value="<?=$exams->total_marks;?>"/>
                                                </div>
                                            </div>
                                       <div class="ui search focus mt-30 lbel25">
                                                <label>Passing Marks</label>
                                                <div class="ui left icon input swdh19">
                                                    <input type="number" data-plugin="dropify" data-default-file="" class="prompt srch_explore" value="<?=$exams->passing_marks;?>"  name="passing_marks"
                                                        id="passing_marks_<?=$exams->exam_id;?>" value="<?=$exams->passing_marks;?>"/>
                                                </div>
                                            </div>
                             <br>
                             <div id="qmsg"></div>
                         <button class="updateexam btn steps_btn" id="" value="<?=$exams->exam_id;?>">Save</button>
                         <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                       </div>
                     </div>
                   </div>
                 </div>

<div class="modal" id="publisexamModal_<?=$exams->exam_id;?>">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-body">
                                        <h5 class="modal-title">Are you sure you want to publis this?</h5><br>
                                        <button class="publishexamm btn steps_btn" id="" value="<?=$exams->exam_id;?>">Yes</button>
                                        <button class="btn btn-default" data-dismiss="modal">No</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal" id="unpublisexamModal_<?=$exams->exam_id;?>">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-body">
                                        <h5 class="modal-title">Are you sure you want to publis this?</h5><br>
                                        <button class="unpublishexamm btn steps_btn" id="" value="<?=$exams->exam_id;?>">Yes</button>
                                        <button class="btn btn-default" data-dismiss="modal">No</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                 <div class="modal" id="deletexamModal_<?=$exams->exam_id;?>">
                   <div class="modal-dialog" role="document">
                     <div class="modal-content">
                       <div class="modal-body">
                         <h5 class="modal-title">Are you sure you want to delete this?</h5><br>
                         <button class="deleteexam btn steps_btn" id="" value="<?=$exams->exam_id;?>">Yes</button>
                         <button class="btn btn-default" data-dismiss="modal">No</button>
                       </div>
                     </div>
                   </div>
                 </div>
             <?php
                 }
             }
         ?>
                        <div class="row" id="testbody">
                                <?php 
                                $i=0;
                                    foreach ($ltests as $test) {
                                    ?>
                                    <div class="col-md-4">
                                        <div class="card text-center shadow rounded bg-white">
                                            <div class="card-body">
                                                <h3 class="ltdetails card-title text-success" id="<?=$test->Id;?>" style="cursor: pointer;"><?=$test->ExamName;?></h3>
                                                <p>Total Questions: <?=$lquestions[$i];?></p>
                                                <p>Duration: <?=$test->Duration;?> mins</p>
                                                <p class="text-center"><button class="updatetest btn btn-default"  data-toggle="modal" data-target="#edittestModel_<?=$test->Id;?>"><i class="fas fa-edit"></i></button><button class="btn btn-default" data-toggle="modal" data-target="#deletelquestionModal_<?=$test->Id;?>"><i class="fas fa-trash"></i></button></p>
                                            </div>
                                        </div><br>
                                        <div class="modal" id="deletelquestionModal_<?=$test->Id;?>">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-body">
                                                <h5 class="modal-title">Are you sure you want to delete this?</h5><br>
                                                <button class="deletelquestion btn steps_btn" value="<?=$test->Id;?>">Yes</button>
                                                <button class="btn btn-default" data-dismiss="modal">No</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                       <div class="modal" id="edittestModel_<?=$test->Id;?>">
                                      <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h4 class="modal-title">Edit Topic Test</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          </div>
                                          <div class="modal-body">
                                            <div class="row container">
                                              <div class="col-md-12">
                                               <div class="ui search focus lbel25">
                                                <label>Title</label>
                                                <div class="ui left icon input swdh19">
                                                  <input class="prompt srch_explore" type="text" placeholder="Enter title" id="uttitle_<?=$test->Id;?>" value="<?=$test->ExamName;?>">                  
                                                </div>
                                                </div>
                                               <div class="ui search focus mt-30 lbel25">
                                                  <label>Duration(in minutes)</label>
                                                  <div class="ui left icon input swdh19">
                                                    <input class="prompt srch_explore" type="number" placeholder="Minutes" id="utduration_<?=$test->Id;?>" value="<?=$test->Duration;?>">                  
                                                  </div>
                                                </div>
                                               <div class="ui search focus mt-30 lbel25">
                                                  <label>Passing Percentage</label>
                                                  <div class="ui left icon input swdh19">
                                                    <input class="prompt srch_explore" type="text" placeholder="30" id="utpmarks_<?=$test->Id;?>" value="<?=$test->PassingPercent;?>">                  
                                                  </div>
                                                </div>
                                               <div class="ui search focus mt-30 lbel25">
                                                  <label>Instructions</label>
                                                  <div class="ui left icon input swdh19">
                                                    <textarea class="desc form-control" id="utinstructions_<?=$test->Id;?>" rows="2" placeholder="Instructions"><?=$test->Instructions;?>
                                                    </textarea>
                                                  </div>
                                                </div>
                                              </div>
                                              <br>
                                              <div id="utmsg_<?=$test->Id;?>"></div>
                                            </div><br>
                                            <div class="text-left">
                                              <button type="button" class="updatetest btn btn-default steps_btn" value="<?=$test->Id;?>">Update</button>
                                            </div>
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
                    <!-- <div class="tab-pane" id="live" role="tabpanel" aria-labelledby="live-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Live Lectures:</h3>
                            </div>
                            <div class="col-md-6 text-right">
                                <button class="btn steps_btn" type="button" data-toggle="collapse" data-target="#collapseLive" aria-expanded="false" aria-controls="collapseLive">Create Live Lecture</button>
                            </div>
                        </div>  
                        <div class="collapse" id="collapseLive"><br>
                            <div class="card shadow rounded bg-white">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="ui search focus mt-30 lbel25">
                                                <label>Lecture Title</label>
                                                <div class="ui left icon input swdh19">
                                                    <input class="prompt srch_explore" type="text" placeholder="Lecture  title" name="title" data-purpose="edit-course-title" id="ltitle" value="">
                                                </div>
                                            </div>
                                            <div class="ui search focus mt-30 lbel25">
                                                <label>Lecture Description</label>
                                                <div class="ui left icon input swdh19">
                                                    <textarea class="desc form-control" id="ldesc"></textarea>
                                                </div>
                                            </div>  
                                            <div class="ui search focus mt-30 lbel25">
                                                <label>Select Thumbnail</label>
                                                <div class="ui left icon input swdh19">
                                                    <input type="file" data-plugin="dropify" data-default-file="" class="prompt srch_explore" id="ulimage" name="ulimage" accept="image/*"/>
                                                </div>
                                            </div>
                                            <div class="ui search focus mt-30 lbel25">
                                                <label>Lecture date & time</label>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <div class="ui left icon input swdh19">
                                                            <input class="prompt srch_explore" type="date" data-purpose="edit-course-title" id="ldate" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="ui left icon input swdh19">
                                                            <input class="prompt srch_explore" type="time" data-purpose="edit-course-title" id="lstime" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="ui left icon input swdh19">
                                                            <input class="prompt srch_explore" type="time" data-purpose="edit-course-title" id="letime" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ui search focus mt-30 lbel25">
                                                <label>Lecuture Start URL</label>
                                                <div class="ui left icon input swdh19">
                                                    <input class="prompt srch_explore" type="text" placeholder="Lecuture Start URL" name="title" data-purpose="edit-course-title" id="lstarturl" value="">                                  
                                                </div>
                                            </div>
                                            <div class="ui search focus mt-30 lbel25">
                                                <label>Lecuture Id</label>
                                                <div class="ui left icon input swdh19">
                                                    <input class="prompt srch_explore" type="text" placeholder="Lecture Id" data-purpose="edit-course-title" id="lectid" value="">  
                                                </div>
                                            </div>
                                            <div class="ui search focus mt-30 lbel25">
                                                <label>Lecture Password</label>
                                                <div class="ui left icon input swdh19">
                                                    <input class="prompt srch_explore" type="text" placeholder="Password" data-purpose="edit-course-title" id="lpass" value="">     
                                                </div>
                                            </div>  
                                            <br>
                                            <div id="lmsg"></div>
                                            <div class="text-right">
                                                <button class="btn btn-default steps_btn" id="addlecture" value="<?=$topic[0]->Id;?>">Add</button>  
                                            </div>
                                        </div>      
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <?php 

                        if(count($live)>0){
                            date_default_timezone_set('Asia/Kolkata');
                            ?>
                            <div class="row" id="lecturebody">
                                <?php 
                                $i=0;
                                foreach ($live as $lect) {
                                    ?>
                                    <div class="col-md-12">
                                        <div class="card shadow rounded bg-white">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <img src="<?=$lect->Thumbnail;?>" style="width: 100%;">
                                                    </div>
                                                    <div class="col-md-6">
                                                <h4 class="card-title"><?=$lect->Title;?></h4>
                                                <p><i class="fas fa-calendar"></i>&nbsp; <?=date("d M Y", strtotime($lect->Lecture_date));?></p>
                                                <p><i class="fas fa-clock"></i>&nbsp; <?=date("H:i A", strtotime($lect->Start_time))."-".date("H:i A", strtotime($lect->End_time));?></p>
                                                </div>
                                                <div class="col-md-4">
                                                <p class="text-center"><button class="updatelecture btn btn-default" data-toggle="modal" data-target="#editlectureModal_<?=$lect->Id;?>"><i class="fas fa-edit"></i></button><button class="btn btn-default" data-toggle="modal" data-target="#deletelectureModal_<?=$lect->Id;?>"><i class="fas fa-trash"></i></button></p>
                                                 <button class="start btn btn-success" value="<?=$lect->Id;?>">Start</button>
                                                </div>
                                            </div>
                                            </div>
                                        </div><br>
                                    </div>

                        <div class="modal" id="deletelectureModal_<?=$lect->Id;?>">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-body">
                                <h5 class="modal-title">Are you sure you want to delete this?</h5><br>
                                <button class="deletelecture btn steps_btn" value="<?=$lect->Id;?>">Yes</button>
                                <button class="btn btn-default" data-dismiss="modal">No</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="modal" id="editlectureModal_<?=$lect->Id;?>">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-body">
                                <h5 class="modal-title">Edit Lecture</h5><br>
                                <div class="row">
                                        <div class="col-12">
                                            <div class="ui search focus mt-30 lbel25">
                                                <label>Lecture Title</label>
                                                <div class="ui left icon input swdh19">
                                                    <input class="prompt srch_explore" type="text" placeholder="Lecture  title" name="title" data-purpose="edit-course-title" id="ultitle_<?=$lect->Id;?>" value="<?=$lect->Title;?>">
                                                </div>
                                            </div>
                                            <div class="ui search focus mt-30 lbel25">
                                                <label>Lecture Description</label>
                                                <div class="ui left icon input swdh19">
                                                    <textarea class="desc form-control" id="uldesc_<?=$lect->Id;?>"><?=$lect->Description;?></textarea>
                                                </div>
                                            </div>  
                                            <div class="ui search focus mt-30 lbel25">
                                                <label>Select Thumbnail</label>
                                                <input type="hidden" name="" id="uleimage_<?=$lect->Id;?>" value="<?=$lect->Thumbnail;?>">
                                                <div class="ui left icon input swdh19">
                                                    <input type="file" data-plugin="dropify" data-default-file="" class="prompt srch_explore" id="ulimage_<?=$lect->Id;?>" name="ulimage_<?=$lect->Id;?>" accept="image/*"/>
                                                </div>
                                            </div>
                                            <div class="ui search focus mt-30 lbel25">
                                                <label>Lecture date & time</label>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <div class="ui left icon input swdh19">
                                                            <input class="prompt srch_explore" type="date" data-purpose="edit-course-title" id="uldate_<?=$lect->Id;?>" value="<?=$lect->Lecture_date;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="ui left icon input swdh19">
                                                            <input class="prompt srch_explore" type="time" data-purpose="edit-course-title" id="ulstime_<?=$lect->Id;?>" value="<?=$lect->Start_time;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="ui left icon input swdh19">
                                                            <input class="prompt srch_explore" type="time" data-purpose="edit-course-title" id="uletime_<?=$lect->Id;?>" value="<?=$lect->End_time;?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ui search focus mt-30 lbel25">
                                                <label>Lecuture Start URL</label>
                                                <div class="ui left icon input swdh19">
                                                    <input class="prompt srch_explore" type="text" placeholder="Lecuture Start URL" name="title" data-purpose="edit-course-title" id="ulstarturl_<?=$lect->Id;?>" value="<?=$lect->Meeting_url;?>">                                  
                                                </div>
                                            </div>
                                            <div class="ui search focus mt-30 lbel25">
                                                <label>Lecuture Id</label>
                                                <div class="ui left icon input swdh19">
                                                    <input class="prompt srch_explore" type="text" placeholder="Lecture Id" data-purpose="edit-course-title" id="ulectid_<?=$lect->Id;?>" value="<?=$lect->Meeting_id;?>">  
                                                </div>
                                            </div>
                                            <div class="ui search focus mt-30 lbel25">
                                                <label>Lecture Password</label>
                                                <div class="ui left icon input swdh19">
                                                    <input class="prompt srch_explore" type="text" placeholder="Password" data-purpose="edit-course-title" id="ulpass_<?=$lect->Id;?>" value="<?=$lect->Password;?>">     
                                                </div>
                                            </div> 
                                        </div>      
                                    </div>
                                 <br><br>
                                  <div id="ulmsg_<?=$lect->Id;?>"></div><br>
                                <button class="updatelecture btn steps_btn" value="<?=$lect->Id;?>">Save</button>
                              </div>
                            </div>
                          </div>
                        </div>
                                    <?php
                                    $i++;
                                }
                                ?>
                            </div>
                            <?php
                        }
                        else{
                            ?>
                            <div class="row" id="lecturebody">
                            </div>
                            <?php
                        }
                        ?>
                         
                    </div>
                    <div class="tab-pane" id="forum" role="tabpanel" aria-labelledby="forum-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Questions & Answers:</h3>
                            </div>
                            <div class="col-md-6 text-right">
                                <button class="btn steps_btn" type="button" data-toggle="collapse" data-target="#collapseForum" aria-expanded="false" aria-controls="collapseForum">Add New Question</button>
                            </div>
                        </div>  
                        <div class="collapse" id="collapseForum"><br>
                            <div class="card shadow rounded bg-white">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="ui search focus mt-30 lbel25">
                                                <label>Question</label>
                                                <div class="ui left icon input swdh19">
                                                    <textarea class="desc form-control" id="fquestion"></textarea>
                                                </div>
                                            </div>
                                            <div class="ui search focus mt-30 lbel25">
                                                <label>Answer</label>
                                                <div class="ui left icon input swdh19">
                                                    <textarea class="desc form-control" id="fanswer"></textarea>
                                                </div>
                                            </div>      
                                            <br>
                                            <div id="fmsg"></div>
                                            <div class="text-right">
                                                <button class="btn btn-default steps_btn" id="addqa" value="<?=$topic[0]->Id;?>">Add</button>   
                                            </div>
                                        </div>      
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <?php 

                        if(count($fquestions)>0){
                            date_default_timezone_set('Asia/Kolkata');
                            ?>
                            <div class="row" id="lecturebody">
                                <?php 
                                $i=0;
                                foreach ($fquestions as $que) {
                                    ?>
                                    <div class="col-md-12">
                                        <div class="card shadow rounded bg-white">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <h4 class="card-title"><?=$que->Questions;?></h4>
                                                    </div>
                                                    <div class="col-md-4 text-right">
                                                        <p><button class="btn btn-default"   data-toggle="modal" data-target="#editfquestionModal_<?=$que->Id;?>"><i class="fas fa-edit"></i></button><button class="btn btn-default" data-toggle="modal" data-target="#deletequestionModal_<?=$que->Id;?>"><i class="fas fa-trash"></i></button></p>
                                                    </div>
                                                </div>
                                                <?php 
                                                if(count($fanswers[$i])>0)
                                                {
                                                ?>
                                                <p><strong>Answer:</strong><br><?=$fanswers[$i][0]->Answers;?></p>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div><br>
                        <div class="modal" id="deletequestionModal_<?=$que->Id;?>">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-body">
                                <h5 class="modal-title">Are you sure you want to delete this?</h5><br>
                                <button class="deletequestion btn steps_btn" value="<?=$que->Id;?>">Yes</button>
                                <button class="btn btn-default" data-dismiss="modal">No</button>
                              </div>
                            </div>
                          </div>
                        </div>
                                           <div class="modal" id="editfquestionModal_<?=$que->Id;?>">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-body">
                                <div class="row">
                                        <div class="col-12">
                                            <div class="ui search focus mt-30 lbel25">
                                                <label>Question</label>
                                                <div class="ui left icon input swdh19">
                                                    <textarea class="desc form-control" id="fquestion_<?=$que->Id;?>"><?=$que->Questions;?></textarea>
                                                </div>
                                            </div>
                                            <div class="ui search focus mt-30 lbel25">
                                                <label>Answer</label>
                                                <div class="ui left icon input swdh19">
                                                    <textarea class="desc form-control" id="fanswer_<?=$que->Id;?>"><?=$fanswers[$i][0]->Answers;?></textarea>
                                                </div>
                                            </div>      
                                            <br>
                                            <div id="fmsg_<?=$que->Id;?>"></div>
                                            <div>
                                                <button class="updatefquestion btn btn-default steps_btn" value="<?=$que->Id;?>">Update</button>   
                                            </div>
                                        </div>      
                                    </div>
                              </div>
                            </div>
                          </div>
                        </div>
                                    </div>
                                    <?php
                                    $i++;
                                }
                                ?>
                            </div>
                          
                            <?php
                        }
                        else{
                            ?>
                            <div class="row" id="lecturebody">
                            </div>
                            <?php
                        }
                        ?>
                        
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    initialize();
     $( ".modal .form-control" ).click(function( event ) {
      event.stopPropagation();

    });
    $('#addtestseries').click(function(){
        $('#smsg').html('<div class="alert alert-primary"><i class="fa fa-spinner fa-spin"></i> Please wait test creating....</div>');
        var title=$('#stitle').val();
        var desc=tinyMCE.editors[$('#sdesc').attr('id')].getContent();
        var formData = new FormData();
        var sid=$(this).val();
        var cid='<?=$topic[0]->CourseId;?>';
        thumbnail=$('input[name="seriesthumbnail"]').get(0).files;
        formData.append('cid', cid);
        formData.append('sid', sid);
        formData.append('thumbnail', thumbnail[0]);
        formData.append('title', title);
        formData.append('desc', desc);
        $.ajax({
            url: "<?= base_url()?>admin/course/addtestseries",
            data: formData,
            type: "post",
            headers: { 'IsAjax': 'true' },
            processData: false,
            contentType: false,
            dataType:'json',
            success: function(data){
                if(data.code=="404"){
                    $('#smsg').html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
                }
                else{
                    var url = window.location.href;
                    $("#loadcontent").load(url);
                }
            }
        });
    });
    $('#addlecture').click(function(){
        // $('#vmsg').html('<div class="alert alert-primary"><i class="fa fa-spinner fa-spin"></i> Please wait video uploading....</div>');

        // var vdesc=tinyMCE.editors[$('#vdesc').attr('id')].getContent();
        var formData = new FormData();
        var ltitle=$('#ltitle').val();
        var bid=$('#batch_id').val();
        var teacher_id=$('#teacher_id').val();
        var topicid=$('#topic_id').val();
        var ldate=$('#lecture_date').val();
        var stime=$('#start_time').val();
        var etime=$('#end_time').val();
        var note=$('#note').val();
        var sid='<?=$topic[0]->SectionId;?>';
        var cid='<?=$topic[0]->CourseId;?>';
        var tid='<?=$topic[0]->Id;?>';
        // video=$('input[name="uploadvideo"]').get(0).files;
        // thumbnail=$('input[name="uploadthumbnail"]').get(0).files;
        formData.append('course_id', cid);
        formData.append('subject_id', sid);
        formData.append('teacher_id', teacher_id);
        // formData.append('video', video[0]);
        // formData.append('thumbnail', thumbnail[0]);
        formData.append('title', ltitle);
        formData.append('batch_id', bid);
        formData.append('topic_id', tid);
        formData.append('lacture_date', ldate);
        formData.append('stime', stime);
        formData.append('etime', etime);
        formData.append('note', note);
        $.ajax({
            url: "<?= base_url()?>admin/course/addlecture",
            data: formData,
            type: "post",
            headers: { 'IsAjax': 'true' },
            processData: false,
            contentType: false,
            dataType:'json',
            success: function(data){
                if(data.code=="404"){
                    $('#vmsg').html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
                }
                else{
                    var url = '<?=base_url();?>admin/course/topic_lecture/<?=$topic[0]->Id;?>';
                    $("#loadcontent").load(url);
                }
            }
        });
    });
    $('.w_branch').change(function(){
        var formData = new FormData();
        formData.append('batch_id', $(this).val());
        formData.append('topic_id', '<?=$topic[0]->Id;?>');
        $.ajax({
            url: "<?= base_url()?>admin/course/getbatchlectures",
            data: formData,
            type: "post",
            headers: { 'IsAjax': 'true' },
            processData: false,
            contentType: false,
            dataType:'json',
            success: function(data){
                html = '<option value="">Choose Lecture</option>';
                for (let i = 0; i < data.length; i++) {
                   html+='<option value="'+data[i].lecture_id+'">'+data[i].lecture_title+'</option>';
                }
                $('.lec_id').html(html);
            }
        });
    })

    $('#addworksheet').click(function(){
        // $('#ccmsg').html('<div class="alert alert-primary"><i class="fa fa-spinner fa-spin"></i> Please wait Worksheet Uploading....</div>');
        var title=$('#wstitle').val();
        var bid=$('#wbranch_id').val();
        var subdate=$('#sub_date').val();
        var lect_id=$('#lect_id').val();
        // var desc=$('#cdesc').val();//tinyMCE.editors[$('#cdesc').attr('id')].getContent();
        var pdf=$('input[name="work_doc"]').get(0).files;
        var formData = new FormData();
        var tid=$(this).val();
        var sid='<?=$topic[0]->SectionId;?>';
        var cid='<?=$topic[0]->CourseId;?>';
        formData.append('pdf', pdf[0]);
        formData.append('cid', cid);
        formData.append('sid', sid);
        formData.append('tid', tid);
        formData.append('subdate', subdate);
        formData.append('title', title);
        formData.append('lect_id', lect_id);
        formData.append('bid', bid);
        // formData.append('type', 'ppt');
        $.ajax({
            url: "<?= base_url()?>admin/course/addassignment",
            data: formData,
            type: "post",
            headers: { 'IsAjax': 'true' },
            processData: false,
            contentType: false,
            dataType:'json',
            success: function(data){
                if(data.code=="404"){
                    $('#ccmsg').html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
                }
                else{
                    var url = '<?=base_url();?>admin/course/topic_lecture/<?=$topic[0]->Id;?>';
                  //  $("#loadcontent").load(url);
                  location.reload();
                }
            }
        });
    })
    $('#addassignments').click(function(){
         $('#assinmsg').html('<div class="alert alert-primary"><i class="fa fa-spinner fa-spin"></i> Please wait Worksheet Uploading....</div>');
        var assin_title=$('#assin_title').val();
        var bid=$('#abatch_id').val();
        var assinsubmission_date=$('#assinsubmission_date').val();
        var pdf=$('input[name="assin_doc"]').get(0).files;
        var formData = new FormData();
        var tid=$(this).val();
        var sid='<?=$topic[0]->SectionId;?>';
        var cid='<?=$topic[0]->CourseId;?>';
        formData.append('pdf', pdf[0]);
        formData.append('assinsubmission_date', assinsubmission_date);
        formData.append('assin_title', assin_title);
        formData.append('bid', bid);
        formData.append('cid', cid);
        formData.append('sid', sid);
        formData.append('tid', tid);
        // formData.append('type', 'ppt');
        $.ajax({
            url: "<?= base_url()?>admin/course/addassignmentdoc",
            data: formData,
            type: "post",
            headers: { 'IsAjax': 'true' },
            processData: false,
            contentType: false,
            dataType:'json',
            success: function(data){
                if(data.code=="404"){
                    $('#ccmsg').html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
                }
                else{
                    var url = '<?=base_url();?>admin/course/topic_lecture/<?=$topic[0]->Id;?>';
                  //  $("#loadcontent").load(url);
                  location.reload();
                }
            }
        });
    })

    $('#addquestionwrite').click(function(){
        $('#quesmsg').html('<div class="alert alert-primary"><i class="fa fa-spinner fa-spin"></i> Please wait ppt uploading....</div>');
        var title=$('#question_title').val();
        var desc=tinyMCE.editors[$('#question_desc').attr('id')].getContent();
        var pdf=$('input[name="qw_pdf"]').get(0).files;
        var formData = new FormData();
        var tid=$(this).val();
        var sid='<?=$topic[0]->SectionId;?>';
        var cid='<?=$topic[0]->CourseId;?>';
        var bid = $('#qwbatch_id').val();
        formData.append('pdf', pdf[0]);
        formData.append('cid', cid);
        formData.append('tid', tid);
        formData.append('sid', sid);
        formData.append('bid', bid);
        formData.append('title', title);
        formData.append('desc', desc);
        $.ajax({
            url: "<?= base_url()?>admin/course/addquestionwrite",
            data: formData,
            type: "post",
            headers: { 'IsAjax': 'true' },
            processData: false,
            contentType: false,
            dataType:'json',
            success: function(data){
                if(data.code=="404"){
                    $('#quesmsg').html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
                }
                else{
                    var url = '<?=base_url();?>admin/course/topic_lecture/<?=$topic[0]->Id;?>';
                    location.reload();
                }
            }
        });
    })

    $('#addexam').click(function(){
        var title=$('#exam_title').val();
        var date=$('#exam_date').val();
        var stime=$('#exstart_time').val();
        var etime=$('#exend_time').val();
        var bid=$('#exbatch_id').val();
        var total_marks=$('#total_marks').val();
        var passing_marks=$('#passing_marks').val();
        var formData = new FormData();
        var tid=$(this).val();
        var sid='<?=$topic[0]->SectionId;?>';
        var cid='<?=$topic[0]->CourseId;?>';
     
        formData.append('cid', cid);
        formData.append('tid', tid);
        formData.append('sid', sid);
        formData.append('bid', bid);
        formData.append('title', title);
        formData.append('date', date);
        formData.append('stime', stime);
        formData.append('etime', etime);
        formData.append('passing_marks', passing_marks);
        formData.append('total_marks', total_marks);
        $.ajax({
            url: "<?= base_url()?>admin/course/addexam",
            data: formData,
            type: "post",
            headers: { 'IsAjax': 'true' },
            processData: false,
            contentType: false,
            dataType:'json',
            success: function(data){
                if(data.code=="404"){
                    $('#emsg').html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
                }
                else{
                    var url = '<?=base_url();?>admin/course/topic_lecture/<?=$topic[0]->Id;?>';
                    location.reload();
                }
            }
        });
    })
    $('#addstudy').click(function(){
        $('#cmsg').html('<div class="alert alert-primary"><i class="fa fa-spinner fa-spin"></i> Please wait ppt uploading....</div>');
        var title=$('#study_title').val();
        var desc=tinyMCE.editors[$('#study_desc').attr('id')].getContent();
        var pdf=$('input[name="study_pdf"]').get(0).files;
        var formData = new FormData();
        var tid=$(this).val();
        var sid='<?=$topic[0]->SectionId;?>';
        var cid='<?=$topic[0]->CourseId;?>';
        formData.append('pdf', pdf[0]);
        formData.append('cid', cid);
        formData.append('tid', tid);
        formData.append('sid', sid);
        formData.append('title', title);
        formData.append('desc', desc);
        formData.append('type', 'study');
        $.ajax({
            url: "<?= base_url()?>admin/course/addconcept",
            data: formData,
            type: "post",
            headers: { 'IsAjax': 'true' },
            processData: false,
            contentType: false,
            dataType:'json',
            success: function(data){
                if(data.code=="404"){
                    $('#studymsg').html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
                }
                else{
                    var url = '<?=base_url();?>admin/course/topic_lecture/<?=$topic[0]->Id;?>';
                    location.reload();
                }
            }
        });
    })
    $('#addqa').click(function(){
        $('#fmsg').html('<div class="alert alert-primary"><i class="fa fa-spinner fa-spin"></i> Please wait question uploading....</div>');
        var question=tinyMCE.editors[$('#fquestion').attr('id')].getContent();
        var answer=tinyMCE.editors[$('#fanswer').attr('id')].getContent();
        var formData = new FormData();
        var tid=$(this).val();
        var sid='<?=$topic[0]->SectionId;?>';
        var cid='<?=$topic[0]->CourseId;?>';
        formData.append('cid', cid);
        formData.append('sid', sid);
        formData.append('tid', tid);
        formData.append('question', question);
        formData.append('answer', answer);
        $.ajax({
            url: "<?= base_url()?>admin/course/addqa",
            data: formData,
            type: "post",
            headers: { 'IsAjax': 'true' },
            processData: false,
            contentType: false,
            dataType:'json',
            success: function(data){
                if(data.code=="404"){
                    $('#fmsg').html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
                }
                else{
                    var url = '<?=base_url();?>admin/course/topic_lecture/<?=$topic[0]->Id;?>';
                    $("#loadcontent").load(url);
                }
            }
        });
    })
    // $('#addlecture').click(function(){
    //     $('#lmsg').html('<div class="alert alert-primary"><i class="fa fa-spinner fa-spin"></i> Please wait lecture uploading....</div>');
    //     var title=$('#ltitle').val();
    //     var desc=tinyMCE.editors[$('#ldesc').attr('id')].getContent();
    //     var ldate=$('#ldate').val();
    //     var stime=$('#lstime').val();
    //     var etime=$('#letime').val();
    //     var lstarturl=$('#lstarturl').val();
    //     var lectid=$('#lectid').val();
    //     var image=$('input[name="ulimage"]').get(0).files[0];
    //     var pass=$('#lpass').val();
    //     var formData = new FormData();
    //     var tid=$(this).val();
    //     var sid='<?=$topic[0]->SectionId;?>';
    //     var cid='<?=$topic[0]->CourseId;?>';
    //     formData.append('cid', cid);
    //     formData.append('image', image);
    //     formData.append('sid', sid);
    //     formData.append('tid', tid);
    //     formData.append('title', title);
    //     formData.append('desc', desc);
    //     formData.append('ldate', ldate);
    //     formData.append('stime', stime);
    //     formData.append('etime', etime);
    //     formData.append('lstarturl', lstarturl);
    //     formData.append('lectid', lectid);
    //     formData.append('pass', pass);
    //     $.ajax({
    //         url: "<?= base_url()?>admin/course/addlecture",
    //         data: formData,
    //         type: "post",
    //         headers: { 'IsAjax': 'true' },
    //         processData: false,
    //         contentType: false,
    //         dataType:'json',
    //         success: function(data){
    //             if(data.code=="404"){
    //                 $('#lmsg').html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
    //             }
    //             else{
    //                 var url = '<?=base_url();?>admin/course/topic_lecture/<?=$topic[0]->Id;?>';
    //                 $("#loadcontent").load(url);
    //             }
    //         }
    //     });
    // })
    $('body').on('click', '.updatevideo', function(){ 

        var formData=new FormData();
        var vid=$(this).val();
        $('#uvmsg_'+vid).html('<div class="alert alert-primary"><i class="fa fa-spinner fa-spin"></i> Please wait video uploading....</div>');
        var title=$('#uvtitle_'+vid).val();
        var desc=tinyMCE.editors[$('#uvdesc_'+vid).attr('id')].getContent();
        var eimage=$('#uveimage_'+vid).val();
        var evideo=$('#uvevideo_'+vid).val();
        var video=$('input[name="uuploadvideo_'+vid+'"]').get(0).files;
        var thumbnail=$('input[name="uuploadthumbnail_'+vid+'"]').get(0).files;
        formData.append('vid', vid);
        formData.append('video', video[0]);
        formData.append('thumbnail', thumbnail[0]);
        formData.append('title', title);
        formData.append('desc', desc);
        formData.append('ethumbnail', eimage);
        formData.append('evideo', evideo);
        $.ajax({
            url: "<?= base_url()?>admin/course/updatevideo",
            data: formData,
            type: "post",
            headers: { 'IsAjax': 'true' },
            processData: false,
            contentType: false,
            dataType:'json',
            success: function(data){
                if (data.code=="404") {
                    $('#uvmsg').html(data.msg);
                }
                else{
                     swal("Video updated successfully!", "", "success");
                    setTimeout(function () {
                        swal.close();
                       location.reload();
                    }, 1000); 
                }
            }
        });
    });
    $('body').on('click', '.updateworksheet', function(){ 
        var formData=new FormData();
        var wid=$(this).val();
        var title=$('#wtitle_'+wid).val();
        var pdf=$('input[name="wcpdf_'+wid+'"]').get(0).files;
        var epdf=$('#cepdf_'+wid).val();
        var wbatchid=$('#wbatch_id_'+wid).val();
        var wlec_id=$('#wlec_id_'+wid).val();
        var wsub_date=$('#wsub_date_'+wid).val();
  
        formData.append('wid', wid);
        formData.append('epdf', epdf);
        formData.append('pdf', pdf[0]);
        formData.append('title', title);
        formData.append('wbatchid', wbatchid);
        formData.append('wlec_id', wlec_id);
        formData.append('wsub_date', wsub_date);
        formData.append('type', 'ppt');
        $.ajax({
            url: "<?= base_url()?>admin/course/updateworksheet",
            data: formData,
            type: "post",
            headers: { 'IsAjax': 'true' },
            processData: false,
            contentType: false,
            dataType:'json',
            success: function(data){
                if (data.code=="404") {
                    $('#uvmsg').html(data.msg);
                }
                else{
                    swal("ppt updated successfully!", "", "success");
                    setTimeout(function () {
                        swal.close();
                       location.reload();
                    }, 1000); 
                }
            }
        });
    });
    $('body').on('click', '.updateassingmnet', function(){ 
        var formData=new FormData();
        var aid=$(this).val();
        var title=$('#assigntitle_'+aid).val();
        var bid=$('#assignbatch_'+aid).val();
        var pdf=$('input[name="acpdf_'+aid+'"]').get(0).files;
        var epdf=$('#cepdf_'+aid).val();
        var assignsubmitdate=$('#assignsubmitdate_'+aid).val();
   
  
        formData.append('aid', aid);
        formData.append('bid', bid);
        formData.append('epdf', epdf);
        formData.append('pdf', pdf[0]);
        formData.append('title', title);
        $.ajax({
            url: "<?= base_url()?>admin/course/updatassignmentdoc",
            data: formData,
            type: "post",
            headers: { 'IsAjax': 'true' },
            processData: false,
            contentType: false,
            dataType:'json',
            success: function(data){
                if (data.code=="404") {
                    $('#amsg').html(data.msg);
                }
                else{
                    swal("Assignment updated successfully!", "", "success");
                    setTimeout(function () {
                        swal.close();
                       location.reload();
                    }, 1000); 
                }
            }
        });
    });
    $('body').on('click', '.updateppt', function(){ 
        var formData=new FormData();
        var cid=$(this).val();
        var title=$('#uctitle_'+cid).val();
        var pdf=$('input[name="cpdf_'+cid+'"]').get(0).files;
        var epdf=$('#cepdf_'+cid).val();
        var desc=$('#ucdesc_'+cid).val();
        formData.append('cid', cid);
        formData.append('epdf', epdf);
        formData.append('pdf', pdf[0]);
        formData.append('title', title);
        formData.append('desc', desc);
        formData.append('type', 'ppt');
        $.ajax({
            url: "<?= base_url()?>admin/course/updateconcept",
            data: formData,
            type: "post",
            headers: { 'IsAjax': 'true' },
            processData: false,
            contentType: false,
            dataType:'json',
            success: function(data){
                if (data.code=="404") {
                    $('#uvmsg').html(data.msg);
                }
                else{
                    swal("ppt updated successfully!", "", "success");
                    setTimeout(function () {
                        swal.close();
                       location.reload();
                    }, 1000); 
                }
            }
        });
    });
    $('body').on('click', '.updatequestionw', function(){ 
        var formData=new FormData();
        var qid=$(this).val();
        var title=$('#que_title_'+qid).val();
        var batch=$('#quebatch_'+qid).val();
        var pdf=$('input[name="qpdf_'+qid+'"]').get(0).files;
        var epdf=$('#eqpdf_'+qid).val();
        var desc=tinyMCE.editors[$('#que_desc_'+qid).attr('id')].getContent();
        formData.append('qid', qid);
        formData.append('epdf', epdf);
        formData.append('pdf', pdf[0]);
        formData.append('batch', batch);
        formData.append('title', title);
        formData.append('desc', desc);
        $.ajax({
            url: "<?= base_url()?>admin/course/updatequestionwrite",
            data: formData,
            type: "post",
            headers: { 'IsAjax': 'true' },
            processData: false,
            contentType: false,
            dataType:'json',
            success: function(data){
                if (data.code=="404") {
                    $('#qmsg').html(data.msg);
                }
                else{
                    swal("Question Writing updated successfully!", "", "success");
                    setTimeout(function () {
                        swal.close();
                       location.reload();
                    }, 1000); 
                }
            }
        });
    });
    $('body').on('click', '.updateexam', function(){ 
        var formData=new FormData();
        var qid=$(this).val();
        var title=$('#exam_title_'+qid).val();
        var exbatch=$('#qexbatch_id_'+qid).val();
        var tmark=$('#total_marks_'+qid).val();
        var pmark=$('#passing_marks_'+qid).val();
        var date=$('#date_'+qid).val();
        var stime=$('#start_time_'+qid).val();
        var etime=$('#end_time_'+qid).val();
        formData.append('title', title);
        formData.append('exbatch', exbatch);
        formData.append('tmark', tmark);
        formData.append('pmark', pmark);
        formData.append('qid', qid);
        formData.append('date', date);
        formData.append('stime', stime);
        formData.append('etime', etime);
        $.ajax({
            url: "<?= base_url()?>admin/course/updateexam",
            data: formData,
            type: "post",
            headers: { 'IsAjax': 'true' },
            processData: false,
            contentType: false,
            dataType:'json',
            success: function(data){
                if (data.code=="404") {
                    $('#qmsg').html(data.msg);
                }
                else{
                    swal("Question Writing updated successfully!", "", "success");
                    setTimeout(function () {
                        swal.close();
                       location.reload();
                    }, 1000); 
                }
            }
        });
    });
    $('body').on('click', '.updatestudy', function(){ 
        var formData=new FormData();
        var cid=$(this).val();
        var title=$('#study_title_'+cid).val();
        var pdf=$('input[name="cpdf_'+cid+'"]').get(0).files;
        var epdf=$('#cepdf_'+cid).val();
        var desc=tinyMCE.editors[$('#study_desc_'+cid).attr('id')].getContent();
        formData.append('cid', cid);
        formData.append('epdf', epdf);
        formData.append('pdf', pdf[0]);
        formData.append('title', title);
        formData.append('desc', desc);
        formData.append('type', 'study');
        $.ajax({
            url: "<?= base_url()?>admin/course/updateconcept",
            data: formData,
            type: "post",
            headers: { 'IsAjax': 'true' },
            processData: false,
            contentType: false,
            dataType:'json',
            success: function(data){
                if (data.code=="404") {
                    $('#uvmsg').html(data.msg);
                }
                else{
                    swal("Study material updated successfully!", "", "success");
                    setTimeout(function () {
                        swal.close();
                       location.reload();
                    }, 1000); 
                }
            }
        });
    });
     $('body').on('click', '.updatelquestion', function(){ 
        var cid=$(this).val();
        $.ajax({
            url: "<?= base_url()?>admin/course/fetchvideoppt",
            data: {lid:cid},
            type: "post",
            dataType: "json",
            success: function(data){
                $('#ulqtitle').val(data[0].Title);
                tinyMCE.get('ulqdesc').setContent(data[0].Description);
                $('#updatelquestion').val(data[0].Id);
                $('#editlquestionModal').modal('show');
            }
        });
    });
    $('body').on('click', '#updatelquestion', function(){ 
        var formData=new FormData();
        var cid=$(this).val();
        var title=$('#ulqtitle').val();
        var desc=tinyMCE.editors[$('#ulqdesc').attr('id')].getContent();
        formData.append('cid', cid);
        formData.append('title', title);
        formData.append('desc', desc);
        $.ajax({
            url: "<?= base_url()?>admin/course/updateppt",
            data: formData,
            type: "post",
            headers: { 'IsAjax': 'true' },
            processData: false,
            contentType: false,
            dataType:'json',
            success: function(data){
                if (data.code=="404") {
                    $('#uvmsg').html(data.msg);
                }
                else{
                     swal("ppts updated successfully!", "", "success");
                    setTimeout(function () {
                        swal.close();
                       location.reload();
                    }, 1000); 
                }
            }
        });
    });
    $('.updatetest').click(function(){
    var id=$(this).val();
    var title=$('#uttitle_'+id).val();
    var pmarks=$('#utpmarks_'+id).val();
    var duration=$('#utduration_'+id).val();
    var minutes=$('#utminutes_'+id).val();
    var instructions=tinyMCE.editors[$('#utinstructions_'+id).attr('id')].getContent();
    $.ajax({
    url:"<?php echo base_url(); ?>admin/test/updatetest",
        method:"POST",
        data:{id:id,title:title,pmarks:pmarks,duration:duration,instructions:instructions},
        dataType:'json',
        success:function(data)
        {
          if(data.code=="404"){
            $('#utmsg_'+id).html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
          }
          else{
            swal("Test updated successfully!", "", "success");
            setTimeout(function () {
              swal.close();
              location.reload();
            }, 2000);
          }
        }
      });
    });
    $('body').on('click', '.updatelac', function(){ 
        var formData=new FormData();
        var lid=$(this).val();
        var title=$('#uctitle_'+lid).val();
       
        var bid=$('#ubatch_id_'+lid).val();
        var tid=$('#uteacher_id_'+lid).val();
        var ldate=$('#ulecture_date_'+lid).val();
        var stime=$('#ustart_time_'+lid).val();
        var etime=$('#uend_time_'+lid).val();
        var note=$('#unote_'+lid).val();
        // var desc=tinyMCE.editors[$('#uldesc_'+lid).attr('id')].getContent();
        formData.append('lid', lid);
        formData.append('title', title);
        formData.append('bid', bid);
        formData.append('ldate', ldate);
        formData.append('tid', tid);
        formData.append('stime', stime);
        formData.append('etime', etime);
        formData.append('note', note);
        $.ajax({
            url: "<?= base_url()?>admin/course/updatcourselecture",
            data: formData,
            type: "post",
            headers: { 'IsAjax': 'true' },
            processData: false,
            contentType: false,
            dataType:'json',
            success: function(data){
                if (data.code=="404") {
                    $('#usmsg_'+lid).html(data.msg);
                }
                else{
                     swal("Lecture updated successfully!", "", "success");
                    setTimeout(function () {
                        swal.close();
                       location.reload();
                    }, 1000); 
                }
            }
        });
    });
    $('body').on('click', '.updatelecture', function(){ 
        var formData=new FormData();
        var lid=$(this).val();
        var title=$('#ultitle_'+lid).val();
        var desc=tinyMCE.editors[$('#uldesc_'+lid).attr('id')].getContent();
        var lstarturl=$('#ulstarturl_'+lid).val();
        var ldate=$('#uldate_'+lid).val();
        var lectid=$('#ulectid_'+lid).val();
        var lstime=$('#ulstime_'+lid).val();
        var letime=$('#uletime_'+lid).val();
        var lpass=$('#ulpass_'+lid).val();
        var image=$('input[name="ulimage_'+lid+'"]').get(0).files[0];
        var eimage=$('#uleimage_'+lid).val();
        formData.append('lid', lid);
        formData.append('title', title);
        formData.append('desc', desc);
        formData.append('ldate', ldate);
        formData.append('lpass', lpass);
        formData.append('image', image);
        formData.append('eimage', eimage);
        formData.append('lstarturl', lstarturl);
        formData.append('lectid', lectid);
        formData.append('lstime', lstime);
        formData.append('letime', letime);
        $.ajax({
            url: "<?= base_url()?>admin/course/updatelive",
            data: formData,
            type: "post",
            headers: { 'IsAjax': 'true' },
            processData: false,
            contentType: false,
            dataType:'json',
            success: function(data){
                if (data.code=="404") {
                    $('#usmsg_'+lid).html(data.msg);
                }
                else{
                     swal("Lecture updated successfully!", "", "success");
                    setTimeout(function () {
                        swal.close();
                       location.reload();
                    }, 1000); 
                }
            }
        });
    });
    $('body').on('click', '.start', function(){
        $(this).attr("disabled", true);
        var id=$(this).val();
        $.ajax({
            url:"<?php echo base_url(); ?>admin/schedule/startlecture",
            method:"POST",
            data:{id:id},
            dataType:'json',
            success:function(data)
            {
        $(this).attr("disabled", false);
            //setInterval(setTime, 1000);
                // $('#endmeetingmodal').toggle('show');
                // $('#end').val(room);
        var size=$(window).width();
        swal("Lecture started successfully!", "", "success");
                setTimeout(function () {
                            swal.close();
                        }, 2000);     
            if(size<768){
            location.href=data.meetingurl;
        }
        else{
            window.open(data.meetingurl, '_blank');
        }
            }
        })
    });
    $('body').on('click', '.updatefquestion', function(){ 
        var formData=new FormData();
        var qid=$(this).val();
        var fquestion=tinyMCE.editors[$('#fquestion_'+qid).attr('id')].getContent();
        var fanswer=tinyMCE.editors[$('#fanswer_'+qid).attr('id')].getContent();
        formData.append('fquestion', fquestion);
        formData.append('fanswer', fanswer);
        formData.append('qid', qid);
        $.ajax({
            url: "<?= base_url()?>admin/course/updateqaquestion",
            data: formData,
            type: "post",
            headers: { 'IsAjax': 'true' },
            processData: false,
            contentType: false,
            dataType:'json',
            success: function(data){
                if (data.code=="404") {
                    $('#fmsg_'+qid).html(data.msg);
                }
                else{
                     swal("Question updated successfully!", "", "success");
                    setTimeout(function () {
                        swal.close();
                       location.reload();
                    }, 1000); 
                }
            }
        });
    });
    $('body').on('click', '.deletelquestion', function(){ 
        var sid=$(this).val();
        
        $.ajax({
            url: "<?= base_url()?>admin/course/deletetest",
            data: {sid:sid},
            type: "post",
            success: function(data){
                 swal("Last year test deleted successfully!", "", "success");
                    setTimeout(function () {
                        swal.close();
                       location.reload();
                    }, 1000); 
            }
        });
    });

    $('body').on('click', '.deletevideo', function(){ 
        var lid=$(this).val();
        
        $.ajax({
            url: "<?= base_url()?>admin/course/deletesectionlecture",
            data: {lid:lid},
            type: "post",
            success: function(data){
                 swal("Video deleted successfully!", "", "success");
                    setTimeout(function () {
                        swal.close();
                       location.reload();
                    }, 1000); 
            }
        });
    });
    $('body').on('click', '.deleteppt', function(){ 
        var lid=$(this).val();
        
        $.ajax({
            url: "<?= base_url()?>admin/course/deletesectionlecture",
            data: {lid:lid},
            type: "post",
            success: function(data){
                swal("ppt deleted successfully!", "", "success");
                setTimeout(function () {
                    swal.close();
                    location.reload();
                }, 1000); 
            }
        });
    });

    $('body').on('click', '.deleteworksheet', function(){ 
        var wid=$(this).val();
        
        $.ajax({
            url: "<?= base_url()?>admin/course/deleteworkshet",
            data: {wid:wid},
            type: "post",
            success: function(data){
                swal("WorkSheet deleted successfully!", "", "success");
                setTimeout(function () {
                    swal.close();
                    location.reload();
                }, 1000); 
            }
        });
    });
    $('body').on('click', '.deletequew', function(){ 
        var qid=$(this).val();
        
        $.ajax({
            url: "<?= base_url()?>admin/course/deletequew",
            data: {qid:qid},
            type: "post",
            success: function(data){
                swal("Question deleted successfully!", "", "success");
                setTimeout(function () {
                    swal.close();
                    location.reload();
                }, 1000); 
            }
        });
    });
    $('body').on('click', '.deleteexam', function(){ 
        var eid=$(this).val();
        
        $.ajax({
            url: "<?= base_url()?>admin/course/deleteexam",
            data: {eid:eid},
            type: "post",
            success: function(data){
                swal("Exam deleted successfully!", "", "success");
                setTimeout(function () {
                    swal.close();
                    location.reload();
                }, 1000); 
            }
        });
    });
    $('body').on('click', '.deleteassign', function(){ 
        var aid=$(this).val();
        
        $.ajax({
            url: "<?= base_url()?>admin/course/deleteassignment",
            data: {aid:aid},
            type: "post",
            success: function(data){
                swal("Assignment deleted successfully!", "", "success");
                setTimeout(function () {
                    swal.close();
                    location.reload();
                }, 1000); 
            }
        });
    });
    // 
    $('body').on('click', '.deletelac', function(){ 
        var lid=$(this).val();
        
        $.ajax({
            url: "<?= base_url()?>admin/course/deletelecture",
            data: {lid:lid},
            type: "post",
            success: function(data){
                 swal("Course deleted successfully!", "", "success");
                    setTimeout(function () {
                        swal.close();
                       location.reload();
                    }, 1000); 
            }
        });
    });
    $('body').on('click', '.publishlac', function(){ 
        var lid=$(this).val();
        
        $.ajax({
            url: "<?= base_url()?>admin/course/publishlectures",
            data: {lid:lid},
            type: "post",
            success: function(data){
                 swal("Publish course successfully!", "", "success");
                    setTimeout(function () {
                        swal.close();
                       location.reload();
                    }, 1000); 
            }
        });
    });
    $('body').on('click', '.publishwork', function(){ 
        var wid=$(this).val();
        
        $.ajax({
            url: "<?= base_url()?>admin/course/publishworksheet",
            data: {wid:wid},
            type: "post",
            success: function(data){
                 swal("Publish worksheet successfully!", "", "success");
                    setTimeout(function () {
                        swal.close();
                       location.reload();
                    }, 1000); 
            }
        });
    });
    $('body').on('click', '.unpublishwork', function(){ 
        var wid=$(this).val();
        
        $.ajax({
            url: "<?= base_url()?>admin/course/unpublishworksheet",
            data: {wid:wid},
            type: "post",
            success: function(data){
                 swal("UnPublish worksheet successfully!", "", "success");
                    setTimeout(function () {
                        swal.close();
                       location.reload();
                    }, 1000); 
            }
        });
    });
    $('body').on('click', '.publishassin', function(){ 
        var aid=$(this).val();
        
        $.ajax({
            url: "<?= base_url()?>admin/course/publishassingment",
            data: {aid:aid},
            type: "post",
            success: function(data){
                 swal("Publish Assignment successfully!", "", "success");
                    setTimeout(function () {
                        swal.close();
                       location.reload();
                    }, 1000); 
            }
        });
    });
    $('body').on('click', '.unpublishassin', function(){ 
        var aid=$(this).val();
        
        $.ajax({
            url: "<?= base_url()?>admin/course/unpublishassingment",
            data: {aid:aid},
            type: "post",
            success: function(data){
                 swal("UnPublish Assignment successfully!", "", "success");
                    setTimeout(function () {
                        swal.close();
                       location.reload();
                    }, 1000); 
            }
        });
    });
    $('body').on('click', '.publishexamm', function(){ 
        var aid=$(this).val();
        
        $.ajax({
            url: "<?= base_url()?>admin/course/publishexamm",
            data: {aid:aid},
            type: "post",
            success: function(data){
                 swal("Publish Assignment successfully!", "", "success");
                    setTimeout(function () {
                        swal.close();
                       location.reload();
                    }, 1000); 
            }
        });
    });
    $('body').on('click', '.unpublishexamm', function(){ 
        var aid=$(this).val();
        
        $.ajax({
            url: "<?= base_url()?>admin/course/unpublishexamm",
            data: {aid:aid},
            type: "post",
            success: function(data){
                 swal("UnPublish Assignment successfully!", "", "success");
                    setTimeout(function () {
                        swal.close();
                       location.reload();
                    }, 1000); 
            }
        });
    });
    $('body').on('click', '.publishqw', function(){ 
        var aid=$(this).val();
        
        $.ajax({
            url: "<?= base_url()?>admin/course/publishqw",
            data: {aid:aid},
            type: "post",
            success: function(data){
                 swal("Publish Question Writing successfully!", "", "success");
                    setTimeout(function () {
                        swal.close();
                       location.reload();
                    }, 1000); 
            }
        });
    });
    $('body').on('click', '.unpublishqw', function(){ 
        var aid=$(this).val();
        
        $.ajax({
            url: "<?= base_url()?>admin/course/unpublishqw",
            data: {aid:aid},
            type: "post",
            success: function(data){
                 swal("UnPublish Question Writing successfully!", "", "success");
                    setTimeout(function () {
                        swal.close();
                       location.reload();
                    }, 1000); 
            }
        });
    });
    $('body').on('click', '.unpublishlac', function(){ 
        var lid=$(this).val();
        
        $.ajax({
            url: "<?= base_url()?>admin/course/unpublishlectures",
            data: {lid:lid},
            type: "post",
            success: function(data){
                 swal("UnPublish course successfully!", "", "success");
                    setTimeout(function () {
                        swal.close();
                       location.reload();
                    }, 1000); 
            }
        });
    });
    // 
    $('body').on('click', '.deletestudy', function(){ 
        var lid=$(this).val();
        
        $.ajax({
            url: "<?= base_url()?>admin/course/deletesectionlecture",
            data: {lid:lid},
            type: "post",
            success: function(data){
                 swal("Study material deleted successfully!", "", "success");
                    setTimeout(function () {
                        swal.close();
                       location.reload();
                    }, 1000); 
            }
        });
    });
    $('body').on('click', '.deletetest', function(){ 
        var sid=$(this).val();
        
        $.ajax({
            url: "<?= base_url()?>admin/course/deletetest",
            data: {sid:sid},
            type: "post",
            success: function(data){
                
            }
        });
    });
    $('body').on('click', '#ctest', function(){ 
        var tid=0;
        $('#test').load("<?=base_url();?>admin/course/newtest/<?=$topic[0]->Id;?>");
    });
    $('body').on('click', '#cltest', function(){ 
        var tid=0;
        $('#lquestions').load("<?=base_url();?>admin/course/newlqtest/<?=$topic[0]->Id;?>");
    });
    $('body').on('click', '.tdetails', function(){ 
        var tid=this.id;
        $('#test').load("<?=base_url();?>admin/course/testdetails/"+tid);
    });
    $('body').on('click', '.ltdetails', function(){ 
        var tid=this.id;
        $('#lquestions').load("<?=base_url();?>admin/course/testdetails/"+tid);
    });
    $('body').on('click', '.deletelecture', function(){ 
        var lid=$(this).val();
        $.ajax({
            url: "<?= base_url()?>admin/course/deletelecture",
            data: {lid:lid},
            type: "post",
            success: function(data){
                 swal("Lecture deleted successfully!", "", "success");
                    setTimeout(function () {
                        swal.close();
                       location.reload();
                    }, 1000); 
            }
        });
    });
    $('body').on('click', '.deletequestion', function(){ 
        var qid=$(this).val();
        
        $.ajax({
            url: "<?= base_url()?>admin/course/deletequestion",
            data: {qid:qid},
            type: "post",
            success: function(data){
                 swal("Question deleted successfully!", "", "success");
                    setTimeout(function () {
                        swal.close();
                       location.reload();
                    }, 1000); 
            }
        });
    });
    $('body').on('click', '#allowpreview', function(){ 
        var tid=$(this).val();
        
        $.ajax({
            url: "<?= base_url()?>admin/course/allowpreview",
            data: {tid:tid},
            type: "post",
            success: function(data){
               swal("Preview allowed successfully!", "", "success");
                    setTimeout(function () {
                        swal.close();
                        location.reload();
                    }, 2000); 
            }
        });
    });
     $('body').on('click', '#disablepreview', function(){ 
        var tid=$(this).val();
        
        $.ajax({
            url: "<?= base_url()?>admin/course/disablepreview",
            data: {tid:tid},
            type: "post",
            success: function(data){
               swal("Preview disabled successfully!", "", "success");
                    setTimeout(function () {
                        swal.close();
                        location.reload();
                    }, 2000); 
            }
        });
    });
     $('body').on('click', '.nav-link', function(){ 
        var tab=$(this).attr('href').replace('#','');

         window.history.replaceState(null, null,"<?=base_url();?>admin/course/coursedetail/curriculum/topic_lecture/<?=$topic[0]->Id;?>/"+tab);
    });
    var activeTab='';
    var url = window.location.href;
    var urlsplit = url.split("/");
    var tab = urlsplit[urlsplit.length-1];
    console.log(tab);
    var tabs=["video", "test", "ppt", "live", "forum", "lquestions"];
    if(tab!=""){
        if (tabs.indexOf(tab)>-1) {
            $(".nav-link").removeClass("active");
            $(".tab-pane").removeClass("active");
            $("#" + tab).addClass("active");
            $('#'+tab+'-tab').addClass('active');
        }
    }
    $('#esection').click(function(){
        $('#sectiontitle').css("display","none");
        $('#sbtns').css("display","inline-block");
        $('#utopictitle').css("display","inline-block");
    })
    $('#csection').click(function(){
        $('#sectiontitle').css("display","inline-block");
        $('#sbtns').css("display","none");
        $('#utopictitle').css("display","none");
    })
     $('#utopic').click(function(){
        var tid=$(this).val();
        var title=$('#utopictitle').val();
        $.ajax({
            url: "<?= base_url()?>admin/course/updatetopic",
            data: {tid:tid,title:title},
            type: "post",
            dataType: "json",
            success: function(data){
                if(data.code=="200"){
                    $('#sectiontext').html(title);
                    $('#sectiontitle').css("display","inline-block");
                    $('#sbtns').css("display","none");
                    $('#utopictitle').css("display","none");
                }
            }
        });
    })
</script>