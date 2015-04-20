<?php
// this library formats age5 - age18 into human readable age ranges


// format ages served
$agesserved5 = '';
$agesserved6 = '';
$agesserved7 = '';
$agesserved8 = '';
$agesserved9 = '';
$agesserved10 = '';
$agesserved11 = '';
$agesserved12 = '';
$agesserved13 = '';
$agesserved14 = '';
$agesserved15 = '';
$agesserved16 = '';
$agesserved17 = '';
$agesserved18 = '';
$spread6 = 0;
$spread7 = 0;
$spread8 = 0;
$spread9 = 0;
$spread10 = 0;
$spread11 = 0;
$spread12 = 0;
$spread13 = 0;
$spread14 = 0;
$spread15 = 0;
$spread16 = 0;
$spread17 = 0;
$spread18 = 0;


if ($age5=='t' && $age6=='t' && $age7=='t' && $age8=='t' && $age9=='t' && $age10=='t' && $age11=='t' && $age12=='t' && $age13=='t' && $age14=='t' && $age15=='t' && $age16=='t' && $age17=='t' && $age18=='t') {
	$agesserved5 = '5-18';
	$spread18 = 1;
}elseif ($age5=='t' && $age6=='t' && $age7=='t' && $age8=='t' && $age9=='t' && $age10=='t' && $age11=='t' && $age12=='t' && $age13=='t' && $age14=='t' && $age15=='t' && $age16=='t' && $age17=='t') {
	$agesserved5 = '5-17';
	$spread17 = 1;
}elseif ($age5=='t' && $age6=='t' && $age7=='t' && $age8=='t' && $age9=='t' && $age10=='t' && $age11=='t' && $age12=='t' && $age13=='t' && $age14=='t' && $age15=='t' && $age16=='t') {
	$agesserved5 = '5-16';
	$spread16 = 1;
}elseif ($age5=='t' && $age6=='t' && $age7=='t' && $age8=='t' && $age9=='t' && $age10=='t' && $age11=='t' && $age12=='t' && $age13=='t' && $age14=='t' && $age15=='t') {
	$agesserved5 = '5-15';
	$spread15 = 1;
}elseif ($age5=='t' && $age6=='t' && $age7=='t' && $age8=='t' && $age9=='t' && $age10=='t' && $age11=='t' && $age12=='t' && $age13=='t' && $age14=='t') {
	$agesserved5 = '5-14';
	$spread14 = 1;
}elseif ($age5=='t' && $age6=='t' && $age7=='t' && $age8=='t' && $age9=='t' && $age10=='t' && $age11=='t' && $age12=='t' && $age13=='t') {
	$agesserved5 = '5-13';
	$spread13 = 1;
}elseif ($age5=='t' && $age6=='t' && $age7=='t' && $age8=='t' && $age9=='t' && $age10=='t' && $age11=='t' && $age12=='t') {
	$agesserved5 = '5-12';
	$spread12 = 1;
}elseif ($age5=='t' && $age6=='t' && $age7=='t' && $age8=='t' && $age9=='t' && $age10=='t' && $age11=='t') {
	$agesserved5 = '5-11';
	$spread11 = 1;
}elseif ($age5=='t' && $age6=='t' && $age7=='t' && $age8=='t' && $age9=='t' && $age10=='t') {
	$agesserved5 = '5-10';
	$spread10 = 1;
}elseif ($age5=='t' && $age6=='t' && $age7=='t' && $age8=='t' && $age9=='t') {
	$agesserved5 = '5-9';
	$spread9 = 1;
}elseif ($age5=='t' && $age6=='t' && $age7=='t' && $age8=='t') {
	$agesserved5 = '5-8';
	$spread8 = 1;
}elseif ($age5=='t' && $age6=='t' && $age7=='t') {
	$agesserved5 = '5-7';
	$spread7 = 1;
}elseif ($age5=='t' && $age6=='t') {
	$agesserved5 = '5-6';
	$spread6 = 1;
}elseif ($age5=='t') {
	$agesserved5 = '5';
}else{}

