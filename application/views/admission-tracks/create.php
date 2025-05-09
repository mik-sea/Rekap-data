<div class="container-fluid">
<?php if ($this->session->flashdata('success')) { ?>
    <div class="alert alert-success">
        <?= $this->session->flashdata('success'); ?>
    </div>
<?php } else if ($this->session->flashdata('error')) { ?>
    <div class="alert alert-danger">
        <?= $this->session->flashdata('error'); ?>
    </div>
<?php } ?>

    <div class="card o-hidden border-0 shadow-lg mb-5">
        <div class="card-body p-0">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Tambah Data Jalur Masuk</h1>
                </div>
                <?= form_open('admission-track/store', ['class' => 'user']); ?>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Nama" value="<?= $input_name ?? ''; ?>">
                        <strong class="text-danger"><?= form_error('name'); ?></strong>
                    </div>
                    <button class="btn btn-primary btn-user btn-block">
                        Simpan
                    </button>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>
