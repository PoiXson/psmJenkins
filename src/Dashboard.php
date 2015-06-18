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
use psmCore\Jenkins\Exceptions\SourceNotAvailableException;

class Dashboard {

	private $json;



	public function __construct(Source $source) {
		if($source == NULL) throw new \Exception('Source not provided!');
		$this->json = $source->getJson(
				'/view/All/',
				['depth' => 1]
		);
	}



	public function getJobs() {
		$jobs = array();
		foreach($this->json->jobs as $jsonJob) {
			$jobs[$jsonJob->name] = [
				'display' =>
						empty($jsonJob->displayName)
						? $jsonJob->name
						: $jsonJob->displayName,
				'state' => BuildState::getByValue($jsonJob->color),
				'lastbuild' =>
						$jsonJob->lastBuild == NULL
						? NULL
						: $jsonJob->lastBuild->number,
			];
		}
		return $jobs;
	}



}
