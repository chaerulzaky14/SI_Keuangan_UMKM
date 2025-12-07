

  </div>
  <script>
    
     const sidebar = document.getElementById('sidebar');
  const toggleSidebar = document.getElementById('toggleSidebar');

  toggleSidebar.addEventListener('click', () => {
      sidebar.classList.toggle('open');
  });

  

  </script>

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
  </body>
</html>