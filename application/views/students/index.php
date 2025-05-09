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
    <h1 class="h3 mb-4 text-gray-800">Data Mahasiswa</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NPM</th>
                            <th>Fakultas</th>
                            <th>Jurusan</th>
                            <th>Kelas</th>
                            <th>Nama</th>
                            <th>Pilihan</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $counter = 1;
                        foreach($students as $student) {
                    ?>
                        <tr>
                            <td><?= $counter; ?></td>
                            <td><?= $student->student_identification_number; ?></td>
                            <td><?= $student->faculty; ?></td>
                            <td><?= $student->major; ?></td>
                            <td><?= $student->class; ?></td>
                            <td><?= $student->name; ?></td>
                            <td>
                                <a href="<?= site_url('student/detail/' . $student->id) ?>" class="btn btn-success">Lihat</a>
                                <a href="<?= site_url('student/edit/' . $student->id) ?>" class="btn btn-primary">Sunting</a>
                                <?= form_open('student/delete'); ?>
                                <input type="hidden" name="id" value="<?= $student->id; ?>">
                                <button type="submit" class="btn btn-danger">Hapus</button>
                                <?= form_close(); ?>
                            </td>
                        </tr>
                    <?php
                            $counter++;
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
