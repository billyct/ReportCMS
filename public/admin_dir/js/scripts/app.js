define(function(require, exports, module) {

    var $ = require('jquery');
    require('bootstrap/bootstrap-dropdown')($);
    require('bootstrap/bootstrap-modal')($);

    //一些小字体
    $('#loading-block').fadeOut(function() {
        // var cufon = require('cufon');
        // require('js/scripts/cufon_yh.js')(cufon);
        // cufon.replace ('#yh_text', {fontFamily: 'Microsoft YaHei'});
        console.log('enjoy it');
    });




    var admin = require('js/modules/admin');
   // admin.nav();
    admin.nav_side();
    admin.tooltip();
    admin.delete_link();


    var topic = require('js/modules/topic');
    topic.init();

    var question = require('js/modules/question');
    question.init();

    var option = require('js/modules/option');
    option.init();

    // var product = require('js/modules/product');
    // product.init();

    // var category = require('js/modules/category');
    // category.init();

});