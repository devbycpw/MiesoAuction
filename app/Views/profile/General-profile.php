<?php 
    $displayName = $user['full_name'] ?? 'Guest';
?>

<div class="profile-page general">
    <section class="profile-hero">
        <div class="profile-hero__copy">
            <p class="eyebrow">Profile space</p>
            <h1>Hi <?= htmlspecialchars($displayName) ?>, keep your auction identity neat and ready.</h1>
            <p class="lede">
                Use this profile area to understand what clients see, manage your preferences, and move seamlessly
                between browsing and bidding.
            </p>
            <div class="profile-hero__actions">
                <a class="btn btn-primary" href="<?= BASE_URL ?>login">Log in</a>
                <a class="btn btn-outline-light" href="<?= BASE_URL ?>register">Create client profile</a>
            </div>
            <div class="profile-hero__steps">
                <span>01. Secure your account</span>
                <span>02. Complete profile details</span>
                <span>03. Start bidding</span>
            </div>
        </div>
        <div class="profile-hero__card">
            <div class="badge-light">General view</div>
            <h3>See what clients experience</h3>
            <p>
                This general profile page is a preview. Once you log in as a client, you will get a personalized
                dashboard with activity, watchlists, and bidding health.
            </p>
            <ul class="dot-list">
                <li>Organize your identity and contact points</li>
                <li>Save payment preferences securely</li>
                <li>Switch to client mode to unlock bidding tools</li>
            </ul>
            <a class="text-link" href="<?= BASE_URL ?>profile/client">Jump to client profile</a>
        </div>
    </section>

    <section class="profile-grid">
        <div class="profile-tile">
            <div class="tile-icon">🔐</div>
            <h4>Security first</h4>
            <p>Session-aware navigation, logout everywhere, and quick redirects keep your account safe.</p>
        </div>
        <div class="profile-tile">
            <div class="tile-icon">🧭</div>
            <h4>Clear navigation</h4>
            <p>Role-based menus adapt automatically so guests, admins, and clients land on the right surface.</p>
        </div>
        <div class="profile-tile">
            <div class="tile-icon">📈</div>
            <h4>Client benefits</h4>
            <p>Track bids, wins, and payment proofs from one clean hub once you authenticate.</p>
        </div>
    </section>
</div>