if (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0 && $spread9==0 && $spread8==0 && $spread7==0 && $spread6==0) && $age6=='t' && $age7=='t' && $age8=='t' && $age9=='t' && $age10=='t' && $age11=='t' && $age12=='t' && $age13=='t' && $age14=='t' && $age15=='t' && $age16=='t' && $age17=='t' && $age18=='t') {
	$agesserved6 = '6-18';
	$spread18 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0 && $spread9==0 && $spread8==0 && $spread7==0 && $spread6==0) && $age6=='t' && $age7=='t' && $age8=='t' && $age9=='t' && $age10=='t' && $age11=='t' && $age12=='t' && $age13=='t' && $age14=='t' && $age15=='t' && $age16=='t' && $age17=='t') {
	$agesserved6 = '6-17';
	$spread17 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0 && $spread9==0 && $spread8==0 && $spread7==0 && $spread6==0) && $age6=='t' && $age7=='t' && $age8=='t' && $age9=='t' && $age10=='t' && $age11=='t' && $age12=='t' && $age13=='t' && $age14=='t' && $age15=='t' && $age16=='t') {
	$agesserved6 = '6-16';
	$spread16 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0 && $spread9==0 && $spread8==0 && $spread7==0 && $spread6==0) && $age6=='t' && $age7=='t' && $age8=='t' && $age9=='t' && $age10=='t' && $age11=='t' && $age12=='t' && $age13=='t' && $age14=='t' && $age15=='t') {
	$agesserved6 = '6-15';
	$spread15 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0 && $spread9==0 && $spread8==0 && $spread7==0 && $spread6==0) && $age6=='t' && $age7=='t' && $age8=='t' && $age9=='t' && $age10=='t' && $age11=='t' && $age12=='t' && $age13=='t' && $age14=='t') {
	$agesserved6 = '6-14';
	$spread14 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0 && $spread9==0 && $spread8==0 && $spread7==0 && $spread6==0) && $age6=='t' && $age7=='t' && $age8=='t' && $age9=='t' && $age10=='t' && $age11=='t' && $age12=='t' && $age13=='t') {
	$agesserved6 = '6-13';
	$spread13 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0 && $spread9==0 && $spread8==0 && $spread7==0 && $spread6==0) && $age6=='t' && $age7=='t' && $age8=='t' && $age9=='t' && $age10=='t' && $age11=='t' && $age12=='t') {
	$agesserved6 = '6-12';
	$spread12 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0 && $spread9==0 && $spread8==0 && $spread7==0 && $spread6==0) && $age6=='t' && $age7=='t' && $age8=='t' && $age9=='t' && $age10=='t' && $age11=='t') {
	$agesserved6 = '6-11';
	$spread11 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0 && $spread9==0 && $spread8==0 && $spread7==0 && $spread6==0) && $age6=='t' && $age7=='t' && $age8=='t' && $age9=='t' && $age10=='t') {
	$agesserved6 = '6-10';
	$spread10 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0 && $spread9==0 && $spread8==0 && $spread7==0 && $spread6==0) && $age6=='t' && $age7=='t' && $age8=='t' && $age9=='t') {
	$agesserved6 = '6-9';
	$spread9 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0 && $spread9==0 && $spread8==0 && $spread7==0 && $spread6==0) && $age6=='t' && $age7=='t' && $age8=='t') {
	$agesserved6 = '6-8';
	$spread8 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0 && $spread9==0 && $spread8==0 && $spread7==0 && $spread6==0) && $age6=='t' && $age7=='t') {
	$agesserved6 = '6-7';
	$spread7 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0 && $spread9==0 && $spread8==0 && $spread7==0 && $spread6==0) && $age6=='t') {
	$agesserved6 = '6';
}else{}

