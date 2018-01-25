function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}

jQuery(document).ready(function(){
    $.ajax({
        url: "{url}",
        method: 'POST',
        data: {
          'key': '{password}',
          'search': getWord(), 
          'limit': 31
        },
        dataType: "text",
        crossDomain : true,
        success: function(msg)
        {
          var bb = jQuery.parseJSON(msg);
          var html = '';
          console.log(bb);
          jQuery(bb).each(function(){
            html += '<span class="col-xs-2 col-md-2 insta" style="height: 20vh; background-image: url('+this.thumbnail_src+');" ></span>';
          });
          jQuery('#insta-nat').append(html);            
        }
    });
    window.setInterval(function(){
        
        if ($('.insta').length > 30) {
            $.ajax({
                url: "{url}",
                method: 'POST',
                data: {
                  'key': '{password}',
                  'search': getWord(),
                  'limit': 1
                },
                dataType: "text",
                crossDomain : true,
                success: function(msg)
                {
                  var bb = jQuery.parseJSON(msg);
                  var html = '';
                  jQuery(bb).each(function(){
                    html = '<span class="col-xs-2 col-md-2 insta" style="height: 20vh; background-image: url('+this.thumbnail_src+');" ></span>';
                  });
                  window.blob = html;
                  jQuery('#insta-nat').append(html);
                }
            });
            if ($('.insta').length > 30) {
                $('.insta').first().remove();
            }
        }
    }, 1500000);
    
    jQuery("#day-link").click(function(){
        jQuery(".result").hide();
        jQuery("#day").show();
    });
    jQuery("#week-link").click(function(){
        jQuery(".result").hide();
        jQuery("#week").show();
    });
    jQuery("#month-link").click(function(){
        jQuery(".result").hide();
        jQuery("#month").show();
    });
    jQuery("#year-link").click(function(){
        jQuery(".result").hide();
        jQuery("#year").show();
    });
    jQuery("#ever-link").click(function(){
        jQuery(".result").hide();
        jQuery("#ever").show();
    });
    
    jQuery("#nascondi").click(function(){
        jQuery(".nec").hide();
        jQuery("#nascondi").hide();
        jQuery("#cerca").show();
    });
    
    jQuery("#cerca").click(function(){
        jQuery(".nec").show();
        jQuery("#cerca").hide();
        jQuery("#nascondi").show();
    });
});
