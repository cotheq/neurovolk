<?php
    sleep(1);
    mb_internal_encoding("UTF-8");
    require_once('user_agent.php');
?>
<html>
<head>
    <link rel="icon" href="neurovolk.small.png">
    <link rel="dns-prefetch" href="//cdn.jsdelivr.net">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/kneedeepincode/fsex-webfont@v1.0.1/fsex300.css">
    <link rel="stylesheet" type="text/css" href="/style.min.css">
    <title>нейроволк</title>
</head>
<body>


<div class="icons icons--left">
<a href="<?php echo  explode('?', $_SERVER['REQUEST_URI'], 2)[0]; ?>"><img class="icon" src="/quote.svg"/></a>
<a href="?img=1"><img class="icon" src="/photo.svg"/></a>
<a href="https://vk.com/neurovolk" target="blank"><img class="icon" src="vk.svg"/></a>
</div>
    
<?php
    function new_connection() {
        $mysqli = new mysqli("localhost", "u500888395_fuckingbitch", "shittyfuck", "u500888395_neurovolk");
    
        if ($mysqli->connect_errno) {
            echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
            die;
        }
        
        return $mysqli;
    }
    
    $mysqli = new_connection();
    $all_count = -1;
    $res = $mysqli->query("select count(*) as fuck from citatas");
    while ($row = $res->fetch_assoc()) {
        $all_count =  intval($row['fuck']);
        
    }
    $mysqli -> close();
    
    
    
    const MAT_REG = "/((х(у|\*)(й|я|ю|и))|(п(и|\*)зд(а|ы|у|ой|ец))|(про|за|^| |на|пере|от(ъ|.?))(еб(\*|а|л|и|у))|(^|\ )(бл(я|\*)(д|ть)))/im";
    
    const EMOJI_REG = "/😍|😔|❤|🙏|🔥|😊|😂|✌|👇|😌|😈|😉|🎧|🏻|🖤|💫|👌|☝|👍|✨|🌸|😏|😃|￼|😄|💪|🌚|😎|💕|😱|❄|💔|🌺|💋|😆|👏|🍃|📺|😜|🙌|😕|😘|🎄|💥|😢|😋|👊|🍂|☀|✋|😻|💞|😩|😇|✈|🥀|😒|🏼|🙈|😭|💭|💖|😳|👑|😐|😀|🚀|🕊|👼|🤘|💙|😑|👆|👪|😁|❗|🌲|🌹|✊|🌑|😹|🍁|☁|😴|🌿|🍫|😟|🌝|🙅|💰|🤣|😅|🎶|🎁|✔|💜|💎|😮|💐|😠|🔫|📱|🎅|🌴|🔝|🌊|🍓|🤗|📢|👈|💦|💣|😽|😚|👿|🐼|💝|🏡|🍷|💗|💑|🎈|😨|🔞|🙀|💃|🍑|⛄|🐈|🎀|😰|🔹|🌙|👀|🎤|🤤|🏊|😷|🍒|🌼|👰|🔱|✟|🍴|😓|🔪|🍰|⭐|💤|☆|🌷|🚶|😖|☘|💏|🏃|🎬|💓|►|👯|🖕|🆘|🌟|🌞|😝|☕|🍹|👉|😥|👋|🚘|♔|⚡|🔗|🙇|🏠|☜|☞|✝|👐|💴|💷|💳|📚|😫|🎂|🍉|😡|⛔|👩|👦|💻|✉|➕|➖|🐣|🎨|💌|🦁|🎳|🎙|🤢|🤷|♂|♻|😸|🐹|👸|🏆|⚽|👎|👵|🌌|👫|☻|🎥|🚗|💽|🏒|🥅|▷|▪|📞|👻|😯|🎚|🔰|🙃|⬛|💘|💶|🤔|🦋|🏾|🐉|😶|😧|🔊|🎉|😣|⤵|🏩|🐑|🎵|👽|🍼|👶|🤪|🍝|🍛|★|😛|🖇|😞ฺ|🌦|👠|✖|🖐|🌁|🦉|🎼|🤙|❣|🚫|🍏|🍐|☹/";
    
    const IMG_SEP = ',';
    
    
    function conditions_text($str) {
        /*$emoji_matches = preg_match_all(EMOJI_REG, $str);
        return
            (mb_strlen($str) >= 71 && mb_strlen($str) <= 140) &&
            //preg_match("/\ волк.* /", $str)
            //preg_match(MAT_REG, $str) &&
            //$emoji_matches > 0 &&
            true
            // || true
        ;*/
        return true;
    }
    
    function conditions_image($str, $strict_volk = false) {
        
        $emoji_matches = preg_match_all(EMOJI_REG, $str);
        
        /*
        $split_text = explode(IMG_SEP, $str);
        $max_split_length = 0;
        foreach ($split_text as $sss) {
            $max_split_length = max($max_split_length, mb_strlen(trim($sss)));
        }*/

        return
            /*(mb_strlen($str) >= 5 && mb_strlen($str) <= 90) &&
            $max_split_length <= 38 &&
            !preg_match('/\d{1,}/', $str) &&
            sizeof($split_text) > 1 && sizeof($split_text) <= 3 &&*/
            $emoji_matches <= 0 &&
            (!$strict_volk xor preg_match("/\ в[о|o]лк.* /i", $str)) &&
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
        $query = "select text from citatas where id = " . $id;
        $res = $mysqli->query($query);
        $mysqli -> close();
        while ($row = $res->fetch_assoc()) {
            $text = $row['text'];
            return array(
                "text" => $text,
                "id" => $id,
            );
        }
        return false;
    }
    
    function select_random($all_count, $for_image = true, $strict_volk = false) {
        $citata = false;
        if ($for_image) {
            do {
                
                $citata = select_citata(rand(1, $all_count));
            } while (!$citata || !conditions_image($citata['text'], $strict_volk));
        } else {
            do {
                $citata = select_citata(rand(1, $all_count));
            } while (!$citata || !conditions_text($citata['text']));
        }
        return $citata;
    }

    function drawOneText($img, $txt, $v_position = 'top', $font_size, $index=-1) {
        $width = imagesx($img);
        $height = imagesy($img);
        $white = imagecolorallocate($img, 255, 255, 255);
        $black = imagecolorallocate($img, 0, 0, 0);
        $font = "./FSEX300.ttf"; 
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

    function drawTexts($img, $id, $texts, $font_size, $index=-1) {
        $case = rand(0,1);
        
        if (sizeof($texts) > 0) {
            drawOneText($img, randcase(trim($texts[0]), $case), 'top', $font_size, $index);
        }
        
        if (sizeof($texts) > 1) {
            drawOneText($img, randcase(trim($texts[sizeof($texts)-1]), $case), 'bottom', $font_size, $index);
            
        }
        
        if (sizeof($texts) > 2) {
            drawOneText($img, randcase(trim($texts[1]), $case), 'middle', $font_size, $index);
        }
        
        drawOneText($img, "vk.com/neurovolk", 'watermark', $font_size * 0.8);
    
        ob_start();
            $browser = parse_user_agent()['browser'];
            if ($browser == "MSIE" || $browser == "Safari") {
                $generated_path = 'temp/generated_' . $id . '.jpg';
                imagejpeg($img, $generated_path, 20);
            } else {
                $generated_path = 'temp/generated_' . $id . '.jpg';
                //imagewebp($img, $generated_path, 5);
                imagejpeg($img, $generated_path, 20);
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
    
    if ($all_count > 0) {
        
        if ($_GET['img'] == '1') {
            if (!isset($_GET['index'])) {
                $strict_volk = (rand(0, 100) < 10) ? true : false;
                $citata = select_random($all_count, true, $strict_volk);
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
            
    
            if (!conditions_image($citata["text"], $strict_volk)) {
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
                
                $newwidth = 600;
                $newheight = $newwidth / $width * $height;
                $img = imagecreatetruecolor($newwidth, $newheight);
                
                imagecopyresampled($img, $src_img, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                
              
                $img_url = drawTexts($img, $citata["id"], $texts, intval($newwidth / 30), $index);
                
                if (isset($_GET['to_fucking_vk'])) {
                    if ($_GET['to_fucking_vk'] == 1) {
                        $group_id = 189548430;
                        $access_token = "9eaf8d8ad49c3e515feda65e391ac7972119e403f693b0a3791af92e4227dc24da5678b195aed035946b2";
                        
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
                        	//'attachments'  => $link
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
                            	'message' => "",
                            	'attachments'  => 'photo' . $response['response'][0]['owner_id'] . '_' . $img_id
                            );
                            
                            //var_dump($params);
                        
                            $response = json_decode(file_get_contents('https://api.vk.com/method/wall.post?' . http_build_query($params)), true);
                            
                        }
                        
                        echo json_encode($response);
                        
                    }
                }
            } 
     
        } else {
            
            if (!isset($_GET['index'])) {
                $citata = select_random($all_count);
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
                    $access_token = "9eaf8d8ad49c3e515feda65e391ac7972119e403f693b0a3791af92e4227dc24da5678b195aed035946b2";
                    $params = array(
                    	'v'            => '5.00',
                    	'access_token' => $access_token,
                    	'owner_id'     => '-' . $group_id, 
                    	'from_group'   => '1', 
                    	'message'      => $message,
                    	//'attachments'  => $link
                    );
                     
                    $response = file_get_contents('https://api.vk.com/method/wall.post?' . http_build_query($params));
                    echo($response);
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


    



    $if_img = ($_GET['img'] == 1) ? ('&img=' . $_GET['img']) : '';
    echo ('<a class="index" href="?index=' . $citata["id"] . $if_img . '">#' . $citata["id"] . '</a>');

?>
</body>
</html>