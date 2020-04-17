<?php
    mb_internal_encoding("UTF-8");
    require_once('user_agent.php');
    require_once('mysql_connection.php');
    
    $ACCESS_TOKEN = "a709fda76803a306f64e6f09b1977f8f1006daf1fafd94132be0852fd582b7e4d042334a0f61894218e18";
    
    function site_url() {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $domainName = $_SERVER['HTTP_HOST'].'/';
        return $protocol.$domainName;
    }
    $SITE_URL = site_url();
    
    function chance($percent) {
        return (rand(0, 100) < $percent) ? true : false;
    }
?>
<html>
<head>
    <link rel="icon" href="neurovolk.small.png">
    <link rel="dns-prefetch" href="//cdn.jsdelivr.net">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/kneedeepincode/fsex-webfont@v1.0.1/fsex300.css">

    <link rel="stylesheet" type="text/css" href="/style.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <title>нейроволк</title>
</head>
<body>


<div class="icons icons--right">
<a class="icon-link" href="<?php echo  $SITE_URL; ?>"><img class="icon" src="/quote.svg"/></a>
<a class="icon-link" href="<?php echo  $SITE_URL . "img"; ?>"><img class="icon" src="/photo.svg"/></a>
<a class="icon-link" href="https://vk.com/neurovolk" target="blank"><img class="icon" src="vk.svg"/></a>
<a class="icon-link" href="<?php echo  $SITE_URL . "faq"; ?>" target="blank"><div class="icon">FAQ</div></a>
</div>

