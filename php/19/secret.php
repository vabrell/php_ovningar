<?php
session_start();

$message = 'Du har tyvärr inte tillgång till sidan, vänligen <a href="./">logga in</a>';

if (isset($_SESSION['user']) && $_SESSION['user']) {
  $message = 'Du har tillgång till sidan';
}

echo $message;