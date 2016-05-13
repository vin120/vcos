<?php
$this->title = 'Agent Ticketing';
use travelagent\views\myasset\PublicAsset;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

PublicAsset::register($this);
$baseUrl = $this->assetBundles[PublicAsset::className()]->baseUrl . '/';

?>
<!-- main content start -->
<div id="refundApplication" class="mainContent">
    <div id="topNav">
    <?php echo yii::t('app','Agent Ticketing')?>&nbsp;&gt;&gt;&nbsp;
    <a href="#"><?php echo yii::t('app','Refund Ticket')?></a>
    </div>
    <div id="mainContent_content">
		<!-- 请用ajax提交 -->
		<div class="pBox">
			<table>
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
					<tr>
						<td>1</td>
						<td>20151212001</td>
						<td>CTS1212-105</td>
						<td>烟台-仁川(过夜)-烟台，3晚4天游</td>
						<td>￥20000</td>
						<td>2015-12-12 10:12:24</td>
						<td>Finished</td>
						<td><button class="btn1"><img src="<?=$baseUrl?>images/return.png"></button></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- main content end -->

<script type="text/javascript">
window.onload = function(){ 


}
</script>



