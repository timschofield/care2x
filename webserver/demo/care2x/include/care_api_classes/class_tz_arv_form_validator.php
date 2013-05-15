<?php
class Validator {
	var $defaults;
	var $data_in;
	var $data_out;
	var $messages;
	var $errors;
	var $rules;
	var $msg_tpl = "<div class=\"error\">%s</div>";
	
	function Validator($defaults_,$data_in_) {
		$this->defaults=$defaults_;
		$this->data_in=$data_in_;
	}
	
	function set_rule($field,$rule,$param) {
		//Method for setting a validation rule for the ARV forms
				$this->rules[$field][$rule] = $param;
		}
	
	function filterData($val) {
	//clean the data entered into the ARV forms
		$val=trim($val);
		$val=htmlentities($val);
		$val=strip_tags($val);
		return $val;
	}
	
	function applyRules() {
		/* Method for form validation.
		 * Parameters:
		 * $defaults: Array of $default values for the form elements
		 * $data_in: Array of $_GET or $_POST variables.
		 *
		 * set empty fields to the default value
		 * apply the rules given with the set_rule method
		 * return an array, containing the number of errors, error messages, and the validated data
		 * */
	
		$keys = array_keys($this->defaults);
	
		 foreach ($keys as $k) {
		    $this->messages[$k] = false;
	
		    if (!isset($this->data_in[$k])){
	
		      $this->data_out[$k] = $this->defaults[$k];
		      continue;
		    }
			$this->filterData($this->data_in[$k]);
		    $this->data_out[$k] = $this->data_in[$k];
		 }
		 
	
		  foreach ($keys as $field) {
		    while (list($rule, $param) = each($this->rules[$field])) {
		    	
				  $success= $this->$rule($this->data_out[$field],$param);
	
			      if ($success){
			      	$this->messages[$field] = sprintf($this->msg_tpl, $this->$rule($this->data_out[$field],$param));
			        $this->errors ++;
			        break;
			      }
		    }
		  }
		}	
	
	function getValues() {return $this->data_out;}
	function getMessages() {return $this->messages;}
	function getErrors(){return $this->errors;}

//------------------------------------------------------------------------------------------------------	
	function rule_required($val) {
		if(empty($val)) {
			$msg_string="Please enter a value!";
			return $msg_string;
		}
		return false;
	}

	function rule_date($val) {
		$success=true;
		if(empty($val)) { return false;}
		$rule_date = '#^((0?\d|[1-2]\d)[/]\s*(0?[1-9]|10|11|12)|(30)[/]
		\s*(0?[13456789]|10|11|12)|(31)[/]\s*(0?[13578]|10|12))[/]\s*(19\d\d|20\d\d)$#x';
		$success = preg_match($rule_date, $val);

		return !$success ? "Please enter a valid date!" : false;
	}

	function rule_decimal($val) {
		 $success=true;
		 $regex = '#^\d{1,3}[.]+\d{1,2}$|^\d{0,3}$#';
		 $success = preg_match($regex, $val);
		 return !$success ? "Please enter a value in the format 111.22 or 111!" : false;
	}

	function rule_min_chars($val,$number) {
		if(empty($val)) {return false;}
		if(strlen($val)<$number) {
			$error_string="Please enter at minimum $number characters!";
			return $error_string;
		}
		return false;
	}

	function rule_not_empty($val) {
		if(empty($val)) {
			return false;
		}
		return true;
	}

	function rule_numeric($val) {
		if(!empty($val)){
			return is_numeric($val)? false : $error_string="Please enter a numeric value!";
		}
		else {
			return false;
		}
	}
}
?>
