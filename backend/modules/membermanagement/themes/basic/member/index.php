<?php
$this->title = 'Member';


use app\modules\membermanagement\themes\basic\myasset\ThemeAsset;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

ThemeAsset::register($this);
$baseUrl = $this->assetBundles[ThemeAsset::className()]->baseUrl . '/';

//$assets = '@app/modules/membermanagement/themes/basic/static';
//$baseUrl = Yii::$app->assetManager->publish($assets);

?>

<!-- content start -->
<div class="r content" id="user_content">
    <div class="topNav"><?php echo yii::t('vcos', 'Route Manage') ?>&nbsp;&gt;&gt;&nbsp;<a href="#"><?php echo yii::t('vcos', 'Membership') ?></a></div>
    <div class="search">
    <?php
		$form = ActiveForm::begin([
    		'action' => ['index'],
    		'method'=>'post',
    		'id'=>'member_index',
    		'options' => ['class' => 'member_index'],
    		'enableClientValidation'=>false,
    		'enableClientScript'=>false
		]); 
	?>
        <label>
            <span><?php echo yii::t('vcos', 'Name') ?>:</span>
            <input type="text"  name="Name"></input>
        </label>
        <label>
            <span><?php echo yii::t('vcos', 'Member Code:') ?></span>
            <input type="text" id="MemberCode" name="MemberCode"></input>
        </label>
        <label>
            <span><?php echo yii::t('vcos', 'Gender') ?>:</span>
            <select id="Gender" name="Gender">
             	<option value='0'><?php echo yii::t('vcos', 'ALL') ?></option>
                <option value='M'><?php echo yii::t('vcos', 'Male') ?></option>
                <option value='F'><?php echo yii::t('vcos', 'Female') ?></option>
            </select>
        </label>
        <label>
            <span>Status:</span>
            <select id="Status" name="Status">
                <option value="-1"><?php echo yii::t('vcos', 'All') ?></option>
                <option value="0"><?php echo yii::t('vcos', 'Unactivated') ?></option>
                <option value="1"><?php echo yii::t('vcos', 'Activated') ?></option>
                <option value="2"><?php echo yii::t('vcos', 'Frozen') ?></option>
            </select>
        </label>
        <span class="btn"><input type="submit" value="<?php echo yii::t('vcos', 'SEARCH')?>"></input></span>
	<?php 
	   ActiveForm::end(); 
	?>
    </div>
    <div class="searchResult">
        <table>
            <thead>
                <tr>
                    <th><?php echo yii::t('vcos', 'MemberCode') ?></th>
                    <th><?php echo yii::t('vcos', 'SmartCard') ?></th>
                    <th><?php echo yii::t('vcos', 'Name') ?></th>
                    <th><?php echo yii::t('vcos', 'Gender') ?></th>
                    <th><?php echo yii::t('vcos', 'Birthday') ?></th>
                    <th><?php echo yii::t('vcos', 'Country') ?></th>
                    <th><?php echo yii::t('vcos', 'Phone') ?></th>
                    <th><?php echo yii::t('vcos', 'VipGrade') ?></th>
                    <th><?php echo yii::t('vcos', 'Status') ?></th>
                    <th><?php echo yii::t('vcos', 'Operator') ?></th>
                </tr>
            </thead>
            <tbody>
            <tr>
            <?php foreach($member_infos as $member): ?>
                <td><?php echo $member['m_code']?></td>
                <td><?php echo $member['smart_card_number']?></td>
                <td><?php echo $member['full_name']?></td>
                <td><?php 
                    if($member['gender'] == 'M')
                        echo yii::t('vcos', 'Male');
                    else 
                        echo yii::t('vcos', 'Female'); 
                    ?></td>
                <td><?php echo $member['birthday']?></td>
                <td><?php echo $member['country_code']?></td>
                <td><?php echo $member['mobile_number']?></td>
                <td><?php echo $member['vip_grade']?></td>
                <td><?php 
                    if($member['member_verification'] == '0') 
                        echo yii::t('vcos', 'Unactivated');
                    elseif($member['member_verification'] == '1')
                        echo yii::t('vcos', 'Activated');
                    elseif($member['member_verification'] == '2') 
                        echo yii::t('vcos', 'Frozen');
                    ?></td>
                <td>
                	<a href="#"><img src="<?=$baseUrl ?>images/write.png"></a>
                    <a href="#"><img src="<?=$baseUrl ?>images/delete.png"></a>
                </td>
            <?php endforeach ?>
            </tr>
            </tbody>
        </table>
        <p class="records"><?php echo yii::t('vcos', 'Records') ?>:<span><?php echo 1 ;?></span></p>
        <div class="btn">
            <input type="button" value="<?php echo yii::t('vcos', 'Add') ?>"></input>
        </div>
        <div class="pageNum">
			<span>
				<a href="#" class="active">1</a>
				<a href="#">2</a>
				<a href="#">></a>
				<a href="#">Last</a>
			</span>
        </div>
    </div>
</div>
<!-- content end -->
