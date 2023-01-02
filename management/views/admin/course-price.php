
<style type="text/css">
	.nav-link.active{
		font-size: 14px !important;
		font-weight: 500 !important;
		font-family: 'Roboto', sans-serif !important;
		color: #fff !important;
		background: #0eb67c !important;
		border-radius: 25px !important;
		border: 0 !important;
		height: 40px !important;
		padding-top: 10px;
	}
</style>
<div class="title-icon">
	<a href="<?=base_url();?>admin/course/coursedetail/curriculum/<?=$course[0]->Id;?>" class="title" style="display: inline-block;"><i class="fas fa-arrow-left"></i></a>&nbsp;&nbsp;<h3 class="title" style="display: inline-block;"><i class="uil uil-file-copy-alt"></i>Payment Details</h3>
</div><br>

<div class="course__form">
	<div class="view_info10">
		<br>
		<!-- Tab panes -->
		<div class="ui search focus mt-30 lbel25">
					<label>Videos Price</label>
					<div class="ui left icon input swdh19">
						<input class="prompt srch_explore" type="text" placeholder="" name="videos_price" data-purpose="edit-course-title" id="videos_price" value="<?=$course[0]->VideosPrice;?>">
					</div>
				</div>												
				<div class="ui search focus mt-30 lbel25">
					<label>Tests Price</label>
					<div class="ui left icon input swdh19">
						<input class="prompt srch_explore" type="text" placeholder="" name="tests_price" data-purpose="edit-course-title" id="tests_price"value="<?=$course[0]->TestsPrice;?>">
					</div>
				</div>												
				<div class="ui search focus mt-30 lbel25">
					<label>Ppts Price</label>
					<div class="ui left icon input swdh19">
						<input class="prompt srch_explore" type="text" placeholder="" name="ppts_price" data-purpose="edit-course-title" id="ppts_price" value="<?=$course[0]->PptsPrice;?>">
					</div>
				</div>													
				<div class="ui search focus mt-30 lbel25">
					<label>Overall Price</label>
					<div class="ui left icon input swdh19">
						<input class="prompt srch_explore" type="text" placeholder="" name="overall_price" data-purpose="edit-course-title" id="overall_price" value="<?=$course[0]->Price;?>">
					</div>
				</div>			
				<div class="row">
					<div class="col-md-6 text-left">
						<div id="videosmsg"></div>
					</div><br>
				</div><div class="row">
					<div class="col-md-6 text-left">
						<button type="button" class="next steps_btn" id="addprice" value="<?=$course[0]->Id;?>">Submit</button>
					</div>
				</div>
		<br><br>
	</div>
</div><br>

<script type="text/javascript">
	$('input[name="pdetail"]').change(function(){
		if($(this).val()=="1"){
			$('#pricedetails').css({'display':'block'});
		}
		else{
			$('#pricedetails').css({'display':'none'});
		}
	});
	$('input[name="vpdetail"]').change(function(){
		if($(this).val()=="1"){
			$('#vpricedetails').css({'display':'block'});
		}
		else{
			$('#vpricedetails').css({'display':'none'});
		}
	});
	$('input[name="ppdetail"]').change(function(){
		if($(this).val()=="1"){
			$('#ppricedetails').css({'display':'block'});
		}
		else{
			$('#ppricedetails').css({'display':'none'});
		}
	});
	$('input[name="tpdetail"]').change(function(){
		if($(this).val()=="1"){
			$('#tpricedetails').css({'display':'block'});
		}
		else{
			$('#tpricedetails').css({'display':'none'});
		}
	});
	/*$('body').on('click', '#addprice', function(){ 
		var cid=$(this).val();
		var ctype=$("input[name='pdetail']:checked"). val();
		var price=$('#price').val();
		var type="overall";
		updateprice(cid,price,ctype,type);
	});

	$('body').on('click', '#vaddprice', function(){ 
		var cid=$(this).val();
		var ctype=$("input[name='vpdetail']:checked"). val();
		var price=$('#vprice').val();
		var type="videos";
		updateprice(cid,price,ctype,type);
	});
	$('body').on('click', '#paddprice', function(){ 
		var cid=$(this).val();
		var ctype=$("input[name='vpdetail']:checked"). val();
		var price=$('#pprice').val();
		var type="ppts";
		updateprice(cid,price,ctype,type);
	});
	$('body').on('click', '#taddprice', function(){ 
		var cid=$(this).val();
		var ctype=$("input[name='vpdetail']:checked"). val();
		var price=$('#tprice').val();
		var type="tests";
		updateprice(cid,price,ctype,type);
	});
	$('body').on('click', '#ataddprice', function(){ 
		var cid=$(this).val();
		var ctype=0;
		var price=$('#atprice').val();
		var type="two";
		updateprice(cid,price,ctype,type);
	});
	$('body').on('click', '#sectionaddprice', function(){ 
		var cid=$(this).val();
		var ctype=0;
		var price=$('#sectionprice').val();
		var type="section";
		updateprice(cid,price,ctype,type);
	});
	$('body').on('click', '#topicaddprice', function(){ 
		var cid=$(this).val();
		var ctype=0;
		var price=$('#topicprice').val();
		var type="topic";
		updateprice(cid,price,ctype,type);
	});*/
	$('body').on('click', '#addprice', function(){ 
		var formData = new FormData();
	    var videos_price=$('#videos_price').val();
	    var ppts_price=$('#ppts_price').val();
	    var tests_price=$('#tests_price').val();
	    var overall_price=$('#overall_price').val();
	    formData.append('videos_price',videos_price);
	    formData.append('ppts_price',ppts_price);
	    formData.append('tests_price',tests_price);
	    formData.append('overall_price', overall_price);
	    var cid='<?=$course[0]->Id;?>';
	    formData.append('cid',cid);
	   	$.ajax({
	        url: "<?= base_url()?>admin/course/addpayment",
	        data: formData,
	        type: "post",
	        headers: { 'IsAjax': 'true' },
	        processData: false,
	        contentType: false,
	       	dataType: 'json',
			success: function(data){
				if(data.code=="404"){
					$('#'+type+'msg').html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
				}
				else{
					swal("Price added successfully!", "", "success");
					setTimeout(function () {
						swal.close();
		             	//location.reload();
		             }, 2000);
				}
			}
		});
	});
	/*function updateprice(cid,price,ctype,type){
		$.ajax({
			url: "<?= base_url()?>admin/course/addpayment",
			data: {cid:cid,price:price,ctype:ctype,type:type},
			type: "post",
			dataType: "json",
			success: function(data){
				if(data.code=="404"){
					$('#'+type+'msg').html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
				}
				else{
					swal("Price added successfully!", "", "success");
					setTimeout(function () {
						swal.close();
		             	//location.reload();
		             }, 2000);
				}
			}
		});
	}*/
</script>