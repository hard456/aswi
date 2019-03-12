<?php 

loadModel('Transliteration');

class TransliterationTestCase extends UnitTestCase {
	var $object = null;

	function setUp() {
		$this->object = new Transliteration();
	}

	function tearDown() {
		unset($this->object);
	}

	/*
	function testMe() {
		$result = $this->object->doSomething();
		$expected = 1;
		$this->assertEqual($result, $expected);
	}
	*/
}
?>