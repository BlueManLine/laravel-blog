/**
 * Core JS file
 *
 * It can be extended by:
 * jQuery.extend( _main, { element_name: { <your code> } } );
 *
 */
var _main = {
    /* operations fired when document is loaded */
    init: function() {
        $("a[rel='external']").each( function(i) {
            this.target = "_blank";
        });

        // AJAX configuration
        $.ajaxSetup({
            cache: false
        });

        /* initialize code for controllers and actions */
        var controller = _config.controller.charAt(0).toUpperCase() + _config.controller.substr(1).replace(/-[a-z0-9]/ig, function(s) {return s.substr(1,1).toUpperCase();});
        if ( typeof(window[controller]) == "object" ) {

            this._this = window[controller];

            var action = _config.action.replace(/-[a-z0-9]/ig, function(s) {return s.substr(1,1).toUpperCase();}) + "Action";

            if (typeof(window[controller]["init"]) == "function") {
                window[controller]["init"]();
            }
            if (typeof(window[controller][action]) == "function") {
                window[controller][action]();
            }
        }
    }
    
};

$(document).ready(function() {
    _main.init();
});

try {document.execCommand('BackgroundImageCache', false, true);} catch(e) {}
