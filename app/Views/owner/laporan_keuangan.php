
     
      <!-- <input type="search" id="navSearch" placeholder="Cari menu..." /> -->
     <li><a class="nav-link" href="/owner/kelola_menu"> <i class="bi bi-list-ul"></i> Kelola Menu</a></li> 
    <li> <a class="nav-link" href="/owner/laporan_keuangan" > <i class="bi bi-graph-up"></i> Laporan keuangan</a></li> 
      <li><a class="nav-link text-danger" id="logoutBtn"><i class="bi bi-box-arrow-in-left btn btn-danger">| Logout</i> </a></li>
       <footer>Logged in as <span id="userInfo"></span></footer>
    </nav>

<div class="container mt-4"><br>
    <h2 class="mb-4">Laporan Keuangan</h2>
    <!-- Elemen untuk menampilkan pegawai yang sedang login -->
    <div class="alert alert-info">
      <strong>Dibuat Oleh:</strong> <span id="currentUser">Aep samsudin</span>
    </div>
    <div class="mb-3">
      <label for="periode" class="form-label">Pilih Periode</label>
      <select id="periode" class="form-select" aria-label="Select period">
        <option value="harian">Harian</option>
        <option value="mingguan">Mingguan</option>
        <option value="bulanan" selected>Bulanan</option>
      </select>
    </div>

    <canvas id="chartKeuangan" height="100"></canvas>

    

     <!-- Begin Page Content -->
        <div class="container-fluid">
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold ">Laporan Keuangan Owner</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead class="table-dark">
                    <tr>
                      <th>No</th>
                      <th>Tanggal</th>
                      <th>Jenis Transaksi</th>
                      <th>Pemasukan (Rp)</th>
                      <th>Pengeluaran (Rp)</th>
                      <th>Laba Bersih (Rp)</th>
                      <th>Status</th> 
                      <th>Dibuat Oleh</th> 
                      <th>aksi</th>
                    </tr>
                  </thead>
                  <tbody class="table-primary">
                    <tr>
                      <td>1</td>
                      <td>21/11/2025</td>
                      <td>Penjualan</td>
                      <td>Rp200.000</td>
                      <td class="text-danger">-Rp100.000</td>
                      <td class="text-success">+Rp100.000</td>
                      <td><span class="badge text-bg-success">aktif</span></td>
                      <td>Aep samsudin</td>
                      <td class="text-center">
                        <button type="button" class="btn btn-primary"><i class="bi bi-eye text-white"></i></button>
                        <button type="button" class="btn btn-danger"><i class="bi bi-trash text-white"></i></button>
                        <button type="button" class="btn btn-warning"><i class="bi bi-printer"></i></button>

                      </td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>21/11/2025</td>
                      <td>Penjualan</td>
                      <td>Rp200.000</td>
                      <td class="text-danger">-Rp100.000</td>
                      <td class="text-success">+Rp100.000</td>
                      <td><span class="badge text-bg-success">aktif</span></td>
                      <td>Aep samsudin</td>
                      <td class="text-center">
                        <button type="button" class="btn btn-primary"><i class="bi bi-eye text-white"></i></button>
                        <button type="button" class="btn btn-danger"><i class="bi bi-trash text-white"></i></button>
                        <button type="button" class="btn btn-warning"><i class="bi bi-printer"></i></button>

                      </td>
                  
                  
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
  </div>