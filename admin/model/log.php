<?php
/**
 * Autor: Douglas da Paz Silva
 * Date: 08/03/2017
 * Project: 
 * File: file.php
 * Objetivo: Classe do Log
 */
class log {
	
	private $cod_log;
	private $app;
	private $usuario;
	private $texto;
	private $data;
	private $hora;

	function getCod_log(){ return $this->cod_log;}
	function getApp(){	return $this->app;}
	function getUsuario(){ return $this->usuario;}
	function getTexto(){ return $this->texto;}
	function getData(){	return $this->data;}
	function getHora(){	return $this->hora;}
	function getDataFormatada(){	
		$ano=substr($this->data, 0,4);
		$mes=$this->data[5].$this->data[6];
		$dia=substr($this->data, 8);
		return $dia.'/'.$mes.'/'.$ano;
		}

	function setCod_log($value){	$this->cod_log=$value;}
	function setApp($value){	$this->app=$value;}
	function setUsuario($value){	$this->usuario=$value;}
	function setTexto($value){	$this->texto=$value;}
	function setData($value){	$this->data=$value;}
	function setHora($value){	$this->hora=$value;}

	function __construct($cod_log,$usuario,$texto,$data,$hora){
		$this->cod_log=$cod_log;
		$this->app=$app;
		$this->usuario=$usuario;
		$this->texto=$texto;
		$this->data=$data;
	}

	function construtor($app,$usuario,$texto){
		$this->app=$app;
		$this->usuario=$usuario;
		$this->texto=$texto;
		$this->data=date("Y-m-d");
	}

	function show(){
		echo "this->app =".$this->app."<br>";
		echo "this->usuario =".$this->usuario."<br>";
		echo "this->texto =".$this->texto."<br>";
		echo "this->data =".$this->data."<br>";
	}
}
?>