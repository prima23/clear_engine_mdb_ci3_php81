<section class="mb-5 pb-4 mt-4">
    <?php echo $this->session->flashdata('message'); ?>
    <div id="errSuccess"></div>
    <div class="row" id="formParent">
        <div class="col-xl-12 col-md-12 mb-xl-0 mb-4">
            <div class="card card-cascade narrower z-depth-1">
                <div class="view view-cascade gradient-card-header blue-gradient-rgba narrower py-1 mx-4 mb-3 d-flex justify-content-between align-items-center">
                    <h6 class="white-text font-weight-normal mt-2">
                        <i class="fas fa-table"></i>
                        List Data Group
                    </h6>
                    <div class="clearfix">
                        <a type="button" href="<?php echo site_url(isset($siteUri) ? $siteUri : '#'); ?>" class="btn btn-sm btn-white btn-rounded waves-effect waves-light px-3 py-2 font-weight-bold" name="button"><i class="fas fa-sync-alt"></i> Refresh Data</a>
                        <button type="button" class="btn btn-rounded btn-sm btn-success waves-effect waves-light px-3 py-2 font-weight-bold" id="btnAdd"><i class="fas fa-plus-circle"></i> Tambah Baru</button>
                    </div>
                </div>
                <div class="card-body mb-0">
                    <div class="table-responsive-md">
                        <table cellspacing="0" class="table table-striped table-borderless table-hover table-sm" id="tblList" width="100%">
                            <thead>
                                <tr>
                                    <th width="3%" class="font-weight-bold">#</th>
                                    <th width="15%" class="font-weight-bold">Nama Group</th>
                                    <th width="15%" class="font-weight-bold">Level Akses</th>
                                    <th width="49%" class="font-weight-bold">Hak Akses</th>
                                    <th width="7%" class="font-weight-bold">Status</th>
                                    <th width="11%" class="font-weight-bold">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="modalEntryForm" tabindex="-1" role="dialog" aria-labelledby="modalEntryLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" id="frmEntry">
        <div class="modal-content">
            <div class="modal-header aqua-gradient-rgba">
                <h4 class="modal-title heading lead white-text font-weight-bold"><i class="fas fa-edit"></i> Form Entri Data Group</h4>
                <button type="button" class="close btnClose" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>
            <?php echo form_open(site_url(isset($siteUri) ? $siteUri.'/create' : ''), array('id' => 'formEntry', 'class='=>'needs-validated', 'novalidate'=>'')); ?>
            <div class="modal-body">
                <div id="errEntry"></div>
                <?php echo form_hidden('tokenId', ''); ?>
                <div class="form-row  mb-3">
                    <div class="col-md-5 col-12 required">
                        <label for="nama_group" class="control-label font-weight-bolder">Nama Group <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama_group" id="nama_group" placeholder="Nama Group" value="<?php echo $this->input->post('nama_group', TRUE); ?>" required>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-4 col-12 required">
                        <label for="level_akses" class="control-label font-weight-bolder">Level Akses <span class="text-danger">*</span></label>
                        <?php echo form_dropdown('level_akses', isset($level_akses) ? $level_akses : array(''=>'Pilih Data'), $this->input->post('level_akses', TRUE), 'class="form-control select-all" style="width:100%" id="level_akses" required=""');?>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-3 col-12 required">
                        <label for="status" class="control-label font-weight-bolder">Status <span class="text-danger">*</span></label>
                        <?php echo form_dropdown('status', status(), $this->input->post('status', TRUE), 'class="form-control select-data" id="status" style="width:100%" required=""');?>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-blue-grey waves-effect waves-light px-3 py-2 font-weight-bold btnClose"><i class="fas fa-times"></i> Close</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light px-3 py-2 font-weight-bold" name="save" id="save"><i class="fas fa-check"></i> Submit</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<div class="modal fade" id="modalRulesForm" tabindex="-1" role="dialog" aria-labelledby="modalRulesLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" id="frmRules">
        <div class="modal-content">
            <div class="modal-header aqua-gradient-rgba">
                <h4 class="modal-title heading lead white-text font-weight-bold"><i class="fas fa-cogs"></i> Form Group Privilege Manajemen</h4>
                <button type="button" class="close btnClose" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-md-12 mb-0">
                        <div id="errRules"></div>
                        <div class="d-flex justify-content-between">
                            <div>Silahkan pilih privilege untuk Group <span class="font-weight-bold lblNameGroup"></span></div>
                            <div class="custom-control custom-checkbox mt-0 pt-0">
                                <input type="checkbox" class="custom-control-input" id="checkall">
                                <label class="custom-control-label font-weight-bolder" for="checkall">Check All Global Privileges</label>
                            </div>
                        </div>
                        <?php echo form_hidden('tokenGroup', ''); ?>
                    </div>
                    <div class="col-12 col-md-12" id="listRules"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-blue-grey waves-effect waves-light px-3 py-2 font-weight-bold btnClose"><i class="fas fa-times"></i> Close</button>
                <button type="button" class="btn btn-primary waves-effect waves-light px-3 py-2 font-weight-bold" id="btnSaveRules"><i class="fas fa-check"></i> Save Privilege</button>
            </div>
        </div>
    </div>
</div>