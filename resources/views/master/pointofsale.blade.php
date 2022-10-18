@extends('layout')
  
@section('content')
<style type="text/css">
  .point{ width: 50px;padding: 5px;}
  table tr th,td {padding: 3px;}
</style>

<div class="container-fluid">
  <div class="panel panel-primary">
    <div class="panel-heading" style="padding: 10px;"><b>Point-of-Sale (Counter Sale)</b></div>
    <div class="panel-body" >
      <form id="posTransaction" name="posTransaction" method="POST">
        {{ csrf_field() }}
        <div class="col-md-9" style="background-color: #cfccc9;">
           <table width="100%">
              <tr>
                <th>Location: <input type="text" name="loc_Code" id="loc_Code" class="form-control" value="{{ Session::get('companyloc_code')}}" readonly></th>
                <th>Bill Date: <input type="text" name="Bill Date" id="Bill_Date" class="form-control" value="" readonly></th>
                <th>Bill No: <input type="text" name="Bill No" id="Bill_No" class="form-control" value="" readonly></th>
                <th>Cashier: <input type="text" name="Cashier" id="Cashier" class="form-control" value="{{ Session::get('useremail')}}" readonly></th>
                <th>Machine: <input type="text" name="Machine" id="Machine" class="form-control" value="{{$macAddr}}" readonly></th>
              </tr>
            </table>
        </div><br>
        <div class="col-md-3">
          
        </div>
        <div class="col-md-9">
          <br>
          <b> Mobile: <span style="color:red;">*</span></b> <input type="text" name="" placeholder="Mobile" style="width: 85px;"><b>  Cust-Id: <span style="color:red;">*</span> </b><input type="text" name="" style="width: 80px;" placeholder="Customer Id" ><input type="text" name="" style="width: 147px;" placeholder="Customer Name"> <a href="{{route('customer_master')}}" target="_blank" class="btn btn-xs btn-primary">New Cust</a><b>  Points: </b><input type="text" name="" style="width: 80px;" placeholder="Points">
          <b> Home-Delivery: <span style="color:red;"></span> </b>
              <select name="">
                <option value="Y">Select</option>
                <option value="Y">YES</option>
                <option value="N">NO</option>
              </select><b>  Last Bill No: </b><input type="text" name="" align="center" style="width: 120px;" placeholder="Last Bill No" ><br>
            <b> Address: </b> <input type="text" name="" style="width: 301px;" placeholder="Address">
            <b> Disc: </b><input type="text" name="" style="width: 60px;" placeholder="Amt"><input type="text" name="" style="width: 50px;" placeholder="%"><b>
            <b> Oth Chrg: </b><input type="text" name="" style="width: 60px;" placeholder="Amt"><input type="text" name="" style="width: 50px;" placeholder="%">
            <b> Last Bill Amt/Change: </b><input type="text" name="" style="width: 100px;" placeholder="Last Bill Amt" ><input type="text" name="" style="width: 60px;" placeholder="Change">
            <br><br>
            
            <b>Scan Barcode:</b><input type="text" name=""  placeholder="" value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <b>SEARCH SKU:</b><input type="text" name=""  placeholder="" value=""><br><br>
            <table width="100%" border="1">
              <tr>
                <th>Sku </th>
                <th>Sku Name </th>
                <th>Batch-No </th>
                <th>MRP </th>
                <th>Disc </th>
                <th>Qty </th>
                <th>Rate </th>
                <th>Amount </th>
              </tr>
              <tr>
                <td>1 </td>
                <td>Roll </td>
                <td>1 </td>
                <td>100.00 </td>
                <td>5.00 </td>
                <td>1.00 </td>
                <td>95.00</td>
                <td>100.00 </td>
              </tr>
            </table>
        </div>
        <div class="col-md-3">
            <table width="80%" border="1">
              <tr>
                <th><b>Sku Count</b> </th>
                <th><input type="text" name="" class="point" style="text-align:center" placeholder="" value="1"> </th>
                <th><b>Total Qty</b> </th>
                <th><input type="text" name="" class="point" style="text-align:center" placeholder="" value="1.00"> </th>
              </tr>
            </table>
            <table width="80%" border="1">  
              <br>
              <tr>
                <td colspan="4" align="center"><b>Payable Value </b></td>
              </tr>
              <tr>
                <td colspan="4" align="center">
                <input type="text" name="" style="text-align:center" class="" placeholder="" value="95.00"></td>
              </tr>
              </table>
            <table width="80%" border="1">  
              <br>
              <tr>
                <td colspan="4" ><b >Total MRP :</b>  <input type="text" name="" class="" style="text-align:right" placeholder="" value="100.00"></td>
              </tr>
              <tr>
                <td colspan="4" ><b>Save :</b><input type="text" name="" class="" style="text-align:right" placeholder="" value="5.00"></td>
              </tr>
               <tr>
                <td colspan="4" ><b>Amount :</b>  <input type="text" name="" class="" style="text-align:right" placeholder="" value="95.00"></td>
              </tr>
               <tr>
                <td colspan="4" ><b>Pmt. Chrg :</b>  <input type="text" name="" class="" style="text-align:right" placeholder="" value=".00"></td>
              </tr>
              <tr>
                <td colspan="4" ><b>Item Disc :</b>  <input type="text" name="" class="" style="text-align:right" placeholder="" value=".00"></td>
              </tr>
              <tr>
                <td colspan="4" ><b>Bill Disc :</b>  <input type="text" name="" class="" style="text-align:right" placeholder="" value=".00"></td>
              </tr>
              <tr>
                <td colspan="4" ><b>Round Off :</b>  <input type="text" name="" class="" style="text-align:right" placeholder="" value="0.00"></td>
              </tr>
            </table>
        </div>
        <div class="col-md-12">
          <a href="#" class="btn btn-xs btn-success"> Non-Lnv Sku</a>&nbsp;&nbsp;&nbsp;<a href="#" class="btn btn-xs btn-success"> Sku Copy</a>&nbsp;&nbsp;&nbsp;<a href="#" class="btn btn-xs btn-success"> Remove Sku</a>&nbsp;&nbsp;&nbsp;<a href="#" class="btn btn-xs btn-success"> Change Qty</a>&nbsp;&nbsp;&nbsp;
          <a href="#" class="btn btn-xs btn-success"> Block Change</a>&nbsp;&nbsp;&nbsp;<a href="#" class="btn btn-xs btn-success"> Query Mode</a>&nbsp;&nbsp;&nbsp;
          <a href="#" class="btn btn-xs btn-success"> Display / Show</a>&nbsp;&nbsp;&nbsp;<a href="#" class="btn btn-xs btn-success"> Sku List-LOV</a>&nbsp;&nbsp;&nbsp;
          <a href="#" class="btn btn-xs btn-success"> Hold Bill</a>&nbsp;&nbsp;&nbsp;<a href="#" class="btn btn-xs btn-success">Pop Hold Bill </a>
          <a href="#" class="btn btn-xs btn-primary"> Re-Print Bill</a>&nbsp;&nbsp;&nbsp;<a href="#" class="btn btn-xs btn-success"> Cancel Bill</a>
        </div>  
      </form>
    </div>
  </div>
