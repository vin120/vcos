
<?php
$this->title = 'Voyage Management';


use app\modules\voyagemanagement\themes\basic\myasset\ThemeAsset;

ThemeAsset::register($this);

$baseUrl = $this->assetBundles[ThemeAsset::className()]->baseUrl . '/';

//$assets = '@app/modules/membermanagement/themes/basic/static';
//$baseUrl = Yii::$app->assetManager->publish($assets);

?>
	<title>船舱</title>
	<meta charset="utf-8">
	<style type="text/css">
		.selectBox { float: left; width: 100%; overflow: hidden; box-sizing: border-box; }
		.selectList { border: 1px solid #e0e9f4; }
		.selectList ul { width: 200px; margin: 0; padding: 0; list-style: none; }
		.selectList ul:first-child { background-color: #99bfee; }
		.selectList ul:last-child { max-height: 500px; overflow-y: scroll; }
		.selectList li { display: table-row; }
		.selectList li > span { display: table-cell; padding: 10px; }
		.selectBox .btn input { display: block; margin: 20px; }
	</style>
		<div class="r content">
			<div class="topNav">Route Manage&nbsp;&gt;&gt;&nbsp;<a href="#">Scenic Route</a></div>
			<div class="search">
				<label>
					<span>Type:</span>
					<select>
						<option></option>
					</select>
				</label>
				<label>
					<span>Desk:</span>
					<select>
						<option></option>
					</select>
				</label>
			</div>
			<div class="searchResult selectBox">
				<div class="l selectList">
					<ul>
						<li><span><input type="checkbox"></span></input><span>未选</span></li>
					</ul>
					<ul id="left_ul">
					<?php for ($i=1;$i<11;$i++){?>
						<li><span><input value="<?php echo $i;?>" type="checkbox"></span><span class="text">abc_<?php echo $i;?></span></li>
					<?php }?>
					</ul>
				</div>
				<div class="btn l">
					<input id="right_but" type="button" value=">>"></input>
					<input id="left_but" type="button" value="<<"></input>
				</div>
				<div class="l selectList">
					<ul>
						<li><span><input type="checkbox"></span></input><span>已选</span></li>
					</ul>
					<ul id="right_ul">
						
					</ul>
				</div>
			</div>
		</div>
		<!-- content end -->




<script type="text/javascript">
window.onload = function(){ 
		$(document).on('click','#right_but',function(){
			var str = '';
			//alert('right');
			//获取左边选中值
			$("#left_ul li").find("input[type='checkbox']:checked").each(function(e){
				var id = $(this).val();
				var text = $(this).parent().parent().find("span.text").text();
				
				str += '<li><span><input value="'+id+'" type="checkbox"></span><span class="text">'+text+'</span></li>';
				$(this).parent().parent().remove();
			});
			
			$("#right_ul").append(str);
		});

		$(document).on('click','#left_but',function(){

			//alert('left');

			var str = '';
			//获取左边选中值
			$("#right_ul li").find("input[type='checkbox']:checked").each(function(e){
				var id = $(this).val();
				var text = $(this).parent().parent().find("span.text").text();
				
				str += '<li><span><input value="'+id+'" type="checkbox"></span><span class="text">'+text+'</span></li>';
				$(this).parent().parent().remove();
			});
			
			$("#left_ul").append(str);

				
		});


}
</script>