<?php

    $strict_volk = chance(10);

    $mysqli = new_connection();
    $all_count = -1;
    $res = $mysqli->query("select count(*) as fuck from citatas");
    while ($row = $res->fetch_assoc()) {
        $all_count =  intval($row['fuck']);
        
    }
    $mysqli -> close();
    
    $mysqli = new_connection();
        $all_volks = -1;
        $res = $mysqli->query("select count(*) as fuck from volks");
        while ($row = $res->fetch_assoc()) {
            $all_volks =  intval($row['fuck']);
            
        }
    $mysqli -> close();
    
    session_start();
    if (!isset($_SESSION['likes'])) {
      $_SESSION['likes'] = array();
    } 
    
    const MAT_REG = "/((х(у|\*)(й|я|ю|и))|(п(и|\*)зд(а|ы|у|ой|ец))|(про|за|^| |на|пере|от(ъ|.?))(еб(\*|а|л|и|у))|(^|\ )(бл(я|\*)(д|ть)))/im";
    
    const EMOJI_REG = "/😍|😔|❤|🙏|🔥|😊|😂|✌|👇|😌|😈|😉|🎧|🏻|🖤|💫|👌|☝|👍|✨|🌸|😏|😃|￼|😄|💪|🌚|😎|💕|😱|❄|💔|🌺|💋|😆|👏|🍃|📺|😜|🙌|😕|😘|🎄|💥|😢|😋|👊|🍂|☀|✋|😻|💞|😩|😇|✈|🥀|😒|🏼|🙈|😭|💭|💖|😳|👑|😐|😀|🚀|🕊|👼|🤘|💙|😑|👆|👪|😁|❗|🌲|🌹|✊|🌑|😹|🍁|☁|😴|🌿|🍫|😟|🌝|🙅|💰|🤣|😅|🎶|🎁|✔|💜|💎|😮|💐|😠|🔫|📱|🎅|🌴|🔝|🌊|🍓|🤗|📢|👈|💦|💣|😽|😚|👿|🐼|💝|🏡|🍷|💗|💑|🎈|😨|🔞|🙀|💃|🍑|⛄|🐈|🎀|😰|🔹|🌙|👀|🎤|🤤|🏊|😷|🍒|🌼|👰|🔱|✟|🍴|😓|🔪|🍰|⭐|💤|☆|🌷|🚶|😖|☘|💏|🏃|🎬|💓|►|👯|🖕|🆘|🌟|🌞|😝|☕|🍹|👉|😥|👋|🚘|♔|⚡|🔗|🙇|🏠|☜|☞|✝|👐|💴|💷|💳|📚|😫|🎂|🍉|😡|⛔|👩|👦|💻|✉|➕|➖|🐣|🎨|💌|🦁|🎳|🎙|🤢|🤷|♂|♻|😸|🐹|👸|🏆|⚽|👎|👵|🌌|👫|☻|🎥|🚗|💽|🏒|🥅|▷|▪|📞|👻|😯|🎚|🔰|🙃|⬛|💘|💶|🤔|🦋|🏾|🐉|😶|😧|🔊|🎉|😣|⤵|🏩|🐑|🎵|👽|🍼|👶|🤪|🍝|🍛|★|😛|🖇|😞ฺ|🌦|👠|✖|🖐|🌁|🦉|🎼|🤙|❣|🚫|🍏|🍐|☹/";
    
    const IMG_SEP = ',';
  
    function split_size($sep, $str) {
        $split_text = explode($sep, $str);
        $max_split_length = 0;
        foreach ($split_text as $sss) {
            $max_split_length = max($max_split_length, mb_strlen(trim($sss)));
        }
        return array(
            "length" => $max_split_length,
            "size" => $split_text
        );
    }  
    
    function conditions_text($str) {
        //$emoji_matches = preg_match_all(EMOJI_REG, $str);
        return
            mb_strlen($str) >= 5 /*&& mb_strlen($str) <= 140)*/ &&
            //preg_match("/\ волк.* /", $str)
            //preg_match(MAT_REG, $str) &&
            //$emoji_matches > 0 &&
            true
        ;
    }
    
    function conditions_image($str, $strict_volk = false) {
        $emoji_matches = preg_match_all(EMOJI_REG, $str);

        $split_size = split_size(IMG_SEP, $str);
        
        return
            mb_strlen($str) >= 5 &&
            $split_size["length"] <= 70 && 
            //!preg_match('/\d{1,}/', $str) &&
            sizeof($split_size["size"]) > 1 && sizeof($split_size["size"]) <= 3 &&
            //$emoji_matches <= 0 &&
            ($strict_volk == preg_match("/[вВ][оОoO][лЛ][кКkK]/i", $str)) &&
            true
        ;
        
    }   

    function fuckyou($reason = "Wrong index") {
        echo('<div class="text">' . $reason . '. Fuck you.</div>');
        die;
    }
    
    function console_log($text) {
        echo "<script>console.log(`" . $text . "`);</script>";
    }

    
    function select_citata($id) {
        $mysqli = new_connection();
        $query = "select text, rating from citatas where id = " . $id;
        $res = $mysqli->query($query);
        $mysqli -> close();
        while ($row = $res->fetch_assoc()) {
            $text = $row['text'];
            $rating = $row['rating'];
            return array(
                "text" => $text,
                "rating" => $rating,
                "id" => $id,
            );
        }
        return false;
    }
    
    function select_volk($all_volks) {
        $mysqli = new_connection();
        $query = "select id, text, rating from volks where volk_id = " . rand(1, $all_volks);
        $res = $mysqli->query($query);
        $mysqli -> close();
        while ($row = $res->fetch_assoc()) {
            $text = $row['text'];
            $rating = $row['rating'];
            $id = $row['id'];
            return array(
                "text" => $text,
                "rating" => $rating,
                "id" => $id,
            );
        }
        return false;
    }
    
    
    function select_random($all_count, $all_volks, $for_image = true, $strict_volk = false) {
        $citata = false;
        if ($for_image) {
            do {
                if (!$strict_volk)
                    $citata = select_citata(rand(1, $all_count));
                else
                    $citata = select_volk($all_volks);
            } while (!$citata || !conditions_image($citata['text'], $strict_volk));
        } else {
            do {
                if (!$strict_volk)
                    $citata = select_citata(rand(1, $all_count));
                else
                    $citata = select_volk($all_volks);
            } while (!$citata || !conditions_text($citata['text']));
        }
        return $citata;
    }

    function drawOneText($img, $txt, $v_position = 'top', $_font_size) {
        $font_size = $_font_size;
        $width = imagesx($img);
        $height = imagesy($img);
        $white = imagecolorallocate($img, 255, 255, 255);
        $black = imagecolorallocate($img, 0, 0, 0);
        $font = "./Soxra.ttf"; 
        $text_size = imagettfbbox($font_size, 0, $font, $txt);
        $text_width = abs(max([$text_size[2], $text_size[4]]) - min([$text_size[0], $text_size[6]]));
        $text_height = abs(max([$text_size[5], $text_size[7]]) - min([$text_size[1], $text_size[3]]));
        $x = rand(intval(0), intval($width - $text_width));
        switch($v_position) {
            case 'top':
                $y = rand(intval($text_height), max($text_height, intval(0.3 * $height - $text_height)));
                break;
            case 'middle':
                $y = rand(intval(0.3 * $height), intval(0.7 * $height - $text_height));
                break;
            case 'bottom':
                $y = rand(intval(0.7 * $height), intval($height - $text_height - 10));
                break;
            case 'watermark':
                $x = $width - $text_width - 5;
                $y = intval($height - 5);
                break;
            default:
                $y = 0;
                break;
        }
        imagefilledrectangle($img, $x + $text_size[0], $y + $text_size[1], $x + $text_size[4], $y + $text_size[5], $black);
        imagettftext($img, $font_size, 0, $x, $y, $white, $font, $txt);
    }
    
    function randcase($str, $case = -1) {
        if ($case == -1)
            $case = rand(0,1);
        if ($case == 0)
            return mb_strtolower($str);
        return mb_strtoupper($str);
    }

    function drawTexts($img, $id, $texts, $font_size) {
        $case = rand(0,1);
        
        if (sizeof($texts) > 0) {
            drawOneText($img, randcase(trim($texts[0]), $case), 'top', $font_size);
        }
        
        if (sizeof($texts) > 1) {
            drawOneText($img, randcase(trim($texts[sizeof($texts)-1]), $case), 'bottom', $font_size);
            
        }
        
        if (sizeof($texts) > 2) {
            drawOneText($img, randcase(trim($texts[1]), $case), 'middle', $font_size);
        }
        
        drawOneText($img, "vk.com/neurovolk", 'watermark', 10);
    
        ob_start();
            $browser = parse_user_agent()['browser'];
            if ($browser == "MSIE" || $browser == "Safari") {
                $generated_path = 'temp/generated_' . $id . '.jpg';
                imagejpeg($img, $generated_path, img_params()['quality']);
            } else {
                $generated_path = 'temp/generated_' . $id . '.jpg';
                //imagewebp($img, $generated_path, 5);
                imagejpeg($img, $generated_path, img_params()['quality']);
            }
            
        ob_end_clean();
        
        //$dataUri = "data:image/jpeg;base64," . base64_encode($contents);
          echo '<img class="generated" src="/' . $generated_path . '"/><br/>';
          //imagedestroy($jpg_image);
        return $generated_path;
    }
    
    function random_pic($dir = 'uploads')
    {
        $files = glob($dir . '/*.*');
        $file = array_rand($files);
        return $files[$file];
    }
    

    if (!(isset($_GET['img']))) {
        $_GET['img'] = '0';
    } 
    
    function img_params() {
        $p = array(
            'width' => 900,
            'quality' => 10,
        );
        if (isset($_GET['to_fucking_vk'])) {
            if ($_GET['to_fucking_vk'] == 1) {
                $p['width'] = 800;
                $p['quality'] = 50;
            }
        }
        return $p;
    }
    
    if ($all_count > 0) {
        
        if ($_GET['img'] == '1') {
            if (!isset($_GET['index'])) {
                $citata = select_random($all_count, $all_volks, true, $strict_volk);
            } else {
                try {
                    $id = intval($_GET['index']);
                    $citata = select_citata($id);
                    if (!$citata) {
                        fuckyou();
                    }
                    $strict_volk = preg_match("/\ в[о|o]лк.* /i", $citata["text"]);
                
                } catch(Exception $e) {
                    fuckyou();
                }
                
            }
            
    
            if (!conditions_image($citata["text"], $strict_volk) && !isset($_GET["force_image"])) {
                echo '<div class="text">image generation is not supported for this phrase</div>';
            } else {
                $texts = explode(IMG_SEP, $citata["text"]);
                if ($strict_volk) {
                    $category = "volk";
                } else {
                    $category = "bratva";
                }
                $img_path = random_pic('images/' . $category);
                $src_img = imagecreatefromjpeg($img_path);
                
                // THE IMAGE SIZE
                $width = imagesx($src_img);
                $height = imagesy($src_img);
                
                $newwidth = img_params()['width'];
                $newheight = $newwidth / $width * $height;
                $img = imagecreatetruecolor($newwidth, $newheight);
                
                imagecopyresampled($img, $src_img, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                
                $calculated_font_size = intval($newwidth / split_size(IMG_SEP, $citata["text"])["length"] * 0.6);
                $img_url = drawTexts($img, $citata["id"], $texts, $calculated_font_size);
                
                if (isset($_GET['to_fucking_vk'])) {
                    if ($_GET['to_fucking_vk'] == 1) {
                        $group_id = 189548430;
                        $access_token = $ACCESS_TOKEN;
                        
                        $params = array(
                        	'v'            => '5.00',
                        	'access_token' => $access_token,
                        	'group_id'     => $group_id, 
                        	'upload_url'     => $img_url, 
                        );
                        
                        //var_dump($params);
                        
                        $upload_url = json_decode(file_get_contents('https://api.vk.com/method/photos.getWallUploadServer?' . http_build_query($params)))->response->upload_url;
                        //echo $upload_url;
                        
                        $file_new = new CURLFile($img_url);
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_HEADER, 0);
                        curl_setopt($ch, CURLOPT_URL, $upload_url);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                        // curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, array(
                        'file1' => $file_new
                        ));
                        $result = json_decode(curl_exec($ch),true);
                        //echo '<b>' . json_encode($result) . "</b>";
                        curl_close($ch);
                        
                        $params = array(
                        	'v'            => '5.00',
                        	'group_id' => $group_id,
                        	'server' => $result['server'],
                        	'hash' => $result['hash'],
                        	'photo' => urldecode($result['photo']),
                        	'access_token' => $access_token,
                        );
                         
                         
                         
                         
                        $response = json_decode(file_get_contents('https://api.vk.com/method/photos.saveWallPhoto?' . http_build_query($params)), true);
                        //echo json_encode($response);
                        if (!empty($response['response'][0]['id'])) {
                            $img_id = $response['response'][0]['id'];
                            $params = array(
                            	'v'            => '5.00',
                            	'access_token' => $access_token,
                            	'owner_id'     => -$group_id , 
                            	'from_group'   => '1', 
                            	'message'      => /*$SITE_URL*/ "#" . $citata['id'] . " #нейроволк",
                            	'attachments'  => 'photo' . $response['response'][0]['owner_id'] . '_' . $img_id
                            );
                            
                            //var_dump($params);
                        
                            $response = json_decode(file_get_contents('https://api.vk.com/method/wall.post?' . http_build_query($params)), true);
                            
                        }
                        
                        console_log(json_encode($response));
                        
                    }
                }
            } 
     
        } else {
            
            if (!isset($_GET['index'])) {
                $citata = select_random($all_count, $all_volks, false, $strict_volk);
            } else {
                $id = $_GET['index'];
                try {
                    $id = $id * 1;
                    $citata = select_citata($id);
                    if (!$citata) {
                        fuckyou();
                    }
                } catch(Exception $e) {
                    fuckyou("???");
                }
                
            }
            
            $displayed_text = '<div class="text">' . $citata["text"] . "</div>";
            echo $displayed_text;
            
            if (isset($_GET['to_fucking_vk'])) {
                if ($_GET['to_fucking_vk'] == 1) {
                    $message = $citata["text"];
                    $group_id = 189548430;
                    $access_token = $ACCESS_TOKEN;
                    $params = array(
                    	'v'            => '5.00',
                    	'access_token' => $access_token,
                    	'owner_id'     => '-' . $group_id, 
                    	'from_group'   => '1', 
                    	'message' =>  "#" . $citata['id'] . " #нейроволк \n" . $message,
                    	//'attachments'  => $link
                    );
                     
                    $response = file_get_contents('https://api.vk.com/method/wall.post?' . http_build_query($params));
                    console_log(json_encode($response));
                }
            }
        }
    } else {
        fuckyou("Empty database");
    }

    