if (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0 && $spread9==0 && $spread8==0 && $spread7==0) && $age7=='t' && $age8=='t' && $age9=='t' && $age10=='t' && $age11=='t' && $age12=='t' && $age13=='t' && $age14=='t' && $age15=='t' && $age16=='t' && $age17=='t' && $age18=='t') {
	$agesserved7 = '7-18';
	$spread18 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0 && $spread9==0 && $spread8==0 && $spread7==0) && $age7=='t' && $age8=='t' && $age9=='t' && $age10=='t' && $age11=='t' && $age12=='t' && $age13=='t' && $age14=='t' && $age15=='t' && $age16=='t' && $age17=='t') {
	$agesserved7 = '7-17';
	$spread17 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0 && $spread9==0 && $spread8==0 && $spread7==0) && $age7=='t' && $age8=='t' && $age9=='t' && $age10=='t' && $age11=='t' && $age12=='t' && $age13=='t' && $age14=='t' && $age15=='t' && $age16=='t') {
	$agesserved7 = '7-16';
	$spread16 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0 && $spread9==0 && $spread8==0 && $spread7==0) && $age7=='t' && $age8=='t' && $age9=='t' && $age10=='t' && $age11=='t' && $age12=='t' && $age13=='t' && $age14=='t' && $age15=='t') {
	$agesserved7 = '7-15';
	$spread15 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0 && $spread9==0 && $spread8==0 && $spread7==0) && $age7=='t' && $age8=='t' && $age9=='t' && $age10=='t' && $age11=='t' && $age12=='t' && $age13=='t' && $age14=='t') {
	$agesserved7 = '7-14';
	$spread14 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0 && $spread9==0 && $spread8==0 && $spread7==0) && $age7=='t' && $age8=='t' && $age9=='t' && $age10=='t' && $age11=='t' && $age12=='t' && $age13=='t') {
	$agesserved7 = '7-13';
	$spread13 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0 && $spread9==0 && $spread8==0 && $spread7==0) && $age7=='t' && $age8=='t' && $age9=='t' && $age10=='t' && $age11=='t' && $age12=='t') {
	$agesserved7 = '7-12';
	$spread12 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0 && $spread9==0 && $spread8==0 && $spread7==0) && $age7=='t' && $age8=='t' && $age9=='t' && $age10=='t' && $age11=='t') {
	$agesserved7 = '7-11';
	$spread11 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0 && $spread9==0 && $spread8==0 && $spread7==0) && $age7=='t' && $age8=='t' && $age9=='t' && $age10=='t') {
	$agesserved7 = '7-10';
	$spread10 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0 && $spread9==0 && $spread8==0 && $spread7==0) && $age7=='t' && $age8=='t' && $age9=='t') {
	$agesserved7 = '7-9';
	$spread9 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0 && $spread9==0 && $spread8==0 && $spread7==0) && $age7=='t' && $age8=='t') {
	$agesserved7 = '7-8';
	$spread8 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0 && $spread9==0 && $spread8==0 && $spread7==0) && $age7=='t') {
	$agesserved7 = '7';
	$spread7 = 1;
}else{}

