<?php
include "service.php";
$qotd = new QuoteOfTheDay ();
$counter = new Counter ();
$counter->increment ();
?>

<html>
	<head>
		<title>Quote of The Day</title>
	</head>
<body>
<?php
if ($counter->getCounter () % 10 == 0) {
?>
	<pre><?= $qotd->getJunkmail() ?></pre>
<?php
} else {
	$quote = $qotd->getRandomQuotes ();
?>
	<h1><?= $quote["text"] ?></h1>
	<h2><?= $quote["author"] ?></h2>
	<h3><?= $quote["topic"] ?></h3>
<?php
}
?>
</body>
</html>
