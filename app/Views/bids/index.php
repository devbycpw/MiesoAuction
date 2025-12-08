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
                    <td>
                        <img src="<?= BASE_URL ?>assets/uploads/auction_images/<?= htmlspecialchars($h['image']) ?>" width="80"><br>
                        <a href="<?= BASE_URL ?>auction/show/<?= htmlspecialchars($h['auction_id']) ?>">
                            <?= htmlspecialchars($h['title']); ?>
                        </a>
                    </td>

                    <td>$<?= number_format($h['bid_amount']); ?></td>

                    <td>$<?= number_format($h['highest_bid']); ?></td>

                    <td>
                        <?php if ($h['status'] === "active"): ?>
                            <span class="badge bg-success">Active</span>
                        <?php elseif ($h['status'] === "sold"): ?>
                            <span class="badge bg-primary">Sold</span>
                        <?php elseif ($h['status'] === "rejected"): ?>
                            <span class="badge bg-danger">Rejected</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">Closed</span>
                        <?php endif; ?>
                    </td>

                    <td>
                        <?php 
                            $auction_status = $h['status'];
                            $is_winner = $h['is_winner'];
                            $payment_status = $h['payment_status'] ?? null; 
                        ?>

                        <?php if ($auction_status === "active"): ?>
                            <span class="badge bg-info">In Progress</span>

                        <?php elseif ($is_winner == 1): ?>
                            <span class="badge bg-success">You Won!</span><br>
                            <small>Final Price: $<?= number_format($h['final_price']); ?></small><hr class="my-1">

                            <?php if ($payment_status === 'verified'): ?>
                                <span class="badge bg-success mt-2">Paid</span>

                            <?php elseif ($payment_status === 'pending'): ?>
                                <span class="badge bg-info mt-2">Waiting Verification</span>

                            <?php elseif ($payment_status === 'rejected'): ?>
                                <span class="badge bg-danger mt-2">Payment Rejected</span><br>
                                <a href="<?= BASE_URL ?>payment/pay/<?= $h['auction_id'] ?>"
                                   class="btn btn-outline-warning btn-sm mt-1">
                                    Re-upload Proof
                                </a>

                            <?php else: ?>
                                <a href="<?= BASE_URL ?>payment/pay/<?= $h['auction_id'] ?>"
                                   class="btn btn-warning btn-sm mt-2">
                                    Pay Now
                                </a>
                            <?php endif; ?>

                        <?php else: ?>
                            <span class="badge bg-danger">Lost</span>

                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    <?php endif; ?>
</div>