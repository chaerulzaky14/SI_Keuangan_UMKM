

     <div class="container mt-4">
       <h2 class="mb-4">Input Transaksi Penjualan</h2>

       <form id="formPenjualan" class="mb-4 needs-validation" novalidate>
         <input type="hidden" id="editIndex" /> <!-- untuk tracking index edit -->

         <div class="row g-3">
           <div class="col-md-3">
             <label for="tanggal" class="form-label">Tanggal Penjualan</label>
             <input type="date" id="tanggal" class="form-control" required />
             <div class="invalid-feedback">Tanggal wajib diisi.</div>
           </div>

           <div class="col-md-4">
             <label for="namaPegawai" class="form-label">Nama Pegawai</label>
             <input type="text" id="namaPegawai" class="form-control" readonly />
           </div>

           <div class="col-md-5">
             <label for="menuSelect" class="form-label">Pilih Menu</label>
             <select id="menuSelect" class="form-select" required></select>
             <div class="invalid-feedback">Pilih menu penjualan.</div>
           </div>

           <div class="col-md-2">
             <label for="jumlah" class="form-label">Jumlah</label>
             <input type="number" id="jumlah" class="form-control" min="1" required />
             <div class="invalid-feedback">Minimal 1 item.</div>
           </div>

           <div class="col-md-3">
             <label for="metodeBayar" class="form-label">Metode Bayar</label>
             <select id="metodeBayar" class="form-select" required>
               <option value="" disabled selected>Pilih metode</option>
               <option value="cash">Cash</option>
               <option value="digital">Digital</option>
             </select>
             <div class="invalid-feedback">Pilih metode bayar.</div>
           </div>
         </div>

         <div class="mt-3">
           <label for="totalHarga" class="form-label">Total Harga (Rp)</label>
           <input type="text" id="totalHarga" class="form-control" readonly />
         </div>

         <button type="submit" class="btn btn-primary mt-3" id="submitBtn">Simpan Penjualan</button>
         <button type="button" class="btn btn-secondary mt-3 ms-2 d-none" id="cancelEditBtn">Batal Ubah</button>
       </form>

       <h4>Riwayat Penjualan</h4>
       <!-- Tombol Cetak Riwayat -->
       <button class="btn btn-info mb-3" onclick="cetakRiwayat()">Cetak Riwayat</button>
       <table class="table table-striped">
         <thead>
           <tr class="table-dark">
             <th>No</th>
             <th>Tanggal</th>
             <th>Nama Pegawai</th>
             <th>Menu</th>
             <th>Jumlah</th>
             <th>Metode Bayar</th>
             <th>Total Harga</th>
             <th>Aksi</th>
           </tr>
           <tr class="table-primary">
            <td>1</td>
            <td>11-21-2025</td>
            <td>Yoga</td>
            <td>Roti</td>
            <td>2</td>
            <td>Cash</td>
            <td>Rp10.000</td>
            <td>
              <button class="btn btn-sm btn-warning me-1">Edit</button> |
              <button class="btn btn-sm btn-danger">Hapus</button>
            </td>
           </tr>
         </thead>
         <tbody id="penjualanListBody"></tbody>
       </table>
     </div>
     
