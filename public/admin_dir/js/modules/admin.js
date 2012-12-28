define(function(require, exports, module) {

    var $ = require('jquery');
    var alert = require('apprise');
    require('bootstrap/bootstrap-tooltip')($);
    
    // exports.nav = function(){
    //     $('.nav li').hover(
    //         function() {
    //             $(this).addClass('active');
    //         }, 
    //         function() {
    //             if (!$(this).hasClass('current_link')) {
    //                 $(this).removeClass('active');
    //             }
    //         }
    //     );
    // }

    exports.nav_side = function() {
        $('.link_side').live('click', function(){
            var self = $(this);
            var div_id = self.attr('href');
            //加载表单
            $('.div_href').hide();
            $(div_id).show();
            //修改导航边栏的样式
            self.parents('li').siblings('.current_link').removeClass();
            self.parents('li').addClass('active current_link');

        });
    }

    exports.tooltip = function() {
        $('a[rel="tooltip"]').tooltip();
    }

    exports.delete_link = function() {
        $('.delete_link').live('click', function(){
            var self = $(this);
            var attr_data = $(this).attr('data');
            var delete_link = $(this).attr('href');
            if (attr_data) {
                $.post(delete_link, {
                    id : attr_data
                }, function(data){
                    data = $.parseJSON(data);
                    alert.apprise(data['msg'], {'animate': true, 'textOk': '确定'});
                    if (data['code'] == 1) {
                        self.parent().remove();
                    }
                });
            }else {
                self.parent().remove();
            }

            return false;
        });
    }

    exports.base_url = "http://r.localhost/admin/";

});