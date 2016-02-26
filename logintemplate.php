<?php
// Template for login page
?>
<body>
   <h1 id="3rd_party_cookie_test_results"></h1>
   <h1>Login</h1>
   <form name="login" id="login" action="" method="post">
   <table align="left" border="0" cellspacing="0" cellpadding="3">
   <tr><td>Email:</td><td><input type="email" name="user"></td></tr>
   <tr><td>Password:</td><td><input type="password" name="pass"></td></tr>
   <tr><td colspan="2" align="left"><input type="checkbox" name="remember">
   <font size="2">Remember me</td></tr>
   <tr><td colspan="2" align="right"><input type="submit" name="sublogin" value="Login"></td>
   <td><p style="visibility:hidden;" id="progress"/><img id="progress_image" style="padding-left:5px;padding-top:5px;" src="loading.gif" alt=""> Please Wait…</p></td>
   </tr>
   <tr><td colspan="2" align="right"><a href="forgotpassword.php">Forgot your password?</a></td></tr>
   </table>
   </form>
   <div id="clear"></div>
   <br />
   <h1>New Providers</h1>
   <p>Sign up to have your programs and sites listed in the directory.</p>
   <form name="newprovider" action="newprovider.php" method="post">
   <input type="submit" name="newprovider" value="Sign Up">
   </form>
   <div id="clear"></div>
   <br />
   <iframe style="display: block; margin: 0 auto;" src="https://player.vimeo.com/video/122776422?color=ffffff&byline=0&portrait=0" width="800" height="465" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
<?php
require('footer.php');
?>

<script type="text/javascript">
window._3rd_party_test_step1_loaded = function(){
  // At this point, a third-party domain has now attempted to set a cookie (if all went to plan!)
  var step2Url = 'step2.js.php',
    resultsEl = document.getElementById('3rd_party_cookie_test_results'),
    step2El = document.createElement('script');

  // Update loading / results message
  // And load the second part of the test (reading the cookie)
  step2El.setAttribute('src', step2Url);
  resultsEl.appendChild(step2El);
}

window._3rd_party_test_step2_loaded = function(cookieSuccess){
  var resultsEl = document.getElementById('3rd_party_cookie_test_results');

  // check the browser and show the correct instructions
  var browser = navigator.sayswho;
  console.log(browser);
   if (browser === 'Chrome') {
      var browserText = '<a href="https://support.google.com/chrome/answer/95647" target="_blank">Google Chrome cookie preferences</a>. ';
   } else if (browser === 'IE') {
      var browserText = '<a href="http://www.wikihow.com/Enable-Cookies-in-Microsoft-Internet-Explorer" target="_blank">Internet Explorer cookie preferences</a>. ';
   } else if (browser === 'Firefox') {
      var browserText = '<a href="https://support.mozilla.org/en-US/kb/enable-and-disable-cookies-website-preferences" target="_blank">Mozilla Firefox cookie preferences</a>. ';
   } else if (browser === 'Safari') {
      var browserText = '<a href="http://support.apple.com/kb/PH19214" target="_blank">Apple Safari cookie preferences</a>. ';
   } else {
      var browserText = '<a href="http://www.wikihow.com/Enable-Cookies-in-Your-Internet-Web-Browser" target="_blank">cookie preferences</a>. ';

   }



  // Show message
  resultsEl.innerHTML = (cookieSuccess ? '' : 'To access the directory, you must enable third-party cookies in your browser settings. Please follow these instructions for setting your ' + browserText + 'Thank you.' );

  // Done, so remove loading class
  resultsEl.className = resultsEl.className.replace(/\bloading\b/,' ');
  // And remove error message
}

navigator.sayswho= (function(){
    var ua= navigator.userAgent, tem,
    M= ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || [];
    if(/trident/i.test(M[1])){
        tem=  /\brv[ :]+(\d+)/g.exec(ua) || [];
        return 'IE '+(tem[1] || '');
    }
    if(M[1]=== 'Chrome'){
        tem= ua.match(/\b(OPR|Edge)\/(\d+)/);
        if(tem!= null) return tem.slice(1).join(' ').replace('OPR', 'Opera');
    }
    M= M[2]? [M[1], M[2]]: [navigator.appName, navigator.appVersion, '-?'];
    if((tem= ua.match(/version\/(\d+)/i))!= null) M.splice(1, 1, tem[1]);
    return M[0];
})();



</script>

<script type="text/javascript" src="step1.js.php"></script>
