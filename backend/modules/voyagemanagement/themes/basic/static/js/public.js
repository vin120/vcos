$(document).ready(function(){
	// 加载header和asideNav内容
	// $("#header").load("header.html");
	// $("#asideNav").load("asideNav.html");
	
	//自定义验证
	jQuery.validator.addMethod("isEnglish", function(value, element) {       
        return this.optional(element) || /^[A-Za-z0-9\r\t ']+$/.test(value);       
   }, "Can only input English"); 
	
	$.extend($.validator.messages, {
	    required: "Required fields",
	    maxlength: $.validator.format("Please enter no more than {0} characters."), 
	});
	
	
	
	//delete删除弹框
	$(document).on('click',".delete",function(e) {
		var val = $(this).attr('id');
		 $(".ui-widget-overlay").remove();
		 $("#promptBox").remove();
		 var str = "<div class='ui-widget-overlay ui-front'></div>";
		 var str_con = '<div id="promptBox" class="pop-ups write ui-dialog" >';
			str_con += '<h3>提示</h3>';
			str_con += '<span class="op"><a class="close r"></a></span>';
			str_con += '<p>是否删除？</p>';
			str_con += '<p class="btn">';
			str_con += '<input type="button" class="confirm_but" value="确定"></input>';
			str_con += '<input type="button" class="cancel_but" value="取消"></input>';
			str_con += '</p></div>';
			
		 //$("#promptBox").before(str);
		 $(document.body).append(str);
		 $(document.body).append(str_con);
		 //$("#promptBox").removeClass('hide');
		 
		 $(".btn > .confirm_but").attr('id',val);
	 });
	
	//多选删除弹框

	$("#del_submit").on('click',function(){
		 $(".ui-widget-overlay").remove();
		 $("#promptBox").remove();
		 
		 var str = "<div class='ui-widget-overlay ui-front'></div>";
		 var str_con = '<div id="promptBox" class="pop-ups write ui-dialog" >';
			str_con += '<h3>提示</h3>';
			str_con += '<span class="op"><a class="close r"></a></span>';
			str_con += '<p>这些记录是否删除？</p>';
			str_con += '<p class="btn">';
			str_con += '<input type="button" class="confirm_but_more" value="确定"></input>';
			str_con += '<input type="button" class="cancel_but" value="取消"></input>';
			str_con += '</p></div>';
		 var no_str = '<div id="promptBox" class="pop-ups write ui-dialog" >';
			no_str += '<h3>没有选中</h3>';
			no_str += '<span class="op"><a class="close r"></a></span>';
			no_str += '<p>请选择删除项</p>';
			no_str += '<p class="btn">';
			no_str += '<input type="button" class="cancel_but" value="取消"></input>';
			no_str += '</p></div>';
			
		var checkbox = $("table  tbody input[type='checkbox']:checked").length;
		 if(checkbox == 0){
			 $(document.body).append(str);
			 $(document.body).append(no_str);
		 }else{
			 $(document.body).append(str);
			 $(document.body).append(str_con);
		 }
		 
		 
	 }); 
	 
	 //鼠标拖拽
	 var _move=false;//移动标记  
	 var _x,_y;//鼠标离控件左上角的相对位置  
	     $(document).on('click',"#promptBox >h3",function(){
	         //alert("click");//点击（松开后触发）  
	         }).mousedown(function(e){  
	         _move=true;  
	         _x=e.pageX-parseInt($("#promptBox").css("left"));  
	         _y=e.pageY-parseInt($("#promptBox").css("top"));  
	        // $("#promptBox").fadeTo(20, 0.5);//点击后开始拖动并透明显示 
	     });  
	     $(document).mousemove(function(e){ 
	    	 $("#promptBox >h3").css('cursor','move');	//出现移动图标
	         if(_move){  
	             var x=e.pageX-_x;//移动时根据鼠标位置计算控件左上角的绝对位置 
	             if (x < 0) {
	            	 x = 0;
	             } else if (x > $(window).width() - $("#promptBox").width()) {
	            	 x = $(window).width() - $("#promptBox").width();
	             }
	             
	             var y=e.pageY-_y;  
	             if(y < 0){
	            	 y = 0;
	             }else if (y > $(window).height()){
	            	 y = $(window).height();
	             }
	             $("#promptBox").css({top:y,left:x});//控件新位置  
	         }  
	     }).mouseup(function(){  
	     _move=false;  
	     //$("#promptBox").fadeTo("fast", 1);//松开鼠标后停止移动并恢复成不透明  
	   }); 
	     
	     
	     
	   //close 
	   $(document).on('click',"#promptBox >span.op,#promptBox > .btn .cancel_but",function(){
		   $(".ui-widget-overlay").addClass('hide');
		   $("#promptBox").addClass('hide');
	   })
     
	
	//国家数据验证
	$("#country_val").validate({
        rules: {
            code:{required:true,maxlength:12,isEnglish:true},
            code_chara:{required:true,maxlength:12,isEnglish:true},
            name:{required:true,maxlength:128,isEnglish:true}
        },
        errorPlacement: function(error, element) { //错误信息位置设置方法
        	error.appendTo( element.parent().parent().find("span.tips") ); //这里的element是录入数据的对象
    	},
    });
	
	//国家添加编辑页面判断code是否唯一
	$('form#country_val').submit(function(){
        var a=1;
        var op = $(this).attr('class');
        var code = $("input#code").val();
        var name = $("input#name").val();
        var code_ch = $("input#code_chara").val();
        if(code!='' && name!='' && code_ch!=''){
        	
        	var act = (op == 'country_edit')?1:2;
        	if(op == "country_edit")
        		var id = $("input#id").val();
        	else 
        		var id = '';
        	
        	 $.ajax({
			        url:ajax_url,
			        type:'get',
			        data:'code='+code+'&act='+act+'&id='+id,
			        async:false,
			     	dataType:'json',
			    	success:function(data){
			    		if(data==0) a=0;
			    		else{alert("Code can't repeat!");}
			    	}      
			    });
        }
       if(a == 1){
           return false;
       }
    });
	
	
	//港口数据验证
	$("#port_val").validate({
        rules: {
            code:{required:true,maxlength:12,isEnglish:true},
            code_chara:{required:true,maxlength:2,isEnglish:true},
            name:{required:true,maxlength:128,isEnglish:true}
        },
        errorPlacement: function(error, element) { //错误信息位置设置方法
        	error.appendTo( element.parent().parent().find("span.tips") ); //这里的element是录入数据的对象
    	},
    });
	
	//港口添加编辑页面判断港口code是否唯一
	$('form#port_val').submit(function(){
        var a=1;
        var op = $(this).attr('class');
        var code = $("input#code").val();
        var name = $("input#name").val();
        var code_ch = $("input#code_chara").val();
        if(code!='' && name!='' && code_ch!=''){
        	
        	var act = (op == 'port_edit')?1:2;
        	if(op == "port_edit")
        		var id = $("input#id").val();
        	else 
        		var id = '';
        	
        	 $.ajax({
			        url:port_ajax_url,
			        type:'get',
			        data:'code='+code+'&act='+act+'&id='+id,
			        async:false,
			     	dataType:'json',
			    	success:function(data){
			    		if(data==0) a=0;
			    		else{alert("Code can't repeat!");}
			    	}      
			    });
        }
       if(a == 1){
           return false;
       }
    });
	
	
	//cruise 
	//邮轮数据验证
	/*$("#cruise_val").validate({
        rules: {
            code:{required:true,isEnglish:true},
            desc:{required:true,isEnglish:true},
            name:{required:true,isEnglish:true},
            //photoimg:{required:true}
        },
        errorPlacement: function(error, element) { //错误信息位置设置方法
        	error.appendTo( element.parent().parent().find("span.tips") ); //这里的element是录入数据的对象
    	},
    });*/
	
	
	
	
	$("#photoimg").on('change',function(){
		var display = $("#img_back").css('display');
		if(display == 'none'){$("#img_back").css('display','')}
	});
	
	//cabin_type数据验证
	$("#cabin_type_val").validate({
        rules: {
            code:{required:true,isEnglish:true},
            desc:{required:true,isEnglish:true},
            name:{required:true,isEnglish:true}
        },
        errorPlacement: function(error, element) { //错误信息位置设置方法
        	error.appendTo( element.parent().parent().find("span.tips") ); //这里的element是录入数据的对象
    	},
    });
	
	//cabin_type添加编辑页面判断type_code是否唯一
	$('form#cabin_type_val').submit(function(){
        var a=1;
        var op = $(this).attr('class');
        var code = $("input#code").val();
        var name = $("input#name").val();
        var desc = $("textarea#desc").val();
        if(code!='' && name!='' && desc!=''){
        	
        	var act = (op == 'cabin_type_edit')?1:2;
        	if(op == "cabin_type_edit")
        		var id = $("input#id").val();
        	else 
        		var id = '';
        	
        	 $.ajax({
			        url:cabin_type_ajax_url,
			        type:'get',
			        data:'code='+code+'&act='+act+'&id='+id,
			        async:false,
			     	dataType:'json',
			    	success:function(data){
			    		if(data==0) a=0;
			    		else{alert("Code can't repeat!");}
			    	}      
			    });
        }
       if(a == 1){
           return false;
       }
    });
	
	//shore_excursion数据验证
	$("#shore_excursion_val").validate({
        rules: {
            code:{required:true,isEnglish:true},
            desc:{required:true,isEnglish:true},
            name:{required:true,isEnglish:true}
        },
        errorPlacement: function(error, element) { //错误信息位置设置方法
        	error.appendTo( element.parent().parent().find("span.tips") ); //这里的element是录入数据的对象
    	},
    });
	
	
	//shore_excursion添加编辑页面判断shore_excursion_code是否唯一
	$('form#shore_excursion_val').submit(function(){
        var a=1;
        var op = $(this).attr('class');
        var code = $("input#code").val();
        var name = $("input#name").val();
        var desc = $("textarea#desc").val();
        if(code!='' && name!='' && desc!=''){
        	
        	var act = (op == 'shore_excursion_edit')?1:2;
        	if(op == "shore_excursion_edit")
        		var id = $("input#id").val();
        	else 
        		var id = '';
        	
        	 $.ajax({
			        url:shore_excursion_ajax_url,
			        type:'get',
			        data:'code='+code+'&act='+act+'&id='+id,
			        async:false,
			     	dataType:'json',
			    	success:function(data){
			    		if(data==0) a=0;
			    		else{alert("Code can't repeat!");}
			    	}      
			    });
        }
       if(a == 1){
           return false;
       }
    });
	
	
	
	//voyage_set数据验证
	$("#voyage_set_val").validate({
        rules: {
            code:{required:true,isEnglish:true},
            desc:{required:true,isEnglish:true},
            name:{required:true,isEnglish:true},
        },
        errorPlacement: function(error, element) { //错误信息位置设置方法
        	error.appendTo( element.parent().parent().find("span.tips") ); //这里的element是录入数据的对象
    	},
    });
	$("form#voyage_set_val").submit(function(){
		
		if($("input#s_time").val()==''){
			$("input#s_time").parent().parent().find(".tips").html("Required fields");
			return false;
		}else{$("input#s_time").parent().parent().find(".tips").html("");}
		if($("input#e_time").val()==''){
			$("input#e_time").parent().parent().find(".tips").html("Required fields");
			return false;
		}else{
			$("input#e_time").parent().parent().find(".tips").html("");
		}
	});
	
	//voyage_set添加编辑页面判断voyage_code是否唯一
	$('form#voyage_set_val').submit(function(){
        var a=1;
        var op = $(this).attr('class');
        var code = $("input#code").val();
        var name = $("input#name").val();
        var desc = $("textarea#desc").val();
        if(code!='' && name!='' && desc!=''){
        	
        	var act = (op == 'voyage_set_edit')?1:2;
        	if(op == "voyage_set_edit")
        		var id = $("input#id").val();
        	else 
        		var id = '';
        	
        	 $.ajax({
			        url:voyage_set_ajax_url,
			        type:'get',
			        data:'code='+code+'&act='+act+'&id='+id,
			        async:false,
			     	dataType:'json',
			    	success:function(data){
			    		if(data==0) a=0;
			    		else{alert("Code can't repeat!");}
			    	}      
			    });
        }
       if(a == 1){
           return false;
       }
    });
	
	
	
	
	
	//船舱定价弹出框
	$(document).on('click',".btn > input#cabin_pricing_add_but,.op_btn >.cabin_pricing_edit",function(){
		
		//判断用户点击按钮是添加操作还是编辑操作
		var act = $(this).attr('value');
		
		//定义以下程序所用变量
		var data_total = '';
		var pricing_data = '';
		if(act == 'edit'){
			var id = $(this).attr('id');
			
			//获取编辑记录数据
			$.ajax({
		        url:get_cabin_pricing_data_ajax_url,
		        type:'get',
		        data:'id='+id,
		        async:false,
		     	dataType:'json',
		    	success:function(data){
		    		pricing_data = data;
		    	}      
		    });
			
		}
		//获取船舱类型
		$.ajax({
	        url:get_cabin_type_ajax_url,
	        type:'get',
	        async:false,
	     	dataType:'json',
	    	success:function(data){
	    		data_total = data;
	    	}      
	    });
		
		 $voyage = $("select#cabin_pricing_vayage").val();
		 $(".ui-widget-overlay").remove();
		 $("#promptBox").remove();
		 var str = "<div class='ui-widget-overlay ui-front'></div>";
		 var str_con = '<div id="promptBox" class="pop-ups write ui-dialog" style="width:450px;" >';
			str_con += '<h3>Cabin Pricing</h3>';
			str_con += '<span class="op"><a class="close r"></a></span>';
			str_con += '<p><label><span style="width:200px;margin-left:-100px;display:inline-block;text-align:right;">Cabin Type Name:</span>';
			
			str_con += '<select style="width:126px" id="cabin_type_id" name="cabin_type_id">';
			if(data_total!=0){
				$.each(data_total,function(key){
					var type_id = act == 'edit'?(data_total[key]['id']==pricing_data['cabin_type_id']?"selected='selected'":''):'';
					str_con += '<option '+type_id+' value="'+data_total[key]['id']+'">'+data_total[key]['type_name']+'</option>';
				});
			}
			str_con += '</select></label></p>';
			
			str_con += '<p><label><span style="width:200px;margin-left:-100px;display:inline-block;text-align:right;">Check Num:</span>';
			
			str_con += '<select style="width:126px" id="check_num" name="check_num">';
			for(var i=1;i<5;i++){
				var check_num = act == 'edit'?(i==pricing_data['check_num']?"selected='selected'":''):'';
				str_con += '<option '+check_num+' value="'+i+'">'+i+'</option>';
			}
			str_con += '</select></label></p>';
			
			str_con += '<p><label><span style="width:200px;margin-left:-100px;display:inline-block;text-align:right;">Bed Price:</span>';
			var bed_price = act=='edit'?pricing_data['bed_price']:'';
			str_con += '<input style="width:120px" type="text" value="'+bed_price+'" id="bed_price" name="bed_price" /></label></p>';
			
			str_con += '<p><label><span style="width:200px;margin-left:-100px;display:inline-block;text-align:right;">2th-Bed Sates(%):</span>';
			var t_2_sates = act=='edit'?pricing_data['2_empty_bed_preferential']:'';
			str_con += '<input style="width:120px" type="text" value="'+t_2_sates+'" id="t_2_sates" name="t_2_sates" /></label></p>';
			
			str_con += '<p><label><span style="width:200px;margin-left:-100px;display:inline-block;text-align:right;">3/4th-Bed Sates(%):</span>';
			var t_3_sates = act=='edit'?(pricing_data['3_4_empty_bed_preferential']==0?'':pricing_data['3_4_empty_bed_preferential']):'';
			str_con += '<input style="width:120px" type="text" value="'+t_3_sates+'" disabled="disabled" id="t_3_sates" name="t_3_sates" /></label></p>';
			
			str_con += '<p class="btn">';
			var sub_id = act=='edit'?id:0;
			str_con += '<input type="button" id="'+sub_id+'" class="cabin_pricing_confirm_but" value="submit"></input>';
			str_con += '<input type="button" style="margin-left:10px;" class="cancel_but" value="cancel"></input>';
			str_con += '</p></div>';
			
		 //$("#promptBox").before(str); 
		 $(document.body).append(str);
		 $(document.body).append(str_con);
		 //$("#promptBox").removeClass('hide');
		 $(".btn > .cabin_pricing_confirm_but").attr('voyage_code',$voyage);
	 }); 
	
	
	//船舱定价弹出框提交按钮
	$(document).on('click',"#promptBox > .btn .cabin_pricing_confirm_but",function(){
		
		
		var cabin_type_id = $("select[name='cabin_type_id']").val();
		var check_num = $("select[name='check_num']").val();
		var bed_price = $("input[name='bed_price']").val();
		var t_2_sates = $("input[name='t_2_sates']").val();
		var t_3_sates = $("input[name='t_3_sates']").val();
		if(t_3_sates==''){t_3_sates='0';}
		var voyage_code = $(this).attr('voyage_code');
		var sub_id = $(this).attr('id');
		
		$.ajax({
	        url:cabin_pricing_submit_ajax_url,
	        type:'get',
	        async:false,
	        data:'sub_id='+sub_id+'&voyage_code='+voyage_code+'&cabin_type_id='+cabin_type_id+'&check_num='+check_num+'&bed_price='+bed_price+'&t_2_sates='+t_2_sates+'&t_3_sates='+t_3_sates,
	     	dataType:'json',
	    	success:function(data){
	    		$(".ui-widget-overlay").remove();
	    		$("#promptBox").remove();
	    		if(data!=0){
	    			alert('Save success');
	    			location.reload();
	    		}else{
	    			alert('Save failed');
	    		}
	    	}      
	    });
		
	});
	
	
	
	//船舱定价弹出框入住人数选择判断：
	//大于2人禁用3/4号优惠
	$(document).on('change',"#promptBox select[name='check_num']",function(){
		var this_val = $(this).val();
		if(this_val<=2){
			$("#promptBox input[name='t_3_sates']").val('');
			$("#promptBox input[name='t_3_sates']").attr("disabled","disabled");
		}else{
			$("#promptBox input[name='t_3_sates']").removeAttr("disabled");
		}
	});
	
	
	
	//船舱定价-》优惠政策弹框
	$(document).on('click',".btn > input#preferential_policies_add,.preferential_policies_edit",function(){
		
		//判断用户点击按钮是添加操作还是编辑操作
		var act = $(this).attr('value');
		
		//定义变量
		var strategy_data = '';
		var policies_data = '';
		
		if(act == 'edit'){
			var id = $(this).attr('id');
			
			//获取编辑记录数据
			$.ajax({
		        url:get_preferential_policies_data_ajax_url,
		        type:'get',
		        data:'id='+id,
		        async:false,
		     	dataType:'json',
		    	success:function(data){
		    		policies_data = data;
		    	}      
		    });
		}
		
		//获取政策
		$.ajax({
	        url:get_strategy_data_ajax_url,
	        type:'get',
	        async:false,
	     	dataType:'json',
	    	success:function(data){
	    		strategy_data = data;
	    	}      
	    });
		
		 $voyage = $("select#policies_vayage").val();
		 $(".ui-widget-overlay").remove();
		 $("#promptBox").remove();
		 var str = "<div class='ui-widget-overlay ui-front'></div>";
		 var str_con = '<div id="promptBox" class="pop-ups write ui-dialog" style="width:450px;" >';
			str_con += '<h3>Cabin Pricing</h3>';
			str_con += '<span class="op"><a class="close r"></a></span>';
			str_con += '<p><label><span style="width:200px;margin-left:-100px;display:inline-block;text-align:right;">Strategy:</span>';
			
			str_con += '<select style="width:200px" id="strategy" name="strategy">';
			if(strategy_data!=0){
				$.each(strategy_data,function(key){
					var strategy_id = act == 'edit'?(strategy_data[key]['id']==policies_data['p_w_id']?"selected='selected'":''):'';
					str_con += '<option '+strategy_id+'  value="'+strategy_data[key]['id']+'">'+strategy_data[key]['strategy_name']+'</option>';
				});
			}
			str_con += '</select></label></p>';
			
			str_con += '<p><label><span style="width:128px;margin-left:-100px;display:inline-block;text-align:right;">Preferential(%):</span>';
			var price = act=='edit'?policies_data['p_price']:'';
			str_con += '<input style="width:120px" type="text" value="'+price+'" id="price" name="price" /></label></p>';
			
			str_con += '<p class="btn">';
			var sub_id = act=='edit'?id:0;
			str_con += '<input type="button" id="'+sub_id+'" class="preferential_policies_confirm_but" value="submit"></input>';
			str_con += '<input type="button" style="margin-left:10px;" class="cancel_but" value="cancel"></input>';
			str_con += '</p></div>';
			
		 //$("#promptBox").before(str); 
		 $(document.body).append(str);
		 $(document.body).append(str_con);
		 //$("#promptBox").removeClass('hide');
		 $(".btn > .preferential_policies_confirm_but").attr('voyage_code',$voyage);
	})
	
	
	//船舱定价->优惠政策弹出框提交按钮
	$(document).on('click',"#promptBox > .btn .preferential_policies_confirm_but",function(){
		
		
		var strategy = $("select[name='strategy']").val();
		var price = $("input[name='price']").val();
		var voyage_code = $(this).attr('voyage_code');
		var sub_id = $(this).attr('id');
		
		$.ajax({
	        url:preferential_policies_submit_ajax_url,
	        type:'get',
	        async:false,
	        data:'sub_id='+sub_id+'&voyage_code='+voyage_code+'&strategy='+strategy+'&price='+price,
	     	dataType:'json',
	    	success:function(data){
	    		$(".ui-widget-overlay").remove();
	    		$("#promptBox").remove();
	    		if(data!=0){
	    			alert('Save success');
	    			location.reload();
	    		}else{
	    			alert('Save failed');
	    		}
	    	}      
	    });
		
	});
	
	
	
	//船舱定价-》观光路线添加页面航线改变
	$(document).on('change',"#tour_add_voyage  #vayage",function(){
		var voyage = $(this).val();
		$.ajax({
	        url:get_tour_data_ajax_url,
	        type:'get',
	        async:false,
	        data:'voyage='+voyage,
	     	dataType:'json',
	    	success:function(data){
	    		if(data!=0){
	    			var reallt_result = data['really'];
	    			var tour_result = data['result'];
	    			var really_arr = new Array();
	    			$.each(reallt_result,function(key){
	    				really_arr.push(reallt_result[key]['sh_id']);
	    			});
	    			var str = '';
	    			$.each(tour_result,function(k){
	    				if($.inArray(tour_result[k]['id'], really_arr)==-1){
		    				str += '<span style="display: block;height:30px;text-align:left;width:200px;">';
		    				str += '<input style="margin-right:10px;" type="checkbox" name="su[]" value="'+tour_result[k]['id']+'" />';
		    				str += tour_result[k]['se_name'];
		    				str += '</span>';
	    				}
	    			});
	    			$("#tour_add_voyage #tour_data_list").html(str);
	    			
	    		}else{
	    			$("#tour_add_voyage #tour_data_list").html('');
	    		}
	    	}      
	    });
	});
	
	
	

	
	//船舱定价-》附加费添加页面航线改变
	$(document).on('change',"#surcharge_add_voyage  #vayage",function(){
		var voyage = $(this).val();
		$.ajax({
	        url:get_surcharge_data_ajax_url,
	        type:'get',
	        async:false,
	        data:'voyage='+voyage,
	     	dataType:'json',
	    	success:function(data){
	    		if(data!=0){
	    			var reallt_result = data['really'];
	    			var surcharge_result = data['result'];
	    			var really_arr = new Array();
	    			$.each(reallt_result,function(key){
	    				really_arr.push(reallt_result[key]['cost_id']);
	    			});
	    			var str = '';
	    			$.each(surcharge_result,function(k){
	    				if($.inArray(surcharge_result[k]['id'], really_arr)==-1){
		    				str += '<span style="display: block;height:30px;text-align:left;width:200px;">';
		    				str += '<input style="margin-right:10px;" type="checkbox" name="su[]" value="'+surcharge_result[k]['id']+'" />';
		    				str += surcharge_result[k]['cost_name'];
		    				str += '</span>';
	    				}
	    			});
	    			$("#surcharge_add_voyage #surcharge_data_list").html(str);
	    			
	    		}else{
	    			$("#surcharge_add_voyage #surcharge_data_list").html('');
	    		}
	    	}      
	    });
	});
	
	
	
	//航线-》船舱
	$(document).on('click','#cabin_right_but',function(){
		var str = '';
		//alert('right');
		//获取左边选中值
		$("#cabin_left_ul li").find("input[type='checkbox']:checked").each(function(e){
			var id = $(this).val();
			var text = $(this).parent().parent().find("span.text").text();
			
			str += '<li><span><input value="'+id+'" name="cabin_right_ids[]" type="checkbox"></span><span class="text">'+text+'</span></li>';
			$(this).parent().parent().remove();
		});
		
		$("#cabin_right_ul").append(str);
	});

	$(document).on('click','#cabin_left_but',function(){

		//alert('left');

		var str = '';
		//获取左边选中值
		$("#cabin_right_ul li").find("input[type='checkbox']:checked").each(function(e){
			var id = $(this).val();
			var text = $(this).parent().parent().find("span.text").text();
			
			str += '<li><span><input value="'+id+'" type="checkbox"></span><span class="text">'+text+'</span></li>';
			$(this).parent().parent().remove();
		});
		
		$("#cabin_left_ul").append(str);

			
	});
	
	
	
	
	
	
	
	
	
	
	//表格全选反选功能
	$('table th input:checkbox').on('click' , function(){
        var that = this;
        $(this).closest('table').find('tr > td:first-child input:checkbox')
        .each(function(){
            this.checked = that.checked;
            $(this).closest('tr').toggleClass('selected');
        });
    });
	
	
	//添加编辑页面取消填写按钮
	$(".btn > .cancle").on('click',function(){
		$("form input#code").val('');
		$("form input#code_chara").val('');
		$("form input#name").val('');
		$("form textarea#desc").val('');
		$("form input#detail_title").val('');
		$("form textarea#detail_desc").val('');
		$("form input#voyage_name").val('');
		$("form input#voyage_num").val('');
		$("form textarea#desc").val('');
		$("form input#ticket_price").val('');
		$("form input#ticket_taxes").val('');
		$("form input#harbour_taxes").val('');
		$("form input#deposit_ratio").val('');
	});
	
	

	// 动态改变右边部分宽度
	changeMainRWith();
	$(window).resize(function(){
		changeMainRWith();
	});

	// asideNav点击事件
	$("body").on("click","#asideNav li",function(){
		if ($(this).next().prop("tagName") === "UL") {
			if ($(this).hasClass("open")) {
				$(this).parent().find("ul").css("display","none");
				$(this).parent().find("ul").prev("li").removeClass("open");
			} else {
				$(this).next().css("display","block");
				$(this).addClass("open");
			}
		} else {
			$(".active").removeClass("active");
			$(this).addClass("active");
		}
	});

	// 左边导航关闭
	$("body").on("click","#closeAsideNav",function(){
		$("#asideNav_open").css("display","none");
		$("#asideNav_close").css("display","block");
		$("#asideNav").css("width",$("#asideNav_close").width() + "px");
		changeMainRWith();
	});

	// 左边导航打开
	$("body").on("click","#openAsideNav",function(){
		$("#asideNav_close").css("display","none");
		$("#asideNav_open").css("display","block");
		$("#asideNav").css("width",$("#asideNav_open").width() + "px");
		changeMainRWith();
	});

	// tab功能
	$("body").on("click",".tab_title li",function(){
		var index = $(".tab_title li").index($(this));
		$(".tab .active").removeClass("active");
		$(this).addClass("active");
		$($(".tab_content > div")[index]).addClass("active");
	});
	
	
	
	
	
	
	
	
	
	
});

// 动态改变右边部分宽度
function changeMainRWith() {
	$("#main > .r").css("width",($("#main").width() - 44 - $("#asideNav").width())+"px");
}