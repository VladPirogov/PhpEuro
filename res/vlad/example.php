<?php
error_reporting(E_ALL ^ E_NOTICE);
?>
<html>
<head>

</head>

<body>
	<form action="upload.php" method="POST" enctype="multipart/form-data">
		<input type="file" name="file">
		<button type="submit" name="submit">UPLOAD</button>

	</form>
</body>
</html>
