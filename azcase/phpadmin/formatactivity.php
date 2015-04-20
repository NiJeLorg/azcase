<?php
// this file formats activity categories into a bulleted list

// format activity categories for html
if ($arts=='t') {
	$arts = '<li>';
	$arts .= 'Arts and Culture';
	$arts .= '</li>';
}else{
	$arts = '';
}

if ($character=='t') {
	$character = '<li>';
	$character .= 'Character Education';
	$character .= '</li>';
}else{
	$character = '';
}

if ($leadership=='t') {
	$leadership = '<li>';
	$leadership .= 'Leadership';
	$leadership .= '</li>';
}else{
	$leadership = '';
}

if ($mentoring=='t') {
	$mentoring = '<li>';
	$mentoring .= 'Mentoring';
	$mentoring .= '</li>';
}else{
	$mentoring = '';
}

if ($nutrition=='t') {
	$nutrition = '<li>';
	$nutrition .= 'Nutrition';
	$nutrition .= '</li>';
}else{
	$nutrition = '';
}

if ($prevention=='t') {
	$prevention = '<li>';
	$prevention .= 'Prevention';
	$prevention .= '</li>';
}else{
	$prevention = '';
}

if ($sports=='t') {
	$sports = '<li>';
	$sports .= 'Sports and Recreation';
	$sports .= '</li>';
}else{
	$sports = '';
}

if ($supportservices=='t') {
	$supportservices = '<li>';
	$supportservices .= 'Support Services (medical, dental, mental health, etc.)';
	$supportservices .= '</li>';
}else{
	$supportservices = '';
}

if ($academic=='t') {
	$academic = '<li>';
	$academic .= 'Tutoring/Academic Enrichment';
	$academic .= '</li>';
}else{
	$academic = '';
}

if ($community=='t') {
	$community = '<li>';
	$community .= 'Volunteering/Community Service';
	$community .= '</li>';
}else{
	$community = '';
}

if ($stem=='t') {
	$stem = '<li>';
	$stem .= 'Science, Technology, Engineering, and Mathematics';
	$stem .= '</li>';
}else{
	$stem = '';
}

if ($college=='t') {
	$college = '<li>';
	$college .= 'College and Career Readiness';
	$college .= '</li>';
}else{
	$college = '';
}


// put all the activity categories together
$activities = '<ul>' . $academic . $arts . $sports . $community . $stem . $college . $leadership . $character . $prevention . $nutrition . $mentoring . $supportservices . '</ul>';

?>

