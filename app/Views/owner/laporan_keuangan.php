
     
      <!-- <input type="search" id="navSearch" placeholder="Cari menu..." /> -->
      <a class="nav-link" href="/owner/kelola_menu">Kelola Menu</a>
      <a class="nav-link" href="/owner/laporan_keuangan" >Laporan keuangan</a>
      <a class="nav-link text-danger" id="logoutBtn">Logout</a>
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

    <h4 class="mt-5">Detail Laporan</h4>
    <table class="table table-striped">
      <thead>
        <tr  class="table-dark">
          <th>No</th>
          <th>Tanggal</th>
          <th>Jenis Transaksi</th>
          <th>Pemasukan (Rp)</th>
          <th>Pengeluaran (Rp)</th>
          <th>Laba Bersih (Rp)</th>
          <th>Status</th> 
          <th>Dibuat Oleh</th> 
        </tr>

        <tr>
            <td>1</td>
            <td>21/11/2025</td>
            <td>Penjualan</td>
            <td>Rp200.000</td>
            <td class="text-danger">-Rp100.000</td>
            <td class="text-success">+Rp100.000</td>
            <td><span class="badge text-bg-success">aktif</span></td>
            <td>Aep samsudin</td>
        </tr>
        <tr>
            <td>1</td>
            <td>21/11/2025</td>
            <td>Penjualan</td>
            <td>Rp200.000</td>
            <td class="text-danger">-Rp100.000</td>
            <td class="text-success">+Rp100.000</td>
            <td><span class="badge text-bg-success">aktif</span></td>
            <td>Aep samsudin</td>
        </tr>
        <tr>
            <td>1</td>
            <td>21/11/2025</td>
            <td>Penjualan</td>
            <td>Rp200.000</td>
            <td class="text-danger">-Rp100.000</td>
            <td class="text-success">+Rp100.000</td>
            <td><span class="badge text-bg-success">aktif</span></td>
            <td>Aep samsudin</td>
        </tr>
        <tr>
            <td>1</td>
            <td>21/11/2025</td>
            <td>Penjualan</td>
            <td>Rp200.000</td>
            <td class="text-danger">-Rp100.000</td>
            <td class="text-success">+Rp100.000</td>
            <td><span class="badge text-bg-success">aktif</span></td>
            <td>Aep samsudin</td>
        </tr>
        <tr>
            <td>1</td>
            <td>21/11/2025</td>
            <td>Penjualan</td>
            <td>Rp200.000</td>
            <td class="text-danger">-Rp100.000</td>
            <td class="text-success">+Rp100.000</td>
            <td><span class="badge text-bg-success">aktif</span></td>
            <td>Aep samsudin</td>
        </tr>
        <tr>
            <td>1</td>
            <td>21/11/2025</td>
            <td>Penjualan</td>
            <td>Rp200.000</td>
            <td class="text-danger">-Rp100.000</td>
            <td class="text-success">+Rp100.000</td>
            <td><span class="badge text-bg-success">aktif</span></td>
            <td>Aep samsudin</td>
        </tr>
        <tr>
            <td>1</td>
            <td>21/11/2025</td>
            <td>Penjualan</td>
            <td>Rp200.000</td>
            <td class="text-danger">-Rp100.000</td>
            <td class="text-success">+Rp100.000</td>
            <td><span class="badge text-bg-success">aktif</span></td>
            <td>Aep samsudin</td>
        </tr>
        <tr>
            <td>1</td>
            <td>21/11/2025</td>
            <td>Penjualan</td>
            <td>Rp200.000</td>
            <td class="text-danger">-Rp100.000</td>
            <td class="text-success">+Rp100.000</td>
            <td><span class="badge text-bg-success">aktif</span></td>
            <td>Aep samsudin</td>
        </tr>
      </thead>
      <tbody id="laporanBody"></tbody>
    </table>
  </div>