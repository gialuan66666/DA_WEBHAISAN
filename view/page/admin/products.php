<?php
$pageTitle = 'Quản lý sản phẩm';

require_once './controllers/admin/ProductController.php';

$productController = new ProductController();
$adminProducts = $productController->getAdminProducts();

require_once './view/layouts/admin/header.php';
require_once './component/notifi.php';
?>

<div class="panel">

  <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
      <h5 class="fw-bold mb-1">Danh sách sản phẩm</h5>
      <small class="text-muted">Quản lý thông tin, giá bán và tồn kho</small>
    </div>

    <a href="products/create" class="btn btn-orange rounded-pill">
      <i class="fa-solid fa-plus me-1"></i>Thêm sản phẩm
    </a>
  </div>

  <div class="row g-3 mb-4">
    <div class="col-md-5">
      <input 
        id="searchInput" 
        class="form-control" 
        placeholder="Tìm sản phẩm..."
      >
    </div>

    <div class="col-md-3">
      <select id="categoryFilter" class="form-select">
        <option value="">Tất cả danh mục</option>

        <?php
        $categories = [];

        foreach (($adminProducts ?? []) as $item) {
          $catName = $item['category_name'] ?? ($item['category'] ?? '');

          if (!empty($catName)) {
            $categories[$catName] = $catName;
          }
        }

        foreach ($categories as $cat):
        ?>
          <option value="<?= htmlspecialchars($cat) ?>">
            <?= htmlspecialchars($cat) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="col-md-3">
      <select id="statusFilter" class="form-select">
        <option value="">Tất cả trạng thái</option>
        <option value="available">Còn hàng</option>
        <option value="out_of_stock">Hết hàng</option>
        <option value="hidden">Ẩn sản phẩm</option>
      </select>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th>Ảnh</th>
          <th>Tên sản phẩm</th>
          <th>Danh mục</th>
          <th>Giá</th>
          <th>Kho</th>
          <th>Trạng thái</th>
          <th class="text-end">Thao tác</th>
        </tr>
      </thead>

      <tbody id="productTableBody">
        <?php foreach (($adminProducts ?? []) as $p): ?>

          <?php
          $name = $p['name'] ?? '';
          $category = $p['category_name'] ?? ($p['category'] ?? '');
          $status = $p['status'] ?? '';
          ?>

          <tr 
            class="product-row"
            data-name="<?= htmlspecialchars(mb_strtolower($name)) ?>"
            data-category="<?= htmlspecialchars($category) ?>"
            data-status="<?= htmlspecialchars($status) ?>"
          >
            <td>
              <img src="<?= htmlspecialchars($p['image'] ?? '') ?>" class="product-thumb">
            </td>

            <td class="fw-bold">
              <?= htmlspecialchars($name) ?>
            </td>

            <td>
              <?= htmlspecialchars($category) ?>
            </td>

            <td class="text-danger fw-bold">
              <?= number_format($p['price'] ?? 0) ?>đ
            </td>

            <td>
              <?= htmlspecialchars($p['quantity'] ?? ($p['stock'] ?? 0)) ?>
            </td>

            <td>
              <?php
              switch ($status) {
                case 'available':
                  echo '<span class="badge bg-success">Còn hàng</span>';
                  break;

                case 'out_of_stock':
                  echo '<span class="badge bg-danger">Hết hàng</span>';
                  break;

                case 'hidden':
                  echo '<span class="badge bg-secondary">Ẩn sản phẩm</span>';
                  break;

                default:
                  echo '<span class="badge bg-warning text-dark">Chưa rõ</span>';
              }
              ?>
            </td>

            <td class="text-end">
              <a 
                href="/admin/products/edit?id=<?= $p['id'] ?>" 
                class="btn btn-sm btn-outline-primary rounded-pill"
              >
                Sửa
              </a>

              <button
                type="button"
                class="btn btn-sm btn-outline-danger rounded-pill"
                data-bs-toggle="modal"
                data-bs-target="#deleteModal"
                data-id="<?= $p['id'] ?>"
                data-name="<?= htmlspecialchars($name) ?>"
                data-action="/admin/products/delete"
              >
                Xóa
              </button>
            </td>
          </tr>

        <?php endforeach; ?>

        <tr id="emptyRow" style="display: none;">
          <td colspan="7" class="text-center text-muted py-4">
            Không tìm thấy sản phẩm phù hợp
          </td>
        </tr>
      </tbody>
    </table>
  </div>

</div>

<?php require_once './component/form-delete.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const searchInput = document.getElementById('searchInput');
  const categoryFilter = document.getElementById('categoryFilter');
  const statusFilter = document.getElementById('statusFilter');
  const rows = document.querySelectorAll('.product-row');
  const emptyRow = document.getElementById('emptyRow');

  function removeVietnameseTones(str) {
    return str
      .normalize('NFD')
      .replace(/[\u0300-\u036f]/g, '')
      .replace(/đ/g, 'd')
      .replace(/Đ/g, 'D')
      .toLowerCase()
      .trim();
  }

  function filterProducts() {
    const keyword = removeVietnameseTones(searchInput.value);
    const selectedCategory = categoryFilter.value;
    const selectedStatus = statusFilter.value;

    let visibleCount = 0;

    rows.forEach(function (row) {
      const productName = removeVietnameseTones(row.dataset.name || '');
      const productCategory = row.dataset.category || '';
      const productStatus = row.dataset.status || '';

      const matchName = productName.includes(keyword);
      const matchCategory = selectedCategory === '' || productCategory === selectedCategory;
      const matchStatus = selectedStatus === '' || productStatus === selectedStatus;

      if (matchName && matchCategory && matchStatus) {
        row.style.display = '';
        visibleCount++;
      } else {
        row.style.display = 'none';
      }
    });

    emptyRow.style.display = visibleCount === 0 ? '' : 'none';
  }

  searchInput.addEventListener('input', filterProducts);
  categoryFilter.addEventListener('change', filterProducts);
  statusFilter.addEventListener('change', filterProducts);
});
</script>

<?php require_once './view/layouts/admin/footer.php'; ?>