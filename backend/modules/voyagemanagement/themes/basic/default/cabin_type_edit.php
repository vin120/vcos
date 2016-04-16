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
<script type="text/javascript">
var cabin_type_ajax_url = "<?php echo Url::toRoute(['cabin_type_code_check']);?>";
</script>

<!-- content start -->
<div class="r content" id="user_content">
    <div class="topNav">Voyage Manage&nbsp;&gt;&gt;&nbsp;
    <a href="<?php echo Url::toRoute(['cabin_type']);?>">Port</a>&nbsp;&gt;&gt;&nbsp;
    <a href="#">Cabin_type_edit</a></div>
    
    <div class="searchResult">
        
        <div id="service_write" class="pop-ups write max_write">

		<?php
			$form = ActiveForm::begin([
					'action' => ['cabin_type_edit','code'=>$cabin_type_result['type_code']],
					'method'=>'post',
					'id'=>'cabin_type_val',
					'options' => ['class' => 'cabin_type_edit'],
					'enableClientValidation'=>false,
					'enableClientScript'=>false
			]); 
		?>
		
		<div>
			<input type="hidden" id="id" name="id" value="<?php echo $cabin_type_result['id']?>" />
			<p>
				<label>
					<span class='max_l'>Type Code:</span>
					<input type="text" id='code' name='code' value="<?php echo $cabin_type_result['type_code']?>"></input>
					
				</label>
				<label>
					<span>Status:</span>
					<select name="state" id="state">
						<option value='1' <?php echo $cabin_type_result['type_status']==1?"selected='selected'":'';?>>Usable</option>
						<option value='0' <?php echo $cabin_type_result['type_status']==0?"selected='selected'":'';?>>Disabled</option>
					</select>
				</label>
				<span class='tips'></span>
			</p>
			<p>
				<label>
					<span class='max_l'>Cruise Code:</span>
					<select id="cruise_code" name="cruise_code">
					<?php foreach ($cruise_result as $val){?>
					<option <?php if($val['cruise_code']==$cabin_type_result['cruise_code']){echo "selected='selected'";}?> value="<?php echo $val['cruise_code']?>"><?php echo $val['cruise_code']?></option>
					<?php }?>
					</select>
				</label>
				<span class='tips'></span>
			</p>
			<p>
				<label>
					<span class='max_l'>Type Name:</span>
					<input type="text" id="name" name="name" value="<?php echo $cabin_type_result['type_name']?>"></input>
				</label>
				<span class='tips'></span>
			</p>
			<p>
				<label>
					<span class='max_l'>Type Desc:</span>
					<textarea id="desc" name="desc">
					<?php echo $cabin_type_result['type_desc']?>
					</textarea>
				</label>
				<span class='tips'></span>
			</p>
			<div class="btn">
				<input type="submit" value="SAVE"></input>
				<input class='cancle' type="button" value="CANCLE"></input>
			</div>
		</div>
		<?php 
		ActiveForm::end(); 
		?>

	</div>
        
    </div>
</div>
<!-- content end -->

}
