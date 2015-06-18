<?php
/**
 * psmJenkins API library
 *
 * @copyright 2015
 * @license GPL-3
 * @author lorenzo at poixson.com
 * @link http://poixson.com/
 */
namespace psmCore\Jenkins;

use \psmCore\Utils\BasicEnum;

class BuildState extends BasicEnum {


	const GOOD     = 'blue';
	const FAILED   = 'red';
	const NOTBUILT = 'notbuilt';
	const DISABLED = 'disabled';


}
