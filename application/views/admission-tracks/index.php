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
    <h1 class="h3 mb-4 text-gray-800">Data Jalur Masuk</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Pilihan</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $counter = 1;
                        foreach($admission_tracks as $admission_track) {
                    ?>
                        <tr>
                            <td><?= $counter; ?></td>
                            <td><?= $admission_track->name; ?></td>
                            <td>
                                <a href="<?= site_url('admission-track/edit/' . $admission_track->id) ?>" class="btn btn-primary">Sunting</a>
                                <?= form_open('admission-track/delete'); ?>
                                <input type="hidden" name="id" value="<?= $admission_track->id; ?>">
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
