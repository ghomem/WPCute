<?php

require_once("../secure.php");

?>

<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<title>Customer Area | My site</title>

	<!-- Include our stylesheet -->
	<link href="assets/css/styles.css" rel="stylesheet"/>
        <!-- to match the main website menu fonts -->
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,900' rel='stylesheet' type='text/css'>

</head>
<body>

	<div class="menu">
                        <a href="http://mysite.eu/website">HOME</a>
                        <a href="http://mysite.eu/website/about">ABOUT</a>
                        <a href="http://mysite.eu/website/portfolio">PORTFOLIO</a>
                        <a href="http://mysite.eu/website/contacts">CONTACTS</a>
                        <a href="http://mysite.eu/myfiles/customers">CUSTOMER AREA</a>
                        <a href="logout.php">LOGOUT</a>
	</div>


	<div class="filemanager">

		<div class="search">
			<input type="search" placeholder="Find a file.." />
		</div>

		<div class="breadcrumbs"></div>

		<ul class="data"></ul>

		<div class="nothingfound">
			<div class="nofiles"></div>
			<span>No files here.</span>
		</div>

	</div>


	<!-- Include our script files -->
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="assets/js/script.js"></script>

</body>
</html>
