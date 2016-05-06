<?php
$this->title = 'Voyage Management';

use app\modules\voyagemanagement\themes\basic\myasset\ThemeAsset;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

ThemeAsset::register($this);

$baseUrl = $this->assetBundles[ThemeAsset::className()]->baseUrl . '/';

?>

<style>
.pagination{display:inline-flex;}
</style>

<!-- content start -->
<div class="r content">
	<div class="topNav"><?php echo yii::t('app','Route Manage')?>&nbsp;&gt;&gt;&nbsp;
	<a href="<?php echo Url::toRoute(['active_config']);?>"><?php echo yii::t('app','Active Config')?></a>&nbsp;&gt;&gt;&nbsp;
	<a href="#"><?php echo yii::t('app','Active Config Edit')?></a></div>
	<div class="tab">
		<ul class="tab_title">
			<li class="active" id="tab_active">Active</li>
			<li id="tab_detail">Detail</li>
		</ul>
		<div class="tab_content">
			<div class="active">
				<div class="write">
				<?php
					$form = ActiveForm::begin([
						'action'=>['active_config_edit'],
						'method'=>'post',
						'id'=>'active_config_edit',
						'options' => ['class' => 'active_config_edit'],
						'enableClientValidation'=>false,
						'enableClientScript'=>false
					]); 
				?>
					<div>
						<p>
							<label>
								<span><?php echo yii::t('app','Name')?>:</span>
								<input type="text" id="name" name="name" value="<?php echo $active['name'] ?>" required></input>
								<input type="hidden" id="active_id" name="active_id" value="<?php echo $active['active_id']?>" ></input>
							</label>
							<span class='tips'></span>
						</p>
						<p>
							<label>
								<span><?php echo yii::t('app','Status')?>:</span>
								<select id="active_select" name="active_select">
									<option value="1" <?php if($active['status']=='1'){?>selected="selected"<?php }?>>Avaliable</option>
									<option value="0" <?php if($active['status']=='0'){?>selected="selected"<?php }?>>Unavaliable</option>
								</select>
							</label>
							<span class='tips'></span>
						</p>
					</div>
					<div class="btn">
						<input type="submit" value="<?php echo yii::t('app','SAVE')?>"></input>
						<input type="button" class="cancle" value="<?php echo yii::t('app','CLEAN')?>" ></input>
					</div>
					<?php 
						ActiveForm::end(); 
					?>
				</div>
			</div>
			<div>
				<div>
				<?php 
					$form = ActiveForm::begin([
						'action'=>['active_config_detail_delete'],
						'method'=>'post',
						'id'=>'active_config_detail_delete',
						'options' => ['class' => 'active_detail_delete'],
						'enableClientValidation'=>false,
						'enableClientScript'=>false
					]);
				?>
        			<input type="hidden" id="active_config_page" value="<?php echo $active_config_page;?>" />
					<table id="active_config_table">
						<thead>
							<tr>
								<th><input type="checkbox"></input></th>
								<th><?php echo yii::t('app','Day')?></th>
								<th><?php echo yii::t('app','Title')?></th>
								<th><?php echo yii::t('app','Desc')?></th>
								<th><?php echo yii::t('app','Operate')?></th>
							</tr>
						</thead>
						<tbody>
						<!-- 
							<?php //foreach($active_detail as $key=>$row){?>
							<tr>
								<td><input type="checkbox" name="ids[]" value="<?php //echo $row['id']?>"></input></td>
								<td><?php //echo $row['day_from']; if($row['day_to'] != null) { echo " - ".$row['day_to']; }?></td>
								<td><?php //echo //$row['detail_title']?></td>
								<td><?php //echo //$row['detail_desc']?></td>
								<td class='op_btn'>
			                    	<a href="<?php //echo Url::toRoute(['active_config_detail_edit'])."&active_id=".$active['active_id']."&id=".$row['id'];?>"><img src="<?=$baseUrl ?>images/write.png"></a>
									<a class="delete" id="<?php //echo $row['id'];?>" ><img src="<?=$baseUrl ?>images/delete.png"></a>
								</td>
							</tr>
							<?php //}?>
						-->
						</tbody>
					</table>
					<input type="hidden" id="active_id" name="active_id" value="<?php echo $active['active_id']?>" ></input>
					<?php 
						ActiveForm::end(); 
					?>
					<p class="records"><?php echo yii::t('app','Records')?>:<span><?php echo 0//$count;?></span></p>
					<div class="btn">
						<a href="<?php echo Url::toRoute(['active_config_detail_add']).'&active_id='.$active['active_id'];?>" ><input type="button" value="Add"></input></a>
						<input id="del_submit" type="button" value="Del Selected"></input>
					</div>
					<!-- 分页 -->
        			<div class="center" id="active_config_page_div"> </div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- content end -->

<script type="text/javascript">
window.onload = function(){

	$(document).on('click','#tab_detail',function(){
		$.ajax({
            url:"<?php echo Url::toRoute(['get_active_config_detail_ajax']);?>",
            type:'get',
            data:'active_id='+<?php echo $active['active_id']?>,
         	dataType:'json',
        	success:function(data){
	        
        	}
        });
	});
	
	//delete删除确定button
   $(document).on('click',"#promptBox > .btn .confirm_but",function(){
	   var val = $(this).attr('id');
	   var val_id = $("input[name='active_id']").val();
	   location.href="<?php echo Url::toRoute(['active_config_detail_delete']);?>"+"&id="+val+"&active_id="+val_id;
   });

 	//delete删除确定button
   $(document).on('click',"#promptBox > .btn .confirm_but_more",function(){
	   $("form#active_config_detail_delete").submit();
   });

}
</script>