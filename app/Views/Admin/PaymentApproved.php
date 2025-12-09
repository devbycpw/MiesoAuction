<div class="container py-4">
    <h2>Payments Approved (<?= count($approved_payments) ?>)</h2>

    <?php if (empty($approved_payments)): ?>
        <div class="alert alert-info">No payments are currently pending verification.</div>
    <?php else: ?>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Auction Title</th>
                    <th>User</th>
                    <th>Amount</th>
                    <th>Date Paid</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($approved_payments as $payment): ?>
                    <tr>
                        <td><?= htmlspecialchars($payment['id']) ?></td>
                        <td><?= htmlspecialchars($payment['auction_title']) ?></td>
                        <td><?= htmlspecialchars($payment['user_name']) ?> (<?= htmlspecialchars($payment['user_email']) ?>)</td>
                        <td>$<?= number_format($payment['amount'], 2) ?></td>
                        <td><?= htmlspecialchars($payment['created_at']) ?></td>
                        <td><span class="badge bg-warning text-dark"><?= ucfirst(htmlspecialchars($payment['status'])) ?></span></td>
                        <td>
                            <a href="<?= BASE_URL ?>admin/showPayment/<?= $payment['id'] ?>" class="btn btn-primary btn-sm">Show Detail</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>