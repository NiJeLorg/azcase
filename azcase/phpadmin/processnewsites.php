<?php
session_start(); 

// connect to database
require("connect.php");


// set updated
$updated = date('Y-m-d H:i:s');

// get user id to add to these sites
$userid = $_REQUEST['userid'];

// store data passed
$sitename1 = stripslashes($_REQUEST['sitename1']);
$sitename2 = stripslashes($_REQUEST['sitename2']);
$sitename3 = stripslashes($_REQUEST['sitename3']);
$sitename4 = stripslashes($_REQUEST['sitename4']);
$sitename5 = stripslashes($_REQUEST['sitename5']);
$sitename6 = stripslashes($_REQUEST['sitename6']);
$sitename7 = stripslashes($_REQUEST['sitename7']);
$sitename8 = stripslashes($_REQUEST['sitename8']);
$sitename9 = stripslashes($_REQUEST['sitename9']);
$sitename10 = stripslashes($_REQUEST['sitename10']);
$sitename11 = stripslashes($_REQUEST['sitename11']);
$sitename12 = stripslashes($_REQUEST['sitename12']);
$sitename13 = stripslashes($_REQUEST['sitename13']);
$sitename14 = stripslashes($_REQUEST['sitename14']);
$sitename15 = stripslashes($_REQUEST['sitename15']);
$sitename16 = stripslashes($_REQUEST['sitename16']);
$sitename17 = stripslashes($_REQUEST['sitename17']);
$sitename18 = stripslashes($_REQUEST['sitename18']);
$sitename19 = stripslashes($_REQUEST['sitename19']);
$sitename20 = stripslashes($_REQUEST['sitename20']);
$sitename21 = stripslashes($_REQUEST['sitename21']);
$sitename22 = stripslashes($_REQUEST['sitename22']);
$sitename23 = stripslashes($_REQUEST['sitename23']);
$sitename24 = stripslashes($_REQUEST['sitename24']);
$sitename25 = stripslashes($_REQUEST['sitename25']);
$sitename26 = stripslashes($_REQUEST['sitename26']);
$sitename27 = stripslashes($_REQUEST['sitename27']);
$sitename28 = stripslashes($_REQUEST['sitename28']);
$sitename29 = stripslashes($_REQUEST['sitename29']);
$sitename30 = stripslashes($_REQUEST['sitename30']);

$sitename1 = pg_escape_string($sitename1);
$sitename2 = pg_escape_string($sitename2);
$sitename3 = pg_escape_string($sitename3);
$sitename4 = pg_escape_string($sitename4);
$sitename5 = pg_escape_string($sitename5);
$sitename6 = pg_escape_string($sitename6);
$sitename7 = pg_escape_string($sitename7);
$sitename8 = pg_escape_string($sitename8);
$sitename9 = pg_escape_string($sitename9);
$sitename10 = pg_escape_string($sitename10);
$sitename11 = pg_escape_string($sitename11);
$sitename12 = pg_escape_string($sitename12);
$sitename13 = pg_escape_string($sitename13);
$sitename14 = pg_escape_string($sitename14);
$sitename15 = pg_escape_string($sitename15);
$sitename16 = pg_escape_string($sitename16);
$sitename17 = pg_escape_string($sitename17);
$sitename18 = pg_escape_string($sitename18);
$sitename19 = pg_escape_string($sitename19);
$sitename20 = pg_escape_string($sitename20);
$sitename21 = pg_escape_string($sitename21);
$sitename22 = pg_escape_string($sitename22);
$sitename23 = pg_escape_string($sitename23);
$sitename24 = pg_escape_string($sitename24);
$sitename25 = pg_escape_string($sitename25);
$sitename26 = pg_escape_string($sitename26);
$sitename27 = pg_escape_string($sitename27);
$sitename28 = pg_escape_string($sitename28);
$sitename29 = pg_escape_string($sitename29);
$sitename30 = pg_escape_string($sitename30);

