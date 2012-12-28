<?php include_once __DIR__.'/../layout/admin_header.php' ?>
<div class="hero-unit">
	<div class="row">

		<div class="span4 offset2">
			<form action="<?php echo base_url('admin/login') ?>" method="post">
				<legend id="yh_text">登录</legend>
				<input type="text" name="account" placeholder="用户名/邮箱">
				<input type="password" name="password" placeholder="密码">
				<p>
					<button type="submit" class="btn btn-primary" name="login" value="登录">登录</button>
				</p>
			</form>
		</div>

	</div>
</div>
<?php include_once __DIR__.'/../layout/admin_footer.php' ?>