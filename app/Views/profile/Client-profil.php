<div class="profile-page client">
    <div class="container py-5">
        <div class="mb-4">
            <h2 class="profile-title">My Account</h2>
            <p class="profile-subtitle">Manage your own profile, bids and preferences</p>
        </div>

        <div class="row g-4 align-items-stretch">
            <div class="col-12 col-lg-5">
                <div class="card profile-summary-card h-100">
                    <div class="card-body d-flex flex-column align-items-center text-center">
                        <div class="profile-avatar">
                            <?= htmlspecialchars($initials ?? 'U') ?>
                        </div>

                        <div class="profile-stats mt-4 mb-4 w-100">
                            <div class="profile-stat">
                                <div class="profile-stat-number"><?= htmlspecialchars($auctions) ?></div>
                                <div class="profile-stat-label">Auction</div>
                            </div>
                            <div class="profile-stat">
                                <div class="profile-stat-number"><?= htmlspecialchars($wins) ?></div>
                                <div class="profile-stat-label">Won</div>
                            </div>
                            <div class="profile-stat">
                                <div class="profile-stat-number">
                                    <?= isset($wins, $auctions) && $auctions > 0
                                        ? round(($wins / $auctions) * 100) . '%'
                                        : '0%' ?>
                                </div>
                                <div class="profile-stat-label">WinRate</div>
                            </div>
                        </div>

                        <div class="profile-member-since mt-auto">
                            <div class="profile-member-label">Member since</div>
                            <div class="profile-member-date">
                                <?= htmlspecialchars($memberSinceUi ?? $memberSince ?? '-') ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-7">
                <div class="card profile-detail-card h-100">
                    <div class="card-body d-flex flex-column">
                        <div class="profile-detail-row">
                            <span class="profile-detail-label">Name</span>
                            <span class="profile-detail-value">
                                <?= htmlspecialchars($fullName) ?>
                            </span>
                        </div>

                        <div class="profile-detail-row">
                            <span class="profile-detail-label">Email</span>
                            <span class="profile-detail-value">
                                <?= htmlspecialchars($email) ?>
                            </span>
                        </div>

                        <div class="profile-detail-row profile-detail-row-click"
                             onclick="window.location.href='<?= BASE_URL ?>profile/auction';">
                            <span class="profile-detail-label">My Auctions</span>
                            <span class="profile-detail-link">Go to My Auctions</span>
                        </div>

                        <div class="profile-detail-row">
                            <span class="profile-detail-label">Notification</span>
                            <label class="toggle-switch mb-0">
                                <input type="checkbox" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>

                        <div class="profile-detail-row profile-detail-row-click"
                             data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                            <span class="profile-detail-label">Change Password</span>
                            <span class="profile-detail-link">Update</span>
                        </div>

                        <div class="flex-grow-1"></div>

                        <div class="text-center mt-4">
                            <a href="<?= BASE_URL ?>logout"
                               class="btn btn-outline-dark profile-signout-btn">
                                Sign Out
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="changePasswordModal" tabindex="-1"
         aria-labelledby="changePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content profile-modal">
                <form action="#" method="post">
                    <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Current Password</label>
                            <input type="password" name="current_password"
                                   class="form-control profile-input">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <input type="password" name="new_password"
                                   class="form-control profile-input">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Confirm New Password</label>
                            <input type="password" name="confirm_new_password"
                                   class="form-control profile-input">
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-dark">
                            Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
