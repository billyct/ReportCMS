(function ($) {
	var pluginName = "ctMpress";
	var methods = {
		init: function (options) {
			options = $.extend({},
			$.fn.ctMpress.defaults, options);
			return this.each(function () {
				var $this = $(this);
				var $menu = $(options.menuSelector);
				$this.data(pluginName, {
					options: options,
					$menu: $menu
				});
				if ($.browser.mobile || !Modernizr.csstransforms || !Modernizr.csstransforms3d) {
					return initNon3D.apply($this)
				} else {
					return init3D.apply($this)
				}
			})
		}
	};
	var init3D = function () {
		var $this = $(this),
		data = $this.data(pluginName),
		options = data.options,
		$menu = data.$menu;
		$this.addClass("ct-transparency-" + options.transparency);
		$("a[data-slide]", $menu).each(function () {
			var $this = $(this);
			var src = $this.attr("href");
			var slide = $this.data("slide");
			$this.attr("href", $this.data("slide"));
			if ($(slide).html() != "") {
				putScrollbar($(slide));
				return
			}
			$.ajax({
				type: "get",
				url: src,
				dataType: "html",
				success: function (html) {
					$(slide).html($(".step:nth(0)", $(html)).html());
					putScrollbar($(slide))
				}
			})
		});
		yepnope.injectJs("home_dir/js/jmpress.js", function () {
			if (options.mode != null) {
				assignTemplate.apply($this, [options.mode])
			}
			$this.jmpress({
				stepSelector: options.stepSelector,
				mouse: {
					clickSelects: false
				},
				fullscreen: false,
				beforeChange: function (e, data) {
					var id = e.attr("id");
					$this.trigger("show", ["#" + id]);
					$("." + options.menuActiveClass, $menu).removeClass(options.menuActiveClass);
					$("a[href=#" + id + "]").closest("li").addClass(options.menuActiveClass)
				}
			})
		})
	};
	var initNon3D = function () {
		var $this = $(this),
		data = $this.data(pluginName),
		options = data.options,
		$menu = data.$menu;
		$("body").addClass("ct-non3D");
		var $step = $(".step:nth(0)");
		$(".step:not(#" + $step.attr("id") + ")").remove();
		$step.attr("id", "step");
		putScrollbar($step);
		yepnope({
			load: ["home_dir/js/jquery.easing.js", "home_dir/js/jnavigate.js"],
			callback: {
				"js/jnavigate.js": function () {
					$("#step").jNavigate({
						extTrigger: '#menu a',
						showLoader: false
					}).bind("ajaxloaded", function () {
						$this.trigger("show", [$("." + options.menuActiveClass + " a", $menu).data("slide")]);
						putScrollbar($("#step"))
					})
				}
			}
		});
		$("a", $menu).click(function () {
			$("." + options.menuActiveClass, $menu).removeClass(options.menuActiveClass);
			$(this).closest("li").addClass(options.menuActiveClass)
		})
	};
	var assignTemplate = function (template) {
		loadTemplate(template);
		$(this).attr("data-template", template)
	};
	var loadTemplate = function (template) {
		switch (template) {
		case "cube":
			$.jmpress("template", template, {
				children: function (idx, current_child, children) {
					switch (idx) {
					case 0:
						return {
							z:
							-1000,
							template: template
						};
					case 1:
						return {
							z:
							-1500,
							x: 1000,
							rotateY: 90,
							template: template
						};
					case 2:
						return {
							z:
							-2000,
							rotateY: 180,
							template: template
						};
					case 3:
						return {
							z:
							-1500,
							rotateY: 270,
							x: -1000,
							template: template
						}
					}
				}
			});
			break;
		case "path":
			$.jmpress("template", template, {
				children: function (idx, current_child, children) {
					switch (idx) {
					case 0:
						return {
							template:
							template
						};
					case 1:
						return {
							x:
							1000,
							rotate: 90,
							template: template
						};
					case 2:
						return {
							x:
							2000,
							rotate: 90,
							template: template
						};
					case 3:
						return {
							x:
							3000,
							rotate: 30,
							template: template
						}
					}
				}
			});
			break;
		case "circle":
			$.jmpress("template", template, {
				children: function (idx, current_child, children) {
					switch (idx) {
					case 0:
						return {
							template:
							template
						};
					case 1:
						return {
							x:
							1000,
							y: 1000,
							rotate: 90,
							template: template
						};
					case 2:
						return {
							x:
							0,
							y: 2000,
							rotate: 180,
							template: template
						};
					case 3:
						return {
							x:
							-1000,
							y: 1000,
							rotate: 270,
							template: template
						}
					}
				}
			});
			break;
		case "slideshow":
			$.jmpress("template", template, {
				children: function (idx, current_child, children) {
					return {
						z: -idx * 2000
					}
				}
			});
			break;
		case "crazyslideshow":
			$.jmpress("template", template, {
				children: function (idx, current_child, children) {
					return {
						z: -idx * 2000,
						rotate: Math.random() * 360
					}
				}
			});
			break;
		default:
			$.error("Incorrect mode selected (" + template + ")")
		}
	};
	var putScrollbar = function ($slide) {
		if ($(".viewport", $slide).height() < $(".overview", $slide).height() && !$.browser.mobile && !Modernizr.touch) {
			$slide.tinyscrollbar({
				sizethumb: 30,
				invertscroll: Modernizr.touch
			});
			$(".scrollbar", $slide).css("visibility", "visible")
		}
	};
	$.fn.ctMpress = function (method) {
		if (methods[method]) {
			return methods[method].apply(this, Array.prototype.slice.call(arguments, 1))
		} else if (typeof method === 'object' || !method) {
			return methods.init.apply(this, arguments)
		} else {
			$.error('Method ' + method + ' does not exist on ctMpress lib!')
		}
	};
	$.fn.ctMpress.defaults = {
		mode: "cube",
		transparency: "semi",
		stepSelector: ".step",
		menuSelector: "#menu",
		menuActiveClass: "active"
	}
})(jQuery);