<div class="container py-4">
    <h2>Payments Pending Verification (<?= count($pending_payments) ?>)</h2>

    <?php if (empty($pending_payments)): ?>
        <div class="alert text-center py-4 mb-0 admin-empty-state">
            No payments are currently pending verification.
        </div>
    <?php else: ?>
        <table class="table table-striped table-hover admin-payments-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Proof</th>
                    <th>Auction Title</th>
                    <th>User</th>
                    <th>Amount</th>
                    <th>Date Paid</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pending_payments as $payment): ?>
                    <tr>
                        <td><?= htmlspecialchars($payment['id']) ?></td>
                        <td>
                            <?php if (!empty($payment['payment_proof'])): ?>
                                <a href="<?= BASE_URL ?>assets/uploads/payment_proof/<?= htmlspecialchars($payment['payment_proof']) ?>" target="_blank">
                                    <img src="<?= BASE_URL ?>assets/uploads/payment_proof/<?= htmlspecialchars($payment['payment_proof']) ?>" 
                                         alt="proof" style="width:60px;height:60px;object-fit:cover;border-radius:6px;">
                                </a>
                            <?php else: ?>
                                <span class="text-muted small">No proof</span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($payment['auction_title']) ?></td>
                        <td><?= htmlspecialchars($payment['user_name']) ?> (<?= htmlspecialchars($payment['user_email']) ?>)</td>
                        <td>$<?= number_format($payment['amount'], 2) ?></td>
                        <td><?= htmlspecialchars($payment['created_at']) ?></td>
                        <td><span class="badge badge-pending"><?= ucfirst(htmlspecialchars($payment['status'])) ?></span></td>
                        <td>
                            <a href="<?= BASE_URL ?>admin/showPayment/<?= $payment['id'] ?>" class="btn btn-primary btn-sm admin-show-detail">Show Detail</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
