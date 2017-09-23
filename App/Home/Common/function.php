<?php

function searchcolor($str,$q){
	return str_replace($q, '<font color="#f00">'.$q.'</font>', $str);
}