$(document).ready(function() {
	// 收缩侧边导航
	$("#openNav .extendBtn").on("click",function() {
		$("#openNav").hide();
		$("#closeNav").show();
		return false;
	});

	$("#closeNav .extendBtn").on("click",function() {
		$("#closeNav").hide();
		$("#openNav").show();
		return false;
	});

	// 侧边导航下拉
	$("#openNav > ul > li > a").on("click",function() {
		if ($(this).parent().hasClass("open")) {
			$(this).next().hide();
			$(this).parent().removeClass("open");
		} else {
			$(this).next().show();
			$(this).parent().addClass("open");
		}
		return false;
	});

	// input date（请根据需要在各个页面自行修改）
	$(".Wdate").on("focus",function() {
		WdatePicker({isShowClear:false,readOnly:true});
	});

	// tab选项卡
	$(".tabNav li").on("click",function() {
		$(".tabNav .active").removeClass("active");
		$(".tabContent .active").removeClass("active");
		$(this).addClass("active");
		$(".tabContent div").eq($(this).index()).addClass("active");
	});

	// 表格全选
	$("tr th input:checkbox").on("change",function() {
		var index = $(this).index();
		var td = $(this).parents("table").find("tr td").eq(index).children("input");
		if ($(this).is(":checked")) {
			td.prop("checked",true);
		} else {
			td.prop("checked",false);
		}
	})
});

/**
 * 弹窗功能模块
 * @param {obj} obj 弹窗对象
 */
function PopUps(obj) {
	this.init(obj);
}

$.extend(PopUps.prototype, {
	init : function(obj) {
		this.obj = $(obj);
		this.show();
	},
	// 显示弹窗
	show : function() {
		$(".shadow").show();
		this.obj.show();
		this.obj.css({"margin-top": - this.obj.height()/2 + "px", "margin-left": - this.obj.width()/2 + "px"});
		this.move();
		this.close();
	},
	// 隐藏弹窗
	hide : function() {
		$(".shadow").hide();
		this.obj.hide();
	},
	// 弹窗拖拽
	move : function() {
		var that = this;
			console.log($(this.obj));

		$(this.obj).mousedown(function(e) {
			var oldLeft = $(that.obj).offset().left,
				oldTop = $(that.obj).offset().top,
				width = e.pageX - oldLeft,
				height = e.pageY - oldTop;

			$(document).mousemove(function(e) {
				var left = e.pageX + $(document).scrollLeft() - width,
					top = e.pageY + $(document).scrollTop() - height;

				// 控制弹窗在窗口可视范围内
				if (left < 0) {
					left = 0;
				}

				if (left > $(window).width() - $(that.obj).width()) {
					left = $(window).width() - $(that.obj).width();
				}

				if (top < 0) {
					top = 0;
				}

				if (top > $(window).height() - $(that.obj).height()) {
					top = $(window).height() - $(that.obj).height();
				}

				$(that.obj).offset({top : top, left : left});
				return false;
			});

			$(document).mouseup(function() {
				$(document).off("mousemove");
				$(document).off("mouseup");
				return false;
			});
		});
	},
	// 点击关闭弹窗
	close : function() {
		var that = this;

		this.obj.find("h3 .close").on("click",function() {
			that.hide();
		});
	}
});