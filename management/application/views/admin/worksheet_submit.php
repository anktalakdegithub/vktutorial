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
                <h2 class="st_title"><i class="uil uil-analysis"></i>Worksheet Submitted</h2>
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
                <!-- <a href="<?=base_url();?>admin/Attendance/attendance" class="btn btn-default steps_btn" style="padding-top: 10px !important;">Add Score</a>   -->
                <!-- Button trigger modal -->
                <a href="<?=base_url();?>admin/course/add_worksheet_submitted?worksheet_id=<?=$worksheet_id;?>&batch_id=<?=$batch_id;?>" class="btn btn-primary">
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
                                <!-- <div class="input-group"> -->

                                <input type="text" data-plugin="dropify" data-default-file="" value=""
                                    class="prompt srch_explore" name="source" readonly />

                                <!-- </div> -->
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
                            <th scope="col">Worksheet Name</th>
                            <th scope="col">Remark</th>
                            <th scope="col">Submitted</th>
                            <th scope="col">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                                $i = 0;
                                foreach($students as $stu){
                                   
                                    $stu = json_encode($stu);
                                    $stu = json_decode($stu,true);
                                 
                                ?>
                        <tr>
                            <th scope="row"><?php echo ++$i; ?></th>
                            <td><?php echo $stu['FirstName'].' '.$stu['MiddleName'].' '.$stu['LastName'] ; ?></td>
                            
                            <td><?php  echo $stu['remark']; ?></td>
                            <td>
                                <?php 
                                   if($stu['is_submitted']==1){
                                    echo "<span class='badge badge-pill badge-success'>Submitted</span>";
                                   }
                                   else{
                                    echo "<span class='badge badge-pill badge-danger'>Not Submitted</span>";
                                   }
                                   
                                ?>

                                <?php 
                                   if($stu['is_late']==1){
                                    echo "<span class='badge badge-pill badge-warning'>Late</span>";
                                   }
                                   
                                ?>

                            </td>
                            <td>
                                <button class="add_data btn btn-default" data-toggle="modal" data-id="6"
                                    data-toggle="modal" data-target="#exampleModaledit_<?=$stu['id']?>"><i
                                        class="fa fa-edit"></i></button>
                                <div class="modal fade" id="exampleModaledit_<?=$stu['id']?>" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5>Worksheet Title</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="ui search focus lbel25 mt-30 d-flex">
                                                    <label>Is Submitted</label>
                                                    <div class="ui left icon">
                                                            <input type="checkbox" id="asubmitted_<?=$stu['id']?>" class="is_submitted mx-2"  name="is_submitted" <?php if ($stu['is_submitted']==1) {echo "checked";} ?>>
                                                    </div>
                                                </div>
                                                <div class="ui search focus lbel25 d-flex">
                                                    <label>Is Late Submitted</label>
                                                    <div class="ui left icon">
                                                            <input type="checkbox"  id="late_<?=$stu['id']?>" class="is_absent mx-2" name="is_late" <?php if ($stu['is_late']==1) {echo "checked";} ?>>
                                                    </div>
                                                </div>
                                                <div class="ui search focus lbel25 mt-30">
                                                    <label>Remark</label>
                                                    <div class="ui left icon input swdh19">
                                                        <input class="prompt srch_explore" type="text" id="aremark_<?=$stu['id']?>"
                                                            value="<?=$stu['remark']?>">
                                                    </div>
                                                </div>
                                                <div id="qmsg"></div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary updateassignment" value="<?=$stu['id']?>">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="add_data btn btn-default" data-toggle="modal" data-id="6"
                                    data-toggle="modal" data-target="#exampleModaldelete_<?=$stu['id']?>"><i
                                        class="fa fa-trash"></i></button>
                                <div class="modal fade" id="exampleModaldelete_<?=$stu['id']?>" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                <button type="button" class="btn btn-primary deleteassignment" value="<?=$stu['id']?>">Yes</button>
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
            // $('#get_report').click(function(){

            let batch_id = document.querySelector("#batch_id").value;
            let date = document.querySelector("#date").value;
            let type = document.querySelector("#type").value;
            location.href = "Attendance?batch_id=" + batch_id + "&date=" + date + "&type=" + type;
            //   })
            // var sids=[];
            // $( ".courses" ).each(function() {
            // sids.push($(this).attr('id'));
            // });
            // console.log(sids);
            // $.ajax({
            // url: "<?= base_url()?>admin/course/sort_order_courses",
            // data: {sids:sids},
            // type: "post",
            // success: function(data){
            //         swal("Sort order updated successfully!", "", "success");
            //     setTimeout(function () {
            //             swal.close();
            //             location.reload();
            //         }, 2000);
            // }
            // });
        });
         // 

         $('body').on('click', '.updateassignment', function(){ 
        var formData=new FormData();
        
        var aid=$(this).val();
        // var aabsent=$('#aabsent_'+aid).val();
    
        var is_late="";
        if( $('#late_'+aid).attr( 'type' ) === 'checkbox' ) {
            is_late += $('#late_'+aid).is( ':checked' ) ? 1: 0;
        }
        var asumitted="";
        if( $('#asubmitted_'+aid).attr( 'type' ) === 'checkbox' ) {
            asumitted += $('#asubmitted_'+aid).is( ':checked' ) ? 1: 0;
        }

        var aremark=$('#aremark_'+aid).val();
        formData.append('is_late', is_late);
        formData.append('asumitted', asumitted);
        formData.append('aremark', aremark);
        formData.append('aid', aid);
        $.ajax({
            url: "<?= base_url()?>admin/course/updateworksheets",
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
                    swal("Worksheet updated successfully!", "", "success");
                    setTimeout(function () {
                        swal.close();
                       location.reload();
                    }, 1000); 
                }
            }
        });
    });
         // 
       $('body').on('click', '.deleteassignment', function(){ 
        var aid=$(this).val();
        
        $.ajax({
            url: "<?= base_url()?>admin/course/deleteworksingle",
            data: {aid:aid},
            type: "post",
            success: function(data){
                 swal("Worksheet deleted successfully!", "", "success");
                    setTimeout(function () {
                        swal.close();
                      location.reload();
                    }, 1000); 
            }
        });
    });
        </script>