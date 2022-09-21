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
    
    <h4>Payment Master</h4>
    <table width="100%">
        <tr>
            <th class="header" scope="col">Sr. No</th>
            <th class="header" scope="col">Payment  Code</th>
            <th class="header" scope="col">Payment  Name</th>
            <th class="header" scope="col">CalCulate On</th>
            <th class="header" scope="col">Charges (%)</th>
            <th class="header" scope="col">Allow Multi</th>
            <th class="header" scope="col">Bill Copy</th>
            <th class="header" scope="col">Status</th>
            <th class="header" scope="col">Created By</th>
            <th class="header" scope="col">Created Date and Time</th>
            <th class="header" scope="col">Updated Date and Time</th>
        </tr>
        
        @php $arrOfYesNo=array(); $arrOfYesNo['Y']='Yes'; $arrOfYesNo['N']='No';
        $arrOfCalOn=array(); $arrOfCalOn['M']='MRP'; $arrOfCalOn['S']='Sale'; 
        $arrOfStatus=array(); $arrOfStatus['Y']='Active'; $arrOfStatus['N']='In-Active';
        @endphp
        @if(count($paymentData) < 1)
        <tr>
            <td>No Record Found.</td>
        </tr>
        @else
        @php $srNo=0; @endphp
        @foreach($paymentData as $payment_value)
        <tr>
            <td>{{++$srNo}}</td>
            <td>{{$payment_value->pmt_code}}</td>
            <td>{{$payment_value->pmt_name}}</td>
            <td>{{$arrOfCalOn[$payment_value->calc_on]}}</td>
            <td>{{$payment_value->charge_per}}</td>
            <td>{{$arrOfYesNo[$payment_value->allow_multi]?? '-'}}</td>
            <td>{{$payment_value->bill_copy}}</td>
            <td>{{$arrOfStatus[$payment_value->status]}}</td>
            <td>{{$payment_value->created_by}}</td>
            <td>{{$payment_value->created_at}}</td>
            <td>{{$payment_value->updated_at}}</td>
        </tr> 
        @endforeach
        @endif    
    </table> 
</body>
</html>
