<div class="page-content">
  <h3>Answers Sheet</h3>
  <br>
  <div class="row">
    <div class="col-md-8 order-12 order-md-1">
      <div class="panel panel-default">
        <div class="panel-body">
          <br>
          <div id="load_data">
          </div>
          <div id="load_data_message"></div>
          <br />
          <br />
          <br />
          <br />
          <br />
          <br />
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
   $(document).ready(function(){

    var limit = 7;
    var start = 0;
    var action = 'inactive';

    function lazzy_loader(limit)
    {
      var output = '';
      for(var count=0; count<limit; count++)
      {
        output += '<div class="post_data">';
        output += '<p><span class="content-placeholder" style="width:100%; height: 30px;">&nbsp;</span></p>';
        output += '<p><span class="content-placeholder" style="width:100%; height: 100px;">&nbsp;</span></p>';
        output += '</div>';
      }
      $('#load_data_message').html(output);
    }

    lazzy_loader(limit);

    function load_data(limit, start)
    {
      var examid='<?=$test[0]->Id;?>'
      $.ajax({
        url:"<?php echo base_url(); ?>mcqtest/fetchanswersheet",
        method:"POST",
        data:{examid:examid,limit:limit, start:start},
        cache: false,
        success:function(data)
        {
          if(data == '')
          {
            $('#load_data_message').html('');
            action = 'active';
          }
          else
          {
            $('#load_data').append(data);
            $('#load_data_message').html("");
            action = 'inactive';
          }
        }
      })
    }

    if(action == 'inactive')
    {
      action = 'active';
      load_data(limit, start);
    }

    $(window).scroll(function(){
      if($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive')
      {
        lazzy_loader(limit);
        action = 'active';
        start = start + limit;
        setTimeout(function(){
          load_data(limit, start);
        }, 1000);
      }
    });

  });
    $('body').on('click', '.update', function(){
    var id=$(this).val();
    var qmarks=$('#qmarks_'+id).val();
  var question=tinyMCE.editors[$('#question_'+id).attr('id')].getContent();
  var aexplain=tinyMCE.editors[$('#aexplain_'+id).attr('id')].getContent();
  var options = [];
      $('input[name="options_'+id+'"]').each(function(checkbox) {
        options.push($(this).val());
      });
      var cans = [];
      $('input[name="canswer_'+id+'"]:checked').each(function(checkbox) {
        cans.push($(this).val());
      });
    $('#aqmsg_'+id).html('<div class="alert alert-primary"><i class="fa fa-spinner fa-spin"></i> Please wait test creating....</div>');
    $.ajax({
      url: "<?= base_url()?>mcqtest/updatequestion",
      type: "post",
      data:{id:id,question:question,options:options,cans:cans,qmarks:qmarks,aexplain:aexplain},
      success: function(data){
       // $("#submit").attr("disabled", false);
        $('#aqmsg_'+id).html("");
        if(data.code=="200"){
          swal("Mcq test created successfully!", "", "success");
            setTimeout(function () {
            swal.close();
          }, 2000);
        }
        else{
           $('#aqmsg_'+id).html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>')
        }
      }
    });
  });
</script>