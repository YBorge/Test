<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<style type="text/css">
        
    table tr, th , td{border: 1px solid black;}
</style>
<body>
    <h5>Tax Master</h5>
    <table width="100%"  style="border-collapse: collapse;">
        
            <tr> 
                <th class="header" scope="col">Sr. No</th>
                <th class="header" scope="col">Type</th>
                <th class="header" scope="col">Name</th>
                <th class="header" scope="col">Code</th>
                <th class="header" scope="col">Tax (%)</th>
                <th class="header" scope="col">Tax Indicator</th>
                <th class="header" scope="col">IGST (%)</th>
                <th class="header" scope="col">SGST (%)</th>
                <th class="header" scope="col">CGST (%)</th>
                <th class="header" scope="col">UTGST (%)</th>
                <th class="header" scope="col">CESS (%)</th>
                <th class="header" scope="col">Cess Per Peice (%)</th>
                <th class="header" scope="col">Status</th>
                <th class="header" scope="col">Created By</th>
                <th class="header" scope="col">Created Date and Time</th>
                <th class="header" scope="col">Updated By</th>
                <th class="header" scope="col">Updated Date and Time</th>
            </tr>
        
            @php $srNo=0; $arrOfType=array(); $arrOfType['G']='GST'; $arrOfType['V']='Vat';             $arrOfStatus=array(); $arrOfStatus['Y']='Active'; $arrOfStatus['N']='In-Active'; @endphp
                @foreach($tax_master_data as $taxKey => $taxValue)
                <tr>
                    <td>{{++$srNo}}</td>
                    <td>{{$arrOfType[$taxValue->tax_type]}}</td>
                    <td>{{$taxValue->tax_code}}</td>
                    <td>{{$taxValue->tax_name}}</td>
                    <td>{{$taxValue->tax_per}}</td>
                    <td>{{$taxValue->tax_indicator}}</td>
                    <td>{{$taxValue->igst}}</td>
                    <td>{{$taxValue->sgst}}</td>
                    <td>{{$taxValue->cgst}}</td>
                    <td>{{$taxValue->utgst}}</td>
                    <td>{{$taxValue->cess}}</td>
                    <td>{{$taxValue->cessperpiece}}</td>
                    <td>{{$arrOfStatus[$taxValue->status]}}</td>
                    <td>{{$taxValue->created_by}}</td>
                    <td>{{$taxValue->created_at}}</td>
                    <td>{{$taxValue->t_user}}</td>
                    <td>{{$taxValue->updated_at}}</td>
                </tr>
                @endforeach    
    </table>          
</body>
</html>                     