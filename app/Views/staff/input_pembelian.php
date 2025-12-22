<div class="container mt-4 "><br>
   
    <h2 class="mb-4">Input Pembelian Bahan Baku</h2>

    <form action="<?= base_url('staff/simpan_pembelian') ?>" method="post" id="formPembelian" class="mb-4 needs-validation" novalidate>
        <input type="hidden" id="editIndex" /> 
        <div class="row g-3">
          <div class="col-md-3">
            <label for="tanggal" class="form-label">Tanggal Pembelian</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" required />
            <div class="invalid-feedback">Tanggal wajib diisi.</div>
          </div>
          <div class="col-md-4">
            <label for="nama_bahan" class="form-label">Nama Bahan</label>
            <input type="text" name="nama_bahan" id="nama_bahan" class="form-control" placeholder="Nama bahan..." required />
            <div class="invalid-feedback">Nama bahan wajib diisi.</div>
          </div>
          <div class="col-md-2">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control" min="1" required />
            <div class="invalid-feedback">Jumlah minimal 1.</div>
          </div>
          <div class="col-md-3">
            <label for="harga" class="form-label">Harga per Unit (Rp)</label>
            <input type="number" name="harga_satuan" id="harga" class="form-control" min="0" required />
            <div class="invalid-feedback">Masukkan harga valid.</div>
          </div>
        </div>
        <div class="mt-3">
          <label for="nama_supplier" class="form-label">Nama Supplier</label>
          <input type="text" name="supplier" id="nama_supplier" class="form-control" placeholder="Nama supplier..." required/>
          <div class="invalid-feedback">Nama supplier wajib diisi.</div>
        </div>

        <div class="mt-3">
          <label for="total_pengeluaran" class="form-label">Total Pengeluaran (Rp)</label>
          <input type="text" id="total_pengeluaran" class="form-control" readonly />
        </div>

        <div class="mt-3">
          <label for="kasir_pencatat" class="form-label">Kasir Pencatat</label>
          <input type="text" id="kasir_pencatat" class="form-control" readonly />
        </div>

        <div class="mt-3">
          <label for="status" class="form-label">Status</label>
          <select name="status" id="status" class="form-select">
            <option value="Pending">Pending</option>
            <option value="Selesai">Selesai</option>
            <option value="Ditolak">Ditolak</option>
          </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3" id="submitBtn">Simpan Pembelian</button>
        <button type="button" class="btn btn-secondary mt-3 ms-2 d-none" id="cancelEditBtn">Batal Ubah</button>
    </form> <div class="container-fluid">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold ">Data Pembelian Barang</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead class="table-dark">
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Nama Bahan</th>
                  <th>Jumlah</th>
                  <th>Harga Unit</th>
                  <th>Total Pengeluaran</th>
                  <th>Supplier</th>
                  <th>Kasir Pencatat</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody class="table-primary">
                <?php $no = 1; foreach ($pembelian as $p) : ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $p['tanggal_pembelian']; ?></td>
                  <td><?= $p['nama_menu']; ?></td>
                  <td><?= $p['jumlah_pembelian']; ?></td>
                  <td>Rp <?= number_format($p['harga_total'] / ($p['jumlah_pembelian'] ?: 1), 0, ',', '.'); ?></td>
                  <td>Rp <?= number_format($p['harga_total'], 0, ',', '.'); ?></td>
                  <td>-</td> <td>Admin (ID: <?= $p['id_pegawai']; ?>)</td> 
                  <td><span class="badge text-bg-info">Selesai</span></td>
                  <td class="text-center">
                    
                    <button type="button" class="btn btn-success btn-sm" 
                            onclick="editData('<?= $p['id_pembelian_stok'] ?>', '<?= $p['tanggal_pembelian'] ?>', '<?= $p['nama_menu'] ?>', '<?= $p['jumlah_pembelian'] ?>', '<?= $p['harga_total'] ?>')">
                        <i class="bi bi-pencil-square"></i>
                    </button>

                    <a href="<?= base_url('staff/hapus_pembelian/' . $p['id_pembelian_stok']) ?>" 
                       class="btn btn-danger btn-sm" 
                       onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                       <i class="bi bi-trash"></i>
                    </a>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>

<script>
function editData(id, tanggal, nama, jumlah, harga_total) {
    // 1. Masukkan data ke input
    document.getElementById('tanggal').value = tanggal;
    document.getElementById('nama_bahan').value = nama;
    document.getElementById('jumlah').value = jumlah;
    document.getElementById('harga').value = Math.round(harga_total / jumlah);
    
    // 2. Ubah Action Form (PENTING: Gunakan slash yang benar)
    let form = document.getElementById('formPembelian');
    form.action = "<?= base_url('staff/update_pembelian') ?>/" + id;
    
    // 3. Ubah Tombol
    let btn = document.getElementById('submitBtn');
    btn.innerText = "Update Pembelian";
    btn.classList.replace('btn-primary', 'btn-warning');
    
    // 4. Munculkan tombol batal
    document.getElementById('cancelEditBtn').classList.remove('d-none');
    
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

document.getElementById('cancelEditBtn').addEventListener('click', function() {
    location.reload(); 
});
</script>