document.addEventListener("DOMContentLoaded", () => {
  // ==============================
  // 1. COUNTDOWN TIMER
  // ==============================
  const timers = document.querySelectorAll(".countdown-timer");

  timers.forEach((timer) => {
    const endTime = new Date(timer.dataset.end).getTime();

    const daysEl = timer.querySelector(".days");
    const hoursEl = timer.querySelector(".hours");
    const minutesEl = timer.querySelector(".minutes");
    const secondsEl = timer.querySelector(".seconds");

    const interval = setInterval(() => {
      const now = Date.now();
      const distance = endTime - now;

      if (distance <= 0) {
        daysEl.textContent = "00";
        hoursEl.textContent = "00";
        minutesEl.textContent = "00";
        secondsEl.textContent = "00";
        clearInterval(interval);
        return;
      }

      const days = Math.floor(distance / (1000 * 60 * 60 * 24));
      const hours = Math.floor((distance / (1000 * 60 * 60)) % 24);
      const minutes = Math.floor((distance / (1000 * 60)) % 60);
      const seconds = Math.floor((distance / 1000) % 60);

      daysEl.textContent = String(days).padStart(2, "0");
      hoursEl.textContent = String(hours).padStart(2, "0");
      minutesEl.textContent = String(minutes).padStart(2, "0");
      secondsEl.textContent = String(seconds).padStart(2, "0");
    }, 1000);
  });

  // ==============================
  // 2. AUTO UPDATE CURRENT PRICE
  // ==============================
  function updatePrices() {
    const priceElements = document.querySelectorAll(".current-price");
    if (priceElements.length === 0) return;

    priceElements.forEach((el) => {
      const id = el.dataset.id;

      fetch(`${BASE_URL}auction/api/current-price/${id}`)
        .then((res) => res.json())
        .then((data) => {
          if (data.current_price) {
            el.textContent = parseFloat(data.current_price).toLocaleString();
          }
        })
        .catch((err) => console.error("Price update error:", err));
    });
  }

  // Update setiap 2 detik
  setInterval(updatePrices, 2000);
});
