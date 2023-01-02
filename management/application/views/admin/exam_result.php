<div class="sa4d25">
    <div class="container">
        <style type="text/css">
        .img-container {
            position: relative;
            display: inline-block;
        }

        .img-container .overlay {
            position: absolute;
            top: 0;
            left: 0;
            height: 180px;
            width: 100%;
            background: rgb(0, 0, 0, .5);
            opacity: 0;
            transition: opacity 500ms ease-in-out;
        }

        .img-container .overlay {
            opacity: 1;
        }

        .img-container:hover .overlay {
            opacity: 0.7;
        }

        .overlay span {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #fff;
        }

        .updatesort {
            display: none;
        }
        </style>
        <div class="row">
            <div class="col-md-8 col-12">
                <h2 class="st_title"><i class="uil uil-analysis"></i>Exam Result: </h2>
                <br>
            </div>
            <div class="col-md-4 col-12 text-right">
                <button type="button" data-direction="next" class="updatesort btn btn-default steps_btn">Update
                    Sorting</button>
                <?php 
         $access=$this->session->userdata('access');
         $course=array();
         $course=$access->courses;
         if(in_array("add", $course) || in_array("all", $course)){
           ?>
               
                 <a href="<?=base_url();?>admin/course/add_exam_submitted?exam_id=<?=$exam_id;?>&batch_id=<?=$batch_id;?>" class="btn btn-primary">
                    Add Submission
                </a>


                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <!-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> -->
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <label>Source</label>

                                <input type="text" data-plugin="dropify" data-default-file="" value=""
                                    class="prompt srch_explore" name="source" readonly />

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
         }
         ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 order-12 order-md-1">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Student Name</th>
                            <th scope="col">Marks</th>
                            <th scope="col">Pass/Fail/Absent</th>
                            <th scope="col">Remark</th>
                            <th scope="col">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                                $i = 0;
                                //print_r($exam);
                                foreach($students as $stu){
                                    $stu = json_encode($stu);
                                    $stu = json_decode($stu,true);
                                ?>
                        <tr>
                            <th scope="row"><?php echo ++$i; ?></th>
                            <td><?php echo $stu['FirstName'].' '.$stu['MiddleName'].' '.$stu['LastName'] ; ?></td>
                            <td><?=$stu['marks'];?></td>
                            <td> 
                                <?php 
                                 if($stu['is_absent']==1){
                                    echo "<span class='badge badge-pill badge-danger'>Absent</span>";
                                   }
                                   else{
                                   if($stu['marks']>=$exam[0]->passing_marks){
                                    echo "<span class='badge badge-pill badge-success'>Pass</span>";
                                   }
                                   else{
                                    echo "<span class='badge badge-pill badge-danger'>Fail</span>";
                                   }
                               }
                                   
                                ?>
                           </td>
                            <td><?php  echo $stu['remark']; ?></td>
                           
                            <td>
                                    <button class="add_data btn btn-default" data-toggle="modal" data-target="#exampleModaledit_<?=$stu['id']?>"><i class="fa fa-edit"></i></button> 
                                    <div class="modal fade" id="exampleModaledit_<?=$stu['id']?>" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5>Exam Title</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="ui search focus lbel25 d-flex">
                                                    <label>Is Absent</label>
                                                    <div class="ui left icon">
                                                            <input type="checkbox"  id="aabsent_<?=$stu['id']?>" class="is_absent mx-2" name="is_absent" <?php if($stu['is_absent']==1){ echo "checked"; } ?>>
                                                    </div>
                                                </div>
                                                <div class="ui search focus lbel25 mt-30">
                                                    <label>Mark</label>
                                                    <div class="ui left icon input swdh19">
                                                        <input class="prompt srch_explore" type="text" id="qmark_<?=$stu['id']?>"
                                                            value="<?=$stu['marks']?>">
                                                    </div>
                                                </div>
                                                <div class="ui search focus lbel25 mt-30">
                                                    <label>Remark</label>
                                                    <div class="ui left icon input swdh19">
                                                        <input class="prompt srch_explore" type="text" id="qremark_<?=$stu['id']?>"
                                                            value="<?=$stu['remark']?>">
                                                    </div>
                                                </div>
                                                <div id="qmsg"></div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary updateexam" value="<?=$stu['id']?>">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <button class="add_data btn btn-default" data-toggle="modal" data-target="#exampleModaldelete_<?=$stu['id']?>"><i class="fa fa-trash"></i></button> 
                                    <div class="modal fade" id="exampleModaldelete_<?=$stu['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">

                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary deleteexam" value="<?=$stu['id']?>">Yes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                           

                        </tr>
                        <?php
                                }
                                ?>


                    </tbody>
                </table>
            </div>
        </div>
        <script type="text/javascript">
        $("#load_data").sortable({
            update: function(event, ui) {
                $('.updatesort').css("display", "inline-block");
            }
        });
        $('.updatesort').click(function() {
            var sids = [];
            $(".courses").each(function() {
                sids.push($(this).attr('id'));
            });
            console.log(sids);
            $.ajax({
                url: "<?= base_url()?>admin/course/sort_order_courses",
                data: {
                    sids: sids
                },
                type: "post",
                success: function(data) {
                    swal("Sort order updated successfully!", "", "success");
                    setTimeout(function() {
                        swal.close();
                        location.reload();
                    }, 2000);
                }
            });
        });
        $('body').on('click', '.delete', function() {
            var id = $(this).val();
            $('#dmsg_' + id).html(
                '<div class="alert alert-primary"><i class="fa fa-spinner fa-spin"></i> Please wait course deleting....</div>'
                );
            $.ajax({
                url: "<?=base_url();?>admin/course/deletecourse",
                method: "POST",
                data: {
                    id: id
                },
                success: function(data) {
                    swal("course deleted successfully!", "", "success");
                    setTimeout(function() {
                        swal.close();
                        //  location.href="<?=base_url();?>admin/course";
                    }, 2000);
                }
            });
        })

        $('#filter').click(function() {
            let batch_id = document.querySelector("#batch_id").value;
            let date = document.querySelector("#date").value;
            let type = document.querySelector("#type").value;
            location.href = "Attendance?batch_id=" + batch_id + "&date=" + date + "&type=" + type;

        });

         // 

         $('body').on('click', '.updateexam', function(){ 
        var formData=new FormData();
        
        var aid=$(this).val();
        // var aabsent=$('#aabsent_'+aid).val();
    
        var aabsent="";
        if( $('#aabsent_'+aid).attr( 'type' ) === 'checkbox' ) {
            aabsent += $('#aabsent_'+aid).is( ':checked' ) ? 1: 0;
        }
     
        var qmark=$('#qmark_'+aid).val();
        var qremark=$('#qremark_'+aid).val();
        formData.append('aabsent', aabsent);
        formData.append('qmark', qmark);
        formData.append('qremark', qremark);
        formData.append('aid', aid);
        $.ajax({
            url: "<?= base_url()?>admin/course/updateexams",
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
                    swal("Exam updated successfully!", "", "success");
                    setTimeout(function () {
                        swal.close();
                       location.reload();
                    }, 1000); 
                }
            }
        });
    });
          // 
       $('body').on('click', '.deleteexam', function(){ 
        var aid=$(this).val();
        
        $.ajax({
            url: "<?= base_url()?>admin/course/deleteexamsingle",
            data: {aid:aid},
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
        </script>
