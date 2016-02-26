<?php
// this file formats activity categories into a bulleted list
if (!$language) {
	$language = 1;
	// language traslation script
	require('language.php');
}else{}

// format activity categories for html
if ($arts=='t') {
	$arts = '<li>';
	$arts .= $langtext['Arts and Culture'];
	$arts .= '</li>';
}else{
	$arts = '';
}

if ($character=='t') {
	$character = '<li>';
	$character .= $langtext['Character Education'];
	$character .= '</li>';
}else{
	$character = '';
}

if ($leadership=='t') {
	$leadership = '<li>';
	$leadership .= $langtext['Leadership'];
	$leadership .= '</li>';
}else{
	$leadership = '';
}

if ($mentoring=='t') {
	$mentoring = '<li>';
	$mentoring .= $langtext['Mentoring'];
	$mentoring .= '</li>';
}else{
	$mentoring = '';
}

if ($nutrition=='t') {
	$nutrition = '<li>';
	$nutrition .= $langtext['Nutrition'];
	$nutrition .= '</li>';
}else{
	$nutrition = '';
}

if ($prevention=='t') {
	$prevention = '<li>';
	$prevention .= $langtext['Prevention'];
	$prevention .= '</li>';
}else{
	$prevention = '';
}

if ($sports=='t') {
	$sports = '<li>';
	$sports .= $langtext['Sports and Recreation'];
	$sports .= '</li>';
}else{
	$sports = '';
}

if ($supportservices=='t') {
	$supportservices = '<li>';
	$supportservices .= $langtext['Support Services (medical, dental, mental health, etc.)'];
	$supportservices .= '</li>';
}else{
	$supportservices = '';
}

if ($academic=='t') {
	$academic = '<li>';
	$academic .= $langtext['Tutoring/Academic Enrichment'];
	$academic .= '</li>';
}else{
	$academic = '';
}

if ($community=='t') {
	$community = '<li>';
	$community .= $langtext['Volunteering/Community Service'];
	$community .= '</li>';
}else{
	$community = '';
}

if ($stem=='t') {
	$stem = '<li>';
	$stem .= $langtext['Science, Technology, Engineering, and Mathematics'];
	$stem .= '</li>';
}else{
	$stem = '';
}

if ($college=='t') {
	$college = '<li>';
	$college .= $langtext['College and Career Readiness'];
	$college .= '</li>';
}else{
	$college = '';
}


// put all the activity categories together
$activities = '<ul>' . $academic . $arts . $sports . $community . $stem . $college . $leadership . $character . $prevention . $nutrition . $mentoring . $supportservices . '</ul>';

?>

