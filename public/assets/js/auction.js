document.addEventListener("DOMContentLoaded", function() {

    const timers = document.querySelectorAll('.countdown-timer');

    timers.forEach(timer => {
        const endTime = new Date(timer.dataset.end).getTime();

        const interval = setInterval(() => {
            const now = new Date().getTime();
            const distance = endTime - now;

            if (distance <= 0) {
                timer.innerHTML = "Auction Ended";
                clearInterval(interval);
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            timer.innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s`;
        }, 1000);
    });

});

document.addEventListener("DOMContentLoaded", function() {
    function updatePrices() {
        document.querySelectorAll('.current-price').forEach(el => {
            const id = el.dataset.id;

            fetch(`http://localhost/auction/api/current-price/${id}`)
                .then(res => res.json())
                .then(data => {
                    el.innerHTML = parseFloat(data.current_price).toLocaleString();
                });
        });
    }

    // Update setiap 2 detik
    setInterval(updatePrices, 2000);
});

