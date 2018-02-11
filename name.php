<center>
<?php
	include 'config.php';
    $getname = file_get_contents("https://api.vk.com/method/messages.getChat?access_token={$access_token}&chat_id={$chat_id}", true);
	$getname = json_decode($getname);
	$name = $getname->response->title;
	
	if($name == $chat_name){
		echo "ОК, Имя беседы менять не нужно!";
		echo $back = '<p><a href="index.php">Вернуться обратно</a></p>';
	}else{
		$chat_name= str_replace(' ', '%20', $chat_name);
		$editname = file_get_contents("https://api.vk.com/method/messages.editChat?access_token={$access_token}&chat_id={$chat_id}&title={$chat_name}", true);
		$editname = json_decode($editname);
		$name2    = $editname->response;
	    echo "<h1>Всё ОК, Имя беседы сменено! Ответ: {$name2}</h1>";
		echo $back;
	}
?>