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
    $arrOfYesNo=array(); $arrOfYesNo['Y']='Yes'; $arrOfYesNo['N']='No'; 
    $arrOfStatus=array(); $arrOfStatus['Y']='Active'; $arrOfStatus['N']='In-Active';
    $arrOfDayMonth=array(); $arrOfDayMonth['D']='Days'; $arrOfDayMonth['M']='Month';
    @endphp
    @if($cateType=='Master')
    <h4>Category Master</h4>
    <table width="100%">
        <thead>
            <tr>
                <th class="header" scope="col">Sr. No</th>
                <th class="header" scope="col">Code</th>
                <th class="header" scope="col">Name</th>
                <th class="header" scope="col">Type</th>
                <th class="header" scope="col">Group</th>
                <th class="header" scope="col">Inventory</th>
                <th class="header" scope="col">Status</th>
                <th class="header" scope="col">Created By</th>
                <th class="header" scope="col">Created Date and Time</th>
                <th class="header" scope="col">Updated Date and Time</th>
            </tr>
        </thead>
                @if(count($category_master_data) < 1)
                <tr>
                    <td>No Record Found.</td>
                </tr>
                @else
                @php $srNo=0; @endphp
                @foreach($category_master_data as $cat_value)
                <tr>
                    
                    <td>{{++$srNo}}</td>
                    <td>{{$cat_value->cat_code}}</td>
                    <td>{{$cat_value->cat_name}}</td>
                    <td>{{$food_type[$cat_value->cat_type]}}</td>
                    <td>{{$cat_value->group}}</td>
                    <td>{{$arrOfYesNo[$cat_value->inventory]}}</td>
                    <td>{{$arrOfStatus[$cat_value->status]}}</td>
                    <td>{{$cat_value->created_by}}</td>
                    <td>{{$cat_value->created_at}}</td>
                    <td>{{$cat_value->updated_at}}</td>
                </tr> 
                @endforeach
            @endif
    </table>
    @else
    <h4>Sub Category Master</h4>
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
                <th class="header" scope="col">Category</th>
                <th class="header" scope="col">Mark Up</th>
                <th class="header" scope="col">Mark Down</th>
                <th class="header" scope="col">Shelf Peried</th>
                <th class="header" scope="col">Day/Months</th>		
                <th class="header" scope="col">Status</th>
                <th class="header" scope="col">Created By</th>
                <th class="header" scope="col">Created Date and Time</th>
                <th class="header" scope="col">Updated Date and Time</th>
            </tr>
        </thead>
                @if(count($sub_category_master_data) < 1)
                <tr>
                    <td>No Record Found.</td>
                </tr>
                @else
                @php $srNo=0; @endphp
                @foreach($sub_category_master_data as $sub_cat_value)
                <tr>
                    <td>{{++$srNo}}</td>
                    <td>{{$sub_cat_value->sub_cat_code}}</td>
                    <td>{{$sub_cat_value->sub_cat_name}}</td>
                    <td>{{$cat_master[$sub_cat_value->cat_code]}}</td>
                    <td>{{$sub_cat_value->markup}}</td>
                    <td>{{$sub_cat_value->markdown}}</td>
                    <td>{{$sub_cat_value->shelf_life_p}}</td>
                    <td>{{$arrOfDayMonth[$sub_cat_value->shelf_life_dm]}}</td>
                    <td>{{$arrOfStatus[$sub_cat_value->status]}}</td>
                    <td>{{$sub_cat_value->created_by}}</td>
                    <td>{{$sub_cat_value->created_at}}</td>
                    <td>{{$sub_cat_value->updated_at}}</td>
                </tr> 
                @endforeach
            @endif
    </table>

    @endif
</body>
</html>
