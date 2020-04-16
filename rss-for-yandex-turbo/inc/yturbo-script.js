jQuery(document).ready(function($) {
    var thumb = jQuery('#ytthumbnail');
    var select = this.value;

    if (jQuery('#ytthumbnail').is(':checked')) {
        jQuery('.ytselectthumbtr').show();
    } else {
        jQuery('.ytselectthumbtr').hide();
    }

    thumb.change(function() {
        if (jQuery('#ytthumbnail').is(':checked')) {
            jQuery('.ytselectthumbtr').fadeIn();
        } else {
            jQuery('.ytselectthumbtr').hide();
        }
    });

    var tax = jQuery('#ytexclude');

    if (jQuery('#ytexclude').is(':checked')) {
        jQuery('.yttaxlisttr').show();
    } else {
        jQuery('.yttaxlisttr').hide();
    }

    tax.change(function() {
        if (jQuery('#ytexclude').is(':checked')) {
            jQuery('.yttaxlisttr').fadeIn();
        } else {
            jQuery('.yttaxlisttr').hide();
        }
    });

    var razb = jQuery('#ytrazb');

    if (jQuery('#ytrazb').is(':checked')) {
        jQuery('.ytrazbnumbertr').show();
    } else {
        jQuery('.ytrazbnumbertr').hide();
    }

    razb.change(function() {
        if (jQuery('#ytrazb').is(':checked')) {
            jQuery('.ytrazbnumbertr').fadeIn();
        } else {
            jQuery('.ytrazbnumbertr').hide();
        }
    });

    var datef = jQuery('#ytpostdate');

    if (jQuery('#ytpostdate').is(':checked')) {
        jQuery('.ytdateformattr').show();
    } else {
        jQuery('.ytdateformattr').hide();
    }

    datef.change(function() {
        if (jQuery('#ytpostdate').is(':checked')) {
            jQuery('.ytdateformattr').fadeIn();
        } else {
            jQuery('.ytdateformattr').hide();
        }
    });

    if (jQuery('#ytcomments').is(':checked')) {
        jQuery('.ytcommentschildtr').show();
    } else {
        jQuery('.ytcommentschildtr').hide();
    }
    var comments = jQuery('#ytcomments');
    comments.change(function() {
        if (jQuery('#ytcomments').is(':checked')) {
            jQuery('.ytcommentschildtr').fadeIn();
        } else {
            jQuery('.ytcommentschildtr').hide();
        }
    });

    if (jQuery('#ytrelated').is(':checked')) {
        jQuery('.ytrelatedchildtr').show();

        if (jQuery('#ytrelatedcache').is(':checked')) {
             jQuery('.ytcachetime').show();
        } else {
             jQuery('.ytcachetime').hide();
        }

    } else {
        jQuery('.ytrelatedchildtr').hide();
    }
    var related = jQuery('#ytrelated');
    related.change(function() {
        if (jQuery('#ytrelated').is(':checked')) {
            jQuery('.ytrelatedchildtr').fadeIn();
            
             if (jQuery('#ytrelatedcache').is(':checked')) {
             jQuery('.ytcachetime').fadeIn();
            } else {
                jQuery('.ytcachetime').hide();
            }
        } else {
            jQuery('.ytrelatedchildtr').hide();
        }
    });

    var relatedtime = jQuery('#ytrelatedcache');
    relatedtime.change(function() {

        if (jQuery('#ytrelatedcache').is(':checked')) {
             jQuery('.ytcachetime').fadeIn();
        } else {
             jQuery('.ytcachetime').hide();
        }
    });

    if (jQuery('#ytrating').is(':checked')) {
        jQuery('.ytratingchildtr').show();
    } else {
        jQuery('.ytratingchildtr').hide();
    }

    var ytrating = jQuery('#ytrating');
    ytrating.change(function() {
        if (jQuery('#ytrating').is(':checked')) {
            jQuery('.ytratingchildtr').fadeIn();
        } else {
            jQuery('.ytratingchildtr').hide();
        }
    });

    if (jQuery('#ytsearch').is(':checked')) {
        jQuery('.ytsearchchildtr').show();
    } else {
        jQuery('.ytsearchchildtr').hide();
    }

    var ytsearch = jQuery('#ytsearch');
    ytsearch.change(function() {
        if (jQuery('#ytsearch').is(':checked')) {
            jQuery('.ytsearchchildtr').fadeIn();
        } else {
            jQuery('.ytsearchchildtr').hide();
        }
    });

    if (jQuery('#yttoc').is(':checked')) {
        jQuery('.yttocchildtr').show();
    } else {
        jQuery('.yttocchildtr').hide();
    }

    var yttoc = jQuery('#yttoc');
    yttoc.change(function() {
        if (jQuery('#yttoc').is(':checked')) {
            jQuery('.yttocchildtr').fadeIn();
        } else {
            jQuery('.yttocchildtr').hide();
        }
    });

    if (jQuery('#ytshare').is(':checked')) {
        jQuery('.ytsharechildtr').show();
    } else {
        jQuery('.ytsharechildtr').hide();
    }

    var share = jQuery('#ytshare');
    share.change(function() {
        if (jQuery('#ytshare').is(':checked')) {
            jQuery('.ytsharechildtr').fadeIn();
        } else {
            jQuery('.ytsharechildtr').hide();
        }
    });

    if (jQuery('#ytfeedback').is(':checked')) {
        jQuery('.ytfeedbackchildtr').show();
        if (jQuery('#ytfeedbackselect option:selected').val() == 'false') {
            jQuery('.ytfeedbackselectmestotr').show();
        } else {
            jQuery('.ytfeedbackselectmestotr').hide();
        }
    } else {
        jQuery('.ytfeedbackselectmestotr').hide();
        jQuery('.ytfeedbackchildtr').hide();
        jQuery('#ytfeedbackcontacts [value="myselect"]').attr('selected', 'selected');
        jQuery('.ytfeedbackcalltr,.ytfeedbackcallbacktr,.ytfeedbackchattr,.ytfeedbackmailtr,.ytfeedbackvkontaktetr,.ytfeedbackodnoklassnikitr,.ytfeedbacktwittertr,.ytfeedbackfacebooktr,.ytfeedbackvibertr,.ytfeedbackwhatsapptr,.ytfeedbacktelegramtr').hide();
    }

    var feedback = jQuery('#ytfeedback');
    feedback.change(function() {
        if (jQuery('#ytfeedback').is(':checked')) {
            jQuery('.ytfeedbackchildtr').fadeIn();
            if (jQuery('#ytfeedbackselect option:selected').val() == 'false') {
                jQuery('.ytfeedbackselectmestotr').fadeIn();
            } else {
                jQuery('.ytfeedbackselectmestotr').hide();
            }
        } else {
            jQuery('.ytfeedbackchildtr').hide();
            jQuery('.ytfeedbackselectmestotr').hide();
            jQuery('#ytfeedbackcontacts [value="myselect"]').attr('selected', 'selected');
            jQuery('.ytfeedbackcalltr,.ytfeedbackcallbacktr,.ytfeedbackchattr,.ytfeedbackmailtr,.ytfeedbackvkontaktetr,.ytfeedbackodnoklassnikitr,.ytfeedbacktwittertr,.ytfeedbackfacebooktr,.ytfeedbackvibertr,.ytfeedbackwhatsapptr,.ytfeedbacktelegramtr').hide();
        }
    });

    var tags = jQuery('#ytexcludetags');

    if (jQuery('#ytexcludetags').is(':checked')) {
        jQuery('.ytexcludetagslisttr').show();
    } else {
        jQuery('.ytexcludetagslisttr').hide();
    }

    tags.change(function() {
        if (jQuery('#ytexcludetags').is(':checked')) {
            jQuery('.ytexcludetagslisttr').fadeIn();
        } else {
            jQuery('.ytexcludetagslisttr').hide();
        }
    });

    var codes = jQuery('#ytexcludeshortcodes');

    if (jQuery('#ytexcludeshortcodes').is(':checked')) {
        jQuery('.ytexcludeshortcodeslisttr').show();
    } else {
        jQuery('.ytexcludeshortcodeslisttr').hide();
    }

    codes.change(function() {
        if (jQuery('#ytexcludeshortcodes').is(':checked')) {
            jQuery('.ytexcludeshortcodeslisttr').fadeIn();
        } else {
            jQuery('.ytexcludeshortcodeslisttr').hide();
        }
    });

    var tags2 = jQuery('#ytexcludetags2');

    if (jQuery('#ytexcludetags2').is(':checked')) {
        jQuery('.ytexcludetagslist2tr').show();
    } else {
        jQuery('.ytexcludetagslist2tr').hide();
    }

    tags2.change(function() {
        if (jQuery('#ytexcludetags2').is(':checked')) {
            jQuery('.ytexcludetagslist2tr').fadeIn();
        } else {
            jQuery('.ytexcludetagslist2tr').hide();
        }
    });

    var rcont = jQuery('#ytexcludecontent');

    if (jQuery('#ytexcludecontent').is(':checked')) {
        jQuery('.ytexcludecontentlisttr').show();
    } else {
        jQuery('.ytexcludecontentlisttr').hide();
    }

    rcont.change(function() {
        if (jQuery('#ytexcludecontent').is(':checked')) {
            jQuery('.ytexcludecontentlisttr').fadeIn();
        } else {
            jQuery('.ytexcludecontentlisttr').hide();
        }
    });

    var rurls = jQuery('#ytexcludeurls');
    rurls.change(function() {
        if (jQuery('#ytexcludeurls').is(':checked')) {
            jQuery('.ytexcludeurlslisttr').fadeIn();
        } else {
            jQuery('.ytexcludeurlslisttr').hide();
        }
    });

    var block1 = jQuery('#ytad1');

    if (jQuery('#ytad1').is(':checked')) {
        jQuery('.block1').show();
        if (jQuery('#ytad1set option:selected').val() == 'РСЯ') {
            jQuery('.trrsa').fadeIn();
            jQuery('.trfox1').hide();
        }
        if (jQuery('#ytad1set option:selected').val() == 'ADFOX') {
            jQuery('.trrsa').hide();
            jQuery('.trfox1').fadeIn();
        }
    } else {
        jQuery('.block1').hide();
    }

    block1.change(function() {
        if (jQuery('#ytad1').is(':checked')) {
            jQuery('.block1').fadeIn();
            if (jQuery('#ytad1set option:selected').val() == 'РСЯ') {
                jQuery('.trrsa').fadeIn();
                jQuery('.trfox1').hide();
            }
            if (jQuery('#ytad1set option:selected').val() == 'ADFOX') {
                jQuery('.trrsa').hide();
                jQuery('.trfox1').fadeIn();
            }
        } else {
            jQuery('.block1').hide();
        }
    });

    jQuery(document).on('change', '#ytad1set', function() {
        if (jQuery('#ytad1set option:selected').val() == 'РСЯ') {
            jQuery('.trrsa').show();
            jQuery('.trfox1').hide();
        }
        if (jQuery('#ytad1set option:selected').val() == 'ADFOX') {
            jQuery('.trrsa').hide();
            jQuery('.trfox1').show();
        }
    });


    var block2 = jQuery('#ytad2');

    if (jQuery('#ytad2').is(':checked')) {
        jQuery('.block2').show();
        if (jQuery('#ytad2set option:selected').val() == 'РСЯ') {
            jQuery('.trrsa2').fadeIn();
            jQuery('.trfox2').hide();
        }
        if (jQuery('#ytad2set option:selected').val() == 'ADFOX') {
            jQuery('.trrsa2').hide();
            jQuery('.trfox2').fadeIn();
        }
    } else {
        jQuery('.block2').hide();
    }

    block2.change(function() {
        if (jQuery('#ytad2').is(':checked')) {
            jQuery('.block2').fadeIn();
            if (jQuery('#ytad2set option:selected').val() == 'РСЯ') {
                jQuery('.trrsa2').fadeIn();
                jQuery('.trfox2').hide();
            }
            if (jQuery('#ytad2set option:selected').val() == 'ADFOX') {
                jQuery('.trrsa2').hide();
                jQuery('.trfox2').fadeIn();
            }
        } else {
            jQuery('.block2').hide();
        }
    });

    jQuery(document).on('change', '#ytad2set', function() {
        if (jQuery('#ytad2set option:selected').val() == 'РСЯ') {
            jQuery('.trrsa2').show();
            jQuery('.trfox2').hide();
        }
        if (jQuery('#ytad2set option:selected').val() == 'ADFOX') {
            jQuery('.trrsa2').hide();
            jQuery('.trfox2').show();
        }
    });

    var block3 = jQuery('#ytad3');

    if (jQuery('#ytad3').is(':checked')) {
        jQuery('.block3').show();
        if (jQuery('#ytad3set option:selected').val() == 'РСЯ') {
            jQuery('.trrsa3').fadeIn();
            jQuery('.trfox3').hide();
        }
        if (jQuery('#ytad3set option:selected').val() == 'ADFOX') {
            jQuery('.trrsa3').hide();
            jQuery('.trfox3').fadeIn();
        }
    } else {
        jQuery('.block3').hide();
    }

    block3.change(function() {
        if (jQuery('#ytad3').is(':checked')) {
            jQuery('.block3').fadeIn();
            if (jQuery('#ytad3set option:selected').val() == 'РСЯ') {
                jQuery('.trrsa3').fadeIn();
                jQuery('.trfox3').hide();
            }
            if (jQuery('#ytad3set option:selected').val() == 'ADFOX') {
                jQuery('.trrsa3').hide();
                jQuery('.trfox3').fadeIn();
            }
        } else {
            jQuery('.block3').hide();
        }
    });

    jQuery(document).on('change', '#ytad3set', function() {
        if (jQuery('#ytad3set option:selected').val() == 'РСЯ') {
            jQuery('.trrsa3').show();
            jQuery('.trfox3').hide();
        }
        if (jQuery('#ytad3set option:selected').val() == 'ADFOX') {
            jQuery('.trrsa3').hide();
            jQuery('.trfox3').show();
        }
    });

    var block4 = jQuery('#ytad4');

    if (jQuery('#ytad4').is(':checked')) {
        jQuery('.block4').show();
        if (jQuery('#ytad4set option:selected').val() == 'РСЯ') {
            jQuery('.trrsa4').fadeIn();
            jQuery('.trfox4').hide();
        }
        if (jQuery('#ytad4set option:selected').val() == 'ADFOX') {
            jQuery('.trrsa4').hide();
            jQuery('.trfox4').fadeIn();
        }
    } else {
        jQuery('.block4').hide();
    }

    block4.change(function() {
        if (jQuery('#ytad4').is(':checked')) {
            jQuery('.block4').fadeIn();
            if (jQuery('#ytad4set option:selected').val() == 'РСЯ') {
                jQuery('.trrsa4').fadeIn();
                jQuery('.trfox4').hide();
            }
            if (jQuery('#ytad4set option:selected').val() == 'ADFOX') {
                jQuery('.trrsa4').hide();
                jQuery('.trfox4').fadeIn();
            }
        } else {
            jQuery('.block4').hide();
        }
    });

    jQuery(document).on('change', '#ytad4set', function() {
        if (jQuery('#ytad4set option:selected').val() == 'РСЯ') {
            jQuery('.trrsa4').show();
            jQuery('.trfox4').hide();
        }
        if (jQuery('#ytad4set option:selected').val() == 'ADFOX') {
            jQuery('.trrsa4').hide();
            jQuery('.trfox4').show();
        }
    });

    var block5 = jQuery('#ytad5');

    if (jQuery('#ytad5').is(':checked')) {
        jQuery('.block5').show();
        if (jQuery('#ytad5set option:selected').val() == 'РСЯ') {
            jQuery('.trrsa5').fadeIn();
            jQuery('.trfox5').hide();
        }
        if (jQuery('#ytad5set option:selected').val() == 'ADFOX') {
            jQuery('.trrsa5').hide();
            jQuery('.trfox5').fadeIn();
        }
    } else {
        jQuery('.block5').hide();
    }

    block5.change(function() {
        if (jQuery('#ytad5').is(':checked')) {
            jQuery('.block5').fadeIn();
            if (jQuery('#ytad5set option:selected').val() == 'РСЯ') {
                jQuery('.trrsa5').fadeIn();
                jQuery('.trfox5').hide();
            }
            if (jQuery('#ytad5set option:selected').val() == 'ADFOX') {
                jQuery('.trrsa5').hide();
                jQuery('.trfox5').fadeIn();
            }
        } else {
            jQuery('.block5').hide();
        }
    });

    jQuery(document).on('change', '#ytad5set', function() {
        if (jQuery('#ytad5set option:selected').val() == 'РСЯ') {
            jQuery('.trrsa5').show();
            jQuery('.trfox5').hide();
        }
        if (jQuery('#ytad5set option:selected').val() == 'ADFOX') {
            jQuery('.trrsa5').hide();
            jQuery('.trfox5').show();
        }
    });
    var auselect = jQuery('#ytauthorselect');
    if (jQuery('#ytauthorselect option:selected').val() == 'Указать автора') {
        jQuery('#ownname2').fadeIn();
    } else {
        jQuery('#ownname2').hide();
    }
    auselect.change(function() {
        if (jQuery('#ytauthorselect option:selected').val() == 'Указать автора') {
            jQuery('#ownname2').fadeIn();
        } else {
            jQuery('#ownname2').hide();
        }
    });

    var delturbo = jQuery('#ytremoveturbo');

    if (jQuery('#ytremoveturbo').is(':checked')) {
        jQuery('.ytprotokoltr').show();
    } else {
        jQuery('.ytprotokoltr').hide();
    }

    delturbo.change(function() {
        if (jQuery('#ytremoveturbo').is(':checked')) {
            jQuery('.ytprotokoltr').fadeIn();
        } else {
            jQuery('.ytprotokoltr').hide();
        }
    });

    if (jQuery('#ytfeedbackcontacts option:selected').val() == 'feedbackcall') {
        jQuery('.ytfeedbackcalltr').show();
    } else {
        jQuery('.ytfeedbackcalltr').hide();
    }
    if (jQuery('#ytfeedbackcontacts option:selected').val() == 'feedbackcallback') {
        jQuery('.ytfeedbackcallbacktr').show();
    } else {
        jQuery('.ytfeedbackcallbacktr').hide();
    }
    if (jQuery('#ytfeedbackcontacts option:selected').val() == 'feedbackchat') {
        jQuery('.ytfeedbackchattr').show();
    } else {
        jQuery('.ytfeedbackchattr').hide();
    }
    if (jQuery('#ytfeedbackcontacts option:selected').val() == 'feedbackmail') {
        jQuery('.ytfeedbackmailtr').show();
    } else {
        jQuery('.ytfeedbackmailtr').hide();
    }
    if (jQuery('#ytfeedbackcontacts option:selected').val() == 'feedbackvkontakte') {
        jQuery('.ytfeedbackvkontaktetr').show();
    } else {
        jQuery('.ytfeedbackvkontaktetr').hide();
    }
    if (jQuery('#ytfeedbackcontacts option:selected').val() == 'feedbackodnoklassniki') {
        jQuery('.ytfeedbackodnoklassnikitr').show();
    } else {
        jQuery('.ytfeedbackodnoklassnikitr').hide();
    }
    if (jQuery('#ytfeedbackcontacts option:selected').val() == 'feedbacktwitter') {
        jQuery('.ytfeedbacktwittertr').show();
    } else {
        jQuery('.ytfeedbacktwittertr').hide();
    }
    if (jQuery('#ytfeedbackcontacts option:selected').val() == 'feedbackfacebook') {
        jQuery('.ytfeedbackfacebooktr').show();
    } else {
        jQuery('.ytfeedbackfacebooktr').hide();
    }
    if (jQuery('#ytfeedbackcontacts option:selected').val() == 'feedbackviber') {
        jQuery('.ytfeedbackvibertr').show();
    } else {
        jQuery('.ytfeedbackvibertr').hide();
    }
    if (jQuery('#ytfeedbackcontacts option:selected').val() == 'feedbackwhatsapp') {
        jQuery('.ytfeedbackwhatsapptr').show();
    } else {
        jQuery('.ytfeedbackwhatsapptr').hide();
    }
    if (jQuery('#ytfeedbackcontacts option:selected').val() == 'feedbacktelegram') {
        jQuery('.ytfeedbacktelegramtr').show();
    } else {
        jQuery('.ytfeedbacktelegramtr').hide();
    }

    var ytfeedbackcontacts = jQuery('#ytfeedbackcontacts');
    ytfeedbackcontacts.change(function() {
        if (jQuery('#ytfeedbackcontacts option:selected').val() == 'feedbackcall') {
            jQuery('.ytfeedbackcalltr').fadeIn();
        } else {
            jQuery('.ytfeedbackcalltr').hide();
        }
        if (jQuery('#ytfeedbackcontacts option:selected').val() == 'feedbackcallback') {
            jQuery('.ytfeedbackcallbacktr').fadeIn();
        } else {
            jQuery('.ytfeedbackcallbacktr').hide();
        }
        if (jQuery('#ytfeedbackcontacts option:selected').val() == 'feedbackchat') {
            jQuery('.ytfeedbackchattr').fadeIn();
        } else {
            jQuery('.ytfeedbackchattr').hide();
        }
        if (jQuery('#ytfeedbackcontacts option:selected').val() == 'feedbackmail') {
            jQuery('.ytfeedbackmailtr').fadeIn();
        } else {
            jQuery('.ytfeedbackmailtr').hide();
        }
        if (jQuery('#ytfeedbackcontacts option:selected').val() == 'feedbackvkontakte') {
            jQuery('.ytfeedbackvkontaktetr').fadeIn();
        } else {
            jQuery('.ytfeedbackvkontaktetr').hide();
        }
        if (jQuery('#ytfeedbackcontacts option:selected').val() == 'feedbackodnoklassniki') {
            jQuery('.ytfeedbackodnoklassnikitr').fadeIn();
        } else {
            jQuery('.ytfeedbackodnoklassnikitr').hide();
        }
        if (jQuery('#ytfeedbackcontacts option:selected').val() == 'feedbacktwitter') {
            jQuery('.ytfeedbacktwittertr').fadeIn();
        } else {
            jQuery('.ytfeedbacktwittertr').hide();
        }
        if (jQuery('#ytfeedbackcontacts option:selected').val() == 'feedbackfacebook') {
            jQuery('.ytfeedbackfacebooktr').fadeIn();
        } else {
            jQuery('.ytfeedbackfacebooktr').hide();
        }
        if (jQuery('#ytfeedbackcontacts option:selected').val() == 'feedbackviber') {
            jQuery('.ytfeedbackvibertr').fadeIn();
        } else {
            jQuery('.ytfeedbackvibertr').hide();
        }
        if (jQuery('#ytfeedbackcontacts option:selected').val() == 'feedbackwhatsapp') {
            jQuery('.ytfeedbackwhatsapptr').fadeIn();
        } else {
            jQuery('.ytfeedbackwhatsapptr').hide();
        }
        if (jQuery('#ytfeedbackcontacts option:selected').val() == 'feedbacktelegram') {
            jQuery('.ytfeedbacktelegramtr').fadeIn();
        } else {
            jQuery('.ytfeedbacktelegramtr').hide();
        }
    });

        if (jQuery('#ytqueryselect option:selected').val() == 'Все таксономии, кроме исключенных') {
            jQuery('.yttaxlisttr').show();
            jQuery('#excludespan').show();
        } else {
            jQuery('.yttaxlisttr').hide();
            jQuery('#excludespan').hide();
        }
        if (jQuery('#ytqueryselect option:selected').val() == 'Только указанные таксономии') {
            jQuery('.ytaddtaxlisttr').show();
            jQuery('#includespan').show();
        } else {
            jQuery('.ytaddtaxlisttr').hide();
            jQuery('#includespan').hide();
        }

    var ytqueryselect = jQuery('#ytqueryselect');
    ytqueryselect.change(function() {
        if (jQuery('#ytqueryselect option:selected').val() == 'Все таксономии, кроме исключенных') {
            jQuery('.yttaxlisttr').fadeIn();
            jQuery('#excludespan').fadeIn();
        } else {
            jQuery('.yttaxlisttr').hide();
            jQuery('#excludespan').hide();
        }
        if (jQuery('#ytqueryselect option:selected').val() == 'Только указанные таксономии') {
            jQuery('.ytaddtaxlisttr').fadeIn();
            jQuery('#includespan').fadeIn();
        } else {
            jQuery('.ytaddtaxlisttr').hide();
            jQuery('#includespan').hide();
        }
    });

    var ytfeedbackselect = jQuery('#ytfeedbackselect');
    ytfeedbackselect.change(function() {
        if (jQuery('#ytfeedbackselect option:selected').val() == 'false') {
            jQuery('.ytfeedbackselectmestotr').fadeIn();
        } else {
            jQuery('.ytfeedbackselectmestotr').hide();
        }
    });

})

