<?php
require('render_msg.php');
	$server = "us-cdbr-iron-east-01.cleardb.net";
    $username = "b21e535520af4b";
    $password = "402bbf1f";
    $db = "heroku_821969a41e3a17e";
    $conn = new mysqli($server, $username, $password, $db);
function reply_msg($txtback,$replyToken)//สร้างข้อความและตอบกลับ
{
    $access_token = 'SgKsNCJ/CFULSBsNU2+N6Oam+5+Jzqhi6P1AHTUlEOw6L8VFkGeU1MwdogFs3s+6lV1gYE6OqsX+CIxwSbbuXZcRbym0o6GeudnHDFqQa1WLoHWx0Z+FDUEojVK8kJ/ZQZnDvXh7h5m1jnN31epjRQdB04t89/1O/w1cDnyilFU=';//เอามาจาก linedev ตรง channel access setting
    $messages = ['type' => 'text','text' => $txtback];//สร้างตัวแปร 
    $url = 'https://api.line.me/v2/bot/message/reply';
    $data = [
                'replyToken' => $replyToken,
                'messages' => [$messages],
            ];
    $post = json_encode($data);
    $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);
    curl_close($ch);
    echo $result . "\r\n";//บรรทัดที่ 4-21 มาจาก document line dev ในไลน์ด้วยภาษา php
}
function reply_flex_msg($keyword,$replyToken)
{
    $access_token = 'SgKsNCJ/CFULSBsNU2+N6Oam+5+Jzqhi6P1AHTUlEOw6L8VFkGeU1MwdogFs3s+6lV1gYE6OqsX+CIxwSbbuXZcRbym0o6GeudnHDFqQa1WLoHWx0Z+FDUEojVK8kJ/ZQZnDvXh7h5m1jnN31epjRQdB04t89/1O/w1cDnyilFU=';
    $keyword1 = $keyword;
	$messages = flex_msg($keyword1);
    // Make a POST Request to Messaging API to reply to sender
    $url = 'https://api.line.me/v2/bot/message/reply';
    $data = [
                'replyToken' => $replyToken,
                'messages' => [$messages],
            ];
    $post = json_encode($data);
    $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);
    curl_close($ch);
    echo $result . "\r\n";
}
	$content = file_get_contents('php://input');//ประกาศตัวแปรชื่อ content เพื่อรับข้อมูลจากข้อความที่พิมพ์ในไลน์มาเก็บที่ตัวแปร content
	$events = json_decode($content, true);//แปลง json เป็น php ข้อมูลที่ส่งมาจากไลน์มาเป็น json มาแปลงเป็น php แล้วเก็บข้อมูลในตัวแปร events
	if (!is_null($events['events'])) //check ค่าในตัวแปร $events ที่ส่งมาจากไลน์ ใส่เครื่อง ! แปลว่าตรงกันข้าม คือถ้าข้อความมาจากไลน์ ให้ทำงานตามบรรทัดด้านล่าง
	{
		foreach ($events['events'] as $event) 
		{
			if ($event['type'] == 'message' && $event['message']['type'] == 'text')// && คือ and กลุ่มหน้าเช็ค event type แล้วกลุ่มหลัง message type
			{
			$replyToken = $event['replyToken']; //ประกาศตัวแปร replyToken เก็บ reply token ที่ไลน์ event ส่งมาในทุกครั้งอะ เอาไว้ใสตัวแปรที่ประกาศ เพื่อเอาไว้ให้ตอบกลับ
            $txtin = $event['message']['text'];//เอาข้อความจากไลน์ที่ผ่านการตรวจสอบบรรทัดที่ 29 มาเก็บในตัวแปร $txtin
			if(strtolower($txtin) == "keyword")//strtolower หมายถึงตัวแปรที่เข้ามาแปลงเปนตัวเล็กหมด 
			{
				$sql_text = "SELECT DISTINCT keyword FROM librarypq";//select* หมายถึงเลือกทั้งตาราง 
				$query = mysqli_query($conn,$sql_text);// ให้หาข้อมูลที่เก็บไว้ในตัวแปร $con และ $sql_text
				while($obj = mysqli_fetch_array($query))//เป็นการคลี่ข้อมูลออกมาที่ละบรรทัดแล้วไปใส่ในตัวแปร obj
				{
					$allkeyword = $allkeyword."\n".$obj["keyword"];
				}
				reply_msg($allkeyword,$replyToken);
				break;
			}
			reply_flex_msg($txtin,$replyToken);
			
			}
		}
	}
	?>