<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Result {
	public $data=array(),$total=0,$result='SUCCESS',$message='';
	
	public function setMessage($message){
		$this->message=$message;
		return $this;
	}
	
	public function setData($data){
		$this->data=$data;
		return $this;
	}
	
	public function setTotal($total){
		$this->total=$total;
		return $this;
	}
	
	public function error(){
		$this->result='ERROR';
		return $this;
	}
	
	public function success(){
		$this->result='SUCCESS';
		return $this;
	}
	
	public function end(){
		echo json_encode($this);
		exit;
	}
}