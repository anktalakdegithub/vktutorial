<script type="text/javascript">
$(document).ready(function() {
  tinymce.init({
    selector: ".desc",
    theme: "modern",
    mode: "exact",
    paste_data_images: true,
     menubar: 'edit insert format table tools',
    plugins: [
      "advlist autolink lists image charmap preview hr anchor pagebreak",,
      "insertdatetime nonbreaking save table contextmenu directionality",
      "template paste textcolor colorpicker textpattern"
    ],
    toolbar1: "preview image | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
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
  });

</script>
<style type="text/css">
	/*custom font*/
@import url(https://fonts.googleapis.com/css?family=Montserrat);
* {
    margin: 0;
    padding: 0
}

html {
    height: 100%
}

#msform {
    position: relative;
    margin-top: 20px
}

#msform fieldset .form-card {
    background: white;
    border: 0 none;
    box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
    padding: 20px 40px 30px 40px;
    box-sizing: border-box;
    width: 94%;
    margin: 0 3% 20px 3%;
    position: relative
}

#msform fieldset {
    border: 0 none;
    text-align: left;
    width: 100%;
    margin: 0;
    padding-bottom: 20px;
    position: relative
}
#msform fieldset:not(:first-of-type) {
    display: none
}
#msform fieldset .form-card {
    color: #9E9E9E
}

#msform input,
#msform textarea {
    padding: 0px 8px 4px 8px;
    border: none;
    border-bottom: 1px solid #ccc;
    margin-bottom: 25px;
    margin-top: 2px;
    box-sizing: border-box;
    color: #2C3E50;
    font-size: 16px;
    letter-spacing: 1px
}

#msform input:focus,
#msform textarea:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: none;
    font-weight: bold;
    border-bottom: 2px solid #ed2a26;
    outline-width: 0
}

#msform .action-button {
       font-size: 14px !important;
    font-weight: 500 !important;
    font-family: 'Roboto', sans-serif !important;
    color: #fff !important;
    background: #ed2a26 !important;
    padding: 0px 20px !important;
    border-radius: 25px !important;
    border: 0 !important;
    height: 40px !important;
}

#msform .action-button:hover,
#msform .action-button:focus {
    box-shadow: 0 0 0 2px white, 0 0 0 3px skyblue
}

#msform .action-button-previous {
       font-size: 14px !important;
    font-weight: 500 !important;
    font-family: 'Roboto', sans-serif !important;
    color: #fff !important;
    background: #ed2a26 !important;
    padding: 0px 20px !important;
    border-radius: 25px !important;
    border: 0 !important;
    height: 40px !important;
}

#msform .action-button-previous:hover,
#msform .action-button-previous:focus {
    box-shadow: 0 0 0 2px white, 0 0 0 3px #ed2a26
}

select.list-dt {
    border: none;
    outline: 0;
    border-bottom: 1px solid #ccc;
    padding: 2px 5px 3px 5px;
    margin: 2px
}

select.list-dt:focus {
    border-bottom: 2px solid #ed2a26
}

.card {
    z-index: 0;
    border: none;
    border-radius: 0.5rem;
    position: relative
}

.fs-title {
    font-size: 25px;
    color: #2C3E50;
    margin-bottom: 10px;
    font-weight: bold;
    text-align: left
}

#progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    color: lightgrey
}

#progressbar .active {
    color: #000000
}

#progressbar li {
    list-style-type: none;
    font-size: 12px;
    width: 25%;
    float: left;
    position: relative
}

#progressbar #first:before {
    font-family: FontAwesome;
    content: "\f023"
}

#progressbar #second:before {
    font-family: FontAwesome;
    content: "\f007"
}

#progressbar #third:before {
    font-family: FontAwesome;
    content: "\f09d"
}

#progressbar #forth:before {
    font-family: FontAwesome;
    content: "\f00c"
}

#progressbar li:before {
    width: 50px;
    height: 50px;
    line-height: 45px;
    display: block;
    font-size: 18px;
    color: #ffffff;
    background: lightgray;
    border-radius: 50%;
    margin: 0 auto 10px auto;
    padding: 2px
}

