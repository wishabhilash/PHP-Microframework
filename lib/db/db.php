<?php

require_once("types.php");

class Model
{
	protected $p_key = array();
	protected $pattChar = "(CHAR) (?<arg>\d*)";
	protected $pattFloat = "FLOAT";
	protected $pattText = "(TEXT):?(?<arg>LONG|MEDIUM)?";
	protected $pattInt = "(INT):?(?<arg>BIG|SMALL|TINY|MEDIUM)";
	protected $pattBlob = "(BLOB):?(?<arg>LONG|MEDIUM)?";
	
	function __construct()
	{
		$varlist = get_var_list();
		foreach($varlist as $var => $value)
		{
			if(preg_match("/$pattChar/i", $value, $matches)
				$this -> {"$var"} = CharField($arg);
			else if(preg_match("/$pattFloat/i", $value, $matches)
				$this -> {"$var"} = FloatField();
			else if(preg_match("/$pattText/i", $value, $matches)
				$this -> {"$var"} = TextField(strtoupper($arg));
			else if(preg_match("/$pattInt/i", $value, $matches)
				$this -> {"$var"} = IntegerField(strtoupper($arg));
			else if(preg_match("/$pattBlob/i", $value, $matches)
				$this -> {"$var"} = BlobField(strtoupper($arg));
		}
	}
	
	function __toString()
	{
		return $this -> table_name;
	}
	
	
	
	function get_var_list()
	{
		$arr = get_class_vars(get_class($this));
		unset($arr['p_key']);
		unset($arr['pattChar']);
		unset($arr['pattFloat']);
		unset($arr['pattText']);
		unset($arr['pattInt']);
		unset($arr['pattBlob']);
		unset($arr['pattText']);
		return $arr;
	}
	
	function query($query_string)
	{
		mysql_query($query_string);
	}
	
	function save()
	{
		$variable_string = "id";
		$values = $this -> get_var_list();
		foreach ($values as $key => $value)
		{
			$variable_string = $variable_string . ' ' . "$value";
		}
		print_r($variable_string);
		//mysql_connect("INSERT INTO IF EXISTS $this -> $table_name VALUES (
	}
	
	function make_primary_key($var_name)
	{
		array_push($this -> p_key, $var_name);
	}
}


class ArticleModel extends Model
{
	public $name = "VARCHAR(100)";
	public $rank = "INT";
}




$m = new ArticleModel;
$m -> save()
?>
