<div class="container-fluid">
<?php if ($this->session->flashdata('success')) { ?>
    <div class="alert alert-success">
        <?php echo $this->session->flashdata('success'); ?>
    </div>
<?php } else if ($this->session->flashdata('error')) { ?>
    <div class="alert alert-danger">
        <?php echo $this->session->flashdata('error'); ?>
    </div>
<?php } ?>

    <div class="card o-hidden border-0 shadow-lg mb-5">
        <div class="card-body p-0">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Sunting Data Jurusan</h1>
                </div>
                <?php echo form_open('major/update', ['class' => 'user']); ?>
                    <div class="form-group">
                        <input type="hidden" name="id" value="<?php echo $input_id ?? ''; ?>">
                    </div>
                    <div class="form-group">
                        <select class="form-control form-select" id="faculty_id" name="faculty_id">
                            <option value=""<?= isset($input_faculty_id) ? '' : ' selected' ?>>-- Select Faculty --</option>
                        <?php foreach ($faculties as $faculty): ?>
                            <option value="<?= $faculty->id ?>"<?= isset($input_faculty_id) && $input_faculty_id == $faculty->id ? ' selected':'' ?>><?= $faculty->name ?></option>
                        <?php endforeach; ?>
                        </select>
                        <strong class="text-danger"><?php echo form_error('faculty_id'); ?></strong>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="code" name="code" placeholder="Kode" value="<?php echo $input_code ?? ''; ?>">
                        <strong class="text-danger"><?php echo form_error('code'); ?></strong>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Name" value="<?php echo $input_name ?? ''; ?>">
                        <strong class="text-danger"><?php echo form_error('name'); ?></strong>
                    </div>
                    <button class="btn btn-primary btn-user btn-block">
                        Simpan
                    </button>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
