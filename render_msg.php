<?php

function flex_msg($keyword)
{
	$server = "us-cdbr-iron-east-01.cleardb.net";
    $username = "b21e535520af4b";
    $password = "402bbf1f";
    $db = "heroku_821969a41e3a17e";
    $conn = new mysqli($server, $username, $password, $db);
	mysqli_query($conn, "SET NAMES utf8");
	$sql_key_search = "SELECT * FROM librarypq WHERE keyword LIKE '%".$keyword."%' OR type LIKE '%".$keyword."%'";
	$key_query = mysqli_query($conn,$sql_key_search);
    $numrows = mysqli_num_rows($key_query);
	$objsearch = mysqli_fetch_array($key_query);
	if($numrows > 1)
	{
		$url = "line://app/1613340720-yx1KWdPo?keyword=".$keyword;
		$txtresult = $numrows." items";
		$btn_txt = "Click";
	}
	else if($numrows == 1)
	{
		$url = "line://app/1613340720-yx1KWdPo?keyword=".$keyword;
		$txtresult = $numrows." item";
		$btn_txt = "รายละเอียดเพิ่มเติม";
	}
	else if ($numrows < 1)
	{
		$url = "https://nutt-i.com/psqv2";
		$txtresult = "0 item";
		$btn_txt = "Manual";
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
                "text": "'.$txtresult.'",
                "wrap": true,
                "color": "#666666",
                "size": "md",
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
          "label": "'.$btn_txt.'",
          "uri": "'.$url.'"
        }
      },
     
      {
        "type": "spacer",
        "size": "sm"
      }
    ],
    "flex": 0
  }
},
	"quickReply": {
             "items": [
                {
                 "type": "action",
                 "action": {
                    "type": "message",
                    "label": "Keyword",
                    "text": "Keyword"
                   }
                }  
               ]
            }
	}';
	$result = json_decode($json1);
	return $result;
}
?>