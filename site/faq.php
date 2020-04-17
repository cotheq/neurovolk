<?php
    mb_internal_encoding("UTF-8");
    require_once('user_agent.php');
    require_once('mysql_connection.php');
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

<body class="faq">
<div class="icons icons--right">
<a class="icon-link" href="/"><img class="icon" src="/quote.svg"></a>
<a class="icon-link" href="/img"><img class="icon" src="/photo.svg"></a>
<a class="icon-link" href="https://vk.com/neurovolk" target="blank"><img class="icon" src="vk.svg"></a>
</div>

<div class="text">FAQ</div>
<div class="faq-content">
<?php
    echo file_get_contents("faq.fuck");
?>
</div>


</body>

</html>