<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<style type="text/css">
        
    table tr, th , td{border: 1px solid black;}
</style>
<body>
    <h5>User Master</h5>
    <table width="100%"  style="border-collapse: collapse;">
        
            <tr> 
                <th class="header" scope="col">Sr. No</th>
                    <th class="header" scope="col">User  Code</th>
                    <th class="header" scope="col">User  Name</th>
                    <th class="header" scope="col">Role</th>
                    <th class="header" scope="col">Mobile</th>
                    <th class="header" scope="col">Email</th>
                    <th class="header" scope="col">Status</th>
                    <th class="header" scope="col">Created By</th>
                    <th class="header" scope="col">Created Date and Time</th>
                    <th class="header" scope="col">Updated By</th>
                    <th class="header" scope="col">Updated Date and Time</th>
            </tr>
        
            @php $srNo=0; $arrOfStatus=array(); $arrOfStatus['Y']='Active'; @endphp
             @if(count($user_data) < 0)
                <tr>
                    <td colspan="10" style="color: red">No Record Found..!</td>
                </tr>
            @else
                @php $srNo=0; $arrOfStatus=array(); $arrOfStatus['Y']='Active';  @endphp
                @foreach($user_data as $usKey => $user)
                <tr>
                    
                    <td>{{++$srNo}}</td>
                    <td>{{$user->user_code}}</td>
                    <td>{{$user->uname}}</td>
                    <td>{{$user_role[$user->role]?? '-'}}</td>
                    <td>{{$user->mobile}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$arrOfStatus[$user->status]}}</td>
                    <td>{{$user->created_by}}</td>
                    <td>{{$user->created_at}}</td>
                    <td>{{$user->t_user}}</td>
                    <td>{{$user->updated_at}}</td>
                </tr>
                @endforeach
            @endif 
    </table>          
</body>
</html>                     