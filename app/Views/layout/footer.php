

  </div>
  <script>
    
     const sidebar = document.getElementById('sidebar');
  const toggleSidebar = document.getElementById('toggleSidebar');

  toggleSidebar.addEventListener('click', () => {
      sidebar.classList.toggle('open');
  });

  

  </script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="<?= base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js')  ?>"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= base_url('assets/js/sb-admin-2.min.js')  ?>"></script>

  <!-- Page level plugins -->
<script src="<?= base_url('assets/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/datatables/dataTables.bootstrap4.min.js') ?>"></script>

  <!-- Page level custom scripts -->
  <script src="<?=  base_url('assets/js/demo/datatables-demo.js') ?>"></script>

  <!-- Modal Logout -->
  <div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content text-center p-4">

        <div class="text-danger fs-1 mb-3">
          <i class="bi bi-x-circle-fill"></i>
        </div>

        <h4 class="mb-2">Logout?</h4>
        <p class="text-muted mb-4">Apakah kamu yakin ingin keluar?</p>

        <div class="d-flex justify-content-center gap-3">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <a href="<?= base_url(''); ?>" class="btn btn-danger">Ya, Keluar</a>
        </div>

      </div>
    </div>
  </div>

  </body>
</html>