@extends('layout')
  
@section('content')

<div class="container-fluid">
    <div class="row form-group"> 
        <div class="col-md-2" class="form-group" style="padding-top:22px;">
            <a href="{{route('item_master_add')}}" class="btn btn-success"> Add Item </a>	
        </div>
    </div>
<div class="panel panel-primary">
<div class="panel-heading"><b>List Of Item</b></div>
<div class="panel-body" >
    
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
                    <th class="header" scope="col">View</th>
                    <th class="header" scope="col">No</th>
                    <th class="header" scope="col">Status</th>
                    <th class="header" scope="col">Code</th>
                    <th class="header" scope="col">Name</th>
                    <th class="header" scope="col">Weight</th>
                    <th class="header" scope="col">Unit</th>
                    <th class="header" scope="col">Item Type</th>
                    <th class="header" scope="col">Parent Item</th>
                    <th class="header" scope="col">Pack Charge</th>
                    <th class="header" scope="col">Label Reqd</th>
                    <th class="header" scope="col">Qty In Case</th>
                    <th class="header" scope="col">Tax (%)</th>
                    <th class="header" scope="col">Sub Category</th>
                    <th class="header" scope="col">Category</th>
                    <th class="header" scope="col">Category Type</th>
                    <th class="header" scope="col">Inventory</th>
                    <th class="header" scope="col">Brand</th>
                    <th class="header" scope="col">Manufacturer</th>
                    <th class="header" scope="col">MarkUp (%)</th>
                    <th class="header" scope="col">MarkDown (%)</th>
                    <th class="header" scope="col">Rate Update</th>
                    <th class="header" scope="col">HSN No</th>
                    <th class="header" scope="col">Expiry Reqired</th>
                    <th class="header" scope="col">ShelfLife</th>
                    <th class="header" scope="col">Shelf Life D/M</th>
                    <th class="header" scope="col">Group 1</th>
                    <th class="header" scope="col">Group 2</th>
                    <th class="header" scope="col">Group 3</th>
                    <th class="header" scope="col">Group 4</th>
                    <th class="header" scope="col">Bar Code</th>
                    <th class="header" scope="col">Created By</th>
                    <th class="header" scope="col">Created Date and Time</th>
                    <th class="header" scope="col">Updated By</th>
                    <th class="header" scope="col">Updated Date and Time</th>
                </tr>
            </thead>
                        
            </table>                   
        </div>  
    </div>
</div>

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
        
      </script>

@endsection