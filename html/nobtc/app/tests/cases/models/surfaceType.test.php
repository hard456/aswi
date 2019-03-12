<?php 

loadModel('SurfaceType');

class SurfaceTypeTestCase extends UnitTestCase {
	var $object = null;

	function setUp() {
		$this->object = new SurfaceType();
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