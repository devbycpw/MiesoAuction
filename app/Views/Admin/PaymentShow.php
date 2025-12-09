<div class="container py-4">
    <a href="<?= BASE_URL ?>admin/payment/pending" class="btn btn-secondary mb-3">
        &larr; Back to Pending Payments
    </a>

    <h2 class="mb-4">Payment Detail & Verification (ID: <?= htmlspecialchars($payment['id']) ?>)</h2>

    <div class="row">
        <div class="col-md-7">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white fw-bold">
                    Transaction Details
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <strong>Auction Item:</strong> 
                        <a href="<?= BASE_URL ?>auction/show/<?= htmlspecialchars($payment['auction_id']) ?>">
                            <?= htmlspecialchars($payment['auction_title']) ?>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <strong>Final Price (Amount Due):</strong> 
                        <span class="fw-bold text-success">$<?= number_format($payment['auction_final_price'], 2) ?></span>
                    </li>
                    <li class="list-group-item">
                        <strong>Amount Paid:</strong> 
                        <span class="fw-bold text-danger">$<?= number_format($payment['amount'], 2) ?></span>
                        <?php if ($payment['amount'] != $payment['auction_final_price']): ?>
                            <span class="badge bg-danger ms-2">Mismatch!</span>
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
                <div class="card mb-4">
                    <div class="card-header bg-light">Admin Note</div>
                    <div class="card-body">
                        <p class="card-text small"><?= nl2br(htmlspecialchars($payment['admin_note'])) ?></p>
                    </div>
                </div>
            <?php endif; ?>

        </div>

        <div class="col-md-5">
            
            <h4 class="mb-3">Payment Proof</h4>
            <?php if (!empty($payment['payment_proof'])): ?>
                <a href="<?= BASE_URL ?>assets/uploads/payment_proof/<?= htmlspecialchars($payment['payment_proof']) ?>" target="_blank">
                    <img src="<?= BASE_URL ?>assets/uploads/payment_proof/<?= htmlspecialchars($payment['payment_proof']) ?>" 
                         class="img-fluid rounded shadow-sm mb-3" alt="Payment Proof" style="max-height: 350px; object-fit: contain;">
                </a>
            <?php else: ?>
                <div class="alert alert-warning">Proof not uploaded or available.</div>
            <?php endif; ?>

            <h4 class="mt-4">Verification Actions</h4>
            
            <p>Current Status: 
                <?php 
                    $status = htmlspecialchars($payment['status']);
                    $status_class = match ($status) {
                        'pending' => 'bg-warning text-dark',
                        'verified' => 'bg-success',
                        'rejected' => 'bg-danger',
                        default => 'bg-secondary',
                    };
                ?>
                <span class="badge <?= $status_class ?> fs-6"><?= ucfirst($status) ?></span>
            </p>

            <?php if ($status === 'pending'): ?>
                <div class="d-grid gap-2 mt-3">
                    <a href="<?= BASE_URL ?>admin/payment/verify/<?= $payment['id'] ?>" 
                       class="btn btn-success fw-bold"
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
                <div class="alert alert-success">This payment has been successfully verified. Auction is marked as SOLD.</div>
            <?php endif; ?>

        </div>
    </div>
</div>