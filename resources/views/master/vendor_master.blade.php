@extends('layout')
  
@section('content')

<div class="container-fluid">
<div class="panel panel-primary">
<div class="panel-heading" style="padding: 10px;"><b>Add Vendors</b></div>
<div class="panel-body" >
    <div class="row">
    <form id="vendorMaster" name="vendorMaster" method="POST">
        {{ csrf_field() }} 
        <div class="col-md-1" class="form-group">
            <label style="color:black;" >Vendor Code <span style="color:red;">*</span></label>
            @if($vendorCodeSeq=='Y')
            <input type="text" name="vend_code" id="vend_code" class="form-control" placeholder="Vendor Code" readonly>
            @else
            <input type="text" name="vend_code" id="vend_code" class="form-control" placeholder="Vendor Code">
            @endif
        </div>
        <div class="col-md-3" class="form-group">
            <label style="color:black;">Vendor Name <span style="color:red;">*</span></label>
            <input type="text" name="vend_name" id="vend_name" placeholder="Vendor Name" class="form-control">
        </div>
        <div class="col-md-2" class="form-group">
            <label style="color:black;">Type <span style="color:red;">*</span></label>
            <select name="type" id="type" class="form-control">
                <option value="">Select</option>
                @foreach($suply_type as $typkey => $suptype)
                <option value="{{$typkey}}">{{$suptype}}</option>
                @endforeach
            </select>	
        </div>
        <div class="col-md-2" class="form-group">
            <label>Credit Days</label>
            <input type="text" name="credit_day" id="credit_day" placeholder="Credit Days" class="form-control" onkeypress="return isNumber(event)">	
        </div>
        <div class="col-md-2" class="form-group">
            <label style="color:black;">Address 1 <span style="color:red;">*</span></label>
            <input type="text" name="aadr1" id="aadr1" class="form-control" placeholder="Address 1"value="">	
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
            <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone No"value="" onkeypress="return isNumber(event)">		
        </div>
         <div class="col-md-2" class="form-group">
            <label style="color:black;">Email</label>
            <input type="text" name="email" id="email" class="form-control" placeholder="Email"value="">     
        </div>
        <div class="col-md-1" class="form-group">
            <label style="color:black;">GSTIN</label>
            <input type="text" name="gstin" id="gstin" class="form-control" placeholder="GST NO"value="" style='text-transform:uppercase'>		
        </div>
        <div class="col-md-1" class="form-group">
            <label>FSSAI No </label>
            <input type="text" name="fassi_no" id="fassi_no" class="form-control" placeholder="FSSAI No"value="" style='text-transform:uppercase'>		
        </div>
        <div class="col-md-2" class="form-group">
            <label>Aadhar No </label>
            <input type="text" name="aadhar_no" id="aadhar_no" placeholder="Aadhar No" class="form-control" maxlength="12" onkeypress="return isNumber(event)">		
        </div>
        <div class="col-md-2" class="form-group">
            <label>PAN</label>
            <input type="text" name="pan_no" id="pan_no" class="form-control" placeholder="PAN"value="" style='text-transform:uppercase'>		
        </div>
        <div class="col-md-2" class="form-group">
            <label>Contact Person</label>
            <input type="text" name="contact_person" id="contact_person" placeholder="Contact" class="form-control">
        </div>
        <div class="col-md-4" class="form-group" style="padding-top:22px;">
            <input type="submit" name="btn_submit" id="btn_submit" value="Add" class="btn btn-success">
            <input type="submit" name="btn_cancel_payment" id="btn_cancel_payment" value="Clear" class="btn btn-danger">
            <a href="{{route('vendor_master_pdf')}}" target="_blank" class="btn btn-primary">PDF</a>
            <button class="btn btn-primary" formaction="{{route('vendor_master_excel')}}" id="btn" type="submit">Excel</button>	
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
                    <th class="header" scope="col">Edit</th>
                    <th class="header" scope="col">Sr. No</th>
                    <th class="header" scope="col">Code</th>
                    <th class="header" scope="col">Name</th>
                    <th class="header" scope="col">Type</th>
                    <th class="header" scope="col">Credit Days</th>
                    <th class="header" scope="col">Address 1</th>
                    <th class="header" scope="col">Address 2</th>
                    <th class="header" scope="col">City</th>
                    <th class="header" scope="col">State</th>
                    <th class="header" scope="col">Country</th>
                    <th class="header" scope="col">Pin Code</th>
                    <th class="header" scope="col">Phone No</th>
                    <th class="header" scope="col">Email</th>
                    <th class="header" scope="col">GSTIN</th>
                    <th class="header" scope="col">FASSI No</th>
                    <th class="header" scope="col">Aadhar No</th>
                    <th class="header" scope="col">Pan No</th>
                    <th class="header" scope="col">Contact Person</th>
                    <th class="header" scope="col">Status</th>
                    <th class="header" scope="col">Created By</th>
                    <th class="header" scope="col">Created Date and Time</th>
                    <th class="header" scope="col">Updated By</th>
                    <th class="header" scope="col">Updated Date and Time</th>
                </tr>
            </thead>
                @php $srNo=0; $arrOfStatus=array(); $arrOfStatus['Y']='Active'; $arrOfStatus['N']='In-Active';@endphp
                @foreach($vendor_master_data as $venKey => $venvalue)
                <tr>
                    <th></th>
                    <th>{{++$srNo}}</th>
                    <th>{{$venvalue->vend_code}}</th>
                    <th>{{$venvalue->vend_name}}</th>
                    <th>{{$suply_type[$venvalue->type]}}</th>
                    <th>{{$venvalue->credit_day}}</th>
                    <th>{{$venvalue->aadr1}}</th>
                    <th>{{$venvalue->addr2}}</th>
                    <th>{{$city_master[$venvalue->city]}}</th>
                    <th>{{$state_master[$venvalue->state]}}</th>
                    <th>{{$country_master[$venvalue->country]}}</th>
                    <th>{{$venvalue->pin}}</th>
                    <th>{{$venvalue->phone}}</th>
                    <th>{{$venvalue->email}}</th>
                    <th>{{$venvalue->gstin}}</th>
                    <th>{{$venvalue->fassi_no}}</th>
                    <th>{{$venvalue->aadhar_no}}</th>
                    <th>{{$venvalue->pan_no}}</th>
                    <th>{{$venvalue->contact_person}}</th>
                    <th>{{$arrOfStatus[$venvalue->status]}}</th>
                    <th>{{$venvalue->created_by}}</th>
                    <th>{{$venvalue->created_at}}</th>
                    <th>{{$venvalue->t_user}}</th>
                    <th>{{$venvalue->updated_at}}</th>
                </tr>
                @endforeach    
            </table>                   
        </div>  
    </div>
</div>
</form>
<script>
         $(document).ready(function(){
            var form=$("#vendorMaster");
            $('#btn_submit').click(function(e){
                 e.preventDefault();
                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                     }
                 });
                 $.ajax({
                    url: "{{ url('vendor_master_store') }}",
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
                            $('#vendorMaster')[0].reset();
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
                    url: "{{ url('vendor_city_change') }}",
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
        
        $('#btn_cancel_payment').click(function(){
            $('#vendorMaster')[0].reset();
            return false;
        });
      </script>

@endsection
