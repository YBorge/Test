@extends('layout')
  
@section('content')

<div class="container-fluid">
<div class="panel panel-primary">
<div class="panel-heading" style="padding: 10px;"><b>Item Tax Master</b></div>
<div class="panel-body" >
    <div class="row">
    <form id="itemtaxMaster" name="itemtaxMaster" method="POST">
        {{ csrf_field() }} 
        <div class="col-md-2" class="form-group">
            <label style="color:black;">Item <span style="color:red;">*</span></label>
            <select name="item_code" id="item_code" class="form-control">
                <option value="" id="yes" readonly>Select</option>
                @foreach($item_master_data as $key => $itemmast)
                <option value="{{$key}}" >{{$itemmast}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2" class="form-group">
            <label>Tax % <span style="color:red;">*</span></label>
            <select name="tax_code" id="tax_code" class="form-control">
                <option value="" id="No" readonly>Select</option>
                @foreach($tax_master_data as $uKey => $taxmast)
                <option value="{{$uKey}}" >{{$taxmast}}</option>
                @endforeach
            </select>	
        </div>
        <div class="col-md-2" class="form-group">
            <label>Start Date<span style="color:red;">*</span></label>
            <input type="date" name="start_date" id="start_date" placeholder="Start Date" class="form-control">
        </div>
        <div class="col-md-2" class="form-group">
            <label>End Date</label>
            <input type="date" name="end_date" id="end_date" placeholder="End Date" class="form-control" readonly>
        </div>
        <div class="col-md-2" class="form-group">
            <label>State<span style="color:red;">*</span> </label>
            <input type="text" name="state_code" id="state_code" placeholder="Default '0'" class="form-control" value="0">
        </div>
        <div class="col-md-2" class="form-group" style="padding-top:22px;">
            <input type="submit" name="btn_submit" id="btn_submit" value="Add" class="btn btn-success">
            <input type="submit" name="btn_cancel_payment" id="btn_cancel_payment" value="Clear" class="btn btn-danger">
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
                    <th class="header" scope="col">Item Code</th>
                    <th class="header" scope="col">Item Name</th>
                    <th class="header" scope="col">Tax %</th>
                    <th class="header" scope="col">Tax Name</th>
                    <th class="header" scope="col">Start Date</th>
                    <th class="header" scope="col">End Date</th>
                    <th class="header" scope="col">State</th>
                    <th class="header" scope="col">Created By</th>
                    <th class="header" scope="col">Created Date</th>
                    <th class="header" scope="col">Updated By</th>
                    <th class="header" scope="col">Updated Date</th>
                    <th class="header" scope="col">Action</th>
                </tr>
            </thead>
                @php $srNo=0; $arrOfStatus=array(); $arrOfStatus['Y']='Active'; $arrOfStatus['N']='In-Active'; @endphp
                @foreach($item_tax_master_data as $taxKey => $taxValue)
                <tr>
                    <td>{{++$srNo}}</td>
                    <td>{{$taxValue->item_code}}</td>
                    <td>{{$item_master_data[$taxValue->item_code]}}</td>
                    <td>{{$taxValue->tax_code}}</td>
                    <td>{{$tax_master_data[$taxValue->tax_code]}}</td>
                    <td>{{$taxValue->start_date}}</td>
                    <td>{{$taxValue->end_date}}</td>
                    <td>{{$taxValue->state_code}}</td>
                    <td>{{$taxValue->created_by}}</td>
                    <td>{{$taxValue->created_at}}</td>
                    <td>{{$taxValue->updated_by}}</td>
                    <td>{{$taxValue->updated_at}}</td>
                    <td><a href="#" target="_blank" rel="noopener noreferrer"><img src="{{asset('front_assets/img/delete.png')}}" alt=""></a> &nbsp;<a href="#" target="_blank" rel="noopener noreferrer"><img src="{{asset('front_assets/img/edit.png')}}" alt=""></a></td>
                </tr>
                @endforeach
            </table>                   
        </div>  
    </div>
</div>
</form>
<script>
         $(document).ready(function(){
            var form=$("#itemtaxMaster");
            $('#btn_submit').click(function(e){
                 e.preventDefault();
                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                     }
                 });
                 $.ajax({
                    url: "{{ url('item_tax_master_post') }}",
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
                            $('#itemtaxMaster')[0].reset();
                            location.reload();
                       }
                    },
                    error: function(data) {
                    }
                 });
             });
         });
        
        $('#btn_cancel_payment').click(function(){
            $('#itemtaxMaster')[0].reset();
            return false;
        });
      </script>

@endsection
