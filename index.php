<?php
// org.gradle.jvmargs=-Xmx512m -XX:MaxPermSize=512m
$GLOBALS['simba_ip'] = "192.168.1.103";

if($_SERVER['HTTP_HOST'] == "localhost")
{
	header("Location: http://localhost/walartpharma/public/");
}
elseif($_SERVER['HTTP_HOST'] == $GLOBALS['simba_ip'])
{
	header("Location: ". $GLOBALS['simba_ip'] ."/walartpharma/public/");
}
else
{
	header("Location: http://www.walartpharma.com/walartpharma/public/");
}
?>