@extends('layout')
  
@section('content')

<form id="itemMaster" name="itemMaster" method="POST">
    {{ csrf_field() }} 
    <div class="container-fluid" style="padding-left:5px; padding-right:5px;">
        <div class="panel panel-primary">
            <div class="panel-heading" align="center" style="padding: 5px 0px 5px 0px;"><b>Add Items</b></div>
            <div class="panel-body ">
                <div class="col-md-12">
                    <div class="col-md-8 rounded-6 bg-primary text-white "  >
                        <div class="col-md-12" style="padding:5px;">
                            <div class="col-md-3" class="form-group">
                                <label style=" float: left;">Item Code<span style="color:red;">*</span></label>
                                 @if($itemCodeSeq=='Y')
                                 <span style=" display: block;overflow: hidden;padding: 0 4px 0 6px">
                                <input type="text" name="item_code" id="item_code" class="form-control" readonly placeholder="Item Code" onkeypress="return isNumber(event)"></span>
                                @else
                                <span style=" display: block;overflow: hidden;padding: 0 4px 0 6px">
                                <input type="text" name="item_code" id="item_code" class="form-control" placeholder="Item Code" onkeypress="return isNumber(event)"></span>
                                @endif                   
                            </div>
                            <div class="col-md-9" class="form-group">
                                <label style=" float: left;">Item Name<span style="color:red;">*</span></label>
                                <span style=" display: block;overflow: hidden;padding: 0 4px 0 6px">
                                    <input type="text" name="item_name" id="item_name" placeholder="Item Name" class="form-control"></span>
                            </div>

                            <div class="col-md-12" style="padding:5px;">
                                <div class="col-md-4" class="form-group">
                                    <label style=" float: left;">Inventory<span style="color:red;">*</span></label>
                                   
                                    <span style=" display: block;overflow: hidden;padding: 0 4px 0 6px"><input type="text" name="inventory" id="inventory" class="form-control" placeholder=""value=""readonly >  </span>
                                </div>
                                <div class="col-md-4" class="form-group">
                                     <label style=" float: left;">Unit<span style="color:red;">*</span></label>
                                    <span style=" display: block;overflow: hidden;padding: 0 4px 0 6px"> 
                                     <select name="item_UOM" id="item_UOM" class="form-control">
                                        <option value="" id="yes" readonly>Select</option>
                                        @foreach($unitType as $unitKey => $unitValue)
                                        <option value="{{$unitKey}}">{{$unitValue}}</option>
                                        @endforeach
                                    </select></span>
                                   
                                </div>
                                <div class="col-md-4" class="form-group">
                                    <label style=" float: left;">Weight<span style="color:red;">*</span></label>
                                    <span style=" display: block;overflow: hidden;padding: 0 4px 0 6px"><input type="text" name="item_weight" id="item_weight" placeholder="Weight" class="form-control" onkeypress="return isNumber(event)"></span>
                                </div>
                            </div>
                            <div class="col-md-12" style="padding:5px;">
                                <label style=" float: left;">Catelog Name<span style="color:red;">*</span></label>
                                    <span style=" display: block;overflow: hidden;padding: 0 4px 0 6px"><input type="text" name="txt_catlogname" id="txt_catlogname" placeholder="Weight" class="form-control" onkeypress="return isNumber(event)"></span>
                            </div>
                            <div class="col-md-12" style="padding:5px;">
                                <label style=" float: left;">Discription<span style="color:red;">*</span></label>
                                    <span style=" display: block;overflow: hidden;padding: 0 4px 0 6px"><input type="text" name="txt_catdisc" id="txt_catdisc" placeholder="Discription" class="form-control" onkeypress="return isNumber(event)"></span>
                            </div>
                            <div class="col-md-12" style="padding:5px;">
                                <div class="col-md-5" class="form-group">
                                    <span style=" display: block;overflow: hidden;padding: 0 4px 0 6px">
                                    <label>Sub Category<span style="color:red;">*</span></label>
                                        <select name="sub_category_code" id="sub_category_code" class="form-control" >
                                        <option value="" id="yes" readonly>Select</option>
                                        @foreach($subCateMaster as $catKey => $catVal)
                                        <option value="{{$catKey}}" id="yes">{{$catVal}}</option>
                                        @endforeach
                                    </select>
                                    </span>
                                                
                                </div>
                                
                                <div class="col-md-1" class="form-group">
                                    <a href="{{route('cate_master')}}" class="btn btn-danger btn-xs">+</a>
                                </div>
                                <div class="col-md-5" class="form-group">
                                    <label style=" float: left;">Category Code And Name<span style="color:red;">*</span></label>
                                    
                                    <span style=" display: block;overflow: hidden;padding: 0 4px 0 6px"><input type="text" name="category_name" id="category_name" class="form-control" placeholder=""value=""readonly></span>
                                    <input type="hidden" name="category_code" id="category_code" class="form-control" placeholder=""value="" readonly> 
                                </div>
                                <div class="col-md-1" class="form-group">
                                    <a href="{{route('cate_master')}}" class="btn btn-danger btn-xs">+</a>
                                </div>
                            </div>
                            
                            <div class="col-md-12" style="padding:5px;">
                                <div class="col-md-5" class="form-group">
                                    <label style=" float: left;">Brand<span style="color:red;">*</span></label>
                                    <span style=" display: block;overflow: hidden;padding: 0 4px 0 6px">
                                    <select name="brand_code" id="brand_code" class="form-control" >
                                        <option value="" id="yes" readonly>Select</option>
                                        @foreach($brand_master_data as $brKey => $brand)
                                        <option value="{{$brKey}}" id="yes">{{$brand}}</option>
                                        @endforeach
                                    </select>
                                    </span>
                                    
                                </div>
                               
                                <div class="col-md-1" class="form-group">
                                    <a href="{{route('brand_master')}}" class="btn btn-danger btn-xs">+</a>
                                </div>
                                <div class="col-md-5" class="form-group">
                                    <label style=" float: left;">Manufacturer Code And Name<span style="color:red;">*</span></label>
                                    <span style=" display: block;overflow: hidden;padding: 0 4px 0 6px"><input type="text" name="manufact_name" id="manufact_name" class="form-control" placeholder="Manufacturer"value=""readonly>   
                                    <input type="hidden" name="manufact_code" id="manufact_code" class="form-control" placeholder=""value=""readonly> </span>
                                </div>
                                <div class="col-md-1" class="form-group">
                                    <a href="{{route('brand_master')}}" class="btn btn-danger btn-xs">+</a>
                                </div>
                            </div>
                           
                            <div class="col-md-12" style="padding:5px;">
                                <div class="col-md-4" class="form-group">
                                    <label style=" float: left;">Item Type<span style="color:red;">*</span></label>
                                    <span style=" display: block;overflow: hidden;padding: 0 4px 0 6px">
                                     <select name="item_type" id="item_type" class="form-control">
                                        <option value="" id="yes" readonly>Select</option>
                                        <option value="P" id="pack">Pack</option>
                                         <option value="L" id="loose">Loose</option>
                                         <option value="V" id="variant">Variant</option>
                                    </select></span>
                                </div>
                                <div class="col-md-4" class="form-group">
                                    <label style=" float: left;">Ref.Itm<span style="color:red;">*</span></label>
                                    <span style=" display: block;overflow: hidden;padding: 0 4px 0 6px"><input type="text" name="txt_refitm" id="txt_refitm" placeholder="Ref.Itm" class="form-control" ></span>
                                </div>
                                <div class="col-md-4" class="form-group">
                                    <input type="text" name="txt_refitm_disp" id="txt_refitm_disp" placeholder="" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12" style="padding:5px;">
                                <div class="col-md-4" class="form-group">
                                    <label style=" float: left;">Pack Type<span style="color:red;">*</span></label>
                                    <span style=" display: block;overflow: hidden;padding: 0 4px 0 6px"><input type="text" name="txt_packtype" id="txt_packtype" placeholder="Ref.Itm" class="form-control" ></span>
                                </div>
                                <div class="col-md-2" class="form-group">
                                    <input type="text" name="txt_packtype1" id="txt_packtype1" placeholder="" class="form-control" >
                                </div>
                                <div class="col-md-4" class="form-group">
                                    <label style=" float: left;">Pack From<span style="color:red;">*</span></label>
                                    <span style=" display: block;overflow: hidden;padding: 0 4px 0 6px"><input type="text" name="txt_packfrom" id="txt_packfrom" placeholder="Ref.Itm" class="form-control" ></span>
                                </div>
                                <div class="col-md-2" class="form-group">
                                    <input type="text" name="txt_packfrom1" id="txt_packfrom1" placeholder="" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12" style="padding:5px;">
                                <div class="col-md-2" class="form-group">
                                    <label>Tax (%)<span style="color:red;">*</span></label>
                                    <select name="tax_code" id="tax_code" class="form-control" >
                                        <option value="" id="yes" readonly>Select</option>
                                        @foreach($taxMaster as $taxKey => $taxValue)
                                        <option value="{{$taxKey}}" id="yes">{{$taxValue}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2" class="form-group">
                                    <input type="text" name="txt_taxval" id="txt_taxval" placeholder="" class="form-control" >
                                </div>
                                <div class="col-md-3" class="form-group" >
                                    <label>Label Reqd</label>
                                    <select name="lrequd" id="lrequd" class="form-control" >
                                        <option value="" id="yes" readonly>Select</option>
                                        <option value="Y" id="yes">Yes</option>
                                        <option value="N" id="no">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12" style="padding:5px;">
                                <div class="col-md-4" class="form-group">
                                    <label style=" float: left;">On MRP<span style="color:red;">*</span></label>
                                    <span style=" display: block;overflow: hidden;padding: 0 4px 0 6px">
                                    <select name="lrequd" id="lrequd" class="form-control" >
                                        <option value="" id="yes" readonly>Select</option>
                                        <option value="Y" id="yes">Yes</option>
                                        <option value="N" id="no">No</option>
                                    </select></span>
                                </div>
                                <div class="col-md-3" class="form-group" >
                                    <label style=" float: left;">MarkUp (%)</label>
                                    <span style=" display: block;overflow: hidden;padding: 0 4px 0 6px"><input type="text" name="markup" id="markup" class="form-control" placeholder="MarkUp"value="" onkeypress="return isNumber(event)"></span> 
                                </div>
                                <div class="col-md-3" class="form-group" >
                                    <label style=" float: left;">MarkDown(%)</label>
                                    <span style=" display: block;overflow: hidden;padding: 0 4px 0 6px"><input type="text" name="markdown" id="markdown" class="form-control" placeholder="MarkDown"value="" size="30" onkeypress="return isNumber(event)">   </span> 
                                </div>
                            </div>
                            <div class="col-md-12" style="padding:5px;">
                                
                                <div class="col-md-3" class="form-group" >
                                    <label style=" float: left;">RateUpdate</label>
                                    <span style=" display: block;overflow: hidden;padding: 0 4px 0 6px"><input type="text" name="txt_rateupd" id="txt_rateupd" class="form-control" placeholder="RateUpdate"value="" onkeypress="return isNumber(event)"></span>    
                                </div>
                                <div class="col-md-3" class="form-group" >
                                    <label style=" float: left;">HSN No</label>
                                    <span style=" display: block;overflow: hidden;padding: 0 4px 0 6px"><input type="text" name="hsn" id="hsn" class="form-control" placeholder="HSN No"value="" onkeypress="return isNumber(event)"></span>    
                                </div>
                            </div>
                            <div class="col-md-12" style="padding:5px;">
                                <div class="col-md-3" class="form-group" >
                                    <label style=" float: left;">Expiry Reqd</label><span style=" display: block;overflow: hidden;padding: 0 4px 0 6px">
                                        <select name="expired" id="expired" class="form-control" >
                                            <option value="" id="yes" readonly>Select</option>
                                            <option value="Y" id="yes">Yes</option>
                                            <option value="N" id="no">No</option>
                                        </select></span>
                                </div>                                      
                                <div class="col-md-3" class="form-group" >
                                    <label style=" float: left;">ShelfLife</label><span style=" display: block;overflow: hidden;padding: 0 4px 0 6px">
                                    <input type="text" name="shelf_life_period" id="shelf_life_period" class="form-control" placeholder="Shelf Life Peried"value="" onkeypress="return isNumber(event)"></span>        
                                </div>
                                <div class="col-md-3" class="form-group" >
                                    <label style=" float: left;">Shelf Life D/M</label>
                                   <span style=" display: block;overflow: hidden;padding: 0 4px 0 6px">
                                    <select name="shelf_life_dm" id="shelf_life_dm" class="form-control" >
                                        <option value="" id="yes" readonly>Select</option>
                                        <option value="D" id="yes">Days</option>
                                        <option value="M" id="no">Months</option>
                                    </select></span>
                                </div>
                            </div>
                            <div class="col-md-12" style="padding:5px;">
                                <div class="col-md-3" class="form-group" >
                                    <label style=" float: left;">Group 1</label>
                                    <span style=" display: block;overflow: hidden;padding: 0 4px 0 6px"><input type="text" name="group1" id="group1" class="form-control" placeholder="Group 1"value="" >   </span>
                                </div>
                                <div class="col-md-3" class="form-group" >
                                    <label style=" float: left;">Group 2</label>
                                    <span style=" display: block;overflow: hidden;padding: 0 4px 0 6px"><input type="text" name="group2" id="group2" class="form-control" placeholder="Group 2"value="" >   </span>
                                </div>
                                <div class="col-md-3" class="form-group" >
                                    <label style=" float: left;">Group 3</label>
                                    <span style=" display: block;overflow: hidden;padding: 0 4px 0 6px"><input type="text" name="group3" id="group3" class="form-control" placeholder="Group 3"value="" >   </span>
                                </div>
                                <div class="col-md-3" class="form-group" >
                                    <label style=" float: left;">Group 4</label>
                                    <span style=" display: block;overflow: hidden;padding: 0 4px 0 6px"><input type="text" name="group4" id="group4" class="form-control" placeholder="Group 4"value="" >   </span>
                                </div>
                            </div>
                            <div class="col-md-12" style="padding:5px;" align="center">
                                <input type="submit" name="btn_submit" id="btn_submit" value="Add" class="btn btn-success">
                                <input type="submit" name="btn_cancel_payment" id="btn_cancel_payment" value="Clear" class="btn btn-danger">
                                
                                <a href="{{route('item_master')}}" class="btn btn-primary">Exit</a>
                            </div>
                            </div>
                        </div>
                    <div class="col-md-1">
                    </div>
                
                    <div class="col-md-3  bg-primary  "  style="padding:5px;">
                        <div class="col-md-12 text-white" >
                            <table class="table table-rounded " width="100%" style="color:white;">
                                <tr>
                                    <th>No</th>
                                    <th>Barcode</th>
                                    <th>UserCode</th>
                                    <th>Trans-Date</th>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>AA</td>
                                    <td>Admin</td>
                                    <td>27/09/22</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>BB</td>
                                    <td>Admin</td>
                                    <td>27/09/22</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>CC</td>
                                    <td>Admin</td>
                                    <td>27/09/22</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>DD</td>
                                    <td>Admin</td>
                                    <td>27/09/22</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>EE</td>
                                    <td>Admin</td>
                                    <td>27/09/22</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td ><input type="text" name="txt_brcode" class="form-control" value="5"></td>
                                    <td colspan="3">Total Barcode/HotKey</td>
                                    
                                </tr>
                            </table>
                        
                        </div>
                        <div class="col-md-12 " >
                            <table class="table table-rounded " width="100%"  style="color:white;">
                                <tr>
                                    <th>Created On</th>
                                    <td><input type="text" name="txt_createdon" id="txt_createdon"class="form-control" value=""></td>
                                    
                                </tr>
                                <tr>
                                    <th>Created By</th>
                                    <td><input type="text" name="txt_createdby" id="txt_createdby" class="form-control" value=""></td>
                                    
                                </tr>
                                <tr>
                                    <th>Updated On</th>
                                    <td><input type="text" name="txt_updatedon" id="txt_updatedon" class="form-control" value=""></td>
                                    
                                </tr>
                                <tr>
                                    <th>Updated By</th>
                                    <td><input type="text" name="txt_updatedby" id="txt_updatedby"class="form-control" value=""></td>
                                    
                                </tr>
                                <tr>
                                    <th>Deactive Reason</th>
                                    <td><input type="text" name="txt_deactivereason" id="txt_deactivereason"class="form-control" value="5"></td>
                                    
                                </tr>
                                <tr>
                                    <th>Deactive Date</th>
                                    <td><input type="Date" name="txt_deactivedate" id="txt_deactivedate"class="form-control" value="5"></td>
                                    
                                </tr>
                            </table>
                        </div>
                    </div>
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