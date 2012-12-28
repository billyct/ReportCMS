$(document).ready(function () {
	var $chooser = $("#stylechooser");
	var $container = $("#slideContainer");
	var mode = "cube";

	$("#slideContainer").ctMpress({
		mode: mode
	}).bind("show", function (e, id) {
		if (id == "#portfolio") {
			launchQuicksand();
			loadAndLaunchThickbox()
		}
		// if ($('.pieChart').children().length == 0){
		// 	launchChart();
		// }
		
	});
	$("#menu a").click(function () {
		$(this).closest(".nav-collapse").collapse('hide');
		return false
	})
});

var base_url = "http://r.localhost/";

function launchChart() {
	yepnope([{
		load: [base_url+'home_dir/js/raphael-min.js', base_url+'home_dir/js/pieChart.js'],
		complete: function(url, result, key) {
		    $('.question').each(function(){
		        var values = [],
		            labels = [];
		        var self = $(this);
		        $(this).find('tr').each(function(){
		            values.push(parseInt($("td", this).text(), 10));
		            labels.push($("th", this).text());
		        });
		        console.log(values);
		        console.log(labels);
		        console.log(self.find('.pieChart')[0]);
		        self.find('table').hide();
		        Raphael(self.find('.pieChart')[0], 400, 120).pieChart(10, 40, 30, values, labels, "#000000");
		    });
		}
	}]);
}

function launchQuicksand() {
	yepnope([{
		load: ["js/jquery.easing.js", "js/jquery.quicksand.js"],
		complete: function (url, result, key) {
			var p = $('#portfolios1');
			var f = $('.filterPortfolio');
			var data = p.clone();
			f.find('a').click(function () {
				var link = $(this);
				var li = link.parents('li');
				if (li.hasClass('active')) {
					return false
				}
				f.find('li').removeClass('active');
				li.addClass('active');
				var filtered = li.data('filter') ? data.find('li[data-filter~="' + li.data('filter') + '"]') : data.find('li');
				p.quicksand(filtered, {
					duration: 800,
					easing: 'easeInOutQuad'
				},
				function () {
					launchThickbox(1)
				});
				return false
			})
		}
	}])
}
function loadAndLaunchThickbox() {
	yepnope.injectCss("css/thickbox.css");
	yepnope([{
		load: ["js/thickbox.js"],
		complete: function (url, result, key) {
			launchThickbox(0)
		}
	}])
}
function launchThickbox(i) {
	$("#portfolios1 a").addClass("thickbox").attr("rel", "set");
	if (i == 1) {
		console.log("reassign thickbox");
		tb_init('a.thickbox, area.thickbox, input.thickbox')
	}
}