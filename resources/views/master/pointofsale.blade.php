@extends('layout')
  
@section('content')

<div class="container-fluid">
  <div class="panel panel-primary">
    <div class="panel-heading" style="padding: 10px;"><b>Point-of-Sale (Counter Sale)</b></div>
    <div class="panel-body" >
      <form id="posTransaction" name="posTransaction" method="POST">
        {{ csrf_field() }} 
        <table width="100%">
          <tr>
            <td><b> Mobile <span style="color:red;">*</span></b> <input type="text" name="" placeholder="Mobile"></td>
            <td><b>Cust-Id <span style="color:red;">*</span> </b><input type="text" name="" placeholder="Customer Id" > <input type="text" name="" placeholder="Customer Name"> <a href="#" class="btn btn-xs btn-primary"> New Customer</a>  </td>
            <td><b>HD <span style="color:red;">*</span> </b>
              <select name="">
                <option value="Y">Select</option>
                <option value="Y">YES</option>
                <option value="N">NO</option>
              </select>
            </td>
            <td><b>Points </b><input type="text" name="" placeholder="Points"></td>
            <td><b>Disc </b><input type="text" name="" placeholder="Amount"> <input type="text" name="" placeholder="%"></td>
          </tr>
        </table> <br>
        <table width="100%">
          <tr>
            <td><b>Address</b> <input type="text" name="" placeholder="Address"></td>
            <td><b>Last Bill No </b><input type="text" name="" placeholder="Last Bill No" > </td>
            <td><b>Last Bill Amt. </b><input type="text" name="" placeholder="Last Bill Amt" >
            </td>
            <td><b>Last Bill Charges </b><input type="text" name="" placeholder="Last Bill Charges" ></td>
            <td><b>Other Charges </b><input type="text" name="" placeholder="Amount"> <input type="text" name="" placeholder="%"></td>
          </tr>
        </table>
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