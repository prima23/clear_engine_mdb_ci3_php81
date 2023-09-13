<section class="mb-5 pb-4 mt-4">
    <?php echo $this->session->flashdata('message'); ?>
    <div id="errSuccess"></div>
    <div class="row" id="formParent">
        <div class="col-xl-12 col-md-12 mb-xl-0 mb-4">
            <div class="card card-cascade narrower z-depth-1">
                <div class="view view-cascade gradient-card-header blue-gradient-rgba narrower py-1 mx-4 mb-3 d-flex justify-content-between align-items-center">
                    <h6 class="white-text font-weight-normal mt-2">
                        <i class="fas fa-table"></i>
                        List Data Menu
                    </h6>
                    <div class="clearfix">
                        <a type="button" href="<?php echo site_url(isset($siteUri) ? $siteUri : '#'); ?>" class="btn btn-sm btn-white btn-rounded waves-effect waves-light px-3 py-2 font-weight-bold" name="button"><i class="fas fa-sync-alt"></i> Refresh Data</a>
                        <button type="button" class="btn btn-rounded btn-sm btn-success waves-effect waves-light px-3 py-2 font-weight-bold btnAdd" data-id="0"><i class="fas fa-plus-circle"></i> Tambah Baru</button>
                    </div>
                </div>
                <div class="card-body mb-0">
                    <div class="table-responsive-md">
                        <table cellspacing="0" class="table table-striped table-borderless table-hover table-sm" id="tblList" width="100%">
                            <thead>
                                <tr>
                                    <th width="72%" class="font-weight-bold">Title Menu</th>
                                    <th width="6%" class="font-weight-bold text-center">Sort</th>
                                    <th width="11%" class="font-weight-bold text-center">Status</th>
                                    <th width="11%" class="font-weight-bold text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
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
                <h4 class="modal-title heading lead white-text font-weight-bold"><i class="fas fa-edit"></i> Form Entri Data Menu</h4>
                <button type="button" class="close btnClose" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>
            <?php echo form_open(site_url(isset($siteUri) ? $siteUri.'/create' : ''), array('id' => 'formEntry', 'class='=>'needs-validated', 'novalidate'=>'')); ?>
            <div class="modal-body">
                <div id="errEntry"></div>
                <?php echo form_hidden('tokenId', ''); ?>
                <div class="form-row mb-3">
                    <div class="col-12 col-md-6 required">
                        <label for="nama_menu" class="control-label font-weight-bolder">Nama Menu <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama_menu" id="nama_menu" placeholder="Nama Menu" value="<?php echo $this->input->post('nama_menu', TRUE); ?>" required>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-12 col-md-6 required">
                        <label for="parent_id" class="control-label font-weight-bolder">Parent Menu <span class="text-danger">*</span></label>
                        <?php echo form_dropdown('parent_id', isset($parent) ? $parent : array(''=>'Pilih Data'), $this->input->post('parent_id', TRUE), 'class="form-control select-all" id="parent_id" style="width:100%" required=""');?>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="col-12 col-md-12 mb-2">
                        <div class="row">
                            <label for="type_menu" class="control-label col-2 font-weight-bolder">Type Menu <span class="text-danger">*</span></label>
                            <div class="col-3">
                                <div class="custom-control custom-radio required">
                                    <input type="radio" class="custom-control-input" name="is_parent" id="type_1" value="Y" <?php echo set_radio('is_parent', 'Y'); ?> required>
                                    <label class="custom-control-label" for="type_1">Root Menu</label>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="custom-control custom-radio required">
                                    <input type="radio" class="custom-control-input" name="is_parent" id="type_2" value="N" <?php echo set_radio('is_parent', 'N'); ?> required>
                                    <label class="custom-control-label" for="type_2">Sub Menu</label>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="col-12 col-md-12">
                        <label for="id_rules" class="control-label font-weight-bolder">Module <span class="text-danger">*</span></label>
                        <div class="row">
                            <div class="col-12 col-md-10 required">
                                <input type="hidden"  class="form-control" name="id_rules" id="id_rules" value="<?php echo $this->input->post('id_rules', TRUE); ?>">
                                <input type="text" class="form-control" name="nama_rules" id="nama_rules" placeholder="Pilih Module" value="<?php echo $this->input->post('nama_rules', TRUE); ?>" required disabled>
                                <span><code> Module tidak perlu diisi jika Type Menu yang dipilih bukan Sub Menu</code></span>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-12 col-md-2" style="margin-top: -5px;">
                                <button type="button" class="btn btn-outline-cyan waves-effect waves-light px-2 py-2" data-toggle="modal" data-target="#modalModuleList"> Pilih Data</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="col-12 col-md-3 required">
                        <label for="url_menu" class="control-label font-weight-bolder">URL Menu</label>
                        <input type="text" class="form-control" name="url_menu" id="url_menu" placeholder="URL Menu" value="<?php echo $this->input->post('url_menu', TRUE); ?>" readonly="">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-12 col-md-3 required">
                        <label for="order_menu" class="control-label font-weight-bolder">Order Menu <span class="text-danger">*</span></label>
                        <input type="number" class="form-control nominal" name="order_menu" id="order_menu" placeholder="Order Menu" min="1" value="<?php echo $this->input->post('order_menu', TRUE); ?>" required>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-12 col-md-3 required">
                        <label for="icon_menu" class="control-label font-weight-bolder">Icon Menu</label>
                        <input type="text" class="form-control" name="icon_menu" id="icon_menu" placeholder="Icon Menu" value="<?php echo $this->input->post('icon_menu', TRUE); ?>">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-12 col-md-3 required">
                        <label for="status" class="control-label font-weight-bolder">Status <span class="text-danger">*</span></label>
                        <?php echo form_dropdown('status', status(), $this->input->post('status', TRUE), 'class="form-control select-data" id="status" style="width:100%" required=""');?>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="blockquote-footer">
                    <span><b>NB:</b> Jika menu bertipe sub menu maka icon manu tidak usah diisi</span>
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
<div class="modal fade" id="modalModuleList" tabindex="-1" role="dialog" aria-labelledby="modalModuleListLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header aqua-gradient-rgba">
                <h4 class="modal-title heading lead white-text font-weight-bold"><i class="fas fa-list-alt"></i> Data Rules Module</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered table-hover table-sm" cellspacing="0" id="tblRules" width="100%">
                    <thead>
                        <tr>
                            <th width="5%" class="font-weight-bold text-center">#</th>
                            <th class="font-weight-bold">Module</th>
                            <th class="font-weight-bold">Kontrol</th>
                            <th class="font-weight-bold">Fungsi</th>
                            <th width="7%" class="font-weight-bold text-center">Act</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i=1; foreach ((isset($rules) ? $rules : array()) as $key => $r): ?>
                        <tr>
                            <td width="5%" class="text-center"><?php echo $i; ?>.</td>
                            <td><?php echo $r['label_module'];?></td>
                            <td><?php echo $r['label_kontrol'];?></td>
                            <td><?php echo $r['label_fungsi'];?></td>
                            <td width="7%" class="text-center">
                                <button class="btn btn-primary btn-sm px-2 py-1 my-0 mx-0 waves-effect waves-light setModule" data-id="<?php echo $this->encryption->encrypt($r['id_rules']); ?>" data-nm="<?php echo $r['url_module'].'/'.$r['url_kontrol'].'/'.$r['url_fungsi']; ?>"> Set </button>
                            </td>
                        </tr>
                        <?php $i++; endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-blue-grey waves-effect waves-light px-3 py-2 mx-0 font-weight-bold" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i> Close</button>
            </div>
        </div>
    </div>
</div>