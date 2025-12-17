

    <div class="container mt-4"><br>

    


          <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- tombol tambah data -->
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
               Tambah Menu
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
                            <?php $no=1; foreach($menu as $m): ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $m['nama_menu'] ?></td>
                        <td><?= $m['harga'] ?></td>
                        <td><?= $m['stok'] ?></td>
                        <td><?= $m['kategori'] ?></td>
                        <td>
                          <?php if($m['stok'] > 0): ?>
                              <span class="badge bg-success">Tersedia</span>
                          <?php else: ?>
                              <span class="badge bg-danger">Habis</span>
                          <?php endif; ?>
                        </td>
                        <td>
                            <button class="btn btn-success btnEdit"
                                data-id="<?= $m['id_menu'] ?>"
                                data-nama="<?= $m['nama_menu'] ?>"
                                data-harga="<?= $m['harga'] ?>"
                                data-stok="<?= $m['stok'] ?>"
                                data-kategori="<?= $m['kategori'] ?>"
                            ><i class="bi bi-pencil-square text-white"></i></button>

                            <button class="btn btn-danger btnDelete"
                                data-id="<?= $m['id_menu'] ?>"
                            ><i class="bi bi-trash text-white"></i></button>
                        </td>
                      </tr>
                    <?php endforeach ?>
                  
                  </tbody>
                </table>
              </div>
            </div>
            </div>
        </div>
        <!-- /.container-fluid -->




         <!-- Modal Tambah/Ubah Menu -->
<div class="modal fade" id="addModal">
  <div class="modal-dialog">
    <div class="modal-content">

                <form action="kelola_menu/save" method="post">

              <div class="modal-header">
                <h5 class="modal-title">Tambah Menu</h5>
              </div>

              <div cl ass="modal-body">
                
                <div class="mb-3">
                  <label>Nama Menu</label>
                  <input type="text" name="nama_menu" class="form-control">
                </div>

                <div class="mb-3">
                  <label>Harga</label>
                  <input type="number" name="harga" class="form-control">
                </div>

                <div class="mb-3">
                  <label>Stok</label>
                  <input type="number" name="stok" class="form-control">
                </div>

                <div class="mb-3">
                  <label>Kategori</label>
                    <select id="menuCategory" name="kategori" class="form-select" required>
                    <option value="" disabled selected>Pilih kategori</option>
                    <option value="makanan">Makanan</option>
                    <option value="minuman">Minuman</option>
                  </select>
                </div>

          

                  <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Simpan</button>
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>        
                  </div>

                    </form>

              </div>
            </div>
        </div>
    </div>

    

  








<div class="modal fade" id="editModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <form id="formEdit" action="" method="post">

        <div class="modal-header">
          <h5 class="modal-title">Edit Menu</h5>
        </div>

        <div class="modal-body">

          <input type="hidden" id="edit_id" name="id_menu">

          <div class="mb-3">
            <label>Nama Menu</label>
            <input type="text" id="edit_nama" name="nama_menu" class="form-control">
          </div>

          <div class="mb-3">
            <label>Harga</label>
            <input type="number" id="edit_harga" name="harga" class="form-control">
          </div>

          <div class="mb-3">
            <label>Stok</label>
            <input type="number" id="edit_stok" name="stok" class="form-control">
          </div>

          <div class="mb-3">
            <label>Kategori</label>
             <select id="edit_kategori" name="kategori" class="form-select" required>
              <option value="" disabled selected>Pilih kategori</option>
              <option value="makanan">Makanan</option>
              <option value="minuman">Minuman</option>
            </select>
          </div>

        </div>

        <div class="modal-footer">
          <button class="btn btn-success">Update</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

        </div>

      </form>

    </div>
  </div>
</div>
   






  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>

      
$(document).ready(function() {

    // ================= EDIT ==================
    $('.btnEdit').on('click', function() {

        $('#edit_id').val($(this).data('id'));
        $('#edit_nama').val($(this).data('nama'));
        $('#edit_harga').val($(this).data('harga'));
        $('#edit_stok').val($(this).data('stok'));
        $('#edit_kategori').val($(this).data('kategori'));

        
        $('#formEdit').attr('action', '/owner/update/' + $(this).data('id'));
       let modal = new bootstrap.Modal(document.getElementById('editModal'));
      modal.show();
      

    });


    // ================= DELETE ==================
    $('.btnDelete').on('click', function() {

        let id = $(this).data('id');

        Swal.fire({
            title: "Hapus Menu?",
            text: "Data tidak bisa dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, hapus!"
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: "/owner/delete/" + id,
                    type: "GET",
                    success: function() {
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil!",
                            text: "Menu telah dihapus",
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            location.reload();
                        });
                    }
                });

            }
        });

    });

});

</script>


<?php if (session()->getFlashdata('success')) : ?>
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '<?= session()->getFlashdata('success'); ?>'
    });
</script>
<?php endif; ?>



  

