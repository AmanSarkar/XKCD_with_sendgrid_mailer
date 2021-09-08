<?php
require_once('xkcd.php');
class xkcdcomic{
    private $raw = array();
	private $api = null;
    public $url = '';
    
	function __construct($raw, &$api){
		$this->raw = $raw;
		$this->api = &$api;
        $this->url = 'http://xkcd.com/'.$this->num;
	}
	
	function __get($var){
		
		if (array_key_exists($var, $this->raw)) {
		    return $this->raw[$var];
		}
	
	}
	
	function next(){
		return $this->api->get($this->num + 1);
	}
	
	function prev(){
		return $this->api->get($this->num - 1);
	}
}
?>