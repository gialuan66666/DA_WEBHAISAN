<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$toast = $_SESSION['toast'] ?? null;
unset($_SESSION['toast']);

$type = $toast['type'] ?? '';
$message = $toast['message'] ?? '';

$config = [
    'success' => [
        'icon' => 'fa-check',
        'title' => 'Thành công',
        'class' => 'toast-success'
    ],
    'error' => [
        'icon' => 'fa-xmark',
        'title' => 'Lỗi',
        'class' => 'toast-error'
    ],
    'warning' => [
        'icon' => 'fa-triangle-exclamation',
        'title' => 'Cảnh báo',
        'class' => 'toast-warning'
    ],
];

$current = $config[$type] ?? null;
?>

<?php if ($current && $message): ?>
<div class="custom-toast-wrapper">
    <div class="custom-toast <?= $current['class'] ?>" id="customToast">
        <div class="toast-icon">
            <i class="fa-solid <?= $current['icon'] ?>"></i>
        </div>

        <div class="toast-content">
            <strong><?= htmlspecialchars($current['title']) ?></strong>
            <p><?= htmlspecialchars($message) ?></p>
        </div>

        <button class="toast-close" onclick="closeCustomToast()">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <div class="toast-progress"></div>
    </div>
</div>

<style>
.custom-toast-wrapper {
    position: fixed;
    top: 24px;
    right: 24px;
    z-index: 99999;
}

.custom-toast {
    position: relative;
    width: 380px;
    min-height: 92px;
    padding: 20px 56px 20px 22px;
    border-radius: 22px;
    display: flex;
    align-items: center;
    gap: 16px;
    color: #fff;
    overflow: hidden;
    animation: toastSlideIn .45s cubic-bezier(.2,.8,.2,1);
    box-shadow: 0 24px 70px rgba(0,0,0,.28);
    backdrop-filter: blur(20px);
}

.custom-toast::before {
    content: "";
    position: absolute;
    inset: 0;
    opacity: .95;
    z-index: -1;
}

.toast-success::before {
    background:
        radial-gradient(circle at 15% 50%, rgba(34,197,94,.28), transparent 35%),
        linear-gradient(135deg, #202020, #111);
}

.toast-error::before {
    background:
        radial-gradient(circle at 15% 50%, rgba(239,68,68,.32), transparent 35%),
        linear-gradient(135deg, #202020, #111);
}

.toast-warning::before {
    background:
        radial-gradient(circle at 15% 50%, rgba(245,158,11,.35), transparent 35%),
        linear-gradient(135deg, #202020, #111);
}

.toast-icon {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    display: grid;
    place-items: center;
    flex-shrink: 0;
}

.toast-success .toast-icon {
    background: rgba(34,197,94,.18);
    color: #4ade80;
    box-shadow: 0 0 0 10px rgba(34,197,94,.08);
}

.toast-error .toast-icon {
    background: rgba(239,68,68,.18);
    color: #f87171;
    box-shadow: 0 0 0 10px rgba(239,68,68,.08);
}

.toast-warning .toast-icon {
    background: rgba(245,158,11,.18);
    color: #fbbf24;
    box-shadow: 0 0 0 10px rgba(245,158,11,.08);
}

.toast-content strong {
    display: block;
    font-size: 17px;
    font-weight: 800;
    margin-bottom: 4px;
}

.toast-content p {
    margin: 0;
    font-size: 15px;
    line-height: 1.35;
    color: rgba(255,255,255,.82);
}

.toast-close {
    position: absolute;
    top: 20px;
    right: 20px;
    border: 0;
    background: transparent;
    color: rgba(255,255,255,.75);
    font-size: 20px;
    cursor: pointer;
    transition: .2s;
}

.toast-close:hover {
    color: #fff;
    transform: rotate(90deg);
}

.toast-progress {
    position: absolute;
    left: 0;
    bottom: 0;
    height: 3px;
    width: 100%;
    animation: toastProgress 3.2s linear forwards;
}

.toast-success .toast-progress {
    background: #22c55e;
}

.toast-error .toast-progress {
    background: #ef4444;
}

.toast-warning .toast-progress {
    background: #f59e0b;
}

.custom-toast.hide {
    animation: toastSlideOut .35s ease forwards;
}

@keyframes toastSlideIn {
    from {
        opacity: 0;
        transform: translateX(120%) scale(.96);
    }
    to {
        opacity: 1;
        transform: translateX(0) scale(1);
    }
}

@keyframes toastSlideOut {
    to {
        opacity: 0;
        transform: translateX(120%) scale(.96);
    }
}

@keyframes toastProgress {
    from {
        width: 100%;
    }
    to {
        width: 0%;
    }
}

@media (max-width: 576px) {
    .custom-toast-wrapper {
        left: 16px;
        right: 16px;
        top: 16px;
    }

    .custom-toast {
        width: 100%;
    }
}
</style>

<script>
function closeCustomToast() {
    const toast = document.getElementById('customToast');
    if (!toast) return;

    toast.classList.add('hide');

    setTimeout(() => {
        toast.remove();
    }, 350);
}

setTimeout(() => {
    closeCustomToast();
}, 3200);
</script>
<?php endif; ?>
