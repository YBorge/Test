@extends('layout')
  
@section('content')

<div class="container-fluid">
<div class="panel panel-primary">
<div class="panel-heading" style="padding: 10px;"><b>Add Vendors</b></div>
<div class="panel-body" >
    <div class="row">
    <form id="vendorMaster" name="vendorMaster" method="POST">
        {{ csrf_field() }} 
        <div class="col-md-2" class="form-group">
            <label style="color:black;" >Vendor Code <span style="color:red;">*</span></label>
            @if($vendorCodeSeq=='Y')
            <input type="text" name="loc_code" id="loc_code" class="form-control" placeholder="Vendor Code" readonly>
            @else
            <input type="text" name="loc_code" id="loc_code" class="form-control" placeholder="Vendor Code">
            @endif
        </div>
        <div class="col-md-2" class="form-group">
            <label style="color:black;">Vendor Name <span style="color:red;">*</span></label>
            <input type="text" name="loc_no" id="loc_no" placeholder="Vendor Name" class="form-control" onkeypress="return isNumber(event)">
        </div>
        <div class="col-md-3" class="form-group">
            <label style="color:black;">Type <span style="color:red;">*</span></label>
            <select name="" id="" class="form-control">
                <option value="">Select</option>
                @foreach($suply_type as $typkey => $suptype)
                <option value="{{$typkey}}">{{$suptype}}</option>
                @endforeach
            </select>	
        </div>
        <div class="col-md-3" class="form-group">
            <label>Credit Days</label>
            <input type="text" name="txt_creditdays" id="txt_creditdays" placeholder="Credit Days" class="form-control" onkeypress="return isNumber(event)">	
        </div>
        <div class="col-md-2" class="form-group">
            <label style="color:black;">Address 1 <span style="color:red;">*</span></label>
            <input type="text" name="addr1" id="addr1" class="form-control" placeholder="Address 1"value="">	
        </div>
        <div class="col-md-2" class="form-group">
            <label style="color:black;">Address 2</label>
            <input type="text" name="addr2" id="addr2" class="form-control" placeholder="Address 2"value="">	
        </div>
        <div class="col-md-2" class="form-group">
            <label>City <span style="color:red;">*</span></label>
            <select name="city" id="city" class="form-control">
                <option value="" >Select</option>
                @foreach($city_master as $citykey => $cityval)
                <option value="{{$citykey}}">{{$cityval}}</option>
                @endforeach    
			</select>
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
            <label style="color:black;">Pin Code</label>
            <input type="text" name="pin" id="pin" class="form-control" placeholder="PIN CODE" value="">		
        </div>
        <div class="col-md-2" class="form-group">
            <label style="color:black;">Phone No</label>
            <input type="text" name="phone_no" id="phone_no" class="form-control" placeholder="Phone No"value="" onkeypress="return isNumber(event)">		
        </div>
        <div class="col-md-2" class="form-group">
            <label style="color:black;">GSTIN</label>
            <input type="text" name="gstin" id="gstin" class="form-control" placeholder="GST NO"value="" style='text-transform:uppercase'>		
        </div>
        <div class="col-md-2" class="form-group">
            <label>FSSAI No </label>
            <input type="text" name="txt_fssaino" id="txt_fssaino" class="form-control" placeholder="FSSAI No"value="" style='text-transform:uppercase'>		
        </div>
        <div class="col-md-2" class="form-group">
            <label>Aadhar No </label>
            <input type="text" name="txt_adhar" id="txt_adhar" placeholder="Aadhar No" class="form-control" maxlength="12" onkeypress="return isNumber(event)">		
        </div>
        <div class="col-md-2" class="form-group">
            <label>PAN</label>
            <input type="text" name="txt_pan" id="txt_pan" class="form-control" placeholder="PAN"value="" style='text-transform:uppercase'>		
        </div>
        <div class="col-md-2" class="form-group">
            <label>Contact Person</label>
            <input type="text" name="txt_contact" id="txt_contact" placeholder="Contact" class="form-control">
        </div>
        <div class="col-md-2" class="form-group" style="padding-top:22px;">
            <input type="submit" name="btn_submit" id="btn_submit" value="Add" class="btn btn-success">	
        </div>
    </div>
    </div>
    <style>
        .header{
            position:sticky;
            top: 0 ;
        }
        .table-responsive {
            /* width: 600px; */
            height: 300px;
            overflow: auto;
        }
    </style>
    <div class="table-responsive">
        <table class="mytable table table-bordered" id="example" class="display nowrap" style="width:100%">
            <thead style="position: sticky;top: 0" class="thead-dark">
                <tr>
                    <th class="header" scope="col">Sr. No</th>
                    <th class="header" scope="col">Location  Code</th>
                    <th class="header" scope="col">Location  No</th>
                    <th class="header" scope="col">Location  Name</th>
                    <th class="header" scope="col">Company</th>
                    <th class="header" scope="col">Address 1</th>
                    <th class="header" scope="col">Address 2</th>
                    <th class="header" scope="col">City</th>
                    <th class="header" scope="col">State</th>
                    <th class="header" scope="col">Country</th>
                    <th class="header" scope="col">Pin Code</th>
                    <th class="header" scope="col">Phone No</th>
                    <th class="header" scope="col">GSTIN</th>
                    <th class="header" scope="col">Bank Name</th>
                    <th class="header" scope="col">Bank A/C No</th>
                    <th class="header" scope="col">Created By</th>
                    <th class="header" scope="col">Created Date and Time</th>
                    <th class="header" scope="col">Updated Date and Time</th>
                </tr>
            </thead>
                        
            </table>                   
        </div>  
    </div>
</div>
</form>
<script>
         $(document).ready(function(){
            var form=$("#branchMaster");
            $('#btn_submit').click(function(e){
                 e.preventDefault();
                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                     }
                 });
                 $.ajax({
                    url: "{{ url('branch_master_post') }}",
                    method: 'post',
                    data:form.serialize(),
                    success: function(data)
                    {
                       if(data.errors) 
                       {
                            toastr.error(data.errors);
                            // $.each(data.errors, function(index, jsonObject) {
                            //       $.each(jsonObject, function(key, val) { 
                            //      toastr.error(val);
                            //       });
                            //    });
                       }
                       if(data.success) 
                       {
                            toastr.success('Data Saved Successfully');
                            $('#branchMaster')[0].reset();
                            location.reload();
                          
                       }
                    },
                    error: function(data) {
                    }
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
         });
        function isNumber(evt) 
        {
            var iKeyCode = (evt.which) ? evt.which : evt.keyCode
            if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57) && iKeyCode != 9){
            alert("Please Enter Numbers Only");
                return false;
            }
            return true;
        }
      </script>

@endsection