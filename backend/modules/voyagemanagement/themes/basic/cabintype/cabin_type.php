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
    <div class="topNav"><?php echo yii::t('app','Voyage Manage')?>&nbsp;&gt;&gt;&nbsp;<a href="#"><?php echo yii::t('app','Cabin Type')?></a></div>
    <?php
			$form = ActiveForm::begin([
					'method'=>'get',
					'enableClientValidation'=>false,
					'enableClientScript'=>false
			]); 
		?>
    <div class="search">
        <label>
            <span><?php echo yii::t('app','Cabin Type Name')?>:</span>
            <input type="text" name="w_name" value="<?php echo $w_name;?>"></input>
        </label>
        <label>
            <span><?php echo yii::t('app','Status')?>:</span>
            <select name="w_state">
                <option value="2" <?php echo $w_state==2?"selected='selected'":'';?>><?php echo yii::t('app','All')?></option>
                <option value="1" <?php echo $w_state==1?"selected='selected'":'';?>><?php echo yii::t('app','Avaliable')?></option>
                <option value="0" <?php echo $w_state==0?"selected='selected'":'';?>><?php echo yii::t('app','Unavaliable')?></option>
            </select>
        </label>
        <span class="btn"><input type="submit" name="w_submit" value="<?php echo yii::t('app','SEARCH')?>"></input></span>
    </div>
      <?php 
		ActiveForm::end(); 
		?>
    <div class="searchResult">
    <?php
			$form = ActiveForm::begin([
					'method'=>'post',
					'id'=>'cabin_type_from',
					'enableClientValidation'=>false,
					'enableClientScript'=>false
			]); 
		?>
        <table id="cabin_type_table">
        <input type="hidden" id="cabin_type_page" value="<?php echo $cabin_type_pag;?>" />
            <thead>
            <tr>
            	<th><?php echo yii::t('app','No.')?></th>
                <th><?php echo yii::t('app','Type Name')?></th>
                <th><?php echo yii::t('app','Beds')?></th>
                <th><?php echo yii::t('app','Live Number')?></th>
                <th><?php echo yii::t('app','Room Area')?></th>
                <th><?php echo yii::t('app','Floor')?></th>
                <th><?php echo yii::t('app','Cabin Location')?></th>
                <th><?php echo yii::t('app','Status')?></th>
                <th><?php echo yii::t('app','Operate')?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($cabin_type_result as $key=>$row){?>
            <tr>
            	<td><?php echo ($key+1);?></td>
            	<td><?php echo $row['type_name'];?></td>
                <td><?php echo $row['beds'];?></td>
                <td><?php echo $row['live_number'];?></td>
                <td><?php echo $row['room_area'];?></td>
                <td><?php echo $row['floor'];?></td>
                <td><?php echo $row['location'];?></td>
                <td><?php echo $row['type_status']?yii::t('vcos', 'Avaliable'):yii::t('vcos', 'Unavaliable');?></td>
                <td class="op_btn">
                    <a href="<?php echo Url::toRoute(['cabin_type_edit','code'=>$row['type_code']]);?>"><img src="<?=$baseUrl ?>images/write.png"></a>
                    <a class="delete" id="<?php echo $row['type_code'];?>"><img src="<?=$baseUrl ?>images/delete.png"></a>
                </td>
            </tr>
            <?php }?>
            </tbody>
        </table>
       <?php 
		ActiveForm::end(); 
		?>
        <p class="records">Records:<span><?php echo $cabin_type_count;?></span></p>
        <div class="btn">
            <a href="<?php echo Url::toRoute(['cabin_type_add']);?>"><input type="button" value="<?php echo yii::t('app','Add')?>"></input></a>
          
        </div>
        
<!--         <div class="pageNum"> -->
<!-- 					<span> -->
<!-- 						<a href="#" class="active">1</a> -->
<!-- 						<a href="#">2</a> -->
<!-- 						<a href="#">》</a> -->
<!-- 						<a href="#">Last</a> -->
<!-- 					</span> -->
<!--         </div> -->

        <!-- 分页 -->
        <div class="center" id="cabin_type_page_div"> </div>
    </div>
    
</div>
<!-- content end -->



<script type="text/javascript">
window.onload = function(){ 
	<?php $cabin_type_total = (int)ceil($cabin_type_count/2);
	if($cabin_type_total >1){
	?>
		$('#cabin_type_page_div').jqPaginator({
		    totalPages: <?php echo $cabin_type_total;?>,
		    visiblePages: 5,
		    currentPage: 1,
		    wrapper:'<ul class="pagination"></ul>',
		    first: '<li class="first"><a href="javascript:void(0);">First</a></li>',
		    prev: '<li class="prev"><a href="javascript:void(0);">«</a></li>',
		    next: '<li class="next"><a href="javascript:void(0);">»</a></li>',
		    last: '<li class="last"><a href="javascript:void(0);">Last</a></li>',
		    page: '<li class="page"><a href="javascript:void(0);">{{page}}</a></li>',
		    onPageChange: function (num, type) {
		    	var this_page = $("input#cabin_type_page").val();
		    	if(this_page==num){$("input#cabin_type_page").val('fail');return false;}

		    	var w_name = "<?php echo $w_name;?>";
		    	var w_state = "<?php echo $w_state;?>";

		    	var where_data = "&w_name="+w_name+"&w_state="+w_state; 
		    	
		    	
		    	$.ajax({
	                url:"<?php echo Url::toRoute(['get_cabin_type_page']);?>",
	                type:'get',
	                data:'pag='+num+where_data,
	             	dataType:'json',
	            	success:function(data){
	                	var str = '';
	            		if(data != 0){
	    	                $.each(data,function(key){
	                        	str += "<tr>";
	                        	str += "<td>"+(key+1)+"</td>";
	                            str += "<td>"+data[key]['type_name']+"</td>";
	                            str += "<td>"+data[key]['beds']+"</td>";
	                            str += "<td>"+data[key]['live_number']+"</td>";
	                            str += "<td>"+data[key]['room_area']+"</td>";
	                            str += "<td>"+data[key]['floor']+"</td>";
	                            str += "<td>"+data[key]['location']+"</td>";
	                            if(data[key]['type_status']==1)
	                            	var status = "Usable";
	                            else if(data[key]['type_status']==0)
	                            	var status = "Disabled";
	                            str += "<td>"+status+"</td>";
	                            str += "<td  class='op_btn'>";
	                            str += "<a href='<?php echo Url::toRoute(['cabin_type_edit']);?>&code="+data[key]['type_code']+"'><img src='<?=$baseUrl ?>images/write.png'></a>";
	                            str += "<a class='delete' id='"+data[key]['type_code']+"'><img src='<?=$baseUrl ?>images/delete.png'></a>";
		                        str += "</td>";
	                            str += "</tr>";
	                          });
	    	                $("table#cabin_type_table > tbody").html(str);
	    	            }
	            	}      
	            });
	    	
	       	// $('#text').html('当前第' + num + '页');
	    	}
		});
	<?php }?>

	//delete删除确定but
   $(document).on('click',"#promptBox > .btn .confirm_but",function(){
	   var val = $(this).attr('id');
	   location.href="<?php echo Url::toRoute(['cabin_type']);?>"+"&code="+val;
   });


}
</script>



