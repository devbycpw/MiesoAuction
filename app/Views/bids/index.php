<?php if (Auth::isClient()): ?>
        <p class="home-welcome">Hello, <?= Auth::user('full_name'); ?>! <br>Here's an overview of your auction victories. You've built an impressive collection!</p>
    <?php endif; ?>

