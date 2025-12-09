

    <div class="container mt-4"><br>

    


          <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- tombol tambah data -->
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#menuModal">
              Tambah Menu Baru
            </button>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold ">Data Kelola Menu</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead class="table-dark">
                    <tr>
                      <th>No</th>
                      <th>Nama menu</th>
                      <th>Harga</th>
                      <th>Stok</th>
                      <th>Kategori</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody class="table-primary">
                    <tr>
                      <td>1</td>
                      <td>System Architect</td>
                      <td>Edinburgh</td>
                      <td>61</td>
                      <td>2011/04/25</td>
                      <td><span class="badge text-bg-success">Tersedia</span></td>
                      <td class="text-center">
                         <button type="button" class="btn btn-success"><i class="bi bi-pencil-square text-white"></i></button>
                        <button type="button" class="btn btn-danger"><i class="bi bi-trash text-white"></i></button>
                        <button type="button" class="btn btn-primary"><i class="bi bi-eye text-white"></i></button>
                      </td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Accountant</td>
                      <td>Tokyo</td>
                      <td>63</td>
                      <td>2011/07/25</td>
                      <td><span class="badge text-bg-success">Tersedia</span></td>
                      <td class="text-center">
                        <button type="button" class="btn btn-success"><i class="bi bi-pencil-square text-white"></i></button>
                        <button type="button" class="btn btn-danger"><i class="bi bi-trash text-white"></i></button>
                        <button type="button" class="btn btn-primary"><i class="bi bi-eye text-white"></i></button>
                      </td>
                  
                  
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->




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

  </div>



 



  

