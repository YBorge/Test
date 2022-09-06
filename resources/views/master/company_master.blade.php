@extends('layout')
  
@section('content')

<div class="container-fluid">
<div class="panel panel-primary">
<div class="panel-heading" style="padding: 10px;"><b>Add Company Details</b></div>
<div class="panel-body" >
    <div class="row">
    <form id="companyMaster" name="companyMaster" method="POST">
        {{ csrf_field() }} 
        <div class="col-md-1" class="form-group">
            <label style="color:black;" >Code <span style="color:red;">*</span></label>
            <input type="text" name="comp_code" id="comp_code" class="form-control">
            <span class="text-danger"><strong id="txtcode-error"></strong></span>
        </div>
        <div class="col-md-4" class="form-group">
            <label style="color:black;">Company Name <span style="color:red;">*</span></label>
            <input type="text" name="txt_comname" id="txt_comname" placeholder="Company Name" class="form-control" style='text-transform:uppercase'>
            <span class="text-danger"><strong id="txt_comname-error"></strong></span>
        </div>
        <div class="col-md-2" class="form-group">
            <label style="color:black;" >Type<span style="color:red;">*</span></label>
            <select name="type" id="type" class="form-control">
                <option value="" >Select</option>
                @foreach($comp_type as $owener)
                <option value="{{$owener->list_value}}" >{{$owener->list_desc}}</option>
                @endforeach      
			</select> 
            <span class="text-danger"><strong id="txt_type-error"></strong></span>
        </div>
        <div class="col-md-3" class="form-group">
            <label style="color:black;">Address 1<span style="color:red;">*</span></label>
            <input type="text" name="addr1" id="addr1" class="form-control" placeholder="Address 1"value="">
            <span class="text-danger"><strong id="txt_addr1-error"></strong></span>	
        </div>
        <div class="col-md-2" class="form-group">
            <label style="color:black;">Address 2</label>
            <input type="text" name="addr2" id="addr2" class="form-control" placeholder="Address 2"value="">	
        </div>
        <div class="col-md-2" class="form-group">
            <label style="color:black;">Address 3</label>
            <input type="text" name="addr3" id="addr3" class="form-control" placeholder="Address 3"value="">	
        </div>
        <div class="col-md-2" class="form-group">
            <label>City <span style="color:red;">*</span></label>
            <select name="city" id="city" class="form-control">
                <option value="" >Select</option>
                @foreach($comp_city as $key => $city_value)
                <option value="{{$city_value->city_id}}" >{{$city_value->city_name}}</option>
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
            <label style="color:black;">STD Code</label>
            <input type="text" name="std_code" id="std_code" class="form-control" placeholder="STD Code"value="" onkeypress="return isNumber(event)">		
        </div>
        <div class="col-md-2" class="form-group">
            <label style="color:black;">Telephone</label>
            <input type="text" name="phone" id="phone" class="form-control" placeholder="Telephone"value=""onkeypress="return isNumber(event)">		
        </div>
        <div class="col-md-2" class="form-group">
            <label style="color:black;">Mobile</label>
            <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Mobile"value="">		
        </div>
        <div class="col-md-2" class="form-group">
            <label style="color:black;">GSTIN</label>
            <input type="text" name="gstin" id="gstin" class="form-control" placeholder="GST NO"value="" style='text-transform:uppercase'>		
        </div>
        <div class="col-md-2" class="form-group">
            <label style="color:black;">FSSAI No</label>
            <input type="text" name="fassano" id="fassano" class="form-control" placeholder="FSSAI No"value="" style='text-transform:uppercase'>		
        </div>
        <div class="col-md-2" class="form-group">
            <label style="color:black;">CIN No</label>
            <input type="text" name="cinno" id="cinno" class="form-control" placeholder="CIN No"value="" style='text-transform:uppercase'>		
        </div>
        <div class="col-md-2" class="form-group">
            <label style="color:black;">PAN</label>
            <input type="text" name="panno" id="panno" class="form-control" placeholder="PAN"value="" style='text-transform:uppercase'>		
        </div>
        <div class="col-md-2" class="form-group">
            <label style="color:black;">TAN No</label>
            <input type="text" name="tanno" id="tanno" class="form-control" placeholder="TAN No"value=""style='text-transform:uppercase'>		
        </div>
        <div class="col-md-2" class="form-group">
            <label style="color:black;">LST/TIN/TPIN No</label>
            <input type="text" name="lsttinpinno" id="lsttinpinno" class="form-control" placeholder="LST/TIN/TPIN No"value="" style='text-transform:uppercase'>		
        </div>
        <div class="col-md-2" class="form-group">
            <label style="color:black;">CST No</label>
            <input type="text" name="cstno" id="cstno" class="form-control" placeholder="CST No"value="">		
        </div>
        <div class="col-md-2" class="form-group">
            <label style="color:black;">CO-REGN No</label>
            <input type="text" name="coregnno" id="coregnno" class="form-control" placeholder="CO-REGN No"value="">		
        </div>
        <div class="col-md-2" class="form-group">
            <label style="color:black;">CO-REGN Date</label>
            <input type="date" name="coregndate" id="coregndate" class="form-control" placeholder="CO-REGN No"value="">		
        </div>
        <div class="col-md-2" class="form-group">
            <label style="color:black;">DRUG LIC No</label>
            <input type="text" name="druglicno" id="druglicno" class="form-control" placeholder="DRUG LIC  No"value="">		
        </div>
        <div class="col-md-2" class="form-group">
            <label style="color:black;">IMP/EXP No</label>
            <input type="text" name="importexport" id="importexport" class="form-control" placeholder="EMP/EXP No"value="">		
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
                    <th class="header" scope="col">No</th>
                    <th class="header" scope="col">Code</th>
                    <th class="header" scope="col">Name</th>
                    <th class="header" scope="col">Active</th>
                    <th class="header" scope="col">Type</th>
                    <th class="header" scope="col">Address1</th>
                    <th class="header" scope="col">Address2</th>
                    <th class="header" scope="col">Address3</th>
                    <th class="header" scope="col">Country</th>
                    <th class="header" scope="col">Country Code</th>
                    <th class="header" scope="col">State</th>
                    <th class="header" scope="col">State Code</th>
                    <th class="header" scope="col">City</th>
                    <th class="header" scope="col">STD Code</th>
                    <th class="header" scope="col">Telephone</th>
                    <th class="header" scope="col">Mob-Cnt-Code</th>
                    <th class="header" scope="col">Mobile</th>
                    <th class="header" scope="col">GSTIN</th>
                    <th class="header" scope="col">FSSAI NO</th>
                    <th class="header" scope="col">CIN NO</th>
                    <th class="header" scope="col">PAN</th>
                    <th class="header" scope="col">TAN</th>
                    <th class="header" scope="col">LST/TPIN/TIN</th>
                    <th class="header" scope="col">CST NO</th>
                    <th class="header" scope="col">Co-Regn No</th>
                    <th class="header" scope="col">Drug Lic No</th>
                    <th class="header" scope="col">IMP/EXP</th>
                    <th class="header" scope="col">Created BY</th>
                    <th class="header" scope="col">Created Date and Time</th>
                    <th class="header" scope="col">Upadted Date and Time </th>
                </tr>
            </thead>
                        @if(count($comp_masterdata) < 1)
                        <tr>
                            <td>No Product Found.</td>
                        </tr>
                        @else
                        @php $srNo=0; @endphp
                        @foreach($comp_masterdata as $mast_value)
                        <tr>
                            <td>{{++$srNo}}</td>
                            <td>{{$mast_value->comp_code}}</td>
                            <td>{{$mast_value->comp_name}}</td>
                            <td></td>
                            <td>{{$comp_type_master[$mast_value->type]}}</td>
                            <td>{{$mast_value->addr1}}</td>
                            <td>{{$mast_value->addr2}}</td>
                            <td>{{$mast_value->addr3}}</td>
                            <td>{{$country_master[$mast_value->country]}}</td>
                            <td>{{$mast_value->country}}</td>
                            <td>{{$state_master[$mast_value->state]}}</td>
                            <td>{{$mast_value->state}}</td>
                            <td>{{$city_master[$mast_value->city]}}</td>
                            <td>{{$mast_value->std_code}}</td>
                            <td>{{$mast_value->phone}}</td>
                            <td>{{$mast_value->country}}</td>
                            <td>{{$mast_value->mobile}}</td>
                            <td>{{$mast_value->gstin}}</td>
                            <td>{{$mast_value->fassano}}</td>
                            <td>{{$mast_value->cinno}}</td>
                            <td>{{$mast_value->panno}}</td>
                            <td>{{$mast_value->tanno}}</td>
                            <td>{{$mast_value->lsttinpinno}}</td>
                            <td>{{$mast_value->cstno}}</td>
                            <td>{{$mast_value->coregnno}}</td>
                            <td>{{$mast_value->druglicno}}</td>
                            <td>{{$mast_value->importexport}}</td>
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
            var form=$("#companyMaster");
            $('#btn_submit').click(function(e){
                 e.preventDefault();
                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                     }
                 });
                 $.ajax({
                    url: "{{ url('company_master_post') }}",
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
                            $('#companyMaster')[0].reset();
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
      </script>

@endsection