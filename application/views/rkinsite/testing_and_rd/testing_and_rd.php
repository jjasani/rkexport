<div class="page-content">
    <div class="page-heading">
        <?php $this->load->view(ADMINFOLDER . 'includes/menu_header'); ?>
    </div>

    <div class="container-fluid">

        <div data-widget-group="group1">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default border-panel mb-md" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);z-index: 9;">
                        <div class="panel-heading filter-panel border-filter-heading">
                            <h2><?= APPLY_FILTER ?></h2>
                            <div class="panel-ctrls" data-actions-container data-action-collapse="{&quot;target&quot;: &quot;.panelcollapse&quot;}" style="float:right;"><span class="button-icon has-bg"><span class="material-icons">keyboard_arrow_down</span></span></div>
                        </div>
                        <div class="panel-body panelcollapse pt-n" style="display: none;">
                            <form action="#" id="categoryform" class="form-horizontal">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="col-sm-12 pl-sm pr-sm">
                                                <label for="processid" class="control-label">Process</label>
                                                <select id="processid" name="processid" class="selectpicker form-control" data-live-search="true" data-select-on-tab="true" data-size="5" data-actions-box="true">
                                                    <option value="0">Select Process</option>
                                                    <?php foreach ($processdata as $pd) { ?>
                                                        <option value="<?php echo $pd['id']; ?>"><?php echo $pd['name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="col-sm-12 pl-sm pr-sm">
                                                <label for="batchid" class="control-label">Batch</label>
                                                <select id="batchid" name="batchid" class="selectpicker form-control" data-live-search="true" data-select-on-tab="true" data-size="5" data-actions-box="true">
                                                    <option value="0">Select Batch</option>
                                                    <?php foreach ($batchnodata as $bd) { ?>
                                                        <option value="<?php echo $bd['id']; ?>"><?php echo $bd['batchno']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="col-md-12 pl-sm pr-sm">
                                                <label for="testedid" class="control-label">Tested By</label>
                                                <select id="testedid" name="testedid" class="selectpicker form-control" data-select-on-tab="true" data-size="5" data-live-search="true">
                                                    <option value="0">Select Tested by</option>
                                                    <?php foreach ($userdata as $ud) { ?>
                                                        <option value="<?php echo $ud['id']; ?>"><?php echo $ud['name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="col-md-12 pl-sm pr-sm">
                                                <label for="statusid" class="control-label">Status</label>
                                                <select id="statusid" name="statusid" class="selectpicker form-control" data-select-on-tab="true" data-size="5" data-live-search="true">
                                                    <option value="-1">Select Status</option>
                                                    <option value="0">Pending</option>
                                                    <option value="1">Partially</option>
                                                    <option value="2">Complete</option>
                                                    <option value="3">Cancel</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-sm-12 pl-sm pr-sm">
                                                <label for="startdate" class="control-label">Test Date</label>
                                                <div class="input-daterange input-group" id="datepicker-range">
                                                    <div class="input-group">
                                                        <input type="text" style="text-align: left;" class="input-small form-control text-left" name="startdate" id="startdate" value="<?php echo $this->general_model->displaydate(date("y-m-d", strtotime("-1 month"))); ?>" placeholder="Start Date" title="Start Date" readonly />
                                                        <span class="btn btn-default datepicker_calendar_button" title='Date'><i class="fa fa-calendar fa-lg"></i></span>
                                                    </div>
                                                    <span class="input-group-addon">to</span>
                                                    <div class="input-group">
                                                        <input type="text" style="text-align: left;" class="input-small form-control text-left" name="enddate" id="enddate" value="<?php echo $this->general_model->displaydate($this->general_model->getCurrentDate()); ?>" placeholder="End Date" title="End Date" readonly />
                                                        <span class="btn btn-default datepicker_calendar_button" title='Date'><i class="fa fa-calendar fa-lg"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 p-n">
                                        <div class="form-group" style="margin-top: 39px;">
                                            <div class="col-sm-12">
                                                <label class="control-label"></label>
                                                <a class="<?= applyfilterbtn_class; ?>" href="javascript:void(0)" onclick="applyFilter()" title=<?= applyfilterbtn_title ?>><?= applyfilterbtn_text; ?></a>
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
                        <div class="panel-heading pr-xs">
                            <div class="col-md-4 p-n">
                                <div class="panel-ctrls panel-tbl"></div>
                            </div>
                            <div class="col-md-8 p-n" style="text-align: right;">
                                <?php
                                if (strpos($submenuvisibility['submenuadd'], ',' . $this->session->userdata[base_url() . 'ADMINUSERTYPE'] . ',') !== false) { ?>
                                    <a class="<?= addbtn_class; ?>" href="<?= ADMIN_URL ?>testing-and-rd/add-testing-and-rd" title=<?= addbtn_title ?>><?= addbtn_text; ?></a>
                                <?php
                                } ?>
                                <?php
                                if (strpos($submenuvisibility['submenudelete'], ',' . $this->session->userdata[base_url() . 'ADMINUSERTYPE'] . ',') !== false) {
                                ?>
                                    <a class="<?= deletebtn_class; ?> delete-btn-align" href="javascript:void(0)" onclick="checkmultipledelete('<?php echo ADMIN_URL; ?>testing-and-rd/check-testing-and-rd-use','Testing And R&D','<?php echo ADMIN_URL; ?>testing-and-rd/delete-mul-testing')" title=<?= deletebtn_title ?>><?= deletebtn_text; ?></a>
                                <?php } ?>
                                <!-- <a class="<?= qrcode_class ?>" href="<?= ADMIN_URL ?>product/qr-code" title="<?= qrcode_title ?>"><?= qrcode_text ?></a> -->
                                <?php if (in_array("import-to-excel", $this->viewData['submenuvisibility']['assignadditionalrights'])) { ?>
                                    <a class="<?= importbtn_class; ?>" href="javascript:void(0)" onclick="importproduct()" title="<?= importbtn_title ?>"><?= importbtn_text; ?></a>
                                    <a class="<?= assignproductbtn_class; ?>" href="javascript:void(0)" onclick="assignproduct()" title="<?= assignproductbtn_title ?>"><?= assignproductbtn_text; ?></a>
                                <?php }
                                if (in_array("upload-image", $this->viewData['submenuvisibility']['assignadditionalrights'])) { ?>
                                    <a class="<?= uploadproductimagebtn_class; ?>" href="javascript:void(0)" onclick="uploadproductfile()" title="<?= uploadproductimagebtn_title ?>"><?= uploadproductimagebtn_text; ?></a>
                                <?php }
                                if (in_array("export-to-excel", $this->viewData['submenuvisibility']['assignadditionalrights'])) { ?>
                                    <a class="<?= exportbtn_class; ?>" href="javascript:void(0)" onclick="exportadminproduct()" title="<?= exportbtn_title ?>"><?= exportbtn_text; ?></a>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="panel-body no-padding">
                            <table id="testingtable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="width8">Sr. No.</th>
                                        <th>Process Name</th>
                                        <th class="width15">Product Name</th>
                                        <th class="width10">Batch No.</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Tested By</th>
                                        <th>Created Date</th>
                                        <!-- <th class="width8 text-right">Discount (%)</th> -->
                                        <!-- <th class="width8 text-right">Priority</th> -->
                                        <th class="width8">Actions</th>
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