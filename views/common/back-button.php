<?php
/**
 * Reusable back button component
 * @var string $url The URL to navigate to
 * @var string $title The tooltip title
 */
?>

<style>
.back-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 48px;
    height: 48px;
    margin-bottom: 30px;
    background: rgba(0, 212, 255, 0.15);
    border: 1px solid rgba(0, 212, 255, 0.3);
    border-radius: 10px;
    color: #00d4ff;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.2s ease;
}

.back-link:hover {
    background: rgba(0, 212, 255, 0.25);
    border-color: rgba(0, 212, 255, 0.5);
    transform: translateX(-4px);
    color: #00d4ff;
}

[data-theme="light"] .back-link {
    background: rgba(31, 115, 230, 0.15);
    border-color: rgba(31, 115, 230, 0.3);
    color: #1f73e6;
}

[data-theme="light"] .back-link:hover {
    background: rgba(31, 115, 230, 0.25);
    border-color: rgba(31, 115, 230, 0.5);
    color: #1f73e6;
}
</style>

<a href="<?= $url ?>" class="back-link" title="<?= $title ?>">
    <span class="glyphicon glyphicon-chevron-left"></span>
</a>
