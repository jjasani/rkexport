<script>
  var CURRENCY_CODE = '<?=CURRENCY_CODE?>';
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
								<div class="panel-heading filter-panel border-filter-heading">
									<h2><?=APPLY_FILTER?></h2>
									<div class="panel-ctrls" data-actions-container data-action-collapse="{&quot;target&quot;: &quot;.panelcollapse&quot;}" style="float:right;"><span class="button-icon has-bg"><span class="material-icons">keyboard_arrow_down</span></span></div>
								</div>
								<div class="panel-body panelcollapse pt-n" style="display: none;">
                  <form action="#" id="purchaseform" class="form-horizontal">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="col-md-3">
                          <div class="form-group">
                            <div class="col-md-12 pl-xs pr-xs">
                              <label for="datetype" class="control-label">Select Type</label>
                              <select id="datetype" name="datetype" class="selectpicker form-control" data-select-on-tab="true" data-size="5">
                                <option value="1">Day Wise</option>
                                <option value="2" selected>Month Wise</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <div class="col-md-12 pl-xs pr-xs">
                              <label class="control-label">Purchase Date</label>
                              <div class="input-daterange input-group" id="datepicker-range">
                                  <input type="text" class="input-small form-control" name="startdate" id="startdate" value="<?php echo $this->general_model->displaydate(date("y-m-d",strtotime("-3 month"))); ?>" placeholder="Start Date" title="Start Date" readonly/>
                                  <span class="input-group-addon">to</span>
                                  <input type="text" class="input-small form-control" name="enddate" id="enddate" value="<?php echo $this->general_model->displaydate($this->general_model->getCurrentDate()); ?>" placeholder="End Date" title="End Date" readonly/>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php /*
                        <div class="col-md-3">
                          <div class="form-group">
                            <div class="col-md-12 pl-xs pr-xs">
                              <label for="channelid" class="control-label">Sales By</label>
                              <select id="channelid" name="channelid" class="selectpicker form-control" data-select-on-tab="true" data-size="5" title="All Channel" data-live-search="true" >
                                <option value="">All Channel</option>
                                <option value="0">Company</option>
                                <?php foreach($channeldata as $cd){
                                    $selected = ""; 
                                    if(!empty($this->session->userdata(base_url().'CHANNEL'))){ 
                                      $arrChannel = explode(",",$this->session->userdata(base_url().'CHANNEL'));
                                      if(in_array($cd['id'], $arrChannel)){ 
                                        $selected = "selected"; 
                                      } 
                                    }
                                  ?>
                                <option value="<?php echo $cd['id']; ?>" <?php echo $selected; ?>><?php echo $cd['name']; ?></option>
                                <?php } ?>
                                
                              </select>
                            </div>
                          </div>
                        </div>    
                        */ ?>
                        <div class="col-md-3">
                          <div class="form-group">
                            <div class="col-md-12 pl-xs pr-xs">
                              <label for="memberid" class="control-label">Select Party</label>
                              <select id="memberid" name="memberid[]"  data-actions-box="true" class="selectpicker form-control" data-select-on-tab="true" data-size="5" data-live-search="true" title="All Party">
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <div class="col-md-12 pl-xs pr-xs">
                              <label for="status" class="control-label">Select Status</label>
                              <select id="status" name="status[]" multiple data-actions-box="true" title="All Status" class="selectpicker form-control" data-select-on-tab="true" data-size="5" data-live-search="true" >
                                <option value="0">Pending</option>
                                <option value="1">Complete</option>
                                <option value="2">Cancel</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                 
                      <div class="col-md-12">
                        
                        
                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="col-md-12 pl-xs pr-xs">
                              <label for="focusedinput" class="control-label mb-sm">Return</label>
                              <div class="col-md-12 p-n">
                                <div class="col-md-5 col-xs-5" style="padding-left: 0px;">
                                    <div class="radio">
                                    <input type="radio" name="purhcasetype" id="withreturn" value="1" checked><label for="withreturn">With Return</label>
                                    </div>
                                </div>
                                <div class="col-md-7 col-xs-7 pl-n">
                                    <div class="radio">
                                    <input type="radio" name="purhcasetype" id="withoutreturn" value="0">
                                    <label for="withoutreturn">Without Return</label>
                                    </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group mt-xl">
                            <div class="col-md-12 pl-xs pr-xs">
                              <label class="control-label"></label>
                              <a class="<?=applyfilterbtn_class;?>" href="javascript:void(0)" onclick="applyFilter()" title=<?=applyfilterbtn_title?>><?=applyfilterbtn_text;?></a>
                            </div>
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
                  <?php if (in_array("export-to-excel",$this->viewData['submenuvisibility']['assignadditionalrights'])){ ?>
                  <a class="<?=exportbtn_class;?>" href="javascript:void(0)" onclick="exportpurchasereport()" title="<?=exportbtn_title?>"><?=exportbtn_text;?></a>
                  <?php } if (in_array("export-to-pdf",$this->viewData['submenuvisibility']['assignadditionalrights'])){ ?>
                  <a class="<?=exportpdfbtn_class;?>" href="javascript:void(0)" onclick="exporttopdfpurchasereport()" title="<?=exportpdfbtn_title?>"><?=exportpdfbtn_text;?></a>
                  <?php } if (in_array("print",$this->viewData['submenuvisibility']['assignadditionalrights'])){ ?>
                  <a class="<?=printbtn_class;?>" href="javascript:void(0)" onclick="printpurchasereport()" title=<?=printbtn_title?>><?=printbtn_text?></a>
                  <?php } ?>
                </div>
              </div>
              <div class="panel-body no-padding panel-vertical-scroll">
                <table id="purchasereporttable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                   <thead>
                    <tr>            
                      <th class="width8">Sr. No.</th> 
                      <th>Party</th>
                      <th>Total Purchase</th>
                    </tr>
                  </thead>
                </table>
              </div>
              <div class="panel-footer"></div>
            </div>
          </div>
        </div>
      </div>

    </div> <!-- .container-fluid -->
</div> <!-- #page-content -->



