var _shouldShowPopup=function(e){return!_getCookie(e)},_getCookie=function(e){for(var o=e+"=",i=document.cookie.split(";"),t=0;t<i.length;t++){for(var r=i[t];" "==r.charAt(0);)r=r.substring(1);if(0==r.indexOf(o))return r.substring(o.length,r.length)}return""},_setCookie=function(e,o,i){var t=new Date;t.setTime(t.getTime()+24*i*60*60*1e3);var r="expires="+t.toUTCString();document.cookie=e+"="+o+";"+r+";path=/"},cookiePrivacyName="modal-cookies",cookiePrivacyLifetime=365;_shouldShowPopup(cookiePrivacyName)&&jQuery(".modal-cookies").show(),jQuery(".cookies-close").click(function(e){e.preventDefault(),jQuery(".modal-cookies").hide(),_setCookie(cookiePrivacyName,1,cookiePrivacyLifetime)});