<?php 

loadController('Tag');

class TagControllerTestCase extends UnitTestCase {
	var $object = null;

	function setUp() {
		$this->object = new TagController();
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