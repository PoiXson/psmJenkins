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

	echo '<table border="1" cellpadding="10" width="500">';
	echo '<tr>';
	echo '	<th>Project</th>';
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
		if($name == 'update-repos')
			$url = 'http://dl.poixson.com/';
		else
			$url = 'http://dl.poixson.com/'.$name.'/';
		echo '<tr>';
		echo '	<td><a href="'.$url.'"><font size="+1">'.$job['display'].'</font></a></td>';
		echo '	<td align="center" style="background-color: '.$colors[$job['state']].';">'.
				'<b>'.$job['state'].'</b></td>';
		echo '	<td align="center">'.$job['lastbuild'].'</td>';
		echo '</tr>';
	}

	echo '</table>';
} catch (SourceNotAvailableException $e) {
	$e->printStackTrace();
	exit();
}
