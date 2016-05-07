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

<!-- content start -->
<div class="r content" id="user_content">
    <div class="topNav"><?php echo yii::t('app','Voyage Manage')?>&nbsp;&gt;&gt;&nbsp;
    <a href="<?php echo Url::toRoute(['preferential_way']);?>"><?php echo yii::t('app','Preferential Way')?></a>&nbsp;&gt;&gt;&nbsp;
    <a href="#"><?php echo yii::t('app','Preferential_way_edit')?></a></div>
    
    <div class="searchResult">
        
        <div id="service_write" class="write">

		<?php
			$form = ActiveForm::begin([
				'action' => ['preferential_way_edit','id'=>$way_result['id']],
				'method'=>'post',
				'id'=>'way_val',
				'options' => ['class' => 'way_edit'],
				'enableClientValidation'=>false,
				'enableClientScript'=>false
			]); 
		?>
		
		<div class='check_save_div'>
			<p>
				<label>
					<span class='max_l'><?php echo yii::t('app','Strategy Name')?>:</span>
					<input type="text" id='name' name='name' value="<?php echo $way_result['strategy_name']?>"></input>
					
				</label>
				<span class='tips'></span>
			</p>
			
		</div>
		<div class="btn">
				<input type="submit" value="<?php echo yii::t('app','SAVE')?>"></input>
				
			</div>
		<?php 
		ActiveForm::end(); 
		?>

	</div>
        
    </div>
</div>
<!-- content end -->
