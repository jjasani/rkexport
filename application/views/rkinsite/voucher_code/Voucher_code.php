<script>
 var FilterMemberId = '<?php if(isset($MemberId) && $MemberId!=''){ echo $MemberId; } ?>';
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
                      <div class="col-md-3">
                        <div class="form-group" id="channelid_div">
                          <div class="col-sm-12">
                            <label for="channelid" class="control-label">Select Channel</label>
                            <select id="channelid" name="channelid" class="selectpicker form-control" data-select-on-tab="true" data-size="5" title="All Channel" data-live-search="true" data-actions-box="true" multiple>
                              <?php foreach($channeldata as $cd){ 
                                  
                                  $selected = ""; 
                                  if(!empty($this->session->userdata(base_url().'CHANNEL'))){ 
                                    $arrChannel = explode(",",$this->session->userdata(base_url().'CHANNEL'));
                                    if(in_array($cd['id'], $arrChannel)){ 
                                      $selected = "selected"; 
                                    } 
                                  }else{
                                    if(isset($ChannelId) && $ChannelId!=""){
                                      $arrChannel = explode(",",$ChannelId);
                                      if(in_array($cd['id'], $arrChannel)){ 
                                        $selected = "selected"; 
                                      }
                                    }
                                  }
                                ?>
                              <option value="<?php echo $cd['id']; ?>" <?php echo $selected; ?>><?php echo $cd['name']; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group" id="memberid_div">
                          <div class="col-sm-12">
                            <label for="memberid" class="control-label">Select <?=Member_label?></label>
                            <select id="memberid" name="memberid" class="selectpicker form-control" data-select-on-tab="true" data-size="5" title="All <?=Member_label?>" data-live-search="true" data-actions-box="true" multiple>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group" style="margin-top: 39px;">
                          <div class="col-sm-12">
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
                    if (strpos($submenuvisibility['submenuadd'],','.$this->session->userdata[base_url().'ADMINUSERTYPE'].',') !== false){
                  ?>
                  <a class="<?=addbtn_class;?>" href="<?=ADMIN_URL; ?>voucher-code/voucher-code-add" title=<?=addbtn_title?>><?=addbtn_text;?></a>
                  <?php } ?>
                  <?php if(strpos($submenuvisibility['submenudelete'],','.$this->session->userdata[base_url().'ADMINUSERTYPE'].',') !== false){
                  ?>
                    <a class="<?=deletebtn_class;?>" href="javascript:void(0)" onclick="checkmultipledelete('<?php echo ADMIN_URL; ?>voucher-code/check-voucher-code-use','Voucher Code','<?php echo ADMIN_URL; ?>voucher-code/delete-mul-voucher-code')" title=<?=deletebtn_title?>><?=deletebtn_text;?></a>
                    <?php } ?>
                </div>
              </div>
              <div class="panel-body no-padding">
                <table id="vouchercodetable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <!-- <th class="width5">
                        <div class="checkbox">
                          <input id="deletecheckall" onchange="allchecked()" type="checkbox" value="all">
                          <label for="deletecheckall"></label>
                        </div>
                      </th>  -->                     
                      <th class="width5">Sr.No.</th>
                      <th>Channel</th>
                      <th><?=Member_label?> Name</th>
                      <th>Coupon Name</th>
                      <th>Coupon Code</th>
                      <th class="text-right">Discount</th>
                      <th class="text-right">Total Used</th>
                      <th>Start-End Date</th>
                      <th>Generated Date</th>
                      <th class="width12">Action</th>
                      <th class="width5">
                        <div class="checkbox">
                          <input id="deletecheckall" onchange="allchecked()" type="checkbox" value="all">
                          <label for="deletecheckall"></label>
                        </div>
                      </th>
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