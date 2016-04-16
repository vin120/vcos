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
var ajax_url = "<?php echo Url::toRoute(['country_code_check']);?>";
</script>

<!-- content start -->
<div class="r content" id="user_content">
    <div class="topNav">Voyage Manage&nbsp;&gt;&gt;&nbsp;
    <a href="<?php echo Url::toRoute(['country']);?>">Country</a>&nbsp;&gt;&gt;&nbsp;
    <a href="#">Country_add</a></div>
    
    <div class="searchResult">
        
        <div id="service_write" class="pop-ups write max_write">

		<?php
			$form = ActiveForm::begin([
					'action' => ['country_add'],
					'method'=>'post',
					'id'=>'country_val',
					'options' => ['class' => 'country_add'],
					'enableClientValidation'=>false,
					'enableClientScript'=>false
			]); 
		?>
		<div>
			<p>
				<label>
					<span class='max_l'>Country Code:</span>
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
					<span class='max_l'>Country Code(3 character):</span>
					<input type="text" id="code_chara" name="code_chara"></input>
					
				</label>
				<span class='tips'></span>
			</p>
			<p>
				<label>
					<span class='max_l'>Country Name:</span>
					<input type="text" id="name" name="name"></input>
					
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

