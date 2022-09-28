@extends('layout')
  
@section('content')
<form id="custMaster" name="custMaster" method="POST">
    {{ csrf_field() }} 
<div class="container-fluid">
    <div class="col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading" style="padding: 10px;"><b>Customer Master</b></div>
            <div class="panel-body" >
                <div class="row">
                    <div class="col-md-2" class="form-group">
                        <label>Location <span style="color:red;">*</span></label>
                        <select name="loc_code" id="loc_code" class="form-control">
                            <option value="" >Select</option>
                            @foreach($loc_code as $key => $loc_value)
                            <option value="{{$key}}" >{{$loc_value}}</option>
                            @endforeach       
                        </select>
                    </div>
                    <div class="col-md-1" class="form-group">
                        <label style="color:black;" >Code <span style="color:red;">*</span></label>
                        @if($custSeq[0]['param_value']=='Y')
                        <input type="text" name="cust_code" id="cust_code" class="form-control" placeholder="Code" value="{{$custcode}}" readonly>
                        @else
                        <input type="text" name="cust_code" id="cust_code" class="form-control" placeholder="Code" value="0" onkeypress="return isNumber(event)">
                        @endif
                    </div>
                    <div class="col-md-3" class="form-group">
                        <label style="color:black;">Name <span style="color:red;">*</span></label>
                        <input type="text" name="cust_name" id="cust_name" placeholder="Name" class="form-control">
                    </div>
                    <div class="col-md-2" class="form-group">
                        <label style="color:black;">Gender <span style="color:red;">*</span></label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="">Select</option>
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                            <option value="T">Transgender</option>
                        </select>
                    </div>
                    <div class="col-md-2" class="form-group">
                        <label style="color:black;">Barcode <span style="color:red;">*</span></label>
                        <input type="text" name="barcode" id="barcode" placeholder="Card" class="form-control">
                    </div>  
                    <div class="col-md-2" class="form-group">
                        <label style="color:black;">Birth Date <span style="color:red;">*</span></label>
                        <input type="date" name="birth_date" id="birth_date" placeholder="Birth Date" class="form-control">
                    </div>
                    <div class="col-md-2" class="form-group">
                        <label style="color:black;">Join Date <span style="color:red;">*</span></label>
                        <input type="date" name="join_date" id="join_date" placeholder="Join Date" class="form-control">
                    </div>
                    <div class="col-md-3" class="form-group">
                        <label style="color:black;">Address1 <span style="color:red;">*</span></label>
                        <input type="text" name="addr1" id="addr1" placeholder="Address-1" class="form-control">
                    </div>
                    <div class="col-md-3" class="form-group">
                        <label style="color:black;">Address2 <span style="color:red;">*</span></label>
                        <input type="text" name="addr2" id="addr2" placeholder="Address-2" class="form-control">
                    </div>
                    <div class="col-md-2" class="form-group">
                        <label>City <span style="color:red;">*</span></label>
                        <select name="city" id="city" class="form-control">
                            <option value="" >Select</option>
                            @foreach($city_master as $key => $city_value)
                            <option value="{{$key}}" >{{$city_value}}</option>
                            @endforeach       
                        </select>
                        <span class="text-danger"><strong id="txt_city-error"></strong></span>
                    </div>
                    <div class="col-md-2" class="form-group">
                        <label>State</label>
                        <input type="text" name="state" id="state" class="form-control" placeholder="State Name" value="" readonly>
                        <input type="hidden" name="statepost" id="statepost" class="form-control" placeholder="State Name" value="">
                    </div>
                    <div class="col-md-2" class="form-group">
                        <label>Country</label>
                        <input type="text" name="country" id="country" class="form-control" placeholder="Country Name" value="" readonly>
                        <input type="hidden" name="countrypost" id="countrypost" class="form-control" placeholder="Country Name" value="">   	
                    </div>
                    <div class="col-md-2" class="form-group">
                        <label style="color:black;">PinCode</label>
                        <input type="text" name="std_code" id="std_code" class="form-control" placeholder="PinCode"value="" onkeypress="return isNumber(event)">		
                    </div>
                    <div class="col-md-2" class="form-group">
                        <label style="color:black;">Mobile</label>
                        <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Mobile" value="">		
                    </div>
                    <div class="col-md-2" class="form-group">
                        <label style="color:black;">Email</label>
                        <input type="mail" name="email" id="email" class="form-control" placeholder="Email" value="">		
                    </div>
                    <div class="col-md-2" class="form-group">
                        <label style="color:black;">PAN</label>
                        <input type="text" name="panno" id="panno" class="form-control" placeholder="PAN"value="" style='text-transform:uppercase'>		
                    </div>
                    <div class="col-md-2" class="form-group">
                        <label style="color:black;">Aadhar No</label>
                        <input type="text" name="aadharno" id="aadharno" class="form-control" placeholder="Aadhar NO" value="" style='text-transform:uppercase'>		
                    </div>
                    <div class="col-md-2" class="form-group">
                        <label style="color:black;">GSTIN</label>
                        <input type="text" name="gstin" id="gstin" class="form-control" placeholder="GST NO" value="" style='text-transform:uppercase'>		
                    </div>
                    <div class="col-md-2" class="form-group">
                        <label style="color:black;" >Customer Type<span style="color:red;">*</span></label>
                        <select name="cust_type" id="cust_type" class="form-control">
                            <option value="" >Select</option>
                            @foreach($cust_type_master as $key => $owener)
                            <option value="{{$key}}" >{{$owener}}</option>
                            @endforeach      
                        </select> 
                        <span class="text-danger"><strong id="txt_type-error"></strong></span>
                    </div>
                    <div class="col-md-2" class="form-group">
                        <label style="color:black;" >Ref. Customer<span style="color:red;">*</span></label>
                        <select name="ref_cust" id="ref_cust" class="form-control">
                            <option value="" >Select</option>
                            @foreach($ref_customer as $key => $owener)
                            <option value="{{$key}}" >{{$owener}}</option>
                            @endforeach      
                        </select> 
                        <span class="text-danger"><strong id="txt_type-error"></strong></span>
                    </div>
                    <div class="col-md-1" class="form-group">
                        <label style="color:black;">Credit Limit</label>
                        <input type="text" name="cr_limit" id="cr_limit" class="form-control" placeholder="Credit Limit" value="" onkeypress="return isNumber(event)">		
                    </div>
                    <div class="col-md-1" class="form-group">
                        <label style="color:black;">CR Over days</label>
                        <input type="text" name="cr_overdue" id="cr_overdue" class="form-control" placeholder="Overdue days" value="" onkeypress="return isNumber(event)">		
                    </div>

                    @php  
                    $arrOfYesNo=array(); $arrOfYesNo['Y']='Yes'; $arrOfYesNo['N']='No'; 
                    $arrOfStatus=array(); $arrOfStatus['Y']='Active'; $arrOfStatus['N']='In-Active';
                    @endphp
                
                    <div class="col-md-4" style="padding-top:22px;">
                        <input type="submit" name="cust_btn_submit" id="cust_btn_submit" value="Add" class="btn btn-success ">&nbsp;
                        <input type="submit" name="btn_cancel" id="btn_cancel" value="Clear" class="btn btn-danger "> 
                        <a href="#" target="_blank" class="btn btn-primary ">PDF</a>
                        <button class="btn btn-primary " formaction="#" id="btn" type="submit">Excel</button>
                    </div>
                    
                </div>
                <style>
                .header{
                    position:sticky;
                    top: 0 ;
                }
                .table-responsive {
                    /* width: 600px; */
                    height: 400px;
                    overflow: auto;
                }
                </style>
                <div class="table-responsive col-md-12 form-group" style="padding-top:25px;">
                    <table class="mytable table table-bordered" id="example" class="display nowrap">
                        <thead style="position: sticky;top: 0" class="thead-dark">
                            <tr>
                                <th class="header" scope="col">Sr. No</th>
                                <th class="header" scope="col">Code</th>
                                <th class="header" scope="col">Name</th>
                                <th class="header" scope="col">Gender</th>
                                <th class="header" scope="col">Barcode</th>
                                <th class="header" scope="col">Birth Date</th>
                                <th class="header" scope="col">Join Date</th>
                                <th class="header" scope="col">Address1</th>
                                <th class="header" scope="col">Address2</th>
                                <th class="header" scope="col">City</th>
                                <th class="header" scope="col">State Code</th>
                                <th class="header" scope="col">State</th>
                                <th class="header" scope="col">Country Code</th>
                                <th class="header" scope="col">Country</th>
                                <th class="header" scope="col">Pincode</th>
                                <th class="header" scope="col">Mobile</th>
                                <th class="header" scope="col">Email</th>
                                <th class="header" scope="col">PAN</th>
                                <th class="header" scope="col">Aadhar No</th>
                                <th class="header" scope="col">GSTIN</th>
                                <th class="header" scope="col">Cust-Type</th>
                                <th class="header" scope="col">Ref-Cust</th>
                                <th class="header" scope="col">CR Limit</th>
                                <th class="header" scope="col">CR Overdue Days</th>
                                <th class="header" scope="col">Status</th>
                                <th class="header" scope="col">Created By</th>
                                <th class="header" scope="col">Created Date</th>
                                <th class="header" scope="col">Updated By</th>
                                <th class="header" scope="col">Updated Date</th>
                            </tr>
                        </thead>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</div>