#progressbar li:after {
    content: '';
    width: 100%;
    height: 2px;
    background: lightgray;
    position: absolute;
    left: 0;
    top: 25px;
    z-index: -1
}

#progressbar li.active:before,
#progressbar li.active:after {
    background: #ed2a26
}

.radio-group {
    position: relative;
    margin-bottom: 25px
}

.radio {
    display: inline-block;
    width: 204;
    height: 104;
    border-radius: 0;
    background: #ed2a26;
    box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
    box-sizing: border-box;
    cursor: pointer;
    margin: 8px 2px
}

.radio:hover {
    box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.3)
}

.radio.selected {
    box-shadow: 1px 1px 2px 2px rgba(0, 0, 0, 0.1)
}

.fit-image {
    width: 100%;
    object-fit: cover
}
</style>
<div class="sa4d25">
	<div class="container">			
		<div class="row">
			<div class="col-lg-12">	
				<h2 class="st_title"><i class="uil uil-analysis"></i> New Student</h2>
			</div>					
		</div>				
		<!-- MultiStep Form -->
<!-- MultiStep Form -->
<div class="container-fluid" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-md-12 text-center p-0 mt-3 mb-2">
           <div class="row">
                    <div class="col-md-12 mx-0">
                        <form id="msform">
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li class="active" id="first"><strong>Personal Details</strong></li>
                                <li id="second"><strong>Gardian Details</strong></li>
                                <li id="third"><strong>Admission Details</strong></li>
                                <li id="forth"><strong>Fees Details</strong></li>
                            </ul> <!-- fieldsets -->
                            <fieldset id="firststep">
                               <div class="title-icon">
										<h3 class="title"><i class="uil uil-info-circle"></i>Personal Details</h3>
									</div>
									<div class="course__form">
      <div class="general_info10">              
        <div class="row justify-content-md-center">
          <div class="col-12">
            <div class="row">
              <div class="col-4">
                <div class="ui search focus mt-30 lbel25">
                  <label>First Name</label>
                  <div class="ui left icon input swdh19">
                    <input class="prompt srch_explore" type="text" placeholder="First Name" name="title" data-purpose="edit-course-title" id="fname">                  
                  </div>
                </div>
              </div>
              <div class="col-4">
                <div class="ui search focus mt-30 lbel25">
                  <label>Middle Name</label>
                  <div class="ui left icon input swdh19">
                    <input class="prompt srch_explore" type="text" placeholder="Middle Name" name="title" data-purpose="edit-course-title" id="mname" value="">                  
                  </div>
                </div>
              </div>
              <div class="col-4">
                <div class="ui search focus mt-30 lbel25">
                  <label>Last Name</label>
                  <div class="ui left icon input swdh19">
                    <input class="prompt srch_explore" type="text" placeholder="Last Name" name="title" data-purpose="edit-course-title" id="lname" value="">                  
                  </div>
                </div>
              </div>
            </div>
            <div class="ui search focus mt-30 lbel25">
              <label>Mobile Number</label>
              <div class="ui left icon input swdh19">
                <input class="prompt srch_explore" type="text" placeholder="Mobile Number" name="title" data-purpose="edit-course-title" id="phone" value="">                  
              </div>
            </div>  
            <div class="ui search focus mt-30 lbel25">
              <label>Email</label>
              <div class="ui left icon input swdh19">
                <input class="prompt srch_explore" type="email" placeholder="Email" name="title" data-purpose="edit-course-title" id="email" value="">                 
              </div>
            </div>
            <div class="ui search focus mt-30 lbel25">
              <label>Password</label>
              <div class="ui left icon input swdh19">
                <input class="prompt srch_explore" type="password" placeholder="Password" name="title" data-purpose="edit-course-title" id="password" value="">                 
              </div>
            </div>
            <div class="ui search focus mt-30 lbel25">
              <label>Photo</label>
              <div class="ui left icon input swdh19">
                <input class="prompt srch_explore" type="file" placeholder="Profile" name="photo" data-purpose="edit-course-title" id="photo" value="">                 
              </div>
            </div>
            <div class="ui search focus mt-30 lbel25">
              <label>Date of birth</label>
              <div class="ui left icon input swdh19">
                <input class="prompt srch_explore" type="date" placeholder="Date Of Birth" name="title" data-purpose="edit-course-title" id="dob" value="">                 
              </div>
            </div>
            <div class="ui search focus mt-30 lbel25 row">
              <label class="col-md-2">Gender</label>
              <div class="col-md-10">
              <input type="radio" id="gender" name="gender" value="Female" checked>Female
                <input type="radio" id="gender" name="gender" value="Male">Male  
              </div>
            </div>
            <div class="ui search focus mt-30 lbel25">
              <label>Address</label>
              <div class="ui left icon input swdh19">
                <textarea class="prompt srch_explore" style="width: 100%;" placeholder="Address" id="address"></textarea>     
              </div>
            </div>
            <div class="ui search focus mt-30 lbel25">
              <label>State</label>
              <div class="ui left icon input swdh19">
                <input class="prompt srch_explore" type="text" placeholder="State" name="title" data-purpose="edit-course-title" id="state" value="">                 
              </div>
            </div>
            <div class="ui search focus mt-30 lbel25">
              <label>City</label>
              <div class="ui left icon input swdh19">
                <input class="prompt srch_explore" type="text" placeholder="City" name="title" data-purpose="edit-course-title" id="city" value="">                 
              </div>
            </div>
            <div class="ui search focus mt-30 lbel25">
              <label>Pincode</label>
              <div class="ui left icon input swdh19">
                <input class="prompt srch_explore" type="text" placeholder="Pincode" name="title" data-purpose="edit-course-title" id="pincode" value="">                 
              </div>
            </div>
             <div class="ui search focus mt-30 lbel25">
              <label>Select Inquiry Source</label>
              <select class="ui hj145 dropdown swdh19 prompt srch_explore selection" id="isource">
                <?php 
                  foreach($isources as $source){
                    if($source->Source!=""){
                    ?>
                    <option value="<?=$source->Id;?>"><?=$source->Source;?></option>
                    <?php
                    }
                  }
                ?>                  
              </select>
            </div>
              <br>
              <div id="msg"></div>
          </div>    
        </div>
      </div>          
    </div>
									<button type="button" class="next action-button" id="addstudent">Save & Next</button>
                            </fieldset>
                            <fieldset id="secondstep">
                               <div class="title-icon">
										<h3 class="title"><i class="uil uil-image-upload"></i>Gaurdian Details</h3>
									</div>
									<div class="course__form">
										<div class="general_info10">              
        <div class="row justify-content-md-center">
          <div class="col-12">
            <div class="ui search focus mt-30 lbel25 row">
              <label class="col-md-2">Relation</label>
              <div class="col-md-10">
                <input type="radio" name="relation" value="Father" checked>&nbsp;Father&nbsp;
                <input type="radio" name="relation" value="Mother">&nbsp;Mother  &nbsp;
                <input type="radio" name="relation" value="Other">&nbsp;Other  &nbsp;
              </div>
            </div>
            <div class="row">
              <div class="col-md-2">
                <div class="ui search focus mt-30 lbel25">
                  <label>Name</label>
                </div>
              </div>
              <div class="col-md-1" style="padding-right: 0px;">
                <div class="ui search focus mt-30 lbel25">
                  <select class="ui hj145 dropdown swdh19 prompt srch_explore selection" id="addressing" style="min-width: 100% !important;">
                    <option>Mr.</option>
                    <option>Mrs.</option>
                    <option>Miss.</option>               
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="ui search focus mt-30 lbel25">
                  <div class="ui left icon input swdh19">
                    <input class="prompt srch_explore" type="text" placeholder="First Name" name="title" data-purpose="edit-course-title"  id="gfname" value="">
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="ui search focus mt-30 lbel25">
                  <div class="ui left icon input swdh19">
                    <input class="prompt srch_explore" type="text" placeholder="Middle Name" name="title" data-purpose="edit-course-title"  id="gmname" value="">
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="ui search focus mt-30 lbel25">
                  <div class="ui left icon input swdh19">
                    <input class="prompt srch_explore" type="text" placeholder="Last Name" name="title" data-purpose="edit-course-title"  id="glname" value="">
                  </div>
                </div>
              </div>
            </div>
            <div class="ui search focus mt-30 lbel25">
              <label>Mobile Number</label>
              <div class="ui left icon input swdh19">
                <input class="prompt srch_explore" type="text" placeholder="Mobile Number" name="title" data-purpose="edit-course-title" id="gphone" value="">                  
              </div>
            </div>  
            <div class="ui search focus mt-30 lbel25">
              <label>Email</label>
              <div class="ui left icon input swdh19">
                <input class="prompt srch_explore" type="email" placeholder="Email" name="title" data-purpose="edit-course-title" id="gemail" value="">                 
              </div>
            </div>
            <div class="ui search focus mt-30 lbel25">
              <label>Occupation</label>
              <div class="ui left icon input swdh19">
                <input class="prompt srch_explore" type="text" placeholder="Occupation" name="title" data-purpose="edit-course-title" id="occupation" value="">
              </div>
            </div>
            <br>
            <div id="gmsg"></div><br>
            <button type="button" class="next action-button" id="addparents">Save</button>
          </div>    
        </div>
      </div> 
      <div class="row">
                    <div class="col-md-12" id="parents">
                    </div>
                  </div>
									</div>
                  
									<div class="row">
										<div class="col-md-6 text-left">
                               </div>
                               <div class="col-md-6 text-right"> 
                               		<button type="button" class="next action-button" id="pnext">Next</button>
                               </div>
                           </div>
                            </fieldset>
                            <fieldset id="thirdstep">

									<div class="title-icon">
										<h3 class="title"><i class="uil uil-film"></i>Admission Details</h3>
									</div>
									<div class="course__form">
										<div class="general_info10">              
        <div class="row justify-content-md-center">
          <div class="col-12">
            <div class="row">
              <div class="col-md-4">
                <div class="ui search focus mt-30 lbel25">
                  <label>Batch</label>
                </div>
              </div>
              <div class="col-md-8">
                <div class="ui search focus mt-30 lbel25">
                  <label>Fees</label>
                </div>
              </div>
              </div>
              <div class="row">
              <div class="col-md-4">
                <div class="ui search focus mt-30 lbel25">
                  <select class="ui hj145 dropdown swdh19 prompt srch_explore selection" id="batch">
                    <option value="">select batch</option>
                    <?php 
                    foreach($batches as $batch){
                    ?>
                    <option value="<?=$batch->Id;?>"><?=$batch->Name;?></option>
                    <?php
                    }
                    ?>                  
                  </select>
                </div>
              </div>
              <div class="col-md-8">
                <div class="row">
                  <div class="col-md-12">
                    <div class="ui search focus mt-30 lbel25">
                      <div class="ui left icon input swdh19">
                        <input class="prompt srch_explore" type="number" name="title" data-purpose="edit-course-title" id="fees" value="0">                 
                      </div>
                    </div>
                  </div>
                </div>
                 <div class="row">
                  <div class="col-md-4"><br><br>
                    <div class="text-right">
                      <h4><badge class="badge badge-secondary" style="width: 100%;">Discount ?</badge></h4>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="ui search focus mt-30 lbel25">
                      <select class="ui hj145 dropdown swdh19 prompt srch_explore selection" id="dtype" style="min-width: 100% !important;">
                        <option value="&#8377;">&#8377;</option>
                        <option value="%">%</option>             
                      </select>
                    </div>
                  </div>
              <div class="col-md-6">
                <div class="ui search focus mt-30 lbel25">
                  <div class="ui left icon input swdh19">
                    <input class="prompt srch_explore" type="number" placeholder="" name="title" data-purpose="edit-course-title"  id="discount" value="0">                  
                  </div>
                </div>
                  </div>
                </div>
                 <div class="row">
                  <div class="col-md-4"><br><br>
                    <div class="text-right">
                      <h4><badge class="badge badge-secondary" style="width: 100%;">Total Fees</badge></h4>
                    </div>
                  </div>
              <div class="col-md-8">
                <div class="ui search focus mt-30 lbel25">
                  <div class="ui left icon input swdh19">
                    <input class="prompt srch_explore" type="number" placeholder="" name="title" data-purpose="edit-course-title"  id="tfees" value="0" disabled>                  
                  </div>
                </div>
                  </div>
                </div>  
                 <div class="row">
                  <div class="col-md-4"><br><br>
                    <div class="text-right">
                      <h4><badge class="badge badge-secondary" style="width: 100%;">Note</badge></h4>
                    </div>
                  </div>
              <div class="col-md-8">
                <div class="ui search focus mt-30 lbel25">
                  <div class="ui left icon input swdh19">
                    <input class="prompt srch_explore" type="text" placeholder="Note" name="title" data-purpose="edit-course-title"  id="note" value="">                  
                  </div>
                </div>
                  </div>
                </div>   
              </div>
              </div>
            </div>
          </div>
        </div>
									</div>
									<br>
                           	<div class="row">
										<div class="col-md-6 text-left">
                               </div>
                               <div class="col-md-6 text-right"> 
                               		<button type="button" class="next action-button" id="addadmission">Next</button>
                               </div>
                           </div>
                            </fieldset>
                            <fieldset id="forthstep">
                                <div class="title-icon">
										<h3 class="title"><i class="uil uil-file-copy-alt"></i>Payment Details</h3>
									</div>
								   	<div class="course__form">
								   		     <div class="general_info10">              
        <div class="row justify-content-md-center">
          <div class="col-12">
            <div class="ui search focus mt-30 lbel25">
              <label>Final Fees</label>
              <div class="ui left icon input swdh19">
                <input class="prompt srch_explore" type="number" name="title" data-purpose="edit-course-title"  id="ffees" value="0">
              </div>
            </div>
            <div class="ui search focus mt-30 lbel25">
              <label>Amount Paid</label>
              <div class="ui left icon input swdh19">
                <input class="prompt srch_explore" type="number" name="title" data-purpose="edit-course-title" id="apaid" value="0">
              </div>
            </div>
            <div class="ui search focus mt-30 lbel25">
              <label>Payment Method</label>
              <select class="ui hj145 dropdown swdh19 prompt srch_explore selection" id="pmethod">
                <?php 
                foreach($pcategory as $method){
                ?>
                <option value="<?=$method->Id;?>"><?=$method->PaymentCategory;?></option>
                <?php
                }
                ?>                  
              </select>
            </div>
            <div class="ui search focus mt-30 lbel25">
              <label>Payment Status</label>
              <select class="ui hj145 dropdown swdh19 prompt srch_explore selection" id="pstatus" style="min-width: 100% !important;">
                <option value="Paid">Paid</option>
                <option value="Unpaid">Unpaid</option>
                <option value="Unclear">Unclear</option>               
              </select>
            </div>
            <div class="ui search focus mt-30 lbel25">
              <label>Amount Remaining</label>
              <div class="ui left icon input swdh19">
                <input class="prompt srch_explore" type="number" name="title" data-purpose="edit-course-title" id="aremaining" value="0">
              </div>
            </div>
            <div class="ui search focus mt-30 lbel25">
              <label>Installment Amount</label>
              <div class="ui left icon input swdh19">
                <input class="prompt srch_explore" type="number" name="title" data-purpose="edit-course-title"  id="iamount" value="0">                  
              </div>
            </div>
            <div class="ui search focus mt-30 lbel25">
              <label>Installment Type</label>
              <select class="ui hj145 dropdown swdh19 prompt srch_explore selection" id="itype" style="min-width: 100% !important;">
                <option>Weekly</option>
                <option>Monthly</option>            
              </select>
            </div>
            <div class="ui search focus mt-30 lbel25">
              <label>No. Of Installments</label>
              <div class="ui left icon input swdh19">
                <input class="prompt srch_explore" type="number" name="title" data-purpose="edit-course-title"  id="noi" value="0">                  
              </div>
            </div>
            <div class="ui search focus mt-30 lbel25">
              <label>Installment Date</label>
              <div class="ui left icon input swdh19">
                <input class="prompt srch_explore" type="date" data-purpose="edit-course-title"  id="idate">                  
              </div>
            </div>
              <br>
              <div id="smsg"></div>
          </div>    
        </div>
      </div> 
									</div><br>
									
									<div class="row">
										<div class="col-md-6 text-left">
                               </div>
                               <div class="col-md-6 text-right"> 
                               		<button type="button" class="next action-button" id="paymentbtn">Submit</button>
                               </div>
                           </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
    </div>