</div>

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
                     success: function(data){
                       if(data.errors) {
                           if(data.errors.txt_code){
                               $( '#txtcode-error' ).html("Please Enter Code" );
                           }else{
                               $( '#txtcode-error' ).html("");
                           }

                           if(data.errors.txt_comname){
                               $( '#txt_comname-error' ).html( "Please Enter Company Name" );
                           }else{
                               $( '#txt_comname-error' ).html( "");
                           }
                           if(data.errors.type){
                               $( '#txt_type-error' ).html("Please Select Type");
                           }else{
                               $( '#txt_type-error' ).html("");
                           }
                           if(data.errors.addr1){
                               $( '#txt_addr1-error' ).html( "Please Enter Address" );
                           }else{
                               $( '#txt_addr1-error' ).html( "");
                           }
                           if(data.errors.city){
                               $( '#txt_city-error' ).html( "Please Select City" );
                           }else{
                               $( '#txt_city-error' ).html( "");
                           }

                       }
                       if(data.success) {
                            alert("Data Saved..!");
                               $( '#txtcode-error' ).html( "");
                               $( '#txt_comname-error' ).html( "");
                               $( '#txt_type-error' ).html( "");
                               $( '#txt_addr1-error' ).html( "");
                           $('#success-msg5').removeClass('hide');
                           setInterval(function(){ 
                               $('#success-msg5').addClass('hide');
                           }, 4000);

                          
                       }
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
                        
                     }
                 });
             });
         });
      </script>

@endsection