String.prototype.replaceAll = function(search, replace){
    return this.split(search).join(replace);
}

jQuery(document).ready(function($) {
    var temp = jQuery('#ytnetw').val();
    if (temp!==undefined) {
        if (temp.indexOf('facebook') !== -1) {jQuery('#facebook').attr('checked', 'checked');}
        if (temp.indexOf('vkontakte') !== -1) {jQuery('#vkontakte').attr('checked', 'checked');}
        if (temp.indexOf('twitter') !== -1) {jQuery('#twitter').attr('checked', 'checked');}
        if (temp.indexOf('odnoklassniki') !== -1) {jQuery('#odnoklassniki').attr('checked', 'checked');}
        if (temp.indexOf('telegram') !== -1) {jQuery('#telegram').attr('checked', 'checked');}
    }
});
jQuery(function() {
    jQuery('#facebook').click(function(){
        if (jQuery('#ytnetw').val().indexOf('facebook') == -1) {
            temp = jQuery('#ytnetw').val()  + 'facebook' + ',';
            jQuery('#ytnetw').val(temp);
            jQuery('#ytnetwspan').val(temp);
        } else {
            temp = jQuery('#ytnetw').val();
            temp = temp.replaceAll('facebook,', '');
            jQuery('#ytnetw').val(temp);
            jQuery('#ytnetwspan').val(temp);
        }
    })
});
jQuery(function() {
    jQuery('#vkontakte').click(function(){
        if (jQuery('#ytnetw').val().indexOf('vkontakte') == -1) {
            temp = jQuery('#ytnetw').val()  + 'vkontakte' + ',';
            jQuery('#ytnetw').val(temp);
            jQuery('#ytnetwspan').val(temp);
        } else {
            temp = jQuery('#ytnetw').val();
            temp = temp.replaceAll('vkontakte,', '');
            jQuery('#ytnetw').val(temp);
            jQuery('#ytnetwspan').val(temp);
        }
    })
});
jQuery(function() {
    jQuery('#twitter').click(function(){
        if (jQuery('#ytnetw').val().indexOf('twitter') == -1) {
            temp = jQuery('#ytnetw').val()  + 'twitter' + ',';
            jQuery('#ytnetw').val(temp);
            jQuery('#ytnetwspan').val(temp);
        } else {
            temp = jQuery('#ytnetw').val();
            temp = temp.replaceAll('twitter,', '');
            jQuery('#ytnetw').val(temp);
            jQuery('#ytnetwspan').val(temp);
        }
    })
});
jQuery(function() {
    jQuery('#odnoklassniki').click(function(){
        if (jQuery('#ytnetw').val().indexOf('odnoklassniki') == -1) {
            temp = jQuery('#ytnetw').val()  + 'odnoklassniki' + ',';
            jQuery('#ytnetw').val(temp);
            jQuery('#ytnetwspan').val(temp);
        } else {
            temp = jQuery('#ytnetw').val();
            temp = temp.replaceAll('odnoklassniki,', '');
            jQuery('#ytnetw').val(temp);
            jQuery('#ytnetwspan').val(temp);
        }
    })
});
jQuery(function() {
    jQuery('#telegram').click(function(){
        if (jQuery('#ytnetw').val().indexOf('telegram') == -1) {
            temp = jQuery('#ytnetw').val()  + 'telegram' + ',';
            jQuery('#ytnetw').val(temp);
            jQuery('#ytnetwspan').val(temp);
        } else {
            temp = jQuery('#ytnetw').val();
            temp = temp.replaceAll('telegram,', '');
            jQuery('#ytnetw').val(temp);
            jQuery('#ytnetwspan').val(temp);
        }
    })
});

