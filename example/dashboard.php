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

use psmCore\Jenkins\Source;
use psmCore\Jenkins\Dashboard;
use psmCore\Jenkins\Exceptions\SourceNotAvailableException;

require('../vendor/autoload.php');



try {
	$source = Source::getByHost('ci.poixson.com');
	$dash = $source->getDashboard();
	$jobs = $dash->getJobs();

	echo '<table border="1" cellpadding="10">';
	echo '<tr>';
	echo '	<th>Name</th>';
	echo '	<th>Display</th>';
	echo '	<th>State</th>';
	echo '	<th>LastBuild</th>';
	echo '</tr>';

	$colors = [
			'GOOD'     => 'green',
			'FAILED'   => 'red',
			'NOTBUILT' => 'gray',
			'DISABLED' => 'pink',
	];
	foreach($jobs as $name => $job) {
		echo '<tr>';
		echo '	<td>'.$name.'</td>';
		echo '	<td>'.$job['display'].'</td>';
		echo '	<td style="background-color: '.$colors[$job['state']].';">'.
				$job['state'].'</td>';
		echo '	<td>'.$job['lastbuild'].'</td>';
		echo '</tr>';
	}

	echo '</table>';
} catch (SourceNotAvailableException $e) {
	$e->printStackTrace();
	exit();
}
