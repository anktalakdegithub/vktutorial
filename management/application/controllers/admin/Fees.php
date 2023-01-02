<?php
class Fees extends CI_Controller 
{
	public function __construct()
	{
	parent::__construct();
	$this->load->database();
	$this->load->helper('url');
	$this->load->model('Fees_Model');
	$this->load->model('Setting_Model');
  $this->load->model('Batch_Model');
	$this->load->library('session'); 
    $this->isadminLoggedIn = $this->session->userdata('isadminLoggedIn'); 
	}

	public function index(){
		if(!$this->isadminLoggedIn){ 
      redirect('admin/login'); 
    }
    else{
    	$result=$this->Fees_Model->totalfees();
      $this->load->view('admin/header');
      $this->load->view('admin/fees_details',$result);
      $this->load->view('admin/footer');
    }
	}
	public function paid_fees(){
		if(!$this->isadminLoggedIn){ 
      redirect('admin/login'); 
    }
    else{
    	$this->session->set_userdata('paidid',0);
      $result['batches']=$this->Batch_Model->fetchbatches();
      $this->load->view('admin/paid_fees',$result);
    }
	}
	public function fetch_paid_fees(){
		$paidid=$this->session->userdata('paidid');
		$result=$this->Fees_Model->fetch_paid_fees($paidid);
    $this->paidfees($result);
	}
	public function unpaid_fees(){
		if(!$this->isadminLoggedIn){ 
            redirect('admin/login'); 
        }
        else{
        	$this->session->set_userdata('unpaidid',0);
          $result['batches']=$this->Batch_Model->fetchbatches();  
          $this->load->view('admin/unpaid_fees',$result);
        }
	}
	public function fetch_unpaid_fees(){
		$unpaidid=$this->session->userdata('unpaidid');
		$result=$this->Fees_Model->fetch_unpaid_fees($unpaidid);
		$this->unpaidfees($result);
	}
	public function unclear_fees(){
		if(!$this->isadminLoggedIn){ 
            redirect('admin/login'); 
        }
        else{
        	$this->session->set_userdata('unclearid',0);
          $result['batches']=$this->Batch_Model->fetchbatches();
          $this->load->view('admin/unclear_fees',$result);
        }
	}
	public function fetch_unclear_fees(){
		$unclearid=$this->session->userdata('unclearid');
		$result=$this->Fees_Model->fetch_unclear_fees($unclearid);
		$this->unclearfees($result);
	}
  public function updatefeestatus(){
    $pstatus=$this->input->post('pstatus');
    $id=$this->input->post('id');
    $iamount=$this->input->post('iamount');
    $pamount=$this->input->post('pamount');
    $pmethod=$this->input->post('pmethod');
    $pdate=$this->input->post('pdate');
    $studid=$this->input->post('studid');
    $remaining=$this->input->post('remaining');
    $code="";
    $msg="";
    if(empty($pamount)){
      $code="404";
      $msg="Please enter paid amount.";
    }
    else if($pamount>$remaining){
      $code="404";
      $msg="Please enter amount less then or equal to amount remaining.";
    }
    else{
      $this->Fees_Model->updatefeestatus($id,$studid,$pstatus,$iamount,$pamount,$pmethod,$pdate,$remaining);
      $code="200";
      $msg="Status updated successfully.";
    }
    $data=array();
    $data['code']=$code;
    $data['msg']=$msg;
    echo json_encode($data);
  }
  function fetchmonthlypaidfees(){
    $month=$this->input->post("month");
    $year=$this->input->post("year");
    $result=$this->Fees_Model->fetchmonthlypaidfees($month,$year);
    $this->paidfees($result);
  }
  function paidfees($result){
    $output='';
      $i=0;
            if(count($result['income'])>0){
              foreach($result['income'] as $row) {
                $this->session->set_userdata('paidid',$row->Id);
                $output.='                  <div class="row">
                    <div class="col-md-9">
                    <h4>'.$row->AmountPaid.'/- Rs.</h4>
                    <p><a class="text-primary"><i class="fas fa-user" aria-hidden="true"></i>&nbsp;'.$result['students'][$i]->FirstName.' '.$result['students'][$i]->MiddleName.' '.$result['students'][$i]->LastName.'</a>&nbsp;&nbsp;<a href="#" data-toggle="modal"><i class="far fa-calendar-alt"></i> '.$row->CreatedAt.' </a><!--&nbsp;&nbsp;<a href="#" data-toggle="modal"data-target="#emailmodal_'.$row->Id.'"><i class="fas fa-envelope" aria-hidden="true"></i> Email</a>
                      &nbsp; &nbsp;<a href="#" data-toggle="modal" data-target="#smsmodal_'.$row->Id.'"><i class="fas fa-sms"></i> SMS</a>--></p>
                  </div>
                 
                 <div class="modal" id="smsmodal_'.$row->Id.'">
            <div class="modal-dialog">
              <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title">Send sms</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                  <div class="form-group">
                    <label>Message</label>
                    <textarea class="form-control" id="smsg_'.$row->Id.'"></textarea>
                    <input type="hidden" value="'.$result['students'][$i]->Phone.'" id="phone_'.$row->Id.'">
                  </div>
                    <div id="ssmsg_'.$row->Id.'"> </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                  <button type="button" class="sendsms btn btn-primary" id="'.$result['students'][$i]->Id.'" value="'.$row->Id.'">Send</button>
                

              </div>
            </div>
          </div>
        </div>
            <div class="modal" id="emailmodal_'.$row->Id.'">
            <div class="modal-dialog">
              <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title">Send email</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                   <div class="form-group">
                    <label>Subject</label>
                    <input type="text" name="" class="form-control" id="sub_'.$row->Id.'">
                  </div>
                  <div class="form-group">
                    <label>Message</label>
                    <textarea class="form-control" id="emsg_'.$row->Id.'"></textarea>
                     <input type="hidden" value="'.$result['students'][$i]->Email.'" id="email_'.$row->Id.'">
                  </div>
                  <div id="esmsg_'.$row->Id.'"> </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                  <button type="button" value="'.$row->Id.'" class="sendemail btn btn-primary">Send</button>
                
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">

                      <!--&nbsp;&nbsp;<a href="'.base_url().'invoice/index/'.$row->Id.'" class="btn btn-default"><i class="fas fa-download" aria-hidden="true"></i> Invoice</a>-->
        </div>
      </div>
      <hr>
      ';
       $i++;
    }
          }
          echo $output;
  }
  function fetchmonthlyunpaidfees(){
    $month=$this->input->post("month");
    $year=$this->input->post("year");
    $batch=$this->input->post("batch");
    $result=$this->Fees_Model->fetchmonthlyunpaidfees($month,$year,$batch);
    $this->unpaidfees($result);
  }
  function unpaidfees($result){

    $pmethod=$this->Setting_Model->fetchpaymentcategories();
    $output='';
      $i=0;
                      if(count($result['income'])>0){
                          foreach($result['income'] as $row) {
                            $this->session->set_userdata('unpaidid',$row->Id);
                          $output.='<div class="row">
                                  <div class="col-md-9">';
                                  if($row->PaymentStatus=="Unclear"){
                              $output.='   <h4>'.($row->Amount-($row->AmountPaid+$row->AmountUnclear)).'/- Rs.</h4>';
                                  }
                                  else{

                                $output.=' <h4>'.($row->Amount-$row->AmountPaid).'/- Rs.</h4>';
                                  }
                                $output.='<p><a href="'.base_url().'admin/student/studentdetails/'.$result['students'][$i]->Id.'"><i class="fas fa-user" aria-hidden="true"></i>&nbsp;'.$result['students'][$i]->FirstName.' '.$result['students'][$i]->MiddleName.' '.$result['students'][$i]->LastName.'</a> &nbsp;&nbsp;<span><i class="far fa-calendar-alt text-primary"></i> '.$row->PaymentDate.' </span><!--&nbsp;&nbsp;<a href="#" data-toggle="modal"data-target="#emailmodal_'.$row->Id.'"><i class="fas fa-envelope" aria-hidden="true"></i> Email</a>
                                  &nbsp; &nbsp;<a href="#" data-toggle="modal" data-target="#smsmodal_'.$row->Id.'"><i class="fas fa-sms"></i> SMS</a>--></p>
                                </div>
                                <div class="col-md-3">
                                  <a href="#" class="btn btn-success" data-toggle="modal" data-target="#editmodal_'.$row->Id.'"><i class="fas fa-money-bill-alt"></i>&nbsp;&nbsp; Pay</a>
                                </div>
                              </div>
                             <hr>
                <div class="modal" id="editmodal_'.$row->Id.'">
                  <div class="modal-dialog">
                    <div class="modal-content">

                      <!-- Modal Header -->
                      <div class="modal-header">
                        <h4 class="modal-title">Edit Fee</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                      <input type="hidden" id="studid_'.$row->Id.'" value="'.$result['students'][$i]->Id.'" name="">
                      <!-- Modal body -->
                      <div class="modal-body">
                    <div class="form-group row">
                    <label class="col-md-3">Installment amount</label>
                    <div class="col-md-9">
                      <input type="text" class="form-control" name="iamount" disabled id="iamount_'.$row->Id.'" value="'.$row->Amount.'">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3">Amount remaining</label>
                    <div class="col-md-9">
                    ';
                                  if($row->PaymentStatus=="Unclear"){
                              $output.='
                      <input type="text" class="form-control" disabled name="parmount" id="paremaining_'.$row->Id.'" value="'.($row->Amount-($row->AmountPaid+$row->AmountUnclear)).'">';
                                  }
                                  else{

                                $output.='
                      <input type="text" class="form-control" disabled name="parmount" id="paremaining_'.$row->Id.'" value="'.($row->Amount-$row->AmountPaid).'">';
                                  }
                                $output.='
                    </div>
                  </div>   
                    <div class="form-group row">
                    <label class="col-md-3">Amount</label>
                    <div class="col-md-9">
                      <input type="text" class="form-control" name="pamount" id="pamount_'.$row->Id.'" val="0">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3">Payment status</label>
                    <div class="col-md-9">
                      <select class="form-control" id="pstatus_'.$row->Id.'">
                         <option value="Paid" selected>Paid</option>
                        <option value="Unclear">Unclear</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3">Payment Method</label>
                    <div class="col-md-9">
                      <select class="form-control" id="pmethod_'.$row->Id.'">';
                        foreach ($pmethod as $method) {
                          $output.='<option value="'.$method->Id.'">'.$method->PaymentCategory.'</option>';
                        }
                      $output.='</select>
                    </div>
                  </div>
                    <div class="form-group row">
                    <label class="col-md-3">Postdated date(optional)</label>
                    <div class="col-md-9">
                      <input type="date" class="form-control" name="" id="pdate_'.$row->Id.'" >
                    </div>
                  </div> 
                  <div id="duemsg_'.$row->Id.'"> </div>
                      </div>

                      <!-- Modal footer -->
                      <div class="modal-footer">
                        <button type="button" class="updateunpaid btn btn-success" value="'.$row->Id.'">Update</button>
                      </div>

                    </div>
                  </div>
                </div>
                             <div class="modal" id="smsmodal_'.$row->Id.'">
                        <div class="modal-dialog">
                          <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                              <h4 class="modal-title">Send sms</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                              <div class="form-group">
                                <label>Message</label>
                                <textarea class="form-control" id="smsg_'.$row->Id.'"></textarea>
                                <input type="hidden" value="'.$result['students'][$i]->Phone.'" id="phone_'.$row->Id.'">
                              </div>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                              <div id="ssmsg_'.$row->Id.'" style="color: green;">
                              <button type="button" class="sendsms btn btn-primary" value="'.$row->Id.'">Send</button>
                            </div>

                          </div>
                        </div>
                      </div>
                      </div>
                             <div class="modal" id="smsmodal_'.$row->Id.'">
                        <div class="modal-dialog">
                          <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                              <h4 class="modal-title">Send sms</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                              <div class="form-group">
                                <label>Message</label>
                                <textarea class="form-control" id="smsg_'.$row->Id.'"></textarea>
                                <input type="hidden" value="'.$result['students'][$i]->Phone.'" id="phone_'.$row->Id.'">
                              </div>
                               <div id="ssmsg_'.$row->Id.'"> </div>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                             
                              <button type="button" class="sendsms btn btn-primary" id="'.$result['students'][$i]->Id.'" value="'.$row->Id.'">Send</button>
                           

                          </div>
                        </div>
                      </div></div>
                        <div class="modal" id="emailmodal_'.$row->Id.'">
                        <div class="modal-dialog">
                          <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                              <h4 class="modal-title">Send email</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                               <div class="form-group">
                                <label>Subject</label>
                                <input type="text" name="" class="form-control" id="sub_'.$row->Id.'">
                              </div>
                              <div class="form-group">
                                <label>Message</label>
                                <textarea class="form-control" id="emsg_'.$row->Id.'"></textarea>
                                 <input type="hidden" value="'.$result['students'][$i]->Email.'" id="email_'.$row->Id.'">
                              </div>
                               <div id="esmsg_'.$row->Id.'"></div>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                             
                              <button type="button" value="'.$row->Id.'" class="sendemail btn btn-primary">Send</button>
                            

                          </div>
                        </div>
                      </div></div>';
                           $i++;
                          }
                        }
                          echo $output;
  }
  function fetchmonthlyunclearfees(){
    $month=$this->input->post("month");
    $year=$this->input->post("year");
    $result=$this->Fees_Model->fetchmonthlyunclearfees($month,$year);
    $this->unclearfees($result);
  }
  function unclearfees($result){

    $pmethod=$this->Setting_Model->fetchpaymentcategories();
    $output='';
      $i=0;
                      if(count($result['income'])>0){
                          foreach($result['income'] as $row) {
                            $this->session->set_userdata('unclearid',$row->Id);
                         $output.='<div class="row">
                                  <div class="col-md-9">
                                <h4>'.($row->AmountUnclear).'/- Rs.</h4>
                                <p><a href="'.base_url().'admin/student/studentdetails/'.$result['students'][$i]->Id.'"><i class="fas fa-user" aria-hidden="true"></i>&nbsp;'.$result['students'][$i]->FirstName.' '.$result['students'][$i]->MiddleName.' '.$result['students'][$i]->LastName.'</a> &nbsp;&nbsp;<span><i class="far fa-calendar-alt text-primary"></i> '.$row->PaymentDate.' </span><!--&nbsp;&nbsp;<a href="#" data-toggle="modal"data-target="#emailmodal_'.$row->Id.'"><i class="fas fa-envelope" aria-hidden="true"></i> Email</a>
                                  &nbsp; &nbsp;<a href="#" data-toggle="modal" data-target="#smsmodal_'.$row->Id.'"><i class="fas fa-sms"></i> SMS</a>--></p>
                                </div>
                                <div class="col-md-3">
                                  <a href="#" class="btn btn-success" data-toggle="modal" data-target="#editmodal_'.$row->Id.'"><i class="fas fa-money-bill-alt"></i>&nbsp;&nbsp; update status</a>
                                </div>
                              </div>
                             <hr>
                <div class="modal" id="editmodal_'.$row->Id.'">
                  <div class="modal-dialog">
                    <div class="modal-content">

                      <!-- Modal Header -->
                      <div class="modal-header">
                        <h4 class="modal-title">Update status</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                      <input type="hidden" id="studid_'.$row->Id.'" value="'.$result['students'][$i]->Id.'" name="">
                      <!-- Modal body -->
                      <div class="modal-body">
                    <div class="form-group row">
                    <label class="col-md-3">Installment amount</label>
                    <div class="col-md-9">
                      <input type="text" class="form-control" name="iamount" disabled id="iamount_'.$row->Id.'" value="'.$row->Amount.'">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3">Amount remaining</label>
                    <div class="col-md-9">
                      <input type="text" class="form-control" disabled name="parmount" id="paremaining_'.$row->Id.'" value="'.($row->Amount-$row->AmountPaid).'">
                    </div>
                  </div>   
                    <div class="form-group row">
                    <label class="col-md-3">Amount unclear</label>
                    <div class="col-md-9">
                      <input type="text" class="form-control" name="pamount" id="pamount_'.$row->Id.'" disabled value="'.$row->AmountUnclear.'">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3">Payment status</label>
                    <div class="col-md-9">
                      <select class="form-control" id="pstatus_'.$row->Id.'">
                        <option value="Paid" selected>Paid</option>
                        <option value="Unpaid">Unpaid</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3">Payment Method</label>
                    <div class="col-md-9">
                      <select class="form-control" id="pmethod_'.$row->Id.'">';
                        foreach ($pmethod as $method) {
                          $output.=' <option value="'.$method->Id.'">'.$method->PaymentCategory.'</option>';
                        }
                      $output.='</select>
                    </div>
                  </div>
                    <div class="form-group row">
                    <label class="col-md-3">Postdated date(optional)</label>
                    <div class="col-md-9">
                      <input type="date" class="form-control" name="" id="pdate_'.$row->Id.'" value="'.$row->PostDate.'">
                    </div>
                  </div> 
                  <div id="unlcearmsg_'.$row->Id.'"></div> 
                      </div>

                      <!-- Modal footer -->
                      <div class="modal-footer">
                        <button type="button" class="updateunclear btn btn-success" value="'.$row->Id.'">Update</button>
                      </div>

                    </div>
                  </div>
                  </div>
                             <div class="modal" id="smsmodal_'.$row->Id.'">
                        <div class="modal-dialog">
                          <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                              <h4 class="modal-title">Send sms</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                              <div class="form-group">
                                <label>Message</label>
                                <textarea class="form-control" id="smsg_'.$row->Id.'"></textarea>
                                <input type="hidden" value="'.$result['students'][$i]->Phone.'" id="phone_'.$row->Id.'">
                              </div>
                              <div id="ssmsg_'.$row->Id.'">   </div>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                              <button type="button" class="sendsms btn btn-primary" id="'.$result['students'][$i]->Id.'" value="'.$row->Id.'">Send</button>
                         

                          </div>
                        </div>
                      </div></div>
                        <div class="modal" id="emailmodal_'.$row->Id.'">
                        <div class="modal-dialog">
                          <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                              <h4 class="modal-title">Send email</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                               <div class="form-group">
                                <label>Subject</label>
                                <input type="text" name="" class="form-control" id="sub_'.$row->Id.'">
                              </div>
                              <div class="form-group">
                                <label>Message</label>
                                <textarea class="form-control" id="emsg_'.$row->Id.'"></textarea>
                                 <input type="hidden" value="'.$result['students'][$i]->Email.'" id="email_'.$row->Id.'">
                              </div>
                              <div id="esmsg_'.$row->Id.'"> </div>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                              <button type="button" value="'.$row->Id.'" class="sendemail btn btn-primary">Send</button>
                           

                          </div>
                        </div>
                      </div></div>';
                           $i++;
                          }
                          }
                          echo $output;
  }
  
}
?>