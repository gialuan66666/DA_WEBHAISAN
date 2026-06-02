<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4">

            <div class="modal-header">
                <h5 class="modal-title fw-bold">Xác nhận xóa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                Bạn có chắc muốn xóa
                <strong id="deleteItemName"></strong>
                không?
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal">
                    Hủy
                </button>

                <form id="deleteForm" method="POST">
                    <input type="hidden" name="id" id="deleteItemId">

                    <button type="submit" class="btn btn-danger rounded-pill">
                        Xóa
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const deleteModal = document.getElementById("deleteModal");

    if (!deleteModal) return;

    deleteModal.addEventListener("show.bs.modal", function (event) {
        const button = event.relatedTarget;

        const id = button.getAttribute("data-id");
        const name = button.getAttribute("data-name");
        const action = button.getAttribute("data-action");

        document.getElementById("deleteItemId").value = id;
        document.getElementById("deleteItemName").textContent = name;
        document.getElementById("deleteForm").setAttribute("action", action);
    });
});
</script>