if (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0 && $spread9==0 && $spread8==0) && $age8=='t' && $age9=='t' && $age10=='t' && $age11=='t' && $age12=='t' && $age13=='t' && $age14=='t' && $age15=='t' && $age16=='t' && $age17=='t' && $age18=='t') {
	$agesserved8 = '8-18';
	$spread18 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0 && $spread9==0 && $spread8==0) && $age8=='t' && $age9=='t' && $age10=='t' && $age11=='t' && $age12=='t' && $age13=='t' && $age14=='t' && $age15=='t' && $age16=='t' && $age17=='t') {
	$agesserved8 = '8-17';
	$spread17 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0 && $spread9==0 && $spread8==0) && $age8=='t' && $age9=='t' && $age10=='t' && $age11=='t' && $age12=='t' && $age13=='t' && $age14=='t' && $age15=='t' && $age16=='t') {
	$agesserved8 = '8-16';
	$spread16 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0 && $spread9==0 && $spread8==0) && $age8=='t' && $age9=='t' && $age10=='t' && $age11=='t' && $age12=='t' && $age13=='t' && $age14=='t' && $age15=='t') {
	$agesserved8 = '8-15';
	$spread15 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0 && $spread9==0 && $spread8==0) && $age8=='t' && $age9=='t' && $age10=='t' && $age11=='t' && $age12=='t' && $age13=='t' && $age14=='t') {
	$agesserved8 = '8-14';
	$spread14 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0 && $spread9==0 && $spread8==0) && $age8=='t' && $age9=='t' && $age10=='t' && $age11=='t' && $age12=='t' && $age13=='t') {
	$agesserved8 = '8-13';
	$spread13 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0 && $spread9==0 && $spread8==0) && $age8=='t' && $age9=='t' && $age10=='t' && $age11=='t' && $age12=='t') {
	$agesserved8 = '8-12';
	$spread12 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0 && $spread9==0 && $spread8==0) && $age8=='t' && $age9=='t' && $age10=='t' && $age11=='t') {
	$agesserved8 = '8-11';
	$spread11 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0 && $spread9==0 && $spread8==0) && $age8=='t' && $age9=='t' && $age10=='t') {
	$agesserved8 = '8-10';
	$spread10 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0 && $spread9==0 && $spread8==0) && $age8=='t' && $age9=='t') {
	$agesserved8 = '8-9';
	$spread9 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0 && $spread9==0 && $spread8==0) && $age8=='t') {
	$agesserved8 = '8';
}else{}

if (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0 && $spread9==0) && $age9=='t' && $age10=='t' && $age11=='t' && $age12=='t' && $age13=='t' && $age14=='t' && $age15=='t' && $age16=='t' && $age17=='t' && $age18=='t') {
	$agesserved9 = '9-18';
	$spread18 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0 && $spread9==0) && $age9=='t' && $age10=='t' && $age11=='t' && $age12=='t' && $age13=='t' && $age14=='t' && $age15=='t' && $age16=='t' && $age17=='t') {
	$agesserved9 = '9-17';
	$spread17 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0 && $spread9==0) && $age9=='t' && $age10=='t' && $age11=='t' && $age12=='t' && $age13=='t' && $age14=='t' && $age15=='t' && $age16=='t') {
	$agesserved9 = '9-16';
	$spread16 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0 && $spread9==0) && $age9=='t' && $age10=='t' && $age11=='t' && $age12=='t' && $age13=='t' && $age14=='t' && $age15=='t') {
	$agesserved9 = '9-15';
	$spread15 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0 && $spread9==0) && $age9=='t' && $age10=='t' && $age11=='t' && $age12=='t' && $age13=='t' && $age14=='t') {
	$agesserved9 = '9-14';
	$spread14 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0 && $spread9==0) && $age9=='t' && $age10=='t' && $age11=='t' && $age12=='t' && $age13=='t') {
	$agesserved9 = '9-13';
	$spread13 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0 && $spread9==0) && $age9=='t' && $age10=='t' && $age11=='t' && $age12=='t') {
	$agesserved9 = '9-12';
	$spread12 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0 && $spread9==0) && $age9=='t' && $age10=='t' && $age11=='t') {
	$agesserved9 = '9-11';
	$spread11 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0 && $spread9==0) && $age9=='t' && $age10=='t') {
	$agesserved9 = '9-10';
	$spread10 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0 && $spread9==0) && $age9=='t') {
	$agesserved9 = '9';
}else{}

