<? 
// Footer 
if (!$language) {
	$language = 1;
	// language traslation script
	require('language.php');
}else{}

?>
<div id="clear"></div>
<br /><br />
<div id="footer"><a href="searchhome.php?language=<?php echo $language; ?>"><?php echo $langtext['Find Programs Near You']; ?></a> | <a href="providerhome.php?language=<?php echo $language; ?>"><?php echo $langtext['Provider Login']; ?></a> | <?php echo $langtext['Powered by NiJeL']; ?>
</div>

</body>
</html>

<script type="text/javascript">
function loadSubmit() {

    ProgressImage = document.getElementById('progress_image');
    document.getElementById("progress").style.visibility = "visible";
    setTimeout(function(){ProgressImage.src = ProgressImage.src},100);
    return true;

} 

</script>
