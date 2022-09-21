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
            @if($paymentSeq=='Y')
            <input type="text" name="pmt_code" id="pmt_code" class="form-control" readonly placeholder="Payment Code" onkeypress="return isNumber(event)">
            @else
            <input type="text" name="pmt_code" id="pmt_code" class="form-control" placeholder="Payment Code" onkeypress="return isNumber(event)">
            @endif
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
                @php $arrOfYesNo=array(); $arrOfYesNo['Y']='Yes'; $arrOfYesNo['N']='No';
                $arrOfCalOn=array(); $arrOfCalOn['M']='MRP'; $arrOfCalOn['S']='Sale'; 
                $arrOfStatus=array(); $arrOfStatus['Y']='Active'; $arrOfStatus['N']='In-Active';
                @endphp
                @if(count($paymentData) < 1)
                <tr>
                    <td>No Record Found.</td>
                </tr>
                @else
                @php $srNo=0; @endphp
                @foreach($paymentData as $payment_value)
                <tr>
                    <td></td>
                    <td>{{++$srNo}}</td>
                    <td>{{$payment_value->pmt_code}}</td>
                    <td>{{$payment_value->pmt_name}}</td>
                    <td>{{$arrOfCalOn[$payment_value->calc_on]}}</td>
                    <td>{{$payment_value->charge_per}}</td>
                    <td>{{$arrOfYesNo[$payment_value->allow_multi]?? '-'}}</td>
                    <td>{{$payment_value->bill_copy}}</td>
                    <td>{{$arrOfStatus[$payment_value->status]}}</td>
                    <td>{{$payment_value->created_by}}</td>
                    <td>{{$payment_value->created_at}}</td>
                    <td>{{$payment_value->updated_at}}</td>
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