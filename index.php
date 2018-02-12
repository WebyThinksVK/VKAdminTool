<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>VKAdminTool 1.2 by isaacrulz23</title>
	<meta charset="utf-8">
</head>
<body>
<center>
    <?php
	include 'config.php';

    $url = 'http://oauth.vk.com/authorize';
    $params = array(
        'client_id'     => $client_id,
        'redirect_uri'  => $redirect_uri,
        'response_type' => 'code'
    );

	echo "<h1>Это VKAdminTool настроенный для беседы {$chat_name}</h1>";
    echo $link = '<p><a style="position:absolute; top:97%; left:0%" href="' . $url . '?' . urldecode(http_build_query($params)) . '"><h2>Войти через ВК</h2> </a></p>';

if (isset($_GET['code'])) {
    $result = false;
    $params = array(
        'client_id'     => $client_id,
        'client_secret' => $client_secret,
        'code'  		=> $_GET['code'],
        'redirect_uri'  => $redirect_uri
    );

    $token = json_decode(file_get_contents('https://oauth.vk.com/access_token' . '?' . urldecode(http_build_query($params))), true);

    if (isset($token['access_token'])) {
        $params = array(
            'uids'         => $token['user_id'],
            'fields'       => 'uid,',
            'access_token' => $token['access_token']
        );

        $userInfo = json_decode(file_get_contents('https://api.vk.com/method/users.get' . '?' . urldecode(http_build_query($params))), true);
        if (isset($userInfo['response'][0]['uid'])) {
            $userInfo = $userInfo['response'][0];
            $result = true;
        }
    }

		if ($result && $userInfo['uid'] == in_array($userInfo['uid'], $moder_id)) {
		
		echo $edit123 = '<form action="name.php"><button type="submit" class="butt">Сменить название</button></form>';		
		echo "<form action='remove.php' method='post'><p><h2>ID человека (людей):</h2> <input type='text' name='kickid' />" ;
		if ($reason_message == true){
		echo "</p><p><h2>Причина:</h2> <input type='text' name='reason' /></p>" ;
		}
		echo "<p><input type='submit' class='butt' value='Кикнуть' /></p></form>";
		}else{
			echo "<h3>Доступ запрещён! Вас нету в списке модераторов беседы {$chat_name}!</h3>";
		}
}
?>

</body>
</html>
