<?php

require_once SOURCE_DIR."/model/fields.php";

$fieldId = $_POST["fieldId"];
deleteField($fieldId);
