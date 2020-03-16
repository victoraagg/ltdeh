<?php
if (!defined('ABSPATH')) {
    exit;
}

// [redsysbutton]
function redsysbutton_func($atts = null, $content = null) {

    $button_id = $atts['id'];
    $qty = $atts['qty'];
    $order = $atts['order'];
    $description = $atts['desc'];
    $price = get_post_meta( $button_id, '_button_price', true );
    $titular = 'Titular Test';
    $merchantIdentifier = '';
    $merchantData = null;
    $environment = get_option('_redsys_environment');
    if($environment == 'TEST'){
        $url_tpv = get_option('_redsys_url_tpv_test');
        $clave = get_option('_redsys_keycode_test');
    }else{
        $url_tpv = get_option('_redsys_url_tpv_prod');
        $clave = get_option('_redsys_keycode_prod');
    }
    $version = "HMAC_SHA256_V1"; 
    $clave = get_option('_redsys_keycode');
    $nombreComercio = get_option('_redsys_name');
    $code = get_option('_redsys_fuc_code');
    $terminal = get_option('_redsys_terminal');
    $amount = number_format((float)($qty * $price), 2, '.', '');
    $amount = str_replace('.', '', $amount);
    $amount = floatval($amount);
    $currency = get_option('_redsys_currency');
    $consumerlng = '001';
    $transactionType = '0';
    $urlMerchant = get_option('_redsys_url_merchant');
    $urlweb_ok = get_option('_redsys_url_ok');
    $urlweb_ko = get_option('_redsys_url_ko');
    $productDescription = $description;

    $apiObj = new RedsysAPI;
    $apiObj->setParameter("DS_MERCHANT_AMOUNT", $amount);
    $apiObj->setParameter("DS_MERCHANT_CURRENCY", $currency);
    $apiObj->setParameter("DS_MERCHANT_ORDER", $order);
    $apiObj->setParameter("DS_MERCHANT_MERCHANTCODE", $code);
    $apiObj->setParameter("DS_MERCHANT_TERMINAL", $terminal);
    $apiObj->setParameter("DS_MERCHANT_TRANSACTIONTYPE", $transactionType);
    $apiObj->setParameter("DS_MERCHANT_TITULAR", $titular);
    $apiObj->setParameter("DS_MERCHANT_MERCHANTNAME", $nombreComercio);
    $apiObj->setParameter("DS_MERCHANT_MERCHANTURL", $urlMerchant);
    $apiObj->setParameter("DS_MERCHANT_PRODUCTDESCRIPTION", $productDescription);
    $apiObj->setParameter("DS_MERCHANT_URLOK", $urlweb_ok);
    $apiObj->setParameter("DS_MERCHANT_URLKO", $urlweb_ko);
    $apiObj->setParameter("DS_MERCHANT_CONSUMERLANGUAGE", $consumerlng);
    $apiObj->setParameter("DS_MERCHANT_IDENTIFIER", $merchantIdentifier);

    $params = $apiObj->createMerchantParameters();
    $signature = $apiObj->createMerchantSignature($clave);

    echo '<p>Importe: '.substr_replace($amount, ',', -2,0).'€</p>';
    echo '<form action="'.$url_tpv.'" method="post" id="formRedsys">';
    echo '<input type="hidden" name="Ds_Merchant_Amount" id="Ds_Merchant_Amount" value="'.$amount.'" />';
    echo '<input disabled type="hidden" name="Ds_Merchant_Currency" id="Ds_Merchant_Currency" value="'.$currency.'" />';
    echo '<input disabled type="hidden" name="Ds_Merchant_Order" id="Ds_Merchant_Order" value="'.$order.'" />';
    echo '<input disabled type="hidden" name="Ds_Merchant_MerchantCode" id="Ds_Merchant_MerchantCode" value="'.$code.'" />';
    echo '<input disabled type="hidden" name="Ds_Merchant_Terminal" id="Ds_Merchant_Terminal" value="'.$terminal.'" />';
    echo '<input disabled type="hidden" name="Ds_Merchant_TransactionType" id="Ds_Merchant_TransactionType" value="'.$transactionType.'" />';
    echo '<input disabled type="hidden" name="Ds_Merchant_Titular" id="Ds_Merchant_Titular" value="'.$titular.'" />';
    echo '<input disabled type="hidden" name="Ds_Merchant_MerchantName" id="Ds_Merchant_MerchantName" value="'.$nombreComercio.'" />';
    echo '<input disabled type="hidden" name="Ds_Merchant_ProductDescription" id="Ds_Merchant_ProductDescription" value="'.$productDescription.'" />';
    echo '<input disabled type="hidden" name="Ds_Merchant_MerchantURL" id="Ds_Merchant_MerchantURL" value="'.$urlMerchant.'" />';
    echo '<input disabled type="hidden" name="Ds_Merchant_UrlOK" id="Ds_Merchant_UrlOK" value="'.$urlweb_ok.'" />';
    echo '<input disabled type="hidden" name="Ds_Merchant_UrlKO" id="Ds_Merchant_UrlKO" value="'.$urlweb_ko.'" />';
    echo '<input disabled type="hidden" name="Ds_Merchant_ConsumerLanguage" id="Ds_Merchant_ConsumerLanguage" value="'.$consumerlng.'" />';
    echo '<input disabled type="hidden" name="Ds_Merchant_MerchantData" id="Ds_Merchant_MerchantData" value="'.$merchantData.'" />';
    echo '<input disabled type="hidden" name="Ds_Merchant_Identifier" id="Ds_Merchant_Identifier" value="'.$merchantIdentifier.'" />';
    echo '<input type="hidden" name="Ds_SignatureVersion" id="Ds_SignatureVersion" value="'.$version.'"/>';
    echo '<input type="hidden" name="Ds_MerchantParameters" id="Ds_MerchantParameters" value="'.$params.'"/>';
    echo '<input type="hidden" name="Ds_Signature" id="Ds_Signature" value="'.$signature.'"/>';
    echo '</form>';
    echo '<button class="dx-btn dx-btn-lg" type="submit" form="formRedsys" value="Submit">Realizar pago</button>';

    /*
    echo '<form name="from" action="'.$url_tpv.'" method="POST">';
    echo '<input type="hidden" name="Ds_SignatureVersion" value="'.$version.'">';
    echo '<input type="hidden" name="Ds_MerchantParameters" value="'.$params.'">';
    echo '<input type="hidden" name="Ds_Signature" value="'.$signature.'">';
    echo '<input class="dx-btn dx-btn-lg" type="submit" value="Realizar pago" />';
    echo '</form>';
    */

}
add_shortcode('redsysbutton', 'redsysbutton_func');