if (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0) && $age10=='t' && $age11=='t' && $age12=='t' && $age13=='t' && $age14=='t' && $age15=='t' && $age16=='t' && $age17=='t' && $age18=='t') {
	$agesserved10 = '10-18';
	$spread18 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0) && $age10=='t' && $age11=='t' && $age12=='t' && $age13=='t' && $age14=='t' && $age15=='t' && $age16=='t' && $age17=='t') {
	$agesserved10 = '10-17';
	$spread17 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0) && $age10=='t' && $age11=='t' && $age12=='t' && $age13=='t' && $age14=='t' && $age15=='t' && $age16=='t') {
	$agesserved10 = '10-16';
	$spread16 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0) && $age10=='t' && $age11=='t' && $age12=='t' && $age13=='t' && $age14=='t' && $age15=='t') {
	$agesserved10 = '10-15';
	$spread15 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0) && $age10=='t' && $age11=='t' && $age12=='t' && $age13=='t' && $age14=='t') {
	$agesserved10 = '10-14';
	$spread14 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0) && $age10=='t' && $age11=='t' && $age12=='t' && $age13=='t') {
	$agesserved10 = '10-13';
	$spread13 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0) && $age10=='t' && $age11=='t' && $age12=='t') {
	$agesserved10 = '10-12';
	$spread12 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0) && $age10=='t' && $age11=='t') {
	$agesserved10 = '10-11';
	$spread11 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0 && $spread10==0) && $age10=='t') {
	$agesserved10 = '10-10';
}else{}

if (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0) && $age11=='t' && $age12=='t' && $age13=='t' && $age14=='t' && $age15=='t' && $age16=='t' && $age17=='t' && $age18=='t') {
	$agesserved11 = '11-18';
	$spread18 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0) && $age11=='t' && $age12=='t' && $age13=='t' && $age14=='t' && $age15=='t' && $age16=='t' && $age17=='t') {
	$agesserved11 = '11-17';
	$spread17 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0) && $age11=='t' && $age12=='t' && $age13=='t' && $age14=='t' && $age15=='t' && $age16=='t') {
	$agesserved11 = '11-16';
	$spread16 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0) && $age11=='t' && $age12=='t' && $age13=='t' && $age14=='t' && $age15=='t') {
	$agesserved11 = '11-15';
	$spread15 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0) && $age11=='t' && $age12=='t' && $age13=='t' && $age14=='t') {
	$agesserved11 = '11-14';
	$spread14 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0) && $age11=='t' && $age12=='t' && $age13=='t') {
	$agesserved11 = '11-13';
	$spread13 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0) && $age11=='t' && $age12=='t') {
	$agesserved11 = '11-12';
	$spread12 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0 && $spread11==0) && $age11=='t') {
	$agesserved11 = '11';
}else{}

if (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0) && $age12=='t' && $age13=='t' && $age14=='t' && $age15=='t' && $age16=='t' && $age17=='t' && $age18=='t') {
	$agesserved12 = '12-18';
	$spread18 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0) && $age12=='t' && $age13=='t' && $age14=='t' && $age15=='t' && $age16=='t' && $age17=='t') {
	$agesserved12 = '12-17';
	$spread17 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0) && $age12=='t' && $age13=='t' && $age14=='t' && $age15=='t' && $age16=='t') {
	$agesserved12 = '12-16';
	$spread16 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0) && $age12=='t' && $age13=='t' && $age14=='t' && $age15=='t') {
	$agesserved12 = '12-15';
	$spread15 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0) && $age12=='t' && $age13=='t' && $age14=='t') {
	$agesserved12 = '12-14';
	$spread14 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0) && $age12=='t' && $age13=='t') {
	$agesserved12 = '12-13';
	$spread13 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0 && $spread12==0) && $age12=='t') {
	$agesserved12 = '12';
}else{}

if (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0) && $age13=='t' && $age14=='t' && $age15=='t' && $age16=='t' && $age17=='t' && $age18=='t') {
	$agesserved13 = '13-18';
	$spread18 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0) && $age13=='t' && $age14=='t' && $age15=='t' && $age16=='t' && $age17=='t') {
	$agesserved13 = '13-17';
	$spread17 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0) && $age13=='t' && $age14=='t' && $age15=='t' && $age16=='t') {
	$agesserved13 = '13-16';
	$spread16 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0) && $age13=='t' && $age14=='t' && $age15=='t') {
	$agesserved13 = '13-15';
	$spread15 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0) && $age13=='t' && $age14=='t') {
	$agesserved13 = '13-14';
	$spread14 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0 && $spread13==0) && $age13=='t') {
	$agesserved13 = '13';
}else{}

