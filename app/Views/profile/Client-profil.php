<?php
    $fullName  = $user['full_name'] ?? 'Client';
    $email     = $user['email'] ?? '-';
    $role      = $user['role'] ?? 'client';

    $auctions  = $stats['auctions_created'] ?? 0;
    $wins      = $stats['wins'] ?? 0;
    $bids      = $stats['bids_placed'] ?? 0;
    $watchlist = $stats['watchlist'] ?? 0;

    $rating        = $user['rating'] ?? '98%';
    $biddingPower  = $user['bidding_power'] ?? null;
    $limitUsed     = $user['limit_used_percent'] ?? null;
    $memberSinceUi = $memberSince ?? '—';
?>

<div class="profile-page client" style="background-color:#f6f2ea; color:#1f2933; min-height:100vh;">
    <div class="container py-5">
        <div class="row g-4">

            <div class="col-12 col-lg-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body d-flex flex-column align-items-center text-center">
                        <div class="rounded-circle d-flex align-items-center justify-content-center mb-3"
                             style="width:72px;height:72px;font-weight:600;font-size:24px;background:#f1f1f1;">
                            <?= htmlspecialchars($initials) ?>
                        </div>

                        <h5 class="mb-1"><?= htmlspecialchars($fullName) ?></h5>
                        <p class="text-muted small mb-2"><?= htmlspecialchars($email) ?></p>

                        <span class="badge rounded-pill bg-light text-dark border mb-4">
                            <i class="fa-solid fa-star me-1"></i>
                            <?= htmlspecialchars(ucfirst($role)) ?> member
                        </span>

                        <div class="d-flex justify-content-between w-100 text-center mb-4">
                            <div>
                                <div class="fw-semibold"><?= htmlspecialchars($auctions) ?></div>
                                <div class="text-muted text-uppercase small">Auctions</div>
                            </div>
                            <div>
                                <div class="fw-semibold"><?= htmlspecialchars($wins) ?></div>
                                <div class="text-muted text-uppercase small">Won</div>
                            </div>
                            <div>
                                <div class="fw-semibold"><?= htmlspecialchars($rating) ?></div>
                                <div class="text-muted text-uppercase small">Rating</div>
                            </div>
                        </div>

                        <div class="w-100 small mb-4">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="text-muted">Bidding power</span>
                                <span class="fw-semibold">
                                    <?= $biddingPower !== null ? htmlspecialchars($biddingPower) : '$—'; ?>
                                </span>
                            </div>
                            <?php if ($limitUsed !== null): ?>
                                <div class="text-muted">
                                    <?= (int) $limitUsed ?>% of limit used
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="mt-auto small text-muted">
                            <div class="text-uppercase">Member since</div>
                            <div><?= htmlspecialchars($memberSinceUi) ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-8">
                <div class="mb-3">
                    <h2 class="h3 mb-1">My Account</h2>
                    <p class="text-muted mb-0">Manage your profile, bids, and preferences</p>
                </div>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-0 pb-2">
                        <span class="text-uppercase small text-muted">Activity</span>
                    </div>
                    <div class="list-group list-group-flush">
                        <a href="<?= BASE_URL ?>transactions"
                           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <span class="me-3"><i class="fa-solid fa-gavel"></i></span>
                                <div>
                                    <div class="fw-semibold">My Bids</div>
                                    <div class="small text-muted">Active and past bids</div>
                                </div>
                            </div>
                            <span class="small text-muted"><?= htmlspecialchars($bids) ?> active</span>
                        </a>

                        <a href="#"
                           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <span class="me-3"><i class="fa-regular fa-eye"></i></span>
                                <div>
                                    <div class="fw-semibold">Watching</div>
                                    <div class="small text-muted">Items you're following</div>
                                </div>
                            </div>
                            <span class="small text-muted"><?= htmlspecialchars($watchlist) ?></span>
                        </a>

                        <a href="<?= BASE_URL ?>transactions"
                           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <span class="me-3"><i class="fa-solid fa-trophy"></i></span>
                                <div>
                                    <div class="fw-semibold">Won Auctions</div>
                                    <div class="small text-muted">Your winning bids</div>
                                </div>
                            </div>
                        </a>

                        <a href="#"
                           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <span class="me-3"><i class="fa-regular fa-heart"></i></span>
                                <div>
                                    <div class="fw-semibold">Favorites</div>
                                    <div class="small text-muted">Saved for later</div>
                                </div>
                            </div>
                        </a>

                        <a href="<?= BASE_URL ?>transactions"
                           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <span class="me-3"><i class="fa-regular fa-clock"></i></span>
                                <div>
                                    <div class="fw-semibold">Bid History</div>
                                    <div class="small text-muted">Complete auction history</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-0 pb-2">
                        <span class="text-uppercase small text-muted">Account</span>
                    </div>
                    <div class="list-group list-group-flush">
                        <a href="#"
                           class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <span class="me-3"><i class="fa-regular fa-user"></i></span>
                                <div>
                                    <div class="fw-semibold">Profile Settings</div>
                                    <div class="small text-muted">Personal information</div>
                                </div>
                            </div>
                        </a>

                        <a href="<?= BASE_URL ?>payments"
                           class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <span class="me-3"><i class="fa-regular fa-credit-card"></i></span>
                                <div>
                                    <div class="fw-semibold">Payment Methods</div>
                                    <div class="small text-muted">Cards and billing</div>
                                </div>
                            </div>
                        </a>

                        <a href="#"
                           class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <span class="me-3"><i class="fa-regular fa-bell"></i></span>
                                <div>
                                    <div class="fw-semibold">Notifications</div>
                                    <div class="small text-muted">Email and alerts</div>
                                </div>
                            </div>
                            <span class="small text-muted">2 new</span>
                        </a>

                        <a href="#"
                           class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <span class="me-3"><i class="fa-solid fa-shield-halved"></i></span>
                                <div>
                                    <div class="fw-semibold">Security</div>
                                    <div class="small text-muted">Password and 2FA</div>
                                </div>
                            </div>
                        </a>

                        <a href="#"
                           class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <span class="me-3"><i class="fa-solid fa-gear"></i></span>
                                <div>
                                    <div class="fw-semibold">Preferences</div>
                                    <div class="small text-muted">App settings</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-header bg-white border-0 pb-2">
                        <span class="text-uppercase small text-muted">Support</span>
                    </div>
                    <div class="list-group list-group-flush">
                        <a href="<?= BASE_URL ?>Aboutus"
                           class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <span class="me-3"><i class="fa-regular fa-circle-question"></i></span>
                                <div>
                                    <div class="fw-semibold">Help Center</div>
                                    <div class="small text-muted">FAQs and guides</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="<?= BASE_URL ?>logout" class="btn btn-outline-secondary">
                        <i class="fa-solid fa-right-from-bracket me-2"></i>
                        Sign Out
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
