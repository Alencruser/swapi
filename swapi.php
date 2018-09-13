<?php
/*
Plugin Name: swapi
Plugin URI: aucun
Description: plugin api star wars
Author: Alencruser & theklaz
Version: 1.0
Author URI: Le vide
*/
class swapi {
public function people($atts,$content){
	$d=file_get_contents('https://swapi.co/api/'.$content);
	$x=json_decode($d, true);
	foreach($x as $u=>$v){
		if(gettype($v)=="array"){
			foreach($v as $c=>$a){
				$w=file_get_contents($a);
				$p=json_decode($w,true);
				if(strlen($p["name"])<2){
					echo $u." :".$p['title']."<br>";
				}else{
					echo $u." :". $p["name"]."<br>";
				}
			}
		}elseif(stripos($v,'/')&&$u!="url"){
			$r=file_get_contents(strval($v));
			$t=json_decode($r,true);
			echo $u." : ".$t["name"]."<br>";
		}else{
			echo $u." :".$v."<br>";
		}
	}
}
public function search($atts,$type){
	$f=explode(" ", $type);
	$d=file_get_contents('https://swapi.co/api/'.$f[0].'/?search='.$f[1]);
	$x=json_decode($d, true);
	foreach($x['results'][0] as $u=>$v){
		if(gettype($v)=="array"){
			foreach($v as $c=>$a){
				$w=file_get_contents($a);
				$p=json_decode($w,true);
				if(strlen($p["name"])<2){
					echo $u." :".$p['title']."<br>";
				}else{
					echo $u." :". $p["name"]."<br>";
				}
			}
		}elseif(stripos($v,'/')&&$u!="url"){
			$r=file_get_contents(strval($v));
			$t=json_decode($r,true);
			echo $u." : ".$t["name"]."<br>";
		}else{
			echo $u." :".$v."<br>";
		}
	}
}
}
$swap= new swapi;
add_shortcode('swapi',array($swap,'people'));
add_shortcode('search',array($swap,'search'));