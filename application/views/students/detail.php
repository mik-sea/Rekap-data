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
                    <h1 class="h4 text-gray-900 mb-4">Detail Data Mahasiswa</h1>
                </div>
                <div class="row">
                <!-- Kolom kiri: Info Mahasiswa -->
                <div class="col-md-8">

                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">NPM</div>
                        <div class="col-sm-8"><?= $input_student_identification_number ?? '-'; ?></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Nama</div>
                        <div class="col-sm-8"><?= $input_name ?? '-'; ?></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Kelas</div>
                        <div class="col-sm-8"><?= $input_class ?? '-'; ?></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Tempat, Tanggal Lahir</div>
                        <div class="col-sm-8"><?= ($input_place_of_birth ?? '-') . ', ' . ($input_date_of_birth ?? '-'); ?></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Agama</div>
                        <div class="col-sm-8"><?= $input_religion ?? '-'; ?></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Jenis Kelamin</div>
                        <div class="col-sm-8"><?= $input_gender ?? '-'; ?></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Lokasi Kampus</div>
                        <div class="col-sm-8"><?= $input_location ?? '-'; ?></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Jalur Masuk</div>
                        <div class="col-sm-8">
                            <?php
                            if (!empty($admission_tracks)) {
                                foreach ($admission_tracks as $track) {
                                    if ($track->id == ($input_admission_track_id ?? null)) {
                                        echo html_escape($track->name);
                                        break;
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Jurusan</div>
                        <div class="col-sm-8">
                            <?php
                            if (!empty($majors)) {
                                foreach ($majors as $major) {
                                    if ($major->id == ($input_major_id ?? null)) {
                                        echo html_escape($major->code . ' - ' . $major->name);
                                        break;
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Kolom kanan: Foto Profil -->
                <div class="col-md-4 text-center">
                    <img src="<?= base_url('./uploads/' . ($input_profile_photo ?? 'default.png')); ?>" 
                         alt="Foto Profil" 
                         class="img-fluid rounded-circle mb-2" 
                         style="max-width: 200px; height: auto;">
                    <p class="text-muted">Foto Profil</p>
                </div>
            </div>
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
