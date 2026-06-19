const hoursEl = document.querySelector('.hours');
const minutesEl = document.querySelector('.minutes');
const secondsEl = document.querySelector('.seconds');
let totalSeconds = 2 * 60 * 60 + 18 * 60 + 45;
function updateCountdown() {
    if (!hoursEl || !minutesEl || !secondsEl) return;
    const h = Math.floor(totalSeconds / 3600);
    const m = Math.floor((totalSeconds % 3600) / 60);
    const s = totalSeconds % 60;
    hoursEl.textContent = String(h).padStart(2, '0');
    minutesEl.textContent = String(m).padStart(2, '0');
    secondsEl.textContent = String(s).padStart(2, '0');
    if (totalSeconds > 0) totalSeconds--;
}
setInterval(updateCountdown, 1000);
updateCountdown();

document.querySelectorAll('.quantity-box').forEach(box => {
    if (box.dataset.manualQty === 'true') return;
    const input = box.querySelector('.qty-input');
    const plus = box.querySelector('.plus');
    const minus = box.querySelector('.minus');
    if (plus) { plus.addEventListener('click', () => input.value = Number(input.value || 1) + 1); }
    if (minus) { minus.addEventListener('click', () => input.value = Math.max(1, Number(input.value || 1) - 1)); }
});
