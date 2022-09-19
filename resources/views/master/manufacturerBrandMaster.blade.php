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
                    @if($manufSeq=='Y')
                    <input type="text" name="manufact_code" id="manufact_code" class="form-control" placeholder="Code" value="" readonly>
                    @else
                    <input type="text" name="manufact_code" id="manufact_code" class="form-control" placeholder="Code" value="" onkeypress="return isNumber(event)">
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
                $arrOfYesNo=array(); $arrOfYesNo['B']='Branded'; $arrOfYesNo['U']='Unbranded'; 
                $arrOfStatus=array(); $arrOfStatus['Y']='Active'; $arrOfStatus['N']='In-Active';
                @endphp
               
                <div class="col-md-4" style="padding-top:25px;">
                    <input type="submit" name="manu_btn_submit" id="manu_btn_submit" value="Add" class="btn btn-success btn-xs">&nbsp;
                    <input type="submit" name="btn_cancel" id="btn_cancel" value="Clear" class="btn btn-danger btn-xs"> 
                    <a href="{{route('brand_master_pdf')}}"  class="btn btn-primary btn-xs">PDF</a>
                    <button class="btn btn-primary btn-xs" formaction="{{route('brand_master_excel')}}" id="btn" type="submit">Excel</button>
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
                        <tbody>
                            @if(count($manfacData) < 1)
                                <tr>
                                    <td colspan="9">No Record Found.</td>
                                </tr>
                            @else
                            @php $srNo=0; @endphp
                            @foreach($manfacData as $mancf_value)
                            <tr>
                                <td></td>
                                <td>{{++$srNo}}</td>
                                <td>{{$mancf_value->manufact_code}}</td>
                                <td>{{$mancf_value->manufact_name}}</td>
                                <td>{{$arrOfYesNo[$mancf_value->type]}}</td>
                                <td>{{$arrOfStatus[$mancf_value->status]}}</td>
                                <td>{{$mancf_value->created_by}}</td>
                                <td>{{$mancf_value->created_at}}</td>
                                <td>{{$mancf_value->updated_at}}</td>
                                
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                                
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
                    @if($branAutoCode=='Y')
                    <input type="text" name="brand_code" id="brand_code" class="form-control" placeholder="Code" readonly onkeypress="return isNumber(event)">
                    @else
                    <input type="text" name="brand_code" id="brand_code" class="form-control" placeholder="Code" onkeypress="return isNumber(event)">
                    @endif
                    
                </div>
                <div class="col-md-3" class="form-group">
                    <label style="color:black;">Name <span style="color:red;">*</span></label>
                    <input type="text" name="brand_name" id="brand_name" placeholder="Name" class="form-control">
                </div>
                <div class="col-md-3" class="form-group">
                    <label style="color:black;">Manufacturer <span style="color:red;">*</span></label>
                    <select name="manufact_brand" id="manufact_brand" class="form-control">
                        <option value="">Select</option>
                        @foreach($manfacData as $mnafdata)
                        <option value="{{$mnafdata->manufact_code}}">{{$mnafdata->manufact_name}}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-4" style="padding-top:25px;">
                    <input type="submit" name="brand_btn_submit" id="brand_btn_submit" value="Add" class="btn btn-success btn-xs" >&nbsp;
                    <input type="submit" name="btn_cancel_brand" id="btn_cancel_brand" value="Clear" class="btn btn-danger btn-xs">
                    <a href="{{route('sub_brand_master_pdf')}}" class="btn btn-primary btn-xs">PDF</a>
                    <button class="btn btn-primary btn-xs" formaction="{{route('sub_brand_master_excel')}}" id="btn" type="submit">Excel</button>
                </div>
               
                <div class="table-responsive col-md-12 form-group" style="padding-top:1px;">
                    <table class="mytable table table-bordered" id="example" class="display nowrap">
                        <thead style="position: sticky;top: 0" class="thead-dark">
                            <tr>
                                <th class="header" scope="col">Sr. No</th>
                                <th class="header" scope="col">Code</th>
                                <th class="header" scope="col">Name</th>
                                <th class="header" scope="col">Manufacturer</th>		
                                <th class="header" scope="col">Status</th>
                                <th class="header" scope="col">Created By</th>
                                <th class="header" scope="col">Created Date and Time</th>
                                <th class="header" scope="col">Updated Date and Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($brandData) < 1)
                                <tr>
                                    <td colspan="8">No Record Found.</td>
                                </tr>
                            @else
                            @php $srNo=0; @endphp
                            @foreach($brandData as $brand_value)
                            <tr>
                                <td>{{++$srNo}}</td>
                                <td>{{$brand_value->brand_code}}</td>
                                <td>{{$brand_value->brand_name}}</td>
                                <td>{{$manftype[$brand_value->manufact_code]}}</td>
                                <td>{{$arrOfStatus[$brand_value->status]}}</td>
                                <td>{{$brand_value->created_by}}</td>
                                <td>{{$brand_value->created_at}}</td>
                                <td>{{$brand_value->updated_at}}</td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>      
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
             $('#brand_btn_submit').click(function(e){
                 e.preventDefault();
                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                     }
                 });
                 $.ajax({
                    url: "{{ url('sub_brand_master_post') }}",
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
                            $('#brandMaster')[0].reset();
                            location.reload();
                          
                       }
                    },
                    error: function(data) {
                    }
                 });
             });
        });
        
        $('#btn_cancel').click(function(){
            $('#brandMaster')[0].reset();
            return false;
        });
        $('#btn_cancel_brand').click(function(){
            $('#brandMaster')[0].reset();
            return false;
        });
      </script>

@endsection
