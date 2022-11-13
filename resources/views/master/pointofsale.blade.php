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
      <form id="posTransaction" name="posTransaction" method="POST" autocomplete="off">
        {{ csrf_field() }}
        <div class="col-md-9" style="background-color: #cfccc9;">
           <table width="100%">
              <tr>
                <th>Location: <input type="text" name="loc_Code" id="loc_Code" class="form-control" value="{{ Session::get('companyloc_code')}}" readonly></th>
                <th>Bill Date: <input type="text" name="Bill Date" id="Bill_Date" class="form-control" value="{{$sysDate}}" readonly></th>
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
          <b> Mobile: </b> <input type="text" name="Mobile" id="Mobile" placeholder="Mobile" style="width: 85px;" maxlength="10" onkeypress="return isNumber(event)"><b>  Cust-Id: <span style="color:red;">*</span> </b><input type="text" name="cust_code" id="cust_code" style="width: 80px;" placeholder="Customer Id" onkeypress="return isNumber(event)" maxlength="50" ><input type="text" name="cust_name" id="cust_name" style="width: 147px;" placeholder="Customer Name" maxlength="60"> <a href="{{route('customer_master')}}" target="_blank" class="btn btn-xs btn-primary">New Cust</a><b>  Points: </b><input type="text" name="points" id="points" style="width: 80px;" placeholder="Points" readonly>
          <b> Home-Delivery: <span style="color:red;"></span> </b>
              <select name="homedel" id="homedel">
                <option value="">Select</option>
                <option value="Y">YES</option>
                <option value="N">NO</option>
              </select><b>  Last Bill No: </b><input type="text" name="" align="center" style="width: 93px;" placeholder="Last Bill No" readonly><br>
            <b> Address: </b> <input type="text" name="cust_addr1" id="cust_addr1" style="width: 270px;" placeholder="Address">
            <b> Disc: </b><input type="text" name="discAmt" id="discAmt" onclick="openmodal(this);" style="width: 60px;" placeholder="Amt" onkeypress="return isNumber(event)" readonly><input type="text" name="discPercent" id="discPercent" onkeypress="return isNumber(event)" readonly style="width: 50px;" placeholder="%"><b>
            <b> Oth Chrg: </b><input type="text" name="" onkeypress="return isNumber(event)" style="width: 60px;" placeholder="Amt"><input type="text" name="" onkeypress="return isNumber(event)" style="width:50px;" placeholder="%">
            <b> Last Bill Amt/Change: </b><input type="text" name="" onkeypress="return isNumber(event)" style="width: 100px;" placeholder="Last Bill Amt" readonly><input type="text" name="" style="width: 60px;" onkeypress="return isNumber(event)" placeholder="Change"><br>
            <input type="hidden" name="existCust" id="existCust" value="" placeholder="existCust">
            <input type="text" name="itemCodeNew" id="itemCodeNew" value="" placeholder="itemCodeNew">
            <b>Scan Barcode:</b><input type="text" name="barcode" id="barcode" placeholder="Barcode" value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <b>SEARCH SKU:</b><input type="text" name="skusearch" id="skusearch" placeholder="SKU" value="">&nbsp;&nbsp;<input type="button" class="btn btn-primary btn-xs" id="getItem" name="getItem " value="Get Item Details"><br><br>
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
              <tbody id="tbdata">
              </tbody>
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
          <a href="#" id="btn_submit" class="btn btn-xs btn-primary"> Re-Print Bill</a>&nbsp;&nbsp;&nbsp;<a href="#" class="btn btn-xs btn-success"> Cancel Bill</a>
        </div>  
      
    </div>
  </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title"><b>User Authentication</b></h4>
      </div>
      <div class="modal-body">
        @if ($otpCop=='Y')
        <label for="">OTP</label><input type="text" name="uotp" id="uotp">
        @else
        <label for="">User-Code</label><input type="text" name="usercode" id="usercode"> <label for="">Password</label><input type="password" name="upass" id="upass"><br> @endif  <b> Disc: </b><input type="text" name="discAmt" id="discAmt" onclick="openmodal(this);" style="width: 60px;" placeholder="Amt" onkeypress="return isNumber(event)" readonly><input type="text" name="discPercent" id="discPercent" onkeypress="return isNumber(event)" readonly style="width: 50px;" placeholder="%">
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary">Apply</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title"><b>Item Details</b></h4>
      </div>
      <div class="modal-body">
       <table border="1">
          <tr>
            <th>SrNo</th>
            <th>item code</th>
            <th>Batch No</th>
            <th>item name</th>
            <th>MRP</th>
            <th>Sale</th>
            <th>Bal Qty</th>
            <th>Select</th>
          </tr>
          <tbody id="tbdata1">

          </tbody>
       </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-submit">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</form>