</form>
<script>
         $(document).ready(function(){
            var form=$("#custMaster");
            $('#cust_btn_submit').click(function(e){
                 e.preventDefault();
                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                     }
                 });
                 $.ajax({
                    url: "{{ url('cust_master_post') }}",
                    method: 'post',
                    data:form.serialize(),
                    success: function(data)
                    {
                       if(data.errors) 
                       {
                            toastr.error(data.errors);
                       }
                       if(data.success) 
                       {
                            toastr.success('Data Saved Successfully');
                            $('#custMaster')[0].reset();
                            location.reload();
                          
                       }
                    },
                    error: function(data) {
                    }
                 });
             });
             
             });

        $('#city').change(function(e){
                 e.preventDefault();
                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                     }
                 });
                 $.ajax({
                    url: "{{ url('company_master_city') }}",
                    method: 'post',
                    data:form.serialize(),
                     success: function(data)
                     {
                        if(data.StateCount.state)
                        {
                            $("#state").val(data.StateCount.state);
                        }
                        if(data.StateCount.comp_country)
                        {
                            $("#country").val(data.StateCount.comp_country);
                        }
                        if(data.StateCount.statecode)
                        {
                            $("#statepost").val(data.StateCount.statecode);
                        }
                        if(data.StateCount.countrycode)
                        {
                            $("#countrypost").val(data.StateCount.countrycode);
                        }
                        
                     }
                 });
             });
      </script>

@endsection