$sitenamesp1 = stripslashes($_REQUEST['sitenamesp1']);
$sitenamesp2 = stripslashes($_REQUEST['sitenamesp2']);
$sitenamesp3 = stripslashes($_REQUEST['sitenamesp3']);
$sitenamesp4 = stripslashes($_REQUEST['sitenamesp4']);
$sitenamesp5 = stripslashes($_REQUEST['sitenamesp5']);
$sitenamesp6 = stripslashes($_REQUEST['sitenamesp6']);
$sitenamesp7 = stripslashes($_REQUEST['sitenamesp7']);
$sitenamesp8 = stripslashes($_REQUEST['sitenamesp8']);
$sitenamesp9 = stripslashes($_REQUEST['sitenamesp9']);
$sitenamesp10 = stripslashes($_REQUEST['sitenamesp10']);
$sitenamesp11 = stripslashes($_REQUEST['sitenamesp11']);
$sitenamesp12 = stripslashes($_REQUEST['sitenamesp12']);
$sitenamesp13 = stripslashes($_REQUEST['sitenamesp13']);
$sitenamesp14 = stripslashes($_REQUEST['sitenamesp14']);
$sitenamesp15 = stripslashes($_REQUEST['sitenamesp15']);
$sitenamesp16 = stripslashes($_REQUEST['sitenamesp16']);
$sitenamesp17 = stripslashes($_REQUEST['sitenamesp17']);
$sitenamesp18 = stripslashes($_REQUEST['sitenamesp18']);
$sitenamesp19 = stripslashes($_REQUEST['sitenamesp19']);
$sitenamesp20 = stripslashes($_REQUEST['sitenamesp20']);
$sitenamesp21 = stripslashes($_REQUEST['sitenamesp21']);
$sitenamesp22 = stripslashes($_REQUEST['sitenamesp22']);
$sitenamesp23 = stripslashes($_REQUEST['sitenamesp23']);
$sitenamesp24 = stripslashes($_REQUEST['sitenamesp24']);
$sitenamesp25 = stripslashes($_REQUEST['sitenamesp25']);
$sitenamesp26 = stripslashes($_REQUEST['sitenamesp26']);
$sitenamesp27 = stripslashes($_REQUEST['sitenamesp27']);
$sitenamesp28 = stripslashes($_REQUEST['sitenamesp28']);
$sitenamesp29 = stripslashes($_REQUEST['sitenamesp29']);
$sitenamesp30 = stripslashes($_REQUEST['sitenamesp30']);

$sitenamesp1 = pg_escape_string($sitenamesp1);
$sitenamesp2 = pg_escape_string($sitenamesp2);
$sitenamesp3 = pg_escape_string($sitenamesp3);
$sitenamesp4 = pg_escape_string($sitenamesp4);
$sitenamesp5 = pg_escape_string($sitenamesp5);
$sitenamesp6 = pg_escape_string($sitenamesp6);
$sitenamesp7 = pg_escape_string($sitenamesp7);
$sitenamesp8 = pg_escape_string($sitenamesp8);
$sitenamesp9 = pg_escape_string($sitenamesp9);
$sitenamesp10 = pg_escape_string($sitenamesp10);
$sitenamesp11 = pg_escape_string($sitenamesp11);
$sitenamesp12 = pg_escape_string($sitenamesp12);
$sitenamesp13 = pg_escape_string($sitenamesp13);
$sitenamesp14 = pg_escape_string($sitenamesp14);
$sitenamesp15 = pg_escape_string($sitenamesp15);
$sitenamesp16 = pg_escape_string($sitenamesp16);
$sitenamesp17 = pg_escape_string($sitenamesp17);
$sitenamesp18 = pg_escape_string($sitenamesp18);
$sitenamesp19 = pg_escape_string($sitenamesp19);
$sitenamesp20 = pg_escape_string($sitenamesp20);
$sitenamesp21 = pg_escape_string($sitenamesp21);
$sitenamesp22 = pg_escape_string($sitenamesp22);
$sitenamesp23 = pg_escape_string($sitenamesp23);
$sitenamesp24 = pg_escape_string($sitenamesp24);
$sitenamesp25 = pg_escape_string($sitenamesp25);
$sitenamesp26 = pg_escape_string($sitenamesp26);
$sitenamesp27 = pg_escape_string($sitenamesp27);
$sitenamesp28 = pg_escape_string($sitenamesp28);
$sitenamesp29 = pg_escape_string($sitenamesp29);
$sitenamesp30 = pg_escape_string($sitenamesp30);

