<?php
require('adodb.inc.php');
#Define Valiable for DB Connection
define("DB_HOST","localhost");
define("DB_USER","catadmin");
define("DB_PASS","p@ssw0rd");
define("DB","documents");

# Create DB Connecttion
//$dns = PConnect(false, DB_USER, DB_PASS, DB_HOST);

$dsn = "mysqli://".DB_USER.":".DB_PASS."@".DB_HOST."/".DB;   
$db = NewADOConnection($dsn);
$db->SetFetchMode(ADODB_FETCH_ASSOC);

# Sst Charaterset to Encode DB
$db->Execute("SET NAMES UTF8");
$db->Execute("SET character_set_results=utf8");
$db->Execute("SET character_set_client=utf8");
$db->Execute("SET character_set_connection=utf8");

# Set Debug Mode for Develope / In case on Site  set to false
$db->debug = 0; # Change to false for Production


?>