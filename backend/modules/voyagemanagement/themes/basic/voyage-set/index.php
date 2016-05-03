<?php
$this->title = 'Voyage Management';


use app\modules\voyagemanagement\themes\basic\myasset\ThemeAsset;
use app\modules\voyagemanagement\themes\basic\myasset\ThemeAssetDate;
use yii\helpers\Url;
use yii\widgets\ActiveForm;


ThemeAsset::register($this);
ThemeAssetDate::register($this);
$baseUrl = $this->assetBundles[ThemeAsset::className()]->baseUrl . '/';

//$assets = '@app/modules/membermanagement/themes/basic/static';
//$baseUrl = Yii::$app->assetManager->publish($assets);

?>

<!-- content start -->
<div class="r content">
<div class="topNav">Voyage Manage&nbsp;&gt;&gt;&nbsp;
    <a href="<?php echo Url::toRoute(['index']);?>">Voyage Set</a></div>
    <?php
		$form = ActiveForm::begin([
			'method'=>'post',
			'enableClientValidation'=>false,
			'enableClientScript'=>false
		]); 
	?>
	<div class="search">
		<label>
			<span>Voyage Name:</span>
			<input type="text" id="voyage_name" name="voyage_name" value="<?php echo $voyage_name ?>"></input>
		</label>
		<label>
			<span>Start Time:</span>
			<input type="text" id="s_time" name="s_time" placeholder="please choose" value="<?php echo $s_time?>" readonly></input>
		</label>
		<label>
		<span>End Time:</span>
			<input type="text" id="e_time" name="e_time" placeholder="please choose" value="<?php echo $e_time?>" readonly ></input>
		</label>
		<span class="btn"><input type="submit" value="SEARCH"></input></span>
	</div>
	<?php
		ActiveForm::end();
	?>
	<div class="searchResult">
		<table id="voyage_table">
			<thead>
				<tr>
					<th>Voyage Name</th>
					<th>Voyage Num</th>
					<th>Start Time</th>
					<th>End Time</th>
					<th>Operate</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($voyage as $row ){ ?>
				<tr>
					<td><?php echo $row['voyage_name']?></td>
					<td><?php echo $row['voyage_num']?></td>
					<td><?php echo $row['start_time']?></td>
					<td><?php echo $row['end_time']?></td>
					<td>
						<a href="<?php echo Url::toRoute(['voyage_edit']).'&voyage_id='.$row['id'];?>"><img src="<?=$baseUrl ?>images/write.png" ></a>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		<p class="records">Records:<span><?php echo $count ?></span></p>
		<div class="btn">
			<a href="<?php echo Url::toRoute(['voyage_add']);?>"><input type="button" value="Add"></input></a>
		</div>
		<!--分页-->
		 <div class="center" id="voyage_page_div"> </div>
	</div>
</div>
<!-- content end -->


<script type="text/javascript">
window.onload = function(){
	<?php $voyage_total = (int)ceil($count/2);
		if($voyage_total >1){
	?>

	$('#voyage_page_div').jqPaginator({
	    totalPages: <?php echo $voyage_total;?>,
	    visiblePages: 5,
	    currentPage: 1,
	    wrapper:'<ul class="pagination"></ul>',
	    first: '<li class="first"><a href="javascript:void(0);">First</a></li>',
	    prev: '<li class="prev"><a href="javascript:void(0);">«</a></li>',
	    next: '<li class="next"><a href="javascript:void(0);">»</a></li>',
	    last: '<li class="last"><a href="javascript:void(0);">Last</a></li>',
	    page: '<li class="page"><a href="javascript:void(0);">{{page}}</a></li>',
	    onPageChange: function (num, type) {
	    	var this_page = $("input#cruise_page").val();
	    	if(this_page==num){$("input#cruise_page").val('fail');return false;}
	  
	    	var voyage_name = '<?php echo $voyage_name ?>';
	    	var s_time = '<?php echo $s_time ?>';
	    	var e_time = '<?php echo $e_time ?>';

	    	$.ajax({
                url:"<?php echo Url::toRoute(['get_voyage_page']);?>",
                type:'get',
                data:'pag='+num+'&voyage_name='+voyage_name+"&s_time="+s_time+"&e_time="+e_time,
             	dataType:'json',
            	success:function(data){
                	var str = '';
            		if(data != 0){
    	                $.each(data,function(key){
                        	str += "<tr>";	
                            str += "<td>"+data[key]['voyage_name']+"</td>";
                            str += "<td>"+data[key]['voyage_num']+"</td>";
                            str += "<td>"+data[key]['start_time']+"</td>";
                            str += "<td>"+data[key]['end_time']+"</td>";
                            str += "<td><a href='<?php echo Url::toRoute(['voyage_edit']);?>&voyage_id="+data[key]['id']+"'><img src='<?=$baseUrl ?>images/write.png'></a>";
	                        str += "</td>";
                            str += "</tr>";
                          });
    	                $("table#voyage_table > tbody").html(str);
    	            }
            	}      
            });
    	}
	});
	<?php }?>


	var start = {
	    dateCell: '#s_time',
	    format: 'YYYY-MM-DD hh:mm:ss',
	    minDate: '0000-00-00 00:00:00', //设定最小日期为当前日期
		festival:false,
	    maxDate: '2199-99-99 23:59:59', //最大日期
	    isTime: true,
	    choosefun: function(datas){
	         end.minDate = datas; //开始日选好后，重置结束日的最小日期
	    }
	};
	var end = {
	    dateCell: '#e_time',
	    format: 'YYYY-MM-DD hh:mm:ss',
	    minDate: '0000-00-00 00:00:00', //设定最小日期为当前日期
		festival:false,
	    maxDate: '2199-99-99 23:59:59', //最大日期
	    isTime: true,
	    choosefun: function(datas){
	         start.maxDate = datas; //将结束日的初始值设定为开始日的最大日期
	    }
	};
		jeDate(start);
		jeDate(end);
}
</script>
