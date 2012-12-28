define(function(require, exports, module) {

    var $ = require('jquery');
    var dot = require('dot');
    var functions = require('js/modules/functions');

    require('js/plugins/jquery/jeditable')($);
    var admin = require('js/modules/admin');

    exports.init = function() {
        $('#btn_addquestion').live('click', function() {
            var self = $(this);
            var form_question = self.parents('form[name="form_question"]');
           
            var question_data = {
                title: form_question.find('textarea[name="question_title"]').val(),
                type: form_question.find('select[name="question_type"]').val(),
                topic_id: form_question.find('input[name="topic_id"]').val()
            };


            functions.addbtn_function_dot($(this), question_data, 'question_tr_tmpl', '#topic_'+question_data.topic_id+' #questions');


            $('#add-question-modal').modal('hide');
            return false;
        });


        $('a#add-question-modal-btn').live('click', function(){
            var self = $(this);
            var topic_id = self.attr('data');

            console.log(topic_id);

            $('#add-question-modal').find('input[name="topic_id"]').val(topic_id);
        });

        var type_select = {
            1:'单选题',
            2:'多选题',
            3:'判断题',
            4:'填空'
        };

        $('.editable-type-select').editable(admin.base_url+'question/update_question', { 
            indicator : '<img src="admin_dir/images/indicator.gif">',
            data   : type_select,
            type   : "select",
            style  : "display: inline",
            onblur : 'submit',
            name   : 'type',
            event  : "dblclick",
            submitdata : function(value, settings) {
                return {
                    id: $(this).attr('data'),
                };
            },
            callback : function(data, settings) {
                data = $.parseJSON(data);
                var type = data.data.type;
                $(this).html(type_select[type]);
            }
        });

        $('.editable-title-textarea').editable(admin.base_url+'question/update_question', {
            indicator : '<img src="admin_dir/images/indicator.gif">',
            type   : "textarea",
            style  : "inherit",
            onblur : 'submit',
            name   : 'title',
            event  : "dblclick",
            submitdata : function(value, settings) {
                return {
                    id: $(this).attr('data'),
                };
            },
            callback : function(data, settings) {
                data = $.parseJSON(data);
                var title = data.data.title;
                $(this).html(title);
            }
        });

    }


});