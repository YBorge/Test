@extends('layout')
  
@section('content')
<form id="brandMaster" name="brandMaster" method="POST">
    {{ csrf_field() }} 
<div class="container-fluid">
    <div class="col-md-6">
        <div class="panel panel-success">
            <div class="panel-heading" style="padding: 10px;"><b>Add Manufacturing Company</b></div>
            <div class="panel-body" >
            <div class="row">
                <div class="col-md-2" class="form-group">
                    <label style="color:black;" >Code <span style="color:red;">*</span></label>
                    @if($manufSeq[0]['param_value']=='Y')
                    <input type="text" name="manufact_code" id="manufact_code" class="form-control" placeholder="Code" value="{{$mancode}}" readonly>
                    @else
                    <input type="text" name="manufact_code" id="manufact_code" class="form-control" placeholder="Code" value="0" onkeypress="return isNumber(event)">
                    @endif
                </div>
                <div class="col-md-3" class="form-group">
                    <label style="color:black;">Name <span style="color:red;">*</span></label>
                    <input type="text" name="manufact_name" id="manufact_name" placeholder="Name" class="form-control">
                </div>
                <div class="col-md-3" class="form-group">
                    <label style="color:black;">Type <span style="color:red;">*</span></label>
                    <select name="type" id="type" class="form-control">
                        <option value="">Select</option>
                        <option value="B">Branded</option>
                        <option value="U">Unbranded</option>
                    </select>
                </div>
               
                @php  
                $arrOfYesNo=array(); $arrOfYesNo['Y']='Yes'; $arrOfYesNo['N']='No'; 
                $arrOfStatus=array(); $arrOfStatus['Y']='Active'; $arrOfStatus['N']='In-Active';
                @endphp
               
                <div class="col-md-4" style="padding-top:25px;">
                    <input type="submit" name="manu_btn_submit" id="manu_btn_submit" value="Add" class="btn btn-success btn-xs">&nbsp;
                    <input type="submit" name="btn_cancel" id="btn_cancel" value="Clear" class="btn btn-danger btn-xs"> 
                    <a href="{{route('cate_master_pdf')}}" target="_blank" class="btn btn-primary btn-xs">PDF</a>
                    <button class="btn btn-primary btn-xs" formaction="{{route('cate_master_excel')}}" id="btn" type="submit">Excel</button>
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
                <div class="table-responsive col-md-12 form-group" style="padding-top:1px;">
                    <table class="mytable table table-bordered" id="example" class="display nowrap">
                        <thead style="position: sticky;top: 0" class="thead-dark">
                            <tr>
                                <th class="header" scope="col">Select</th>
                                <th class="header" scope="col">Sr. No</th>
                                <th class="header" scope="col">Code</th>
                                <th class="header" scope="col">Name</th>
                                <th class="header" scope="col">Type</th>
                               
                                <th class="header" scope="col">Status</th>
                                <th class="header" scope="col">Created By</th>
                                <th class="header" scope="col">Created Date and Time</th>
                                <th class="header" scope="col">Updated Date and Time</th>
                            </tr>
                        </thead>
                                
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-success">
            <div class="panel-heading" style="padding: 10px;"><b>Add Brand</b></div>
            <div class="panel-body" >
            <div class="row">
                <div class="col-md-2" class="form-group">
                    <label style="color:black;" >Code <span style="color:red;">*</span></label>
                    @if($manufSeq[0]['param_value']=='Y')
                    <input type="text" name="manufact_code" id="manufact_code" class="form-control" placeholder="Code">
                    @else
                    @php $readonlytext=""; @endphp
                    @endif
                    
                </div>
                <div class="col-md-3" class="form-group">
                    <label style="color:black;">Name <span style="color:red;">*</span></label>
                    <input type="text" name="sub_cat_name" id="sub_cat_name" placeholder="Sub Ctegory Name" class="form-control">
                </div>
                <div class="col-md-3" class="form-group">
                    <label style="color:black;">Manufacturer <span style="color:red;">*</span></label>
                    <select name="cat_code" id="cat_code" class="form-control">
                        <option value="" id="yes" readonly>Select</option>
                        
                    </select>
                </div>
                
                <div class="col-md-4" style="padding-top:25px;">
                    <input type="submit" name="subcate_btn_submit" id="subcate_btn_submit" value="Add" class="btn btn-success btn-xs" >&nbsp;
                    <input type="submit" name="btn_cancel" id="btn_cancel" value="Clear" class="btn btn-danger btn-xs">
                    <a href="{{route('sub_cate_master_pdf')}}" target="_blank" class="btn btn-primary btn-xs">PDF</a>
                    <button class="btn btn-primary btn-xs" formaction="{{route('sub_cate_master_excel')}}" id="btn" type="submit">Excel</button>
                </div>
               
                <div class="table-responsive col-md-12 form-group" style="padding-top:1px;">
                    <table class="mytable table table-bordered" id="example" class="display nowrap">
                        <thead style="position: sticky;top: 0" class="thead-dark">
                            <tr>
                                <th class="header" scope="col"></th>
                                <th class="header" scope="col">Sr. No</th>
                                <th class="header" scope="col">Code</th>
                                <th class="header" scope="col">Name</th>
                                <th class="header" scope="col">Category</th>
                                		
                                <th class="header" scope="col">Status</th>
                                <th class="header" scope="col">Created By</th>
                                <th class="header" scope="col">Created Date and Time</th>
                                <th class="header" scope="col">Updated Date and Time</th>
                            </tr>
                        </thead>
                               
                    </table>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
</form>
<script>
         $(document).ready(function(){
            var form=$("#brandMaster");
            $('#manu_btn_submit').click(function(e){
                 e.preventDefault();
                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                     }
                 });
                 $.ajax({
                    url: "{{ url('brand_master_post') }}",
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
                            $('#brandMaster')[0].reset();
                            location.reload();
                          
                       }
                    },
                    error: function(data) {
                    }
                 });
             });
             $('#subcate_btn_submit').click(function(e){
                 e.preventDefault();
                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                     }
                 });
                 $.ajax({
                    url: "{{ url('sub_cate_master_post') }}",
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
                            $('#cateMaster')[0].reset();
                            location.reload();
                          
                       }
                    },
                    error: function(data) {
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
        function CheckData(dataid)
        {
            return dataid;
        }
      </script>

@endsection
