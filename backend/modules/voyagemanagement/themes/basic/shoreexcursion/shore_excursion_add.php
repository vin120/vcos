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
<script type="text/javascript" src="<?php echo $baseUrl;?>js/My97DatePicker/WdatePicker.js"></script>
<!-- content start -->
<div class="r content" id="user_content">
    <div class="topNav"><?php echo yii::t('app','Voyage Manage')?>&nbsp;&gt;&gt;&nbsp;
    <a href="<?php echo Url::toRoute(['shore_excursion']);?>"><?php echo yii::t('app','Shore Excursion')?></a>&nbsp;&gt;&gt;&nbsp;
    <a href="#"><?php echo yii::t('app','Shore_excursion_add')?></a></div>
    
    <div class="searchResult">
        
        <div id="service_write" class="write">

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
					<span class='max_l'><?php echo yii::t('app','Tour Code')?>:</span>
					<input type="text" required id='code' name='code'></input>
					
				</label>
				
				<span class='tips'></span>
			</p>
			<p>
				<label>
					<span class='max_l'><?php echo yii::t('app','Tour Name')?>:</span>
					<input type="text" required id="name" name="name"></input>
					
				</label>
				<span class='tips'></span>
			</p>
			<p>
				<label>
					<span class='max_l'><?php echo yii::t('app','Price')?>:</span>
					<input type="text" required id="price" name="price"></input>
					
				</label>
				<span class='tips'></span>
			</p>
			<p>
				<label>
					<span class='max_l'><?php echo yii::t('app','Describe')?>:</span>
					<textarea id="desc" required name="desc">
					</textarea>
				</label>
				<span class='tips'></span>
			</p>
			<p>
				<label>
					<span class='max_l'><?php echo yii::t('app','Date')?>:</span>
					<input type="text" name="date_of_entry" value="" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss ',lang:'en'})" class="Wdate"   id="date_of_entry"></input>
					
				</label>
				<span class='tips'></span>
			</p>
			<p>
				<label>
					<span class='max_l'><?php echo yii::t('app','Status')?>:</span>
					<select name="state" id="state">
						<option value='1'><?php echo yii::t('app','Avaliable')?></option>
						<option value='0'><?php echo yii::t('app','Unavaliable')?></option>
					</select>
				</label>
			</p>
			
		</div>
		<div class="btn">
				<input type="submit" value="<?php echo yii::t('app','SAVE')?>"></input>
				<input class="cancle" type="button" value="<?php echo yii::t('app','CANCLE')?>"></input>
			</div>
		<?php 
		ActiveForm::end(); 
		?>

	</div>
        
    </div>
</div>
<!-- content end -->

