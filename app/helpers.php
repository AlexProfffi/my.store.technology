<?php

	function translations($filePath) {

		if(empty(file_exists($filePath))) return [];

		return json_decode(file_get_contents($filePath));
	}
