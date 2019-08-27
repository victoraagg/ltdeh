/* cookies */
var _shouldShowPopup = function (cookieName) {
    if (_getCookie(cookieName)) {
        return false;
    } else {
        return true;
    }
};

var _getCookie = function (cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
};

var _setCookie = function (cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
};

var cookiePrivacyName = 'modal-cookies';
var cookiePrivacyLifetime = 365; // expiry in days

if (_shouldShowPopup(cookiePrivacyName)) {
    jQuery('.modal-cookies').show();
}

// Close on click and "esc" keyboard
jQuery('.cookies-close').click(function(e){
    e.preventDefault();
    jQuery('.modal-cookies').hide();
    _setCookie(cookiePrivacyName, 1, cookiePrivacyLifetime);
});