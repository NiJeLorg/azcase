<?php
if (!$language) {
	$language = 1;
	// language traslation script
	require('language.php');
}else{}

// format times for html
// declare empty day varibles
$monday = '';
$tuesday = '';
$wednesday = '';
$thursday = '';
$friday = '';
$satruday = '';
$sunday = '';

// format monday times
if (!$monstartmorning || $monstartmorning=='00:00:00') {
	$monday .= "<td></td>";
}else{
	$monstartmorning = date("g:i A", strtotime($monstartmorning));
	$monday .= "<td align=\"center\">$monstartmorning</td>";
}

if (!$monendmorning || $monendmorning=='00:00:00') {
	$monday .= "<td></td>";
}else{
	$monendmorning = date("g:i A", strtotime($monendmorning));
	$monday .= "<td align=\"center\">$monendmorning</td>";
}

if (!$monstartafter || $monstartafter=='00:00:00') {
	$monday .= "<td></td>";
}else{
	$monstartafter = date("g:i A", strtotime($monstartafter));
	$monday .= "<td align=\"center\">$monstartafter</td>";
}

if (!$monendafter || $monendafter=='00:00:00') {
	$monday .= "<td></td>";
}else{
	$monendafter = date("g:i A", strtotime($monendafter));
	$monday .= "<td align=\"center\">$monendafter</td>";
}

// overwrite monday if closed
if ((!$monstartmorning || $monstartmorning=='00:00:00') && (!$monendmorning || $monendmorning=='00:00:00') && (!$monstartafter || $monstartafter=='00:00:00') && (!$monendafter || $monendafter=='00:00:00')) {
	$monday = "<td align=\"center\" colspan=\"4\">";
	$monday .= $langtext['Closed'];
	$monday .= '</td>';
}else{}
	

// format tuesday times
if (!$tuestartmorning || $tuestartmorning=='00:00:00') {
	$tuesday .= "<td></td>";
}else{
	$tuestartmorning = date("g:i A", strtotime($tuestartmorning));
	$tuesday .= "<td align=\"center\">$tuestartmorning</td>";
}

if (!$tueendmorning || $tueendmorning=='00:00:00') {
	$tuesday .= "<td></td>";
}else{
	$tueendmorning = date("g:i A", strtotime($tueendmorning));
	$tuesday .= "<td align=\"center\">$tueendmorning</td>";
}

if (!$tuestartafter || $tuestartafter=='00:00:00') {
	$tuesday .= "<td></td>";
}else{
	$tuestartafter = date("g:i A", strtotime($tuestartafter));
	$tuesday .= "<td align=\"center\">$tuestartafter</td>";
}

if (!$tueendafter || $tueendafter=='00:00:00') {
	$tuesday .= "<td></td>";
}else{
	$tueendafter = date("g:i A", strtotime($tueendafter));
	$tuesday .= "<td align=\"center\">$tueendafter</td>";
}

// overwrite tuesday if closed
if ((!$tuestartmorning || $tuestartmorning=='00:00:00') && (!$tueendmorning || $tueendmorning=='00:00:00') && (!$tuestartafter || $tuestartafter=='00:00:00') && (!$tueendafter || $tueendafter=='00:00:00')) {
	$tuesday = "<td align=\"center\" colspan=\"4\">";
	$tuesday .= $langtext['Closed'];
	$tuesday .= '</td>';
}else{}


// format wednesday times
if (!$wedstartmorning || $wedstartmorning=='00:00:00') {
	$wednesday .= "<td></td>";
}else{
	$wedstartmorning = date("g:i A", strtotime($wedstartmorning));
	$wednesday .= "<td align=\"center\">$wedstartmorning</td>";
}

if (!$wedendmorning || $wedendmorning=='00:00:00') {
	$wednesday .= "<td></td>";
}else{
	$wedendmorning = date("g:i A", strtotime($wedendmorning));
	$wednesday .= "<td align=\"center\">$wedendmorning</td>";
}

if (!$wedstartafter || $wedstartafter=='00:00:00') {
	$wednesday .= "<td></td>";
}else{
	$wedstartafter = date("g:i A", strtotime($wedstartafter));
	$wednesday .= "<td align=\"center\">$wedstartafter</td>";
}

if (!$wedendafter || $wedendafter=='00:00:00') {
	$wednesday .= "<td></td>";
}else{
	$wedendafter = date("g:i A", strtotime($wedendafter));
	$wednesday .= "<td align=\"center\">$wedendafter</td>";
}

// overwrite wednesday if closed
if ((!$wedstartmorning || $wedstartmorning=='00:00:00') && (!$wedendmorning || $wedendmorning=='00:00:00') && (!$wedstartafter || $wedstartafter=='00:00:00') && (!$wedendafter || $wedendafter=='00:00:00')) {
	$wednesday = "<td align=\"center\" colspan=\"4\">";
	$wednesday .= $langtext['Closed'];
	$wednesday .= '</td>';
}else{}


