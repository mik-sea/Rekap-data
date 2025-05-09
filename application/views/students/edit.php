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
                    <h1 class="h4 text-gray-900 mb-4">Sunting Data Mahasiswa</h1>
                </div>
                <?= form_open_multipart('student/update', ['class' => 'user']); ?>
                    <div class="form-group">
                        <input type="hidden" id="id" name="id" value="<?= $input_id ?? ''; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="student_identification_number" name="student_identification_number" placeholder="Nomor Pokok Mahasiswa" value="<?= $input_student_identification_number ?? ''; ?>">
                        <strong class="text-danger"><?= form_error('student_identification_number'); ?></strong>
                    </div>
                    <div class="form-group">
                        <select class="form-control form-select" id="admission_track_id" name="admission_track_id">
                            <option value="" <?= set_select('admission_track_id', '', empty($input_admission_track_id)) ?>>-- Pilih Jalur Masuk --</option>
                            <?php foreach ($admission_tracks as $admission_track): ?>
                                <option value="<?= html_escape($admission_track->id) ?>" <?= set_select('admission_track_id', $admission_track->id, isset($input_admission_track_id) && $input_admission_track_id == $admission_track->id) ?>>
                                    <?= html_escape($admission_track->name) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <strong class="text-danger"><?= form_error('admission_track_id'); ?></strong>
                    </div>
                    <div class="form-group">
                        <select class="form-control form-select" id="major_id" name="major_id">
                            <option value="" <?= set_select('major_id', '', empty($input_major_id)) ?>>-- Pilih Jurusan --</option>
                            <?php foreach ($majors as $major): ?>
                                <option value="<?= html_escape($major->id) ?>" <?= set_select('major_id', $major->id, isset($input_major_id) && $input_major_id == $major->id) ?>>
                                    <?= html_escape($major->code . ' - ' . $major->name) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <strong class="text-danger"><?= form_error('major_id'); ?></strong>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="location" name="location" placeholder="Lokasi Kampus" value="<?= $input_location ?? ''; ?>">
                        <strong class="text-danger"><?= form_error('location'); ?></strong>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="class" name="class" placeholder="Kelas" value="<?= $input_class ?? ''; ?>">
                        <strong class="text-danger"><?= form_error('class'); ?></strong>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Nama Lengkap" value="<?= $input_name ?? ''; ?>">
                        <strong class="text-danger"><?= form_error('name'); ?></strong>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="place_of_birth" name="place_of_birth" placeholder="Tempat Lahir" value="<?= $input_place_of_birth ?? ''; ?>">
                        <strong class="text-danger"><?= form_error('place_of_birth'); ?></strong>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="date_of_birth" name="date_of_birth" placeholder="Tanggal Lahir" value="<?= $input_date_of_birth ?? ''; ?>">
                        <strong class="text-danger"><?= form_error('date_of_birth'); ?></strong>
                    </div>
                    <div class="form-group">
                        <select class="form-control form-select" id="religion" name="religion">
                            <option value="" <?= set_select('religion', '', empty($input_religion)) ?>>-- Pilih Agama --</option>
                            <option value="Islam" <?= set_select('religion', 'Islam', isset($input_religion) && $input_religion === 'Islam') ?>>Islam</option>
                            <option value="Kristen Protestan" <?= set_select('religion', 'Kristen Protestan', isset($input_religion) && $input_religion === 'Kristen Protestan') ?>>Kristen Protestan</option>
                            <option value="Kristen Katolik" <?= set_select('religion', 'Kristen Katolik', isset($input_religion) && $input_religion === 'Kristen Katolik') ?>>Kristen Katolik</option>
                            <option value="Hindu" <?= set_select('religion', 'Hindu', isset($input_religion) && $input_religion === 'Hindu') ?>>Hindu</option>
                            <option value="Buddha" <?= set_select('religion', 'Buddha', isset($input_religion) && $input_religion === 'Buddha') ?>>Buddha</option>
                            <option value="Khonghucu" <?= set_select('religion', 'Khonghucu', isset($input_religion) && $input_religion === 'Khonghucu') ?>>Khonghucu</option>
                        </select>
                        <strong class="text-danger"><?= form_error('religion'); ?></strong>
                    </div>
                    <div class="form-group">
                        <select class="form-control form-select" id="gender" name="gender">
                            <option value="" <?= set_select('gender', '', empty($input_gender)) ?>>-- Pilih Jenis Kelamin --</option>
                            <option value="Laki-laki" <?= set_select('gender', 'Laki-laki', isset($input_gender) && $input_gender === 'Laki-laki') ?>>Laki-laki</option>
                            <option value="Perempuan" <?= set_select('gender', 'Perempuan', isset($input_gender) && $input_gender === 'Perempuan') ?>>Perempuan</option>
                        </select>
                        <strong class="text-danger"><?= form_error('gender'); ?></strong>
                    </div>
                    <div class="form-group">
                        <label for="profile_photo" class="form-label">Foto Profil</label>
                        <input type="file" class="form-control" id="profile_photo" name="profile_photo">
                        <strong class="text-danger"><?= form_error('profile_photo'); ?></strong>
                    </div>
                    <button class="btn btn-primary btn-user btn-block">
                        Simpan
                    </button>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>

<script>
    $('#date_of_birth').datepicker({
        uiLibrary: 'bootstrap5',
        format: 'yyyy-mm-dd',
        autohide: true
    });
</script>
