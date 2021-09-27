var count = 0;
var inter = setInterval(function() {
    var credentials;
    if (!window.Comagic || !window.Comagic.getCredentials) return;
    credentials = Comagic.getCredentials();

    for (field in credentials) {
        if (credentials.hasOwnProperty(field)) {
            jQuery('[name=_wpcf7tc_' + field + ']').map(function() {
                jQuery(this).val(credentials[field]);
            })
        }
    }
    if (count > 10) clearInterval(inter);
    else count++;
}, 2000);