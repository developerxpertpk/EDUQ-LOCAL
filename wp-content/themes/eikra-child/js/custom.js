jQuery(window).scroll(function () {
    var scroll = jQuery(window).scrollTop();
    if (scroll > 200) {
        jQuery("#masthead").addClass("fixed-header");
       
    } else {
        jQuery("#masthead").removeClass("fixed-header");
 
    }
});

jQuery(document).ready(function () {
    if (jQuery(window).width() <= 767) {
         jQuery("#meanmenu.mean-container").addClass("fixed-header");
         jQuery("#content").css("padding-top","50px");
        var HeaderPhone = jQuery('#masthead #tophead .tophead-contact ul li:first-child').html();
        jQuery('<span style="font-size: 14px;width: calc(100% - 160px);display: inline-block;text-align: center;">' + HeaderPhone + '<span>').insertAfter('#meanmenu .mean-bar a:first-child');
    }

    jQuery(".participant-info label .optional").remove();
    jQuery('#amount_cursists').on('mousewheel', function (e) {
        jQuery(this).blur();
    });
    jQuery('#form_subscription').trigger("reset");
    jQuery('.business').css('display', 'none');
    jQuery('.businessfield').each(function () {
        jQuery(this).attr('disabled', true);
    });
    jQuery('.radio_type').change(function () {
        const type = this.value;
        if (type == 0) {
            jQuery('.business').css('display', 'none');
            jQuery('.businessfield').each(function () {
                jQuery(this).attr('disabled', true);
            })
            jQuery('.private').fadeIn();
            jQuery('.private').each(function () {
                jQuery(this).attr('disabled', false);
            })
        } else if (type == 1) {
//            jQuery('.private').css('display', 'none');
//            jQuery('.private').each(function () {
//                jQuery(this).attr('disabled', true);
//            })
            jQuery('.business').fadeIn();
            jQuery('.businessfield').each(function () {
                jQuery(this).attr('disabled', false);
            })
        }
    });
    jQuery('#amount_cursists').change(function () {
        var html = "";
        var noCursist = jQuery('.cursist').length;
        jQuery('#submit_subscription').prop('disabled', true);
        jQuery('#amount_cursists').prop('disabled', true);
        if (jQuery.isNumeric(this.value)) {
            if ((this.value - noCursist) > 0) {
                jQuery.ajax({
                    type: 'POST',
                    url: "/wp-admin/admin-ajax.php",
                    data: {
                        action: 'getFormCursist',
                        number: this.value,
                        noCursist: noCursist,
                    },
                    success: function (data) {
                        jQuery('#cusistswrapper').append(data);
                        jQuery('#submit_subscription').prop('disabled', false);
                        jQuery('#amount_cursists').prop('disabled', false);
                    }
                });
            } else {
                for (i = 0; i < noCursist - this.value; i++) {
                    var index = noCursist - i;
                    jQuery('#cursist' + index).remove();
                }
                jQuery('#amount_cursists').prop('disabled', false);
                jQuery('#submit_subscription').prop('disabled', false);
            }
        }
    }).change();
    
    // sticky sidebar

    
    $('.single-product-edit #wrapper_contact').stickySidebar({
    topSpacing: 140,
    bottomSpacing:0,
    containerSelector: '#content .single-product-edit',
       	innerWrapperSelector: '.single-product-edit #wrapper_contact .team-member',
        resizeSensor: true,
});
    
    
});