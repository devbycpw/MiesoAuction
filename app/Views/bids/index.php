<div class="container mt-4">
<?php 
if (Auth::isClient()): ?>
        <p class="home-welcome">Hello, <?= Auth::user('full_name'); ?>! <br>Here's an overview of your auction victories. You've built an impressive collection!</p>
    <?php endif; ?>

<h2>My Bids</h2>

<?php if (empty($history)): ?>
    <p>You haven't placed any bids yet.</p>
<?php else: ?>

<table class="table">
    <thead>
        <tr>
            <th>Item</th>
            <th>Your Bid</th>
            <th>Highest Bid</th>
            <th>Status</th>
            <th>Result</th>
        </tr>
    </thead>

    <tbody>
    <?php foreach ($history as $h): ?>

        <tr>
            <td>
                <img src="<?= BASE_URL ?>assets/uploads/auction_images/<?= $h['image'] ?>" width="80">
                <br>
                <a href="<?= BASE_URL ?>auction/show/<?= $h['auction_id'] ?>">
                    <?= htmlspecialchars($h['title']); ?>
                </a>
            </td>

            <td>Rp <?= number_format($h['bid_amount']); ?></td>

            <td>Rp <?= number_format($h['highest_bid']); ?></td>

            <td>
                <?php if ($h['status'] === "active"): ?>
                    <span class="badge bg-success">Active</span>
                <?php elseif ($h['status'] === "sold"): ?>
                    <span class="badge bg-primary">Sold</span>
                <?php else: ?>
                    <span class="badge bg-secondary">Closed</span>
                <?php endif; ?>
            </td>

            <td>
                <?php if ($h['status'] === "active"): ?>
                    <span class="badge bg-info">In Progress</span>
                <?php else: ?>
                    <?php if ($h['is_winner'] == 1): ?>
                        <span class="badge bg-success">You Won</span>
                        <br>
                        <small>Final Price: Rp <?= number_format($h['final_price']); ?></small>
                    <?php else: ?>
                        <span class="badge bg-danger">Lost</span>
                    <?php endif; ?>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php endif; ?>
</div>