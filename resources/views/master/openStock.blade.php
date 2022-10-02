@extends('layout')
  
@section('content')

<div class="container-fluid">
<div class="panel panel-primary">
<div class="panel-heading" style="padding: 10px;"><b>Add Opening Stock</b></div>
<div class="panel-body" >
    <div class="row">
    <form id="openStock" name="openStock" method="POST">
        {{ csrf_field() }} 
        
        <div class="col-md-1" class="form-group">
            <label>Location <span style="color:red;">*</span></label>
            <input type="text" name="loc_Code" id="loc_Code" class="form-control" value="{{ Session::get('companyname')}}" readonly>
        </div>
        <div class="col-md-2" class="form-group">
            <label style="color:black;">Barcode/Hotkey <span style="color:red;">*</span></label>
            <input type="text" name="barcode" id="barcode" placeholder="Scan Barcode" class="form-control">
        </div>
        <div class="col-md-1" class="form-group">
            <label style="color:black;">Code <span style="color:red;">*</span></label>
            <input type="text" name="item_code" id="item_code" class="form-control" placeholder="Item Code" value="" onkeypress="return isNumber(event)" readonly>	
        </div>
        <div class="col-md-2" class="form-group">
            <label style="color:black;">Name <span style="color:red;">*</span></label>
            <input type="text" name="item_name" id="item_name" placeholder="Item Name" class="form-control" onkeypress="return isNumber(event)" readonly>
        </div>
        <div class="col-md-1" class="form-group">
            <label style="color:black;">Markup (%)<span style="color:red;">*</span></label>
            <input type="text" name="markup" id="markup" placeholder="Markup (%)" class="form-control" onkeypress="return isNumber(event)" readonly>
        </div>
        <div class="col-md-1" class="form-group">
            <label style="color:black;">Markdown (%)<span style="color:red;">*</span></label>
            <input type="text" name="markdown" id="markdown" placeholder="Markdown (%)" class="form-control" onkeypress="return isNumber(event)" readonly>
        </div>
        <div class="col-md-1" class="form-group">
            <label style="color:black;">Quantity<span style="color:red;">*</span></label>
            <input type="text" name="qty" id="qty" placeholder="Quantity" class="form-control" onkeypress="return isNumber(event)">
        </div>
        <div class="col-md-1" class="form-group">
            <label style="color:black;">MRP<span style="color:red;">*</span></label>
            <input type="text" name="mrp" id="mrp" placeholder="MRP" class="form-control" onkeypress="return isNumber(event)">
        </div>
        <div class="col-md-1" class="form-group">
            <label style="color:black;">Sale Rate<span style="color:red;">*</span></label>
            <input type="text" name="sale_rate" id="sale_rate" placeholder="Sale Rate" class="form-control" onkeypress="return isNumber(event)">
        </div>
        <div class="col-md-1" class="form-group">
            <label style="color:black;">Cost Rate<span style="color:red;">*</span></label>
            <input type="text" name="cost_rate" id="cost_rate" placeholder="Cost Rate" class="form-control" onkeypress="return isNumber(event)">
        </div>
        <div class="col-md-1" class="form-group">
            <label>Department <span style="color:red;">*</span></label>
            <select name="loc_code" id="loc_code" class="form-control">
                <option value="" >Select</option>
                @foreach($dept_code as $key => $dept_value)
                <option value="{{$key}}" >{{$dept_value}}</option>
                @endforeach       
            </select>
        </div>        
        <div class="col-md-2" class="form-group">
            <label style="color:black;">Expiry Date<span style="color:red;">*</span></label>
            <input type="date" name="expiry" id="expiry" placeholder="Expiry Date" class="form-control">
        </div>
        <div class="col-md-4" style="padding-top:22px;">
            <input type="submit" name="manu_btn_submit" id="manu_btn_submit" value="Add" class="btn btn-success">&nbsp;
            <input type="submit" name="btn_cancel" id="btn_cancel" value="Clear" class="btn btn-danger"> 
            <a href="#" target="_blank" class="btn btn-primary">PDF</a>
            <button class="btn btn-primary" formaction="#" id="btn" type="submit">Excel</button>
        </div>
    </div>
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
                    <th class="header" scope="col">Sr. No</th>
                    <th class="header" scope="col">Location</th>
                    <th class="header" scope="col">Barcode</th>
                    <th class="header" scope="col">Item Code</th>
                    <th class="header" scope="col">Item Name</th>
                    <th class="header" scope="col">Quantity</th>
                    <th class="header" scope="col">MRP</th>
                    <th class="header" scope="col">Sale Rate</th>
                    <th class="header" scope="col">Cost Rate</th>
                    <th class="header" scope="col">Department</th>
                    <th class="header" scope="col">Expiry Date</th>
                    <th class="header" scope="col">Batch-No</th>
                    <th class="header" scope="col">Doc-Type</th>
                    <th class="header" scope="col">Company</th>
                    <th class="header" scope="col">Status</th>
                    <th class="header" scope="col">Created By</th>
                    <th class="header" scope="col">Created Date</th>
                    <th class="header" scope="col">Updated By</th>
                    <th class="header" scope="col">Updated Date</th>
                </tr>
            </thead>
                
            </table>                   
        </div>  
    </div>

</div>
</form>


@endsection