<?php
$x = 1;
$json = '{
    "glossary": {
        "title": "example glossary",
		"GlossDiv": {
            "title": "S",
			"GlossList": {
                "GlossEntry": {
                    "ID": "SGML",
					"SortAs": "SGML",
					"GlossTerm": "Standard Generalized Markup Language",
					"Acronym": "SGML",
					"Abbrev": "ISO 8879:1986",
					"GlossDef": {
                        "para": "A meta-markup language, used to create markup languages such as DocBook.",
						"GlossSeeAlso": ["GML", "XML"]
                    },
					"GlossSee": "markup"
                }
            }
        }
    }
}';
setcookie("Method", "Method--".$json, time()+3600);
setcookie("Method2", "Method2--".$json, time()+3600);
//Above part will be handle by Javascript

//Php file handle
$my_file = 'log.txt';
if(isset($_COOKIE["Method"]))
{
	$handleWrite = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
	$dataWrite  = $_COOKIE["Method"].'***'.$_COOKIE["Method2"];
	fwrite($handleWrite, $dataWrite);
	fclose($handleWrite);
}
if(!empty($_COOKIE["Method"]))
{
	$handleRead = fopen($my_file, 'r') or die('Cannot open file:  '.$my_file);
	$data = fread($handleRead,filesize($my_file));
	$data = explode("***", $data);
	if(is_array($data))
	{
	  $my_settings = array();
	  for($i=0; $i< sizeof($data); $i++)
	  {
		 $perMethod = explode("--", $data[$i]);
		 if(is_array($perMethod))
		 {
			//print $_COOKIE[$perMethod[0]] //Values from cookie;
			//print $perMethod[0]; //MethodName
			//print $perMethod[1]; //JsonString
			//Sending old values to javascript function
			$my_settings[$perMethod[0]] = $perMethod[1];
			//Replacing json if cookie json string is not same as our log json string
			$dataFromCookie = explode("--", $_COOKIE[$perMethod[0]]);
			if($dataFromCookie[1]!=$perMethod[1])
			{
				$str = @file_get_contents($my_file);
				$str = str_replace($perMethod[1], $dataFromCookie[1],$str);
				@file_put_contents($my_file, $str);
				//print $str; 
			}
			
		 }
	  }
	  print_r($my_settings);
	}
}
//$my_settings = array(
//  'Method' => 'JSON STRING'
//);
//drupal_add_js(array('my_module' => $my_settings), 'setting');
//var jsonStrings = Drupal.settings.my_module.Method;
?>