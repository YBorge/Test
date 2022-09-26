@extends('layout')
  
@section('content')

<div class="container-fluid">
<div class="panel panel-primary">
<div class="panel-heading" style="padding: 10px;"><b>Item Master</b></div>
<div class="panel-body" >
    <div class="row">
    <form id="itemMaster" name="itemMaster" method="POST">
        {{ csrf_field() }} 
        <div class="col-md-1" class="form-group">
            <label style="color:black;" >Item Code <span style="color:red;">*</span></label>
            @if($itemCodeSeq=='Y')
            <input type="text" name="item_code" id="item_code" class="form-control" readonly placeholder="Item Code" onkeypress="return isNumber(event)">
            @else
            <input type="text" name="item_code" id="item_code" class="form-control" placeholder="Item Code" onkeypress="return isNumber(event)">
            @endif
        </div>
        <div class="col-md-2" class="form-group">
            <label style="color:black;">Item Name <span style="color:red;">*</span></label>
            <input type="text" name="item_name" id="item_name" class="form-control"  placeholder="Item Name"value="">	
        </div>
        <div class="col-md-1" class="form-group">
            <label>Weight<span style="color:red;">*</span></label>
            <input type="text" name="item_weight" id="item_weight" placeholder="Weight" class="form-control" onkeypress="return isNumber(event)">
        </div>
        <div class="col-md-1" class="form-group">
            <label>Unit<span style="color:red;">*</span></label>
             <select name="item_UOM" id="item_UOM" class="form-control">
                <option value="" id="yes" readonly>Select</option>
                @foreach($unitType as $unitKey => $unitValue)
                <option value="{{$unitKey}}">{{$unitValue}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-1" class="form-group">
            <label>Item Type<span style="color:red;">*</span></label>
             <select name="item_type" id="item_type" class="form-control">
                <option value="" id="yes" readonly>Select</option>
                <option value="P" id="pack">Pack</option>
                 <option value="L" id="loose">Loose</option>
                 <option value="V" id="variant">Variant</option>
            </select>
        </div>
        
        <div class="col-md-1" class="form-group">
            <label>Parent Item </label><!-- <span style="color:red;">*</span> -->
            <select name="item_parent" id="item_parent" class="form-control">
                <option value="" id="No" readonly>Select</option>
                @foreach($parentItem as $parKey => $parItem)
                <option value="{{$parKey}}" id="Yes">{{$parItem}}</option>
                @endforeach
            </select>	
        </div>
        <div class="col-md-1" class="form-group">
            <label>Pack Charge</label>
            <input type="text" name="pack_charge" id="pack_charge" class="form-control" placeholder="Pack Chrg"value="" onkeypress="return isNumber(event)">  
        </div>
        <div class="col-md-1" class="form-group" >
            <label>Label Reqd</label>
            <select name="lebel_reqd" id="lebel_reqd" class="form-control" >
                <option value="" id="yes" readonly>Select</option>
                <option value="Y" id="yes">Yes</option>
                <option value="N" id="no">No</option>
            </select>
        </div>
        <div class="col-md-1" class="form-group" >
            <label>Qty In Case</label>
            <input type="text" name="qty_in_case" id="qty_in_case" class="form-control" placeholder="Quntity In Case"value="" onkeypress="return isNumber(event)">  
        </div>
        <div class="col-md-2" class="form-group" >
            <label>Tax (%)<span style="color:red;">*</span></label>
            <select name="tax_code" id="tax_code" class="form-control" >
                <option value="" id="yes" readonly>Select</option>
                @foreach($taxMaster as $taxKey => $taxValue)
                <option value="{{$taxKey}}" id="yes">{{$taxValue}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2" class="form-group">
                <label>Sub Category<span style="color:red;">*</span></label>
                <select name="sub_category_code" id="sub_category_code" class="form-control" >
                <option value="" id="yes" readonly>Select</option>
                @foreach($subCateMaster as $catKey => $catVal)
                <option value="{{$catKey}}" id="yes">{{$catVal}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2" class="form-group">
            <label>Category</label>
            <input type="text" name="category_name" id="category_name" class="form-control" placeholder=""value=""readonly>   
            <input type="hidden" name="category_code" id="category_code" class="form-control" placeholder=""value="" readonly>   
        </div>
        <div class="col-md-1" class="form-group">
            <label>Category Type</label>
            <input type="text" name="category_type" id="category_type" class="form-control" placeholder=""value="" readonly> 
        </div>
        <div class="col-md-1" class="form-group">
            <label>Inventory<span style="color:red;">*</span></label>
            <input type="text" name="inventory" id="inventory" class="form-control" placeholder=""value="" readonly>   
        </div>
        <div class="col-md-1" class="form-group">
                <label>Brand<span style="color:red;">*</span></label>
                <select name="brand_code" id="brand_code" class="form-control" >
                <option value="" id="yes" readonly>Select</option>
                @foreach($brand_master_data as $brKey => $brand)
                <option value="{{$brKey}}" id="yes">{{$brand}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-1" class="form-group" >
            <label>Manufacturer</label>
            <input type="text" name="manufact_name" id="manufact_name" class="form-control" placeholder="Manufacturer"value=""readonly>   
            <input type="hidden" name="manufact_code" id="manufact_code" class="form-control" placeholder=""value=""readonly>   
        </div>
        
        <div class="col-md-1" class="form-group" >
            <label>MarkUp (%)</label>
            <input type="text" name="markup" id="markup" class="form-control" placeholder="MarkUp"value="" onkeypress="return isNumber(event)">    
        </div>
        <div class="col-md-1" class="form-group" >
            <label>MarkDown(%)</label>
            <input type="text" name="markdown" id="markdown" class="form-control" placeholder="MarkDown"value="" size="30" onkeypress="return isNumber(event)">   
        </div>
        <div class="col-md-1" class="form-group" >
            <label>HSN No</label>
            <input type="text" name="hsn" id="hsn" class="form-control" placeholder="HSN No"value="" onkeypress="return isNumber(event)">   
        </div>
        <div class="col-md-1" class="form-group" >
            <label>Expiry Reqd</label>
            <select name="exp_req" id="exp_req" class="form-control" >
                <option value="" id="yes" readonly>Select</option>
                <option value="Y" id="yes">Yes</option>
                <option value="N" id="no">No</option>
            </select>
        </div>
        <div class="col-md-1" class="form-group" >
            <label>ShelfLife</label>
            <input type="text" name="shelf_life_period" id="shelf_life_period" class="form-control" placeholder="Shelf Life Peried" value="" onkeypress="return isNumber(event)">   
        </div>
        <div class="col-md-1" class="form-group" >
            <label>Shelf Life D/M</label>
            <select name="shelf_life_dm" id="shelf_life_dm" class="form-control" >
                <option value="" id="yes" readonly>Select</option>
                <option value="D" id="yes">Days</option>
                <option value="M" id="no">Months</option>
            </select>
        </div>
        <div class="col-md-1" class="form-group" >
            <label>Group 1</label>
            <input type="text" name="group1" id="group1" class="form-control" placeholder="Group 1"value="" >   
        </div>
        <div class="col-md-1" class="form-group" >
            <label>Group 2</label>
            <input type="text" name="group2" id="group2" class="form-control" placeholder="Group 2"value="" >   
        </div>
        <div class="col-md-1" class="form-group" >
            <label>Group 3</label>
            <input type="text" name="group3" id="group3" class="form-control" placeholder="Group 3"value="" >   
        </div>
        <div class="col-md-1" class="form-group" >
            <label>Group 4</label>
            <input type="text" name="group4" id="group4" class="form-control" placeholder="Group 4"value="" >   
        </div>
        <div class="col-md-2" class="form-group" >
            <label>BarCode</label>
            <input type="text" name="barcode" id="barcode" class="form-control" placeholder="BarCode"value="" style='text-transform:uppercase'> 
        </div>
        <div class="col-md-3" class="form-group" style="padding-top:22px;">
            <input type="submit" name="btn_submit" id="btn_submit" value="Add" class="btn btn-success">
            <input type="submit" name="btn_cancel_payment" id="btn_cancel_payment" value="Clear" class="btn btn-danger">
            
            <a href="{{route('item_master')}}" class="btn btn-primary">Exit</a>
        </div>
    </div>
    </div>
    
</div>
</form>
<script>
         $(document).ready(function(){
            var form=$("#itemMaster");
            $('#btn_submit').click(function(e){
                 e.preventDefault();
                 $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                 });
                 $.ajax({
                    url: "{{ url('item_master_store') }}",
                    method: 'post',
                    data:form.serialize(),
                    success: function(data)
                    {
                       if(data.errors) 
                       {
                            toastr.error(data.errors);
                       }
                       if(data.success) 
                       {
                            toastr.success('Data Saved Successfully');
                            $('#itemMaster')[0].reset();
                            location.reload();
                          
                       }
                    },
                    error: function(data) {
                    }
                 });
             });

            $('#sub_category_code').change(function(e){
                 e.preventDefault();
                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                     }
                 });
                 $.ajax({
                    url: "{{ url('item_master_cate') }}",
                    method: 'post',
                    data:form.serialize(),
                    success: function(data)
                    {
                        if(data.subCateData.markup)
                        {
                            $("#markup").val(data.subCateData.markup);
                        }
                        if(data.subCateData.markdown)
                        {
                            $("#markdown").val(data.subCateData.markdown);
                        }
                        if(data.subCateData.shelf_life_p)
                        {
                            $("#shelf_life_period").val(data.subCateData.shelf_life_p);
                        }
                        if(data.subCateData.shelf_life_dm)
                        {
                            $("#shelf_life_dm").val(data.subCateData.shelf_life_dm);
                        }
                        if(data.subCateData.cate_code)
                        {
                            $("#category_code").val(data.subCateData.cate_code);
                        }
                        if (data.subCateData.cateName) 
                        {
                            $("#category_name").val(data.subCateData.cateName);
                        }
                        if (data.subCateData.inventory) 
                        {
                            $("#inventory").val(data.subCateData.inventory);
                        }
                        if (data.subCateData.cat_type_name) 
                        {
                            $("#category_type").val(data.subCateData.cat_type_name);
                        }
                    }
                });
            });

            $('#brand_code').change(function(e){
                 e.preventDefault();
                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                     }
                 });
                 $.ajax({
                    url: "{{ url('item_master_brand') }}",
                    method: 'post',
                    data:form.serialize(),
                    success: function(data)
                    {
                        if(data.brand_data.manufact_name)
                        {
                            $("#manufact_name").val(data.brand_data.manufact_name);
                            $("#manufact_code").val(data.brand_data.manufact_code);
                        }
                        else{
                            $("#manufact_name").val("");
                            $("#manufact_code").val("");
                        }
                    }
                });
            });

        });
        
        $('#btn_cancel_payment').click(function(){
            $('#itemMaster')[0].reset();
            return false;
        });
      </script>

@endsection