$locationid1 = $_REQUEST['locationid1'];
$locationid2 = $_REQUEST['locationid2'];
$locationid3 = $_REQUEST['locationid3'];
$locationid4 = $_REQUEST['locationid4'];
$locationid5 = $_REQUEST['locationid5'];
$locationid6 = $_REQUEST['locationid6'];
$locationid7 = $_REQUEST['locationid7'];
$locationid8 = $_REQUEST['locationid8'];
$locationid9 = $_REQUEST['locationid9'];
$locationid10 = $_REQUEST['locationid10'];
$locationid11 = $_REQUEST['locationid11'];
$locationid12 = $_REQUEST['locationid12'];
$locationid13 = $_REQUEST['locationid13'];
$locationid14 = $_REQUEST['locationid14'];
$locationid15 = $_REQUEST['locationid15'];
$locationid16 = $_REQUEST['locationid16'];
$locationid17 = $_REQUEST['locationid17'];
$locationid18 = $_REQUEST['locationid18'];
$locationid19 = $_REQUEST['locationid19'];
$locationid20 = $_REQUEST['locationid20'];
$locationid21 = $_REQUEST['locationid21'];
$locationid22 = $_REQUEST['locationid22'];
$locationid23 = $_REQUEST['locationid23'];
$locationid24 = $_REQUEST['locationid24'];
$locationid25 = $_REQUEST['locationid25'];
$locationid26 = $_REQUEST['locationid26'];
$locationid27 = $_REQUEST['locationid27'];
$locationid28 = $_REQUEST['locationid28'];
$locationid29 = $_REQUEST['locationid29'];
$locationid30 = $_REQUEST['locationid30'];

$phone1 = stripslashes($_REQUEST['phone1']);
$phone2 = stripslashes($_REQUEST['phone2']);
$phone3 = stripslashes($_REQUEST['phone3']);
$phone4 = stripslashes($_REQUEST['phone4']);
$phone5 = stripslashes($_REQUEST['phone5']);
$phone6 = stripslashes($_REQUEST['phone6']);
$phone7 = stripslashes($_REQUEST['phone7']);
$phone8 = stripslashes($_REQUEST['phone8']);
$phone9 = stripslashes($_REQUEST['phone9']);
$phone10 = stripslashes($_REQUEST['phone10']);
$phone11 = stripslashes($_REQUEST['phone11']);
$phone12 = stripslashes($_REQUEST['phone12']);
$phone13 = stripslashes($_REQUEST['phone13']);
$phone14 = stripslashes($_REQUEST['phone14']);
$phone15 = stripslashes($_REQUEST['phone15']);
$phone16 = stripslashes($_REQUEST['phone16']);
$phone17 = stripslashes($_REQUEST['phone17']);
$phone18 = stripslashes($_REQUEST['phone18']);
$phone19 = stripslashes($_REQUEST['phone19']);
$phone20 = stripslashes($_REQUEST['phone20']);
$phone21 = stripslashes($_REQUEST['phone21']);
$phone22 = stripslashes($_REQUEST['phone22']);
$phone23 = stripslashes($_REQUEST['phone23']);
$phone24 = stripslashes($_REQUEST['phone24']);
$phone25 = stripslashes($_REQUEST['phone25']);
$phone26 = stripslashes($_REQUEST['phone26']);
$phone27 = stripslashes($_REQUEST['phone27']);
$phone28 = stripslashes($_REQUEST['phone28']);
$phone29 = stripslashes($_REQUEST['phone29']);
$phone30 = stripslashes($_REQUEST['phone30']);

$phone1 = pg_escape_string($phone1);
$phone2 = pg_escape_string($phone2);
$phone3 = pg_escape_string($phone3);
$phone4 = pg_escape_string($phone4);
$phone5 = pg_escape_string($phone5);
$phone6 = pg_escape_string($phone6);
$phone7 = pg_escape_string($phone7);
$phone8 = pg_escape_string($phone8);
$phone9 = pg_escape_string($phone9);
$phone10 = pg_escape_string($phone10);
$phone11 = pg_escape_string($phone11);
$phone12 = pg_escape_string($phone12);
$phone13 = pg_escape_string($phone13);
$phone14 = pg_escape_string($phone14);
$phone15 = pg_escape_string($phone15);
$phone16 = pg_escape_string($phone16);
$phone17 = pg_escape_string($phone17);
$phone18 = pg_escape_string($phone18);
$phone19 = pg_escape_string($phone19);
$phone20 = pg_escape_string($phone20);
$phone21 = pg_escape_string($phone21);
$phone22 = pg_escape_string($phone22);
$phone23 = pg_escape_string($phone23);
$phone24 = pg_escape_string($phone24);
$phone25 = pg_escape_string($phone25);
$phone26 = pg_escape_string($phone26);
$phone27 = pg_escape_string($phone27);
$phone28 = pg_escape_string($phone28);
$phone29 = pg_escape_string($phone29);
$phone30 = pg_escape_string($phone30);

