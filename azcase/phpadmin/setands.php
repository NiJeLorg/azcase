<?php
if ($azcongresswhere!='' && $statelegwhere!='') {
	$and1 = " AND";
}elseif ($azcongresswhere!='' && $elemschooldistrictwhere!='') {
	$and1 = " AND";
}elseif ($azcongresswhere!='' && $unionschooldistrictwhere!='') {
	$and1 = " AND";
}elseif ($azcongresswhere!='' && $citieswhere!='') {
	$and1 = " AND";
}elseif ($azcongresswhere!='' && $whereactivity!='') {
	$and1 = " AND";
}elseif ($azcongresswhere!='' && $whereages!='') {
	$and1 = " AND";
}else{
	$and1 = '';
}

if ($statelegwhere!='' && $elemschooldistrictwhere!='') {
	$and2 = " AND";
}elseif ($statelegwhere!='' && $unionschooldistrictwhere!='') {
	$and2 = " AND";
}elseif ($statelegwhere!='' && $citieswhere!='') {
	$and2 = " AND";
}elseif ($statelegwhere!='' && $whereactivity!='') {
	$and2 = " AND";
}elseif ($statelegwhere!='' && $whereages!='') {
	$and2 = " AND";
}else{
	$and2 = '';
}

if ($elemschooldistrictwhere!='' && $unionschooldistrictwhere!='') {
	$and3 = " AND";
}elseif ($elemschooldistrictwhere!='' && $citieswhere!='') {
	$and3 = " AND";
}elseif ($elemschooldistrictwhere!='' && $whereactivity!='') {
	$and3 = " AND";
}elseif ($elemschooldistrictwhere!='' && $whereages!='') {
	$and3 = " AND";
}else{
	$and3 = '';
}

if ($unionschooldistrictwhere!='' && $citieswhere!='') {
	$and4 = " AND";
}elseif ($unionschooldistrictwhere!='' && $whereactivity!='') {
	$and4 = " AND";
}elseif ($unionschooldistrictwhere!='' && $whereages!='') {
	$and4 = " AND";
}else{
	$and4 = '';
}

if ($citieswhere!='' && $whereactivity!='') {
	$and5 = " AND";
}elseif ($citieswhere!='' && $whereages!='') {
	$and5 = " AND";
}else{
	$and5 = '';
}

if ($whereactivity!='' && $whereages!='') {
	$and6 = " AND";
}else{
	$and6 = '';
}
?>
