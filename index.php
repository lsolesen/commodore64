<?php
/**
 * Commodore 64
 *
 * @todo Could be created accessible, so if no javascript it still works
 *
 * @link http://www.zimmers.net/cbmpics/cbm/c64/c64ug.txt
 * @link http://bernholm.dk/computermuseum/index.php?view=c64&showMessages=35
 * @link http://sta.c64.org/cbm64baserr.html
 */

require_once 'config.local.php';

$allowed = array("load", "list", "run", "reset");

if (isset($_GET['kommando'])) {
    $_GET['kommando'] = strip_tags($_GET['kommando']);
} else {
    $_GET['kommando'] = '';
}

// find the command
$tmp = explode(" ", $_GET['kommando']);
$c64prompt = trim($tmp[0]);

// find what to do with the command
if (isset($tmp[1])) {
    $secondKommando = stripslashes($tmp[1]);
    $tmp = explode('"', $secondKommando);
    $loadWhat = $tmp[1];
}

switch ($c64prompt) {
    case 'run':
        if ((int)$_GET['site'] > 0) {
            header("Location: load.php?file=".(int)$_GET['site']);
            exit;
        }
        $c64prompt = 'run';
        break;

    case 'ci':
        header("Location: /websites/customer/");
        exit;

    case 'manual';
        header("Location: http://www.zimmers.net/cbmpics/cbm/c64/c64ug.txt");
        exit;

    case 'list';
        $c64prompt = 'load';
        $_GET['kommando'] = 'load "$",8';
    default:
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="da">
<head>
<title>**** SNUPTAG (.) DK ****</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script type="text/javascript">
if (document.getElementById) {
    window.onload = function() {
        var cursor = document.getElementById('thecursor');
        var toggle = 0;
        var cursorColors = ["#5454FC","#0000A8"];

	      function cursorBlink(){
          toggle = 1-toggle;
          cursor.style.color = cursorColors[toggle];
          cursor.style.background = cursorColors[1-toggle];
        }

        setInterval(cursorBlink,760); // blink cursor

        elm = document.getElementById('kommando');
				elm.focus(); elm.value = '';
				intSize = 1;
        elm.setAttribute('size', '1');
				elm.onkeypress = function(){ setTimeout(function(){ elm.size=elm.value.length+1; },1); };
      }
    }
</script>
<style type="text/css">
body {
	background: #5454FC;
	text-transform: uppercase;
	font-weight: normal;
	font-family: Fixedsys, mono-space;
}

h1,h2,p {
	font-size: 1em;
	font-weight: normal;
}

#bodywrap {
	height: 28em;
	background: #0000A8;
	color: #5454FC;
	margin: 4%;
}

#bodywrap h1,#bodywrap h2 {
	text-align: center;
	margin: 0 0 0.4em 0;
	padding: 0;
}

#top {
	padding: 1em 0 0 0;
}

#top p {
	margin-top: 1em;
}

#content {
	background: #0000A8;
	color: #5454FC;
}

#content h2 {
	text-align: left;
}

input {
	background: #0000A8;
	border: 0px solid #0000A8;
	color: #5454FC;
	font-size: 1em;
	font-family: Fixedsys, mono-space;
	text-transform: uppercase;
}

input.submit {
	color: #0000A8;
}

a {
	color: #5454FC;
	text-decoration: none;
}

ul {
	list-style-type: none;
	margin: 1em 0 1em 0;
	padding: 0;
}

li {
	margin: 0;
	padding: 0;
}

#foot {
	margin: 0;
	padding: 0 0 1em 0;
	background: #0000A8;
}

p {
	margin: 0;
}

form {
	margin: 0;
	padding: 0;
}

label {
	display: none;
}

pre {
	letter-spacing: 0;
	font-family: Fixedsys, mono-space;
}

span#thecursor {
	position: relative;
	left: -0.53em;
	white-space: pre;
	font-family: Fixedsys;
}
</style>
</head>

<body>

<div id="bodywrap">
<div id="top">
<h1>**** <a href="http://www.larsolesen.dk/">Snuptag (dk) edb webdesign</a> ****</h1>
<h2>
    <a href="index.php?kommando=list">Sites</a>&nbsp;&nbsp;
    <a href="index.php?kommando=help">Help</a>&nbsp;&nbsp;
    <a href="http://validator.w3.org/check/referer">1.0 valid xhtml strict</a>&nbsp;&nbsp;
    <a href="index.php?kommando=about">About</a>
