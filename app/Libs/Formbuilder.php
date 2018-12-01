<?php
namespace App\Libs;
class Formbuilder{
	private $markup="";
	public function __construct($name ,$method="POST", $action="", $enctype=false){
//		$this->markup="<script src='assets/js/animationworkaround.js'></script>\n";
		$this->markup="<form method='$method' ";
		if(empty($action)) $this->markup.="id='f-$name'";
		else $this->markup.="action='$action' id='f-$name'";
		$this->markup.=($enctype)?"enctype\"multipart/form-dat>":">";
//		$csrf= set_csrf();
//		$this->markup.="<input type='hidden' value='$csrf' name='csrf'>";
		$this->markup.="<div class='row'>\n";
	}
	public function addInput($type="text", $name="", $label=false, $attr=array()){
		$this->markup.="<div class='field textfield'>";
		$this->markup.="<input type='$type' name='$name' id='$name' ";
			$class=isset($attr['class'])?"{$attr['class']}":"form";
			$this->markup.="class='$class'";
			if(count($attr)>0){
				foreach($attr as $key=>$item):
					if($key=="class") continue;
					$this->markup.=" $key=\"$item\"";
				endforeach;
			}
			if (isset($_POST[$name])&&$type!=="password")$this->markup.="value=$_POST[$name]";
			$this->markup.=">\n";//input ende
		if($label!=false){
			$this->markup.="<label for='$name' class='label'>$label</label>";
			$this->markup.="<div class=\"underline\"></div>";
		}
		$this->markup.="</div>\n";//form-group ende
		return $this;
	}
	public function addButton($name, $value, $attr = array())
	{
		$this->markup .= "<div class='field button'>";
		$this->markup .= "<button name=\"$name\" id=\"$name\" ";
		$class = (isset($attr['class'])) ? "{$attr['class']}" : "button";
		$this->markup .= " class=\"$class\"";
		if (count($attr) > 0) {
			foreach ($attr as $key => $val):
				if ($key == "class") continue;
				$this->markup .= " $key=\"$val\"";
			endforeach;
		}
		$this->markup .= ">$value</button>";
		$this->markup .= "</div>"; // form-group end
		return $this;
	}
	public function addSelect($name = "", $label = false, $options = array(), $selected = null, $attr = array()){
		$this->markup .= "<div>";
		$this->markup .= "<select id=\"$name\" name=\"$name\"";
		$class = (isset($attr['class'])) ? "{$attr['class']}" : "form";
		$this->markup .= " class=\"$class\"";
		if (count($attr) > 0) {
			foreach ($attr as $key => $val):
				if ($key == "class") continue;
				$this->markup .= " $key=\"$val\"";
			endforeach;
		}
		$this->markup .= ">";
		foreach ($options as $key => $val):
			if ($selected !== null && $selected == $key) {
				$this->markup .= "<option value=\"$key\" selected>$val</option>";
			} else {
				$this->markup .= "<option value=\"$key\">$val</option>";
			}
		endforeach;
		$this->markup .= "</select>";
		if ($label !== false) $this->markup .= "<label for=\"$name\">$label</label>";
		$this->markup .= "</div>"; // form-group end
		return $this;
	}
	public function addTextarea($name = "", $label = false, $value = "", $attr = array()){
		$this->markup .= "<div>";
		$this->markup .= "<textarea name=\"$name\" id=\"$name\"";
		if (count($attr) > 0) {
			foreach ($attr as $key => $val):
				if ($key == "class") continue;
				$this->markup .= " $key=\"$val\"";
			endforeach;
		}
		$this->markup .= ">$value</textarea>";
		if ($label !== false) $this->markup .= "<label for=\"$name\">$label</label>";
		$this->markup .= "</div>"; // form-group end
		return $this;
	}
	public function addCheckbox($values=array(), $attr=array())
	{
		$this->markup .= "<div class='field checkbox'>";
		foreach ($values as $key => $item){
			$this->markup.="<label for=\"$key\">";
			$this->markup.="<input type=\"checkbox\" name=\"$key\" id=\"$key\" value=\"1\">";
			$this->markup.="<span>$item</span>";
			$this->markup.="</label>";
		}
		$this->markup .= "</div>";
		return $this;
	}
	public function addRadioGroup($name, $values=array()){
		$this->markup .= "<div>";
		$counter=1;
		foreach($values as $key=>$item){
			$this->markup.="<div class=\"form\">";
			$this->markup.="<input class='form-input' type='radio' id='$name-$counter' name='$name' value='$key'>";
			$this->markup.="<label for='$name-$counter' class='form-label'>$item</label>";
			$this->markup.="</div>";
			$counter++;
		}
		$this->markup.="</div>";
		return $this;
	}
	public function output(){
		$this->markup.="</div>";
		$this->markup.="</form>";
		return $this->markup;
	}
}