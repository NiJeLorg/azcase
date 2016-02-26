<? 
// Footer 
if (!$language) {
	$language = 1;
	// language traslation script
	require('language.php');
}else{}

?>
<div id="clear"></div>
</body>
</html>

<script type="text/javascript">
function loadSubmit() {

    ProgressImage = document.getElementById('progress_image');
    document.getElementById("progress").style.visibility = "visible";
    setTimeout(function(){ProgressImage.src = ProgressImage.src},100);
    return true;

} 

  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-61309035-2', 'auto');
  ga('send', 'pageview');

</script>