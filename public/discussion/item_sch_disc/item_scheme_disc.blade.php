@extends('layout')
  
@section('content')

<form id="itemScheme" name="itemScheme" method="POST">
<div class="container-fluid">
<div class="panel panel-primary">
<div class="panel-heading" style="padding: 10px;"><b>Item Level Scheme Master</b></div>
<div class="panel-body" >
    <div class="row">
        {{ csrf_field() }} 
        <!--<div class="col-md-1" class="form-group">
            <label style=" float: left;">Location</label>    
            <span style=" display: block;overflow: hidden;padding: 0 4px 0 6px">
            <select name="loc_code" id="loc_code" class="form-control" >
                <option value="" id="yes" readonly>Select</option>
                @foreach($locData as $locKey => $locVal)
                <option value="{{$locKey}}" id="yes">{{$locVal}}</option>
                @endforeach
            </select>
            </span>
        </div>-->
        <div class="col-md-1" class="form-group">
            <label>Location <span style="color:red;">*</span></label>
            <input type="text" name="loc_Code" id="loc_Code" class="form-control" value="{{ Session::get('companyloc_code')}}" readonly>
        </div>
        <div class="col-md-1" class="form-group">
            <label style="color:black;" >Promo<span style="color:red;">*</span></label>
            <select name="promo_code" id="promo_code" class="form-control">
                <option value="" id="yes" readonly>Select</option>
                <option value="F" id="Fix">Fix</option>
                <option value="P" id="Perc">Perc</option>
                <option value="A" id="Amt">Amt</option>
            </select>
        </div>
        <div class="col-md-2" class="form-group">
            <label style=" float: left;">Item</label>    
            <select name="item_code" id="item_code" class="form-control" >
                <option value="" id="yes" readonly>Select</option>
                @foreach($itemData as $itemKey => $itemVal)
                <option value="{{$itemKey}}" id="yes">{{$itemVal}}</option>
                @endforeach
            </select>
            </span>
        </div>
        <div class="col-md-1" class="form-group">
            <label style="color:black;">Batch</label>
            <input type="text" name="batch_no" id="batch_no" class="form-control"  placeholder="Batch" value="">
        </div>
        <div class="col-md-2" class="form-group">
            <label style="color:black;">Start Date</label>
            <input type="date" name="from_date" id="from_date" placeholder="Scheme Start Date" class="form-control">
        </div>
        <div class="col-md-2" class="form-group">
            <label style="color:black;">End Date</label>
            <input type="date" name="to_date" id="to_date" placeholder="Scheme End Date" class="form-control">
        </div>
        <div class="col-md-1" class="form-group">
            <label style="color:black;">Start Time</label>
            <input type="time" name="from_time" id="from_time" placeholder="Scheme Start Time" class="form-control">
        </div>
        <div class="col-md-1" class="form-group">
            <label style="color:black;">End Time</label>
            <input type="time" name="to_time" id="to_time" placeholder="Scheme End Time" class="form-control">
        </div>
        <div class="col-md-1" class="form-group">
            <label style="color:black;">From Qty</label>
            <input type="text" name="from_qty" id="from_qty" class="form-control"  placeholder="From Qty" value="" onkeypress="return isNumber(event)">
        </div>
        <div class="col-md-1" class="form-group">
            <label style="color:black;">To Qty</label>
            <input type="text" name="to_qty" id="to_qty" class="form-control"  placeholder="to Qty" value="" onkeypress="return isNumber(event)">	
        </div>
        <div class="col-md-1" class="form-group">
            <label style="color:black;">Max Qty</label>
            <input type="text" name="max_qty" id="max_qty" placeholder="Max Qty" class="form-control" onkeypress="return isNumber(event)">
        </div>
        <div class="col-md-1" class="form-group">
            <label style="color:black;">Fixed Rate</label>
            <input type="text" name="fix_rate" id="fix_rate" placeholder="Fixed Rate" class="form-control" onkeypress="return isNumber(event)">
        </div>
        <div class="col-md-1" class="form-group">
            <label style="color:black;">Disc Perc</label>
            <input type="text" name="disc_perc" id="disc_perc" placeholder="Disc Perc" class="form-control" onkeypress="return isNumber(event)">
        </div>
        <div class="col-md-1" class="form-group">
            <label style="color:black;">Disc Amt</label>
            <input type="text" name="disc_amt" id="disc_amt" placeholder="Disc Amt" class="form-control" onkeypress="return isNumber(event)">
        </div>
        <div class="col-md-1" class="form-group">
            <label style="color:black;" >Calc On</label>
            <select name="calc_on" id="calc_on" class="form-control">
                <option value="S" id="Sale">Sale</option>
                <option value="M" id="MRP">MRP</option>
            </select>
        </div>
        <div class="col-md-1" class="form-group">
            <label style="color:black;" >Cust Type Incl</label>
            <select name="cust_type_incl" id="cust_type_incl" class="form-control">
                <option value="" >Select</option>
                @foreach($cust_type_master as $key => $owener)
                <option value="{{$key}}" >{{$owener}}</option>
                @endforeach      
            </select> 
            <span class="text-danger"><strong id="txt_type-error"></strong></span>
        </div>
        <div class="col-md-1" class="form-group">
            <label style="color:black;" >Cust Type Excl</label>
            <select name="cust_type_excl" id="cust_type_excl" class="form-control">
                <option value="" >Select</option>
                @foreach($cust_type_master as $key => $owener)
                <option value="{{$key}}" >{{$owener}}</option>
                @endforeach      
            </select> 
            <span class="text-danger"><strong id="txt_type-error"></strong></span>
        </div>
        <div class="col-md-4" class="form-group" style="padding-top:22px;">
            <input type="submit" name="btn_submit" id="btn_submit" value="Add" class="btn btn-success">
            <input type="submit" name="btn_cancel_Module" id="btn_cancel_Module" value="Clear" class="btn btn-danger">
            <a href="{{route('item_scheme_disc_pdf')}}" class="btn btn-primary">PDF</a>
            <button class="btn btn-primary" formaction="{{route('item_scheme_disc_excel')}}" id="btn" type="submit">Excel</button>	
        </div>
    </div>
    </div>
    </div>   
    
    <div class="panel panel-primary">
    <div class="panel-heading" style="padding: 10px;"><b>Search</b></div>
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-2" class="form-group">
                <label style=" float: left;">Location</label> 
                <span style=" display: block;overflow: hidden;padding: 0 4px 0 6px">
                <select name="loc_code" id="loc_code" class="form-control" >
                    <option value="" id="yes" readonly>Select</option>
                    @foreach($locData as $locKey => $locVal)
                    <option value="{{$locKey}}" id="yes">{{$locVal}}</option>
                    @endforeach
                </select>
                </span>
            </div>
            <div class="col-md-2" class="form-group">
                <label style=" float: left;">Promo</label>
                <span style=" display: block;overflow: hidden;padding: 0 4px 0 6px">
                <select name="promo_code" id="promo_code" class="form-control">
                    <option value="" id="yes" readonly>Select</option>
                    <option value="F" id="Fix">Fix</option>
                    <option value="P" id="Perc">Perc</option>
                    <option value="A" id="Amt">Amt</option>
                </select>
            </div>
            <div class="col-md-2" class="form-group">
                <label style=" float: left;">Item</label>
                <span style=" display: block;overflow: hidden;padding: 0 4px 0 6px">  
                <select name="item_code" id="item_code" class="form-control" >
                    <option value="" id="yes" readonly>Select</option>
                    @foreach($itemData as $itemKey => $itemVal)
                    <option value="{{$itemKey}}" id="yes">{{$itemVal}}</option>
                    @endforeach
                </select>
                </span>
            </div>
        </div>
    </div>
    
    
    <div class="panel panel-primary">
    <div class="panel-heading" style="padding: 10px;"><b>Item List</b></div>
    <div class="panel-body" >
    <div class="row">
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
                    <th class="header" scope="col">Loc Code</th>
                    <th class="header" scope="col">Loc Name</th>
                    <th class="header" scope="col">Promo</th>
                    <th class="header" scope="col">Item Code</th>
                    <th class="header" scope="col">Item Name</th>
                    <th class="header" scope="col">Batch</th>
                    <th class="header" scope="col">Start Date</th>
                    <th class="header" scope="col">End Date</th>
                    <th class="header" scope="col">Start Time</th>
                    <th class="header" scope="col">End Time</th>
                    <th class="header" scope="col">From Qty</th>
                    <th class="header" scope="col">To Qty</th>
                    <th class="header" scope="col">Max Qty</th>
                    <th class="header" scope="col">Disc Perc(%)</th>
                    <th class="header" scope="col">Disc Amt</th>
                    <th class="header" scope="col">Fixed Rate</th>
                    <th class="header" scope="col">Calc On</th>
                    <th class="header" scope="col">Cust Type Incl</th>
                    <th class="header" scope="col">Cust Type Excl</th>
                    <th class="header" scope="col">Created By</th>
                    <th class="header" scope="col">Created Date</th>
                    <th class="header" scope="col">Updated By</th>
                    <th class="header" scope="col">Updated Date</th>
                </tr>
            </thead>
                @php 
                    $arrOfpromo_code=array(); $arrOfpromo_code['F']='Fix'; $arrOfpromo_code['P']='Perc'; $arrOfpromo_code['A']='Amt';
                    $arrOfcalc_on=array(); $arrOfcalc_on['S']='Sale'; $arrOfcalc_on['M']='MRP';
                @endphp
                @if(count($itemSchemeData) < 1)
                <tr>
                    <td>No Record Found.</td>
                </tr>
                @else
                    @php 
                        $srNo=0; 
                    @endphp
                    @foreach($itemSchemeData as $item_value)
                    <tr>
                        <td></td>
                        <td>{{++$srNo}}</td>
                        <td>{{$item_value->loc_code}}</td>
                        <td>{{$locData[$item_value->loc_code]}}</td>
                        <!--<td>{{$item_value->promo_code}}</td>-->
                        <td>{{$arrOfpromo_code[$item_value->promo_code]}}</td>
                        <td>{{$item_value->item_code}}</td>
                        <td>{{$itemData[$item_value->item_code]}}</td>
                        <td>{{$item_value->batch_no}}</td>
                        <td>{{$item_value->from_date}}</td>
                        <td>{{$item_value->to_date}}</td>
                        <td>{{$item_value->from_time}}</td>
                        <td>{{$item_value->to_time}}</td>
                        <td>{{$item_value->from_qty}}</td>
                        <td>{{$item_value->to_qty}}</td>
                        <td>{{$item_value->max_qty}}</td>
                        <td>{{$item_value->disc_perc}}</td>
                        <td>{{$item_value->disc_amt}}</td>
                        <td>{{$item_value->fix_rate}}</td>
                        <td>{{$arrOfcalc_on[$item_value->calc_on]}}</td>
                        <td>{{$item_value->cust_type_incl}}</td>
                        <td>{{$item_value->cust_type_excl}}</td>
                        <td>{{$item_value->created_by}}</td>
                        <td>{{$item_value->created_at}}</td>
                        <td>{{$item_value->updated_by}}</td>
                        <td>{{$item_value->updated_at}}</td>
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
            var form=$("#itemScheme");
            $('#btn_submit').click(function(e){
                 e.preventDefault();
                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                     }
                 });
                 $.ajax({
                    url: "{{ url('item_scheme_disc_post') }}",
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
                            $('#itemScheme')[0].reset();
                            location.reload();
                          
                       }
                    },
                    error: function(data) {
                    }
                });
            });
        });
        
        $('#promo_code').change(function(e){
            var promocode = document.getElementById('promo_code').value;
            var fielddisable_f=["disc_perc","disc_amt"];
            var fielddisable_p=["fix_rate","disc_amt"];
            var fielddisable_a=["fix_rate","disc_perc"];

            var fieldenable_f=["fix_rate"];
            var fieldenable_p=["disc_perc"];
            var fieldenable_a=["disc_amt"];

            if(promocode == 'F')
            {
                fielddisable_f.forEach(single_ele => {
                    $("#"+single_ele).prop("disabled",true);
                });
                fieldenable_f.forEach(single_ele => {
                    $("#"+single_ele).prop("disabled",false);
                    $("#"+single_ele).val("");
                });
            }
            else if(promocode == 'P')
            {
                fielddisable_p.forEach(single_ele => {
                    $("#"+single_ele).prop("disabled",true);
                });
                fieldenable_p.forEach(single_ele => {
                    $("#"+single_ele).prop("disabled",false);
                    $("#"+single_ele).val("");
                });
            }
            else if(promocode == 'A')
            {
                fielddisable_a.forEach(single_ele => {
                    $("#"+single_ele).prop("disabled",true);
                });
                fieldenable_a.forEach(single_ele => {
                    $("#"+single_ele).prop("disabled",false);
                    $("#"+single_ele).val("");
                });
            }
        });

        $('#btn_cancel_Module').click(function(){
            $('#itemScheme')[0].reset();
            return false;
        });
      </script>

@endsection
