<?php 

loadController('Origin');

class OriginControllerTestCase extends UnitTestCase {
	var $object = null;

	function setUp() {
		$this->object = new OriginController();
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