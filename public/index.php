<?php

use UniversalCodeDefinition\View\UCDView;
use UniversalCodeDefinition\Model\RepositoryModel;
use UniversalCodeDefinition\Controller\UCDController;

require "../vendor/autoload.php";

header("Content-Type: application/json; charset=utf8");

echo (new UCDController(
   new RepositoryModel,
   new UCDView)
)->execute();
