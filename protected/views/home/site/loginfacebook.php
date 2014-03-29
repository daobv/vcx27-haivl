<?php
$baseUrl = Yii::app()->request->baseUrl;
$cs = Yii::app()->getClientScript();
?>
<div id="content-login" class="pull-left"> 
	<h3>Đăng nhập<h3>
	<p>Click vào nút dưới đây để đăng nhập với tài khoản Facebook của bạn. Tài khoản của bạn trên haivl sẽ tự động được tạo sau lần đăng nhập đầu tiên mà không cần đăng ký.</p>


    <a href="javascript:connectFacebook();">
		Login Facebook
	</a>
</div>

