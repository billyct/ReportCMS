define(function(require, exports, module) {

    var $ = require('jquery');
    var dot = require('dot');
    var functions = require('js/modules/functions');
    require('bootstrap/bootstrap-tab')($);

    var admin = require('js/modules/admin');


    exports.init = function() {
        $('#btn_addtopic').live('click', function() {

            var self = $(this);
            var form_cateogry = self.parents('form[name="form_topic"]');
            
            var topic_data = {
                name: form_cateogry.find('input[name="topic_name"]').val()
            };

            functions.addbtn_function_dot($(this), topic_data, 'topic_tr_tmpl', '#topic-tab');

            $('.tab-content').append();

            return false;
        });

        $('button#delete-topic').live('click', function(){
            var topic_id = $(this).attr('data');
            $('#topic_'+topic_id).remove();
            $('#topic-tab a:first').tab('show');
        });

        $('#topic-tab a:first').tab('show');

        $('#topic-tab a').click(function (e) {
          e.preventDefault();
          $(this).tab('show');
        });



        $('a#display-topic-btn').live('click', function(){
            var self = $(this);

            var display_data = {
                id: self.attr('data'),
                display: (self.children().attr('data') == 0)?1:0
            };

            $.post(admin.base_url+'topic/update_topic', display_data, function(data){
                if (data.code == 1) {
                    self.children().attr('data', display_data.display);
                    self.children().toggleClass(function() {
                      if ($(this).hasClass('icon-star-empty')) {
                        $(this).removeClass('icon-star-empty');
                        return 'icon-star';
                      } else {
                        $(this).removeClass('icon-star');
                        return 'icon-star-empty';
                      }
                    });
                };
            },'json');

            return false;
        });
    }


});