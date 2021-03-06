<?php
if (!defined('ABSPATH')) {
    exit;
}

require_once __DIR__ . '/settings/config.php';
require_once __DIR__ . '/settings/options.php';
require_once __DIR__ . '/assets/styles.php';
require_once __DIR__ . '/assets/scripts.php';
require_once __DIR__ . '/widgets/config.php';
require_once __DIR__ . '/menu/config.php';
require_once __DIR__ . '/cpt/document.php';
require_once __DIR__ . '/cpt/inscription.php';
require_once __DIR__ . '/cpt/book.php';
require_once __DIR__ . '/taxonomies/document.php';
require_once __DIR__ . '/metaboxes/document.php';
require_once __DIR__ . '/metaboxes/inscription.php';
require_once __DIR__ . '/metaboxes/book.php';
require_once __DIR__ . '/helpers/book.php';
require_once __DIR__ . '/helpers/notification.php';
require_once __DIR__ . '/helpers/switcher.php';