jQuery(document).ready(function($) {
    var temp2 = jQuery('#ytfeedbacknetw').val();
    if (temp2!==undefined) {
        if (temp2.indexOf('call,') !== -1) {jQuery('#feedbackcall').attr('checked', 'checked');jQuery('#ytfeedbackcontacts [value="feedbackcall"]').removeAttr('disabled');}
        if (temp2.indexOf('callback') !== -1) {jQuery('#feedbackcallback').attr('checked', 'checked');jQuery('#ytfeedbackcontacts [value="feedbackcallback"]').removeAttr('disabled');}
        if (temp2.indexOf('chat') !== -1) {jQuery('#feedbackchat').attr('checked', 'checked');jQuery('#ytfeedbackcontacts [value="feedbackchat"]').removeAttr('disabled');}
        if (temp2.indexOf('mail') !== -1) {jQuery('#feedbackmail').attr('checked', 'checked');jQuery('#ytfeedbackcontacts [value="feedbackmail"]').removeAttr('disabled');}
        if (temp2.indexOf('vkontakte') !== -1) {jQuery('#feedbackvkontakte').attr('checked', 'checked');jQuery('#ytfeedbackcontacts [value="feedbackvkontakte"]').removeAttr('disabled');}
        if (temp2.indexOf('odnoklassniki') !== -1) {jQuery('#feedbackodnoklassniki').attr('checked', 'checked');jQuery('#ytfeedbackcontacts [value="feedbackodnoklassniki"]').removeAttr('disabled');}
        if (temp2.indexOf('twitter') !== -1) {jQuery('#feedbacktwitter').attr('checked', 'checked');jQuery('#ytfeedbackcontacts [value="feedbacktwitter"]').removeAttr('disabled');}
        if (temp2.indexOf('facebook') !== -1) {jQuery('#feedbackfacebook').attr('checked', 'checked');jQuery('#ytfeedbackcontacts [value="feedbackfacebook"]').removeAttr('disabled');}
        if (temp2.indexOf('viber') !== -1) {jQuery('#feedbackviber').attr('checked', 'checked');jQuery('#ytfeedbackcontacts [value="feedbackviber"]').removeAttr('disabled');}
        if (temp2.indexOf('whatsapp') !== -1) {jQuery('#feedbackwhatsapp').attr('checked', 'checked');jQuery('#ytfeedbackcontacts [value="feedbackwhatsapp"]').removeAttr('disabled');}
        if (temp2.indexOf('telegram') !== -1) {jQuery('#feedbacktelegram').attr('checked', 'checked');jQuery('#ytfeedbackcontacts [value="feedbacktelegram"]').removeAttr('disabled');}
    }
});
jQuery(function() {
    jQuery('#feedbackcall').click(function(){
        jQuery('#ytfeedbackcontacts [value="myselect"]').attr('selected', 'selected');
        jQuery('.ytfeedbackcalltr,.ytfeedbackcallbacktr,.ytfeedbackchattr,.ytfeedbackmailtr,.ytfeedbackvkontaktetr,.ytfeedbackodnoklassnikitr,.ytfeedbacktwittertr,.ytfeedbackfacebooktr,.ytfeedbackvibertr,.ytfeedbackwhatsapptr,.ytfeedbacktelegramtr').hide();
        if (jQuery('#ytfeedbacknetw').val().indexOf('call,') == -1) {
            temp2 = jQuery('#ytfeedbacknetw').val()  + 'call' + ',';
            jQuery('#ytfeedbacknetw').val(temp2);
            jQuery('#ytfeedbacknetwspan').val(temp2);
            jQuery('#ytfeedbackcontacts [value="feedbackcall"]').removeAttr('disabled');
        } else {
            temp2 = jQuery('#ytfeedbacknetw').val();
            temp2 = temp2.replaceAll('call,', '');
            jQuery('#ytfeedbacknetw').val(temp2);
            jQuery('#ytfeedbacknetwspan').val(temp2);
            jQuery('#ytfeedbackcontacts [value="feedbackcall"]').attr('disabled', 'disabled');
        }
    })
});
jQuery(function() {
    jQuery('#feedbackcallback').click(function(){
        jQuery('#ytfeedbackcontacts [value="myselect"]').attr('selected', 'selected');
        jQuery('.ytfeedbackcalltr,.ytfeedbackcallbacktr,.ytfeedbackchattr,.ytfeedbackmailtr,.ytfeedbackvkontaktetr,.ytfeedbackodnoklassnikitr,.ytfeedbacktwittertr,.ytfeedbackfacebooktr,.ytfeedbackvibertr,.ytfeedbackwhatsapptr,.ytfeedbacktelegramtr').hide();
        if (jQuery('#ytfeedbacknetw').val().indexOf('callback') == -1) {
            temp2 = jQuery('#ytfeedbacknetw').val()  + 'callback' + ',';
            jQuery('#ytfeedbacknetw').val(temp2);
            jQuery('#ytfeedbacknetwspan').val(temp2);
            jQuery('#ytfeedbackcontacts [value="feedbackcallback"]').removeAttr('disabled');
        } else {
            temp2 = jQuery('#ytfeedbacknetw').val();
            temp2 = temp2.replaceAll('callback,', '');
            jQuery('#ytfeedbacknetw').val(temp2);
            jQuery('#ytfeedbacknetwspan').val(temp2);
            jQuery('#ytfeedbackcontacts [value="feedbackcallback"]').attr('disabled', 'disabled');
        }
    })
});
jQuery(function() {
    jQuery('#feedbackchat').click(function(){
        jQuery('#ytfeedbackcontacts [value="myselect"]').attr('selected', 'selected');
        jQuery('.ytfeedbackcalltr,.ytfeedbackcallbacktr,.ytfeedbackchattr,.ytfeedbackmailtr,.ytfeedbackvkontaktetr,.ytfeedbackodnoklassnikitr,.ytfeedbacktwittertr,.ytfeedbackfacebooktr,.ytfeedbackvibertr,.ytfeedbackwhatsapptr,.ytfeedbacktelegramtr').hide();
        if (jQuery('#ytfeedbacknetw').val().indexOf('chat') == -1) {
            temp2 = jQuery('#ytfeedbacknetw').val()  + 'chat' + ',';
            jQuery('#ytfeedbacknetw').val(temp2);
            jQuery('#ytfeedbacknetwspan').val(temp2);
            jQuery('#ytfeedbackcontacts [value="feedbackchat"]').removeAttr('disabled');
        } else {
            temp2 = jQuery('#ytfeedbacknetw').val();
            temp2 = temp2.replaceAll('chat,', '');
            jQuery('#ytfeedbacknetw').val(temp2);
            jQuery('#ytfeedbacknetwspan').val(temp2);
            jQuery('#ytfeedbackcontacts [value="feedbackchat"]').attr('disabled', 'disabled');
        }
    })
});
jQuery(function() {
    jQuery('#feedbackmail').click(function(){ 
        jQuery('#ytfeedbackcontacts [value="myselect"]').attr('selected', 'selected');
        jQuery('.ytfeedbackcalltr,.ytfeedbackcallbacktr,.ytfeedbackchattr,.ytfeedbackmailtr,.ytfeedbackvkontaktetr,.ytfeedbackodnoklassnikitr,.ytfeedbacktwittertr,.ytfeedbackfacebooktr,.ytfeedbackvibertr,.ytfeedbackwhatsapptr,.ytfeedbacktelegramtr').hide();
        if (jQuery('#ytfeedbacknetw').val().indexOf('mail') == -1) {
            temp2 = jQuery('#ytfeedbacknetw').val()  + 'mail' + ',';
            jQuery('#ytfeedbacknetw').val(temp2);
            jQuery('#ytfeedbacknetwspan').val(temp2);
            jQuery('#ytfeedbackcontacts [value="feedbackmail"]').removeAttr('disabled');
        } else {
            temp2 = jQuery('#ytfeedbacknetw').val();
            temp2 = temp2.replaceAll('mail,', '');
            jQuery('#ytfeedbacknetw').val(temp2);
            jQuery('#ytfeedbacknetwspan').val(temp2);
            jQuery('#ytfeedbackcontacts [value="feedbackmail"]').attr('disabled', 'disabled');
        }
    })
});
jQuery(function() {
    jQuery('#feedbackvkontakte').click(function(){
        jQuery('#ytfeedbackcontacts [value="myselect"]').attr('selected', 'selected');
        jQuery('.ytfeedbackcalltr,.ytfeedbackcallbacktr,.ytfeedbackchattr,.ytfeedbackmailtr,.ytfeedbackvkontaktetr,.ytfeedbackodnoklassnikitr,.ytfeedbacktwittertr,.ytfeedbackfacebooktr,.ytfeedbackvibertr,.ytfeedbackwhatsapptr,.ytfeedbacktelegramtr').hide();
        if (jQuery('#ytfeedbacknetw').val().indexOf('vkontakte') == -1) {
            temp2 = jQuery('#ytfeedbacknetw').val()  + 'vkontakte' + ',';
            jQuery('#ytfeedbacknetw').val(temp2);
            jQuery('#ytfeedbacknetwspan').val(temp2);
            jQuery('#ytfeedbackcontacts [value="feedbackvkontakte"]').removeAttr('disabled');
        } else {
            temp2 = jQuery('#ytfeedbacknetw').val();
            temp2 = temp2.replaceAll('vkontakte,', '');
            jQuery('#ytfeedbacknetw').val(temp2);
            jQuery('#ytfeedbacknetwspan').val(temp2);
            jQuery('#ytfeedbackcontacts [value="feedbackvkontakte"]').attr('disabled', 'disabled');
        }
    })
});
jQuery(function() {
    jQuery('#feedbackodnoklassniki').click(function(){
        jQuery('#ytfeedbackcontacts [value="myselect"]').attr('selected', 'selected');
        jQuery('.ytfeedbackcalltr,.ytfeedbackcallbacktr,.ytfeedbackchattr,.ytfeedbackmailtr,.ytfeedbackvkontaktetr,.ytfeedbackodnoklassnikitr,.ytfeedbacktwittertr,.ytfeedbackfacebooktr,.ytfeedbackvibertr,.ytfeedbackwhatsapptr,.ytfeedbacktelegramtr').hide();
        if (jQuery('#ytfeedbacknetw').val().indexOf('odnoklassniki') == -1) {
            temp2 = jQuery('#ytfeedbacknetw').val()  + 'odnoklassniki' + ',';
            jQuery('#ytfeedbacknetw').val(temp2);
            jQuery('#ytfeedbacknetwspan').val(temp2);
            jQuery('#ytfeedbackcontacts [value="feedbackodnoklassniki"]').removeAttr('disabled');
        } else {
            temp2 = jQuery('#ytfeedbacknetw').val();
            temp2 = temp2.replaceAll('odnoklassniki,', '');
            jQuery('#ytfeedbacknetw').val(temp2);
            jQuery('#ytfeedbacknetwspan').val(temp2);
            jQuery('#ytfeedbackcontacts [value="feedbackodnoklassniki"]').attr('disabled', 'disabled');
        }
    })
});
jQuery(function() {
    jQuery('#feedbacktwitter').click(function(){
        jQuery('#ytfeedbackcontacts [value="myselect"]').attr('selected', 'selected');
        jQuery('.ytfeedbackcalltr,.ytfeedbackcallbacktr,.ytfeedbackchattr,.ytfeedbackmailtr,.ytfeedbackvkontaktetr,.ytfeedbackodnoklassnikitr,.ytfeedbacktwittertr,.ytfeedbackfacebooktr,.ytfeedbackvibertr,.ytfeedbackwhatsapptr,.ytfeedbacktelegramtr').hide();
        if (jQuery('#ytfeedbacknetw').val().indexOf('twitter') == -1) {
            temp2 = jQuery('#ytfeedbacknetw').val()  + 'twitter' + ',';
            jQuery('#ytfeedbacknetw').val(temp2);
            jQuery('#ytfeedbacknetwspan').val(temp2);
            jQuery('#ytfeedbackcontacts [value="feedbacktwitter"]').removeAttr('disabled');
        } else {
            temp2 = jQuery('#ytfeedbacknetw').val();
            temp2 = temp2.replaceAll('twitter,', '');
            jQuery('#ytfeedbacknetw').val(temp2);
            jQuery('#ytfeedbacknetwspan').val(temp2);
            jQuery('#ytfeedbackcontacts [value="feedbacktwitter"]').attr('disabled', 'disabled');
        }
    })
});
jQuery(function() {
    jQuery('#feedbackfacebook').click(function(){
        jQuery('#ytfeedbackcontacts [value="myselect"]').attr('selected', 'selected');
        jQuery('.ytfeedbackcalltr,.ytfeedbackcallbacktr,.ytfeedbackchattr,.ytfeedbackmailtr,.ytfeedbackvkontaktetr,.ytfeedbackodnoklassnikitr,.ytfeedbacktwittertr,.ytfeedbackfacebooktr,.ytfeedbackvibertr,.ytfeedbackwhatsapptr,.ytfeedbacktelegramtr').hide();
        if (jQuery('#ytfeedbacknetw').val().indexOf('facebook') == -1) {
            temp2 = jQuery('#ytfeedbacknetw').val()  + 'facebook' + ',';
            jQuery('#ytfeedbacknetw').val(temp2);
            jQuery('#ytfeedbacknetwspan').val(temp2);
            jQuery('#ytfeedbackcontacts [value="feedbackfacebook"]').removeAttr('disabled');
        } else {
            temp2 = jQuery('#ytfeedbacknetw').val();
            temp2 = temp2.replaceAll('facebook,', '');
            jQuery('#ytfeedbacknetw').val(temp2);
            jQuery('#ytfeedbacknetwspan').val(temp2);
            jQuery('#ytfeedbackcontacts [value="feedbackfacebook"]').attr('disabled', 'disabled');
        }
    })
});
jQuery(function() {
    jQuery('#feedbackviber').click(function(){ 
        jQuery('#ytfeedbackcontacts [value="myselect"]').attr('selected', 'selected');
        jQuery('.ytfeedbackcalltr,.ytfeedbackcallbacktr,.ytfeedbackchattr,.ytfeedbackmailtr,.ytfeedbackvkontaktetr,.ytfeedbackodnoklassnikitr,.ytfeedbacktwittertr,.ytfeedbackfacebooktr,.ytfeedbackvibertr,.ytfeedbackwhatsapptr,.ytfeedbacktelegramtr').hide();
        if (jQuery('#ytfeedbacknetw').val().indexOf('viber') == -1) {
            temp2 = jQuery('#ytfeedbacknetw').val()  + 'viber' + ',';
            jQuery('#ytfeedbacknetw').val(temp2);
            jQuery('#ytfeedbacknetwspan').val(temp2);
            jQuery('#ytfeedbackcontacts [value="feedbackviber"]').removeAttr('disabled');
        } else {
            temp2 = jQuery('#ytfeedbacknetw').val();
            temp2 = temp2.replaceAll('viber,', '');
            jQuery('#ytfeedbacknetw').val(temp2);
            jQuery('#ytfeedbacknetwspan').val(temp2);
            jQuery('#ytfeedbackcontacts [value="feedbackviber"]').attr('disabled', 'disabled');
        }
    })
});
jQuery(function() {
    jQuery('#feedbackwhatsapp').click(function(){
        jQuery('#ytfeedbackcontacts [value="myselect"]').attr('selected', 'selected');
        jQuery('.ytfeedbackcalltr,.ytfeedbackcallbacktr,.ytfeedbackchattr,.ytfeedbackmailtr,.ytfeedbackvkontaktetr,.ytfeedbackodnoklassnikitr,.ytfeedbacktwittertr,.ytfeedbackfacebooktr,.ytfeedbackvibertr,.ytfeedbackwhatsapptr,.ytfeedbacktelegramtr').hide();
        if (jQuery('#ytfeedbacknetw').val().indexOf('whatsapp') == -1) {
            temp2 = jQuery('#ytfeedbacknetw').val()  + 'whatsapp' + ',';
            jQuery('#ytfeedbacknetw').val(temp2);
            jQuery('#ytfeedbacknetwspan').val(temp2);
            jQuery('#ytfeedbackcontacts [value="feedbackwhatsapp"]').removeAttr('disabled');
        } else {
            temp2 = jQuery('#ytfeedbacknetw').val();
            temp2 = temp2.replaceAll('whatsapp,', '');
            jQuery('#ytfeedbacknetw').val(temp2);
            jQuery('#ytfeedbacknetwspan').val(temp2);
            jQuery('#ytfeedbackcontacts [value="feedbackwhatsapp"]').attr('disabled', 'disabled');
        }
    })
});
jQuery(function() {
    jQuery('#feedbacktelegram').click(function(){
        jQuery('#ytfeedbackcontacts [value="myselect"]').attr('selected', 'selected');
        jQuery('.ytfeedbackcalltr,.ytfeedbackcallbacktr,.ytfeedbackchattr,.ytfeedbackmailtr,.ytfeedbackvkontaktetr,.ytfeedbackodnoklassnikitr,.ytfeedbacktwittertr,.ytfeedbackfacebooktr,.ytfeedbackvibertr,.ytfeedbackwhatsapptr,.ytfeedbacktelegramtr').hide();
        if (jQuery('#ytfeedbacknetw').val().indexOf('telegram') == -1) {
            temp2 = jQuery('#ytfeedbacknetw').val()  + 'telegram' + ',';
            jQuery('#ytfeedbacknetw').val(temp2);
            jQuery('#ytfeedbacknetwspan').val(temp2);
            jQuery('#ytfeedbackcontacts [value="feedbacktelegram"]').removeAttr('disabled');
        } else {
            temp2 = jQuery('#ytfeedbacknetw').val();
            temp2 = temp2.replaceAll('telegram,', '');
            jQuery('#ytfeedbacknetw').val(temp2);
            jQuery('#ytfeedbacknetwspan').val(temp2);
            jQuery('#ytfeedbackcontacts [value="feedbacktelegram"]').attr('disabled', 'disabled');
        }
    })
});

