@extends('layout')
  
@section('content')

<div class="container-fluid">
<div class="panel panel-primary">
<div class="panel-heading" style="padding: 10px;"><b>Payment Master</b></div>
<div class="panel-body" >
    <div class="row">
    <form id="paymentMaster" name="paymentMaster" method="POST">
        {{ csrf_field() }} 
        <div class="col-md-2" class="form-group">
            <label style="color:black;" >Code <span style="color:red;">*</span></label>
            
            <input type="text" name="pmt_code" id="pmt_code" class="form-control" readonly placeholder="Payment Code" onkeypress="return isNumber(event)">
           
            <input type="text" name="pmt_code" id="pmt_code" class="form-control" placeholder="Payment Code" onkeypress="return isNumber(event)">
           
        </div>
        <div class="col-md-3" class="form-group">
            <label style="color:black;">Name <span style="color:red;">*</span></label>
            <input type="text" name="pmt_name" id="pmt_name" class="form-control"  placeholder="Payment Name"value="">	
        </div>
        <div class="col-md-2" class="form-group">
            <label style="color:black;">Calculate On <span style="color:red;">*</span></label>
            <select name="calc_on" id="calc_on" class="form-control">
                <option value="" id="Sale" readonly>Select</option>
                <option value="M" id="MRP">MRP</option>
                    <option value="S" id="Sale">Sale</option>
            </select>	
        </div>
        <div class="col-md-1" class="form-group">
            <label style="color:black;">Charge (%) </label>
            <input type="text" name="charge_per" id="charge_per" class="form-control" placeholder="%"value="">	
        </div>
        <div class="col-md-2" class="form-group">
            <label>Allow Multi<span style="color:red;">*</span></label>
            <select name="allow_multi" id="allow_multi" class="form-control">
                <option value="" id="No" readonly>Select</option>
                <option value="Y" id="Yes">Yes</option>
                    <option value="N" id="No">No</option>
            </select>	
        </div>
        
        <div class="col-md-2" class="form-group">
            <label>Bill Copy</label>
            <input type="text" name="bill_copy" id="bill_copy" class="form-control" placeholder="Bill Copy" value="">
            
        </div>
        <div class="col-md-4" class="form-group" style="padding-top:22px;">
            <input type="submit" name="btn_submit" id="btn_submit" value="Add" class="btn btn-success">
            <input type="submit" name="btn_cancel_payment" id="btn_cancel_payment" value="Clear" class="btn btn-danger">
            <a href="{{route('payment_master_pdf')}}" class="btn btn-primary">PDF</a>
            <button class="btn btn-primary" formaction="{{route('payment_master_excel')}}" id="btn" type="submit">Excel</button>	
        </div>
    </div>
    </div>
    
</div>
</form>
<script>
         $(document).ready(function(){
            var form=$("#paymentMaster");
            $('#btn_submit').click(function(e){
                 e.preventDefault();
                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                     }
                 });
                 $.ajax({
                    url: "{{ url('payment_master_post') }}",
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
                            $('#paymentMaster')[0].reset();
                            location.reload();
                          
                       }
                    },
                    error: function(data) {
                    }
                 });
             });
         });
        
        $('#btn_cancel_payment').click(function(){
            $('#paymentMaster')[0].reset();
            return false;
        });
      </script>

@endsection