<?php
$pattType = "(?<type>CHAR|PASSWORD)FIELD";
$pattValue = "(:value=(?<value>\w+))";
$pattName = "(:name=(?<name>\w+))";
$pattLabel = "(:label=(?<label>\w+))";
$pattRequired = "(:required=(?<required>\w+))";
$pattChecked = "(:checked=(?<checked>\w+))";

$str = 'charfield:name=time:value=line';
$res = explode(":",$str);
$field = $res[0];
preg_match("/$pattType/i", $field, $matches);
echo $matches['type'];
unset($res[0]);
$str = ":".implode(":", $res);
preg_match("/$pattValue/", $str, $matches);
preg_match("/$pattName/", $str, $matches);
print_r($matches);
?>
