@extends('layout')
  
@section('content')
<form id="itemList" name="itemList" method="POST">
    {{ csrf_field() }} 
<div class="container-fluid">
    <div class="row form-group"> 
        <div class="col-md-4" class="form-group" style="padding-top:22px;">
            <a href="{{route('item_master_add')}}" class="btn btn-success"> Add Item </a>
            <a href="{{route('item_master_pdf')}}" class="btn btn-primary"> PDF </a>
            <button class="btn btn-primary" formaction="{{route('item_master_excel')}}" id="btn" type="submit">Excel</button>	
        </div>
    </div>
<div class="panel panel-primary">
<div class="panel-heading"><b>List Of Item</b></div>
<div class="panel-body" >
    
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
                    <th class="header" scope="col">View</th>
                    <th class="header" scope="col">No</th>
                    <th class="header" scope="col">Status</th>
                    <th class="header" scope="col">Code</th>
                    <th class="header" scope="col">Name</th>
                    <th class="header" scope="col">Weight</th>
                    <th class="header" scope="col">Unit</th>
                    <th class="header" scope="col">Item Type</th>
                    <th class="header" scope="col">Parent Item</th>
                    <th class="header" scope="col">Pack Charge</th>
                    <th class="header" scope="col">Label Reqd</th>
                    <th class="header" scope="col">Qty In Case</th>
                    <th class="header" scope="col">Tax (%)</th>
                    <th class="header" scope="col">Sub Category</th>
                    <th class="header" scope="col">Category</th>
                    <th class="header" scope="col">Category Type</th>
                    <th class="header" scope="col">Inventory</th>
                    <th class="header" scope="col">Brand</th>
                    <th class="header" scope="col">Manufacturer</th>
                    <th class="header" scope="col">MarkUp (%)</th>
                    <th class="header" scope="col">MarkDown (%)</th>
                    <th class="header" scope="col">Rate Update</th>
                    <th class="header" scope="col">HSN No</th>
                    <th class="header" scope="col">Expiry Reqired</th>
                    <th class="header" scope="col">ShelfLife</th>
                    <th class="header" scope="col">Shelf Life D/M</th>
                    <th class="header" scope="col">Group 1</th>
                    <th class="header" scope="col">Group 2</th>
                    <th class="header" scope="col">Group 3</th>
                    <th class="header" scope="col">Group 4</th>
                    <th class="header" scope="col">Bar Code</th>
                    <th class="header" scope="col">Created By</th>
                    <th class="header" scope="col">Created Date and Time</th>
                    <th class="header" scope="col">Updated By</th>
                    <th class="header" scope="col">Updated Date and Time</th>
                </tr>
            </thead>
            @php $srNo=0;
                $arrOfYesNo=array(); $arrOfYesNo['Y']='Yes'; $arrOfYesNo['N']='No'; 
                $arrOfStatus=array(); $arrOfStatus['Y']='Active'; $arrOfStatus['N']='In-Active';
                $arrOfDayMonth=array(); $arrOfDayMonth['D']='Days'; $arrOfDayMonth['M']='Month';
                $arrOfPackLoose=array(); $arrOfPackLoose['P']='Pack'; $arrOfPackLoose['L']='Loose'; $arrOfPackLoose['V']='Variant';
            @endphp
            @if(sizeof($item_master_data) < 1)
                <tr>
                    <td colspan="25">No Record Found..!</td>
                </tr>
            @endif
            @foreach($item_master_data as $itemKey => $itemvalue)
                <tr>
                    <td></td>
                    <td></td>
                    <td>{{++$srNo}}</td>
                    <td>{{$arrOfStatus[$itemvalue->status]}}</td>
                    <td>{{$itemvalue->item_code}}</td>
                    <td>{{$itemvalue->item_name?? '-'}}</td>
                    <td>{{$itemvalue->item_weight}}</td>
                    <td>{{$unitType[$itemvalue->item_UOM]}}</td>
                    <td>{{$arrOfPackLoose[$itemvalue->item_type]?? '-'}}</td>
                    <td>{{$parentItem[$itemvalue->item_parent]?? '-'}}</td>
                    <td>{{$itemvalue->pack_charge}}</td>
                    <td>{{$arrOfYesNo[$itemvalue->lebel_reqd]?? '-'}}</td>
                    <td>{{$itemvalue->qty_in_case}}</td>
                    <td>{{$taxMaster[$itemvalue->tax_code]?? '-'}}</td>
                    <td>{{$subCateMaster[$itemvalue->sub_category_code]?? '-'}}</td>
                    <td>{{$category_data[$itemvalue->category_code]?? '-'}}</td>
                    <td>{{$itemvalue->category_type}}</td>
                    <td>{{$itemvalue->inventory}}</td>
                    <td>{{$brand_master_data[$itemvalue->brand_code]?? '-'}}</td>
                    <td>{{$manufact_master_data[$itemvalue->manufact_code]?? '-'}}</td>
                    <td>{{$itemvalue->markup}}</td>
                    <td>{{$itemvalue->markdown}}</td>
                    <td>{{$itemvalue->rate_upd}}</td>
                    <td>{{$itemvalue->hsn}}</td>
                    <td>{{$arrOfYesNo[$itemvalue->exp_req]?? '-'}}</td>
                    <td>{{$itemvalue->shelf_life_period}}</td>
                    <td>{{$arrOfDayMonth[$itemvalue->shelf_life_dm]?? '-'}}</td>
                    <td>{{$itemvalue->group1}}</td>
                    <td>{{$itemvalue->group2}}</td>
                    <td>{{$itemvalue->group3}}</td>
                    <td>{{$itemvalue->group4}}</td>
                    <td>{{$itemvalue->barcode}}</td>
                    <td>{{$itemvalue->created_by}}</td>
                    <td>{{$itemvalue->created_at}}</td>
                    <td>{{$itemvalue->t_user}}</td>
                    <td>{{$itemvalue->updated_at}}</td>
                </tr>
            @endforeach       
            </table>                   
        </div>  
    </div>
</div>
</form>
@endsection