if (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0) && $age14=='t' && $age15=='t' && $age16=='t' && $age17=='t' && $age18=='t') {
	$agesserved14 = '14-18';
	$spread18 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0) && $age14=='t' && $age15=='t' && $age16=='t' && $age17=='t') {
	$agesserved14 = '14-17';
	$spread17 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0) && $age14=='t' && $age15=='t' && $age16=='t') {
	$agesserved14 = '14-16';
	$spread16 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0) && $age14=='t' && $age15=='t') {
	$agesserved14 = '14-15';
	$spread15 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0 && $spread14==0) && $age14=='t') {
	$agesserved14 = '14';
}else{}

if (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0) && $age15=='t' && $age16=='t' && $age17=='t' && $age18=='t') {
	$agesserved15 = '15-18';
	$spread18 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0) && $age15=='t' && $age16=='t' && $age17=='t') {
	$agesserved15 = '15-17';
	$spread17 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0) && $age15=='t' && $age16=='t') {
	$agesserved15 = '15-16';
	$spread16 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0 && $spread15==0) && $age15=='t') {
	$agesserved15 = '15';
}else{}

if (($spread18==0 && $spread17==0 && $spread16==0) && $age16=='t' && $age17=='t' && $age18=='t') {
	$agesserved16 = '16-18';
	$spread18 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0) && $age16=='t' && $age17=='t') {
	$agesserved16 = '16-17';
	$spread17 = 1;
}elseif (($spread18==0 && $spread17==0 && $spread16==0) && $age16=='t') {
	$agesserved16 = '16';
}else{}

if (($spread18==0 && $spread17==0) && $age17=='t' && $age18=='t') {
	$agesserved17 = '17-18';
	$spread18 = 1;
}elseif (($spread18==0 && $spread17==0) && $age17=='t') {
	$agesserved17 = '17';
}else{}

if ($spread18==0 && $age18=='t') {
	$agesserved18 = '18';
}else{}


if ($agesserved5<>'' && $agesserved6<>'') {
	$semi1 = '; ';
}elseif ($agesserved5<>'' && $agesserved7<>'') {
	$semi1 = '; ';
}elseif ($agesserved5<>'' && $agesserved8<>'') {
	$semi1 = '; ';
}elseif ($agesserved5<>'' && $agesserved9<>'') {
	$semi1 = '; ';
}elseif ($agesserved5<>'' && $agesserved10<>'') {
	$semi1 = '; ';
}elseif ($agesserved5<>'' && $agesserved11<>'') {
	$semi1 = '; ';
}elseif ($agesserved5<>'' && $agesserved12<>'') {
	$semi1 = '; ';
}elseif ($agesserved5<>'' && $agesserved13<>'') {
	$semi1 = '; ';
}elseif ($agesserved5<>'' && $agesserved14<>'') {
	$semi1 = '; ';
}elseif ($agesserved5<>'' && $agesserved15<>'') {
	$semi1 = '; ';
}elseif ($agesserved5<>'' && $agesserved16<>'') {
	$semi1 = '; ';
}elseif ($agesserved5<>'' && $agesserved17<>'') {
	$semi1 = '; ';
}elseif ($agesserved5<>'' && $agesserved18<>'') {
	$semi1 = '; ';
}else{
	$semi1 = '';
}

if ($agesserved6<>'' && $agesserved7<>'') {
	$semi2 = '; ';
}elseif ($agesserved6<>'' && $agesserved8<>'') {
	$semi2 = '; ';
}elseif ($agesserved6<>'' && $agesserved9<>'') {
	$semi2 = '; ';
}elseif ($agesserved6<>'' && $agesserved10<>'') {
	$semi2 = '; ';
}elseif ($agesserved6<>'' && $agesserved11<>'') {
	$semi2 = '; ';
}elseif ($agesserved6<>'' && $agesserved12<>'') {
	$semi2 = '; ';
}elseif ($agesserved6<>'' && $agesserved13<>'') {
	$semi2 = '; ';
}elseif ($agesserved6<>'' && $agesserved14<>'') {
	$semi2 = '; ';
}elseif ($agesserved6<>'' && $agesserved15<>'') {
	$semi2 = '; ';
}elseif ($agesserved6<>'' && $agesserved16<>'') {
	$semi2 = '; ';
}elseif ($agesserved6<>'' && $agesserved17<>'') {
	$semi2 = '; ';
}elseif ($agesserved6<>'' && $agesserved18<>'') {
	$semi2 = '; ';
}else{
	$semi2 = '';
}

