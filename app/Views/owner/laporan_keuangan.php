

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
    <!-- Export / Download -->
    <div class="mb-3 d-flex gap-2 flex-wrap align-items-center">
      <div class="small text-muted">
        Export berdasarkan periode yang dipilih (tanggal otomatis).
      </div>

      <a id="btnExportPdf" class="btn btn-outline-danger btn-sm" href="#" target="_blank" rel="noopener">
        Download PDF
      </a>

      <a id="btnExportWord" class="btn btn-outline-primary btn-sm" href="#" target="_blank" rel="noopener">
        Download Word
      </a>
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
                        
                               <button type="button" class="btn btn-success"><i class="bi bi-pencil-square text-white"></i></button>
                        <button type="button" class="btn btn-danger"><i class="bi bi-trash text-white"></i></button>
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
                               <button type="button" class="btn btn-success"><i class="bi bi-pencil-square text-white"></i></button>
                        <button type="button" class="btn btn-danger"><i class="bi bi-trash text-white"></i></button>

                      </td>
                  
                  
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
  </div>
  <script>
  const BASE_EXPORT_PDF  = "/owner/laporan/export/pdf";
  const BASE_EXPORT_WORD = "/owner/laporan/export/word";

  function formatDateYYYYMMDD(d) {
    const yyyy = d.getFullYear();
    const mm = String(d.getMonth() + 1).padStart(2, "0");
    const dd = String(d.getDate()).padStart(2, "0");
    return `${yyyy}-${mm}-${dd}`;
  }

  function getRangeByPeriode(periode) {
    const now = new Date();

    const end = new Date(now.getFullYear(), now.getMonth(), now.getDate());
    let start = new Date(end);

    if (periode === "harian") {
      start = new Date(end);
    } else if (periode === "mingguan") {
      start = new Date(end);
      start.setDate(start.getDate() - 6);
    } else {
      start = new Date(end.getFullYear(), end.getMonth(), 1);
    }

    return {
      start: formatDateYYYYMMDD(start),
      end: formatDateYYYYMMDD(end),
    };
  }

  function updateExportLinks() {
    const periodeEl = document.getElementById("periode");
    const pdfEl = document.getElementById("btnExportPdf");
    const wordEl = document.getElementById("btnExportWord");
    if (!periodeEl || !pdfEl || !wordEl) return;

    const periode = periodeEl.value || "bulanan";
    const range = getRangeByPeriode(periode);

    const qs = `?start=${encodeURIComponent(range.start)}&end=${encodeURIComponent(range.end)}`;
    pdfEl.href = BASE_EXPORT_PDF + qs;
    wordEl.href = BASE_EXPORT_WORD + qs;
  }

  document.addEventListener("DOMContentLoaded", () => {
    updateExportLinks();
    const periodeEl = document.getElementById("periode");
    if (periodeEl) {
      periodeEl.addEventListener("change", updateExportLinks);
    }
  });
</script>
