<html>
<head>
<title>Log in | Punctuality Tracker System</title>
</head>
<body>
<h1>Punctuality Tracker System</h1>
<h2>Log in</h2>
<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
<table>
<tr>
	<td><label for="username">Username: </label></td>
	<td><input id="username" name="username" value="" placeholder="Username"></td>
</tr>
<tr>
	<td><label for="password">Password: </label></td>
	<td><input id="password" name="password" type="password" value="" placeholder="Password"></td>
</tr>
<tr>
	<td colspan="2"><input type="submit" name="submit" value="Submit"></td>
</tr>
</table>
</form>
</body>
</html>