jQuery(function() {
    jQuery('#showlistrss').click(function(){
        if (jQuery('#allrss').is(':hidden')) {
            jQuery('#allrss').fadeIn();
            jQuery('#showlistrss').text('скрыть');
        } else {
            jQuery('#allrss').hide();
            jQuery('#showlistrss').text('показать');
        }
    })
});

(function($) {
$(function() {

    $('ul.xyztabs__caption').on('click', 'li:not(.active)', function() {
        $(this)
            .addClass('active').siblings().removeClass('active')
            .closest('div.xyztabs').find('div.xyztabs__content').removeClass('active').eq($(this).index()).addClass('active');
            $('#yttab').val($('.xyztabs__caption li.active').text());
    });

    var tabIndex = window.location.hash.replace('#tab','')-1;
    if (tabIndex != -1) $('ul.xyztabs__caption li').eq(tabIndex).click();

    $('a[href*=#tab]').click(function() {
        var tabIndex = $(this).attr('href').replace(/(.*)#tab/, '')-1;
        $('ul.xyztabs__caption li').eq(tabIndex).click();
    });

});
})(jQuery);

jQuery(document).ready(function($){

    checkExpTime();

    $('#close-donat').on('click',function(e) {
        localStorage.setItem('yt-close-donat', 'yes');
        $('#donat').slideUp(300);
        $('#restore-hide-blocks').show(300);
        setExpTime();
    });

    $('#close-about').on('click',function(e) {
        localStorage.setItem('yt-close-about', 'yes');
        $('#about').slideUp(300);
        $('#restore-hide-blocks').show(300);
        setExpTime();
    });

    $('#restore-hide-blocks').on('click',function(e) {
        localStorage.removeItem('yt-time');
        localStorage.removeItem('yt-close-donat');
        localStorage.removeItem('yt-close-about');
        $('#restore-hide-blocks').hide(300);
        $('#donat').slideDown(300);
        $('#about').slideDown(300);
    });

    function setExpTime() {
        var limit = 90 * 24 * 60 * 60 * 1000; // 3 месяца
        var time = localStorage.getItem('yt-time');
        if (time === null) {
            localStorage.setItem('yt-time', +new Date());
        } else if(+new Date() - time > limit) {
            localStorage.removeItem('yt-time');
            localStorage.removeItem('yt-close-donat');
            localStorage.removeItem('yt-close-about');
            localStorage.setItem('yt-time', +new Date());
        }
    }

    function checkExpTime() {
        var limit = 90 * 24 * 60 * 60 * 1000; // 3 месяца
        var time = localStorage.getItem('yt-time');
        if (time === null) {

        } else if(+new Date() - time > limit) {
            localStorage.removeItem('yt-time');
            localStorage.removeItem('yt-close-donat');
            localStorage.removeItem('yt-close-about');
        }
    }

});

jQuery(document).ready(function($) {

    var str = $('#tags-list').val();
    var whitelist = str.split(',');

    var input = document.querySelector('input[name="ytexcludetagslist-input"]'),
        tagify = new Tagify(input, {
            whitelist: whitelist,
            enforceWhitelist: true,
            dropdown: {
                maxItems: 20,
                classname: 'tags-look',
                enabled: 0,
                closeOnSelect: false,
            }
        })

    tagify
        .on('add', onAddTag)
        .on('remove', onRemoveTag)
        .on('invalid', onInvalidTag)

    function onAddTag(e) {

        $('tag').data('title', $('tag').attr('title')).removeAttr('title');
        var str = tagify.DOM.originalInput.value;
        var temp = str.replace(/{"value":"/g, '');
        temp = temp.replace(/"}/g, '');
        temp = temp.replace(/"}/g, '');
        temp = temp.replace(/\[/g, '');
        temp = temp.replace(/\]/g, '');

        $('#ytexcludetagslist').val(temp);
    }

    function onRemoveTag(e) {
        if ($('tags').hasClass('tagify--focus')) {
            tagify.dropdown.hide.call(tagify);
            $('tags').removeClass('tagify--focus');
        }

        var str = tagify.DOM.originalInput.value;
        var temp = str.replace(/{"value":"/g, '');
        temp = temp.replace(/"}/g, '');
        temp = temp.replace(/"}/g, '');
        temp = temp.replace(/\[/g, '');
        temp = temp.replace(/\]/g, '');

        $('#ytexcludetagslist').val(temp);

    }

    function onInvalidTag(e) {
        tagify.dropdown.show.call(tagify);
    }

    $('tag').data('title', $('tag').attr('title')).removeAttr('title');

});


jQuery(document).ready(function($) {

    var str = $('#tags-list2').val();
    var whitelist = str.split(',');

    var input = document.querySelector('input[name="ytexcludetagslist-input2"]'),
        tagify2 = new Tagify(input, {
            whitelist: whitelist,
            enforceWhitelist: true,
            dropdown: {
                maxItems: 20,
                classname: 'tags-look',
                enabled: 0,
                closeOnSelect: false,
            }
        })

    tagify2
        .on('add', onAddTag2)
        .on('remove', onRemoveTag2)
        .on('invalid', onInvalidTag2)

    function onAddTag2(e) {

        $('tag').data('title', $('tag').attr('title')).removeAttr('title');
        var str = tagify2.DOM.originalInput.value;
        var temp = str.replace(/{"value":"/g, '');
        temp = temp.replace(/"}/g, '');
        temp = temp.replace(/"}/g, '');
        temp = temp.replace(/\[/g, '');
        temp = temp.replace(/\]/g, '');

        $('#ytexcludetagslist2').val(temp);
    }

    function onRemoveTag2(e) {
        if ($('tags').hasClass('tagify--focus')) {
            tagify2.dropdown.hide.call(tagify2);
            $('tags').removeClass('tagify--focus');
        }

        var str = tagify2.DOM.originalInput.value;
        var temp = str.replace(/{"value":"/g, '');
        temp = temp.replace(/"}/g, '');
        temp = temp.replace(/"}/g, '');
        temp = temp.replace(/\[/g, '');
        temp = temp.replace(/\]/g, '');

        $('#ytexcludetagslist2').val(temp);

    }

    function onInvalidTag2(e) {
        tagify2.dropdown.show.call(tagify2);
    }

    $('tag').data('title', $('tag').attr('title')).removeAttr('title');

});