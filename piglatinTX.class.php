<?php


/**
 * piglatinTX
 *
 * @package default
 * @author Nick Fox 2011 quixand@gmail.com
 **/
class piglatinTX  {
	/**
	 * $use_prefix_style prefix default, defines how to generate language. can be overridden on object creation
	 *
	 * @var string
	 */
	private $use_prefix_style = 'vanilla';
	/**
	 * $available_prefix options for $use_prefix_style
	 *
	 * added null because array_search() seems to start from 1 not 0 ??? WTF?
	 *
	 * @var string
	 */
	private $available_prefix = array(null,'vanilla','hyphenated','random');
	/**
	 * $prefix_settings regex and replacments per prefix type
	 *
	 * @var string
	 */
	private $prefix_settings = array(
		'vanilla' => array(
			'starting_vowel_append' => 'way',
			'special_qu' => "$2$1ay",
			'starting_consonant' => '$2$1ay'
			),
		'hyphenated' => array(
			'starting_vowel_append' => '-way',
			'special_qu' => "$2-$1ay",
			'starting_consonant' => '$2-$1ay'
			)
	);
	/**
	 * construct stores/validates overrides on defaults
	 *
	 * @param string $overrideConfigs 
	 * @author NickMBP
	 */
	public function __construct($overrideConfigs = '') {
		// process args, if not recognised as valid $available_prefix element throw exception
		// $overrideConfigs should be an array of valid configs, validate and update object array
		if ( is_array($overrideConfigs) && ! is_null($overrideConfigs['prefix']) ){
			if( array_search( $overrideConfigs['prefix'], $this->available_prefix ) ){
				$this->use_prefix_style = $overrideConfigs['prefix'];
				// generate random choice for prefix style
				if ( 'random' == $this->use_prefix_style ){ $this->selectRandomStyle(); }
				return $this;
			}else{
				// Throw new Exception('prefix method not valid. try '.implode($this->available_prefix,' ') );
				Throw new Exception('prefix method not valid. could not find ::'.$overrideConfigs['prefix'].':: in ::'.$this->available_prefix[0].'::');
			}
		}
	}

	public function translate($word = ''){
		// word?
		if( preg_match('/^[\s\t]+/i', $word) ){ return false; } // or throw exception? 
		
		// some words we cannot/should not translate. numbers, dates etc, special chars..
		// however hyphens should be retained as well as punctuations
	   	if ( preg_match('/^[^a-z]+/i', $word) ) { return $word; }

		$this->dictionaryCheck();

		// starting vowel? add "way/-way"
		if (preg_match('/^[aeiouy]/', $word)) {
			return $this->fixPunctuation( $word.$this->prefix_settings[$this->use_prefix_style]['starting_vowel_append'] );

		}elseif (preg_match('/^qu/i', $word)) {
			// got qu? add 'quay/-quay' to the end of the word.
			$reg = '/^(qu)(.*)$/i';
			$word = preg_replace($reg, $this->prefix_settings[$this->use_prefix_style]['special_qu'], $word);
			return $this->fixPunctuation( $word );
			// return preg_replace($reg, "$2$1ay", $word);

		}elseif (preg_match('/^([^aeiou][^aeiouy]*)(.*)$/i', $word)) {
			// got starting consonant? move prefix to end and append ay/-<prefix>ay
			// If 'y' follows a leading consonant group, it's considered a vowel, apparently!
			$reg = '/^([^aeiou][^aeiouy]*)(.*)$/i';
			$word = preg_replace($reg, $this->prefix_settings[$this->use_prefix_style]['starting_consonant'], $word);
			return $this->fixPunctuation( $word );
		}
		Throw new Exception("regex match fail for: ".$word);
	}

	/**
	 * fixPunctuation
	 *
	 * @param string $word 
	 * @return string
	 * @author NickMBP
	 */
	private function fixPunctuation($word='')
	{
		// move punctuation to end of word
		$reg = '/^(.*)([\!\?]+)(.*)$/i';
		return preg_replace($reg, "$1$3$2", $word);
		
	}

	/**
	 * getPrefixSet convenience method
	 *
	 * @return string
	 * @author NickMBP
	 */
	public function getPrefixSet(){
		return $this->use_prefix_style;
	}
	/**
	 * getAvailablePrefix convenience method
	 *
	 * @return string
	 * @author NickMBP
	 */
	public function getAvailablePrefix(){
		return $this->available_prefix;
	}

	/**
	 * selectRandomStyle picks a prefix style for you
	 *	
	 *	Can be called on the object any time or triggered on object initialisation
	 *
	 * @return void
	 * @author NickMBP
	 */
	public function selectRandomStyle(){
		// choose prefix style randomly
		if(rand(0, 100) > 50){
			$this->use_prefix_style = 'hyphenated';	
		}else{
			$this->use_prefix_style = 'vanilla';	
		}
		return $this->use_prefix_style;
	}
	
} // END class 












?>