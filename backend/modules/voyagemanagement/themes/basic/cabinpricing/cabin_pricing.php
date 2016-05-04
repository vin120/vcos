<?php
$this->title = 'Voyage Management';


use app\modules\voyagemanagement\themes\basic\myasset\ThemeAsset;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

ThemeAsset::register($this);

$baseUrl = $this->assetBundles[ThemeAsset::className()]->baseUrl . '/';

//$assets = '@app/modules/membermanagement/themes/basic/static';
//$baseUrl = Yii::$app->assetManager->publish($assets);

?>
<style>
.pagination{display:inline-flex;}
</style>
<script type="text/javascript">
var get_cabin_type_ajax_url = "<?php echo Url::toRoute(['get_cabin_type']);?>";
var cabin_pricing_submit_ajax_url = "<?php echo Url::toRoute(['cabin_pricing_submit']);?>";
var cabin_pricing_submit_success_ajax_url = "<?php echo Url::toRoute(['get_cabin_pricing_page','pag'=>1]);?>";
var get_cabin_pricing_data_ajax_url = "<?php echo Url::toRoute(['get_cabin_pricing_data']);?>";
var get_strategy_data_ajax_url = "<?php echo Url::toRoute(['get_strategy_data']);?>";
var preferential_policies_submit_ajax_url = "<?php echo Url::toRoute(['preferential_policies_submit']);?>";
var get_preferential_policies_data_ajax_url = "<?php echo Url::toRoute(['get_preferential_policies_data']);?>";
</script>


