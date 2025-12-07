document.addEventListener("DOMContentLoaded", function () {
    const timers = document.querySelectorAll(".countdown-container");

    timers.forEach(timer => {
        const endTime = new Date(timer.getAttribute("data-end")).getTime();

        const daysEl = timer.querySelector(".days");
        const hoursEl = timer.querySelector(".hours");
        const minsEl = timer.querySelector(".minutes");
        const secsEl = timer.querySelector(".seconds");
        
        // Hapus elemen yang tidak digunakan jika diff <= 0 agar tidak mengganggu tata letak
        const parentDiv = timer.closest('.card-body');

        function updateCountdown() {
            let now = new Date().getTime();
            let diff = endTime - now;

            if (diff <= 0) {
                // Ganti seluruh container countdown dengan teks "Auction Ended"
                timer.innerHTML = `<p class="auction-ended-text"><strong>Countdown:</strong> Auction Ended</p>`;
                return;
            }

            let days = Math.floor(diff / (1000 * 60 * 60 * 24));
            let hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            let minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((diff % (1000 * 60)) / 1000);

            daysEl.textContent = String(days).padStart(2, '0');
            hoursEl.textContent = String(hours).padStart(2, '0');
            minsEl.textContent = String(minutes).padStart(2, '0');
            secsEl.textContent = String(seconds).padStart(2, '0');
        }
        updateCountdown(); // pertama kali jalan
        setInterval(updateCountdown, 1000); // update setiap detik
    });
});