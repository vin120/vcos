<?php
$this->title = 'Agent Ticketing';


use travelagent\views\myasset\PublicAsset;
//use travelagent\views\myasset\PublicAssetPage;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

PublicAsset::register($this);
$baseUrl = $this->assetBundles[PublicAsset::className()]->baseUrl . '/';
//PublicAssetPage::register($this);
//$baseUrl_page = $this->assetBundles[PublicAssetPage::className()]->baseUrl . '/';

//$assets = '@app/modules/membermanagement/themes/basic/static';
//$baseUrl = Yii::$app->assetManager->publish($assets);

?>
<!-- main content start -->
<div id="reservation" class="mainContent">
    <div id="topNav">
    <?php echo yii::t('app','Agent Ticketing')?>&nbsp;&gt;&gt;&nbsp;
    <a href="#"><?php echo yii::t('app','Booking Ticke')?></a>
    </div>
    <div id="mainContent_content">
				<!-- 请用ajax提交 -->
				<div class="pBox search">
					<label>
						<span>Sailing Date:</span>
						<span>
							<input type="text" class="Wdate"></input>
						</span>
					</label>
					<label>
						<span>Route Name:</span>
						<span>
							<input type="text" name="name" id='name' maxlength="16"></input>
						</span>
					</label>
					<label>
						<span>Route Code:</span>
						<span>
							<input type="text" name="code" id="code" maxlength="16"></input>
						</span>
					</label>
					<input type="button" value="SEARCH" class="btn1"></input>
				</div>
				<div class="pBox">
					<table id="booking_ticke_table">
					<input type="hidden" id="booking_ticke_page" value="<?php echo $booking_ticke_pag;?>" />
						<thead>
							<tr>
								<th>Route Code</th>
								<th>Price</th>
								<th>Sailing Date</th>
								<th>Return Date</th>
								<th>Route Date</th>
								<!-- <th>Shore Excursions</th>
								<th>Departure Port</th> -->
								<th>Operation</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($result as $v){?>
							<tr>
								<td><?php echo $v['voyage_code']?></td>
								<td><?php echo $v['ticket_price']?></td>
								<td><?php echo $v['start_time']?></td>
								<td><?php echo $v['end_time']?></td>
								<td><?php echo $v['voyage_name']?></td>
								<td><button class="btn1"><img src="<?=$baseUrl ?>images/right.png"></button></td>
							</tr>
						<?php }?>
						</tbody>
					</table>
					<p class="records">Records:<span><?php echo $count;?></span></p>
					<div class="center" id="booking_ticke_page_div"> </div>
				</div>
			</div>
</div>
<!-- main content end -->

<script type="text/javascript">
window.onload = function(){ 
	<?php $booking_total = (int)ceil($count/2);
	if($booking_total >1){
	?>
		$('#booking_ticke_page_div').jqPaginator({
		    totalPages: <?php echo $booking_total;?>,
		    visiblePages: 5,
		    currentPage: 1,
		    wrapper:'<ul class="pagination"></ul>',
		    first: '<li class="first"><a href="javascript:void(0);">First</a></li>',
		    prev: '<li class="prev"><a href="javascript:void(0);">«</a></li>',
		    next: '<li class="next"><a href="javascript:void(0);">»</a></li>',
		    last: '<li class="last"><a href="javascript:void(0);">Last</a></li>',
		    page: '<li class="page"><a href="javascript:void(0);">{{page}}</a></li>',
		    onPageChange: function (num, type) {
		    	var this_page = $("input#booking_ticke_page").val();
		    	if(this_page==num){$("input#booking_ticke_page").val('fail');return false;}

		    	var w_code = "<?php //echo $w_code;?>";
		    	var w_name = "<?php //echo $w_name;?>";
		    	var w_state = "<?php //echo $w_state;?>";
		    	/*
		    	var where_data = "&w_code="+w_code+"&w_name="+w_name+"&w_state="+w_state; 
		    	*/
		    	$.ajax({
	                url:"<?php echo Url::toRoute(['get_cruise_page']);?>",
	                type:'get',
	                data:'pag='+num,
	             	dataType:'json',
	            	success:function(data){
	                	var str = '';
	            		if(data != 0){
	    	                $.each(data,function(key){
								
	                        	str += "<tr>";
	                            str += "<td>"+data[key]['voyage_code']+"</td>";
	                            str += "<td>"+data[key]['ticket_price']+"</td>";
	                            str += "<td>"+data[key]['start_time']+"</td>";
	                            str += "<td>"+data[key]['end_time']+"</td>";
	                            str += "<td>"+data[key]['voyage_name']+"</td>";
	                            str += "<td><button class='btn1'><img src='<?=$baseUrl ?>images/right.png'></button></td>";
	                            str += "</tr>";
	                          });
	    	                $("table#cruise_table > tbody").html(str);
	    	            }
	            	}      
	            });
	    	
	       	// $('#text').html('当前第' + num + '页');
	    	}
		});
	<?php }?>



	$(document).on('click',"#booking_ticke_table",function(){});

}
</script>