</div>
<!-- /.MultiStep Form -->
  </div>
</div>

<script type="text/javascript">

$("#addstudent").click(function(){
	var formData = new FormData();
	var fname=$('#fname').val();
  var mname=$('#mname').val();
  var lname=$('#lname').val();
  var email=$('#email').val();
  var password=$('#password').val();
  var phone=$('#phone').val();
  var dob=$('#dob').val();
  var address=$('#address').val();
  var city=$('#city').val();
  var state=$('#state').val();
  var pincode=$('#pincode').val();
  var isource=$('#isource').val();
  var photo=$('input[name="photo"]').get(0).files[0];
  var gender=$("input[name='gender']:checked"). val();
  formData.append('fname', fname);
  formData.append('gender', gender);
  formData.append('mname', mname);
  formData.append('lname', lname);
  formData.append('email',email);
  formData.append('password', password);
  formData.append('phone', phone);
  formData.append('dob', dob);
  formData.append('address',address);
  formData.append('city', city);
  formData.append('pincode', pincode);
  formData.append('photo', photo);
  formData.append('isource', isource);
  $.ajax({
    url: "<?= base_url()?>admin/student/addstudent",
    data: formData,
    type: "post",
    headers: { 'IsAjax': 'true' },
    processData: false,
    contentType: false,
   	dataType: 'json',
    success:function(data)
    {
      if(data.code=="404"){
        $('#msg').html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
      }
      else{
    		$('#addadmission').val(data.id);
        $('#addparents').val(data.id);
        $('#paymentbtn').val(data.id);
    		$('#msg').html('');
	      $('fieldset').css({'display':'none'});
      	$('#secondstep').css({'display':'block'});
      	$('li').removeClass('active');
      	$('#second').addClass('active');
	    }
    }
	});
});

