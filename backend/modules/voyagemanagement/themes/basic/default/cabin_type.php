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
    <div class="topNav">Voyage Manage&nbsp;&gt;&gt;&nbsp;<a href="#">Cabin Type</a></div>
    <?php
			$form = ActiveForm::begin([
					'method'=>'post',
					'enableClientValidation'=>false,
					'enableClientScript'=>false
			]); 
		?>
    <div class="search">
    	<label>
            <span>Cabin Type Code:</span>
            <input type="text"></input>
        </label>
        <label>
            <span>Cabin Type Name:</span>
            <input type="text"></input>
        </label>
        <label>
            <span>Status:</span>
            <select>
                <option>All</option>
                <option>Usable</option>
                <option>Disabled</option>
            </select>
        </label>
        <span class="btn"><input type="button" value="SEARCH"></input></span>
    </div>
      <?php 
		ActiveForm::end(); 
		?>
    <div class="searchResult">
    <?php
			$form = ActiveForm::begin([
					'method'=>'post',
					'enableClientValidation'=>false,
					'enableClientScript'=>false
			]); 
		?>
        <table id="cabin_type_table">
        <input type="hidden" id="cabin_type_page" value="<?php echo $cabin_type_pag;?>" />
            <thead>
            <tr>
                <th><input type="checkbox"></input></th>
                <th>type_code</th>
                <th>cruise_code</th>
                <th>type_name</th>
                <th>type_desc</th>
                <th>Status</th>
                <th>Operate</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($cabin_type_result as $key=>$row){?>
            <tr>
                <td><input type="checkbox" name="ids[]" value="<?php echo $row['type_code'];?>"></input></td>
                <td><?php echo $row['type_code'];?></td>
                <td><?php echo $row['cruise_code'];?></td>
                <td><?php echo $row['type_name'];?></td>
                <td><?php echo $row['type_desc'];?></td>
                <td><?php echo $row['type_status']?yii::t('vcos', 'Usable'):yii::t('vcos', 'Disabled');?></td>
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
            <a href="<?php echo Url::toRoute(['cabin_type_add']);?>"><input type="button" value="Add"></input></a>
            <input id="del_submit" type="button" value="Del Selected"></input>
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
		    	
		    	$.ajax({
	                url:"<?php echo Url::toRoute(['get_cabin_type_page']);?>",
	                type:'get',
	                data:'pag='+num,
	             	dataType:'json',
	            	success:function(data){
	                	var str = '';
	            		if(data != 0){
	    	                $.each(data,function(key){
	                        	str += "<tr>";
	                            str += "<td><input name='ids[]' type='checkbox' value='"+data[key]['type_code']+"'></input></td>";
	                            str += "<td>"+data[key]['type_code']+"</td>";
	                            str += "<td>"+data[key]['cruise_code']+"</td>";
	                            str += "<td>"+data[key]['type_name']+"</td>";
	                            str += "<td>"+data[key]['type_desc']+"</td>";
	                            if(data[key]['type_status']==1)
	                            	var status = "Usable";
	                            else if(data[key]['type_status']==0)
	                            	var status = "Disabled";
	                            str += "<td>"+status+"</td>";
	                            str += "<td  class='op_btn'>";
	                            str += "<a href='<?php echo Url::toRoute(['cabin_type_edit']);?>&code="+data[key]['type_code']+"'><img src='<?=$baseUrl ?>images/write.png'></a>";
	                            str += "<a class='delete' id='"+data[key]['cabin_type_code']+"'><img src='<?=$baseUrl ?>images/delete.png'></a>";
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

 //delete删除确定but
   $(document).on('click',"#promptBox > .btn .confirm_but_more",function(){
	   $("form:first").submit();
   });


}
</script>



