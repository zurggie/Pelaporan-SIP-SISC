<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">

 <title>Keramatifar Treeview Right-To-Left Sample</title>
 <link rel="stylesheet" type="text/css" href="rtl.css">
 <script type="text/javascript" src="jquery.js"></script>
 <script type="text/javascript" src="funcs.js"></script>
</head>
<body>

<?php

//include the treeview class
include 'class.treeview_new.php';
//create an instant of Treeview Class
$treeSample = new Treeview('localhost','root','root','dbsip');
//Calling the method to generate tree view and set the queryArray public member for Input Parameter
$treeSample->CreateTreeview('rtl','id','title', 'parent_id', 'perfixForJqueryIDs');
//echo the public member of object names treeResult (Contain the treeview html and jquery codes)
echo $treeSample->treeResult;

?>



</body>
</html>