$fax1 = stripslashes($_REQUEST['fax1']);
$fax2 = stripslashes($_REQUEST['fax2']);
$fax3 = stripslashes($_REQUEST['fax3']);
$fax4 = stripslashes($_REQUEST['fax4']);
$fax5 = stripslashes($_REQUEST['fax5']);
$fax6 = stripslashes($_REQUEST['fax6']);
$fax7 = stripslashes($_REQUEST['fax7']);
$fax8 = stripslashes($_REQUEST['fax8']);
$fax9 = stripslashes($_REQUEST['fax9']);
$fax10 = stripslashes($_REQUEST['fax10']);
$fax11 = stripslashes($_REQUEST['fax11']);
$fax12 = stripslashes($_REQUEST['fax12']);
$fax13 = stripslashes($_REQUEST['fax13']);
$fax14 = stripslashes($_REQUEST['fax14']);
$fax15 = stripslashes($_REQUEST['fax15']);
$fax16 = stripslashes($_REQUEST['fax16']);
$fax17 = stripslashes($_REQUEST['fax17']);
$fax18 = stripslashes($_REQUEST['fax18']);
$fax19 = stripslashes($_REQUEST['fax19']);
$fax20 = stripslashes($_REQUEST['fax20']);
$fax21 = stripslashes($_REQUEST['fax21']);
$fax22 = stripslashes($_REQUEST['fax22']);
$fax23 = stripslashes($_REQUEST['fax23']);
$fax24 = stripslashes($_REQUEST['fax24']);
$fax25 = stripslashes($_REQUEST['fax25']);
$fax26 = stripslashes($_REQUEST['fax26']);
$fax27 = stripslashes($_REQUEST['fax27']);
$fax28 = stripslashes($_REQUEST['fax28']);
$fax29 = stripslashes($_REQUEST['fax29']);
$fax30 = stripslashes($_REQUEST['fax30']);

$fax1 = pg_escape_string($fax1);
$fax2 = pg_escape_string($fax2);
$fax3 = pg_escape_string($fax3);
$fax4 = pg_escape_string($fax4);
$fax5 = pg_escape_string($fax5);
$fax6 = pg_escape_string($fax6);
$fax7 = pg_escape_string($fax7);
$fax8 = pg_escape_string($fax8);
$fax9 = pg_escape_string($fax9);
$fax10 = pg_escape_string($fax10);
$fax11 = pg_escape_string($fax11);
$fax12 = pg_escape_string($fax12);
$fax13 = pg_escape_string($fax13);
$fax14 = pg_escape_string($fax14);
$fax15 = pg_escape_string($fax15);
$fax16 = pg_escape_string($fax16);
$fax17 = pg_escape_string($fax17);
$fax18 = pg_escape_string($fax18);
$fax19 = pg_escape_string($fax19);
$fax20 = pg_escape_string($fax20);
$fax21 = pg_escape_string($fax21);
$fax22 = pg_escape_string($fax22);
$fax23 = pg_escape_string($fax23);
$fax24 = pg_escape_string($fax24);
$fax25 = pg_escape_string($fax25);
$fax26 = pg_escape_string($fax26);
$fax27 = pg_escape_string($fax27);
$fax28 = pg_escape_string($fax28);
$fax29 = pg_escape_string($fax29);
$fax30 = pg_escape_string($fax30);

