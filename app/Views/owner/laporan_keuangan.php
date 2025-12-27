

<div class="container mt-4"><br>
    <h2 class="mb-4">Laporan Keuangan</h2>
    <!-- Elemen untuk menampilkan pegawai yang sedang login -->
    <div class="alert alert-info">
      <strong>Dibuat Oleh:</strong> <span id="currentUser">Kelompok 6</span>
    </div>
    <div class="mb-3">
      <label for="periode" class="form-label">Pilih Periode</label>
    <select id="periode" class="form-select">
        <option value="harian" <?= ($periode == 'harian') ? 'selected' : '' ?>>Harian</option>
        <option value="mingguan" <?= ($periode == 'mingguan') ? 'selected' : '' ?>>Mingguan</option>
        <option value="bulanan" <?= ($periode == 'bulanan') ? 'selected' : '' ?>>Bulanan</option>
    </select>

    <script>
    document.getElementById('periode').addEventListener('change', function () {
        const periode = this.value;
        window.location.href = `?periode=${periode}`;
    });
    </script>
    

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

    
<div class="card shadow mb-4">
    <div class="card-body">
        <canvas id="grafikLaba" height="120"></canvas>
    </div>
</div>
    

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
    <th>Pemasukan (Rp)</th>
    <th>Pengeluaran (Rp)</th>
    <th>Laba Bersih (Rp)</th>
    <th>Status</th>
    <th>Dibuat Oleh</th>
</tr>
</thead>
<tbody>
<?php if (!empty($laporan)) : ?>
<?php $no = 1; foreach ($laporan as $row) : ?>
<tr>
    <td><?= $no++; ?></td>

    <td><?= date('d/m/Y', strtotime($row['tanggal'])) ?></td>

    <td>
        Rp <?= number_format($row['pemasukan'], 0, ',', '.') ?>
    </td>

    <td class="text-danger">
        - Rp <?= number_format($row['pengeluaran'], 0, ',', '.') ?>
    </td>

    <td class="<?= $row['laba'] >= 0 ? 'text-success' : 'text-danger' ?>">
        <?= $row['laba'] >= 0 ? '+' : '-' ?>
        Rp <?= number_format(abs($row['laba']), 0, ',', '.') ?>
    </td>

    <td>
        <span class="badge text-bg-success">aktif</span>
    </td>

    <td>Kelompok 6</td>

</tr>
<?php endforeach; ?>
<?php else : ?>
<tr>
    <td colspan="8" class="text-center">Data tidak tersedia</td>
</tr>
<?php endif; ?>
</tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
  </div>

  <script>
document.addEventListener("DOMContentLoaded", function () {

    const laporan = <?= json_encode(array_values($laporan)) ?>;

    console.log(laporan); // ⬅️ PENTING: cek di Console

    if (!laporan.length) {
        console.warn("Data laporan kosong");
        return;
    }

    const labels = laporan.map(item => {
        const d = new Date(item.tanggal);
        return d.toLocaleDateString('id-ID');
    });

    const dataLaba = laporan.map(item => item.laba);

    const ctx = document.getElementById('grafikLaba');

    if (!ctx) {
        console.error("Canvas tidak ditemukan");
        return;
    }

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Laba Bersih (Rp)',
                data: dataLaba,
                borderColor: '#198754',
                backgroundColor: 'rgba(25, 135, 84, 0.2)',
                borderWidth: 2,
                fill: true,
                tension: 0.4,
                pointRadius: 5
            }]
        },
        options: {
            responsive: true,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: ctx => 'Rp ' + ctx.parsed.y.toLocaleString('id-ID')
                    }
                }
            },
            scales: {
                y: {
                    ticks: {
                        callback: value => 'Rp ' + value.toLocaleString('id-ID')
                    }
                }
            }
        }
    });
});
</script>

  <script>
  const BASE_EXPORT_PDF  = "<?= base_url('owner/laporan/export/pdf') ?>";
  const BASE_EXPORT_WORD = "<?= base_url('owner/laporan/export/word') ?>";

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

<script>
$(document).ready(function () {
    const table = $('#dataTable').DataTable({
        searching: true
    });

    // Override search agar hanya kolom tanggal
    $('#dataTable_filter input')
        .off() // matikan search default
        .on('keyup change', function () {
            table
                .columns(1) // kolom TANGGAL
                .search(this.value)
                .draw();
        });
});
</script>