<!-- content start -->
<div class="r content" id="user_content">
    <div class="topNav">Voyage Manage&nbsp;&gt;&gt;&nbsp;<a href="#">Cabin Pricing</a></div>
   <div class="tab">
		<ul class="tab_title">
			<li class="active" act="pricing">Cabin Pricing</li>
			<li act="policies">Preferential Policies</li>
			<li act="surcharge">Surcharge</li>
			<li act="tour">Tour Route</li>
		</ul>
		<div class="tab_content">
		<!-- one -->
			<div class="active">
				<div class="search" style="margin-bottom: 10px;">
					<label>
						<span>Route No.:</span>
						<select id="cabin_pricing_vayage">
						<?php foreach ($voyage_result as $k=>$v){?>
							<option value="<?php echo $v['voyage_code']?>"><?php echo $v['voyage_name']?></option>
						<?php }?>
						</select>
					</label>
					<!-- <span class="btn">
						<input type="button" value="Copy Price"></input>
					</span> -->
				</div>
				<div class="searchResult">
					<table id="cabin_pricing_table">
						<thead>
							<tr>
								<th>Cabin Type Name</th>
								<th>Check Num</th>
								<th>Bed Price</th>
								<th>2th-Bed Sates(%)</th>
								<th>3/4th-Bed Sates(%)</th>
								<th>Operation</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($cabin_pricing_result as $k=>$v){?>
							<tr>
								<td><?php echo $v['type_name']?></td>
								<td><?php echo $v['check_num']?></td>
								<td><?php echo $v['bed_price']?></td>
								<td><?php echo $v['2_empty_bed_preferential']?></td>
								<td><?php echo $v['3_4_empty_bed_preferential']==0?'--':$v['3_4_empty_bed_preferential'];?></td>
								<td class="op_btn">
				                    <a class="cabin_pricing_edit" id="<?php echo $v['id']?>" value="edit"><img src="<?=$baseUrl ?>images/write.png"></a>
				                    <a class="delete" id="<?php echo $v['id']?>"><img src="<?=$baseUrl ?>images/delete.png"></a>
				                </td>
							</tr>
						<?php }?>
						</tbody>
					</table>
					<p class="records">Records:<span id="cabin_pricing_total"><?php echo count($cabin_pricing_result);?></span></p>
			        <div class="btn">
			            <input id="cabin_pricing_add_but" type="button" value="Add"></input>
			        </div>
				</div>
			</div>
			<!-- two -->
			<div>
				<div class="search" style="margin-bottom: 10px;">
					<label>
						<span>Route No.:</span>
						<select id="policies_vayage">
						<?php foreach ($voyage_result as $k=>$v){?>
							<option value="<?php echo $v['voyage_code']?>"><?php echo $v['voyage_name']?></option>
						<?php }?>
						</select>
					</label>
					<!-- <span class="btn">
						<input type="button" value="Copy Price"></input>
					</span> -->
				</div>
				<div>
					<table id="preferential_policies_table">
						<thead>
							<tr>
								<th>Strategy</th>
								<th>Preferential(%)</th>
								<th>Operate</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($policies_result as $k=>$v){?>
							<tr>
								<td><?php echo $v['strategy_name']?></td>
								<td><?php echo $v['p_price']?></td>
								<td>
									<a class="preferential_policies_edit" id="<?php echo $v['id']?>" value="edit"><img src="<?=$baseUrl ?>images/write.png"></a>
				                    <a class="delete" id="<?php echo $v['id']?>"><img src="<?=$baseUrl ?>images/delete.png"></a>
				                
								</td>
							</tr>
						<?php }?>
						</tbody>
					</table>
					<p class="records">Records:<span id="preferential_policies_total"><?php echo count($policies_result);?></span></p>
					<div class="btn">
						<input type="button" id="preferential_policies_add" value="Add"></input>
					</div>
				</div>
			</div>
			<!-- three -->
			<div>
				<div class="search" style="margin-bottom: 10px;">
						<label>
							<span>Route No.:</span>
							<select id="surcharge_vayage">
							<?php foreach ($voyage_result as $k=>$v){?>
								<option value="<?php echo $v['voyage_code']?>"><?php echo $v['voyage_name']?></option>
							<?php }?>
							</select>
						</label>
						<!-- <span class="btn">
							<input type="button" value="Copy Price"></input>
						</span> -->
					</div>
					<div>
					<table id="surcharge_table">
						<thead>
							<tr>
								<th>Cost Name</th>
								<th>Operate</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($surcharge_result as $k=>$v){?>
							<tr>
								<td><?php echo $v['cost_name']?></td>
								<td>
				                    <a class="delete" id="<?php echo $v['id']?>"><img src="<?=$baseUrl ?>images/delete.png"></a>
				               </td>
							</tr>
						<?php }?>
						</tbody>
					</table>
					<p class="records">Records:<span id="surcharge_total"><?php echo count($surcharge_result)?></span></p>
					<div class="btn">
						<a href="<?php echo Url::toRoute(['surcharge_add']);?>"><input type="button" value="Add"></input></a>
					</div>
				</div>
			</div>
			<!-- four -->
			<div>
				<div class="search" style="margin-bottom: 10px;">
						<label>
							<span>Route No.:</span>
							<select id="tour_vayage">
							<?php foreach ($voyage_result as $k=>$v){?>
								<option value="<?php echo $v['voyage_code']?>"><?php echo $v['voyage_name']?></option>
							<?php }?>
							</select>
						</label>
						<!-- <span class="btn">
							<input type="button" value="Copy Price"></input>
						</span> -->
					</div>
					<div>
					<table id="tour_table">
						<thead>
							<tr>
								<th>Title</th>
								<th>Operate</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($tour_result as $k=>$v){?>
							<tr>
								<td><?php echo $v['se_name']?></td>
								<td>
				                    <a class="delete" id="<?php echo $v['id']?>"><img src="<?=$baseUrl ?>images/delete.png"></a>
				               </td>
							</tr>
						<?php }?>
						</tbody>
					</table>
					<p class="records">Records:<span id="tour_total"><?php echo count($tour_result)?></span></p>
					<div class="btn">
						<a href="<?php echo Url::toRoute(['tour_add']);?>"><input type="button" value="Add"></input></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- content end -->



