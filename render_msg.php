<?php

function flex_msg($keyword)
{
	$server = "us-cdbr-iron-east-01.cleardb.net";
    $username = "b21e535520af4b";
    $password = "402bbf1f";
    $db = "heroku_821969a41e3a17e";
    $conn = new mysqli($server, $username, $password, $db);
	$sql_key_search = "SELECT * FROM librarypq WHERE keyword LIKE '%".$keyword."%' OR type LIKE '%".$keyword."%'";
	$key_query = mysqli_query($conn,$sql_key_search);
    $numrows = mysqli_num_rows($key_query);
	$objsearch = mysqli_fetch_array($key_query);
	if($numrows > 1)
	{
		$url = "line://app/1613340720-yx1KWdPo?keyword=".$keyword;
		$txtresult = $numrows." items";
		$btn_txt = "รายละเอียดเพิ่มเติม";
	}
	else if($numrows == 1)
	{
		$url = "line://app/1613340720-yx1KWdPo?keyword=".$keyword;
		$txtresult = "จำนวน ".$numrows." รายการ";
		$btn_txt = "รายละเอียดเพิ่มเติม";
	}
	else if ($numrows < 1)
	{
		$url = "https://nutt-i.com/psqv2";
		$txtresult = "ไม่พบข้อมูล";
		$btn_txt = "ติดต่อผู้ดูแล";
	}
	$json1 = '{
				"type":"flex",
				"altText":"PQ PEAS1",
				"contents":{
  "type": "bubble",
  "hero": {
    "type": "image",
    "url": "https://pqlibrary.herokuapp.com/IMG1360550178.png",
    "size": "full",
    "aspectRatio": "16:9",
    "aspectMode": "fit",
    "action": {
      "type": "uri",
      "uri": "http://linecorp.com/"
    }
  },
  "body": {
    "type": "box",
    "layout": "vertical",
    "contents": [
      {
        "type": "text",
        "text": "All Results",
        "weight": "bold",
        "size": "xl"
      },
      {
        "type": "box",
        "layout": "vertical",
        "margin": "lg",
        "spacing": "sm",
        "contents": [
          {
            "type": "box",
            "layout": "baseline",
            "spacing": "sm",
            "contents": [
              {
                "type": "text",
                "text": "Miraina Tower, 4-1-6 Shinjuku, Tokyo",
                "wrap": true,
                "color": "#666666",
                "size": "sm",
                "flex": 5
              }
            ]
          }
        ]
      }
    ]
  },
  "footer": {
    "type": "box",
    "layout": "vertical",
    "spacing": "sm",
    "contents": [
      {
        "type": "button",
        "style": "primary",
        "height": "sm",
        "action": {
          "type": "uri",
          "label": "Click",
          "uri": "https://linecorp.com"
        }
      },
     
      {
        "type": "spacer",
        "size": "sm"
      }
    ],
    "flex": 0
  }
}
	}';
	$result = json_decode($json1);
	return $result;
}
?>