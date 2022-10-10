@extends('layout')
  
@section('content')
<form id="pmtinclexclMaster" name="pmtinclexclMaster" method="POST">
    {{ csrf_field() }} 
<div class="container-fluid">
    <div class="col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading" style="padding: 10px;"><b>Pyament Include/Exclude Master</b></div>
            <div class="panel-body" >
                <div class="row">
                    <div class="col-md-2" class="form-group">
                        <label>Payment <span style="color:red;">*</span></label>
                        <select name="pmt_code" id="pmt_code" class="form-control">
                            <option value="" >Select</option>
                            @foreach($pmt_code as $key => $pmt_value)
                            <option value="{{$key}}" >{{$pmt_value}}</option>
                            @endforeach       
                        </select>
                    </div>
                    <div class="col-md-2" class="form-group">
                        <label style="color:black;">Trans-Type <span style="color:red;">*</span></label>
                        <select name="trans_type" id="trans_type" class="form-control">
                            <option value="">Select</option>
                            <option value="CT">Category</option>
                            <option value="SC">Sub-Category</option>
                            <option value="M">Manufacturer</option>
                            <option value="B">Brand</option>
                            <option value="I">Item-Code</option>
                        </select>
                        <span class="text-danger"><strong id="txt_type-error"></strong></span>
                    </div>        
                    <div class="col-md-3" class="form-group">
                        <label style="color:black;">Transaction <span style="color:red;">*</span></label>
                        <input type="text" name="trans_name" id="trans_name" class="form-control" placeholder="Transaction Name"value="">	
                    </div>        
                    <div class="col-md-1" class="form-group">
                        <label style="color:black;">Include/Exclude <span style="color:red;">*</span></label>
                        <select name="type" id="type" class="form-control">
                            <option value="">Select</option>
                            <option value="I">Include</option>
                            <option value="E">Exclude</option>
                        </select>
                    </div>        
                    <div class="col-md-4" class="form-group" style="padding-top:22px;">
                        <input type="submit" name="btn_submit" id="btn_submit" value="Add" class="btn btn-success">	
                        <input type="submit" name="btn_cancel" id="btn_cancel" value="Clear" class="btn btn-danger "> 
                    </div>
                </div>
            </div>
            <style>
                .header{
                    position:sticky;
                    top: 0 ;
                }
                .table-responsive {
                    height: 300px;
                    overflow: auto;
                }
            </style>
            <div class="table-responsive">
                <table class="mytable table table-bordered" id="example" class="display nowrap" style="width:100%">
                    <thead style="position: sticky;top: 0" class="thead-dark">
                        <tr>
                            <th class="header" scope="col">Sr. No</th>
                            <th class="header" scope="col">Payment  Code</th>
                            <th class="header" scope="col">Payment  Name</th>
                            <th class="header" scope="col">Trans-Type</th>
                            <th class="header" scope="col">Trans-Code</th>
                            <th class="header" scope="col">Trans-Name</th>
                            <th class="header" scope="col">Incl/Excl</th>
                            <th class="header" scope="col">Status</th>
                            <th class="header" scope="col">Created By</th>
                            <th class="header" scope="col">Created Date</th>
                            <th class="header" scope="col">Updated By</th>
                            <th class="header" scope="col">Updated Date</th>
                        </tr>
                    </thead>
                                @if(count($comp_pmt_incl_excl_master) < 1)
                                <tr>
                                    <td>No Details Found.</td>
                                </tr>
                                @else
                                @php $srNo=0; @endphp
                                @foreach($comp_pmt_incl_excl_master as $mast_value)
                                <tr>
                                    <td>{{++$srNo}}</td>
                                    <td>{{$mast_value->lpmt_code}}</td>
                                    <td>{{$mast_value->pmt_name}}</td>
                                    <td></td>
                                    <td>{{$mast_value->trans_type}}</td>
                                    <td>{{$mast_value->trans_code}}</td>
                                    <td>{{$state_master[$mast_value->trans_name]}}</td>
                                    <td>{{$comp_city[$mast_value->incl_excl]}}</td>
                                    <td>{{$mast_value->status}}</td>
                                    <td>{{$mast_value->created_by}}</td>
                                    <td>{{$mast_value->created_at}}</td>
                                    <td>{{$mast_value->updated_by}}</td>
                                    <td>{{$mast_value->updated_at}}</td>
                                </tr> 
                                @endforeach
                            @endif
                    </table>                   
                </div>  
            </div>
        </div>    
    </div>
</div>
</form>
<script>
    $(document).ready(function(){
        var form=$("#pmtinclexclMaster");
        $('#btn_submit').click(function(e){
        e.preventDefault();
        $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
            $.ajax({
                url: "{{ url('pmt_incl_excl_master_post') }}",
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
                        $('#pmtinclexclMaster')[0].reset();
                        location.reload();
                        
                    }
                },
                error: function(data) {
                }
            });
        });
    });
        
</script>

@endsection