if ($agesserved7<>'' && $agesserved8<>'') {
	$semi3 = '; ';
}elseif ($agesserved7<>'' && $agesserved9<>'') {
	$semi3 = '; ';
}elseif ($agesserved7<>'' && $agesserved10<>'') {
	$semi3 = '; ';
}elseif ($agesserved7<>'' && $agesserved11<>'') {
	$semi3 = '; ';
}elseif ($agesserved7<>'' && $agesserved12<>'') {
	$semi3 = '; ';
}elseif ($agesserved7<>'' && $agesserved13<>'') {
	$semi3 = '; ';
}elseif ($agesserved7<>'' && $agesserved14<>'') {
	$semi3 = '; ';
}elseif ($agesserved7<>'' && $agesserved15<>'') {
	$semi3 = '; ';
}elseif ($agesserved7<>'' && $agesserved16<>'') {
	$semi3 = '; ';
}elseif ($agesserved7<>'' && $agesserved17<>'') {
	$semi3 = '; ';
}elseif ($agesserved7<>'' && $agesserved18<>'') {
	$semi3 = '; ';
}else{
	$semi3 = '';
}

if ($agesserved8<>'' && $agesserved9<>'') {
	$semi4 = '; ';
}elseif ($agesserved8<>'' && $agesserved10<>'') {
	$semi4 = '; ';
}elseif ($agesserved8<>'' && $agesserved11<>'') {
	$semi4 = '; ';
}elseif ($agesserved8<>'' && $agesserved12<>'') {
	$semi4 = '; ';
}elseif ($agesserved8<>'' && $agesserved13<>'') {
	$semi4 = '; ';
}elseif ($agesserved8<>'' && $agesserved14<>'') {
	$semi4 = '; ';
}elseif ($agesserved8<>'' && $agesserved15<>'') {
	$semi4 = '; ';
}elseif ($agesserved8<>'' && $agesserved16<>'') {
	$semi4 = '; ';
}elseif ($agesserved8<>'' && $agesserved17<>'') {
	$semi4 = '; ';
}elseif ($agesserved8<>'' && $agesserved18<>'') {
	$semi4 = '; ';
}else{
	$semi4 = '';
}

if ($agesserved9<>'' && $agesserved10<>'') {
	$semi5 = '; ';
}elseif ($agesserved9<>'' && $agesserved11<>'') {
	$semi5 = '; ';
}elseif ($agesserved9<>'' && $agesserved12<>'') {
	$semi5 = '; ';
}elseif ($agesserved9<>'' && $agesserved13<>'') {
	$semi5 = '; ';
}elseif ($agesserved9<>'' && $agesserved14<>'') {
	$semi5 = '; ';
}elseif ($agesserved9<>'' && $agesserved15<>'') {
	$semi5 = '; ';
}elseif ($agesserved9<>'' && $agesserved16<>'') {
	$semi5 = '; ';
}elseif ($agesserved9<>'' && $agesserved17<>'') {
	$semi5 = '; ';
}elseif ($agesserved9<>'' && $agesserved18<>'') {
	$semi5 = '; ';
}else{
	$semi5 = '';
}

