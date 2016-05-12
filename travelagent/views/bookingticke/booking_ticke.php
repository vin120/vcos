<?php
$this->title = 'Agent Ticketing';


use travelagent\views\myasset\PublicAsset;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

PublicAsset::register($this);
$baseUrl = $this->assetBundles[PublicAsset::className()]->baseUrl . '/';

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
							<input type="text"></input>
						</span>
					</label>
					<label>
						<span>Route Code:</span>
						<span>
							<input type="text"></input>
						</span>
					</label>
					<input type="button" value="SEARCH" class="btn1"></input>
				</div>
				<div class="pBox">
					<table>
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
								<td>$888</td>
								<td>2015-12-12</td>
								<td>2015-12-15</td>
								<td>烟台-仁川(过夜)，3夜4天游</td>
								<td><button class="btn1"><img src="img/right.png"></button></td>
							</tr>
						<?php }?>
						</tbody>
					</table>
					<div class="pagination">
						<ul class="clearfix">
							<li class="active"><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li class="icon"><a href="#">>></a></li>
							<li><a href="#">Last</a></li>
						</ul>
					</div>
				</div>
			</div>
</div>
<!-- main content end -->

<script type="text/javascript">
window.onload = function(){ 


}
</script>



