<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN""http://www.w3.org/TR/html4/strict.dtd"><html><head>   <title>FMWebschool FileMaker Server Troubleshooting Tool v1.6</title>   <style type="text/css">      div.logo {         width: auto;         margin-left: auto;         margin-right: auto;         text-align: center;      }      div.logo img{         border: 0px;      }      fieldset.serverData {         width: 610px;         margin-left: auto;         margin-right: auto;         margin-bottom: 50px;      }      fieldset.serverData label {         width: 400px;         float: left;         display: block;      }      fieldset.serverData input {         float: left;         width: 200px;         border: 1px solid black;      }      div.step {         width: 610px;         margin-left: auto;         margin-right: auto;      }      div.step div.left {         width: 500px;         float: left;         border: 1px solid black;      }      div.step div.right {         width: 100px;         float: left;         border: 1px solid black;      }      div.step div.right span.fail {         color: red;         font-weight: bold;      }      div.step div.right span.pass {         color: green;         font-weight: bold;      }      div.step div.right span.info {         color: #DAA520;         font-weight: bold;      }      div.step a {         color: blue;      }      div.copyright {         float: left;         width: 95%;         margin-left: auto;         margin-right: auto;         text-align: center;         margin-top: 40px;         margin-bottom: 40px;      }   </style>   <script type="text/javascript">function selectDatabase(name) {   document.getElementById('serverDB').value = name;   document.getElementById('mainForm').submit();}function selectLayout(db,name) {   document.getElementById('serverDB').value = db;   document.getElementById('serverLayout').value = name;   document.getElementById('mainForm').submit();}   </script></head><body>   <div class="logo">      <h1>FMWebschool FileMaker Server Troubleshooting Tool v1.6</h1>      <a href="http://fmwebschool.com"><img alt="FMWebschool Logo" src="http://fmwebschool.com/images07/logo_web.jpg"></a>   </div><!--<?php echo ' php block start -'.'-'.">\n"; ?><?php   if(get_magic_quotes_gpc()) {      isset($_POST['serverIP']) ? $serverIP = stripslashes($_POST['serverIP']) : $serverIP = '127.0.0.1';      isset($_POST['serverPort']) ? $serverPort = stripslashes($_POST['serverPort']) : $serverPort = '80';      isset($_POST['serverUser']) ? $serverUser = stripslashes($_POST['serverUser']) : $serverUser = 'webuser';      isset($_POST['serverPass']) ? $serverPass = stripslashes($_POST['serverPass']) : $serverPass = 'webpass';      isset($_POST['serverDB']) ? $serverDB = stripslashes($_POST['serverDB']) : $serverDB = '';      isset($_POST['serverLayout']) ? $serverLayout = stripslashes($_POST['serverLayout']) : $serverLayout = '';   }else{      isset($_POST['serverIP']) ? $serverIP = $_POST['serverIP'] : $serverIP = '127.0.0.1';      isset($_POST['serverPort']) ? $serverPort = $_POST['serverPort'] : $serverPort = '80';      isset($_POST['serverUser']) ? $serverUser = $_POST['serverUser'] : $serverUser = 'webuser';      isset($_POST['serverPass']) ? $serverPass = $_POST['serverPass'] : $serverPass = 'webpass';      isset($_POST['serverDB']) ? $serverDB = $_POST['serverDB'] : $serverDB = '';      isset($_POST['serverLayout']) ? $serverLayout = $_POST['serverLayout'] : $serverLayout = '';   }   isset($_POST['serverHTTPS']) ? $serverHTTPS = 'checked' : $serverHTTPS = '';   isset($_POST['serverAPI']) ? $serverAPI = $_POST['serverAPI'] : $serverAPI = '';?>   <form method="post" action="serverTest.php" name="mainForm" id="mainForm">      <fieldset class="serverData">         <legend>Server Information</legend>               <input type="hidden" name="serverDB" id="serverDB" value="">         <input type="hidden" name="serverLayout" id="serverLayout" value="">         <label for="serverIP">FMSA Address:</label>         <input type="text" name="serverIP" id="serverIP" value="<?php echo $serverIP; ?>">         <label for="serverPort">FMSA Port:</label>         <input type="text" name="serverPort" id="serverPort" value="<?php echo $serverPort; ?>">         <label for="serverUser">FMSA User:</label>         <input type="text" name="serverUser" id="serverUser" value="<?php echo $serverUser; ?>">         <label for="serverPass">FMSA Password:</label>         <input type="text" name="serverPass" id="serverPass" value="<?php echo $serverPass; ?>">         <label for="serverAPIPHP">API Type: PHP API?</label>         <input type="radio" style="width:auto;" name="serverAPI" id="serverAPIPHP" value="API"<?php if($serverAPI == 'API') echo 'checked="checked"'; ?>>         <label for="serverAPIFX">API Type: FX.php?</label>         <input type="radio" style="width:auto;" name="serverAPI" id="serverAPIFX" value="FX"<?php if($serverAPI == 'FX') echo 'checked="checked"'; ?>>         <label for="serverHTTPS">HTTPS Connection?:</label>         <input type="checkbox" style="width: auto;" name="serverHTTPS" id="serverHTTPS" value="HTTPS"<?php echo $serverHTTPS; ?>>         <label>&nbsp;</label>         <input type="submit" name="serverSubmit" id="serverSubmit" value="Submit!">      </fieldset>   </form><?php echo '<'.'!-'.'- php block end '; ?> -->   <div class="step">      <div class="left">         1. Testing PHP Capability      </div>      <div class="right"><!--<?php echo ' php block start -'.'-'.">\n"; ?><?php ob_start(); ?><?php echo '<'.'!-'.'- php block end '; ?> -->         <span class="fail">Fail</span>      </div>   </div>   <div class="step">      <div class="left">         1.1 Check to make sure you are running this page through "http://" and that the file extension is .php and not .html      </div>      <div class="right">         <span class="info">Info</span>         <!--<?phpob_end_clean();echo "\t\t\t<span class=\"pass\">Pass</span>";echo '<'.'!-'.'- comment start'; ?>-->      </div>   </div><!--<?php echo ' php block start -'.'-'.">\n"; ?><?phpswitch(true) {case true:   /* PHP Version Info */   step('1.1 PHP Version: '.phpversion().'| <a href="serverTest.php?phpinfo=1">view phpinfo()</a>');   step('1.2 Web Server Type: '.$_SERVER['SERVER_SOFTWARE']);   if(function_exists('apache_get_modules')) {      if(in_array('mod_rewrite',apache_get_modules())) {         step('1.3 mod_rewrite is loaded');      }else{         step('1.3 mod_rewrite is not loaded');      }   }   /* Curl check */   $curl = function_exists('curl_init');   step('2. Checking if curl is enabled', $curl);   if(!$curl) break;   /* Post check */   $_SERVER['REQUEST_METHOD'] == 'POST' ? $post = true : $post = false;   step('3. Checking if data above was submitted', $post);   if(!$post) step('3.1 Please fill out the form above and submit it');   flush();   if(!$post) break;   /* Preparing URLs for server calls */   $baseURL = 'http://';   if($serverHTTPS != '') $baseURL = 'https://';   $baseURL.= urlencode($serverUser).':'.urlencode($serverPass).'@'.$serverIP.':'.$serverPort.'/fmi/xml/';   /* Server Version Retrieval */   $url = $baseURL.'version.xml';   comment('DB REQUEST URL: '.$url);   $ch = curl_init($url);   curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);   $ret = curl_exec($ch);   comment('SERVER RESPONSE: '.htmlentities(print_r($ret,true)));   if($ret === false) {      step('4. Attempting to get server version',  false);      step('4.1 Curl error: '.curl_error($ch));   }else if(preg_match('#<fmresultset.*error\ code.*?version="([^"]+)"#i',$ret, $matches)){      step('4. Attempting to get server version',  true);      step('4.1 Server version: '.$matches[1]);   }else if(curl_getinfo($ch, CURLINFO_HTTP_CODE) == 401){      step('4. Attempting to get server version',  false);      step('4.1 401: incorrect user name, password, or privileges');      $ret = false;   }else{      step('4. Attempting to get server version',  false);      step('4.1 Failed with HTTP code '.curl_getinfo($ch, CURLINFO_HTTP_CODE).' (url attempted:'.$url.')');      $ret = false;   }   curl_close($ch);   if($ret === false) break;   /* Testing a database list retrieval */   $url = $baseURL.'FMPXMLRESULT.xml?-dbnames';   comment('DB REQUEST URL: '.$url);   $ch = curl_init($url);   curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);   if($serverAPI == 'API') {      curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-FMI-PE-ExtendedPrivilege: tU+xR2RSsdk='));   }   $ret = curl_exec($ch);   comment('SERVER RESPONSE: '.htmlentities(print_r($ret,true)));   if($ret === false) {      step('5. Attempting to get database list',  false);      step('5.1 Curl error: '.curl_error($ch));   }else if(preg_match('#<FMPXMLRESULT.*?version="([^"]+)"#i',$ret, $matches)){      step('5. Attempting to get database list',  true);      if(preg_match_all('#<DATA>([^>]+)</DATA>#i',$ret,$matches)) {         foreach($matches[1] as $key=>$value) {            $matches[1][$key] = "<a href=\"#\" onclick=\"selectDatabase('{$value}')\">{$value}</a>";         }         step('5.1 Databases: '.implode(', ',$matches[1]), true);         error_code_step($ret);      }else{         step('5.1 Cannot find any databases', false);         error_code_step($ret);         $ret = false;      }   }else if(curl_getinfo($ch, CURLINFO_HTTP_CODE) == 401){      step('5. Attempting to get database list',  false);      step('5.1 401: incorrect user name, password, or privileges');      $ret = false;   }else{      step('5.1 Failed with HTTP code '.curl_getinfo($ch, CURLINFO_HTTP_CODE));      $ret = false;   }   curl_close($ch);   if($ret === false) break;   /* Testing listing of layouts for a specific database */   if($serverDB == '') {      step('6. Please select a database above');      break;   }   $url = $baseURL.'FMPXMLRESULT.xml?-db='.urlencode($serverDB).'&-layoutnames';   comment('DB REQUEST URL: '.$url);   $ch = curl_init($url);   curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);   if($serverAPI == 'API') {      curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-FMI-PE-ExtendedPrivilege: tU+xR2RSsdk='));   }   $ret = curl_exec($ch);   comment('SERVER RESPONSE: '.htmlentities(print_r($ret,true)));   if($ret === false) {      step('6. Attempting to get layout list',  false);      step('6.1 Curl error: '.curl_error($ch));   }else if(preg_match('#<FMPXMLRESULT.*?version="([^"]+)"#i',$ret, $matches)){      step('6. Attempting to get layout list',  true);      if(preg_match_all('#<DATA>([^>]+)</DATA>#i',$ret,$matches)) {         foreach($matches[1] as $key=>$value) {            $matches[1][$key] = "<a href=\"#\" onclick=\"selectLayout('{$serverDB}','{$value}')\">{$value}</a>";         }         step('6.1 Layouts: '.implode(', ',$matches[1]), true);      }else{         step('6.1 Cannot find any layouts', false);         error_code_step($ret);         $ret = false;      }   }else if(curl_getinfo($ch, CURLINFO_HTTP_CODE) == 401){      step('6. Attempting to get layout list',  false);      step('6.1 401: incorrect user name, password, or privileges');      $ret = false;   }else{      step('6.1 Failed with HTTP code '.curl_getinfo($ch, CURLINFO_HTTP_CODE));      $ret = false;   }   curl_close($ch);   if($ret === false) break;   /* Testing listing of layouts for a specific database */   if($serverLayout == '') {      step('7. Please select a layout above');      break;   }   $url = $baseURL.'FMPXMLRESULT.xml?-db='.urlencode($serverDB).'&-lay='.urlencode($serverLayout).'&-findany';   comment('DB REQUEST URL: '.$url);   $ch = curl_init($url);   curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);   if($serverAPI == 'API') {      curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-FMI-PE-ExtendedPrivilege: tU+xR2RSsdk='));   }   $ret = curl_exec($ch);   comment('SERVER RESPONSE: '.htmlentities(print_r($ret,true)));   if($ret === false) {      step('7. Attempting to get a random record',  false);      step('7.1 Curl error: '.curl_error($ch));   }else if(preg_match('#<FMPXMLRESULT.*?version="([^"]+)"#i',$ret, $matches)){      step('7. Attempting to get a random record',  true);      if(preg_match_all('#<DATA>([^>]+)</DATA>#i',$ret,$matches)) {         step('7.1 Data: '.implode(', ',$matches[1]), true);      }else{         step('7.1 Cannot find any records', false);         error_code_step($ret);         $ret = false;      }   }else if(curl_getinfo($ch, CURLINFO_HTTP_CODE) == 401){      step('7. Attempting to get a random record',  false);      step('7.1 401: incorrect user name, password, or privileges');      $ret = false;   }else{      step('7.1 Failed with HTTP code '.curl_getinfo($ch, CURLINFO_HTTP_CODE));      $ret = false;   }   curl_close($ch);   if($ret === false) break;   step('8. Reached End of Testing Cycle', true);}function comment($text) {   // Comment is formatted this way in order to avoid having   // the browser parse the string below as an actual comment tag   echo "\n<".'!'.'-'.'- '.$text.' -'.'-'.">\n";}function step($left, $pass = null) {   echo "\t<div class=\"step\">\n";   echo "\t\t<div class=\"left\">\n";   echo "\t\t\t{$left}\n";   echo "\t\t</div>\n";   echo "\t\t<div class=\"right\">\n";   if($pass === true) {      echo "\t\t\t<span class=\"pass\">Pass</span>\n";   }else if($pass === false){      echo "\t\t\t<span class=\"fail\">Fail</span>\n";   }else{      echo "\t\t\t<span class=\"info\">Info</span>\n";   }   echo "\t\t</div>\n";   echo "\t</div>\n";}function error_code_step($ret) {   $pass = false;   preg_match_all('#<ERRORCODE>([^>]+)</ERRORCODE>#i',$ret,$matches);   if($matches[1][0] == 0) $pass = null;   step('Error code from last action: <a href="http://fmwebschool.com/reference/FileMaker_Web_Publishing_Engine_Error_Codes">'.$matches[1][0].'</a>',$pass);}if(isset($_GET['phpinfo'])) {   echo '<div style="margin-top: 50px; width: 100%; float: left;">';   phpinfo();   echo '</div>';}?><?php echo '<'.'!-'.'- php block end '; ?> --><div class="copyright">Copyright &copy; FMWebschool 2008<br>FileMaker and the FileMaker logo are registered trademarks of FileMaker, Inc<br>All other trademarks and copyrights are the property of their respective owners.<br></div></body></html>