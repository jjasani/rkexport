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
                  <div class="panel-ctrls panel-tbl"></div>
                </div>
                <div class="col-md-6 form-group" style="text-align: right;">
                    <?php if (strpos($submenuvisibility['submenuadd'],','.$this->session->userdata[base_url().'ADMINUSERTYPE'].',') !== false){ ?>
                        <a class="<?=addbtn_class;?>" href="<?=ADMIN_URL?>designation-mapping/add-designation-mapping" title=<?=addbtn_title?>><?=addbtn_text;?></a>
                    <?php } if(strpos($submenuvisibility['submenudelete'],','.$this->session->userdata[base_url().'ADMINUSERTYPE'].',') !== false){ ?>
                        <a class="<?=deletebtn_class;?> delete-btn-align" href="javascript:void(0)" onclick="checkmultipledelete('<?php echo ADMIN_URL; ?>designation-mapping/check-designation-mapping-use','Designation Mapping','<?php echo ADMIN_URL; ?>designation-mapping/delete-mul-designation-mapping')" title=<?=deletebtn_title?>><?=deletebtn_text;?></a>
                    <?php } ?>
                </div>
              </div>
              <div class="panel-body no-padding">
                <table id="designationmappingtable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th class="width8">Sr. No.</th>
                      <th>Default Designation</th> 
                      <th>Designation Group</th> 
                      <th class="width15">Actions</th>
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