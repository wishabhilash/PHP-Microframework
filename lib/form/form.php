<?php
require_once("types.php");

class Form
{
	protected $output = array();
	protected $errors = array();
	protected $loaded = true;
	protected $valid = true;
	protected $cleaned_values = array();
	
	function __construct($arg = null)
	{
		
		$varlist = $this -> get_var_list();
		if($arg)
		{
			// Makes sure form is loaded i.e. all the required values are present. 
			foreach($varList as $var => $value)
			{
				/*if(!($arg["nm_$var"] && $this -> {"$var"} -> required) || 
				($arg["nm_$var"] || !$arg["nm_$var"] && !$this -> {"$var"} -> required))
					$this -> loaded = false;*/
				if(!($arg["nm_$var"] && $this -> {"$var"} -> required))
					$this -> loaded = false;
			}
			
			//	Checks validity of the form.
			if($this -> loaded)
			{
				$methods = ":".implode(":", get_class_methods($this));
				foreach($varList as $var => $value)
				{
					if(preg_match("/$var/",$methods))
					{
						$funcName = $var."_check";
						if(!$funcName($arg["nm_$var"]))
						{
							array_push($this -> errors, $this -> {"$var"} -> $label);
							$this -> valid = false;
						}
					}
					$this -> cleaned_values["$var"] = $arg["nm_$var"];
				}
			}
			
		}
		else
		{
			foreach($varlist as $var => $value)
			{
				if($matches = $this -> extract_parameters($value))
				{
					if(strtoupper($matches['type']) == "CHAR")
					{
						$this -> {"$var"} = new CharField($matches['type'],$var,
						array_key_exists('label',$matches) == TRUE && $matches['label'] != ""? $matches['label']:$var,
						array_key_exists('value',$matches) == TRUE && $matches['value'] != ""? $matches['value']:"",
						array_key_exists('required',$matches) == TRUE && $matches['required'] != ""? $matches['required']:'false');
					}
					if(strtoupper($matches['type']) == "PASSWORD")
					{
						$this -> {"$var"} = new PasswordField($matches['type'], $var,
						array_key_exists('label',$matches) == TRUE && $matches['label'] != ""? $matches['label']:$var,
						array_key_exists('value',$matches) == TRUE && $matches['value'] != ""? $matches['value']:"",
						array_key_exists('required',$matches) == TRUE && $matches['required'] != ""? $matches['required']:'false');
					}
					if(strtoupper($matches['type']) == "CHECKBOX")
					{
						$this -> {"$var"} = new CheckBoxFieldField($matches['type'], $var,
						array_key_exists('label',$matches) == TRUE && $matches['label'] != ""? $matches['label']:$var,
						array_key_exists('value',$matches) == TRUE && $matches['value'] != ""? $matches['value']:"",
						array_key_exists('checked',$matches) == TRUE && $matches['checked'] != ""? $matches['checked']:'false',
						array_key_exists('required',$matches) == TRUE && $matches['required'] != ""? $matches['required']:'false');
					}
					if(strtoupper($matches['type']) == "RADIO")
					{
						$this -> {"$var"} = new RadioField($matches['type'], $var,
						array_key_exists('label',$matches) == TRUE && $matches['label'] != ""? $matches['label']:$var,
						array_key_exists('value',$matches) == TRUE && $matches['value'] != ""? $matches['value']:"",
						array_key_exists('checked',$matches) == TRUE && $matches['checked'] != ""? $matches['checked']:'false',
						array_key_exists('required',$matches) == TRUE && $matches['required'] != ""? $matches['required']:'false');
					}
				}
				else
				{
					echo "Malformed expression: ".$var;
					exit(1);
				}
				array_push($this -> output, $this -> {"$var"} -> get_html());
			}
		}
	}
	
	function get_error_list()
	{
		return $this -> errors;
	}
	
	
	function get_cleaned_list()
	{
		return $this -> cleaned_values;
	}
	
	function extract_parameters($value)
	{
		$return = array(); 
		$pattType = "(?<type>CHAR|PASSWORD|CHECKBOX|RADIO)FIELD";
		$pattValue = "(:value=(?<value>\w+))";
		$pattLabel = "(:label=(?<label>\w+))";
		$pattRequired = "(:required=(?<required>\w+))";
		$pattChecked = "(:checked=(?<checked>\w+))";
		$value = explode(":", $value);
		$type = $value[0];
		if(!preg_match("/$pattType/i",$type, $match))
			return false;
		$return['type'] = $match['type'];
		unset($value[0]);
		$value = ":".implode(":",$value);
		if(preg_match("/$pattValue/i",$value, $match))
			$return['value'] = $match['value'];
		if(preg_match("/$pattLabel/i",$value, $match))
			$return['label'] = $match['label'];
		if(preg_match("/$pattRequired/i",$value, $match))
			$return['required'] = $match['required'];
		if(preg_match("/$pattChecked/i",$value, $match))
			$return['checked'] = $match['checked'];
		return $return;
	}
	
	function get_var_list()
	{
		$arr = get_class_vars(get_class($this));
		unset($arr['output']);
		unset($arr['loaded']);
		unset($arr['valid']);
		unset($arr['errors']);
		unset($arr['cleaned_values']);
		return $arr;
	}
	
	
	function __toString()
	{
		$out = "";
		for($i = 0; $i < count($this -> output); $i++)
		{
			$out = $out."<p>".$this -> output[$i]."</p>"."\n";
		}
		return $out;
	}
	
	function as_div()
	{
		$out = "";
		for($i = 0; $i < count($this -> output); $i++)
		{
			$out = $out."<div>".$this -> output[$i]."</div>"."\n";
		}
		return $out;
	}
	
	function as_table()
	{
		$patt = '</label>';
		$repl = '/label></td><td';
		$out = "";
		for($i = 0; $i < count($this -> output); $i++)
		{
			$temp = $this -> output[$i];
			$out = $out."<tr><td>".preg_replace($patt, $repl, $temp)."</td></tr>"."\n";
		}
		return $out;
	}
	
	function is_loaded()
	{
		return $this -> loaded;
	}
	
	function is_valid()
	{
		return $this -> valid;
	}
	
}



	
?>
