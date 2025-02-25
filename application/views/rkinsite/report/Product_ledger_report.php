<div class="page-content">
    <div class="page-heading">     
      <?php $this->load->view(ADMINFOLDER.'includes/menu_header');?>
    </div>

    <div class="container-fluid">
                                    
      <div data-widget-group="group1">
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default border-panel mb-md" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);z-index: 9;">
                <div class="panel-heading filter-panel border-filter-heading">
                    <h2><?=APPLY_FILTER?></h2>
                    <div class="panel-ctrls" data-actions-container data-action-collapse="{&quot;target&quot;: &quot;.panelcollapse&quot;}" style="float:right;"><span class="button-icon has-bg"><span class="material-icons">keyboard_arrow_down</span></span></div>
                </div>
                <div class="panel-body panelcollapse pt-n" style="display: none;">
                  <form action="#" id="memberform" class="form-horizontal">
                    <div class="row">
                      <div class="col-md-12 p-n">
                        <div class="col-md-3">
                          <div class="form-group">
                            <div class="col-md-12 pr-xs">
                              <label class="control-label">Transaction Date</label>
                              <div class="input-daterange input-group" id="datepicker-range">
                                  <input type="text" class="input-small form-control" name="startdate" id="startdate" value="<?php echo $this->general_model->displaydate(date("y-m-d",strtotime("-3 month"))); ?>" placeholder="Start Date" title="Start Date" readonly/>
                                  <span class="input-group-addon">to</span>
                                  <input type="text" class="input-small form-control" name="enddate" id="enddate" value="<?php echo $this->general_model->displaydate($this->general_model->getCurrentDate()); ?>" placeholder="End Date" title="End Date" readonly/>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group" id="productid_div">
                            <div class="col-md-12 pl-xs pr-xs">
                              <label for="status" class="control-label">Product</label>
                              <select id="productid" name="productid[]" class="selectpicker form-control" data-select-on-tab="true" data-size="8" data-live-search="true" data-actions-box="true" title="All Product" multiple>
                                <?php if(!empty($productdata)){
                                    foreach($productdata as $product){
                                      $productname = str_replace("'","&apos;",$product['name']);
                                      if(DROPDOWN_PRODUCT_LIST==0){ ?>

                                          <option value="<?=$product['id']?>"><?=$productname?></option>

                                      <?php }else{

                                          if($product['productimage']!="" && file_exists(PRODUCT_PATH.$product['productimage'])){
                                              $img = $product['productimage'];
                                          }else{
                                              $img = PRODUCTDEFAULTIMAGE;
                                          }
                                          ?>

                                          <option data-content="<?php if(!empty($product['productimage'])){?><img src='<?=PRODUCT.$img?>' style='width:40px'> <?php } echo $productname; ?> " value="<?php echo $product['id']; ?>"><?php echo $productname; ?></option>
                                      
                                      <?php } ?> 
                                        
                                    <?php }
                                }?>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group">
                            <div class="col-md-12 pl-xs pr-xs">
                              <label for="memberid" class="control-label"><?=Member_label?> / Vendor</label>
                              <select id="memberid" name="memberid[]" class="selectpicker form-control" data-select-on-tab="true" data-size="5" data-live-search="true" data-actions-box="true" title="All <?=Member_label?> / Vendor" multiple>
                                <?php if(!empty($memberdata)){
                                    foreach($memberdata as $member){ ?>
                                            <option value="<?=$member['id']?>"><?=$member['name']?></option>
                                <?php }
                                }?>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group">
                            <div class="col-md-12 pl-xs pr-xs">
                              <label for="type" class="control-label">Transaction Type</label>
                              <select id="type" name="type[]" class="selectpicker form-control" data-select-on-tab="true" data-size="5" data-live-search="true" data-actions-box="true" title="All Transaction Type" multiple>
                                <option value="1">Sales Order</option>
                                <option value="2">Sales Invoice</option>
                                <option value="3">Sales Return</option>
                                <option value="4">Purchase Order</option>
                                <option value="5">Purchase Invoice</option>
                                <option value="6">Purchase Return</option>
                                <?php if(MANUFACTURING_PROCESS==1){ ?>
                                <option value="7">Out Process</option>
                                <option value="8">IN Process</option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group pt-xl">
                            <div class="col-md-12">
                              <label class="control-label"></label>
                              <a class="<?=applyfilterbtn_class;?>" href="javascript:void(0)" onclick="applyFilter()" title=<?=applyfilterbtn_title?>><?=applyfilterbtn_text;?></a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 p-n">
                       
                      </div>
                    </div> 
                  </form>
                </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="panel panel-default border-panel">
              <div class="panel-heading">
                <div class="col-md-6">
                  <div class="panel-ctrls panel-tbl"></div>
                </div>
                <div class="col-md-6 form-group" style="text-align: right;">
                  <?php if (in_array("export-to-excel",$this->viewData['submenuvisibility']['assignadditionalrights'])){ ?>
                  <a class="<?=exportbtn_class;?>" href="javascript:void(0)" onclick="exporttoexcelproductledgerreport()" title="<?=exportbtn_title?>"><?=exportbtn_text;?></a>
                  <?php } if (in_array("export-to-pdf",$this->viewData['submenuvisibility']['assignadditionalrights'])){ ?>
                  <a class="<?=exportpdfbtn_class;?>" href="javascript:void(0)" onclick="exporttopdfproductledgerreport()" title="<?=exportpdfbtn_title?>"><?=exportpdfbtn_text;?></a>
                  <?php } if (in_array("print",$this->viewData['submenuvisibility']['assignadditionalrights'])){ ?>
                  <a class="<?=printbtn_class;?>" href="javascript:void(0)" onclick="printproductledgerreport()" title=<?=printbtn_title?>><?=printbtn_text?></a>
                  <?php } ?>
                </div>
              </div>
              <div class="panel-body no-padding">
                <table id="productledgertable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>            
                      <th>Sr. No.</th>
                      <th>Transaction Date</th>
                      <th>Transaction No.</th>
                      <th><?=Member_label?> / Vendor</th>
                      <th>Product Name</th>
                      <th class="text-right">In Qty</th>
                      <th class="text-right">Out Qty</th>
                      <th>Transaction Type</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
              <div class="panel-footer"></div>
            </div>
          </div>
        </div>
      </div>

    </div> <!-- .container-fluid -->
</div> <!-- #page-content -->