$("#addparents").click(function(){
	var formData = new FormData();
  var fname=$('#gfname').val();
  var mname=$('#gmname').val();
  var lname=$('#glname').val();
  var email=$('#gemail').val();
  var phone=$('#gphone').val();
  var occupation=$('#occupation').val();
  var addressing=$('#addressing').val();
  var relation=$("input[name='relation']:checked").val();
  formData.append('fname', fname);
  formData.append('relation', relation);
  formData.append('mname', mname);
  formData.append('lname', lname);
  formData.append('email',email);
  formData.append('addressing', addressing);
  formData.append('phone', phone);
  formData.append('occupation', occupation);
  formData.append('studid',$(this).val());
  $.ajax({
    url: "<?= base_url()?>admin/student/addparents",
    data: formData,
    type: "post",
    headers: { 'IsAjax': 'true' },
    processData: false,
    contentType: false,
   	dataType: 'json',
    success:function(data)
    {
      if(data.code=="404"){
    		$('#gmsg').html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
    	}
    	else{
    		$('#gmsg').html('<div class="alert alert-success"><strong>Success! </strong>'+data.msg+'</div>');
         $('#gemail').val("");
          $('#gphone').val("");
          $('#gname').val("");
          var htmltext='<div class="card" style="border: 1px solid #e4eaec;"><div class="card-body"><div class="row"><div class="col-md-10"><h4>'+addressing+' '+fname+' '+mname+' '+lname+'('+relation+')</h4><p><i class="fa fa-envelope"></i>&nbsp;'+email+'&nbsp;&nbsp;<span><i class="fa fa-phone"></i>&nbsp;'+phone+'</span></p></div><div class="col-md-2"></div></div></div>';
          $('#parents').append(htmltext);
    		
      }
    }
	});
});
	$("#pnext").click(function(){
	 	$('fieldset').css({'display':'none'});
        $('#thirdstep').css({'display':'block'});
        $('li').removeClass('active');
        $('#third').addClass('active');
	 });


 $('#addadmission').click(function() {
  var batch=$('#batch').val();
  var fees=$('#fees').val();
  var discount=$('#discount').val();
  var dtype=$('#dtype').val();
  var tfees=$('#tfees').val();
  if (dtype=="%") {
    discount=(discount/100)*tfees;
  }
  var note=$('#note').val();
  var formData = new FormData();
  formData.append('batch', batch);
  formData.append('fees', fees);
  formData.append('tfees', tfees);
  formData.append('discount', discount);
  formData.append('note', note);
  formData.append('studid', $(this).val());
  $.ajax({
    url: "<?=base_url()?>admin/student/addadmission",
    data: formData,
    type: "post",
    headers: { 'IsAjax': 'true' },
    dataType: "json",
    processData: false,
    contentType: false,
    success: function(data){
      console.log(data);
      if(data.code=="200"){
         $('#cmsg').html('<div class="alert alert-success"><strong>Success! </strong>'+data.msg+'</div>');
         $('fieldset').css({'display':'none'});
            $('#forthstep').css({'display':'block'});
            $('li').removeClass('active');
            $('#forth').addClass('active');
      }
      else{
        $('#cmsg').html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
      }
    }
  });
});
$('#batch').change(function(){
  $.ajax({
    url: "<?= base_url()?>admin/batch/fetchbatch",
    data: {id:$(this).val()},
    type: "post",
    dataType: 'json',
    success: function(data){
      $('#fees').val(data.Fees);
      calculate();
    }
  });
});
$('#discount').on('input', function() {
  calculate();
});
$('body').on('change', '#dtype', function(){
  calculate();
});
  $("#apaid").change(function() { 
                var apaid=$('#apaid').val();
                var final=$('#ffees').val();
                var iamount=$('#iamount').val();
                  var aremaining=final-apaid;
                
                $('#aremaining').val(aremaining);
               if(aremaining<iamount || iamount=="0"){
                
                  $('#iamount').val(aremaining);
                  $('#noi').val('1');
                }
                else{
                var iamount=$('#iamount').val();
                var aremaining=$('#aremaining').val();
                var famount=0;
                var count=(aremaining/iamount);
                
                $('#noi').val(Math.ceil(count));
                }

            }); 

    

            $("#iamount").change(function() { 
                var iamount=$('#iamount').val();
                var aremaining=$('#aremaining').val();
                var famount=0;
                var count=(aremaining/iamount);
                
                $('#noi').val(Math.ceil(count));
            }); 
           
  function calculate(){
    var fees=$('#fees').val();
    var discount=$('#discount').val();
    var dtype=$('#dtype').val();
    var totalfees=0;
    if (dtype=="%") {
      totalfees=fees-(discount/100)*fees;
    }
    else{
      totalfees=fees-discount;
    }
    $('#tfees').val(totalfees);
    $('#ffees').val(totalfees);
    $('#apaid').val(totalfees);
  } 
  $("#nvcourse").click(function(){
    $('fieldset').css({'display':'none'});
    $('#thirdstep').css({'display':'block'});
    $('li').removeClass('active');
    $('#third').addClass('active');
  });
	$('#paymentbtn').click(function() {
		var formData = new FormData();
    var ffees=$("#ffees"). val();
    var apaid=$("#apaid"). val();
    var aremaining=$("#aremaining"). val();
    var iamount=$("#iamount"). val();
    var itype=$('#itype').val();
    var batch=$('#batch').val();
    var pstatus=$('#pstatus').val();
    var pmethod=$('#pmethod').val();
    var noi=$('#noi').val();
    var idate=$('#idate').val();
    formData.append('apaid',apaid);
    formData.append('aremaining', aremaining);
    formData.append('iamount',iamount);
    formData.append('itype', itype);
    formData.append('batch',batch);
    formData.append('pstatus', pstatus);
    formData.append('pmethod',pmethod);
    formData.append('noi', noi);
    formData.append('idate',idate);
    formData.append('tfees', ffees);
    formData.append('studid', $(this).val());
   	$.ajax({
      url: "<?= base_url()?>admin/student/addpayment",
      data: formData,
      type: "post",
      headers: { 'IsAjax': 'true' },
      processData: false,
      contentType: false,
     	dataType: 'json',
      success:function(data)
      {
      	if(data.code=="404"){
      		$('#pmsg').html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
      	}
      	else{
      		swal("Payment details successfully!", "", "success");
		    setTimeout(function () {
              	swal.close();
             	location.href="<?=base_url();?>admin/student";
          	}, 2000);
        }
      }
		});
		//console.log(cname);
	});
</script>