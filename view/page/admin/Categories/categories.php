<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'config/database.php';

$db = new Database();
$pdo = $db->connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_category'])) {
    $name = $_POST['name'];
    $status = $_POST['status'];
    $product_count = $_POST['product_count'];

    $slug = $name;

    if (!empty($name)) {
        try {
            $sql = "INSERT INTO categories (name, slug, description, status) VALUES (:name, :slug, :description, :status)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':name' => $name,
                ':slug' => $slug,
                ':description' => $product_count,
                ':status' => $status
            ]);

            $_SESSION['toast'] = ['type' => 'success', 'message' => 'Thêm danh mục thành công!'];
            header('Location: /admin/categories');
            exit();
        } catch (Exception $e) {
            $_SESSION['toast'] = ['type' => 'error', 'message' => 'Lỗi: ' . $e->getMessage()];
            header('Location: /admin/categories');
            exit();
        }
    }
}

$sql = "SELECT * FROM categories ORDER BY id DESC";
$categories = $pdo->query($sql)->fetchAll();


$pageTitle = 'Quản lý danh mục';
require_once 'view/layouts/admin/header.php';

require_once 'component/notifi.php';

require_once 'component/form-delete.php';
?>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="panel">
            <h5 class="fw-bold mb-3">Thêm danh mục</h5>
            <form method="POST">
                <input type="hidden" name="add_category" value="1">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Tên danh mục</label>
                    <input class="form-control" name="name" placeholder="Nhập tên danh mục" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Mô tả</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="product_count" placeholder="Nhập mô tả danh mục">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Trạng thái</label>
                    <select class="form-control" name="status">
                        <option value="1">Hiển thị</option>
                        <option value="0">Ẩn</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-blue w-100 rounded-pill">Lưu danh mục</button>
            </form>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="panel">
            <h5 class="fw-bold mb-3">Danh sách danh mục (<?= count($categories) ?>)</h5>
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên danh mục</th>
                        <th>Mô tả</th>
                        <th>Trạng thái</th>
                        <th class="text-end">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $i => $c): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td class="fw-bold"><?= htmlspecialchars($c['name']) ?></td>
                            <td><?= htmlspecialchars(!empty($c['description']) ? $c['description'] : 'Chưa có mô tả') ?></td>
                            <td>
                                <span class="badge <?= $c['status'] == 1 ? 'bg-success' : 'bg-secondary' ?>">
                                    <?= $c['status'] == 1 ? 'Hiển thị' : 'Ẩn' ?>
                                </span>
                            </td>
                            <td class="text-end">
                                <div class="d-flex gap-2 justify-content-end">
                                    <button class="btn btn-sm btn-outline-primary rounded-pill edit-btn"
                                        data-id="<?= $c['id'] ?>"
                                        data-name="<?= htmlspecialchars($c['name']) ?>"
                                        data-count="<?= htmlspecialchars($c['description'] ?? '') ?>"
                                        data-status="<?= $c['status'] ?>">
                                        Sửa
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger rounded-pill"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal"
                                        data-id="<?= $c['id'] ?>"
                                        data-name="<?= htmlspecialchars($c['name']) ?>"
                                        data-action="/admin/categories/delete">
                                        Xóa
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4">
            <form method="POST" action="/admin/categories/update">
                <input type="hidden" name="id" id="edit_id">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Sửa danh mục</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tên danh mục</label>
                        <input type="text" class="form-control" name="name" id="edit_name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Mô tả</label>
                        <input type="text" class="form-control" name="product_count" id="edit_product_count">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Trạng thái</label>
                        <select class="form-control" name="status" id="edit_status">
                            <option value="1">Hiển thị</option>
                            <option value="0">Ẩn</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary rounded-pill">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.getElementById('edit_id').value = this.dataset.id;
                document.getElementById('edit_name').value = this.dataset.name;
                document.getElementById('edit_product_count').value = this.dataset.count;
                document.getElementById('edit_status').value = this.dataset.status;
                new bootstrap.Modal(document.getElementById('editModal')).show();
            });
        });
    });
</script>
<?php require_once './view/layouts/admin/footer.php'; ?>