if ($agesserved10<>'' && $agesserved11<>'') {
	$semi6 = '; ';
}elseif ($agesserved10<>'' && $agesserved12<>'') {
	$semi6 = '; ';
}elseif ($agesserved10<>'' && $agesserved13<>'') {
	$semi6 = '; ';
}elseif ($agesserved10<>'' && $agesserved14<>'') {
	$semi6 = '; ';
}elseif ($agesserved10<>'' && $agesserved15<>'') {
	$semi6 = '; ';
}elseif ($agesserved10<>'' && $agesserved16<>'') {
	$semi6 = '; ';
}elseif ($agesserved10<>'' && $agesserved17<>'') {
	$semi6 = '; ';
}elseif ($agesserved10<>'' && $agesserved18<>'') {
	$semi6 = '; ';
}else{
	$semi6 = '';
}

if ($agesserved11<>'' && $agesserved12<>'') {
	$semi7 = '; ';
}elseif ($agesserved11<>'' && $agesserved13<>'') {
	$semi7 = '; ';
}elseif ($agesserved11<>'' && $agesserved14<>'') {
	$semi7 = '; ';
}elseif ($agesserved11<>'' && $agesserved15<>'') {
	$semi7 = '; ';
}elseif ($agesserved11<>'' && $agesserved16<>'') {
	$semi7 = '; ';
}elseif ($agesserved11<>'' && $agesserved17<>'') {
	$semi7 = '; ';
}elseif ($agesserved11<>'' && $agesserved18<>'') {
	$semi7 = '; ';
}else{
	$semi7 = '';
}

if ($agesserved12<>'' && $agesserved13<>'') {
	$semi8 = '; ';
}elseif ($agesserved12<>'' && $agesserved14<>'') {
	$semi8 = '; ';
}elseif ($agesserved12<>'' && $agesserved15<>'') {
	$semi8 = '; ';
}elseif ($agesserved12<>'' && $agesserved16<>'') {
	$semi8 = '; ';
}elseif ($agesserved12<>'' && $agesserved17<>'') {
	$semi8 = '; ';
}elseif ($agesserved12<>'' && $agesserved18<>'') {
	$semi8 = '; ';
}else{
	$semi8 = '';
}

if ($agesserved13<>'' && $agesserved14<>'') {
	$semi9 = '; ';
}elseif ($agesserved13<>'' && $agesserved15<>'') {
	$semi9 = '; ';
}elseif ($agesserved13<>'' && $agesserved16<>'') {
	$semi9 = '; ';
}elseif ($agesserved13<>'' && $agesserved17<>'') {
	$semi9 = '; ';
}elseif ($agesserved13<>'' && $agesserved18<>'') {
	$semi9 = '; ';
}else{
	$semi9 = '';
}

if ($agesserved14<>'' && $agesserved15<>'') {
	$semi10 = '; ';
}elseif ($agesserved14<>'' && $agesserved16<>'') {
	$semi10 = '; ';
}elseif ($agesserved14<>'' && $agesserved17<>'') {
	$semi10 = '; ';
}elseif ($agesserved14<>'' && $agesserved18<>'') {
	$semi10 = '; ';
}else{
	$semi10 = '';
}

if ($agesserved15<>'' && $agesserved16<>'') {
	$semi11 = '; ';
}elseif ($agesserved15<>'' && $agesserved17<>'') {
	$semi11 = '; ';
}elseif ($agesserved15<>'' && $agesserved18<>'') {
	$semi11 = '; ';
}else{
	$semi11 = '';
}

if ($agesserved16<>'' && $agesserved17<>'') {
	$semi12 = '; ';
}elseif ($agesserved16<>'' && $agesserved18<>'') {
	$semi12 = '; ';
}else{
	$semi12 = '';
}

if ($agesserved17<>'' && $agesserved18<>'') {
	$semi13 = '; ';
}else{
	$semi13 = '';
}

// put all the age ranges together
$agesserved = $agesserved5 . $semi1 . $agesserved6 . $semi2  . $agesserved7 . $semi3 . $agesserved8 . $semi4 . $agesserved9 . $semi5 . $agesserved10 . $semi6 . $agesserved11 . $semi7 . $agesserved12 . $semi8 . $agesserved13 . $semi9 . $agesserved14 . $semi10 . $agesserved15 . $semi11 . $agesserved16 . $semi12 . $agesserved17 . $semi13 . $agesserved18;

?>
