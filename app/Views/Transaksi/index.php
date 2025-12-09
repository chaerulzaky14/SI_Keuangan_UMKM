<div class="container mt-4"><br>
  <h2 class="mb-4">Transaksi Penjualan</h2>

  <?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success">
      <?= session()->getFlashdata('success') ?>
    </div>
  <?php endif; ?>

  <?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger">
      <?= session()->getFlashdata('error') ?>
    </div>
  <?php endif; ?>

  <div class="mb-3">
    <a href="<?= base_url('transaksi/create') ?>" class="btn btn-primary">
      <i class="bi bi-plus-circle"></i> Input Transaksi Baru
    </a>
  </div>

  <!-- Begin Page Content -->
  <div class="container-fluid">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold">Daftar Transaksi</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead class="table-dark">
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Metode Pembayaran</th>
                <th>Total Harga (Rp)</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody class="table-primary">
              <?php $no = 1; ?>
              <?php foreach ($transaksi as $row) : ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= esc($row['tanggal_transaksi']) ?></td>
                  <td><?= esc($row['metode_pembayaran']) ?></td>
                  <td>Rp<?= number_format($row['total_harga'], 2, ',', '.') ?></td>
                  <td class="text-center">
                    <a href="<?= base_url('transaksi/' . $row['id_transaksi']) ?>" class="btn btn-primary btn-sm">
                      <i class="bi bi-eye text-white"></i>
                    </a>
                    <a href="<?= base_url('transaksi/delete/' . $row['id_transaksi']) ?>"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Yakin ingin membatalkan / menghapus transaksi ini?');">
                      <i class="bi bi-trash text-white"></i>
                    </a>
                    <a href="<?= base_url('transaksi/' . $row['id_transaksi']) ?>?print=1"
                       class="btn btn-warning btn-sm" onclick="window.open(this.href); return false;">
                      <i class="bi bi-printer"></i>
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>

              <?php if (empty($transaksi)) : ?>
                <tr>
                  <td colspan="5" class="text-center">Belum ada transaksi.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
  <!-- /.container-fluid -->
</div>
