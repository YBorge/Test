@extends('layout')
  
@section('content')

<div class="container-fluid">
<div class="panel panel-primary">
<div class="panel-heading" style="padding: 10px;"><b>Add Users</b></div>
<div class="panel-body" >
    <div class="row">
    <form id="userMaster" name="userMaster" method="POST">
        {{ csrf_field() }} 
        <div class="col-md-1" class="form-group">
            <label style="color:black;" >User Code <span style="color:red;">*</span></label>
            <input type="text" name="user_code" id="user_code" class="form-control" placeholder="User Code"  style='text-transform:uppercase'>
            
        </div>
        <div class="col-md-2" class="form-group">
            <label style="color:black;">User Name <span style="color:red;">*</span></label>
            <input type="text" name="uname" id="uname" class="form-control"  placeholder="User Name" value="">	
        </div>
       
        <div class="col-md-2" class="form-group">
            <label>Password <span style="color:red;">*</span></label>
             <input type="password" name="upass" id="upass" placeholder="Password" class="form-control">
            <input type="checkbox" onclick="myFunction()">Show
        </div>
        <div class="col-md-2" class="form-group">
            <label>Role<span style="color:red;">*</span></label>
            <select name="role" id="role" class="form-control">
                <option value="" id="No" readonly>Select</option>
                @foreach($user_role as $uKey => $user)
                <option value="{{$uKey}}" >{{$user}}</option>
                @endforeach
                
            </select>	
        </div>
        
        <div class="col-md-1" class="form-group">
            <label>Mobile No <span style="color:red;">*</span></label>
            <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Mobile No" value="" onkeypress="return isNumber(event)" maxlength="10">
        </div>
        <div class="col-md-2" class="form-group">
            <label>Email Id <span style="color:red;">*</span></label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Email Id" value="" maxlength="100">
        </div>
        <div class="col-md-2" class="form-group" style="padding-top:22px;">
            <input type="submit" name="btn_submit" id="btn_submit" value="Add" class="btn btn-success btn-xs">
            <input type="submit" name="btn_cancel_payment" id="btn_cancel_payment" value="Clear" class="btn btn-danger btn-xs">
            <a href="{{route('payment_master_pdf')}}" class="btn btn-primary btn-xs">PDF</a>
            <button class="btn btn-primary btn-xs" formaction="{{route('payment_master_excel')}}" id="btn" type="submit">Excel</button>	
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
                    <th class="header" scope="col">Payment  Code</th>
                    <th class="header" scope="col">Payment  Name</th>
                    <th class="header" scope="col">CalCulate On</th>
                    <th class="header" scope="col">Charges (%)</th>
                    <th class="header" scope="col">Allow Multi</th>
                    <th class="header" scope="col">Bill Copy</th>
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
</form>
<script>
         $(document).ready(function(){
            var form=$("#userMaster");
            $('#btn_submit').click(function(e){
                 e.preventDefault();
                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                     }
                 });
                 $.ajax({
                    url: "{{ url('user_master_store') }}",
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
                            $('#userMaster')[0].reset();
                            location.reload();
                          
                       }
                    },
                    error: function(errors) 
                    {
                        toastr.error("Invalid Request.");
                    }
                 });
             });
         });
        
        $('#btn_cancel_payment').click(function(){
            $('#userMaster')[0].reset();
            return false;
        });
        function myFunction() {
          var x = document.getElementById("upass");
          if (x.type === "password") {
            x.type = "text";
          } else {
            x.type = "password";
          }
        }
      </script>

@endsection