jQuery(document).ready(function($) {
    //Archive menu
    $('.tx-tkblog-widget-content .year').next().hide();
    
    var cookie = $.cookie("tx_tkblog"),
    expanded = cookie ? cookie.split("|").getUnique() : [],
    cookieExpires = 7;
   
    $.each( expanded, function(){
        $('#' + this).show();
    })
    
    $('.tx-tkblog-widget-content .year').click(function(){
        $(this).next().slideToggle('300', function(){
            updateCookie(this);
        });
    })
    
    // Update the Cookie
    function updateCookie(el){
        var tmp = expanded.getUnique();
        if ($(el).is(':hidden')) {
            tmp.splice( tmp.indexOf(el.id) , 1);
        } else {
            tmp.push(el.id);
        }
        expanded = tmp.getUnique();
        $.cookie("tx_tkblog", expanded.join('|'), {
            expires: cookieExpires
        } );   
    }

});

// Return a unique array.
Array.prototype.getUnique = function(sort){
    var u = {}, a = [], i, l = this.length;
    for(i = 0; i < l; ++i){
        if(this[i] in u) {
            continue;
        }
        a.push(this[i]);
        u[this[i]] = 1;
    }
    return (sort) ? a.sort() : a;
}


