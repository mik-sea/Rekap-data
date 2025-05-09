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
    <h1 class="h3 mb-4 text-gray-800">Data Fakultas</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Pilihan</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $counter = 1;
                        foreach($faculties as $faculty) {
                    ?>
                        <tr>
                            <td><?= $counter; ?></td>
                            <td><?= $faculty->code; ?></td>
                            <td><?= $faculty->name; ?></td>
                            <td>
                                <a href="<?= site_url('faculty/edit/' . $faculty->id) ?>" class="btn btn-primary">Sunting</a>
                                <?= form_open('faculty/delete'); ?>
                                <input type="hidden" name="id" value="<?= $faculty->id; ?>">
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
