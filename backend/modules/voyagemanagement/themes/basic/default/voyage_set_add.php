<?php
$this->title = 'Voyage Management';

use app\modules\voyagemanagement\themes\basic\myasset\ThemeAsset;
use app\modules\voyagemanagement\themes\basic\myasset\ThemeAssetDate;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

ThemeAsset::register($this);
ThemeAssetDate::register($this);

$baseUrl = $this->assetBundles[ThemeAsset::className()]->baseUrl . '/';
$baseUrl_date = $this->assetBundles[ThemeAssetDate::className()]->baseUrl . '/';

//$assets = '@app/modules/membermanagement/themes/basic/static';
//$baseUrl = Yii::$app->assetManager->publish($assets);

?>
<script type="text/javascript">
var voyage_set_ajax_url = "<?php echo Url::toRoute(['voyage_set_code_check']);?>";
</script>

<!-- content start -->
<div class="r content" id="user_content">
    <div class="topNav">Voyage Manage&nbsp;&gt;&gt;&nbsp;
    <a href="<?php echo Url::toRoute(['voyage_set']);?>">Voyage Set</a>&nbsp;&gt;&gt;&nbsp;
    <a href="#">Voyage_set_add</a></div>
    <div class="searchResult">
        
        <div id="service_write" class="pop-ups write max_write date_write">

		<?php
			$form = ActiveForm::begin([
					'action' => ['voyage_set_add'],
					'method'=>'post',
					'id'=>'voyage_set_val',
					'options' => ['class' => 'voyage_set_add'],
					'enableClientValidation'=>false,
					'enableClientScript'=>false
			]); 
		?>
		<div>
			<p>
				<label>
					<span class='max_l'>Voyage Code:</span>
					<input type="text" id='code' name='code'></input>
					
				</label>
				<label>
					<span>Status:</span>
					<select name="state" id="state">
						<option value='1'>Usable</option>
						<option value='0'>Disabled</option>
					</select>
				</label>
				<span class='tips'></span>
			</p>
			<p>
				<label>
					<span class='max_l'>Cruise Code:</span>
					<select id="cruise_code" name="cruise_code">
					<?php foreach($cruise_result as $val){?>
					<option value="<?php echo $val['cruise_code']?>"><?php echo $val['cruise_code']?></option>
					<?php }?>
					</select>
				</label>
				<span class='tips'></span>
			</p>
			<p>
				<label>
					<span class='max_l'>Start Time:</span>
					<input type="text" id="s_time" name="s_time" placeholder="please choose"  readonly></input>
					
				</label>
				<span class='tips'></span>
			</p>
			<p>
				<label>
					<span class='max_l'>End Time:</span>
					<input type="text" id="e_time" name="e_time" placeholder="please choose"  readonly></input>
					
				</label>
				<span class='tips'></span>
			</p>
			<p>
				<label>
					<span class='max_l'>Voyage Name:</span>
					<input type="text" id="name" name="name"></input>
					
				</label>
				<span class='tips'></span>
			</p>
			<p>
				<label>
					<span class='max_l'>Voyage Desc:</span>
					<textarea id="desc" name="desc">
					</textarea>
				</label>
				<span class='tips'></span>
			</p>
			
			<div class="btn">
				<input type="submit" value="SAVE"></input>
				<input class="cancle" type="button" value="CANCLE"></input>
			</div>
		</div>
		<?php 
		ActiveForm::end(); 
		?>

	</div>
        
    </div>
</div>
<!-- content end -->


<script type="text/javascript">
window.onload = function(){
	var start = {
		    dateCell: '#s_time',
		    format: 'YYYY-MM-DD hh:mm:ss',
		    minDate: jeDate.now(0), //设定最小日期为当前日期
			festival:true,
			isinitVal:true,
		    maxDate: '2099-06-16 23:59:59', //最大日期
		    isTime: true,
		    choosefun: function(datas){
		         end.minDate = datas; //开始日选好后，重置结束日的最小日期
		    }
		};
		var end = {
		    dateCell: '#e_time',
		    format: 'YYYY-MM-DD hh:mm:ss',
		    minDate: jeDate.now(0), //设定最小日期为当前日期
			festival:true,
			isinitVal:true,
		    maxDate: '2099-06-16 23:59:59', //最大日期
		    isTime: true,
		    choosefun: function(datas){
		         start.maxDate = datas; //将结束日的初始值设定为开始日的最大日期
		    }
		};
		jeDate(start);
		jeDate(end);
}
</script>
