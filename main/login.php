<?php
ini_set('session.use_only_cookies', 1); 
session_start();
$msg = '';
$username = '';

require_once '../config/config.php';

if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
{
	
	require_once '../utils/connect_db.php';

	// print_r($config);
	// exit();

	$db = connect($config['db']['auth']);
	
	$sql = sprintf('SELECT `username`,`password` FROM `user` WHERE username="%s"', $_POST['username']);
	
	$result = $db->query($sql);
	
	while ( $res = $result->fetchArray() )
	{
		$username = $res['username'];
		$password = $res['password'];
	}

	if ( ! $username )
	{
		$msg = '无此用户!';
	} else if ( $password != $_POST['password'] ) {
		$msg = '密码错误!';
	} else {
		$msg = '登录成功!';
		$_SESSION['username'] = $username;

		if ( isset($_POST['remember-me']) ) {
			if ( $_POST['remember-me'] == "on" )
			{
				// 添加path='/'使其可以跨目录访问
				setcookie('username', $username, time()+3600, '/');
			}
		}
		// print_r($_SESSION);
		printf('<script>window.location.href="index.php";</script>');
	}
	
	$db->close();
}
?>

<!DOCTYPE html>
<title>Login | <?php echo $config['web']['name']; ?></title>

<meta http-equiv="x-ua-compatible" content="IE=11" />

<link rel="icon" href="../static/images/logo.png">

<link href="../static/css/bootstrap.min.css" rel="stylesheet">
<link href="../static/css/signin.css" rel="stylesheet">
<style>
	#term {
		float: right;
	}
</style>


<div class="signin">
	<div class="signin-head"><img src="../static/images/head_120.png" alt="" class="img-circle"></div>
	<form class="form-signin" role="form" action="" method="post">
		<input name="username" type="text" class="form-control" placeholder="用户名" required 
			<?php if($msg=='无此用户!') {echo "autofocus value=".$_POST['username'];} 
				else if($msg=='密码错误!') {echo "value=".$_POST['username'];}?>	/>
		<input name="password" type="password" class="form-control" placeholder="密码" required 
			<?php if($msg=='密码错误!') {echo "autofocus";}?>	/>
		<button class="btn btn-lg btn-warning btn-block" type="submit">登录</button>
		<div style="margin-top: 10px;">
			<input name="remember-me" type="checkbox"> 记住我
			<!-- <div class="text-right">没有账户？ <a class="">立即注册</a></div> -->
			<a id="term"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"> 请先阅读使用说明</a>
		</div>
	</form>
	<div id="msg" class="text-center" >
	<?php
		if( $msg )
		{
			echo $msg;
		} else if(isset($_COOKIE['username'])) {
			printf('Hi, %s, welcome back!', $_COOKIE['username']);
		}?>
	</div>
</div>

<div id="term_modal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title text-center">声明</h4>
		</div>
		<div class="modal-body">
			<p>本网站为NovoZhonghua数据库的在线查询系统，可以批量查询位置、变异、基因、RS号等。</p>
			<p>网站需登录后方可查询，如需使用，请联系<a href="mailto:disease@novogene.com"> humaninfo@novogene.com </a>进行申请。</p>
		</div>
    </div>
  </div>
</div>

<script src="../static/js/jquery.min.js"></script>
<script src="../static/js/bootstrap.min.js"></script>
<script>
	$(document).ready(function () {
		$('#term').click(function () {
			$('#term_modal').modal();
		});
	});
</script>
