<?php
// Data already prepared in controller: $history, $stats
?>

<div class="mybids-page">
    <section class="mybids-hero">
        <div class="mybids-hero__icon"><i class="bi bi-stars"></i></div>
        <div>
            <p class="mybids-hero__eyebrow">Welcome back</p>
            <?php $displayName = $user['full_name'] ?? Auth::user('full_name') ?? 'Bidder'; ?>
            <h1 class="mybids-hero__title">Hello, <?= htmlspecialchars($displayName); ?></h1>
            <p class="mybids-hero__lede">
                Here's an overview of your auction victories. You've built an impressive collection!
            </p>
        </div>
    </section>

    <section class="mybids-stats">
        <div class="mybids-stat-card">
            <div>
                <p class="stat-label">Total Spend</p>
                <p class="stat-value">$ <?= number_format($stats['totalSpend'], 0, '.', ','); ?></p>
                <p class="stat-sub">Across all wins</p>
            </div>
            <div class="stat-icon">💵</div>
        </div>
        <div class="mybids-stat-card">
            <div>
                <p class="stat-label">Item Won</p>
                <p class="stat-value"><?= $stats['itemsWon']; ?> Item</p>
            </div>
            <div class="stat-icon">🏆</div>
        </div>
        <div class="mybids-stat-card">
            <div>
                <p class="stat-label">Paid</p>
                <p class="stat-value">$ <?= number_format($stats['paidSum'], 0, '.', ','); ?></p>
            </div>
            <div class="stat-icon">✔</div>
        </div>
        <div class="mybids-stat-card">
            <div>
                <p class="stat-label">Waiting</p>
                <p class="stat-value">$ <?= number_format($stats['waitingSum'], 0, '.', ','); ?></p>
                <p class="stat-sub"><?= $stats['waitingCount']; ?> item left</p>
            </div>
            <div class="stat-icon">⏱</div>
        </div>
    </section>

    <section class="mybids-filter">
        <button class="filter-pill active" data-filter="all">All Item <span class="pill-count"><?= $stats['allCount']; ?></span></button>
        <button class="filter-pill" data-filter="paid">Paid <span class="pill-count"><?= $stats['paidCount']; ?></span></button>
        <button class="filter-pill" data-filter="waiting">Waiting <span class="pill-count"><?= $stats['waitingCount']; ?></span></button>
    </section>

    <section class="mybids-list">
        <?php if (empty($history)): ?>
            <p class="empty-state">You have no winning bids yet.</p>
        <?php else: ?>
            <div class="mybids-grid">
                <?php foreach ($history as $h):
                    $isWinner = !empty($h['is_winner']);
                    $payment = $h['payment_status'] ?? null;
                    $paid = $payment === 'verified';
                    $waiting = !$paid;
                    $statusBadge = $isWinner
                        ? ($paid ? 'Paid' : ($waiting ? 'Unpaid' : 'Rejected'))
                        : ($h['status'] === 'active' ? 'Watch' : 'Closed');
                    $statusClass = $paid
                        ? 'status-paid'
                        : ($isWinner ? 'status-unpaid' : 'status-watch');
                    $price = $h['final_price'] ?? $h['highest_bid'] ?? $h['bid_amount'] ?? 0;
                    $endDate = !empty($h['end_time']) ? date("d M Y", strtotime($h['end_time'])) : '-';
                ?>
                    <article class="mybid-card" data-status="<?= $paid ? 'paid' : 'waiting'; ?>">
                        <div class="mybid-card__badges">
                            <span class="badge-outline">Won</span>
                            <span class="badge-solid <?= $statusClass; ?>"><?= htmlspecialchars($statusBadge); ?></span>
                        </div>
                        <a href="<?= BASE_URL ?>auction/show/<?= htmlspecialchars($h['auction_id']); ?>" class="mybid-image-wrap">
                            <?php if (!empty($h['image'])): ?>
                                <img src="<?= BASE_URL ?>assets/uploads/auction_images/<?= htmlspecialchars($h['image']); ?>" alt="<?= htmlspecialchars($h['title']); ?>">
                            <?php else: ?>
                                <div class="mybid-image-placeholder">No Image</div>
                            <?php endif; ?>
                        </a>
                        <div class="mybid-meta">
                            <h3 class="mybid-title"><?= htmlspecialchars($h['title']); ?></h3>
                            <p class="mybid-price">$ <?= number_format($price, 2, '.', ','); ?></p>
                            <p class="mybid-date"><i class="bi bi-calendar3 me-1"></i><?= $endDate; ?></p>
                            <p class="mybid-location"><i class="bi bi-hammer me-1"></i>Seller: <?= htmlspecialchars($h['seller_name'] ?? 'Unknown'); ?></p>
                            <?php if ($isWinner): ?>
                                <a class="btn-transaction" href="<?= BASE_URL ?>bids/transaction/<?= htmlspecialchars($h['auction_id']); ?>">
                                    View Transaction
                                </a>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>
</div>

<script>
  (function() {
    const pills = document.querySelectorAll(".filter-pill");
    const cards = document.querySelectorAll(".mybid-card");

    pills.forEach(pill => {
      pill.addEventListener("click", () => {
        pills.forEach(p => p.classList.remove("active"));
        pill.classList.add("active");

        const filter = pill.getAttribute("data-filter");
        cards.forEach(card => {
          const status = card.getAttribute("data-status");
          const show = filter === "all" || status === filter;
          card.style.display = show ? "" : "none";
        });
      });
    });
  })();
</script>
