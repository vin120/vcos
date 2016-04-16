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
var shore_excursion_ajax_url = "<?php echo Url::toRoute(['shore_excursion_code_check']);?>";
</script>

<!-- content start -->
<div class="r content" id="user_content">
    <div class="topNav">Voyage Manage&nbsp;&gt;&gt;&nbsp;
    <a href="<?php echo Url::toRoute(['shore_excursion']);?>">Shore Excursion</a>&nbsp;&gt;&gt;&nbsp;
    <a href="#">Shore_excursion_add</a></div>
    
    <div class="searchResult">
        
        <div id="service_write" class="pop-ups write max_write">

		<?php
			$form = ActiveForm::begin([
					'action' => ['shore_excursion_add'],
					'method'=>'post',
					'id'=>'shore_excursion_val',
					'options' => ['class' => 'shore_excursion_add'],
					'enableClientValidation'=>false,
					'enableClientScript'=>false
			]); 
		?>
		<div>
			<p>
				<label>
					<span class='max_l'>Shore Excursion Code:</span>
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
					<span class='max_l'>Shore Excursion Name:</span>
					<input type="text" id="name" name="name"></input>
					
				</label>
				<span class='tips'></span>
			</p>
			<p>
				<label>
					<span class='max_l'>Shore Excursion Info:</span>
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

