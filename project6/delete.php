<html>
<title>Remove Crininal Incident</title>	
<body>
	
<?php include_once 'nav.php'; ?>

<h1>Delete Criminal Incident</h1>

<p><b>Data Format</b></p>
<p>Time: 2030</p>
<p>Date:  2016-11-02</p>

<form action="deleteResults.php" method="post">
Incident Number: <input type="text" name="IncidentNumber"><br>
Time Occurred: <input type="text" name="TimeOccurred"><br>
Date Occurred: <input type="text" name="DateOccurred"><br>
Address: <input type="text" name="Address"><br>
<input type="submit">
</form>

</body>
</html>