<script>
        $(document).ready(function(){
            var form=$("#posTransaction");
            $('#btn_submit').click(function(e){
                 e.preventDefault();
                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                     }
                 });
                 $.ajax({
                    url: "{{ url('pointofsale_store') }}",
                    method: 'post',
                    data:form.serialize(),
                     success: function(data){
                       if(data.errors) 
                       {  
                          toastr.error(data.errors);
                       }
                       if(data.success) 
                       {   
                          toastr.success('Data Saved Successfully');
                          //$('#posTransaction')[0].reset();
                          //location.reload();
                       }
                     }
                 });
             });
            $('#getItem').click(function(e){
                 e.preventDefault();
                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                     }
                 });
                 $.ajax({
                    url: "{{ url('pointofsale_getItem') }}",
                    method: 'post',
                    data:form.serialize(),
                     success: function(data){
                       if(data.errors) 
                       {  
                          toastr.error(data.errors);
                       }
                       if(data.success) 
                       {   
                          toastr.success('Data Saved Successfully');
                          //$('#posTransaction')[0].reset();
                          //location.reload();
                       }
                        if(data.ItemData)
                        {
                          if (data.countVal==1) 
                          {
                            $('#tbdata').empty();
                              $.each(data.ItemData, (index, row) => {
                              const rowContent 
                              = `<tr>
                                  <td><input type="hidden" value="${row.SrNo}"> ${row.SrNo}</td>
                                  <td>${row.itemName}</td>
                                  <td>${row.batch_no}</td>
                                  <td>${row.mrp}</td>
                                  <td>${row.disc}</td>
                                  <td>${row.qty}</td>
                                  <td>${row.sale_rate}</td>
                                  <td>${row.sale_rate}</td>
                                </tr>`;
                              $('#tbdata').append(rowContent);
                            });
                            return true;
                          }
                          $('#tbdata1').empty();
                            $.each(data.ItemData, (index, row) => {
                            const rowContent 
                            = `<tr>
                                <td><input type="hidden" value="${row.SrNo}"> ${row.SrNo}</td>
                                <td>${row.item_code}</td>
                                <td>${row.batch_no}</td>
                                <td>${row.itemName}</td>
                                <td>${row.mrp}</td>
                                <td>${row.sale_rate}</td>
                                <td>${row.qty}</td>
                                <td><input type="checkbox" class="cbCheck" value="${row.item_code}" name="itemCheck[]" id="itemCheck[]"></td>
                              </tr>`;
                            $('#tbdata1').append(rowContent);
                          });
                          $('#myModal2').modal('show');
                        }
                      }
                 });
             });

            $(".btn-submit").click(function(){
              var chkCount = $(".cbCheck:checked").length;
             
              if(chkCount > 1)
              {
                $("#itemCodeNew").val("");
                alert("Can not select more than one checkbox..!");
                return false;
                exit();
              }
              var chkVal = $('.cbCheck').val();
              $("#itemCodeNew").val(chkVal);
              $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                     }
                 });

              $.ajax({
                    url: "{{ url('pointofsaleitemSave') }}",
                    method: 'post',
                    data:form.serialize(),
                    success: function(data)
                    {
                      
                    }
                 });

             });

            $('#Mobile').mouseleave(function(e){
                 e.preventDefault();
                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                     }
                 });
                 $.ajax({
                    url: "{{ url('pointofsaleMobile_change') }}",
                    method: 'post',
                    data:form.serialize(),
                     success: function(data)
                     {
                        if(data.errors) 
                        {
                          toastr.error(data.errors);
                          $("#cust_code").val("");
                          $("#cust_name").val("");
                          $("#cust_addr1").val("");
                          $("#points").val("");
                          $("#existCust").val("");
                          $("#cust_code").attr('readonly',false);
                        }
                        if(data.custData.cust_code)
                        {
                          $("#cust_code").attr('readonly',true);
                          $("#cust_code").val(data.custData.cust_code);
                        }
                        if(data.custData.cust_name)
                        {
                          $("#cust_name").val(data.custData.cust_name);
                        }
                        if(data.custData.cust_addr1)
                        {
                          $("#cust_addr1").val(data.custData.cust_addr1);
                        }
                        if(data.custData.points)
                        {
                          $("#points").val(data.custData.points);
                        }

                        if(data.custData.existCust)
                        {
                          $("#existCust").val(data.custData.existCust);
                        }
                        
                     }
                 });
             });
             $('#cust_code').mouseleave(function(e){
                 e.preventDefault();
                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                     }
                 });
                 $.ajax({
                    url: "{{ url('pointofsalecust_code_change') }}",
                    method: 'post',
                    data:form.serialize(),
                     success: function(data)
                     {
                        if(data.errors) 
                        {
                          toastr.error(data.errors);
                          $("#cust_code").val("");
                          $("#cust_name").val("");
                          $("#cust_addr1").val("");
                          $("#points").val("");
                          $("#existCust").val("");
                          $("#Mobile").val("");
                          $("#cust_code").attr('readonly',false);
                        }
                        if(data.custData.cust_code)
                        {
                          //$("#cust_code").attr('readonly',true);
                          $("#cust_code").val(data.custData.cust_code);
                        }
                        if(data.custData.cust_name)
                        {
                          $("#cust_name").val(data.custData.cust_name);
                        }
                        if(data.custData.cust_addr1)
                        {
                          $("#cust_addr1").val(data.custData.cust_addr1);
                        }
                        if(data.custData.points)
                        {
                          $("#points").val(data.custData.points);
                        }
                        // if(data.custData.Mobile)
                        // {
                        //   $("#Mobile").val(data.custData.Mobile);
                        // }
                        if(data.custData.existCust)
                        {
                          $("#existCust").val(data.custData.existCust);
                        }
                        
                     }
                 });
             });
        });
        function openmodal(e) {
        //prevent(default);
        //document.getElementById("demo").innerHTML = "YOU CLICKED ME!";
          $('#myModal').modal('show');
          $(document).on("click", ".hello", function(event){
            event.preventDefault();
            //e.value=$(this).attr("data-id");
            //alert(e.value);
            $('#myModal').modal('hide');
          });
        }
        $('#homedel').change(function(e){
          var hD= document.getElementById('homedel').value;
          var cd= document.getElementById('cust_code').value;
          if(hD=='Y' && (cd=='' || cd==null))
          {
            alert('Please Enter Cust-Id..!');
            $('#cust_code').focus();
            return false;
          }
        });
        
      </script>

@endsection
