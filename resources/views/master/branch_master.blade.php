@extends('layout')
  
@section('content')

<div class="container-fluid">
<div class="panel panel-primary">
<div class="panel-heading" style="padding: 10px;"><b>Add Location Details (Branch Master)</b></div>
<div class="panel-body" >
    <div class="row">
    <form id="branchMaster" name="branchMaster" method="POST">
        {{ csrf_field() }} 
        <div class="col-md-2" class="form-group">
            <label style="color:black;" >Location Code <span style="color:red;">*</span></label>
            <input type="text" name="loc_code" id="loc_code" class="form-control" placeholder="Location Code">
        </div>
        <div class="col-md-2" class="form-group">
            <label style="color:black;">Location No <span style="color:red;">*</span></label>
            <input type="text" name="loc_no" id="loc_no" placeholder="Location No" class="form-control" onkeypress="return isNumber(event)">
        </div>
        <div class="col-md-3" class="form-group">
            <label style="color:black;">Location Name <span style="color:red;">*</span></label>
            <input type="text" name="loc_name" id="loc_name" class="form-control" style='text-transform:uppercase' placeholder="Location Name"value="">	
        </div>
        <div class="col-md-3" class="form-group">
            <label style="color:black;">Company <span style="color:red;">*</span></label>
            <input type="text" name="comp_name" id="comp_name" class="form-control" value="{{ Session::get('companyname')}}" readonly>
            <input type="hidden" name="comp_code" id="comp_code" class="form-control" value="{{ Session::get('companycode')}}" readonly>	
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
                @foreach($comp_city as $key => $city_value)
                <option value="{{$key}}" >{{$city_value}}</option>
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
            <label style="color:black;">Bank Name</label>
            <input type="text" name="bank_code" id="bank_code" class="form-control" placeholder="Bank Name" value="">		
        </div>
        <div class="col-md-2" class="form-group">
            <label style="color:black;">Bank A/C No</label>
            <input type="text" name="bankacno" id="bankacno" class="form-control" placeholder="Bank A/C No"value="" onkeypress="return isNumber(event)">		
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
                        @if(count($comp_location_master) < 1)
                        <tr>
                            <td>No Product Found.</td>
                        </tr>
                        @else
                        @php $srNo=0; @endphp
                        @foreach($comp_location_master as $mast_value)
                        <tr>
                            <td>{{++$srNo}}</td>
                            <td>{{$mast_value->loc_code}}</td>
                            <td>{{$mast_value->loc_no}}</td>
                            <td>{{$mast_value->loc_name}}</td>
                            <td></td>
                            <td>{{$mast_value->addr1}}</td>
                            <td>{{$mast_value->addr2}}</td>
                            <td>{{$comp_city[$mast_value->city]}}</td>
                            <td>{{$state_master[$mast_value->state_code]}}</td>
                            <td>{{$country_master[$mast_value->country_code]}}</td>
                            <td>{{$mast_value->pin}}</td>
                            <td>{{$mast_value->phone_no}}</td>
                            <td>{{$mast_value->gstin}}</td>
                            <td>{{$mast_value->bank_code}}</td>
                            <td>{{$mast_value->bankacno}}</td>
                            <td>{{$mast_value->created_by}}</td>
                            <td>{{$mast_value->created_at}}</td>
                            <td>{{$mast_value->updated_at}}</td>
                        </tr> 
                        @endforeach
                    @endif
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