define(function(require, exports, module) {

    var $ = require('jquery');
    var dot = require('dot');
    var functions = require('js/modules/functions');
    
    require('js/plugins/jquery/jeditable')($);
    var admin = require('js/modules/admin');
    
    exports.init = function() {
        $('#btn_addoption').live('click', function() {
            var self = $(this);
            var form_option = self.parents('form[name="form_option"]');
           
            var option_data = {
                content: form_option.find('textarea[name="option_content"]').val(),
                question_id: form_option.find('input[name="question_id"]').val()
            };

           

            functions.addbtn_function_dot($(this), option_data, 'option_tr_tmpl', '#question_'+option_data.question_id+' ol');
            $('#add-option-modal').modal('hide');
            return false;
        });

        $('a#add-option-modal-btn').live('click', function() {
            var question_id = $(this).attr('data');
            $('#add-option-modal').find('input[name="question_id"]').val(question_id);
        });


        // $('.editable-option-textarea').dblclick(function(){
        //     $(this).parent().append('<div class="clearfix"></div>');
        // });

        $('.editable-option-textarea').editable(admin.base_url+'option/update_option', {
            indicator : '<img src="admin_dir/images/indicator.gif">',
            type   : "textarea",
            onblur : 'submit',
            style  : 'display: inherit;',
            name   : 'content',
            event  : "dblclick",
            submitdata : function(value, settings) {
                return {
                    id: $(this).attr('data'),
                };
            },
            callback : function(data, settings) {
                data = $.parseJSON(data);
                var content = data.data.content;
                $(this).html(content);
               // $(this).parent().find('div[class="clearfix"]').remove();
            }
        });
    }


});