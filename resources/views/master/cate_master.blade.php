@extends('layout')
  
@section('content')

<div class="container-fluid">
    <div class="col-md-6">
        <div class="panel panel-success">
            <div class="panel-heading" style="padding: 10px;"><b>Add Category</b></div>
            <div class="panel-body" >
            <div class="row">
                <div class="col-md-2" class="form-group">
                    <label style="color:black;" >Code <span style="color:red;">*</span></label>
                    <input type="text" name="loc_code" id="loc_code" class="form-control" placeholder="Code">
                </div>
                <div class="col-md-3" class="form-group">
                    <label style="color:black;">Name <span style="color:red;">*</span></label>
                    <input type="text" name="loc_no" id="loc_no" placeholder="Name" class="form-control" onkeypress="return isNumber(event)">
                </div>
                <div class="col-md-2" class="form-group">
                    <label style="color:black;">Type <span style="color:red;">*</span></label>
                    <select name="" id="" class="form-control">
                        <option value="" id="yes" readonly>Select</option>
                        <option value="Y" id="yes">Yes</option>
                        <option value="N" id="no">No</option>
                    </select>
                </div>
                <div class="col-md-3" class="form-group">
                    <label style="color:black;">Group <span style="color:red;">*</span></label>
                    <input type="text" name="loc_name" id="loc_name" class="form-control" style='text-transform:uppercase' placeholder="Group"value="">	
                </div>
                <div class="col-md-2" class="form-group">
                    <label style="color:black;">Inventory <span style="color:red;">*</span></label>
                    <select name="inventory" id="inventory" class="form-control">
                        <option value="" id="yes" readonly>Select</option>
                        <option value="Y" id="yes">Yes</option>
                        <option value="N" id="no">No</option>
                    </select>
                </div>
                <div class="col-md-1" style="padding-top:18px;">
                    <input type="submit" name="btn_submit" id="btn_submit" value="Add" class="btn btn-success" onclick="add_cat();" >
                    
                </div>
                <div class="col-md-1" style="padding-top:18px;">
                    
                    <input type="submit" name="btn_cancel" id="btn_cancel" value="Clear" class="btn btn-danger" onclick="chk1();">
                </div>
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
                    <input type="text" name="loc_code" id="loc_code" class="form-control" placeholder="Code">
                </div>
                <div class="col-md-3" class="form-group">
                    <label style="color:black;">Name <span style="color:red;">*</span></label>
                    <input type="text" name="loc_no" id="loc_no" placeholder="Name" class="form-control" onkeypress="return isNumber(event)">
                </div>
                <div class="col-md-2" class="form-group">
                    <label style="color:black;">Type <span style="color:red;">*</span></label>
                    <select name="" id="" class="form-control">
                        <option value="" id="yes" readonly>Select</option>
                        <option value="Y" id="yes">Yes</option>
                        <option value="N" id="no">No</option>
                    </select>
                </div>
                <div class="col-md-3" class="form-group">
                    <label style="color:black;">Group <span style="color:red;">*</span></label>
                    <input type="text" name="loc_name" id="loc_name" class="form-control" style='text-transform:uppercase' placeholder="Group"value="">	
                </div>
                <div class="col-md-2" class="form-group">
                    <label style="color:black;">Inventory <span style="color:red;">*</span></label>
                    <select name="inventory" id="inventory" class="form-control">
                        <option value="" id="yes" readonly>Select</option>
                        <option value="Y" id="yes">Yes</option>
                        <option value="N" id="no">No</option>
                    </select>
                </div>
                <div class="col-md-1" style="padding-top:18px;">
                    <input type="submit" name="btn_submit" id="btn_submit" value="Add" class="btn btn-success" onclick="add_cat();" >
                    
                </div>
                <div class="col-md-1" style="padding-top:18px;">
                    
                    <input type="submit" name="btn_cancel" id="btn_cancel" value="Clear" class="btn btn-danger" onclick="chk1();">
                </div>
            </div>
            </div>
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