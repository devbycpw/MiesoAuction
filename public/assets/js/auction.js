document.addEventListener("DOMContentLoaded", () => {

    // ==============================
    // 1. COUNTDOWN TIMER
    // ==============================
    const timers = document.querySelectorAll('.countdown-timer');

    timers.forEach(timer => {
        const endTime = new Date(timer.dataset.end).getTime();

        const interval = setInterval(() => {
            const now = Date.now();
            const distance = endTime - now;

            if (distance <= 0) {
                timer.textContent = "Auction Ended";
                clearInterval(interval);
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            timer.textContent = `${days}d ${hours}h ${minutes}m ${seconds}s`;
        }, 1000);
    });

    // ==============================
    // 2. AUTO UPDATE CURRENT PRICE
    // ==============================
    function updatePrices() {
        const priceElements = document.querySelectorAll('.current-price');
        if (priceElements.length === 0) return;

        priceElements.forEach(el => {
            const id = el.dataset.id;

            fetch(`${BASE_URL}auction/api/current-price/${id}`)
                .then(res => res.json())
                .then(data => {
                    if (data.current_price) {
                        el.textContent = parseFloat(data.current_price).toLocaleString();
                    }
                })
                .catch(err => console.error("Price update error:", err));
        });
    }

    // Update setiap 2 detik
    setInterval(updatePrices, 2000);

});
