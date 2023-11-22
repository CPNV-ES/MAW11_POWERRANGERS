<?php

require_once SOURCE_DIR."/model/fields.php";

deleteField(intval($this->variables['fieldId']));
header( "Location: /exercises/". $this->variables['exerciseId'] ."/fields" );