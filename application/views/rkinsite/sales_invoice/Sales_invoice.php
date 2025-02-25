
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
                      <form action="#" class="form-horizontal">
                          <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                  <div class="col-sm-12 pr-sm">
                                      <label for="salespersonid" class="control-label">Salesman</label>
                                      <select id="salespersonid" name="salespersonid" class="selectpicker form-control" data-select-on-tab="true" data-size="5" data-live-search="true">
                                          <option value="0">All Salesman</option>
                                          <?php foreach ($employeedata as $employee) { ?>
                                              <option value="<?=$employee['id']?>"><?=ucwords($employee['name'])?></option>
                                          <?php } ?> 
                                      </select>
                                  </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                  <div class="col-sm-12 pr-sm pl-sm">
                                        <label for="fromdate" class="control-label">Order Date</label>
                                        <div class="input-daterange input-group" id="datepicker-range">
                                            <input type="text" class="input-small form-control" name="fromdate" id="fromdate" value="<?php echo $this->general_model->displaydate(date("y-m-d",strtotime("-1 month"))); ?>" placeholder="Start Date" title="Start Date" readonly/>
                                            <span class="input-group-addon">to</span>
                                            <input type="text" class="input-small form-control" name="todate" id="todate" value="<?php echo $this->general_model->displaydate($this->general_model->getCurrentDate()); ?>" placeholder="End Date" title="End Date" readonly/>
                                        </div>
                                  </div>
                                </div>
                            </div>
                            
                            <div class="col-md-2">
                                <div class="form-group">
                                  <div class="col-sm-12 pr-sm pl-sm">
                                      <label for="status" class="control-label">Status</label>
                                      <select id="status" name="status" class="selectpicker form-control" data-select-on-tab="true" data-size="5" data-live-search="true">
                                        <option value="-1">All Status</option> 
                                        <option value="0">Pending</option>
                                        <option value="3">Partially</option>
                                        <option value="1">Complete</option>
                                        <option value="2">Cancel</option>
                                      </select>
                                  </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group mt-xl">
                                  <div class="col-sm-12 pr-sm">
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
                <a class="<?=addbtn_class;?>" href="<?=ADMIN_URL?>Sales-Invoice/add-sales-invoice" title=<?=addbtn_title?>><?=addbtn_text;?></a>
                </div>
              </div>
              <div class="panel-body no-padding">
                <table id="salespersonordertable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>            
                      <th>Sr. No.</th>
                      <th>Party Name</th>
                      <th>Inquiry ID</th>
                      <th>PO No</th>
                      <th>Amount</th>
                      <th>Added By</th>
                      <th>Status</th>
                      <th>Action </th>
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

<div class="modal fade" id="reasonModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
          <h4 class="modal-title">Reason</h4>
      </div>
      <div class="modal-body" style="overflow-y: auto;max-height: 430px;">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>    