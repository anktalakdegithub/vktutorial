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
                <h2 class="st_title"><i class="uil uil-analysis"></i>Courses</h2><br>
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
                <a href="<?=base_url();?>admin/course/newcourse" class="btn btn-default steps_btn"
                    style="padding-top: 10px !important;">Create course</a>
                <?php
        }
        ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 order-12 order-md-1 card card-body">
                <div class="row" id="load_data">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Price</th>
                                <th scope="col">Action</th>

                            </tr>
                        </thead>

                        <tbody id="students">
                            <?php
  $i=1;
foreach ($courses as $row) {
  $this->session->set_userdata('startid',$row->Id);
  ?>
                            <tr class="students">
                                <th scope="col"><?= $i;?></th>
                                <th scope="col"><?php if(strlen($row->Title)>20){
        ?>
                                    <a href="<?=base_url();?>admin/course/coursedetail/information/<?=$row->Id;?>"
                                        style="font-size:15px;font-weight:bold;"><?=substr($row->Title, 0, 20);?>....</a>
                                    <?php
      }
      else{
        ?>
                                    <a href="<?=base_url();?>admin/course/coursedetail/information/<?=$row->Id;?>" style="font-size:15px;font-weight:bold;"><?=$row->Title;?></a>
                                    <?php
      }?>
                                </th>
                                <th scope="col"><?php  if($row->Price!=0){ ?>
                                    <p style="color:black;">&#8377; <?=$row->Price;?></p>
                                    <?php
              }
              else{
              ?>
                                    <p style="color:black;">FREE</p>
                                    <?php
              }
              ?>
                                </th>
                                <th>
                                <?php 
 if(in_array("edit", $course) || in_array("all", $course)){
  ?>
                                <a class="add_data btn btn-default" href="<?=base_url();?>admin/course/coursedetail/information/<?=$row->Id;?>"><i class="fa fa-edit"></i></a> 
                                <?php 
}
if(in_array("delete", $course) || in_array("all", $course)){
?> 
                                <button class="add_data btn btn-default" data-toggle="modal"
                                        data-target="#deleteModal_<?=$row->Id;?>"><i class="fa fa-trash"></i></button>
                                        <?php 
}
?>
                                </th>
                            </tr>
                            <div class="modal" id="deleteModal_<?=$row->Id;?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <h3>Are you sure you want to delete this course?</h3>
                                            <div id="dmsg_<?=$row->Id;?>"></div>
                                            <button data-direction="next" class="delete btn btn-default steps_btn"
                                                value="<?=$row->Id;?>">Delete</button>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
$i++;
}
?>
                        </tbody>
                    </table>
                </div>

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
        </script>