$(document).ready(function() {
	$("#search").click(function(){
		var counturl=$("#counturl").val();
		var voyage_id=$("select[name=voyage_id]").val();
		var type_code=$("select[name=type_code]").val();
		  $.ajax({
			  url:counturl,
			  type:'POST',
			  data:{voyage_id:voyage_id,type_code:type_code},
			  dataType:'json',
			  success:function(d){
				  alert(d);
				if(d!=0){
					var total = parseInt(Math.ceil(d/2));
					if(total==0){
						total=1;
						}
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
	            			  var voyage_id=$("select[name=voyage_id]").val();
	            			  var type_code=$("select[name=type_code]").val();
	            			  if(this_page==num){$("input#pag").val('fail');return false;}
	            			  $.ajax({
	            				  url:pageurl,
	            				  type:'POST',
	            				  data:{pag:num,voyage_id:voyage_id,type_code:type_code},
	            				  dataType:'json',
	            				  success:function(data){
	            					  var data = eval(data); //数组
	            					  if(data!=0){
	            					  var tmp = "{{each remaining}}";
	            			            var t="{{$index}}";
	            		  				tmp+="<tr>";
	            		  				tmp+="<td>{{$value.cabin_type}}</td>";
	            		  				tmp+="<td>{{$value.deck_num}}</td>";
	            		  				tmp+="<td>{{$value.quantity}}</td>";
	            		  				tmp+="</tr>";
	            		  				tmp+="{{/each}}";
	            		  				var render = template.compile(tmp);
	            						var html = render({remaining:data});
	            						 $("#count").html(data['count']);
	            		  	         	$("table#remaining_page_table > tbody").html(html);
	            					  }
	            					  else{
	            						  $("#count").html('0');
	            						$("table#remaining_page_table > tbody").html("");
	            					  }
	            				  } 
	            			  });
	          	    	
	            		  }
	            	  });
			  }
				else{
					 $("#count").html(d['count']);
					$("table#remaining_page_table > tbody").html("");
				}
			  }
			  });
	        
		});
});
