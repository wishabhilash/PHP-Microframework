<?php

class CharField
{
	protected $required = true;
	protected $returnString;
	public $id;
	public $name;
	public $label;
	public $value;
	function __construct($id, $name, $label, $value = "", $required = true)
	{
		$this -> id = $id;
		$this -> name = $name;
		$this -> value = $value;
		$this -> label = $label;
		$this -> required = $required;
		$this -> returnString = "<label for=\"id_$id\">$label</label><input id=\"id_$id\" type=\"text\" name=\"nm_$name\" value=\"$value\" />";
	}
	
	function get_html()
	{
		return $this -> returnString;
	}
	
	function get_required()
	{
		return $this -> required;
	}
}

class PasswordField
{
	protected $required = true;
	protected $returnString;
	public $id;
	public $name;
	public $label;
	public $value;
	function __construct($id, $name, $label, $value = "", $required = true)
	{
		$this -> id = $id;
		$this -> name = $name;
		$this -> value = $value;
		$this -> label = $label;
		$this -> required = $required;
		$this -> returnString = "<label for=\"id_$id\">$label</label><input id=\"id_$id\" type=\"password\" name=\"nm_$name\" value=\"$value\" />";
	}
	
	function get_html()
	{
		return $this -> returnString;
	}
	
	function get_required()
	{
		return $this -> required;
	}
}

class CheckBoxField
{
	protected $required = true;
	protected $returnString;
	public $id;
	public $name;
	public $label;
	public $value;
	function __construct($id, $name, $label, $value = "", $checked = "unchecked", $required = true)
	{
		$this -> id = $id;
		$this -> name = $name;
		$this -> value = $value;
		$this -> label = $label;
		$this -> required = $required;
		$this -> returnString = "<label for=\"id_$id\">$label</label><input id=\"id_$id\" type=\"checkbox\" name=\"nm_$name\" value=\"vl_$value\" checked=\"$checked:\" />";
	}
	
	function get_html()
	{
		return $this -> returnString;
	}
	
	function get_required()
	{
		return $this -> required;
	}
}

class RadioField
{
	protected $required = true;
	protected $returnString;
	public $id;
	public $name;
	public $label;
	public $value;
	function __construct($id, $name, $label, $value = "", $checked = "false", $required = true)
	{
		$this -> id = $id;
		$this -> name = $name;
		$this -> value = $value;
		$this -> label = $label;
		$this -> required = $required;
		$this -> returnString = "<label for=\"id_$id\">$label</label><input id=\"id_$id\" type=\"radio\" name=\"nm_$name\" value=\"vl_$value\" checked=\"$checked\" />";
	}
	
	function get_html()
	{
		return $this -> returnString;
	}
	
	function get_required()
	{
		return $this -> required;
	}
}
?>
