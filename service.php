<?php
/**
 * 
 * service.php is the file that contains the classes required to run the application.
 * Since this application is very simple, everything is put together in this one file.
 * 
 * @author Evan Pratama <evan.pratama@gmail.com>
 * 
 */

/**
 *
 * QuoteOfTheDay class is a class that will handle the loading and displaying of Quotes as well as Junk Content.
 *
 * @author Evan Pratama <evan.pratama@gmail.com>
 *        
 */
class QuoteOfTheDay {
	
	/**
	 * Constant for the file that contains the quotes
	 */
	const QUOTES_FILENAME = "files/quotes.txt";
	/**
	 * Constant for the file that contains the junk mail
	 */
	const JUNK_FILENAME = "files/junk.txt";
	/**
	 * Constant for semicolon symbol that will be used for breaking down quotes
	 */
	const SEMICOLON = ";";
	/**
	 * Variable to store the loaded quotes
	 */
	private $quotes = array ();
	/**
	 * Variable to store the loaded junk mail
	 */
	private $junk;
	
	/**
	 * Constructor for QuoteOfTheDay
	 *
	 * Loading the quotes and junk mail into the variables when the class is initialised.
	 */
	function __construct() {
		$this->loadQuotes ();
		$this->loadJunkmail ();
	}
	/**
	 * A function to load the quotes into the variable.
	 *
	 * The quotes are stored in this format:
	 * <quote_text>;<author>;<topic>
	 *
	 * The function will break the format into chunks of string, and will assign each to an associative array to make it more meaningful.
	 * This array will then be pushed to the primary variable that contains all quotes.
	 */
	private function loadQuotes() {
		$lines = file ( self::QUOTES_FILENAME );
		foreach ( $lines as $line_num => $line ) {
			$lineArr = explode ( self::SEMICOLON, $line );
			$quote = array ();
			$quote ["text"] = $lineArr [0];
			$quote ["author"] = $lineArr [1];
			$quote ["topic"] = $lineArr [2];
			array_push ( $this->quotes, $quote );
		}
	}
	/**
	 * A function to load the junk mail into the variable.
	 * The content of the file is loaded as-is.
	 */
	private function loadJunkmail() {
		$this->junk = trim ( file_get_contents ( self::JUNK_FILENAME ) );
	}
	/**
	 * A function to get a random quote.
	 * The function will randomise a number based on how many quotes are there.
	 * It will then return the quote for that index.
	 */
	public function getRandomQuotes() {
		$random = rand ( 0, count ( $this->quotes ) - 1 );
		return $this->quotes [$random];
	}
	/**
	 * A function to get the content of the junk mail.
	 */
	public function getJunkmail() {
		return $this->junk;
	}
}

/**
 *
 * Counter class is the class that will handle the page load tracking.
 *
 * @author Evan Pratama <evan.pratama@gmail.com>
 *        
 */
class Counter {
	/**
	 * Constant for the file that contains the counter
	 */
	const COUNTER_FILENAME = "files/counter.txt";
	/**
	 * A function to increment the counter.
	 */
	public function increment() {
		$ctr = file_get_contents ( self::COUNTER_FILENAME );
		$ctr ++;
		file_put_contents ( SELF::COUNTER_FILENAME, $ctr );
	}
	/**
	 * A function to display the current counter number.
	 */
	public function getCounter() {
		$ctr = file_get_contents ( self::COUNTER_FILENAME );
		return $ctr;
	}
}
?>