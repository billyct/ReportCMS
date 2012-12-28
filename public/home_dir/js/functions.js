$(document).ready(function () {

	$('#btn-submit-answer').live('click', function(){
			
		var fields = $(".question select, .question :radio,.question :checkbox,.question textarea").serializeArray();
		var answers = new Array();
		var topic_id = $(this).attr('data');

		$.each( fields, function(i, field){
		  var question_id = field.name.replace(/[^0-9]/ig, "");
		  answers.push({
		  	question_id: question_id,
		  	option_id: field.value,
		  	topic_id: topic_id
		  });
		});

		$.post('http://r.localhost/visitor/submit', {
			answers: answers
		}, function(data){
			if (data.code == 1) {
				// console.log(data.msg);

				location.reload();
			}
		},'json');

		return false;
	});
});