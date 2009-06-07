  <div id="bodywrap">
    <div id="top">
      <h1>**** <a href="http://www.larsolesen.dk/webdesign/">Snuptag (dk) edb webdesign</a> ****</h1>
      <h2><a href="index.php?kommando=list"><?php echo $db->nf(); ?> sites</a>&nbsp;&nbsp;<a href="index.php?kommando=help">Help</a>&nbsp;&nbsp;<a href="http://validator.w3.org/check/referer">1.0 valid xhtml strict</a>&nbsp;&nbsp;<a href="index.php?kommando=about">About</a></h2>
            <p>Ready.</p>
    </div>
    <div id="content">
<?php

echo stripslashes($_GET['kommando']);

switch ($c64prompt) {
  case 'load':
    if(stripslashes($_GET['kommando']) == 'load "$",8') { ?>
      <p><br />Searching for $.<br />Loading.<br />List.</p>
      <ul>
        <li>0&nbsp;&nbsp;"Sider på retlet.dk"&nbsp;&nbsp;&nbsp;&nbsp;00&nbsp;2A</li>
        <?php
          while ($db->next_record()) {
            echo '<li><a href="http://'.$db->f("www").'">';
            echo $db->f("id");
            echo '&nbsp;';
            if ($db->f("id") < 10) echo '&nbsp;';
            echo '"' . $db->f("name") . '"';
            $stop = 25 - strlen($db->f("name"));
            for($i = 1; $i <= $stop; $i++) { echo '&nbsp;'; }
            echo 'WEB';
            echo '</a></li>';
          }
        ?>
        <li><a href="http://www.retlet.dk/about.php">1&nbsp;&nbsp; blocks free</a></li>
      </ul>
      <p>
    <?php
    }
    else {
        if (!empty($loadWhat)) {
        $db = new DB_Sql("SELECT * FROM site WHERE name = '".$loadWhat."'");
        if ($db->next_record()) {
          echo '<br />Searching for "'.$loadWhat.'".<br />Loading.<br />Ready.</p>';
          $site_id = $db->f("id");
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
  ?>
    <br/>&nbsp;
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
    </dl><p><br />Ready.</p>
  <?php
      break;
  case 'about':
  ?>
    <br />&nbsp;
    <h2>Om sitet</h2>
    <p>Siden er inspireret af <a href="http://www.clausejner.dk/">www.clausejner.dk</a> og Commodore 64, som en gang var ungernes foretrukne spillecomputer og programmørens simple legetøj.</p>
    <pre>
   _____
  /  ___|___
 |  /   |__/  c o m m o d o r e
 |  \___|__\  C O M P U T E R
  \_____|
</pre>
    <dl>
      <dt><a href="http://www.zimmers.net/cbmpics/cbm/c64/c64ug.txt">manual til commodore 64</a></dt>
      <dd>Manualen til C64. Tegningerne er for seje.</dd>
    </dl>
    <p>Vil du have din egen side, der lever op til de gældende webstandarder, så klik ind på min side om <a href="http://www.larsolesen.dk/webdesign/">webdesign</a>.</p>
    <p><br />&copy; 2004 Lars Olesen.</p><p><br />Ready.</p>
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
              <div>
                <label for="kommando">Kommando</label>
        <input tabindex="1" type="text" name="kommando" id="kommando" size="60" /><span id="thecursor">&nbsp;</span>
        <input type="hidden" name="site" value="<?php if(isset($site_id)) echo $site_id; ?>" />
        <input tabindex="2" type="submit" value="Send" class="submit" />
                </div>
      </form>
    </div>
  </div>
