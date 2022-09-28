@extends('layout')
  
@section('content')

<div class="container-fluid">
<div class="panel panel-primary">
<div class="panel-heading" style="padding: 10px;"><b>Tax Master</b></div>
<div class="panel-body" >
    <div class="row">
    <form id="taxMaster" name="taxMaster" method="POST">
        {{ csrf_field() }} 
        <div class="col-md-1" class="form-group">
            <label style="color:black;" >Tax Type <span style="color:red;">*</span></label>
            <select name="tax_type" id="tax_type" class="form-control">
                <option value="" id="Yes" readonly>Select</option>
                <option value="G" id="Yes">GST</option>
                    <option value="V" id="No">VAT</option>
            </select>
        </div>
        <div class="col-md-1" class="form-group">
            <label>Tax Code<span style="color:red;">*</span></label>
            <input type="text" name="tax_code" id="tax_code" placeholder="Tax Code" class="form-control" onkeypress="return isNumber(event)">
        </div>
        <div class="col-md-2" class="form-group">
            <label>Tax Name<span style="color:red;">*</span></label>
            <input type="text" name="tax_name" id="tax_name" placeholder="Tax Name" class="form-control">
        </div>
        <div class="col-md-1" class="form-group">
            <label>Tax(%)<span style="color:red;">*</span></label>
            <input type="text" name="tax_per" id="tax_per" placeholder="Tax(%)" class="form-control" onkeypress="return isNumber(event)">
        </div>
        <div class="col-md-1" class="form-group">
            <label>Tax Indicator </label>
            <input type="text" name="tax_indicator" id="tax_indicator" placeholder="Tax Indicator" class="form-control">
        </div>
        <div class="col-md-1" class="form-group">
            <label>IGST (%)</label>
            <input type="text" name="igst" id="igst" placeholder="IGST (%)" class="form-control" onkeypress="return isNumber(event)">
        </div>
        <div class="col-md-1" class="form-group">
            <label>SGST (%)</label>
            <input type="text" name="sgst" id="sgst" placeholder="SGST (%)" class="form-control" onkeypress="return isNumber(event)">
        </div>
        <div class="col-md-1" class="form-group">
            <label>CGST (%)</label>
             <input type="text" name="cgst" id="cgst" placeholder="CGST (%)" class="form-control" onkeypress="return isNumber(event)">
        </div>
        <div class="col-md-1" class="form-group">
            <label>UTGST (%)</label>
            <input type="text" name="utgst" id="utgst" placeholder="UTGST (%)" class="form-control" onkeypress="return isNumber(event)">
        </div>
        <div class="col-md-1" class="form-group">
            <label>CESS (%)</label>
            <input type="text" name="cess" id="cess" placeholder="TCESS (%)" class="form-control" value="" onkeypress="return isNumber(event)">
        </div>
        <div class="col-md-1" class="form-group">
            <label>Cess/Peice (%)</label>
            <input type="text" name="cessperpiece" id="cessperpiece" placeholder="CESS Per Peice (%)" class="form-control" value="" onkeypress="return isNumber(event)">
        </div>
        <div class="col-md-4" class="form-group" style="padding-top:22px;">
            <input type="submit" name="btn_submit" id="btn_submit" value="Add" class="btn btn-success">
            <input type="submit" name="btn_cancel_payment" id="btn_cancel_payment" value="Clear" class="btn btn-danger">
            <a href="{{route('tax_master_pdf')}}" target="_blank" class="btn btn-primary">PDF</a>
            <button class="btn btn-primary" formaction="{{route('tax_master_excel')}}" id="btn" type="submit">Excel</button>	
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
                    <th class="header" scope="col">Sr. No</th>
                    <th class="header" scope="col">Type</th>
                    <th class="header" scope="col">Name</th>
                    <th class="header" scope="col">Code</th>
                    <th class="header" scope="col">Tax (%)</th>
                    <th class="header" scope="col">Tax Indicator</th>
                    <th class="header" scope="col">IGST (%)</th>
                    <th class="header" scope="col">SGST (%)</th>
                    <th class="header" scope="col">CGST (%)</th>
                    <th class="header" scope="col">UTGST (%)</th>
                    <th class="header" scope="col">CESS (%)</th>
                    <th class="header" scope="col">Cess Per Peice (%)</th>
                    <th class="header" scope="col">Status</th>
                    <th class="header" scope="col">Created By</th>
                    <th class="header" scope="col">Created Date and Time</th>
                    <th class="header" scope="col">Updated By</th>
                    <th class="header" scope="col">Updated Date and Time</th>
                </tr>
            </thead>
                @php $srNo=0; $arrOfType=array(); $arrOfType['G']='GST'; $arrOfType['V']='Vat'; $arrOfStatus=array(); $arrOfStatus['Y']='Active'; $arrOfStatus['N']='In-Active'; @endphp
                @foreach($tax_master_data as $taxKey => $taxValue)
                <tr>
                    <td>{{++$srNo}}</td>
                    <td>{{$arrOfType[$taxValue->tax_type]}}</td>
                    <td>{{$taxValue->tax_code}}</td>
                    <td>{{$taxValue->tax_name}}</td>
                    <td>{{$taxValue->tax_per}}</td>
                    <td>{{$taxValue->tax_indicator}}</td>
                    <td>{{$taxValue->igst}}</td>
                    <td>{{$taxValue->sgst}}</td>
                    <td>{{$taxValue->cgst}}</td>
                    <td>{{$taxValue->utgst}}</td>
                    <td>{{$taxValue->cess}}</td>
                    <td>{{$taxValue->cessperpiece}}</td>
                    <td>{{$arrOfStatus[$taxValue->status]}}</td>
                    <td>{{$taxValue->created_by}}</td>
                    <td>{{$taxValue->created_at}}</td>
                    <td>{{$taxValue->t_user}}</td>
                    <td>{{$taxValue->updated_at}}</td>
                </tr>
                @endforeach
            </table>                   
        </div>  
    </div>
</div>
</form>
<script>
         $(document).ready(function(){
            var form=$("#taxMaster");
            $('#btn_submit').click(function(e){
                 e.preventDefault();
                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                     }
                 });
                 $.ajax({
                    url: "{{ url('tax_master_store') }}",
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
                            $('#taxMaster')[0].reset();
                            location.reload();
                          
                       }
                    },
                    error: function(data) {
                    }
                 });
             });
            $('#tax_type').change(function(e){
                var taxType = document.getElementById('tax_type').value;
                var fielddisable=["igst","sgst","cgst","utgst","cess","cessperpiece"]; 
                if(taxType == 'V')
                {
                    fielddisable.forEach(single_ele => {
                        $("#"+single_ele).prop("disabled",true);
                        $("#"+single_ele).val("");

                    });
                }
                else{
                    fielddisable.forEach(single_ele => {
                        $("#"+single_ele).prop("disabled",false);
                    });
                }
             });
         });
        
        $('#btn_cancel_payment').click(function(){
            $('#taxMaster')[0].reset();
            return false;
        });
      </script>

@endsection