// format thursday times
if (!$thustartmorning || $thustartmorning=='00:00:00') {
	$thursday .= "<td></td>";
}else{
	$thustartmorning = date("g:i A", strtotime($thustartmorning));
	$thursday .= "<td align=\"center\">$thustartmorning</td>";
}

if (!$thuendmorning || $thuendmorning=='00:00:00') {
	$thursday .= "<td></td>";
}else{
	$thuendmorning = date("g:i A", strtotime($thuendmorning));
	$thursday .= "<td align=\"center\">$thuendmorning</td>";
}

if (!$thustartafter || $thustartafter=='00:00:00') {
	$thursday .= "<td></td>";
}else{
	$thustartafter = date("g:i A", strtotime($thustartafter));
	$thursday .= "<td align=\"center\">$thustartafter</td>";
}

if (!$thuendafter || $thuendafter=='00:00:00') {
	$thursday .= "<td></td>";
}else{
	$thuendafter = date("g:i A", strtotime($thuendafter));
	$thursday .= "<td align=\"center\">$thuendafter</td>";
}

// overwrite thursday if closed
if ((!$thustartmorning || $thustartmorning=='00:00:00') && (!$thuendmorning || $thuendmorning=='00:00:00') && (!$thustartafter || $thustartafter=='00:00:00') && (!$thuendafter || $thuendafter=='00:00:00')) {
	$thursday = "<td align=\"center\" colspan=\"4\">";
	$thursday .= $langtext['Closed'];
	$thursday .= '</td>';
}else{}


// format friday times
if (!$fristartmorning || $fristartmorning=='00:00:00') {
	$friday .= "<td></td>";
}else{
	$fristartmorning = date("g:i A", strtotime($fristartmorning));
	$friday .= "<td align=\"center\">$fristartmorning</td>";
}

if (!$friendmorning || $friendmorning=='00:00:00') {
	$friday .= "<td></td>";
}else{
	$friendmorning = date("g:i A", strtotime($friendmorning));
	$friday .= "<td align=\"center\">$friendmorning</td>";
}

if (!$fristartafter || $fristartafter=='00:00:00') {
	$friday .= "<td></td>";
}else{
	$fristartafter = date("g:i A", strtotime($fristartafter));
	$friday .= "<td align=\"center\">$fristartafter</td>";
}

if (!$friendafter || $friendafter=='00:00:00') {
	$friday .= "<td></td>";
}else{
	$friendafter = date("g:i A", strtotime($friendafter));
	$friday .= "<td align=\"center\">$friendafter</td>";
}

// overwrite friday if closed
if ((!$fristartmorning || $fristartmorning=='00:00:00') && (!$friendmorning || $friendmorning=='00:00:00') && (!$fristartafter || $fristartafter=='00:00:00') && (!$friendafter || $friendafter=='00:00:00')) {
	$friday = "<td align=\"center\" colspan=\"4\">";
	$friday .= $langtext['Closed'];
	$friday .= '</td>';
}else{}


// format saturday times
if (!$satstartweekend || $satstartweekend=='00:00:00') {
	$saturday .= "<td></td>";
}else{
	$satstartweekend = date("g:i A", strtotime($satstartweekend));
	$saturday .= "<td align=\"center\" colspan=\"2\">$satstartweekend</td>";
}

if (!$satendweekend || $satendweekend=='00:00:00') {
	$saturday .= "<td></td>";
}else{
	$satendweekend = date("g:i A", strtotime($satendweekend));
	$saturday .= "<td align=\"center\" colspan=\"2\">$satendweekend</td>";
}

// overwrite saturday if closed
if ((!$satstartweekend || $satstartweekend=='00:00:00') && (!$satendweekend || $satendweekend=='00:00:00')) {
	$saturday = "<td align=\"center\" colspan=\"4\">";
	$saturday .= $langtext['Closed'];
	$saturday .= '</td>';
}else{}


// format sunday times
if (!$sunstartweekend || $sunstartweekend=='00:00:00') {
	$sunday .= "<td></td>";
}else{
	$sunstartweekend = date("g:i A", strtotime($sunstartweekend));
	$sunday .= "<td align=\"center\" colspan=\"2\">$sunstartweekend</td>";
}

if (!$sunendweekend || $sunendweekend=='00:00:00') {
	$sunday .= "<td></td>";
}else{
	$sunendweekend = date("g:i A", strtotime($sunendweekend));
	$sunday .= "<td align=\"center\" colspan=\"2\">$sunendweekend</td>";
}

// overwrite sunday if closed
if ((!$sunstartweekend || $sunstartweekend=='00:00:00') && (!$sunendweekend || $sunendweekend=='00:00:00')) {
	$sunday = "<td align=\"center\" colspan=\"4\">";
	$sunday .= $langtext['Closed'];
	$sunday .= '</td>';
}else{}

?>

