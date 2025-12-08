<div class="container mt-4">

    <?php if (Auth::isClient()): ?>
        <p class="home-welcome">
            Hello, <?= Auth::user('full_name'); ?>! <br>
            Here's an overview of your auction victories. You've built an impressive collection!
        </p>
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
                    <!-- ITEM -->
                    <td>
                        <img src="<?= BASE_URL ?>assets/uploads/auction_images/<?= $h['image'] ?>" width="80"><br>
                        <a href="<?= BASE_URL ?>auction/show/<?= $h['auction_id'] ?>">
                            <?= htmlspecialchars($h['title']); ?>
                        </a>
                    </td>

                    <!-- USER BID -->
                    <td>Rp <?= number_format($h['bid_amount']); ?></td>

                    <!-- HIGHEST BID -->
                    <td>Rp <?= number_format($h['highest_bid']); ?></td>

                    <!-- AUCTION STATUS -->
                    <td>
                        <?php if ($h['status'] === "active"): ?>
                            <span class="badge bg-success">Active</span>
                        <?php elseif ($h['status'] === "sold"): ?>
                            <span class="badge bg-primary">Sold</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">Closed</span>
                        <?php endif; ?>
                    </td>

                    <!-- RESULT + PAYMENT -->
                    <td>
                        <?php if ($h['status'] === "active"): ?>

                            <span class="badge bg-info">In Progress</span>

                        <?php else: ?>

                            <?php if ($h['is_winner'] == 1): ?>

                                <span class="badge bg-success">You Won</span><br>
                                <small>Final Price: Rp <?= number_format($h['final_price']); ?></small><br>

                                <!-- PAYMENT AREA -->
                                <?php if ($h['status'] === "closed"): ?>

                                    <?php if (empty($h['payment'])): ?>

                                        <a href="<?= BASE_URL ?>payment/show/<?= $h['auction_id'] ?>"
                                           class="btn btn-warning btn-sm mt-2">
                                            Pay Now
                                        </a>

                                    <?php else: ?>

                                        <?php if ($h['payment_status'] === 'pending'): ?>
                                            <span class="badge bg-info mt-2">Waiting Verification</span>

                                        <?php elseif ($h['payment_status'] === 'verified'): ?>
                                            <span class="badge bg-success mt-2">Paid</span>

                                        <?php elseif ($h['payment_status'] === 'rejected'): ?>
                                            <span class="badge bg-danger mt-2">Payment Rejected</span><br>
                                            <a href="<?= BASE_URL ?>payment/pay/<?= $h['auction_id'] ?>"
                                               class="btn btn-outline-warning btn-sm mt-1">
                                                Re-upload Proof
                                            </a>
                                        <?php endif; ?>

                                    <?php endif; ?>

                                <?php endif; ?>

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
