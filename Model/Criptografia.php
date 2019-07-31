<?php

class Criptografia{

	public function encode($string){
        $encoded = base64_encode(trim($string));
        return $encoded; 
    }

    public function decode($string){
        $decoded = base64_decode(trim($string));
        return $decoded;
    }
}

?>