$email1 = stripslashes($_REQUEST['email1']);
$email2 = stripslashes($_REQUEST['email2']);
$email3 = stripslashes($_REQUEST['email3']);
$email4 = stripslashes($_REQUEST['email4']);
$email5 = stripslashes($_REQUEST['email5']);
$email6 = stripslashes($_REQUEST['email6']);
$email7 = stripslashes($_REQUEST['email7']);
$email8 = stripslashes($_REQUEST['email8']);
$email9 = stripslashes($_REQUEST['email9']);
$email10 = stripslashes($_REQUEST['email10']);
$email11 = stripslashes($_REQUEST['email11']);
$email12 = stripslashes($_REQUEST['email12']);
$email13 = stripslashes($_REQUEST['email13']);
$email14 = stripslashes($_REQUEST['email14']);
$email15 = stripslashes($_REQUEST['email15']);
$email16 = stripslashes($_REQUEST['email16']);
$email17 = stripslashes($_REQUEST['email17']);
$email18 = stripslashes($_REQUEST['email18']);
$email19 = stripslashes($_REQUEST['email19']);
$email20 = stripslashes($_REQUEST['email20']);
$email21 = stripslashes($_REQUEST['email21']);
$email22 = stripslashes($_REQUEST['email22']);
$email23 = stripslashes($_REQUEST['email23']);
$email24 = stripslashes($_REQUEST['email24']);
$email25 = stripslashes($_REQUEST['email25']);
$email26 = stripslashes($_REQUEST['email26']);
$email27 = stripslashes($_REQUEST['email27']);
$email28 = stripslashes($_REQUEST['email28']);
$email29 = stripslashes($_REQUEST['email29']);
$email30 = stripslashes($_REQUEST['email30']);

$email1 = pg_escape_string($email1);
$email2 = pg_escape_string($email2);
$email3 = pg_escape_string($email3);
$email4 = pg_escape_string($email4);
$email5 = pg_escape_string($email5);
$email6 = pg_escape_string($email6);
$email7 = pg_escape_string($email7);
$email8 = pg_escape_string($email8);
$email9 = pg_escape_string($email9);
$email10 = pg_escape_string($email10);
$email11 = pg_escape_string($email11);
$email12 = pg_escape_string($email12);
$email13 = pg_escape_string($email13);
$email14 = pg_escape_string($email14);
$email15 = pg_escape_string($email15);
$email16 = pg_escape_string($email16);
$email17 = pg_escape_string($email17);
$email18 = pg_escape_string($email18);
$email19 = pg_escape_string($email19);
$email20 = pg_escape_string($email20);
$email21 = pg_escape_string($email21);
$email22 = pg_escape_string($email22);
$email23 = pg_escape_string($email23);
$email24 = pg_escape_string($email24);
$email25 = pg_escape_string($email25);
$email26 = pg_escape_string($email26);
$email27 = pg_escape_string($email27);
$email28 = pg_escape_string($email28);
$email29 = pg_escape_string($email29);
$email30 = pg_escape_string($email30);

$url1 = stripslashes($_REQUEST['url1']);
$url2 = stripslashes($_REQUEST['url2']);
$url3 = stripslashes($_REQUEST['url3']);
$url4 = stripslashes($_REQUEST['url4']);
$url5 = stripslashes($_REQUEST['url5']);
$url6 = stripslashes($_REQUEST['url6']);
$url7 = stripslashes($_REQUEST['url7']);
$url8 = stripslashes($_REQUEST['url8']);
$url9 = stripslashes($_REQUEST['url9']);
$url10 = stripslashes($_REQUEST['url10']);
$url11 = stripslashes($_REQUEST['url11']);
$url12 = stripslashes($_REQUEST['url12']);
$url13 = stripslashes($_REQUEST['url13']);
$url14 = stripslashes($_REQUEST['url14']);
$url15 = stripslashes($_REQUEST['url15']);
$url16 = stripslashes($_REQUEST['url16']);
$url17 = stripslashes($_REQUEST['url17']);
$url18 = stripslashes($_REQUEST['url18']);
$url19 = stripslashes($_REQUEST['url19']);
$url20 = stripslashes($_REQUEST['url20']);
$url21 = stripslashes($_REQUEST['url21']);
$url22 = stripslashes($_REQUEST['url22']);
$url23 = stripslashes($_REQUEST['url23']);
$url24 = stripslashes($_REQUEST['url24']);
$url25 = stripslashes($_REQUEST['url25']);
$url26 = stripslashes($_REQUEST['url26']);
$url27 = stripslashes($_REQUEST['url27']);
$url28 = stripslashes($_REQUEST['url28']);
$url29 = stripslashes($_REQUEST['url29']);
$url30 = stripslashes($_REQUEST['url30']);