//////////// 

    $mysqli = new_connection();
    $ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
    $mysqli -> query("insert into requests(time, ip, citata_id, is_img) values(CURRENT_TIMESTAMP, INET_ATON('" . $ip . "'), " . $citata["id"] . ", " . $_GET["img"] . ");");
    $mysqli -> close();

    $if_img = ($_GET['img'] == 1) ? 'img' : '';
    echo ('<a class="index" href="/' . $if_img . $citata["id"] . '">#' . $citata["id"] . '</a>');

?>


<div class="icons icons--left">
<img class="icon" src="like.svg" id="like">
<div id="rating"><?php if ($citata["rating"] > 0) echo "+"; echo $citata["rating"]; ?></div>
<img class="icon" src="like.svg" id="dislike" style="transform:rotate(180deg);">
</div>

<?php if (!isset($_SESSION["likes"][$citata["id"]])) { ?>
<style> #like, #dislike { cursor: pointer; } </style>
<script>
    function removeButton($elem) {
        $elem.animate({width: 0}, 75, function() {
            $elem.animate({height: 0}, 75, function() {
                $elem.animate({padding: 0}, 75, function() {
                    $elem.delay(75).css("border", "0px solid white").remove();
                });
            });
        });
    }

    function sendRequest(like, citataID, $elem) {
        $.ajax({
            "url": "like.php",
            "method": "POST",
            "data": { "like": like, "citata_id": citataID }
        }).done(function(response) {
            let r = JSON.parse(response);
            if (r.success === true) {
                $("#rating").html(r.rating);
                if (like == "like") {
                    $("#like").css("cursor", "auto").css("background", "green");
                    removeButton($("#dislike"));
                } else if (like == "dislike") {
                    $("#dislike").css("cursor", "auto").css("background", "red");
                    removeButton($("#like"));
                }
            } else {
                console.log("fuck your vote, bitch");
            }
        });
    }

    $(document).ready(function(){
        $("#like").on("click", function() {
            sendRequest("like", <?php echo $citata["id"]; ?>, $(this));
        });
        $("#dislike").on("click", function() {
            sendRequest("dislike", <?php echo $citata["id"]; ?>, $(this));
        });
    })
</script>

<?php } else {
    $like = $_SESSION["likes"][$citata["id"]];
    if ($like == "like") {
?>      <style>#dislike { display: none; } #like { background: green; }</style> <?php
    } else if ($like == "dislike") {
?>      <style>#like { display: none; } #dislike { background: red; }</style> <?php        
    }
} ?>

</body>
</html>