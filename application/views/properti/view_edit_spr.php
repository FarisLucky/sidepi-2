<div class="content-wrapper" id="spr_property">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="dark txt_title d-inline-block mt-2">SPR Properti</h4>
                                <img id="logo_perusahaan" width="50px" src="<?= base_url().'assets/uploads/images/properti/'.$img->logo_perusahaan ?>" class="float-right" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <h5 class="d-inline-block">SPR Properti</h5>
                                <a href="<?= base_url() ?>properti" class="btn btn-dark mr-2 float-right"><i class="fa fa-arrow-circle-left"></i>Kembali</a>
                            </div>
                        </div>
                        <hr>
                        <form id="form_detail" action="<?= base_url() ?>properti/corespr" method="post">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">Setting SPR</label>
                                    <textarea name="txt_edit_spr" id="txt_edit_spr" rows="10"></textarea>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-info mr-2 float-right">Ubah</button>
                            </div>  
                        </div>
                        </form>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>