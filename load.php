<?php 
include("../core/DB_Sql.php");


$db = new DB_Sql("SELECT * FROM site WHERE id='".(int)$_GET['file']."'");
$db->next_record();
header("Refresh: 3; URL=http://".$db->f("www"));
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
<title>Loading</title>
<style type="text/css">
body { background: url(load.gif); }
</style>

</head>
<body>

</body>
</html>
