<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function set_flash(string $type, string $message): void
{
    $_SESSION['flash'] = [
        'type' => $type,
        'message' => $message,
    ];
}

function display_flash(): void
{
    if (!empty($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        echo '<div class="alert alert-' . htmlspecialchars($flash['type']) . ' alert-dismissible fade show" role="alert">';
        echo htmlspecialchars($flash['message']);
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
        unset($_SESSION['flash']);
    }
}

function redirect_with_message(string $url, string $type, string $message): void
{
    set_flash($type, $message);
    header('Location: ' . $url);
    exit;
}

function h(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}
?>
