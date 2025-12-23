<style>
    .konten-utama {
        padding: 15px;
        max-width: 100%;
        overflow-x: hidden; 
    }

    .kotak-tabel-scroll {
        width: 100%;
        overflow-x: auto; 
        background: white;
        border: 1px solid #dee2e6;
        border-radius: 8px;
    }

    .tabel-data {
        min-width: 900px; 
        font-size: 0.85rem;
        margin-bottom: 0 !important;
    }

    .tabel-data th, .tabel-data td {
        padding: 8px 5px !important;
        vertical-align: middle;
    }

    .col-no { width: 40px; }
    .col-tgl { width: 100px; }
    .col-jml { width: 60px; }
    .col-status { width: 90px; }
    .col-aksi { width: 120px; }
</style>

<div class="konten-utama">
    <h2 class="fw-bold mb-4">Input Pembelian Bahan Baku</h2>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form action="<?= base_url('staff/simpan_pembelian') ?>" method="post" id="formPembelian">
                <div class="row g-2">
                    <div class="col-md-3">
                        <label class="small fw-bold">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control form-control-sm" required />
                    </div>
                    <div class="col-md-3">
                        <label class="small fw-bold">Nama Bahan</label>
                        <input type="text" name="nama_bahan" id="nama_bahan" class="form-control form-control-sm" required />
                    </div>
                    <div class="col-md-3">
                        <label class="small fw-bold">Jumlah</label>
                        <input type="number" name="jumlah" id="jumlah" class="form-control form-control-sm" required />
                    </div>
                    <div class="col-md-3">
                        <label class="small fw-bold">Harga Satuan</label>
                        <input type="number" name="harga_satuan" id="harga_satuan" class="form-control form-control-sm" required />
                    </div>
                </div>

                <div class="row g-2 mt-2">
                    <div class="col-md-4">
                        <label class="small fw-bold">Total Pengeluaran</label>
                        <input type="text" id="total_pengeluaran_view" class="form-control form-control-sm bg-light fw-bold" readonly />
                    </div>
                    <div class="col-md-4">
                        <label class="small fw-bold">Nama Supplier</label>
                        <input type="text" name="nama_supplier" id="nama_supplier" class="form-control form-control-sm" required/>
                    </div>
                    <div class="col-md-4">
                        <label class="small fw-bold">Status</label>
                        <select name="status" id="status" class="form-select form-select-sm">
                            <option value="Selesai">Selesai</option>
                            <option value="Pending">Pending</option>
                            <option value="Ditolak">Ditolak</option>
                        </select>
                    </div>
                </div>

                <div class="mt-2">
                    <label class="small fw-bold">Kasir Pencatat</label>
                    <input type="text" name="kasir_pencatat" id="kasir_pencatat" class="form-control form-control-sm" placeholder="Ketik nama kasir..." required />
                </div>

                <button type="submit" class="btn btn-primary btn-sm w-100 fw-bold mt-3 shadow" id="submitBtn">Simpan Pembelian</button>
            </form>
        </div>
    </div>

    <h2 class="fw-bold mb-3">Data Pembelian Bahan Baku</h2>

    <div class="kotak-tabel-scroll shadow-sm">
        <table class="table table-sm table-bordered table-striped tabel-data">
            <thead class="table-dark text-center">
                <tr>
                    <th class="col-no">No</th>
                    <th class="col-tgl">Tanggal</th>
                    <th>Nama Bahan</th>
                    <th class="col-jml">Jumlah</th>
                    <th>Harga Unit</th>
                    <th>Total Pengeluaran</th>
                    <th>Supplier</th>
                    <th>Kasir</th>
                    <th class="col-status">Status</th>
                    <th class="col-aksi">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($pembelian)) : $no = 1; foreach ($pembelian as $p) : ?>
                <tr>
                    <td class="text-center"><?= $no++; ?></td>
                    <td class="text-center"><?= $p['tanggal_pembelian']; ?></td>
                    <td><?= $p['nama_menu']; ?></td>
                    <td class="text-center"><?= $p['jumlah_pembelian']; ?></td>
                    <td nowrap>Rp <?= number_format($p['harga_total'] / ($p['jumlah_pembelian'] ?: 1), 0, ',', '.'); ?></td>
                    <td class="fw-bold" nowrap>Rp <?= number_format($p['harga_total'], 0, ',', '.'); ?></td>
                    <td><?= $p['supplier']; ?></td>
                    <td class="text-center"><?= $p['kasir_pencatat'] ?? $p['id_pegawai']; ?></td>
                    <td class="text-center">
                        <?php 
                            $warna = 'secondary';
                            if ($p['status'] == 'Selesai') $warna = 'success';
                            elseif ($p['status'] == 'Pending') $warna = 'warning';
                            elseif ($p['status'] == 'Ditolak') $warna = 'danger';
                        ?>
                        <span class="badge btn-sm bg-<?= $warna; ?> text-dark" style="font-size: 0.7rem;">
                            <?= $p['status']; ?>
                        </span>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-success btn-xs" style="padding: 2px 5px; font-size: 0.75rem;" onclick="editData('<?= $p['id_pembelian_stok'] ?>', '<?= $p['tanggal_pembelian'] ?>', '<?= $p['nama_menu'] ?>', '<?= $p['jumlah_pembelian'] ?>', '<?= $p['harga_total'] ?>', '<?= $p['supplier'] ?>', '<?= $p['status'] ?>', '<?= isset($p['kasir_pencatat']) ? $p['kasir_pencatat'] : '' ?>')">Edit</button>
                        <a href="<?= base_url('staff/hapus_pembelian/' . $p['id_pembelian_stok']) ?>" class="btn btn-danger btn-xs" style="padding: 2px 5px; font-size: 0.75rem;" onclick="return confirm('Hapus?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    const inJ = document.getElementById('jumlah'), 
          inH = document.getElementById('harga_satuan'), 
          outT = document.getElementById('total_pengeluaran_view');

    function hitung() { 
        const total = (Number(inJ.value) || 0) * (Number(inH.value) || 0);
        outT.value = "Rp " + total.toLocaleString('id-ID'); 
    }
    
    inJ.addEventListener('input', hitung); 
    inH.addEventListener('input', hitung);

    function editData(id, tgl, nama, j, t, s, stat, k) {
        document.getElementById('tanggal').value = tgl;
        document.getElementById('nama_bahan').value = nama;
        document.getElementById('jumlah').value = j;
        document.getElementById('harga_satuan').value = Math.round(t / (j || 1));
        document.getElementById('nama_supplier').value = s;
        document.getElementById('status').value = stat;
        document.getElementById('kasir_pencatat').value = k;
        document.getElementById('formPembelian').action = "<?= base_url('staff/update_pembelian') ?>/" + id;
        document.getElementById('submitBtn').innerText = "Update Data";
        hitung();
        window.scrollTo({top: 0, behavior: 'smooth'});
    }
</script>