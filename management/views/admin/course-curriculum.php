<style type="text/css">
  .utopictitle{
    display: none;
  }
  .sbtns{
    display: none;
  }
  .updatesort
  {
    display: none;
  }
</style>
<div class="title-icon">
  <div class="row">
    <div class="col-md-6">
     <a href="<?=base_url();?>admin/course/coursedetail/information/<?=$cid;?>" class="title" style="display: inline-block;"><i class="fas fa-arrow-left"></i></a>&nbsp;&nbsp;
    <h3 class="title" style="display: inline-block;"><i class="uil uil-film"></i>Course Curriculum</h3>
    </div>
    <div class="col-md-6 text-right">
      <button type="button" data-direction="next" class="updatesort btn btn-default steps_btn">Update Sorting</button>  
      <button class="btn steps_btn" value="<?=$cid;?>" id="viewsection">New Section</button>
    </div>
  </div>
</div>
  <div class="container">
    <div class="row">
        <div class="col-md-12" id="sortable">
          <?php
          $i=0;

          foreach ($sections as $section) {
          ?>
          <div class="sections" id="<?=$section->Id;?>">
      
            <div class="card">
              <div class="card-body">

                <div class="row">
                  <div class="col-md-1">
                    <img src="<?=$section->Thumbnail;?>" style="width: 100%;">
                  </div>
                  <div class="col-md-9" data-toggle="collapse" href="#collapselect_<?=$section->Id;?>">
                      <div class="row">
  <div class="col-md-6">
    <h4 id="sectiontitle_<?=$section->Id;?>"><span id="sectiontext_<?=$section->Id;?>" data-toggle="collapse" data-target="#collapsesection_<?=$section->Id;?>" style="cursor: pointer;"><?=$section->Title;?></span>&nbsp;&nbsp;<button class="esection btn btn-default" style="font-size: 20px;" value="<?=$section->Id;?>"><i class="fas fa-edit"></i></button></h4>
        <input type="text" class="utopictitle form-control" value="<?=$section->Title;?>" id="utopictitle_<?=$section->Id;?>" style="width: 100%;">
    </div>
    <div class="col-md-2">
        <div class ="sbtns" id="sbtns_<?=$section->Id;?>">
            <button class="usection btn btn-default" value="<?=$section->Id;?>" style="font-size: 20px;"><i class="fas fa-check-circle"></i></button>
            <button class="csection btn btn-default" value="<?$section->Id;?>" style="font-size: 20px;"><i class="fas fa-times-circle"></i></button>
        </div>
  </div></div>
                      
                  
                </div>
                  <div class="col-md-2 text-right">
                    <button type="button" class="btn btn-default viewtopics" value="<?=$section->Id;?>" style="text-decoration: underline;">sort topics</button>
                     <button class="btn btn-default" value="<?=$cid;?>" data-toggle="modal" data-target="#deletesectionModal_<?=$section->Id;?>"><i class="fas fa-times-circle"></i></button>
                  </div>
                </div>
                <div class="collapse row" id="collapsesection_<?=$section->Id;?>">
                        <div class="col-md-12" style="padding-left: 20px;"><br>
                            <?php 
                              foreach ($topics[$i] as $topic) {
                                ?>
                                <div class="row">
                                  <div class="col-md-8" data-toggle="collapse" href="#collapselect_<?=$topic->Id;?>" style="padding-left: 20px;">
                                      <a href="#" class="topic_details" id="<?=$topic->Id;?>"><h4><span><?=$topic->Topic;?></span>&nbsp;&nbsp;</h4>
                                      </a>
                                  </div>
                                  <div class="col-md-4 text-right">
                                     <button class="btn btn-default" value="<?=$cid;?>" data-toggle="modal" data-target="#deletetopicModal_<?=$topic->Id;?>"><i class="fas fa-times-circle"></i></button>
                                  </div>
                                </div><hr>

    <div class="modal" data-keyboard="false" data-backdrop="static" id="deletetopicModal_<?=$topic->Id;?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <h5 class="modal-title" id="deletetopicModal_<?=$topic->Id;?>">Are you sure you want to delete this topic?</h5><br>
                    <div id="vmsg"></div>
                <button class="deletetopic btn steps_btn" value="<?=$topic->Id;?>">Yes</button>
                <button class="btn btn-default" data-dismiss="modal">No</button>
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
                        <div class="col-md-12" style="padding-left: 20px;"><br>
                          <button class="newtopic btn btn-default text-primary" value="<?=$section->Id;?>">+ Add New Topic</button>
                        </div>
                      </div>
              </div>
            </div><br>
    <div class="modal" data-keyboard="false" data-backdrop="static" id="deletesectionModal_<?=$section->Id;?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <h5 class="modal-title" id="deletesectionModal">Are you sure you want to delete this section?</h5><br>
                    <div id="vmsg"></div>
                <button class="deletesection btn steps_btn" value="<?=$section->Id;?>">Yes</button>
                <button class="btn btn-default" data-dismiss="modal">No</button>
              </div>
            </div>
        </div>
    </div></div>
          <?php
            $i++;
          }
          ?>
    </div>
  </div>
<script type="text/javascript">
 $("#sortable").sortable({
        update: function (event, ui) {
    $('.updatesort').css("display","inline-block");
        }
    });
 $('.updatesort').click(function(){
  var sids=[];
   $( ".sections" ).each(function() {
    sids.push($(this).attr('id'));
  });
   $.ajax({
        url: "<?= base_url()?>admin/course/sort_order_sections",
        data: {sids:sids},
        type: "post",
        success: function(data){
             swal("Sort order updated successfully!", "", "success");
          setTimeout(function () {
                  swal.close();
                  location.reload();
              }, 2000);
        }
 });
 });
  $('body').on('click', '#publishsection', function(){ 
        var sid=$(this).val();
        
        $.ajax({
            url: "<?= base_url()?>admin/course/publishsection",
            data: {sid:sid},
            type: "post",
            success: function(data){
               swal("section published successfully!", "", "success");
                    setTimeout(function () {
                        swal.close();
                       location.reload();
                    }, 2000); 
            }
        });
    });
  $('#viewsection').click(function(){
    var cid=$(this).val();
    window.history.replaceState(null, null,"<?=base_url();?>admin/course/coursedetail/curriculum/newsection/"+cid);
    $('#loadcontent').load("<?=base_url();?>admin/course/newsection/"+cid);
  })
  $('.viewtopics').click(function(){
    var sid=$(this).val();
    window.history.replaceState(null, null,"<?=base_url();?>admin/course/coursedetail/curriculum/topics/"+sid);
    $('#loadcontent').load("<?=base_url();?>admin/course/viewtopics/"+sid);
  })
   $('.newtopic').click(function(){
    var sid=$(this).val();
    window.history.replaceState(null, null,"<?=base_url();?>admin/course/coursedetail/curriculum/section/newtopic/"+sid);
    $('#loadcontent').load("<?=base_url();?>admin/course/new_section_topic/"+sid);
  })
   $('.topic_details').click(function(){
    var tid=this.id;
    window.history.replaceState(null, null,"<?=base_url();?>admin/course/coursedetail/curriculum/topic_lecture/"+tid);
    $('#loadcontent').load("<?=base_url();?>admin/course/topic_lecture/"+tid);
  })
    $('body').on('click', '.deletesection', function(){ 
        var sid=$(this).val();
        
        $.ajax({
            url: "<?= base_url()?>admin/course/deletesection",
            data: {sid:sid},
            type: "post",
            success: function(data){
              $('#deletesectionModal_'+sid).modal('hide');
              location.reload();
            }
        });
    });
    $('body').on('click', '.deletetopic', function(){ 
        var tid=$(this).val();
        
        $.ajax({
            url: "<?= base_url()?>admin/course/deletetopic",
            data: {tid:tid},
            type: "post",
            success: function(data){
              $('#deletetopicModal_'+tid).modal('hide');
              location.reload();
            }
        });
    });
    $('.esection').click(function(){
      var sid=$(this).val();
       window.history.replaceState(null, null,"<?=base_url();?>admin/course/coursedetail/curriculum/editsection/"+sid);
      $('#loadcontent').load("<?=base_url();?>admin/course/editsection/"+sid);
    })
    $('.csection').click(function(){
      var sid=$(this).val();
        $('#sectiontitle_'+sid).css("display","inline-block");
        $('#sbtns_'+sid).css("display","none");
        $('#utopictitle_'+sid).css("display","none");
    })
     $('.usection').click(function(){
        var sid=$(this).val();
        var title=$('#utopictitle_'+sid).val();
        $.ajax({
            url: "<?= base_url()?>admin/course/updatesection",
            data: {sid:sid,title:title},
            type: "post",
            dataType: "json",
            success: function(data){
                if(data.code=="200"){
                    $('#sectiontext_'+sid).html(title);
                    $('#sectiontitle_'+sid).css("display","inline-block");
                    $('#sbtns_'+sid).css("display","none");
                    $('#utopictitle_'+sid).css("display","none");
                }
            }
        });
    });
   
</script>