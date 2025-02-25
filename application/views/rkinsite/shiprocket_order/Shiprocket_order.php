<script>
 var panelcollapsed = '<?php if(isset($panelcollapsed)){ echo $panelcollapsed; } ?>';
</script>
<div class="page-content">
    <div class="page-heading">     
      <?php $this->load->view(ADMINFOLDER.'includes/menu_header');?>
    </div>

    <div class="container-fluid">
                                    
      <div data-widget-group="group1">
        <div class="row">
        <div class="col-md-12">
             <div class="panel panel-default border-panel mb-md" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);z-index: 9;">
								<div class="panel-heading filter-panel border-filter-heading" display-type="<?php if(isset($panelcollapsed) && $panelcollapsed==1){ echo "0"; } else{ echo "1";}?>">
									<h2><?=APPLY_FILTER?></h2>
									<div class="panel-ctrls" data-actions-container data-action-collapse="{&quot;target&quot;: &quot;.panelcollapse&quot;}" style="float:right;"><span class="button-icon has-bg"><span class="material-icons">keyboard_arrow_down</span></span></div>
								</div>
								<div class="panel-body panelcollapse pt-n" style="display: none;">
                  <form action="#" id="memberform" class="form-horizontal">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <div class="col-sm-12 pr-sm">
                            <label for="startdate" class="control-label">Order Date</label>
                            <div class="input-daterange input-group" id="datepicker-range">
                              <input type="text" class="input-small form-control" name="startdate" id="startdate" value="<?php if(isset($startdate) && $startdate!=''){ echo $this->general_model->displaydate($startdate); }else{ echo $this->general_model->displaydate(date("y-m-d",strtotime("-1 month"))); } ?>" placeholder="Start Date" title="Start Date" readonly/>
                              <span class="input-group-addon">to</span>
                              <input type="text" class="input-small form-control" name="enddate" id="enddate" value="<?php if(isset($enddate) && $enddate!=''){ echo $this->general_model->displaydate($enddate); }else{ echo $this->general_model->displaydate($this->general_model->getCurrentDate()); } ?>" placeholder="End Date" title="End Date" readonly/>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <div class="col-sm-12 pl-sm pr-sm">
                            <label for="status" class="control-label">Select Status</label>
                            <select id="status" name="status" class="selectpicker form-control" data-select-on-tab="true" data-size="5">
                              <option value="-1">All Status</option>
                              <option value="0" >Pending</option>
                              <option value="1" >Cancel</option>
                              <option value="2" >Shipping</option>
                              
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group mt-xl">
                          <div class="col-sm-12 pl-sm">
                            <label class="control-label"></label>
                            <a class="<?=applyfilterbtn_class;?>" href="javascript:void(0)" onclick="applyFilter()" title=<?=applyfilterbtn_title?>><?=applyfilterbtn_text;?></a>
                          </div>
                        </div>
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
                  <?php 
                    if (strpos($submenuvisibility['submenuadd'],','.$this->session->userdata[base_url().'ADMINUSERTYPE'].',') !== false){ ?>
                      <a class="<?=addbtn_class;?>" href="<?=ADMIN_URL?>shiprocket-order/order-add" title=<?=addbtn_title?>><?=addbtn_text;?></a>
                  <?php
                    } ?>
                </div>
              </div>
              <div class="panel-body no-padding">
                <table id="shiprocketordertable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>            
                      <th class="width5">Sr. No.</th>
                      <th class="width12">Order Date</th>
                      <th class="width5">OrderID</th>
                      <th class="width5">ShipmentID</th>
                      <th class="text-right width5">Invoice Amount (<?=CURRENCY_CODE?>)</th>
                      <th class="width12">Customer Details</th>  
                      <th class="width12">Shipping Details</th>
                      <th class="width12">Dimension & Weight</th>
                      <th class="width5">Status</th>
                      <th class="width12">Actions</th>
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
      <!-- Modal -->
      <div class="modal fade" id="rejectorderModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="z-index: 1250000;">
        <div class="modal-dialog" role="document" style="width: 460px;">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="col-sm-9 p-n">Reason for Rejection Order</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="pagetitle"></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" id="resonforrejectionform" name="resonforrejectionform">
                <input type="hidden" id="rejectionorderid" name="rejectionorderid">
                <input type="hidden" id="rejectionstatus" name="rejectionstatus">
                <div id="row">
                  <div id="col-md-9">
                    <div class="form-group" id="resonforrejection_div">
                      <div class="col-sm-12">
                          <label for="resonforrejection" class="control-label">Reason for Rejection <span class="mandatoryfield">*</span></label>
                          <textarea id="resonforrejection" name="resonforrejection" class="form-control"></textarea>
                          <p style="color: red;" id="resonalert"></p>
                      </div>
                    </div>
                  </div>
                  <div id="col-md-12">
                    <div class="form-group text-right">
                      <div class="col-sm-12">
                          <input type="button" id="submit" onclick="checkvalidationforrejectionorder()" name="submit" value="SUBMIT" class="btn btn-primary btn-raised">

                          <a class="<?=cancellink_class;?>" href="<?=ADMIN_URL?>order" title=<?=cancellink_title?>><?=cancellink_text?></a>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer"></div>
          </div>
        </div>
      </div>
    </div> <!-- .container-fluid -->
</div> <!-- #page-content -->


