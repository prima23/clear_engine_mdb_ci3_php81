<section class="mb-5 pb-4 mt-4">
    <?php echo $this->session->flashdata('message'); ?>
    <div id="errSuccess"></div>
    <div class="row" id="formParent">
        <div class="col-xl-12 col-md-12 mb-xl-0 mb-4">
            <div class="card card-cascade narrower z-depth-1">
                <div class="view view-cascade gradient-card-header blue-gradient-rgba narrower py-1 mx-4 mb-3 d-flex justify-content-between align-items-center">
                    <h6 class="white-text font-weight-normal mt-2">
                        <i class="fas fa-table"></i>
                        List Data Kontrol
                    </h6>
                    <div class="clearfix">
                        <a type="button" href="<?php echo site_url(isset($siteUri) ? $siteUri : '#'); ?>" class="btn btn-sm btn-white btn-rounded waves-effect waves-light px-3 py-2 font-weight-bold" name="button"><i class="fas fa-sync-alt"></i> Refresh Data</a>
                        <button type="button" class="btn btn-sm btn-rounded btn-success waves-effect waves-light px-3 py-2 font-weight-bold" id="btnAdd"><i class="fas fa-plus-circle"></i> Tambah Baru</button>
                    </div>
                </div>
                <div class="card-body mb-0">
                    <div class="table-responsive-md">
                        <table cellspacing="0" class="table table-striped table-borderless table-hover table-sm" id="tblList" width="100%">
                            <thead>
                                <tr>
                                    <th width="5%" class="font-weight-bold">#</th>
                                    <th width="15%" class="font-weight-bold">Label Kontrol</th>
                                    <th width="13%" class="font-weight-bold">Nama Kontrol</th>
                                    <th width="13%" class="font-weight-bold">URL Kontrol</th>
                                    <th width="39%" class="font-weight-bold">Deskripsi</th>
                                    <th width="7%" class="font-weight-bold">Status</th>
                                    <th width="7%" class="font-weight-bold">Action</th>
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
                <h4 class="modal-title heading lead white-text font-weight-bold"><i class="fas fa-edit"></i> Form Entri Data Kontrol</h4>
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
                        <label for="label_kontrol" class="control-label font-weight-bolder">Label Kontrol <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="label_kontrol" id="label_kontrol" placeholder="Label Kontrol" value="<?php echo $this->input->post('label_kontrol', TRUE); ?>" required>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-12 col-md-4 required">
                        <label for="nama_kontrol" class="control-label font-weight-bolder">Nama Kontrol <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama_kontrol" id="nama_kontrol" placeholder="Nama Kontrol" value="<?php echo $this->input->post('nama_kontrol', TRUE); ?>" required>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-12 col-md-4 required">
                        <label for="url_kontrol" class="control-label font-weight-bolder">Url Kontrol <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="url_kontrol" id="url_kontrol" placeholder="Url Kontrol" value="<?php echo $this->input->post('url_kontrol', TRUE); ?>" required>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="col-12 col-md-12">
                        <label for="deskripsi_kontrol" class="control-label font-weight-bolder">Deskripsi Kontrol</label>
                        <textarea class="form-control" name="deskripsi_kontrol" id="deskripsi_kontrol" rows="3" placeholder="Deskripsi Kontrol"><?php echo $this->input->post('deskripsi_kontrol', TRUE); ?></textarea>
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
                    <span><b>NB:</b> Nama kontrol adalah nama class/controller yang digunakan di dalam modules</span>
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