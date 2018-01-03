<center>
<?php
	include 'config.php';
	$kickid = htmlspecialchars($_POST['kickid']);
	$reason = htmlspecialchars($_POST['reason']);
	
	$reason = "{$bot_prefix}%20{$reason}";
	$reason = str_replace(" ", "%20", $reason);
	
	if($reason_message == true){
		file_get_contents("https://api.vk.com/method/messages.send?access_token={$access_token}&chat_id={$chat_id}&message={$reason}", true);
	}

	$kick = file_get_contents("https://api.vk.com/method/messages.removeChatUser?access_token={$access_token}&chat_id={$chat_id}&user_id={$kickid}", true);
	$kick = json_decode($kick);
	$err = $kick->error->error_code;
	
	if($err == null){
		header("Location: {$redirect_uri}");
	}else{
		echo "<b>!</b> Произошла ошибка при исключении человека (людей) из беседы {$chat_name}. Пожалуйста, повторите заного.<b>!</b><br><b>Инфо об ошибке</b>:<br>Код ошибки - <i>{$kick->error->error_code}</i><br>Сообщение ошибки - <i>{$kick->error->error_msg}</i>" ;
		echo $back = '<p><a href="index.php">Вернуться обратно</a></p>';
	}
?>
