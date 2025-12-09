<div class="container py-4 admin-payments">
    <a href="<?= BASE_URL ?>admin/payment/pending" class="btn btn-link p-0 mb-3 text-decoration-none back-link">
        &larr; Back
    </a>

    <h2 class="mb-4">Payment Detail & Verification (ID: <?= htmlspecialchars($payment['id']) ?>)</h2>

    <div class="payment-layout">
        <div class="text-center">
            <div class="payment-proof mb-3">
                <?php if (!empty($payment['payment_proof'])): ?>
                    <a href="<?= BASE_URL ?>assets/uploads/payment_proof/<?= htmlspecialchars($payment['payment_proof']) ?>" target="_blank">
                        <img src="<?= BASE_URL ?>assets/uploads/payment_proof/<?= htmlspecialchars($payment['payment_proof']) ?>" 
                             alt="Payment Proof">
                    </a>
                <?php else: ?>
                    <div class="alert alert-warning">Proof not uploaded or available.</div>
                <?php endif; ?>
            </div>
        </div>

        <div>
            <div class="payment-card mb-4">
                <ul class="list-group list-group-flush payment-list">
                    <li class="list-group-item">
                        <strong class="text-dark">Auction Item:</strong>
                        <a class="text-dark" href="<?= BASE_URL ?>auction/show/<?= htmlspecialchars($payment['auction_id']) ?>">
                            <?= htmlspecialchars($payment['auction_title']) ?>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <strong>Final Price (Amount Due):</strong>
                        <span class="price-accent">$<?= number_format($payment['auction_final_price'], 2) ?></span>
                    </li>
                    <li class="list-group-item">
                        <strong>Amount Paid:</strong>
                        <span class="price-warning">$<?= number_format($payment['amount'], 2) ?></span>
                        <?php if ($payment['amount'] != $payment['auction_final_price']): ?>
                            <span class="badge badge-rejected ms-2">Mismatch!</span>
                        <?php endif; ?>
                    </li>
                    <li class="list-group-item">
                        <strong>Payment Date:</strong> <?= htmlspecialchars($payment['created_at']) ?>
                    </li>
                    <li class="list-group-item">
                        <strong>Payer Name:</strong> <?= htmlspecialchars($payment['payer_name']) ?> (<?= htmlspecialchars($payment['payer_email']) ?>)
                    </li>
                </ul>
            </div>

            <?php if (!empty($payment['admin_note'])): ?>
                <div class="payment-card mb-4">
                    <div class="card-header">Admin Note</div>
                    <div class="p-3">
                        <p class="mb-0"><?= nl2br(htmlspecialchars($payment['admin_note'])) ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <div class="payment-card p-3">
                <h5 class="mb-3">Verification Actions</h5>
                <?php 
                    $status = htmlspecialchars($payment['status']);
                    $status_class = match ($status) {
                        'pending' => 'badge-pending',
                        'verified' => 'badge-approved',
                        'rejected' => 'badge-rejected',
                        default => 'bg-secondary'
                    };
                ?>
                <p class="mb-2">Current Status: <span class="badge <?= $status_class ?>"><?= ucfirst($status) ?></span></p>

                <?php if ($status === 'pending'): ?>
                    <div class="d-grid gap-2 verify-actions">
                        <a href="<?= BASE_URL ?>admin/payment/verify/<?= $payment['id'] ?>" 
                           class="btn btn-success"
                           onclick="return confirm('Confirm verification? This will mark the auction as SOLD.');">
                            <i class="bi bi-check-circle"></i> Verify & Approve
                        </a>
                        <a href="<?= BASE_URL ?>admin/payment/reject/<?= $payment['id'] ?>" 
                           class="btn btn-danger"
                           onclick="return confirm('Reject this payment? The user can re-upload proof.');">
                            <i class="bi bi-x-circle"></i> Reject Payment
                        </a>
                    </div>
                <?php elseif ($status === 'verified'): ?>
                    <div class="verify-box success mt-2">
                        This payment has been successfully verified. Auction is marked as SOLD.
                    </div>
                <?php elseif ($status === 'rejected'): ?>
                    <div class="verify-box pending mt-2">
                        Payment was rejected. User may re-upload proof.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
