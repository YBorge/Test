@extends('layout')
  
@section('content')
<style type="text/css">
  .point{ width: 50px;padding: 5px;}
  table tr th,td {padding: 3px;}
  #myTable tr.header, #myTable tr:hover {
  background-color: #f1f1f1;
}
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
          <b> Mobile: </b> 
            <input type="text" name="Mobile" id="Mobile" placeholder="Mobile" style="width: 85px;" maxlength="10" onkeypress="return isNumber(event)">
          <b>  Cust-Id: <span style="color:red;">*</span> </b>
            <input type="text" name="cust_code" id="cust_code" style="width: 80px;" placeholder="Customer Id" onkeypress="return isNumber(event)" maxlength="50" >
            <input type="text" name="cust_name" id="cust_name" style="width: 147px;" placeholder="Customer Name" maxlength="60"> 
            <a href="{{route('customer_master')}}" target="_blank" class="btn btn-xs btn-primary">New Cust</a>
          <b>Points: </b>
            <input type="text" name="points" id="points" style="width: 80px;" placeholder="Points" readonly>
          <b> Home-Delivery: <span style="color:red;"></span> </b>
              <select name="homedel" id="homedel">
                <option value="">Select</option>
                <option value="Y">YES</option>
                <option value="N">NO</option>
              </select>
            <b>  Last Bill No: </b>
                <input type="text" name="lastBillNo" id="lastBillNo" align="center" maxlength="30" style="width: 93px;" placeholder="Last Bill No" readonly><br>
            <b> Address: </b> 
              <input type="text" name="cust_addr1" id="cust_addr1" style="width: 270px;" placeholder="Address">
            <b> Disc: </b>
              <input type="text" name="discAmt" id="discAmt" onclick="openmodal(this);" style="width: 60px;" maxlength="10" placeholder="Amt" onkeypress="return isNumber(event)" readonly>
              <input type="text" name="discPercent" id="discPercent" onkeypress="return isNumber(event)" readonly style="width: 50px;" placeholder="%"><b>
            <b> Oth Chrg: </b>
              <input type="text" name="otherCharges" id="otherCharges" onkeypress="return isNumber(event)" maxlength="10" style="width: 60px;" placeholder="Amt"><input type="text" name="" onkeypress="return isNumber(event)" style="width:50px;" placeholder="%">
            <b> Last Bill Amt/Change: </b>
              <input type="text" name="lastBillamt" id="lastBillamt"  onkeypress="return isNumber(event)" style="width: 100px;" placeholder="Last Bill Amt" readonly>
              <input type="text" name="lastBillamtChange" id="lastBillamtChange" style="width: 60px;" onkeypress="return isNumber(event)" placeholder="Change" maxlength="14">
            <br>
              <input type="hidden" name="existCust" id="existCust" value="" placeholder="existCust">
              <input type="hidden" name="itemCodeNew" id="itemCodeNew" value="" placeholder="itemCodeNew">
              <input type="hidden" name="itemBalQty" id="itemBalQty" value="" placeholder="itemBalQty">
            <b>Scan Barcode:</b>
              <input type="text" name="barcode" id="barcode" placeholder="Barcode" value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <b>SEARCH SKU:</b>
              <input type="text" name="skusearch" id="skusearch" onkeyup="myFunction()" placeholder="SEARCH SKU" value="">&nbsp;&nbsp;<input type="button" class="btn btn-primary btn-xs" id="getItem" name="getItem " value="Get Item Details"><br><br>
            <table width="100%" border="1" id="myTable">
              <tr class="header">
                <th>Sku </th>
                <th>Sku Name </th>
                <th>Batch-No </th>
                <th>MRP </th>
                <th>Disc </th>
                <th>Qty </th>
                <th>Rate </th>
                <th>Amount </th>
                <th style="text-align: center;">Select</th>
              </tr>
              <tbody id="tbdata">
              </tbody>
            </table>
        </div>
        <div class="col-md-3">
            <table width="80%" border="1">
              <tr>
                <th><b>Sku Count</b> </th>
                <th><input type="text" name="skuCount" id="skuCount" class="point" style="text-align:center" placeholder="" value="" readonly=""> </th>
                <th><b>Total Qty</b> </th>
                <th><input type="text" name="totalQty" id="totalQty" class="point" style="text-align:center" placeholder="" value="" readonly=""> </th>
              </tr>
            </table>
            <table width="80%" border="1">  
              <br>
              <tr>
                <td colspan="4" align="center"><b>Payable Value </b></td>
              </tr>
              <tr>
                <td colspan="4" align="center">
                <input type="text" name="payAmt" id="payAmt" readonly="" style="text-align:center" class="" placeholder="" value=""></td>
              </tr>
              </table>
            <table width="80%" border="1">  
              <br>
              <tr>
                <td colspan="4" ><b >Total MRP :</b>  <input type="text" name="totalMrp" id="totalMrp" class="" style="text-align:right" placeholder="" readonly="" value=""></td>
              </tr>
              <tr>
                <td colspan="4" ><b>Save :</b><input type="text" name="saveAmt" id="saveAmt" class="" readonly="" style="text-align:right" placeholder="" value=""></td>
              </tr>
               <tr>
                <td colspan="4" ><b>Amount :</b>  <input type="text" name="totalAmt" id="totalAmt" readonly="" class="" style="text-align:right" placeholder="" value="">
                </td>
              </tr>
               <tr>
                <td colspan="4" ><b>Pmt. Chrg :</b>  <input type="text" name="pmtCharge" id="pmtCharge" class="" style="text-align:right" placeholder="" value=""></td>
              </tr>
              <tr>
                <td colspan="4" ><b>Item Disc :</b>  <input type="text" name="itemDiscount" id="itemDiscount" class="" style="text-align:right" placeholder="" value=""></td>
              </tr>
              <tr>
                <td colspan="4" ><b>Bill Disc :</b>  <input type="text" name="billDiscont" id="billDiscont" class="" style="text-align:right" placeholder="" value=""></td>
              </tr>
              <tr>
                <td colspan="4" ><b>Round Off :</b>  <input type="text" name="roundOff" id="roundOff" class="" style="text-align:right" placeholder="" value=""></td>
              </tr>
            </table>
        </div>
        <div class="col-md-12">
          <a href="#" class="btn btn-xs btn-success"> Non-Lnv Sku</a>&nbsp;&nbsp;&nbsp;
          <button type="button" class="btn btn-xs btn-success" id="skuCopy"> Sku Copy</button>&nbsp;&nbsp;&nbsp;
          <button type="button" class="btn btn-xs btn-success RemoveSku"> Remove Sku</button>&nbsp;&nbsp;&nbsp;
          <a href="#" class="btn btn-xs btn-success"> Change Qty</a>&nbsp;&nbsp;&nbsp;
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
            <th align="center">Select</th>
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
                          if(data.emptyItemCode==1)
                          {
                            alert("Stock Not Available");
                          }
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
                                  <td>${row.amt}</td>
                                  <td align="center"><input type="checkbox" class="" value="${row.id}" name="itemCheckId[]" id="itemCheckId[]"></td>
                                </tr>`;
                              $('#tbdata').append(rowContent);
                            });
                            $("#skuCount").val(data.skuCount);
                            $("#totalQty").val(data.totalQty);
                            $("#payAmt").val(data.payAmt);
                            $("#totalMrp").val(data.totalMrp);
                            $("#saveAmt").val(data.saveAmt);
                            $("#totalAmt").val(data.payAmt);
                            $("#itemDiscount").val(data.itemDiscount);
                            setTimeout(function() {
                              $("#barcode").val("");
                            }, 3000);
                            
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
                                <td>${row.qty} <input type="hidden"  value="${row.qty}" name="balQty_${row.stock_id}" id="balQty_${row.stock_id}"></td>
                                <td><input type="checkbox" class="cbCheck" value="${row.stock_id}" name="itemCheck[]" id="itemCheck[]"></td>
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
                $("#itemBalQty").val("");
                alert("Can not select more than one checkbox..!");
                return false;
                exit();
              }
              var chkVal = $('.cbCheck:checked').val();
              $("#itemCodeNew").val(chkVal);
              var balqty= $("#balQty_"+chkVal).val();
              $("#itemBalQty").val(balqty);
              
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
                      if(data.success)
                      {
                        $('#myModal2').modal('hide');
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
                                  <td>${row.amt}</td>
                                  <td align="center"><input type="checkbox" class="" value="${row.id}" name="itemCheckId[]" id="itemCheckId[]"></td>
                                </tr>`;
                              $('#tbdata').append(rowContent);
                            });

                            $("#skuCount").val(data.skuCount);
                            $("#totalQty").val(data.totalQty);
                            $("#payAmt").val(data.payAmt);
                            $("#totalMrp").val(data.totalMrp);
                            $("#saveAmt").val(data.saveAmt);
                            $("#totalAmt").val(data.payAmt);
                            $("#itemDiscount").val(data.itemDiscount);
                          setTimeout(function(){
                              $("#barcode").val("");
                          }, 1000);
                            
                      }
                      if(data.errors) 
                      {  
                        toastr.error(data.errors);
                      }
                    }
                 });

             });

            $(".RemoveSku").click(function(e){
                $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                     }
                 });

                $.ajax({
                    url: "{{ url('pointofsale_RemoveSku') }}",
                    method: 'post',
                    data:form.serialize(),
                     success: function(data)
                     {
                      if (data.success) 
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
                                  <td>${row.amt}</td>
                                  <td align="center"><input type="checkbox" class="" value="${row.id}" name="itemCheckId[]" id="itemCheckId[]"></td>
                                </tr>`;
                              $('#tbdata').append(rowContent);
                            });

                            $("#skuCount").val(data.skuCount);
                            $("#totalQty").val(data.totalQty);
                            $("#payAmt").val(data.payAmt);
                            $("#totalMrp").val(data.totalMrp);
                            $("#saveAmt").val(data.saveAmt);
                            $("#totalAmt").val(data.payAmt);
                            $("#itemDiscount").val(data.itemDiscount);
                      }
                      else if(data.errors)
                      {
                        toastr.error(data.errors);
                      }
                     }
                 });
            });

            $("#skuCopy").click(function(e){
                e.preventDefault();
                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                     }
                });

                $.ajax({
                    url: "{{ url('pointofsale_copySku') }}",
                    method: 'post',
                    data:form.serialize(),
                    success: function(data)
                    {
                      if (data.success) 
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
                                  <td>${row.amt}</td>
                                  <td align="center"><input type="checkbox" class="" value="${row.id}" name="itemCheckId[]" id="itemCheckId[]"></td>
                                </tr>`;
                              $('#tbdata').append(rowContent);
                            });

                            $("#skuCount").val(data.skuCount);
                            $("#totalQty").val(data.totalQty);
                            $("#payAmt").val(data.payAmt);
                            $("#totalMrp").val(data.totalMrp);
                            $("#saveAmt").val(data.saveAmt);
                            $("#totalAmt").val(data.payAmt);
                            $("#itemDiscount").val(data.itemDiscount);
                      }
                      else if(data.errors)
                      {
                        toastr.error(data.errors);
                      }
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
          $('#myModal').modal('show');
          $(document).on("click", ".hello", function(event){
            event.preventDefault();
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

        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("skusearch");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
              td = tr[i].getElementsByTagName("td")[0];
              if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                  tr[i].style.display = "";
                } else {
                  tr[i].style.display = "none";
                }
              }       
            }
        }
        
</script>

@endsection
