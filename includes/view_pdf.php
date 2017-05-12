<html>
<head>
<script type="text/javascript">
function openPdf()
{
var omyFrame = document.getElementById("myFrame");
omyFrame.style.display="block";
omyFrame.src = "../policy_docs/" + "<?php echo $_REQUEST['document'];  ?>";
}
</script>
</head>

<body onload="openPdf();">
    <div align="center">
	    <iframe id="myFrame" style="display:none" width="900" height="1000"></iframe>
    </div>
</body>

</html>


<!--<input type="button" value="Open PDF" onclick = "openPdf()"/>-->


