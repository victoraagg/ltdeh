<?php
if (!defined('ABSPATH')) {
    exit;
}

require_once __DIR__ . '/settings/config.php';
require_once __DIR__ . '/settings/google-calendar.php';
require_once __DIR__ . '/assets/styles.php';
require_once __DIR__ . '/assets/scripts.php';
require_once __DIR__ . '/widgets/config.php';
require_once __DIR__ . '/menu/config.php';
require_once __DIR__ . '/cpt/document.php';
require_once __DIR__ . '/cpt/incidence.php';
require_once __DIR__ . '/cpt/inscription.php';
require_once __DIR__ . '/taxonomies/document.php';
require_once __DIR__ . '/taxonomies/incidence.php';
require_once __DIR__ . '/metaboxes/document.php';
require_once __DIR__ . '/metaboxes/incidence.php';
require_once __DIR__ . '/metaboxes/inscription.php';
require_once __DIR__ . '/helpers/incidence.php';
require_once __DIR__ . '/class/google-calendar-api.php';
require_once __DIR__ . '/ajax/google-calendar.php';