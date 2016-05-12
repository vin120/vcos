
<?php 

use yii\helpers\Html;
use yii\helpers\Url;

use travelagent\views\myasset\PublicAsset;
use travelagent\views\myasset\AgentinfoAsset;

PublicAsset::register($this);
AgentinfoAsset::register($this);
?>

<!-- main content start -->
<div id="personalCenter" class="mainContent">
    <div id="topNav">
        Agent Ticketing
        <span>>></span>
        <a href="#">Personal Center</a>
    </div>
    <div id="mainContent_content" class="pBox">
        <h2>Basic information</h2>
        <div class="pBox" id="info">
            <ul>
                <li>
                    <span>Account:</span>
                    <span><?php echo $data[0]['travel_agent_code']?></span>
                </li>
                <li>
                    <span>Agent Name:</span>
                    <span><?php echo $data[0]['travel_agent_name']?></span>
                </li>
                <li>
                    <span>Contacts:</span>
                    <span><?php echo $data[0]['travel_agent_contact_name']?></span>
                </li>
                <li>
                    <span>Telephone:</span>
                    <span><?php echo $data[0]['travel_agent_contact_phone']?></span>
                </li>
                <li>
                    <span>E-mail:</span>
                    <span><?php echo $data[0]['travel_agent_email']?></span>
                </li>
                <li>
                    <span>Address:</span>
                    <span><?php echo $data[0]['travel_agent_address']?></span>
                </li>
                <li>
                    <span>Account Balance:</span>
                    <span class="point">￥<?php echo $data[0]['current_amount']?></span>
                </li>
            </ul>
        </div>
        <div class="btnBox2">
            <input type="button" value="Change Login Password" class="btn2"></input>
            <input type="button" value="Change Payment Password" class="btn2" id="paymentpassword"></input>
        </div>
    </div>
    <div class="shadow"></div>
	<div class="popups" id="alertpaymentpassword">
		<h3>Add<a href="#" class="close r">&#10006;</a></h3>
		<div class="pBox">
			<input type="hidden" id="url" value="<?php echo Url::toRoute(['checkpassword']);?>"></input>
			<div>
				<label id="pay_password">
					<span>Old Password:</span>
					<span>
						<input type="password" name="pay_password" id="aa"></input>
						
					</span>
				</label>
			</div>
			<div>
				<label>
					<span>New Password:</span>
					<span>
						<input type="password" name="newpay_password"></input>
					</span>
				</label>
			</div>
			<div>
				<label>
					<span>RePassword:</span>
					<span>
						<input type="password" name="renewpay_password"></input>
					</span>
				</label>
			</div>
			<div class="btnBox2">
				<input type="button" value="SUBMIT" class="btn1"></input>
				<input type="button" value="CANCEL" class="btn2"></input>
			</div>
		</div>
	</div>
</div>

<!-- main content end -->
