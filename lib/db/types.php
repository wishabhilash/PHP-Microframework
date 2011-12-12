<?php

class dbTypes
{
	function CharField($len)
	{
		return "VARCHAR($len)";
	}

	function IntegerField($type = null)
	{
		switch($type)
		{
			case "BIG" : return "BIGINT";
			case "SMALL" : return strtoupper($type)."INT";
			case "MEDIUM" : return strtoupper($type)."INT";
			case "TINY" : return strtoupper($type)."INT";
			default: 
			if($type == null)
			{
				return "INT";
			}
			else
			{
				trigger_error("Wrong argument", E_USER_ERROR);
			}
			break;
		}
	}

	function FloatField()
	{
		return "FLOAT";
	}

	function TextField($type = null)
	{
		switch($type)
		{
			case "TINY" : return strtoupper($type)."TEXT";break;
			case "MEDIUM" : return strtoupper($type)."TEXT"; break;
			case "LONG" : return strtoupper($type)."TEXT"; break;
			default :
			if($type == null)
			{
				return "TEXT";
			}
			else
			{
				trigger_error("Wrong argument", E_USER_ERROR);
			}
			break;
		}
	}

	/** BLOB datatype
		Parameters: MEDIUM/LONG
		Default: BLOB 
	*/

	function BlobField($type)
	{
		switch($type)
		{
			case "MEDIUM" : return strtoupper($type)."BLOB"; break;
			case "LONG" : return strtoupper($type)."BLOB"; break;
			default :
			if($type == null)
			{
				return "BLOB";
			}
			else
			{
				trigger_error("Wrong argument", E_USER_ERROR);
			}
			break;
		}
	}
}



?>
