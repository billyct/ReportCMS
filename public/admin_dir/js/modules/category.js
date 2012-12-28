define(function(require, exports, module) {

    var $ = require('jquery');
    var dot = require('dot');
    var functions = require('js/modules/functions');


    exports.init = function() {
        $('#btn_addcategory').live('click', function() {

            var self = $(this);
            var form_cateogry = self.parents('form[name="form_category"]');
            
            var category_data = {
                name: form_cateogry.find('input[name="category_name"]').val()
            };

            functions.addbtn_function_dot($(this), category_data, 'category_tr_tmpl', '#categorylist_table tbody');

            return false;
        });
    }


});