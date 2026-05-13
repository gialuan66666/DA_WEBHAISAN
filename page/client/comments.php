<?php
if (!isset($_SESSION)) {
    session_start();
}
$allComments = array_merge($comments, $_SESSION['comments']);
?>

<div style="margin-top:40px; display:flex; justify-content:center;">
    
    <div style="
        width:100%;
        max-width:700px;
        padding:25px;
        border:1px solid #ddd;
        border-radius:12px;
        background:#fff;
        box-shadow:0 4px 12px rgba(0,0,0,0.08);
    ">

        <h4 style="text-align:center; margin-bottom:20px; color:teal;">
            💬 Bình luận sản phẩm
        </h4>

       
        <form method="POST" action="funtion/comments.php">

            <input type="hidden" name="product_id" value="<?= $ProductDetail['id'] ?>">

            <input type="text"
                value="<?= $_SESSION['user']['username'] ?? 'Khách' ?>"
                readonly
                style="
                    width:100%;
                    padding:10px;
                    margin-bottom:12px;
                    background:#f5f5f5;
                    border-radius:8px;
                    border:1px solid #ddd;
                ">

            <textarea name="content"
                placeholder="Viết bình luận..."
                required
                style="
                    width:100%;
                    height:100px;
                    padding:10px;
                    margin-bottom:12px;
                    border-radius:8px;
                    border:1px solid #ddd;
                    resize:none;
                "></textarea>

            <div style="display:flex; gap:10px; align-items:center;">

                <select name="rating" style="
                    padding:10px;
                    border-radius:8px;
                    border:1px solid #ddd;
                    flex:1;
                ">
                    <option value="5">⭐⭐⭐⭐⭐</option>
                    <option value="4">⭐⭐⭐⭐</option>
                    <option value="3">⭐⭐⭐</option>
                    <option value="2">⭐⭐</option>
                    <option value="1">⭐</option>
                </select>

                <button type="submit" name="send_comment"
                    style="
                        background:teal;
                        color:#fff;
                        padding:10px 20px;
                        border:none;
                        border-radius:8px;
                        cursor:pointer;
                        font-weight:bold;
                    ">
                    Gửi
                </button>
            </div>

        </form>

        
        <div style="margin-top:25px;">
            <h5 style="margin-bottom:10px;">📋 Danh sách bình luận</h5>

            <?php
            if (!empty($allComments)) {
                foreach ($allComments as $cmt) {

                    if ($cmt['product_id'] == $ProductDetail['id']) {
            ?>
                        <div style="
                            border-bottom:1px solid #eee;
                            padding:12px 0;
                        ">
                            <strong><?= $cmt['username'] ?></strong>
                            <span style="font-size:12px; color:#999;">
                                (<?= $cmt['time'] ?>)
                            </span>

                            <div style="color:#f5a623;">
                                <?php for ($i = 0; $i < $cmt['rating']; $i++): ?>
                                    ⭐
                                <?php endfor; ?>
                            </div>

                            <p style="margin:5px 0;">
                                <?= htmlspecialchars($cmt['content']) ?>
                            </p>
                        </div>
            <?php
                    }
                }
            } else {
                echo "<p>Chưa có bình luận</p>";
            }
            ?>
        </div>

    </div>

</div>