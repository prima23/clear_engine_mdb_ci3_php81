<section class="mb-5 pb-4 mt-4">
    <?php echo $this->session->flashdata('message'); ?>
    <div id="errSuccess"></div>
    <div class="row" id="formParent">
        <div class="col-xl-12 col-md-12 mb-xl-0 mb-4">
            <div class="card card-cascade narrower z-depth-1">
                <div class="view view-cascade gradient-card-header blue-gradient-rgba narrower py-1 mx-4 mb-3 d-flex justify-content-between align-items-center">
                    <h6 class="white-text font-weight-normal mt-2">
                        <i class="fas fa-table"></i>
                        List Data Module
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
                                    <th width="5%" class="font-weight-bold">#</th>
                                    <th width="13%" class="font-weight-bold">Label Module</th>
                                    <th width="12%" class="font-weight-bold">Nama Module</th>
                                    <th width="12%" class="font-weight-bold">URL Module</th>
                                    <th width="40%" class="font-weight-bold">Deskripsi</th>
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
    <div class="modal-dialog modal-lg" id="frmEntry">
        <div class="modal-content">
            <div class="modal-header aqua-gradient-rgba">
                <h4 class="modal-title heading lead white-text font-weight-bold"><i class="fas fa-edit"></i> Form Entri Data Module</h4>
                <button type="button" class="close btnClose" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>
            <?php echo form_open(site_url(isset($siteUri) ? $siteUri.'/create' : ''), array('id' => 'formEntry', 'class='=>'needs-validated', 'novalidate'=>'')); ?>
            <div class="modal-body">
                <div id="errEntry"></div>
                <?php echo form_hidden('tokenId', ''); ?>
                <div class="form-row mb-3">
                    <div class="col-12 col-md-4 required">
                        <label for="label_module" class="control-label font-weight-bolder">Label Module <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="label_module" id="label_module" placeholder="Label Module" value="<?php echo $this->input->post('label_module', TRUE); ?>" required>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-12 col-md-4 required">
                        <label for="nama_module" class="control-label font-weight-bolder">Nama Module <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama_module" id="nama_module" placeholder="Nama Module" value="<?php echo $this->input->post('nama_module', TRUE); ?>" required>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-12 col-md-4 required">
                        <label for="url_module" class="control-label font-weight-bolder">Url Module <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="url_module" id="url_module" placeholder="Url Module" value="<?php echo $this->input->post('url_module', TRUE); ?>" required>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="col-12 col-md-12">
                        <label for="deskripsi_module" class="control-label font-weight-bolder">Deskripsi Module</label>
                        <textarea class="form-control" name="deskripsi_module" id="deskripsi_module" rows="3" placeholder="Deskripsi Module"><?php echo $this->input->post('deskripsi_module', TRUE); ?></textarea>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="col-12 col-md-3 required">
                        <label for="status" class="control-label font-weight-bolder">Status <span class="text-danger">*</span></label>
                        <?php echo form_dropdown('status', status(), $this->input->post('status', TRUE), 'class="form-control select-data" id="status" style="width:100%" required=""');?>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="blockquote-footer">
                    <span><b>NB:</b> Nama module adalah nama modules yang digunakan</span>
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
    <div class="modal-dialog modal-dialog-scrollable modal-xl" id="frmRules">
        <div class="modal-content">
            <div class="modal-header aqua-gradient-rgba">
                <h4 class="modal-title heading lead white-text font-weight-bold"><i class="fas fa-cogs"></i> Form Rules Manajemen</h4>
                <button type="button" class="close btnClose" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-md-12 clearfix mb-3">
                        <div class="float-left">
                            <button class="btn btn-success waves-effect waves-light px-3 py-2 mx-0 font-weight-bold btnSetting" type="button"><i class="fas fa-plus-circle"></i> Setting Rules</button>
                        </div>
                        <div class="float-right" style="display: none;" id="eventRules">
                            <button class="btn btn-danger waves-effect waves-light px-3 py-2 mx-0 font-weight-bold" type="button" id="btnDeleteRules" disabled=""><i class="fas fa-trash-alt"></i> Delete Rules</button>
                            <button class="btn btn-info waves-effect waves-light px-3 py-2 mx-0 font-weight-bold" type="button" id="btnAktifRules" disabled=""><i class="fas fa-check"></i> Aktifkan Rules</button>
                            <button class="btn btn-orange waves-effect waves-light px-3 py-2 mx-0 font-weight-bold" type="button" id="btnNonaktifRules" disabled=""><i class="fas fa-times"></i> Non Aktifkan Rules</button>
                        </div>
                    </div>
                    <div class="col-12 col-md-12">
                        <div id="errRules"></div>
                    </div>
                    <div class="col-12 col-md-12 clearfix mb-3" id="formSettingRules" style="display: none;">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="heading font-weight-bolder mb-3"><i class="fas fa-pencil-alt"></i> Form Entry Rules <span class="lblMod"></span></h5>
                                <?php echo form_open(site_url(isset($siteUri) ? $siteUri.'/rules' : ''), array('id' => 'formRules', 'class='=>'needs-validated', 'novalidate'=>'')); ?>
                                <?php echo form_hidden('tokenRules', ''); ?>
                                <div class="form-row mb-3 ">
                                    <div class="col-12 col-md-5 required">
                                        <label for="nama_kontrol" class="control-label font-weight-bolder">Nama Kontrol <span class="text-danger">*</span></label>
                                        <?php echo form_dropdown('nama_kontrol', isset($data_kontrol) ? $data_kontrol : array(''=>'Pilih Data'), $this->input->post('nama_kontrol', TRUE), 'class="form-control select-all" id="nama_kontrol" required=""');?>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-12 col-md-5 required">
                                        <label for="nama_fungsi" class="control-label font-weight-bolder">Nama Fungsi <span class="text-danger">*</span></label>
                                        <?php echo form_multiselect('nama_fungsi[]', isset($data_fungsi) ? $data_fungsi : array(''=>'Pilih Data'), $this->input->post('nama_fungsi[]', TRUE), 'class="form-control select-all" data-placeholder="Pilih Data" required=""'); ?>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-12 col-md-2 required">
                                        <label for="status_rules" class="control-label font-weight-bolder">Status <span class="text-danger">*</span></label>
                                        <?php echo form_dropdown('status_rules', status(), $this->input->post('status_rules', TRUE), 'class="form-control select-data" id="status_rules" required=""');?>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 col-12">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light px-3 py-2 mx-0 font-weight-bold" id="saveRules"><i class="fas fa-check"></i> Submit</button>
                                        <button type="button" class="btn btn-danger waves-effect waves-light px-3 py-2 mx-0 font-weight-bold btnSetting"><i class="fas fa-times"></i> Cancel</button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive-md">
                    <h5 class="heading font-weight-bold"><i class="fas fa-list"></i> Daftar Rules <span class="lblMod"></span></h5>
                    <table cellspacing="0" class="table table-striped table-borderless table-hover table-sm" id="tblRules" width="100%">
                        <thead>
                            <tr>
                                <th width="2%" class="text-center">
                                    <div class="custom-control custom-checkbox ml-2">
                                        <input type="checkbox" class="custom-control-input" id="checkAll">
                                        <label class="custom-control-label" for="checkAll"></label>
                                    </div>
                                </th>
                                <th width="3%" class="font-weight-bold text-center">No.</th>
                                <th width="89%" class="font-weight-bold">Nama Fungsi</th>
                                <th width="6%" class="font-weight-bold text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-blue-grey waves-effect waves-light px-3 py-2 mx-0 font-weight-bold btnClose"><i class="fas fa-times"></i> Close</button>
            </div>
        </div>
    </div>
</div>