@extends('layout')
  
@section('content')
<form id="cateMaster" name="cateMaster" method="POST">
    {{ csrf_field() }} 
<div class="container-fluid">
    <div class="col-md-6">
        <div class="panel panel-success">
            <div class="panel-heading" style="padding: 10px;"><b>Add Category</b></div>
            <div class="panel-body" >
            <div class="row">
                <div class="col-md-2" class="form-group">
                    <label style="color:black;" >Code <span style="color:red;">*</span></label>
                    <input type="text" name="cat_code" id="cat_code" class="form-control" placeholder="Code">
                </div>
                <div class="col-md-3" class="form-group">
                    <label style="color:black;">Name <span style="color:red;">*</span></label>
                    <input type="text" name="cat_name" id="cat_name" placeholder="Name" class="form-control">
                </div>
                <div class="col-md-3" class="form-group">
                    <label style="color:black;">Type <span style="color:red;">*</span></label>
                    <select name="cat_type" id="cat_type" class="form-control">
                        <option value="" id="yes" readonly>Select</option>
                        @foreach($food_type as $key => $type)
                        <option value="{{$key}}" >{{$type}}</option>
                        @endforeach 
                    </select>
                </div>
                <div class="col-md-4" class="form-group">
                    <label style="color:black;">Group <span style="color:red;">*</span></label>
                    <input type="text" name="group" id="group" class="form-control" style='text-transform:uppercase' placeholder="Group"value="">	
                </div>
                @php  
                $arrOfYesNo=array(); $arrOfYesNo['Y']='Yes'; $arrOfYesNo['N']='No'; 
                $arrOfStatus=array(); $arrOfStatus['Y']='Active'; $arrOfStatus['N']='In-Active';
                $arrOfDayMonth=array(); $arrOfDayMonth['D']='Days'; $arrOfDayMonth['M']='Month';
                @endphp
                <div class="col-md-3" class="form-group">
                    <label style="color:black;">Inventory <span style="color:red;">*</span></label>
                    <select name="inventory" id="inventory" class="form-control">
                        <option value="" readonly>Select</option>
                        <option value="Y">Yes</option>
                        <option value="N">No</option>
                    </select>
                </div>
                <div class="col-md-1" style="padding-top:22px;">
                    <input type="submit" name="cate_btn_submit" id="cate_btn_submit" value="Add" class="btn btn-success">
                    
                </div>
                <div class="col-md-1" style="padding-top:22px;">
                    
                    <input type="submit" name="btn_cancel" id="btn_cancel" value="Clear" class="btn btn-danger">
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
                                <th class="header" scope="col">Group</th>
                                <th class="header" scope="col">Inventory</th>
                                <th class="header" scope="col">Status</th>
                                <th class="header" scope="col">Created By</th>
                                <th class="header" scope="col">Created Date and Time</th>
                                <th class="header" scope="col">Updated Date and Time</th>
                            </tr>
                        </thead>
                                @if(count($category_master_data) < 1)
                                <tr>
                                    <td>No Record Found.</td>
                                </tr>
                                @else
                                @php $srNo=0; @endphp
                                @foreach($category_master_data as $cat_value)
                                <tr>
                                    <td><input type="checkbox" name="check_{{$cat_value->cat_code}}" id="check_{{$cat_value->cat_code}}" value="{{$cat_value->cat_code}}" onclick="return CheckData('this.val')"> </td>
                                    <td>{{++$srNo}}</td>
                                    <td>{{$cat_value->cat_code}}</td>
                                    <td>{{$cat_value->cat_name}}</td>
                                    <td>{{$food_type[$cat_value->cat_type]}}</td>
                                    <td>{{$cat_value->group}}</td>
                                    <td>{{$arrOfYesNo[$cat_value->inventory]}}</td>
                                    <td>{{$arrOfStatus[$cat_value->status]}}</td>
                                    <td>{{$cat_value->created_by}}</td>
                                    <td>{{$cat_value->created_at}}</td>
                                    <td>{{$cat_value->updated_at}}</td>
                                </tr> 
                                @endforeach
                            @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-success">
            <div class="panel-heading" style="padding: 10px;"><b>Add Sub-Category</b></div>
            <div class="panel-body" >
            <div class="row">
                <div class="col-md-2" class="form-group">
                    <label style="color:black;" >Code <span style="color:red;">*</span></label>
                    <input type="text" name="sub_cat_code" id="sub_cat_code" class="form-control" placeholder="Code">
                </div>
                <div class="col-md-4" class="form-group">
                    <label style="color:black;">Sub Ctegory Name <span style="color:red;">*</span></label>
                    <input type="text" name="sub_cat_name" id="sub_cat_name" placeholder="Sub Ctegory Name" class="form-control">
                </div>
                <div class="col-md-3" class="form-group">
                    <label style="color:black;">Ctegory <span style="color:red;">*</span></label>
                    <select name="cat_code" id="cat_code" class="form-control">
                        <option value="" id="yes" readonly>Select</option>
                        @foreach($cat_mater as $key => $cattype)
                        <option value="{{$key}}" >{{$cattype}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2" class="form-group">
                    <label style="color:black;">MarkUp <span style="color:red;">*</span></label>
                    <input type="text" name="markup" id="markup" class="form-control" onkeypress="return isNumber(event)" placeholder="MarkUp" value="">	
                </div>
                <div class="col-md-3" class="form-group">
                    <label style="color:black;">MarkDown <span style="color:red;">*</span></label>
                    <input type="text" name="markdown" id="markdown" class="form-control" onkeypress="return isNumber(event)" placeholder="MarkUp" value="">    
                </div>
                <div class="col-md-3" class="form-group">
                    <label>Shelf Life Peried</label>
                    <input type="text" name="shelf_life_p" id="shelf_life_p" placeholder="ShelfLife" class="form-control" onkeypress="return isNumber(event)">
                </div>
                <div class="col-md-3" class="form-group">
                    <label>Shelf Life D/M</label>
                    <select name="shelf_life_dm" id="shelf_life_dm" class="form-control">
                        <option value="" id="yes" readonly>Select</option>
                        <option value="D" id="yes">Days</option>
                        <option value="M" id="no">Month</option>
                    </select>
                </div>
                <div class="col-md-1" style="padding-top:22px;">
                    <input type="submit" name="subcate_btn_submit" id="subcate_btn_submit" value="Add" class="btn btn-success" >
                    
                </div>
                <div class="col-md-1" style="padding-top:22px;">
                    
                    <input type="submit" name="btn_cancel" id="btn_cancel" value="Clear" class="btn btn-danger">
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
                                <th class="header" scope="col">Mark Up</th>
                                <th class="header" scope="col">Mark Down</th>
                                <th class="header" scope="col">Shelf Peried</th>
                                <th class="header" scope="col">Day/Months</th>		
                                <th class="header" scope="col">Status</th>
                                <th class="header" scope="col">Created By</th>
                                <th class="header" scope="col">Created Date and Time</th>
                                <th class="header" scope="col">Updated Date and Time</th>
                            </tr>
                        </thead>
                                @if(count($sub_category_master_data) < 1)
                                <tr>
                                    <td>No Record Found.</td>
                                </tr>
                                @else
                                @php $srNo=0; @endphp
                                @foreach($sub_category_master_data as $sub_cat_value)
                                <tr>
                                    <td></td>
                                    <td>{{++$srNo}}</td>
                                    <td>{{$sub_cat_value->sub_cat_code}}</td>
                                    <td>{{$sub_cat_value->sub_cat_name}}</td>
                                    <td>{{$sub_cat_value->cat_code}}</td>
                                    <td>{{$sub_cat_value->markup}}</td>
                                    <td>{{$sub_cat_value->markdown}}</td>
                                    <td>{{$sub_cat_value->shelf_life_p}}</td>
                                    <td>{{$arrOfDayMonth[$sub_cat_value->shelf_life_dm]}}</td>
                                    <td>{{$arrOfStatus[$sub_cat_value->status]}}</td>
                                    <td>{{$sub_cat_value->created_by}}</td>
                                    <td>{{$sub_cat_value->created_at}}</td>
                                    <td>{{$sub_cat_value->updated_at}}</td>
                                </tr> 
                                @endforeach
                            @endif
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
            var form=$("#cateMaster");
            $('#cate_btn_submit').click(function(e){
                 e.preventDefault();
                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                     }
                 });
                 $.ajax({
                    url: "{{ url('cate_master_post') }}",
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
