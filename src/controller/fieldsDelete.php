<?php

require_once SOURCE_DIR."/model/fields.php";

deleteField($this->variables['fieldId']);
header( "Location: /exercises/". $this->variables['exerciseId'] ."/fields" );