<script type="text/javascript">
window.onload = function(){ 
	//船舱定价-》船舱定价航线改变
	$(document).on('change',"#cabin_pricing_vayage",function(){
		var voyage = $(this).val();
		$.ajax({
	        url:"<?php echo Url::toRoute(['cabin_pricing_to']);?>",
	        type:'get',
	        async:false,
	        data:'voyage='+voyage,
	     	dataType:'json',
	    	success:function(data){
	    		var str = '';
        		if(data != 0){
	                $.each(data,function(key){
                    	str += "<tr>";
                        str += "<td>"+data[key]['type_name']+"</td>";
                        str += "<td>"+data[key]['check_num']+"</td>";
                        str += "<td>"+data[key]['bed_price']+"</td>";
                        str += "<td>"+data[key]['2_empty_bed_preferential']+"</td>";
                        str += "<td>"+data[key]['3_4_empty_bed_preferential']+"</td>";
                        str += "<td  class='op_btn'>";
                        str += "<a class='cabin_pricing_edit' id='"+data[key]['id']+"' value='edit'><img src='<?=$baseUrl ?>images/write.png'></a>";
                        str += "<a class='delete' id='"+data[key]['id']+"'><img src='<?=$baseUrl ?>images/delete.png'></a>";
                        str += "</td>";
                        str += "</tr>";
                      });
	                $("table#cabin_pricing_table > tbody").html(str);
	                $("#cabin_pricing_total").html(data.length);
	            }else{
	            	$("table#cabin_pricing_table > tbody").html('');
	            	$("#cabin_pricing_total").html(data);
		        }
	    	}      
	    });
	});

	//船舱定价-》船舱定价航线改变
	$(document).on('change',"#policies_vayage",function(){
		var voyage = $(this).val();
		$.ajax({
	        url:"<?php echo Url::toRoute(['preferential_policies_to']);?>",
	        type:'get',
	        async:false,
	        data:'voyage='+voyage,
	     	dataType:'json',
	    	success:function(data){
	    		var str = '';
        		if(data != 0){
	                $.each(data,function(key){
                    	str += "<tr>";
                        str += "<td>"+data[key]['strategy_name']+"</td>";
                        str += "<td>"+data[key]['p_price']+"</td>";
                        str += "<td  class='op_btn'>";
                        str += "<a class='preferential_policies_edit' id='"+data[key]['id']+"' value='edit'><img src='<?=$baseUrl ?>images/write.png'></a>";
                        str += "<a class='delete' id='"+data[key]['id']+"'><img src='<?=$baseUrl ?>images/delete.png'></a>";
                        str += "</td>";
                        str += "</tr>";
                      });
	                $("table#preferential_policies_table > tbody").html(str);
	                $("#preferential_policies_total").html(data.length);
	            }else{
	            	$("table#preferential_policies_table > tbody").html('');
	            	$("#preferential_policies_total").html(data);
		        }
	    	}      
	    });
	});

	//船舱定价-》附加费航线改变
	$(document).on('change',"#surcharge_vayage",function(){
		var voyage = $(this).val();
		$.ajax({
	        url:"<?php echo Url::toRoute(['surcharge_to']);?>",
	        type:'get',
	        async:false,
	        data:'voyage='+voyage,
	     	dataType:'json',
	    	success:function(data){
	    		var str = '';
        		if(data != 0){
	                $.each(data,function(key){
                    	str += "<tr>";
                        str += "<td>"+data[key]['cost_name']+"</td>";
                        str += "<td  class='op_btn'>";
                       	str += "<a class='delete' id='"+data[key]['id']+"'><img src='<?=$baseUrl ?>images/delete.png'></a>";
                        str += "</td>";
                        str += "</tr>";
                      });
	                $("table#surcharge_table > tbody").html(str);
	                $("#surcharge_total").html(data.length);
	            }else{
	            	$("table#surcharge_table > tbody").html('');
	            	$("#surcharge_total").html(data);
		        }
	    	}      
	    });
	});


	//船舱定价-》附加费航线改变
	$(document).on('change',"#tour_vayage",function(){
		var voyage = $(this).val();
		$.ajax({
	        url:"<?php echo Url::toRoute(['tour_to']);?>",
	        type:'get',
	        async:false,
	        data:'voyage='+voyage,
	     	dataType:'json',
	    	success:function(data){
	    		var str = '';
        		if(data != 0){
	                $.each(data,function(key){
                    	str += "<tr>";
                        str += "<td>"+data[key]['se_name']+"</td>";
                        str += "<td  class='op_btn'>";
                       	str += "<a class='delete' id='"+data[key]['id']+"'><img src='<?=$baseUrl ?>images/delete.png'></a>";
                        str += "</td>";
                        str += "</tr>";
                      });
	                $("table#tour_table > tbody").html(str);
	                $("#tour_total").html(data.length);
	            }else{
	            	$("table#tour_table > tbody").html('');
	            	$("#tour_total").html(data);
		        }
	    	}      
	    });
	});

	//delete删除确定but
   $(document).on('click',"#promptBox > .btn .confirm_but",function(){
	   var val = $(this).attr('id');
	   var act = $(".tab .tab_title").find("li.active").attr('act');
	   //alert(act);return false;
	   if(act=='pricing'){ 
	   		location.href="<?php echo Url::toRoute(['cabin_pricing_delete']);?>"+"&id="+val;
	   }else if(act == 'policies'){
		   location.href="<?php echo Url::toRoute(['preferential_policies_delete']);?>"+"&id="+val;
	   }else if(act == 'surcharge'){
		   location.href="<?php echo Url::toRoute(['surcharge_delete']);?>"+"&id="+val;
	   }else if(act == 'tour'){
		   location.href="<?php echo Url::toRoute(['tour_delete']);?>"+"&id="+val;
	   }
   });


}

</script>



