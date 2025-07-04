<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<?php
if (session()->getFlashData('success')) {
?>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
?>


<?php
if (session()->getFlashData('failed')) {
    $errors = session()->getFlashData('failed');
    if (is_array($errors)) {
?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                <?php foreach ($errors as $err) : ?>
                    <li><?= esc($err) ?></li>
                <?php endforeach ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
    } else {
    ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= esc($errors) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
<?php
    }
}
?>

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
    Tambah Data
</button>


<!-- Table with stripped rows -->
<table class="table datatable">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Nominal</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($discount as $index => $discount) : ?>
            <tr>
                <th scope="row"><?php echo $index + 1 ?></th>
                <td><?php echo $discount['tanggal'] ?></td>
                <td><?php echo $discount['nominal'] ?></td>
                <td>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal-<?= $discount['id'] ?>">
                        Ubah
                    </button>
                    <a href="<?= base_url('diskon/delete/' . $discount['id']) ?>" class="btn btn-danger" onclick="return confirm('Yakin hapus data ini ?')">
                        Hapus
                    </a>
                </td>
            </tr>

            <!-- Edit Modal Begin -->
            <div class="modal fade" id="editModal-<?= $discount['id'] ?>" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="<?= base_url('diskon/edit/' . $discount['id']) ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="modal-body">
                                <!-- tanggal -->
                                <div class="form-group">
                                    <label for="name">Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control" id="tanggal" value="<?= $discount['tanggal'] ?>" placeholder="Tanggal diskon" required>
                                </div>
                                <!-- nominal -->
                                <div class="form-group">
                                    <label for="name">Nominal</label>
                                    <input type="text" name="nominal" class="form-control" id="nominal" value="<?= $discount['nominal'] ?>" placeholder="Nominal diskon" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Edit Modal End -->
        <?php endforeach ?>
    </tbody>
</table>
<!-- End Table with stripped rows -->

<!-- Add Modal Begin -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('diskon') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <!-- tanggal -->
                    <div class="form-group">
                        <label for="name">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" id="tanggal" value="<?= $discount['tanggal'] ?>" placeholder="Tanggal diskon" required>
                    </div>
                    <!-- nominal -->
                    <div class="form-group">
                        <label for="name">Nominal</label>
                        <input type="text" name="nominal" class="form-control" id="nominal" value="<?= $discount['nominal'] ?>" placeholder="Nominal diskon" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Add Modal End -->

<?= $this->endSection() ?>