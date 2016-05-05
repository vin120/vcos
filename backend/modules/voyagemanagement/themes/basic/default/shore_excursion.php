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
    <div class="topNav">Voyage Manage&nbsp;&gt;&gt;&nbsp;<a href="#">Shore Excursion</a></div>
    <?php
			$form = ActiveForm::begin([
					'method'=>'post',
					'enableClientValidation'=>false,
					'enableClientScript'=>false
			]); 
		?>
    <div class="search">
        <label>
			<span>Tour Code:</span>
			<input type="text"></input>
		</label>
		<label>
			<span>Tour Name:</span>
			<input type="text"></input>
		</label>
		<label>
			<span>Status:</span>
			<select>
				<option>All</option>
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
					'id'=>'shore_excursion_from',
					'enableClientValidation'=>false,
					'enableClientScript'=>false
			]); 
		?>
        <table id="shore_excursion_table">
        <input type="hidden" id="shore_excursion_page" value="<?php echo $shore_excursion_pag;?>" />
            <thead>
            <tr>
                <th><input type="checkbox"></input></th>
                <th>No.</th>
                <th>Tour Code</th>
                <th>Tour Name</th>
                <th>Describe</th>
                <th>Status</th>
                <th>Operate</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($shore_excursion_result as $key=>$row){?>
            <tr>
                <td><input type="checkbox" name="ids[]" value="<?php echo $row['se_code'];?>"></input></td>
                <td><?php echo ($key+1);?></td>
                <td><?php echo $row['se_code'];?></td>
                <td><?php echo $row['se_name'];?></td>
                <td><?php echo $row['se_info'];?></td>
                <td><?php echo $row['status']?yii::t('vcos', 'Usable'):yii::t('vcos', 'Disabled');?></td>
                <td class="op_btn">
                    <a href="<?php echo Url::toRoute(['shore_excursion_edit','code'=>$row['se_code']]);?>"><img src="<?=$baseUrl ?>images/write.png"></a>
                    <a class="delete" id="<?php echo $row['se_code'];?>"><img src="<?=$baseUrl ?>images/delete.png"></a>
                </td>
            </tr>
            <?php }?>
            </tbody>
        </table>
       <?php 
		ActiveForm::end(); 
		?>
        <p class="records">Records:<span><?php echo $shore_excursion_count;?></span></p>
        <div class="btn">
            <a href="<?php echo Url::toRoute(['shore_excursion_add']);?>"><input type="button" value="Add"></input></a>
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
        <div class="center" id="shore_excursion_page_div"> </div>
    </div>
    
</div>
<!-- content end -->



<script type="text/javascript">
window.onload = function(){ 
	<?php $shore_excursion_total = (int)ceil($shore_excursion_count/2);
	if($shore_excursion_total >1){
	?>
		$('#shore_excursion_page_div').jqPaginator({
		    totalPages: <?php echo $shore_excursion_total;?>,
		    visiblePages: 5,
		    currentPage: 1,
		    wrapper:'<ul class="pagination"></ul>',
		    first: '<li class="first"><a href="javascript:void(0);">First</a></li>',
		    prev: '<li class="prev"><a href="javascript:void(0);">«</a></li>',
		    next: '<li class="next"><a href="javascript:void(0);">»</a></li>',
		    last: '<li class="last"><a href="javascript:void(0);">Last</a></li>',
		    page: '<li class="page"><a href="javascript:void(0);">{{page}}</a></li>',
		    onPageChange: function (num, type) {
		    	var this_page = $("input#shore_excursion_page").val();
		    	if(this_page==num){$("input#shore_excursion_page").val('fail');return false;}
		    	
		    	$.ajax({
	                url:"<?php echo Url::toRoute(['get_shore_excursion_page']);?>",
	                type:'get',
	                data:'pag='+num,
	             	dataType:'json',
	            	success:function(data){
	                	var str = '';
	            		if(data != 0){
	    	                $.each(data,function(key){
	                        	str += "<tr>";
	                            str += "<td><input name='ids[]' type='checkbox' value='"+data[key]['se_code']+"'></input></td>";
	                            str += "<td>"+(key+1)+"</td>";
	                            str += "<td>"+data[key]['se_code']+"</td>";
	                            str += "<td>"+data[key]['se_name']+"</td>";
	                            str += "<td>"+data[key]['se_info']+"</td>";
	                            if(data[key]['status']==1)
	                            	var status = "Usable";
	                            else if(data[key]['status']==0)
	                            	var status = "Disabled";
	                            str += "<td>"+status+"</td>";
	                            str += "<td  class='op_btn'>";
	                            str += "<a href='<?php echo Url::toRoute(['shore_excursion_edit']);?>&code="+data[key]['se_code']+"'><img src='<?=$baseUrl ?>images/write.png'></a>";
	                            str += "<a class='delete' id='"+data[key]['se_code']+"'><img src='<?=$baseUrl ?>images/delete.png'></a>";
		                        str += "</td>";
	                            str += "</tr>";
	                          });
	    	                $("table#shore_excursion_table > tbody").html(str);
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
	   location.href="<?php echo Url::toRoute(['shore_excursion']);?>"+"&code="+val;
   });

 //delete删除确定but
   $(document).on('click',"#promptBox > .btn .confirm_but_more",function(){
	   $("form#shore_excursion_from").submit();
   });


}
</script>