$url1 = pg_escape_string($url1);
$url2 = pg_escape_string($url2);
$url3 = pg_escape_string($url3);
$url4 = pg_escape_string($url4);
$url5 = pg_escape_string($url5);
$url6 = pg_escape_string($url6);
$url7 = pg_escape_string($url7);
$url8 = pg_escape_string($url8);
$url9 = pg_escape_string($url9);
$url10 = pg_escape_string($url10);
$url11 = pg_escape_string($url11);
$url12 = pg_escape_string($url12);
$url13 = pg_escape_string($url13);
$url14 = pg_escape_string($url14);
$url15 = pg_escape_string($url15);
$url16 = pg_escape_string($url16);
$url17 = pg_escape_string($url17);
$url18 = pg_escape_string($url18);
$url19 = pg_escape_string($url19);
$url20 = pg_escape_string($url20);
$url21 = pg_escape_string($url21);
$url22 = pg_escape_string($url22);
$url23 = pg_escape_string($url23);
$url24 = pg_escape_string($url24);
$url25 = pg_escape_string($url25);
$url26 = pg_escape_string($url26);
$url27 = pg_escape_string($url27);
$url28 = pg_escape_string($url28);
$url29 = pg_escape_string($url29);
$url30 = pg_escape_string($url30);

$academic = $_REQUEST['activityacademic'];
$arts = $_REQUEST['activityarts'];
$sports = $_REQUEST['activitysports'];
$community = $_REQUEST['activitycommunity'];
$character = $_REQUEST['activitycharacter'];
$leadership = $_REQUEST['activityleadership'];
$nutrition = $_REQUEST['activitynutrition'];
$prevention = $_REQUEST['activityprevention'];
$mentoring = $_REQUEST['activitymentoring'];
$supportservices = $_REQUEST['activitysupportservices'];
$stem = $_REQUEST['activitystem'];
$college = $_REQUEST['activitycollege'];


if ($academic=="TRUE") {
}else{
	$academic = "FALSE";
}

if ($arts=="TRUE") {
}else{
	$arts = "FALSE";
}

if ($sports=="TRUE") {
}else{
	$sports = "FALSE";
}

if ($community=="TRUE") {
}else{
	$community = "FALSE";
}

if ($character=="TRUE") {
}else{
	$character = "FALSE";
}

if ($leadership=="TRUE") {
}else{
	$leadership = "FALSE";
}

if ($nutrition=="TRUE") {
}else{
	$nutrition = "FALSE";
}

if ($prevention=="TRUE") {
}else{
	$prevention = "FALSE";
}

if ($mentoring=="TRUE") {
}else{
	$mentoring = "FALSE";
}

if ($supportservices=="TRUE") {
}else{
	$supportservices = "FALSE";
}

if ($stem=="TRUE") {
}else{
	$stem = "FALSE";
}

if ($college=="TRUE") {
}else{
	$college = "FALSE";
}

$age5 = $_REQUEST['age5'];
$age6 = $_REQUEST['age6'];
$age7 = $_REQUEST['age7'];
$age8 = $_REQUEST['age8'];
$age9 = $_REQUEST['age9'];
$age10 = $_REQUEST['age10'];
$age11 = $_REQUEST['age11'];
$age12 = $_REQUEST['age12'];
$age13 = $_REQUEST['age13'];
$age14 = $_REQUEST['age14'];
$age15 = $_REQUEST['age15'];
$age16 = $_REQUEST['age16'];
$age17 = $_REQUEST['age17'];
$age18 = $_REQUEST['age18'];

if ($age5=="TRUE") {
}else{
	$age5 = "FALSE";
}

if ($age6=="TRUE") {
}else{
	$age6 = "FALSE";
}

if ($age7=="TRUE") {
}else{
	$age7 = "FALSE";
}

if ($age8=="TRUE") {
}else{
	$age8 = "FALSE";
}

if ($age9=="TRUE") {
}else{
	$age9 = "FALSE";
}

if ($age10=="TRUE") {
}else{
	$age10 = "FALSE";
}

if ($age11=="TRUE") {
}else{
	$age11 = "FALSE";
}

if ($age12=="TRUE") {
}else{
	$age12 = "FALSE";
}

