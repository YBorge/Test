<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<style type="text/css">
        
    table tr, th , td{border: 1px solid black;}
</style>
<body>
    <h5>Vendor Master</h5>
    <table width="100%"  style="border-collapse: collapse;">
        
            <tr> 
                <th class="header" scope="col">Sr. No</th>
                <th class="header" scope="col">Code</th>
                <th class="header" scope="col">Name</th>
                <th class="header" scope="col">Type</th>
                <th class="header" scope="col">Credit Days</th>
                <th class="header" scope="col">Address 1</th>
                <th class="header" scope="col">Address 2</th>
                <th class="header" scope="col">City</th>
                <th class="header" scope="col">State</th>
                <th class="header" scope="col">Country</th>
                <th class="header" scope="col">Pin Code</th>
                <th class="header" scope="col">Phone No</th>
                <th class="header" scope="col">Email</th>
                <th class="header" scope="col">GSTIN</th>
                <th class="header" scope="col">FASSI No</th>
                <th class="header" scope="col">Aadhar No</th>
                <th class="header" scope="col">Pan No</th>
                <th class="header" scope="col">Contact Person</th>
                <th class="header" scope="col">Status</th>
                <th class="header" scope="col">Created By</th>
                <th class="header" scope="col">Created Date and Time</th>
                <th class="header" scope="col">Updated By</th>
                <th class="header" scope="col">Updated Date and Time</th>
            </tr>
        
            @php $srNo=0; $arrOfStatus=array(); $arrOfStatus['Y']='Active'; $arrOfStatus['N']='In-Active';@endphp
            @foreach($vendor_master_data as $venKey => $venvalue)
            <tr>
                
                <th>{{++$srNo}}</th>
                <th>{{$venvalue->vend_code}}</th>
                <th>{{$venvalue->vend_name}}</th>
                <th>{{$suply_type[$venvalue->type]}}</th>
                <th>{{$venvalue->credit_day}}</th>
                <th>{{$venvalue->aadr1}}</th>
                <th>{{$venvalue->addr2}}</th>
                <th>{{$city_master[$venvalue->city]}}</th>
                <th>{{$state_master[$venvalue->state]}}</th>
                <th>{{$country_master[$venvalue->country]}}</th>
                <th>{{$venvalue->pin}}</th>
                <th>{{$venvalue->phone}}</th>
                <th>{{$venvalue->email}}</th>
                <th>{{$venvalue->gstin}}</th>
                <th>{{$venvalue->fassi_no}}</th>
                <th>{{$venvalue->aadhar_no}}</th>
                <th>{{$venvalue->pan_no}}</th>
                <th>{{$venvalue->contact_person}}</th>
                <th>{{$arrOfStatus[$venvalue->status]}}</th>
                <th>{{$venvalue->created_by}}</th>
                <th>{{$venvalue->created_at}}</th>
                <th>{{$venvalue->t_user}}</th>
                <th>{{$venvalue->updated_at}}</th>
            </tr>
            @endforeach    
    </table>          
</body>
</html>                     