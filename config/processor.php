<?php

/**
 * @Auto Load files 
 * @process all files
 * @load modules
 * @load functions
 * @load application handler
 * @load controllers
 * @load authentication modules
 * @load requirements
 */

//load configuration file 
include __DIR__ . "/config.php";

/**
 * @load modules
 */

//Load Application modules
if ($handle = opendir(__DIR__ . "/../modules")) {
  while (false !== ($entry = readdir($handle))) {
    if ($entry != "." && $entry != "..") {
      include __DIR__ . "/../modules/$entry";
    }
  }
  closedir($handle);
}
