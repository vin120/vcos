<?php
$this->title = 'Agent Ticketing';
use travelagent\views\myasset\PublicAsset;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

PublicAsset::register($this);
$baseUrl = $this->assetBundles[PublicAsset::className()]->baseUrl . '/';

?>
<!-- main content start -->
<div id="orderCenter" class="mainContent">
    <div id="topNav">
    <?php echo yii::t('app','Agent Ticketing')?>&nbsp;&gt;&gt;&nbsp;
    <a href="#"><?php echo yii::t('app','Ticket Center')?></a>
    </div>
    <div id="mainContent_content">
		<!-- 请用ajax提交 -->
		<div class="pBox search">
		
			<p>
				<label class="wrongBox">
					<span><?php echo yii::t('app','')?>Order No.:</span>
					<span>
						<select id="order_no" name="order_no">
						<?php foreach ( $order as $row) :?>
							<option><?php echo $row['order_serial_number']?></option>
						<?php endforeach;?>
						</select>
						<!-- 错误提示 -->
							<!-- <em><?php echo yii::t('app','Please select')?>...</em> -->
						</span>
					</label>
					<label>
						<span><?php echo yii::t('app','Route Name')?>:</span>
						<input type="text" id="route_name" name="route_name" class="doubleWidth"></input>
					</label>
				</p>
				<p>
					<label>
						<span><?php echo yii::t('app','Start Time')?>:</span>
						<input type="text" id="start_time" name="start_time" class="Wdate"></input>
					</label>
					<label>
						<span><?php echo yii::t('app','End Time')?>:</span>
						<input type="text" id="end_time" name="end_time" class="Wdate"></input>
					</label>
					<label>
						<span><?php echo yii::t('app','Route ID')?>:</span>
						<input type="text" id="route_id" name="route_id"></input>
					</label>
				</p>
				<p class="btnBox2">
					<input type="submit" value="SEARCH" class="btn1"></input>
				</p>
			</div>
			<div class="pBox">
				<table id="ticket_center_table">
				<input type="hidden" id="pag" value="<?php echo $pag;?>" />
					<thead>
						<tr>
							<th><?php echo yii::t('app','No.')?></th>
							<th><?php echo yii::t('app','Order Number')?></th>
							<th><?php echo yii::t('app','Route ID')?></th>
							<th><?php echo yii::t('app','Route Name')?></th>
							<th><?php echo yii::t('app','Order Price')?></th>
							<th><?php echo yii::t('app','Order Time')?></th>
							<th><?php echo yii::t('app','Status')?></th>
							<th><?php echo yii::t('app','Operation')?></th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($order as $key=>$value ) :?>
						<tr>
							<td><?php echo $key+1?></td>
							<td><?php echo $value['order_serial_number']?></td>
							<td><?php echo $value['voyage_code']?></td>
							<td><?php echo $value['voyage_name']?></td>
							<td>￥<?php echo $value['total_pay_price']?></td>
							<td><?php echo $value['create_order_time']?></td>
							<td><?php echo $value['order_status'] == 0 ? yii::t('app','To Be Paid') : yii::t('app','Finished')  ?></td>
							<td>
								<button class="btn1"><img src="<?=$baseUrl ?>images/write.png"></button>
								<button class="btn2"><img src="<?=$baseUrl ?>images/delete.png"></button>
							</td>
						</tr>
					<?php endforeach;?>
					</tbody>
				</table>
				<p class="records"><?php echo yii::t('app','Records')?>:<?php echo $count;?></span></p>
				<div class="center" id="ticket_center_page_div"> </div>
			</div>
		</div>
	</div>
<!-- main content end -->

<script type="text/javascript">
window.onload = function(){ 
<?php $total = (int)ceil($count/2);
	if($total >1){
?>
	$('#ticket_center_page_div').jqPaginator({
	    totalPages: <?php echo $total;?>,
	    visiblePages: 5,
	    currentPage: 1,
	    wrapper:'<ul class="pagination"></ul>',
	    first: '<li class="first"><a href="javascript:void(0);">First</a></li>',
	    prev: '<li class="prev"><a href="javascript:void(0);">«</a></li>',
	    next: '<li class="next"><a href="javascript:void(0);">»</a></li>',
	    last: '<li class="last"><a href="javascript:void(0);">Last</a></li>',
	    page: '<li class="page"><a href="javascript:void(0);">{{page}}</a></li>',
	    onPageChange: function (num, type) {
	    	var this_page = $("input#pag").val();
	    	if(this_page==num){$("input#pag").val('fail');return false;}

	    	
	    	$.ajax({
                url:"<?php echo Url::toRoute(['get_booking_ticke_page']);?>",
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
                            str += "<td><button code='"+data[key]['voyage_code']+"' class='btn1'><img src='<?=$baseUrl ?>images/right.png'></button></td>";
                            str += "</tr>";
                          });
    	                $("table#ticket_center_page_div > tbody").html(str);
    	            }
            	}      
            });
    	
       	// $('#text').html('当前第' + num + '页');
    	}
	});
	<?php }?>




	
}
</script>



