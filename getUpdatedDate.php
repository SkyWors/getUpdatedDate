<?php

function getUpdatedDate($path) {
	date_default_timezone_set("Europe/Paris");
	$date = 0;
	foreach (getAllFiles($path, array()) as $content) {
		$time = @filemtime($content);
		if ($time > $date) {
			$date = $time;
		}
	}
	$date = localtime($date, true);
	return $date;
}

function getAllFiles($path, $array) {
	$pathFiles = @scandir($path . "/");
	if ($pathFiles) {
		foreach (array_diff($pathFiles, array('.', '..')) as $element) {
			if (is_file($path . "/" . $element)) {
				array_push($array, $path . "/" . $element);
			} elseif (is_dir($path . "/" . $element)) {
				$array = getAllFiles($path . "/" . $element, $array);
			}
		}
	}
	return $array;
}
