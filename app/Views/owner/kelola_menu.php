
      <!-- <input type="search" id="navSearch" placeholder="Cari menu..." /> -->


     <li><a class="nav-link" href="/owner/kelola_menu">Kelola Menu</a></li> 
    <li> <a class="nav-link" href="/owner/laporan_keuangan" >Laporan keuangan</a></li> 
      <li><a class="nav-link text-danger" id="logoutBtn">Logout</a></li>
</ul>
       <footer>Logged in as <span id="userInfo"></span></footer>

    </nav>

    <div class="container mt-4"><br>
    <h2 class="mb-10">Kelola Menu</h2>
    <button type="button" class="btn btn-primary mb-3" id="btnAddMenu" >Tambah Menu Baru</button>

    <table class="table table-bordered table-hover align-middle">
      <thead >
        <tr class="table-dark">
          <th>No</th>
          <th>Nama Menu</th>
          <th>Harga</th>
          <th>Stok</th>
          <th>Kategori</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>

        <tr class="table-primary">
            <td>1</td>
            <td>Rendang</td>
            <td>Rp10.000</td>
            <td>10</td>
            <td>Makanan</td>
            <td><span class="badge text-bg-success">Tersedia</span></td>
            <td>
                <button class="btn btn-sm btn-warning me-1">Ubah</button>
                <button class="btn btn-sm btn-danger">Hapus</button>
            </td>
        </tr>
        <tr class="table-primary">
            <td>1</td>
            <td>Rendang</td>
            <td>Rp10.000</td>
            <td>10</td>
            <td>Makanan</td>
            <td><span class="badge text-bg-success">Tersedia</span></td>
            <td>
                <button class="btn btn-sm btn-warning me-1">Ubah</button>
                <button class="btn btn-sm btn-danger">Hapus</button>
            </td>
        </tr>
        <tr class="table-primary">
            <td>1</td>
            <td>Rendang</td>
            <td>Rp10.000</td>
            <td>10</td>
            <td>Makanan</td>
            <td><span class="badge text-bg-success">Tersedia</span></td>
            <td>
                <button class="btn btn-sm btn-warning me-1">Ubah</button>
                <button class="btn btn-sm btn-danger">Hapus</button>
            </td>
        </tr>
        <tr class="table-primary">
            <td>1</td>
            <td>Rendang</td>
            <td>Rp10.000</td>
            <td>10</td>
            <td>Makanan</td>
            <td><span class="badge text-bg-success">Tersedia</span></td>
            <td>
                <button class="btn btn-sm btn-warning me-1">Ubah</button>
                <button class="btn btn-sm btn-danger">Hapus</button>
            </td>
        </tr>
        <tr class="table-primary">
            <td>1</td>
            <td>Rendang</td>
            <td>Rp10.000</td>
            <td>10</td>
            <td>Makanan</td>
            <td><span class="badge text-bg-success">Tersedia</span></td>
            <td>
                <button class="btn btn-sm btn-warning me-1">Ubah</button>
                <button class="btn btn-sm btn-danger">Hapus</button>
            </td>
        </tr>
      </thead>
      <tbody id="menuTableBody"></tbody>
    </table>
  </div>



  <!-- Modal Tambah/Ubah Menu -->
  <div class="modal fade" id="menuModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <form class="modal-content needs-validation" novalidate id="menuForm">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTitle">Tambah Menu</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="menuId"/>
          <div class="mb-3">
            <label class="form-label" for="menuName">Nama Menu</label>
            <input type="text" id="menuName" class="form-control" required/>
            <div class="invalid-feedback">Nama menu wajib diisi</div>
          </div>
          <div class="mb-3">
            <label class="form-label" for="menuPrice">Harga</label>
            <input type="number" id="menuPrice" class="form-control" required min="1"/>
            <div class="invalid-feedback">Masukkan harga valid</div>
          </div>
          <div class="mb-3">
            <label class="form-label" for="menuStock">Stok</label>
            <input type="number" id="menuStock" class="form-control" required min="0"/>
            <div class="invalid-feedback">Masukkan stok valid (0 ke atas)</div>
          </div>
          <div class="mb-3">
            <label class="form-label" for="menuCategory">Kategori</label>
            <select id="menuCategory" class="form-select" required>
              <option value="" disabled selected>Pilih kategori</option>
              <option value="makanan">Makanan</option>
              <option value="minuman">Minuman</option>
            </select>
            <div class="invalid-feedback">Pilih kategori menu</div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" type="submit">Simpan</button>
          <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>

