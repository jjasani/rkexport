<div class="page-content">
    <div class="page-heading">     
        <?php $this->load->view(ADMINFOLDER.'includes/menu_header');?>
    </div>

    <div class="container-fluid">
                                    
      <div data-widget-group="group1">
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default border-panel">
              <div class="panel-heading">
                
                <div class="col-md-6">
                  <div class="panel-ctrls"></div>
                </div>
                <div class="col-md-6 form-group" style="text-align: right;">
                  <?php 
                    if (strpos($submenuvisibility['submenuadd'],','.$this->session->userdata[base_url().'ADMINUSERTYPE'].',') !== false){
                  ?>
                  <a class="<?=addbtn_class;?>" href="<?=ADMIN_URL?>channel-third-sub-menu/add-channel-third-sub-menu" title=<?=addbtn_title?>><?=addbtn_text;?></a>
                  <?php
                    }if(strpos($submenuvisibility['submenudelete'],','.$this->session->userdata[base_url().'ADMINUSERTYPE'].',') !== false){
                  ?>
                  <a class="<?=deletebtn_class;?>" href="javascript:void(0)" onclick="checkmultipledelete('','Channel Third Sub Menu','<?php echo ADMIN_URL; ?>channel-third-sub-menu/delete-mul-channel-third-sub-menu')" title=<?=deletebtn_title?>><?=deletebtn_text;?></a>
                  <?php } ?>
                </div>
              </div>
              <div class="panel-body no-padding">
                <table id="channelsubmenutable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th class="width8">Sr.No.</th>
                      <th>Main Menu</th>
                      <th>Sub Menu Name</th>
                      <th>Menu URL</th>
                      <th class="width8 text-right">Priority</th>
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
    </div> 
</div> <!-- #page-content -->
