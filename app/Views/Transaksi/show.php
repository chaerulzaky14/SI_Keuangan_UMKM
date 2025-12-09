<div class="container mt-4"><br>
  <h2 class="mb-4">Detail Transaksi #<?= $transaksi['id_transaksi'] ?></h2>

  <?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success">
      <?= session()->getFlashdata('success') ?>
    </div>
  <?php endif; ?>

  <div class="mb-3 d-print-none">
    <a href="<?= base_url('transaksi') ?>" class="btn btn-light">
      Kembali
    </a>
    <button class="btn btn-warning" onclick="window.print()">
      <i class="bi bi-printer"></i> Cetak
    </button>
  </div>

  <div class="container-fluid">
    <div class="card mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold">Informasi Transaksi</h6>
      </div>
      <div class="card-body">
        <div class="row mb-2">
          <div class="col-md-4">
            <strong>Tanggal Transaksi</strong><br>
            <?= esc($transaksi['tanggal_transaksi']) ?>
          </div>
          <div class="col-md-4">
            <strong>Metode Pembayaran</strong><br>
            <?= esc($transaksi['metode_pembayaran']) ?>
          </div>
          <div class="col-md-4">
            <strong>Total Harga</strong><br>
            Rp<?= number_format($transaksi['total_harga'], 2, ',', '.') ?>
          </div>
        </div>
      </div>
    </div>

    <h5>Rincian Item</h5>

    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" width="100%" cellspacing="0">
            <thead class="table-dark">
              <tr>
                <th>No</th>
                <th>Nama Menu</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
              </tr>
            </thead>
            <tbody class="table-primary">
              <?php $no = 1; ?>
              <?php foreach ($items as $item) : ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= esc($item['nama_menu']) ?></td>
                  <td>Rp<?= number_format($item['harga'], 2, ',', '.') ?></td>
                  <td><?= esc($item['jumlah']) ?></td>
                  <td>Rp<?= number_format($item['subtotal'], 2, ',', '.') ?></td>
                </tr>
              <?php endforeach; ?>

              <?php if (empty($items)) : ?>
                <tr>
                  <td colspan="5" class="text-center">Tidak ada item.</td>
                </tr>
              <?php endif; ?>
            </tbody>
            <tfoot>
              <tr>
                <th colspan="4" class="text-end">Total</th>
                <th>Rp<?= number_format($transaksi['total_harga'], 2, ',', '.') ?></th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>

  </div>
</div>

<style>
@media print {
  #sidebar,
  #toggleSidebar,
  .nav-toggle,
  .btn,
  .navbar,
  footer {
    display: none !important;
  }

  body {
    background: #fff;
  }

  .container,
  .container-fluid {
    margin: 0;
    padding: 0;
    max-width: 100%;
  }
}
</style>
