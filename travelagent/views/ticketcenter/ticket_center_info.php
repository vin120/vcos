<?php
$this->title = 'Agent Ticketing';
use travelagent\views\myasset\PublicAsset;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use travelagent\views\myasset\TicketCenterInfoAsset;
PublicAsset::register($this);
TicketCenterInfoAsset::register($this);
$baseUrl = $this->assetBundles[PublicAsset::className()]->baseUrl . '/';

?>
<!-- main content start -->
<div id="orderCenter" class="mainContent">
    <div id="topNav">
    <?php echo yii::t('app','Agent Ticketing')?>&nbsp;&gt;&gt;&nbsp;
    <a href="#"><?php echo yii::t('app','Ticket Center')?></a>
    </div>
    <div id="mainContent_contentinfo">
		<!-- 请用ajax提交 -->
			<div class="pBox">
			<div class="infoBox">
			<div><h3><?php echo \Yii::t('app','The Order Information')?>:</h3></div>
			<span>
			<?php echo date('Y-m-d D', time());?>
			</span>
			<span style="margin-left:40px"><?php echo \Yii::t('app','Order Number')?>:</span>
			<span><?php echo isset($_GET['id'])?$_GET['id']:''?></span>
			</div>
				<table id="ticket_center_table">
					<thead>
						<tr>
							<th><?php echo yii::t('app','No.')?></th>
							<th><?php echo yii::t('app','Room Code')?></th>
							<th><?php echo yii::t('app','Room Price')?></th>
							<th><?php echo yii::t('app','Name')?></th>
							<th><?php echo yii::t('app','PassportNum')?></th>
							<th><?php echo yii::t('app','Additional Price')?></th>
						</tr>
					</thead>
					<tbody>
					<?php if(!empty($data)){?>
					<?php foreach($data as $k=>$v):?>
							
					<?php foreach($v['member'][$k] as $num=>$vv):?>
					<?php if($vv != null&& $vv['price_type']!=1){?>
						<tr>
						<?php if($num==0){?>
							<td rowspan="<?php  echo sizeof($v['member'][$k])?>"><?php echo $k+1?></td>
							<td rowspan="<?php echo sizeof($v['member'][$k])?>"><?php echo $v['cabin_type']?></td>
							<td rowspan="<?php echo sizeof($v['member'][$k])?>"><?php echo $v['cabin_price']?></td>
							<?php }?>
							
							<td><?php echo $vv['m_name']?></td>
							<td><?php echo $vv['passport_number']?></td>
							<td><?php echo isset($vv['additional_price'])?$vv['additional_price']:0?></td>
						</tr>
						<?php }?>
							<?php endforeach;?>
					<?php endforeach;?>
					<?php }?>
					</tbody>
				</table>
		</div>
		
		<div class="pBox">
		<h2>Costs Information</h2>
			<div class="infoBox">
				<div class="pBox">
					<ul>
					<?php if(!empty($data)){?>
						<li><span>Total  Room Price:</span><span>￥<?php echo $totalroomprice?></span></li><!-- 房间总价 -->
						<li><span>Taxes  price:</span><span>￥<?php echo $tax_price?></span></li><!-- 税收费 -->
						<li><span>Surcharge  price:</span><span>￥<?php echo $surcharge?></span></li><!-- 附加费 -->
						<li><span>Quayage  price:</span><span>￥<?php echo $quayage?></span></li><!-- 码头税 -->
						<li><span>Total  price:</span><span>￥<?php echo $totalroomprice+$tax_price+$surcharge+$quayage?></span></li>
					<?php }else{?>
					<li><span>Total  Room Price:</span><span>￥0</span></li><!-- 房间总价 -->
						<li><span>Taxes  price:</span><span>￥0</span></li><!-- 税收费 -->
						<li><span>Surcharge  price:</span><span>￥0</span></li><!-- 附加费 -->
						<li><span>Quayage  price:</span><span>￥0</span></li><!-- 码头税 -->
						<li><span>Total  price:</span><span>￥0</span></li>
					<?php }?>
					</ul>
				</div>
			</div>
			<div class="btnBox2">
				<input type="button" id="back" value="Back" class="btn2"></input>
				<input type="button" value="PAY" id="pay" class="btn1"></input>
				<input type="button" value="Cancel The Order" id="cancelorder" class="btn1"></input>
			</div>
		</div>
		<div class="shadow"></div>
		<div class="popups prompt">
				<h3>Prompt<a href="#" class="r close">&#10006;</a></h3>
				<div class="pBox">
					<p>Do you want to cancel the order?</p>
					<p class="btnBox">
						<input type="button" value="YES" id="submitcancelorder" class="btn1"></input>
						<input type="button" value="NO" class="btn2"></input>
					</p>
				</div>
			</div>
	</div>
	</div>
<!-- main content end -->
	<input type="hidden" value="<?php echo isset($_GET['id'])?$_GET['id']:''?>" id="order_serial_number"/>
<script>
	window.onload=function(){
		$("#back").click(function(){
			location.href="<?php echo Url::toRoute(['ticket_center']);?>";
			});
		$("#pay").click(function(){
			location.href="<?php echo Url::toRoute(['bookingticke/payment']);?>&order_serial_number="+"<?php echo isset($_GET['id'])?$_GET['id']:''?>";
			});
		$("#cancelorder").on("click",function() {
			new PopUps($(".prompt"));
		});
		$("#submitcancelorder").click(function(){
		       var order_serial_number=$("#order_serial_number").val();
		         $.ajax({  
		             url: "<?php echo Url::toRoute(['cancelorder']);?>",
		             data:{order_serial_number:order_serial_number},
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
		        	if(tt==1){
						alert('Cancel Success');
						location.href="<?php echo Url::toRoute(['ticket_center']);?>";
			        	}
		        	else{
		        		alert('Cancel Fail');	
		        		location.href="<?php echo Url::toRoute(['ticket_center']);?>";	
			        	}
		         }  
			});
		}
</script>