</h2>
<p>Ready.</p>
</div>
<div id="content"><?php
echo stripslashes($_GET['kommando']);

switch ($c64prompt) {
    case 'load':
        if(stripslashes($_GET['kommando']) == 'load "$",8') { ?>
<p><br />
Searching for $.<br />
Loading.<br />
List.</p>
<ul>
	<li>0&nbsp;&nbsp;"Sider"&nbsp;&nbsp;&nbsp;&nbsp;00&nbsp;2A</li>
	<?php
	foreach ($sites as $key => $site) {
	    echo '<li><a href="'.$site['url'].'">';
	    echo $key;
	    echo '&nbsp;';
	    if ($key < 10) echo '&nbsp;';
	    echo '"' . $site['name'] . '"';
	    $stop = 25 - strlen($site['name']);
	    for($i = 1; $i <= $stop; $i++) { echo '&nbsp;'; }
	    echo 'WEB';
	    echo '</a></li>';
	}
	?>
	<li><a href="http://larsolesen.dk">1&nbsp;&nbsp; blocks free</a></li>
</ul>
<p><?php
        } else {
            if (!empty($loadWhat)) {
                if (!empty($sites[$loadWhat])) {
                    echo '<br />Searching for "'.$loadWhat.'".<br />Loading.<br />Ready.</p>';
                    $site_id = $loadWhat;
                }
                else {
                    echo '<br />File not found.<br />Ready.</p>';
                }
            }
            else {
                echo '<br />Missing filename.<br />Ready.</p>';
            }
        }
        break;

case 'help':
    ?> <br />
&nbsp;
<h2>Kommandoer til datamaten</h2>
<dl>
	<dt>Load "$",8&nbsp;&nbsp;&lt;return&gt;</dt>
	<dd>Viser alle siderne i systemet.</dd>
	<dt>List&nbsp;&nbsp;&lt;return&gt;</dt>
	<dd>Shortcut for ovenstående.</dd>
	<dt>Load "FILNAVN",8&nbsp;&nbsp;&lt;return&gt;</dt>
	<dd>Åbner den angivne side (Du kan også klikke på linkene).</dd>
	<dt>run&nbsp;&nbsp;&lt;return&gt;</dt>
	<dd>Når siden er fundet, skal du klikke på run for at gå til siden.</dd>
	<dt>reset&nbsp;&nbsp;&lt;return&gt;</dt>
	<dd>Nulstiller siden.</dd>
	<dt>about&nbsp;&nbsp;&lt;return&gt;</dt>
	<dd>Information om siden.</dd>
	<dt>ci&nbsp;&nbsp;&lt;return&gt;</dt>
	<dd>Åbner customer interface.</dd>
</dl>
<p><br />
Ready.</p>
    <?php
    break;
case 'about':
    ?> <br />
&nbsp;
<h2>Om sitet</h2>
<p>Siden er inspireret af <a href="http://www.clausejner.dk/">www.clausejner.dk</a>
og Commodore 64, som en gang var ungernes foretrukne spillecomputer og
programmørens simple legetøj.</p>
<pre>
   _____
  /  ___|___
 |  /   |__/  c o m m o d o r e
 |  \___|__\  C O M P U T E R
  \_____|
</pre>
<dl>
	<dt><a href="http://www.zimmers.net/cbmpics/cbm/c64/c64ug.txt">manual
	til commodore 64</a></dt>
	<dd>Manualen til C64. Tegningerne er for seje.</dd>
</dl>
<p>Vil du have din egen side, der lever op til de gældende
webstandarder, så klik ind på min side om <a
	href="http://larsolesen.dk/">webdesign</a>.</p>
<p><br />
&copy; 2004 Lars Olesen.</p>
<p><br />
Ready.</p>
    <?php
    break;
case 'run':
    echo '<p>File not open.<br />Ready.</p>';
    break;
case 'reset':
    echo '<p>Ready.</p>';
    break;
case '':
    break;
default:
    echo '<p>?syntax error<br />Ready.</p>';
    break;
}
?>

</div>
<div id="foot">
<form action="index.php" method="get">
<div><label for="kommando">Kommando</label> <input tabindex="1"
	type="text" name="kommando" id="kommando" size="60" /><span
	id="thecursor">&nbsp;</span> <input type="hidden" name="site"
	value="<?php if (isset($site_id)) echo $site_id; ?>" /> <input
	tabindex="2" type="submit" value="Send" class="submit" /></div>
</form>
</div>
</div>
</body>
</html>
