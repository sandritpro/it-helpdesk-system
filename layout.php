<?php require_once __DIR__ . '/config/db.php'; ?>
<?php function page_header(string $title, string $active=''): void { ?>
<!doctype html><html lang="uk"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title><?= h($title) ?></title><link rel="stylesheet" href="assets/style.css"><script src="https://cdn.jsdelivr.net/npm/chart.js"></script></head><body>
<header><h1>IT and Information Security Request Tracking System</h1><div class="muted">User request log, issue tracking and statistics</div></header>
<nav><a class="<?= $active==='dashboard'?'active':'' ?>" href="index.php">Dashboard</a><a class="<?= $active==='requests'?'active':'' ?>" href="requests.php">Requests</a><a class="<?= $active==='users'?'active':'' ?>" href="users.php">Users</a><a class="<?= $active==='reasons'?'active':'' ?>" href="reasons.php">Reasons</a><a class="<?= $active==='stats'?'active':'' ?>" href="stats.php">Statistics</a></nav><div class="container">
<?php } ?>
<?php function page_footer(): void { ?><div class="footer-note">Data is stored in JSON files in the <b>data</b> folder. SQLite/PDO is not required.</div></div><script src="assets/app.js"></script></body></html><?php } ?>
