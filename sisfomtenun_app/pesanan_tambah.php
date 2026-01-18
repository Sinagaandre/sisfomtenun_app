<?php
include 'config.php';
include 'header.php';
?>

<div class="fade-in">
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h2 class="page-title">Tambah Pesanan Baru</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="pesanan.php">Pesanan Tenun</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                </ol>
            </nav>
        </div>
        <a href="pesanan.php" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i> Kembali
        </a>
    </div>

    <form action="pesanan_proses.php" method="POST" id="formPesanan">
        <input type="hidden" name="aksi" value="tambah">
        
        <div class="row">
            <!-- Customer Info -->
            <div class="col-md-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Data Pelanggan</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Pesanan</label>
                            <input type="date" class="form-control" name="tanggal_pesanan" value="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pilih Customer</label>
                            <select class="form-select" name="id_customers" required>
                                <option value="">-- Pilih Customer --</option>
                                <?php
                                $sql_c = "SELECT * FROM customers ORDER BY nama_customers ASC";
                                $res_c = $conn->query($sql_c);
                                while($c = $res_c->fetch_assoc()) {
                                    echo "<option value='".$c['id_customers']."'>".$c['nama_customers']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status Pesanan</label>
                            <select class="form-select" name="status_pesanan" required>
                                <option value="proses">Proses</option>
                                <option value="selesai">Selesai</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="col-md-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Detail Pesanan</h5>
                        <button type="button" class="btn btn-sm btn-success" id="addItemBtn">
                            <i class="fas fa-plus me-1"></i> Tambah Item
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="itemsTable">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th width="100">Harga</th>
                                        <th width="100">Qty</th>
                                        <th width="150">Subtotal</th>
                                        <th width="50">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Items will be added here via JS -->
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3" class="text-end">Total Harga:</th>
                                        <th colspan="2">
                                            <input type="text" class="form-control" id="grandTotalDisplay" readonly value="Rp 0">
                                            <input type="hidden" name="total_harga" id="grandTotal" value="0">
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary btn-lg"><i class="fas fa-save me-2"></i> Simpan Pesanan</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Product Data for JS -->
<script>
// Get products from PHP
const products = [
<?php
$sql_prod = "SELECT * FROM product_tenun ORDER BY nama_product ASC";
$res_prod = $conn->query($sql_prod);
while($p = $res_prod->fetch_assoc()) {
    echo "{id: ".$p['id_product'].", name: '".addslashes($p['nama_product'])."', price: ".$p['harga']."},";
}
?>
];

document.addEventListener('DOMContentLoaded', function() {
    const tableBody = document.querySelector('#itemsTable tbody');
    const addItemBtn = document.getElementById('addItemBtn');
    
    // Function to add new row
    function addRow() {
        const rowId = Date.now();
        let options = '<option value="">-- Pilih Produk --</option>';
        products.forEach(p => {
            options += `<option value="${p.id}" data-price="${p.price}">${p.name} - Rp ${new Intl.NumberFormat('id-ID').format(p.price)}</option>`;
        });

        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>
                <select class="form-select product-select" name="items[${rowId}][id_product]" required>
                    ${options}
                </select>
                <input type="hidden" class="price-input" name="items[${rowId}][harga_satuan]">
            </td>
            <td>
                <input type="text" class="form-control price-display" readonly>
            </td>
            <td>
                <input type="number" class="form-control qty-input" name="items[${rowId}][jumlah]" min="1" value="1" required>
            </td>
            <td>
                <input type="text" class="form-control subtotal-display" readonly>
                <input type="hidden" class="subtotal-input" name="items[${rowId}][subtotal]">
            </td>
            <td>
                <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-trash"></i></button>
            </td>
        `;
        tableBody.appendChild(tr);
        
        // Add event listeners for this row
        const select = tr.querySelector('.product-select');
        const qtyInput = tr.querySelector('.qty-input');
        const removeBtn = tr.querySelector('.remove-row');
        
        select.addEventListener('change', function() {
            const option = this.options[this.selectedIndex];
            const price = option.getAttribute('data-price') || 0;
            tr.querySelector('.price-input').value = price;
            tr.querySelector('.price-display').value = new Intl.NumberFormat('id-ID').format(price);
            calculateRow(tr);
        });
        
        qtyInput.addEventListener('input', function() {
            calculateRow(tr);
        });
        
        removeBtn.addEventListener('click', function() {
            tr.remove();
            calculateGrandTotal();
        });
    }
    
    function calculateRow(tr) {
        const price = parseFloat(tr.querySelector('.price-input').value) || 0;
        const qty = parseInt(tr.querySelector('.qty-input').value) || 0;
        const subtotal = price * qty;
        
        tr.querySelector('.subtotal-display').value = new Intl.NumberFormat('id-ID').format(subtotal);
        tr.querySelector('.subtotal-input').value = subtotal;
        
        calculateGrandTotal();
    }
    
    function calculateGrandTotal() {
        let total = 0;
        document.querySelectorAll('.subtotal-input').forEach(input => {
            total += parseFloat(input.value) || 0;
        });
        
        document.getElementById('grandTotalDisplay').value = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
        document.getElementById('grandTotal').value = total;
    }
    
    // Add initial row
    addItemBtn.addEventListener('click', addRow);
    addRow(); // Add one row by default
});
</script>

<?php include 'footer.php'; ?>
