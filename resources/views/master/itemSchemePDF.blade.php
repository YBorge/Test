<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<style>
    table, tr, th, td {
  border: 1px solid black;
}
</style>
<body>
    
    <h4>Item Level Scheme Master</h4>
    <table width="100%">
        <tr>
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
        
        @php 
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
                <td>{{++$srNo}}</td>
                <td>{{$item_value->loc_code}}</td>
                <td>{{$locData[$item_value->loc_code]}}</td>
                <td>{{$item_value->promo_code}}</td>
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
</body>
</html>