if ($age13=="TRUE") {
}else{
	$age13 = "FALSE";
}

if ($age14=="TRUE") {
}else{
	$age14 = "FALSE";
}

if ($age15=="TRUE") {
}else{
	$age15 = "FALSE";
}

if ($age16=="TRUE") {
}else{
	$age16 = "FALSE";
}

if ($age17=="TRUE") {
}else{
	$age17 = "FALSE";
}

if ($age18=="TRUE") {
}else{
	$age18 = "FALSE";
}



$monstartmorning = $_REQUEST['monstartmorning'];
$monendmorning = $_REQUEST['monendmorning'];
$monstartafter = $_REQUEST['monstartafter'];
$monendafter = $_REQUEST['monendafter'];

$tuestartmorning = $_REQUEST['tuestartmorning'];
$tueendmorning = $_REQUEST['tueendmorning'];
$tuestartafter = $_REQUEST['tuestartafter'];
$tueendafter = $_REQUEST['tueendafter'];

$wedstartmorning = $_REQUEST['wedstartmorning'];
$wedendmorning = $_REQUEST['wedendmorning'];
$wedstartafter = $_REQUEST['wedstartafter'];
$wedendafter = $_REQUEST['wedendafter'];

$thustartmorning = $_REQUEST['thustartmorning'];
$thuendmorning = $_REQUEST['thuendmorning'];
$thustartafter = $_REQUEST['thustartafter'];
$thuendafter = $_REQUEST['thuendafter'];

$fristartmorning = $_REQUEST['fristartmorning'];
$friendmorning = $_REQUEST['friendmorning'];
$fristartafter = $_REQUEST['fristartafter'];
$friendafter = $_REQUEST['friendafter'];

$satstartweekend = $_REQUEST['satstartweekend'];
$satendweekend = $_REQUEST['satendweekend'];

$sunstartweekend = $_REQUEST['sunstartweekend'];
$sunendweekend = $_REQUEST['sunendweekend'];

$charge = $_REQUEST['charge'];
$costfrequency = $_REQUEST['costfrequency'];
$costamount = $_REQUEST['costamount'];
$feeassistance = $_REQUEST['feeassistance'];
$scholarship = $_REQUEST['scholarship'];
$desassistance = $_REQUEST['desassistance'];
$mcdiscount = $_REQUEST['mcdiscount'];
$otherassistance = $_REQUEST['otherassistance'];
$transportation = $_REQUEST['transportation'];
$snacks = $_REQUEST['snacks'];
$breakfast = $_REQUEST['breakfast'];
$lunch = $_REQUEST['lunch'];
$dinner = $_REQUEST['dinner'];
$freelunch = $_REQUEST['freelunch'];
$spanish = $_REQUEST['spanish'];
$otherlanguage = $_REQUEST['otherlanguage'];

if ($charge=="TRUE") {
}else{
	$charge = "FALSE";
}

if ($feeassistance=="TRUE") {
}else{
	$feeassistance = "FALSE";
}

if ($scholarship=="TRUE") {
}else{
	$scholarship = "FALSE";
}

if ($desassistance=="TRUE") {
}else{
	$desassistance = "FALSE";
}

if ($mcdiscount=="TRUE") {
}else{
	$mcdiscount = "FALSE";
}

if ($otherassistance=="TRUE") {
}else{
	$otherassistance = "FALSE";
}

if ($transportation=="TRUE") {
}else{
	$transportation = "FALSE";
}

if ($snacks=="TRUE") {
}else{
	$snacks = "FALSE";
}

if ($breakfast=="TRUE") {
}else{
	$breakfast = "FALSE";
}

if ($lunch=="TRUE") {
}else{
	$lunch = "FALSE";
}

if ($dinner=="TRUE") {
}else{
	$dinner = "FALSE";
}

if ($spanish=="TRUE") {
}else{
	$spanish = "FALSE";
}

if ($otherlanguage=="TRUE") {
}else{
	$otherlanguage = "FALSE";
}

// check all sites added to make sure that none already exist in the database before adding any new data
require('checknewsites.php');


// insert new sites into database and connect site to users and locations
require('insertnewsites.php');

// create session var with user id
$_SESSION['POSTuserid'] = $userid;

header('Location: https://azcase.nijel.org/php/newsitesurvey.php');
?>

