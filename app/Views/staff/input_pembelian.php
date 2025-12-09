

    <div class="container mt-4 "><br>
   
     <h2 class="mb-4">Input Pembelian Bahan Baku</h2>

     <form id="formPembelian" class="mb-4 needs-validation" novalidate>
       <input type="hidden" id="editIndex" /> <!-- Untuk tracking index edit -->
       <div class="row g-3">
         <div class="col-md-3">
           <label for="tanggal" class="form-label">Tanggal Pembelian</label>
           <input type="date" id="tanggal" class="form-control" required />
           <div class="invalid-feedback">Tanggal wajib diisi.</div>
         </div>
         <div class="col-md-4">
           <label for="nama_bahan" class="form-label">Nama Bahan</label>
           <input type="text" id="nama_bahan" class="form-control" placeholder="Nama bahan..." required />
           <div class="invalid-feedback">Nama bahan wajib diisi.</div>
         </div>
         <div class="col-md-2">
           <label for="jumlah" class="form-label">Jumlah</label>
           <input type="number" id="jumlah" class="form-control" min="1" required />
           <div class="invalid-feedback">Jumlah minimal 1.</div>
         </div>
         <div class="col-md-3">
           <label for="harga" class="form-label">Harga per Unit (Rp)</label>
           <input type="number" id="harga" class="form-control" min="0" required />
           <div class="invalid-feedback">Masukkan harga valid.</div>
         </div>
       </div>
       <div class="mt-3">
         <label for="nama_supplier" class="form-label">Nama Supplier</label>
         <input type="text" id="nama_supplier" class="form-control" placeholder="Nama supplier..." required/>
         <div class="invalid-feedback">Nama supplier wajib diisi.</div>
       </div>

       <!-- Tambahan field total_pengeluaran (read-only, otomatis) -->
       <div class="mt-3">
         <label for="total_pengeluaran" class="form-label">Total Pengeluaran (Rp)</label>
         <input type="text" id="total_pengeluaran" class="form-control" readonly />
       </div>

       <!-- Tambahan field kasir pencatat auto isi -->
       <div class="mt-3">
         <label for="kasir_pencatat" class="form-label">Kasir Pencatat</label>
         <input type="text" id="kasir_pencatat" class="form-control" readonly />
       </div>

       <!-- Tambahan field status (default Pending) -->
       <div class="mt-3">
         <label for="status" class="form-label">Status</label>
         <select id="status" class="form-select">
           <option value="Pending">Pending</option>
           <option value="Selesai">Selesai</option>
           <option value="Ditolak">Ditolak</option>
         </select>
       </div>

       <button type="submit" class="btn btn-primary mt-3" id="submitBtn">Simpan Pembelian</button>
       <button type="button" class="btn btn-secondary mt-3 ms-2 d-none" id="cancelEditBtn">Batal Ubah</button>
     </form>




      <!-- Begin Page Content -->
        <div class="container-fluid">
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
                    <tr>
                      <td>1</td>
                      <td>11-21-2025</td>
                      <td>gula</td>
                      <td>10 kg</td>
                      <td>Rp 8.000</td>
                      <td>Rp 180.000</td>
                      <td>Intan Grosir</td>
                      <td>Yoga</td>
                      <td><span class="badge text-bg-success">Active</span></td>
                      <td class="text-center">
                        <button type="button" class="btn btn-success"><i class="bi bi-pencil-square text-white"></i></button> <br>
                        <button type="button" class="btn btn-danger"><i class="bi bi-trash text-white"></i></button>
                      </td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>11-21-2025</td>
                      <td>Terigu</td>
                      <td>10 kg</td>
                      <td>Rp 8.000</td>
                      <td>Rp 180.000</td>
                      <td>Intan Grosir</td>
                      <td>Yoga</td>
                      <td><span class="badge text-bg-success">Active</span></td>
                      <td class="text-center">
                        <button type="button" class="btn btn-success"><i class="bi bi-pencil-square text-white"></i></button> <br>
                        <button type="button" class="btn btn-danger"><i class="bi bi-trash text-white"></i></button>
                      </td>
                    </tr>
                  
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
   </div>

    