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
    @php  
    $arrOfYesNo=array(); $arrOfYesNo['B']='Branded'; $arrOfYesNo['U']='Unbranded'; 
    $arrOfStatus=array(); $arrOfStatus['Y']='Active'; $arrOfStatus['N']='In-Active';
    @endphp
    @if($Type=='ManfMaster')
    <h4>Manufacturing Company Master</h4>
    <table width="100%">
        <thead>
            <tr>
                <th class="header" scope="col">Sr. No</th>
                <th class="header" scope="col">Code</th>
                <th class="header" scope="col">Name</th>
                <th class="header" scope="col">Type</th>
                <th class="header" scope="col">Status</th>
                <th class="header" scope="col">Created By</th>
                <th class="header" scope="col">Created Date and Time</th>
                <th class="header" scope="col">Updated Date and Time</th>
            </tr>
        </thead>
                @if(count($manfacData) < 1)
                <tr>
                    <td>No Record Found.</td>
                </tr>
                @else
                @php $srNo=0; @endphp
                @foreach($manfacData as $mancf_value)
                <tr>
                    <td>{{++$srNo}}</td>
                    <td>{{$mancf_value->manufact_code}}</td>
                    <td>{{$mancf_value->manufact_name}}</td>
                    <td>{{$arrOfYesNo[$mancf_value->type]}}</td>
                    <td>{{$arrOfStatus[$mancf_value->status]}}</td>
                    <td>{{$mancf_value->created_by}}</td>
                    <td>{{$mancf_value->created_at}}</td>
                    <td>{{$mancf_value->updated_at}}</td>
                    
                </tr>
                @endforeach
            @endif
    </table>
    @else
    <h4>Brand Master</h4>
    <style>
    table, tr, th, td {
  font-size:12px;
}
</style>
    <table>
        <thead>
            <tr>
            <th class="header" scope="col">Sr. No</th>
            <th class="header" scope="col">Code</th>
            <th class="header" scope="col">Name</th>
            <th class="header" scope="col">Manufacturer</th>		
            <th class="header" scope="col">Status</th>
            <th class="header" scope="col">Created By</th>
            <th class="header" scope="col">Created Date and Time</th>
            <th class="header" scope="col">Updated Date and Time</th>
            </tr>
        </thead>
                @if(count($brandData) < 1)
                <tr>
                    <td>No Record Found.</td>
                </tr>
                @else
                @php $srNo=0; @endphp
                @foreach($brandData as $brand_value)
                <tr>
                    <td>{{++$srNo}}</td>
                    <td>{{$brand_value->brand_code}}</td>
                    <td>{{$brand_value->brand_name}}</td>
                    <td>{{$manftype[$brand_value->manufact_code]}}</td>
                    <td>{{$arrOfStatus[$brand_value->status]}}</td>
                    <td>{{$brand_value->created_by}}</td>
                    <td>{{$brand_value->created_at}}</td>
                    <td>{{$brand_value->updated_at}}</td>
                    
                </tr>
                @endforeach
            @endif
    </table>

    @endif
</body>
</html>
