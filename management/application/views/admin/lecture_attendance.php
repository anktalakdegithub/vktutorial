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
                <h2 class="st_title"><i class="uil uil-analysis"></i>Lecture Attendance: </h2>
                <br>
            </div>
            <div class="col-md-4 col-12 text-right">
        
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 order-12 order-md-1 card card-body">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Student Name</th>
                            <th scope="col">In time</th>
                            <th scope="col">Out time</th>
                            <th scope="col">Remark</th>
                            <th scope="col">Absent/Present</th>

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
                            
                            <td><?php  echo $stu['in_time']; ?></td>
                            <td><?php  echo $stu['out_time']; ?></td>
                            <td><?php  echo $stu['remark']; ?></td>
                            <td>
                                <?php
$to_time = strtotime("2008-12-13".$stu['in_time']);
$from_time = strtotime("2008-12-13 ".$lecture[0]->start_time);
$diff= round(abs($to_time - $from_time) / 60,2);
                                   if($stu['is_absent']==0){
                                  /*  if($stu['in_time']<=$lecture[0]->start_time && $stu['out_time']>=$lecture[0]->end_time){ */    
 if($diff<=15 && $stu['out_time']>=$lecture[0]->end_time){     
                                    echo "<span class='badge badge-pill badge-success'>Present</span>";
                                   
                                    }
                                        else {
                                    echo "<span class='badge badge-pill badge-danger'>Absent</span>";
                                   }
                                    }
                                    else if($stu['is_absent']=='' || $stu['is_absent']==1){
                                         echo "<span class='badge badge-pill badge-danger'>Absent</span>";
                                   
                                   }

                                   else{
                                    echo "<span class='badge badge-pill badge-danger'>Absent</span>";
                                   }
                                   
                                ?>
                                
                                <?php 
                                   if($stu['is_late']==1){
                                    echo "<span class='badge badge-pill badge-warning'>Late</span>";
                                   }
                                   
                                ?>

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

        $('body').on('click', '.updateassignment', function(){ 
        var formData=new FormData();
        
        var aid=$(this).val();
        // var aabsent=$('#aabsent_'+aid).val();
    
        var aabsent="";
        if( $('#aabsent_'+aid).attr( 'type' ) === 'checkbox' ) {
            aabsent += $('#aabsent_'+aid).is( ':checked' ) ? 1: 0;
        }
        var asumitted="";
        if( $('#asubmitted_'+aid).attr( 'type' ) === 'checkbox' ) {
            asumitted += $('#asubmitted_'+aid).is( ':checked' ) ? 1: 0;
        }

        var aremark=$('#aremark_'+aid).val();
        formData.append('aabsent', aabsent);
        formData.append('asumitted', asumitted);
        formData.append('aremark', aremark);
        formData.append('aid', aid);
        $.ajax({
            url: "<?= base_url()?>admin/course/updateassignment",
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
       // 
       $('body').on('click', '.deleteassignment', function(){ 
        var aid=$(this).val();
        
        $.ajax({
            url: "<?= base_url()?>admin/course/deleteassignmentsingle",
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
        </script>