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
    <div class="topNav">Voyage Manage&nbsp;&gt;&gt;&nbsp;<a href="#">Voyage Set</a></div>
    <?php
			$form = ActiveForm::begin([
					'method'=>'post',
					'enableClientValidation'=>false,
					'enableClientScript'=>false
			]); 
		?>
    <div class="search">
        <label>
            <span>Voyage Set Code:</span>
            <input type="text"></input>
        </label>
        <label>
            <span>Cruise Code:</span>
            <input type="text"></input>
        </label>
        <div style="clear: both;margin-top:15px;"></div>
        <label>
            <span>Voyage Set Name:</span>
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
        <table id="voyage_set_table">
        <input type="hidden" id="voyage_set_page" value="<?php echo $voyage_set_pag;?>" />
            <thead>
            <tr>
                <th><input type="checkbox"></input></th>
                <th>voyage_code</th>
                <th>cruise_code</th>
                <th>voyage_name</th>
                <th>voyage_desc</th>
                <th>start_time</th>
                <th>end_time</th>
                <th>Status</th>
                <th>Operate</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($voyage_set_result as $key=>$row){?>
            <tr>
                <td><input type="checkbox" name="ids[]" value="<?php echo $row['voyage_code'];?>"></input></td>
                <td><?php echo $row['voyage_code'];?></td>
                <td><?php echo $row['cruise_code'];?></td>
                <td><?php echo $row['voyage_name'];?></td>
                <td><?php echo $row['voyage_desc'];?></td>
                <td><?php echo $row['start_time'];?></td>
                <td><?php echo $row['end_time'];?></td>
                <td><?php echo $row['status']?yii::t('vcos', 'Usable'):yii::t('vcos', 'Disabled');?></td>
                <td class="op_btn">
                    <a href="<?php echo Url::toRoute(['voyage_set_edit','code'=>$row['voyage_code']]);?>"><img src="<?=$baseUrl ?>images/write.png"></a>
                    <a class="delete" id="<?php echo $row['voyage_code'];?>"><img src="<?=$baseUrl ?>images/delete.png"></a>
                </td>
            </tr>
            <?php }?>
            </tbody>
        </table>
       <?php 
		ActiveForm::end(); 
		?>
        <p class="records">Records:<span><?php echo $voyage_set_count;?></span></p>
        <div class="btn">
            <a href="<?php echo Url::toRoute(['voyage_set_add']);?>"><input type="button" value="Add"></input></a>
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
        <div class="center" id="voyage_set_page_div"> </div>
    </div>
    
</div>
<!-- content end -->



<script type="text/javascript">
window.onload = function(){ 
	<?php $voyage_set_total = (int)ceil($voyage_set_count/2);
	if($voyage_set_total >1){
	?>
		$('#voyage_set_page_div').jqPaginator({
		    totalPages: <?php echo $voyage_set_total;?>,
		    visiblePages: 5,
		    currentPage: 1,
		    wrapper:'<ul class="pagination"></ul>',
		    first: '<li class="first"><a href="javascript:void(0);">First</a></li>',
		    prev: '<li class="prev"><a href="javascript:void(0);">«</a></li>',
		    next: '<li class="next"><a href="javascript:void(0);">»</a></li>',
		    last: '<li class="last"><a href="javascript:void(0);">Last</a></li>',
		    page: '<li class="page"><a href="javascript:void(0);">{{page}}</a></li>',
		    onPageChange: function (num, type) {
		    	var this_page = $("input#voyage_set_page").val();
		    	if(this_page==num){$("input#voyage_set_page").val('fail');return false;}
		    	
		    	$.ajax({
	                url:"<?php echo Url::toRoute(['get_voyage_set_page']);?>",
	                type:'get',
	                data:'pag='+num,
	             	dataType:'json',
	            	success:function(data){
	                	var str = '';
	            		if(data != 0){
	    	                $.each(data,function(key){
	                        	str += "<tr>";
	                            str += "<td><input name='ids[]' type='checkbox' value='"+data[key]['voyage_code']+"'></input></td>";
	                            str += "<td>"+data[key]['voyage_code']+"</td>";
	                            str += "<td>"+data[key]['cruise_code']+"</td>";
	                            str += "<td>"+data[key]['voyage_name']+"</td>";
	                            str += "<td>"+data[key]['voyage_desc']+"</td>";
	                            str += "<td>"+data[key]['start_time']+"</td>";
	                            str += "<td>"+data[key]['end_time']+"</td>";
	                            if(data[key]['status']==1)
	                            	var status = "Usable";
	                            else if(data[key]['status']==0)
	                            	var status = "Disabled";
	                            str += "<td>"+status+"</td>";
	                            str += "<td  class='op_btn'>";
	                            str += "<a href='<?php echo Url::toRoute(['voyage_set_edit']);?>&code="+data[key]['voyage_code']+"'><img src='<?=$baseUrl ?>images/write.png'></a>";
	                            str += "<a class='delete' id='"+data[key]['voyage_code']+"'><img src='<?=$baseUrl ?>images/delete.png'></a>";
		                        str += "</td>";
	                            str += "</tr>";
	                          });
	    	                $("table#voyage_set_table > tbody").html(str);
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
	   location.href="<?php echo Url::toRoute(['voyage_set']);?>"+"&code="+val;
   });

 //delete删除确定but
   $(document).on('click',"#promptBox > .btn .confirm_but_more",function(){
	   $("form:first").submit();
   });


}
</script>



