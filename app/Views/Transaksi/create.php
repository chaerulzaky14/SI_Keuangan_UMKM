<div class="container mt-4"><br>
    <h2 class="mb-4">Input Transaksi Penjualan</h2>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold">Form Transaksi</h6>
                <a href="<?= base_url('transaksi') ?>" class="btn btn-light btn-sm">Kembali</a>
            </div>
            <div class="card-body">
                <form action="<?= base_url('transaksi/store') ?>" method="post">

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
                            <input type="date"
                                name="tanggal_transaksi"
                                id="tanggal_transaksi"
                                value="<?= old('tanggal_transaksi') ?? date('Y-m-d') ?>"
                                class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                            <select name="metode_pembayaran" id="metode_pembayaran" class="form-select">
                                <option value="Cash">Cash</option>
                                <option value="Transfer">Transfer</option>
                                <option value="QRIS">QRIS</option>
                                <option value="E-Wallet">E-Wallet</option>
                            </select>
                        </div>
                    </div>

                    <hr>

                    <h5>Daftar Item</h5>

                    <div class="table-responsive">
                        <table class="table table-bordered" id="table-items">
                            <thead class="table-dark">
                                <tr>
                                    <th style="width: 40%;">Menu</th>
                                    <th style="width: 15%;">Harga</th>
                                    <th style="width: 15%;">Jumlah</th>
                                    <th style="width: 20%;">Subtotal</th>
                                    <th style="width: 10%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="body-items" class="table-primary">
                                <tr class="item-row">
                                    <td>
                                        <select name="id_menu[]" class="form-select menu-select">
                                            <option value="">-- Pilih Menu --</option>
                                            <?php foreach ($menu as $m) : ?>
                                                <option value="<?= $m['id_menu'] ?>" data-harga="<?= $m['harga'] ?>">
                                                    <?= esc($m['nama_menu']) ?> (Rp<?= number_format($m['harga'], 2, ',', '.') ?>)
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control harga" value="0" readonly>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control jumlah" name="jumlah[]" min="1" value="1">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control subtotal" value="0" readonly>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-danger btn-sm btn-remove-row">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <button type="button" class="btn btn-secondary mb-3" id="btn-add-row">
                        <i class="bi bi-plus-circle"></i> Tambah Item
                    </button>

                    <div class="d-flex justify-content-end mb-3">
                        <div class="text-end">
                            <label for="total_harga" class="form-label fw-bold">Total Harga</label>
                            <input type="text" id="total_harga" class="form-control fw-bold" value="0" readonly>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Simpan Transaksi
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function hitungRow(row) {
        const selectMenu = row.querySelector('.menu-select');
        const hargaInput = row.querySelector('.harga');
        const jumlahInput = row.querySelector('.jumlah');
        const subtotalInput = row.querySelector('.subtotal');

        const harga = parseFloat(selectMenu.selectedOptions[0]?.getAttribute('data-harga') || 0);
        const jumlah = parseInt(jumlahInput.value || 0);
        const subtotal = harga * jumlah;

        hargaInput.value = harga.toLocaleString('id-ID');
        subtotalInput.value = subtotal.toLocaleString('id-ID');

        hitungTotal();
    }

    function hitungTotal() {
        let total = 0;
        document.querySelectorAll('#body-items .item-row').forEach(row => {
            const subtotalInput = row.querySelector('.subtotal');
            const clean = (subtotalInput.value || '0').toString().replace(/\./g, '').replace(/,/g, '');
            const subtotal = parseFloat(clean) || 0;
            total += subtotal;
        });

        document.getElementById('total_harga').value = total.toLocaleString('id-ID');
    }

    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('menu-select') || e.target.classList.contains('jumlah')) {
            const row = e.target.closest('.item-row');
            hitungRow(row);
        }
    });

    document.getElementById('btn-add-row').addEventListener('click', function() {
        const tbody = document.getElementById('body-items');
        const firstRow = tbody.querySelector('.item-row');
        const clone = firstRow.cloneNode(true);

        clone.querySelector('.menu-select').selectedIndex = 0;
        clone.querySelector('.harga').value = '0';
        clone.querySelector('.jumlah').value = '1';
        clone.querySelector('.subtotal').value = '0';

        tbody.appendChild(clone);
    });

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-remove-row') || e.target.closest('.btn-remove-row')) {
            const btn = e.target.closest('.btn-remove-row');
            const tbody = document.getElementById('body-items');
            const rows = tbody.querySelectorAll('.item-row');

            if (rows.length > 1) {
                btn.closest('.item-row').remove();
                hitungTotal();
            } else {
                alert('Minimal satu item.');
            }
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('#body-items .item-row').forEach(row => hitungRow(row));
    });
</script>