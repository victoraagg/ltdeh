<?php
if (!defined('ABSPATH')) {
    exit;
}

// [redsysbutton]
function redsysbutton_func($atts = null, $content = null)
{
    $post_id = $atts['post_id'];
    $button_id = $atts['id'];
    $qty = $atts['qty'];
    $order = str_pad($post_id, 8, "X", STR_PAD_LEFT) . date("is");
    $description = $atts['desc'];
    $price = get_post_meta($button_id, '_button_price', true);
    $environment = get_option('_redsys_environment');
    if ($environment == 'TEST') {
        $url_tpv = get_option('_redsys_url_tpv_test');
        $clave = get_option('_redsys_keycode_test');
    } else {
        $url_tpv = get_option('_redsys_url_tpv_prod');
        $clave = get_option('_redsys_keycode_prod');
    }
    $version = "HMAC_SHA256_V1";
    $nombreComercio = get_option('_redsys_name');
    $code = get_option('_redsys_fuc_code');
    $terminal = get_option('_redsys_terminal');
    $amountClean = number_format((float)($qty * $price), 2, '.', '');
    $amount = str_replace('.', '', $amountClean);
    $amount = floatval($amount);
    $currency = get_option('_redsys_currency');
    $consumerlng = '0';
    $transactionType = '0';
    $urlMerchant = get_option('_redsys_url_merchant');
    $urlweb_ok = get_option('_redsys_url_ok');
    $urlweb_ko = get_option('_redsys_url_ko');
    $merchantData = 'postId_' . $post_id;

    $apiObj = new RedsysAPI;
    $apiObj->setParameter("DS_MERCHANT_AMOUNT", $amount);
    $apiObj->setParameter("DS_MERCHANT_CURRENCY", $currency);
    $apiObj->setParameter("DS_MERCHANT_ORDER", $order);
    $apiObj->setParameter("DS_MERCHANT_MERCHANTCODE", $code);
    $apiObj->setParameter("DS_MERCHANT_TERMINAL", $terminal);
    $apiObj->setParameter("DS_MERCHANT_TRANSACTIONTYPE", $transactionType);
    $apiObj->setParameter("DS_MERCHANT_MERCHANTNAME", $nombreComercio);
    $apiObj->setParameter("DS_MERCHANT_MERCHANTURL", $urlMerchant);
    $apiObj->setParameter("DS_MERCHANT_PRODUCTDESCRIPTION", $description);
    $apiObj->setParameter("DS_MERCHANT_URLOK", $urlweb_ok);
    $apiObj->setParameter("DS_MERCHANT_URLKO", $urlweb_ko);
    $apiObj->setParameter("DS_MERCHANT_CONSUMERLANGUAGE", $consumerlng);
    $apiObj->setParameter("DS_MERCHANT_MERCHANTDATA", $merchantData);

    $params = $apiObj->createMerchantParameters();
    $signature = $apiObj->createMerchantSignature($clave);

    echo '<p>Importe: ' . str_replace('.', ',', $amountClean) . '€</p>';
    echo '<form action="' . $url_tpv . '" method="post" id="formRedsys">';
    echo '<input type="hidden" name="Ds_SignatureVersion" id="Ds_SignatureVersion" value="' . $version . '"/>';
    echo '<input type="hidden" name="Ds_MerchantParameters" id="Ds_MerchantParameters" value="' . $params . '"/>';
    echo '<input type="hidden" name="Ds_Signature" id="Ds_Signature" value="' . $signature . '"/>';
    echo '<input type="submit" class="dx-btn dx-btn-lg" value="Realizar pago" />';
    echo '</form>';
}
add_shortcode('redsysbutton', 'redsysbutton_func');
