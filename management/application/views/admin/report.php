<div class="sa4d25">
<div class="container">
<style type="text/css">
   .img-container{
   position:relative;
   display:inline-block;
   }
   .img-container .overlay{
   position:absolute;
   top:0;
   left:0;
   height: 180px;
   width:100%;
   background:rgb(0,0,0,.5);
   opacity:0;
   transition:opacity 500ms ease-in-out;
   }
   .img-container .overlay{
   opacity:1;
   }
   .img-container:hover .overlay{
   opacity:0.7;
   }
   .overlay span{
   position:absolute;
   top:50%;
   left:50%;
   transform:translate(-50%,-50%);
   color:#fff;
   }
   .updatesort
   {
   display: none;
   }
    th {
        text-align: center;
    }
    /* table {
        border-collapse: separate;
        border-spacing: 0 1em;
    } */
</style>
<div class="row">
   <div class="col-md-8 col-12">
      <h2 class="st_title"><i class="uil uil-analysis"></i>Report</h2>
      <br>
   </div>
   <div class="col-md-4 col-12 text-right">
   <button class="btn btn-success" id="btn-generate" >Download</button>
   <button id="button-a" class="btn btn-success">Create Excel</button>
      <button type="button" data-direction="next" class="updatesort btn btn-default steps_btn">Update Sorting</button>    
      <?php 
         $access=$this->session->userdata('access');
         $course=array();
         $course=$access->courses;
         if(in_array("add", $course) || in_array("all", $course)){
           ?>
      <!-- <a href="<?=base_url();?>admin/Attendance/attendance" class="btn btn-default steps_btn" style="padding-top: 10px !important;">Add Attendance</a>   -->
      <?php
         }
         ?>
   </div>
</div>

<div class="row">
   <div class="col-md-12 order-12 order-md-1">
        <div class="row">
            <div class="col-md-3 my-4">
                <div class="card">
                    <div class="card-body">
                    <label>Select Batch</label>
                        <div class="input-group">
                       
                            <select class="custom-select form-control" id="batch_id">
                                <option value="" selected>Choose...</option>
                                <?php 
                                foreach($batches as $batch){
                                ?>
                                 <option value="<?=$batch->Id;?>"><?php echo $batch->Name;?></option>
                                <?php } ?>
                                <option value="3">Three</option> -->
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 my-4">
                <div class="card">
                    <div class="card-body">
                    <label>Select Students</label>
                        <div class="input-group">
                       

                            <select class="custom-select form-control" id="student_id">
                                <option value="" selected>Choose...</option>
                                
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 my-4">
                <div class="card">
                    <div class="card-body">
                    <label>From Date</label>
                        <div class="input-group">
                       
                            <input type="date" class="form-control" value="" id="from_date">

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 my-4">
                <div class="card">
                    <div class="card-body">
                        <label>To Date</label>
                        <div class="input-group">
                            <!-- <i class="fa fa-calendar"></i>&nbsp;
                            <span></span> <i class="fa fa-caret-down ml-1"></i> -->
                            <input type="date" class="form-control" value="" id="to_date">
                        

                                <div class="input-group-append">
                                <button type="submit" class="btn btn-primary" id="filter"style="font-size: 19px;"><i class="fa fa-search"></i></button>
                            </div>
                            </div>
                    </div>
                </div>
            </div>

             <!-- <div class="col-md-4 my-3"> -->
           <!--     <div class="card">
                    <div class="card-body">
                    <label>Present/Absent</label>
                        <div class="input-group">
                           
                            <select class="custom-select form-control" id="type">
                                <option value="1">Present</option>
                                <option value="2">Absent</option>
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-primary" id="filter"style="font-size: 19px;"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>-->
            <!-- </div>  -->

        </div>
        <div class="container">
          <div class="card card-body">
            <div class="row" id="load_data">
            
            </div>
          </div>
        </div>
        <div align="center">
            <?php //$pagination?>
        </div>
   </div>
</div>

<script type="text/javascript">
  
$('body').on('change', '#batch_id', function(){ 
  getbatchstudents();
});
function getbatchstudents() {
  $.ajax({
    url:"<?=base_url();?>admin/batch/getbatchstudents",
      method:"POST",
      data:{'batch_id':$('#batch_id').val()},
      dataType: 'JSON',
      success:function(data)
      {
      var html='<option value="">Select student</option>';
      for(i=0;i<data.length;i++){
        html+='<option value="'+data[i].Id+'">'+data[i].FirstName+' '+data[i].LastName+'</option>'
      }
      $('#student_id').html(html);
      }
  });
}
   $('#filter').click(function(){
    // $('#get_report').click(function(){
       
        let student_id = document.querySelector("#student_id").value;
        let from_date = document.querySelector("#from_date").value;
        let to_date = document.querySelector("#to_date").value;
        let batch_id = document.querySelector("#batch_id").value;
    //    location.href="Attendance?batch_id="+batch_id+"&date="+date;
    //   })
        // var sids=[];
        // $( ".courses" ).each(function() {
        // sids.push($(this).attr('id'));
        // });
        // console.log(sids);
        $.ajax({
        url: "<?= base_url()?>admin/report/filter_report",
        data: {'student_id':student_id,'from_date':from_date,'to_date':to_date,'batch_id': batch_id},
        type: "get",
        success: function(data){
            //     swal("Sort order updated successfully!", "", "success");
            // setTimeout(function () {
            //         swal.close();
            //         location.reload();
            //     }, 2000);
            // console.log(data);
            $('#load_data').html(data);

        }
        });
   });
</script>

<script src="https://code.jquery.com/jquery-2.1.3.js"></script>
<script
  src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
<script
  src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>


<script>
$(document).ready(function(){
  $("#btn-generate").click(function(){
    var htmlWidth = $("#load_data").width();
    var htmlHeight = $("#load_data").height();
    var pdfWidth = htmlWidth + (15 * 2);
    var pdfHeight = (pdfWidth * 1.5) + (15 * 2);
    
    var doc = new jsPDF('p', 'pt', [pdfWidth, pdfHeight]);
  
    var pageCount = Math.ceil(htmlHeight / pdfHeight) - 1;
  
  
    html2canvas($("#load_data")[0], { allowTaint: true }).then(function(canvas) {
      canvas.getContext('2d');
  
      var image = canvas.toDataURL("image/png", 1.0);
      doc.addImage(image, 'PNG', 15, 15, htmlWidth, htmlHeight);

      for (var i = 1; i <= pageCount; i++) {
        doc.addPage(pdfWidth, pdfHeight);
        doc.addImage(image, 'PNG', 15, -(pdfHeight * i)+15, htmlWidth, htmlHeight);
      }
      
        doc.save("report.pdf");
    });
  });
});
  
       
$("#button-a").click(function(){
        // saveAs(new Blob([s2ab(wbout)],{type:"application/octet-stream"}), 'test.xlsx');
        html_table_to_excel('xlsx');
});
  
function html_table_to_excel(type)
    {
        var data = document.getElementById('load_data');

        var file = XLSX.utils.table_to_book(data, {sheet: "sheet1"});

        XLSX.write(file, { bookType: type, bookSST: true, type: 'base64' });

        XLSX.writeFile(file, 'report.' + type);
    }

</script>