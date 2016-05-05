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
    <a href="#">Voyage_set_edit</a></div>
    
    <div class="searchResult">
        
        <div id="service_write" class="write date_write">

		<?php
			$form = ActiveForm::begin([
					'action' => ['voyage_set_edit','code'=>$voyage_set_result['voyage_code']],
					'method'=>'post',
					'id'=>'voyage_set_val',
					'options' => ['class' => 'voyage_set_edit'],
					'enableClientValidation'=>false,
					'enableClientScript'=>false
			]); 
		?>
		
		<div>
			<input type="hidden" id="id" name="id" value="<?php echo $voyage_set_result['id']?>" />
			<p>
				<label>
					<span class='max_l'>Voyage Code:</span>
					<input type="text" id='code' name='code' value="<?php echo $voyage_set_result['voyage_code']?>"></input>
					
				</label>
				<label>
					<span>Status:</span>
					<select name="state" id="state">
						<option value='1' <?php echo $voyage_set_result['status']==1?"selected='selected'":'';?>>Usable</option>
						<option value='0' <?php echo $voyage_set_result['status']==0?"selected='selected'":'';?>>Disabled</option>
					</select>
				</label>
				<span class='tips'></span>
			</p>
			<p>
				<label>
					<span class='max_l'>Cruise Code:</span>
					<select id="cruise_code" name="cruise_code">
					<?php foreach ($cruise_result as $val){?>
					<option <?php if($val['cruise_code']==$voyage_set_result['cruise_code']){echo "selected='selected'";}?> value="<?php echo $val['cruise_code']?>"><?php echo $val['cruise_code']?></option>
					<?php }?>
					</select>
				</label>
				<span class='tips'></span>
			</p>
			<p>
				<label>
					<span class='max_l'>Start Time:</span>
					<input type="text" value="<?php echo $voyage_set_result['start_time']?>" id="s_time" name="s_time"  placeholder="please choose"  readonly></input>
					
				</label>
				<span class='tips'></span>
			</p>
			<p>
				<label>
					<span class='max_l'>End Time:</span>
					<input type="text" value="<?php echo $voyage_set_result['end_time']?>" id="e_time" name="e_time" placeholder="please choose"  readonly></input>
					
				</label>
				<span class='tips'></span>
			</p>
			<p>
				<label>
					<span class='max_l'>Voyage Name:</span>
					<input type="text" id="name" name="name" value="<?php echo $voyage_set_result['voyage_name']?>"></input>
				</label>
				<span class='tips'></span>
			</p>
			<p>
				<label>
					<span class='max_l'>Voyage Desc:</span>
					<textarea id="desc" name="desc">
					<?php echo $voyage_set_result['voyage_desc']?>
					</textarea>
				</label>
				<span class='tips'></span>
			</p>
			
		</div>
		<div class="btn">
				<input type="submit" value="SAVE"></input>
				<input class='cancle' type="button" value="CANCLE"></input>
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
