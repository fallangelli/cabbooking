<?php
$link = mysqli_connect("127.0.0.1", "root", "root");
if (!$link) echo "FAILD!连接错误，用户名密码不对";
else echo "OK!可以连接";
?>