<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<style type="text/css">
        
    table tr, th , td{border: 1px solid black;}
</style>
<body>
    <h5>Customer Master</h5>
    <table width="100%"  style="border-collapse: collapse;">
        
            <tr> 
                <th class="header" scope="col">Sr. No</th>
                <th class="header" scope="col">Code</th>
                <th class="header" scope="col">Name</th>
                <th class="header" scope="col">Gender</th>
                <th class="header" scope="col">Barcode</th>
                <th class="header" scope="col">Birth Date</th>
                <th class="header" scope="col">Join Date</th>
                <th class="header" scope="col">Address1</th>
                <th class="header" scope="col">Address2</th>
                <th class="header" scope="col">City</th>
                <th class="header" scope="col">State Code</th>
                <th class="header" scope="col">State</th>
                <th class="header" scope="col">Country Code</th>
                <th class="header" scope="col">Country</th>
                <th class="header" scope="col">Pincode</th>
                <th class="header" scope="col">Mobile</th>
                <th class="header" scope="col">Email</th>
                <th class="header" scope="col">PAN</th>
                <th class="header" scope="col">Aadhar No</th>
                <th class="header" scope="col">GSTIN</th>
                <th class="header" scope="col">Cust-Type</th>
                <th class="header" scope="col">Ref-Cust</th>
                <th class="header" scope="col">CR Limit</th>
                <th class="header" scope="col">CR Overdue Days</th>
                <th class="header" scope="col">Points</th>
                <th class="header" scope="col">Status</th>
                <th class="header" scope="col">Created By</th>
                <th class="header" scope="col">Created Date</th>
                <th class="header" scope="col">Updated By</th>
                <th class="header" scope="col">Updated Date</th>
            </tr>
        
            @php $srNo=0; $arrOfStatus=array(); $arrOfStatus['Y']='Active'; $arrOfStatus['N']='In-Active'; $arrOfGendor=array(); $arrOfGendor['M']='Male'; $arrOfGendor['F']='Female'; $arrOfGendor['T']='Transgender'; @endphp
            @foreach($cust_masterdata as $custKey => $custVal)
                <tr>
                    <td>{{++$srNo}}</td>
                    <td>{{$custVal->cust_code}}</td>
                    <td>{{$custVal->cust_name}}</td>
                    <td>{{$arrOfGendor[$custVal->gender]}}</td>
                    <td>{{$custVal->barcode?? '-'}}</td>
                    <td>{{$custVal->birth_date}}</td>
                    <td>{{$custVal->join_date}}</td>
                    <td>{{$custVal->cust_addr1}}</td>
                    <td>{{$custVal->cust_addr2}}</td>
                    <td>{{$city_master[$custVal->city]}}</td>
                    <td>{{$custVal->state}}</td>
                    <td>{{$state_master[$custVal->state]}}</td>
                    <td>{{$custVal->country}}</td>
                    <td>{{$country_master[$custVal->country]}}</td>
                    <td>{{$custVal->pincode}}</td>
                    <td>{{$custVal->Mobile}}</td>
                    <td>{{$custVal->email}}</td>
                    <td>{{$custVal->pan}}</td>
                    <td>{{$custVal->aadhar_no}}</td>
                    <td>{{$custVal->gstin}}</td>
                    <td>{{$cust_type_master[$custVal->cust_type]}}</td>
                    <td>{{$ref_customer[$custVal->ref_cust_code]}}</td>
                    <td>{{$custVal->cr_limit}}</td>
                    <td>{{$custVal->cr_overdue_days}}</td>
                    <td>{{$custVal->points}}</td>
                    <td>{{$arrOfStatus[$custVal->status]}}</td>
                    <td>{{$custVal->created_by}}</td>
                    <td>{{$custVal->created_at}}</td>
                    <td>{{$custVal->updated_by}}</td>
                    <td>{{$custVal->updated_at}}</td>
                </tr>
            @endforeach 
    </table>          
</body>
</html>                     