$(document).ready(function() {

	$("#paymentpassword").on("click",function() {
		new PopUps($("#alertpaymentpassword"));
	});
	
/*	$("#pay_password").addClass("wrongBox");
	$("#pay_password span").eq(1).append("<em>Please select...</em>");
	$("#pay_password span").find("em").remove();
	$("#pay_password").removeClass("wrongBox");*/

	$("input[name=pay_password]").blur(function(){
         var pay_password = $(this).val(); 
         var url=$("#url").val();
         $.ajax({  
             url: url,
             data:{pay_password:pay_password},
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
        	  var json = eval(tt); //数组 
                 $.each(json, function (index, item) {
	                 if(json[index]==0){
	                	$("#pay_password").addClass("wrongBox");
	                	$("#pay_password span").eq(1).append("<em>Please select...</em>");
		                 }
	                 else{
	                	$("#pay_password span").find("em").remove();
	                	$("#pay_password").removeClass("wrongBox"); 
	                 }
                 });
			//alert(tt);
               
         }  
 });
    });
