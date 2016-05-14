$(document).ready(function() {
	$("#search").click(function(){
	         var voyage_code = $("input[name=voyage_code]").val(); 
	         var type_code = $("input[name=type_code]").val(); 
	         var url=$("#url").val();
	         $.ajax({  
	             url: url,
	             data:{voyage_code:voyage_code,type_code:type_code},
	             type: 'POST',  
	             dataType: 'json',  
	             timeout: 3000,  
	             cache: false,  
	             beforeSend: LoadFunction, //加载执行方法      
	             error: erryFunction,  //错误执行方法      
	             success: succFunction //成功执行方法      
	         })  
	         function LoadFunction() {  
	             $("#list").html('加载中...');  
	         }  
	         function erryFunction() {  
	             alert("error");  
	         }  
	         function succFunction(tt) {  
        	    var data = eval(tt); //数组
        	    $("#count").val(data.length);
        	    if(data!=0){
	            var tmp = "{{each remaining}}";
	            var t="{{$index}}";
	            if(t<2){
  				tmp+="<tr>";
  				tmp+="<td>{{$value.cabin_type}}</td>";
  				tmp+="<td>{{$value.deck}}</td>";
  				tmp+="<td>{{$value.quantity}}</td>";
  				tmp+="</tr>";
	            }
  				tmp+="{{/each}}";
  				var render = template.compile(tmp);
				var html = render({remaining:data});
  	         	$("table#remaining_page_table > tbody").html(html);
        	    }
        	    else{
        	    	$("table#remaining_page_table > tbody").html("");
        	    }
	              var count=$("#count").val();
	              var total= Math.ceil(count/2);
	              if (total==0){
	            	  total=1;
	              }
	              if(total>1){
	            	  var pagefirst=$("#pagefirst").val();
	            	  var pagelast=$("#pagelast").val();
	            	  $('#remaining_page_div').jqPaginator({
	            		  totalPages: total,
	            		  visiblePages: 5,
	            		  currentPage: 1,
	            		  wrapper:'<ul class="pagination"></ul>',
	            		  first: '<li class="first"><a href="javascript:void(0);">'+pagefirst+'</a></li>',
	            		  prev: '<li class="prev"><a href="javascript:void(0);">«</a></li>',
	            		  next: '<li class="next"><a href="javascript:void(0);">»</a></li>',
	            		  last: '<li class="last"><a href="javascript:void(0);">'+pagelast+'</a></li>',
	            		  page: '<li class="page"><a href="javascript:void(0);">{{page}}</a></li>',
	          		   
	            		  onPageChange: function (num, type) {
	            			 
	            			  var this_page = $("input#pag").val();
	            			  var pageurl=$("#pageurl").val();
	            			 
	            			  if(this_page==num){$("input#pag").val('fail');return false;}
	            			  $.ajax({
	            				  url:pageurl,
	            				  type:'POST',
	            				  data:{pag:num},
	            				  dataType:'json',
	            				  success:function(data){
	            					  var data = eval(data); //数组
	            					  if(data!=0){
	            					  var tmp = "{{each remaining}}";
	            			            var t="{{$index}}";
	            		  				tmp+="<tr>";
	            		  				tmp+="<td>{{$value.cabin_type}}</td>";
	            		  				tmp+="<td>{{$value.deck}}</td>";
	            		  				tmp+="<td>{{$value.quantity}}</td>";
	            		  				tmp+="</tr>";
	            		  				tmp+="{{/each}}";
	            		  				var render = template.compile(tmp);
	            						var html = render({remaining:data});
	            		  	         	$("table#remaining_page_table > tbody").html(html);
	            					  }
	            					  else{
	            						$("table#remaining_page_table > tbody").html("");
	            					  }
	            				  } 
	            			  });
	          	    	
//	            			  $('#text').html('当前第' + num + '页');
	            		  }
	            	  });
	              }
	         }
		});
//		分页

});
