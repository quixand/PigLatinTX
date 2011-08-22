<?php


require_once('piglatinTX.class.php');  


// =========
// = Tests =
// monitor with 
// while true;do clear;phpunit --verbose unit.php;sleep 5;done
// =========



class piglatinTXTest extends PHPUnit_Framework_TestCase  
{

/**
 * testConstruct, create object, no vars
 *
 * @return void
 * @author NickMBP
 */	
	public function testConstruct()  
	{
		$obj = new piglatinTX();  
		$this->assertInstanceOf('piglatinTX', $obj);
	}

/**
 * testConstructVanilla, create object, with valid vars
 *
 * @return void
 * @author NickMBP
 */	
	public function testConstructVanilla()  
	{ 
		$overrideConfigs = array (
			'prefix' => 'vanilla'
			// 'prefix' => 'hyphenated',
			// 'prefix' => 'random',
			);
		$obj = new piglatinTX($overrideConfigs);
		$this->assertInstanceOf('piglatinTX', $obj);
	}
/**
 * testConstructHyphenated, create object, with valid vars
 *
 * @return void
 * @author NickMBP
 */	
	public function testConstructHyphenated()  
	{ 
		$overrideConfigs = array (
			// 'prefix' => 'vanilla'
			'prefix' => 'hyphenated',
			// 'prefix' => 'random',
			);
		$obj = new piglatinTX($overrideConfigs);
		$this->assertInstanceOf('piglatinTX', $obj);
	}
/**
 * testConstructRandom, create object, with valid vars
 *
 * @return void
 * @author NickMBP
 */	
	public function testConstructRandom()  
	{ 
		$overrideConfigs = array (
			// 'prefix' => 'vanilla'
			// 'prefix' => 'hyphenated',
			'prefix' => 'random',
			);
		$obj = new piglatinTX($overrideConfigs);
		$this->assertInstanceOf('piglatinTX', $obj);
	}


/**
 * testTranslateNullWord, create object, no vars, translate empty word
 *
 * @return void
 * @author NickMBP
 */	
	public function testTranslateNullWord()
	{
		$obj = new piglatinTX();
		$result = $obj->translate(' ');
		$this->assertFalse($result);
	}
     
/**
 * testTranslateStandardConsonant, create object, no vars, translate word 
 *
 * @return void
 * @author NickMBP
 */	
	public function testTranslateStandardConsonant()
	{
		$obj = new piglatinTX();
		$result = $obj->translate('foo');
		
		$this->assertEquals('oofay', $result);
	}
	
/**
 * testTranslateSpecial_QU, create object, no vars, translate word 
 *
 * @return void
 * @author NickMBP
 */	
	public function testTranslateSpecial_QU()
	{
		$obj = new piglatinTX();
		$result = $obj->translate('quay');

		$this->assertEquals('ayquay', $result);
	}
		
/**
 * testTranslateStartingVowel, create object, no vars, translate word 
 *
 * @return void
 * @author NickMBP
 */	
	public function testTranslateStartingVowel()
	{
		$obj = new piglatinTX();
		$result = $obj->translate('yellow');

		$this->assertEquals('yellowway', $result);
	}
	
/**
 * testTranslateStandardConsonantHyphenated, create object, use hyphenated, translate word 
 *
 * @return void
 * @author NickMBP
 */	
	public function testTranslateStandardConsonantHyphenated()
	{
		$overrideConfigs = array ('prefix' => 'hyphenated');
		$obj = new piglatinTX($overrideConfigs);
		$result = $obj->translate('foo');

		$this->assertEquals('oo-fay', $result);
	}

/**
 * testTranslateSpecial_QUHyphenated, create object, use hyphenated, translate word 
 *
 * @return void
 * @author NickMBP
 */	
	public function testTranslateSpecial_QUHyphenated()
	{
		$overrideConfigs = array ('prefix' => 'hyphenated');
		$obj = new piglatinTX($overrideConfigs);
		$result = $obj->translate('quay');

		$this->assertEquals('ay-quay', $result);
	}

/**
 * testTranslateStartingVowelHyphenated, create object, use hyphenated, translate word 
 *
 * @return void
 * @author NickMBP
 */	
	public function testTranslateStartingVowelHyphenated()
	{
		$overrideConfigs = array ('prefix' => 'hyphenated');
		$obj = new piglatinTX($overrideConfigs);
		$result = $obj->translate('yellow');

		$this->assertEquals('yellow-way', $result);
	}
}  
?>