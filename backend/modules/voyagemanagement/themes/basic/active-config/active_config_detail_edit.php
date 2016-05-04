<?php
$this->title = 'Voyage Management';

use app\modules\voyagemanagement\themes\basic\myasset\ThemeAsset;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\modules\voyagemanagement\themes\basic\myasset\ThemeAssetUpload;

ThemeAsset::register($this);
ThemeAssetUpload::register($this);

$baseUrl = $this->assetBundles[ThemeAsset::className()]->baseUrl . '/';
$baseUrl_upload = $this->assetBundles[ThemeAssetUpload::className()]->baseUrl . '/';

?>


<!-- content start -->
<div class="r content" id="user_content">
    <div class="topNav">Route Manage&nbsp;&gt;&gt;&nbsp;
	<a href="<?php echo Url::toRoute(['active_config']);?>">Active Config</a>&nbsp;&gt;&gt;&nbsp;
	<a href="#">Active Config Edit</a></div>
    
    <div class="searchResult">
        <div id="service_write" class="pop-ups write max_write">

		<?php
			$form = ActiveForm::begin([
				'action' => ['active_config_detail_edit'],
				'method'=>'post',
				'id'=>'active_config_detail_edit',
				'options' => ['class' => 'active_config_detail_edit','enctype'=>'multipart/form-data'],
				'enableClientValidation'=>false,
				'enableClientScript'=>false
			]); 
		?>
		<input type="hidden" id="active_id" name="active_id" value="<?php echo $active_detail['active_id'];?>"></input>
		<input type="hidden" id="active_detail_id" name="active_detail_id" value="<?php echo $active_detail['id'];?>" ></input>
		<div>
			<p>
				<label>
					<span class='max_l'>Day:</span>
					<select name="day_from" id="day_from">
						<?php for($i=1;$i<=100;$i++){ ?>
                       		<option value="<?php echo $i;?>" <?php if($i == $active_detail['day_from']){?> selected="selected" <?php }?>><?php echo $i?></option>
                        <?php } ?>
					</select>
					~
					<select name="day_to" id="day_to" disabled="disabled">
						<?php for($i=1;$i<=100;$i++){ ?>
                       		<option value="<?php echo $i;?>" <?php if($i == $active_detail['day_to'] && $active_detail['day_to'] != '' ){?> selected="selected" <?php }?>><?php echo $i?></option>
                        <?php } ?>
					</select>
					<input type="hidden" id="day_to_tmp" name="day_to_tmp" value="<?php echo $active_detail['day_to'];?>"></input>
					<input type="checkbox" id="more_day" name="more_day" value="1">Days</input> 
				</label>
				
				<span class='tips'></span>
			</p>
			<p>
				<label>
					<span class='max_l'>Title:</span>
					<input type="text" id='detail_title' name='detail_title' value="<?php echo $active_detail['detail_title'];?>" required></input><!-- modify required -->
				</label>
				
				<span class='tips'></span>
			</p>
			<p style="clear: both">
				<label>
					<span class='max_l'>Desc:</span>
					<textarea id='detail_desc' name='detail_desc' ><?php echo $active_detail['detail_desc']?></textarea>
				</label>
				<span class='tips'></span>
			</p>
			<p>
				<label>
					<span class='max_l' style="float: left;">Active Img:</span>
					<span style="width:120px;height:120px;float:left;margin-left:5px;">
					<img id="ImgPr" width="120" height="120" src="<?php echo $baseUrl.'upload/'.$active_detail['detail_img'] ; ?>"/>
					</span>
					<span id="up_btn" class="btn_img" style="display:inline-block;margin-left:5px;">
						<span>Pick Img</span>
						<input id="photoimg" type="file" name="photoimg" style="width:60px;">
					</span>
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
	
	$("input#more_day").on('click',function(){
		if($(this).is(":checked")){
			$("select[name='day_to']").removeAttr('disabled');
		}else{
			$("select[name='day_to']").attr("disabled",'disabled');
		}
	});

	
	if($("input#day_to_tmp").val() != ''){
		$("select[name='day_to']").removeAttr('disabled');
		$('input#more_day').attr("checked",'checked');
	}else{
		$("select[name='day_to']").attr("disabled",'disabled');
		$('input#more_day').removeAttr("checked");
	}


	



   	$("#photoimg").uploadPreview({ Img: "ImgPr", Width: 120, Height: 120 });
}
</script>