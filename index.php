<?php
  $params = parse_ini_file(sprintf('lib/parameters.ini', __DIR__), true);
  include 'lib/SimpleOrm.class.php';
  $conn = new mysqli($params['database']['host'], $params['database']['user'], $params['database']['password']);
  if ($conn->connect_error)
    die(sprintf('Unable to connect to the database. %s', $conn->connect_error));
  SimpleOrm::useConnection($conn, $params['database']['name']);
  class instawall extends SimpleOrm { }
  
    $search = $_GET['search'] ? $_GET['search'] : 'instagram';
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    
    $unwanted_array = array(    'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
                            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
                            'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
                            'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
                            'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y' );
    $search = strtr( $search, $unwanted_array );
    
    $search = preg_replace('/[^\w\s]/', '', $search);
    $search = preg_replace('/\s+/', '', $search);
    
    $ne_url = 'https://matteoenna.it/tools/instawall/'.str_replace(' ','',$search).'.html';
    if($search != 'instagram' && strpos($actual_link,'index.php')) header('location: '.$ne_url);
    if(!strpos($actual_link,'index.php')) {
      $entry = new instawall;
      $entry->parola = strtolower($search);
      $entry->data = date('Y-m-d H:i:s');
      $entry->save();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8' />  
    <title><?php echo ucfirst($search).': ';?>InstaWall - search on instagram</title>
    <script type='text/javascript'>
        function getWord() {
            return '<?php
                echo $search;
            
            ?>';
        }
    </script>
    <meta name="description" content="What is a <?php echo ucfirst($search).' - ';?>InstaWall - search on instagram"/>
    <meta name="viewport" content="width=device-width" />
    <meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="https://fb.me/react-with-addons-0.14.0.js"></script>
    <script src="https://fb.me/react-dom-0.14.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.24/browser.js"></script>   
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link href="https://matteoenna.it/wp-content/plugins/cookie-notice/css/front.css" media="screen" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

    <link rel="stylesheet" href="css/style.css">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="canonical" href="https://matteoenna.it/tools/instawall/<?php echo ucfirst($search);?>.html" />
    
    <meta property="og:locale" content="it_IT" />
    <meta property="og:title" content="<?php echo ucfirst($search).': ';?>InstaWall - search on instagram" />
    <meta property="og:description" content="What is a <?php echo ucfirst($search).' - ';?>InstaWall - search on instagram" />
    <meta property="og:url" content="https://matteoenna.it/tools/instawall/<?php echo ucfirst($search);?>.html" />
    <meta property="og:site_name" content="Matteo Enna" />
    <meta property="article:publisher" content="https://www.facebook.com/dev.matteoenna" />
    <meta property="article:section" content="Open Bootstrap" />
    <meta property="article:published_time" content="2017-12-29T12:11:11+01:00" />
    <meta property="og:image" content="https://matteoenna.it/wp-content/uploads/2017/12/IL-BLOG-DI-UNOSVILUPPATORE.png" />
    <meta property="og:image:width" content="476" />
    <meta property="og:image:height" content="476" />
    
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="What is a <?php echo ucfirst($search).' - ';?>InstaWall - search on instagram" />
    <meta name="twitter:title" content="<?php echo ucfirst($search).': ';?>InstaWall - search on instagram" />
    <meta name="twitter:site" content="@matteo_ellusu" />
    <meta name="twitter:image" content="https://matteoenna.it/wp-content/uploads/2017/12/IL-BLOG-DI-UNOSVILUPPATORE.png" />
    <meta name="twitter:creator" content="@matteo_ellusu" />
</head>
<body>
<span style="font-size:30px;cursor:pointer" onclick="openNav()" id="menu" class="only-mobile">&#9776;</span>
<div id="mySidenav" class="sidenav only-mobile">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>    
        <a href="https://matteoenna.it/tools/instawall/index.php">Home</a>
        <a href="#" id="nascondi">nascondi</a>
        <a href="#" id="cerca" style="display: none">cerca</a>
        <a href="#" id="day-link">best of the day</a>
        <a href="#" id="week-link">best of the week</a>
        <a href="#" id="month-link">best of the month</a>
        <a href="#" id="year-link">best of the year</a>
        <a href="#" id="ever-link">best ever</a>

</div>
<div id="insta-nat"></div>
<div id="new-body" class="nec">
    <form action="index.php" class="form-group" method="GET" id="form">
        <h1><?php echo !strpos($actual_link,'index.php') ? 'What is a #'.$search : 'InstaWall'?></h1>
        <input type="text" name="search" class="form-control" >
    <div class="result" id="day">
      <h2>best of the day</h2>
      <ol>
      <?php
        $foo = instawall::sql("SELECT parola, count(id) as tot FROM :table WHERE (data BETWEEN '".date('Y-m-d H:i:s', strtotime( '-1 days' ))."' AND '".date('Y-m-d H:i:s')."') GROUP BY parola ORDER BY tot DESC LIMIT 10");
        foreach($foo as $one) {
          $r = $one->get();
          echo '<li><a href="https://matteoenna.it/tools/instawall/'.$r["parola"].'.html">'.$r["parola"].'</a></li>';
        }
      ?>
    </ol>
    </div>
    <div class="result" id="week">
        <h2>best of the week</h2>
      <ol>
      <?php
        $foo = instawall::sql("SELECT parola, count(id) as tot FROM :table WHERE (data BETWEEN '".date('Y-m-d H:i:s', strtotime( '-7 days' ))."' AND '".date('Y-m-d H:i:s')."') GROUP BY parola ORDER BY tot DESC LIMIT 10");
        foreach($foo as $one) {
          $r = $one->get();
          echo '<li><a href="https://matteoenna.it/tools/instawall/'.$r["parola"].'.html">'.$r["parola"].'</a></li>';
        }
      ?>
    </ol>
      
    </div>
    <div class="result" id="month">
        <h2>best of the month</h2>
      <ol>
      <?php
        $foo = instawall::sql("SELECT parola, count(id) as tot FROM :table WHERE (data BETWEEN '".date('Y-m-d H:i:s', strtotime( '-30 days' ))."' AND '".date('Y-m-d H:i:s')."') GROUP BY parola ORDER BY tot DESC LIMIT 10");
        foreach($foo as $one) {
          $r = $one->get();
          echo '<li><a href="https://matteoenna.it/tools/instawall/'.$r["parola"].'.html">'.$r["parola"].'</a></li>';
        }
      ?>
    </ol>
      
    </div>
    <div class="result" id="year">
        <h2>best of the year</h2>
      <ol>
      <?php
        $foo = instawall::sql("SELECT parola, count(id) as tot FROM :table WHERE (data BETWEEN '".date('Y-m-d H:i:s', strtotime( '-365 days' ))."' AND '".date('Y-m-d H:i:s')."') GROUP BY parola ORDER BY tot DESC LIMIT 10");
        foreach($foo as $one) {
          $r = $one->get();
          echo '<li><a href="https://matteoenna.it/tools/instawall/'.$r["parola"].'.html">'.$r["parola"].'</a></li>';
        }
      ?>
    </ol>
      
    </div>
    <div class="result" id="ever">
        <h2>best ever</h2>
      <ol>
      <?php
        $foo = instawall::sql("SELECT parola, count(id) as tot FROM :table WHERE 1 GROUP BY parola ORDER BY tot DESC LIMIT 10");
        foreach($foo as $one) {
          $r = $one->get();
          echo '<li><a href="https://matteoenna.it/tools/instawall/'.$r["parola"].'.html">'.$r["parola"].'</a></li>';
        }
      ?>
    </ol>
      
    </div>
  </form>
    
    
    <div class="col-xs-12 col-md-12 nec" id="footer-bottom">
Mi chiamo <a href="https://matteoenna.it">Matteo Enna</a>, sono uno Sviluppatore Web (PHP e JavaScript) e Open Source Evangelist. Son appassionato di Telegram e tecnologie libere.
    </div>
    <div id="cookie-notice" class="cn-top bootstrap" style="color: rgb(255, 255, 255); background-color: rgb(0, 0, 0); display: block;">
        <div class="cookie-notice-container">
            <span id="cn-notice-text">Utilizziamo i cookie per essere sicuri che tu possa avere la migliore esperienza sul nostro sito. Se continui ad utilizzare questo sito noi assumiamo che tu ne sia felice. </span>
            <a href="#" id="cn-accept-cookie" data-cookie-set="accept" class="cn-set-cookie button bootstrap">Ok</a>
            <a href="http://matteoenna.it/privacy-policy/" target="_blank" id="cn-more-info" class="button bootstrap">Leggi di più</a>
        </div>
    </div>
<script type='text/javascript'>
//<![CDATA[
jQuery.cookie = function (key, value, options) {
// key and at least value given, set cookie...
if (arguments.length > 1 && String(value) !== "[object Object]") {
options = jQuery.extend({}, options);
if (value === null || value === undefined) {
options.expires = -1;
}
if (typeof options.expires === 'number') {
var days = options.expires, t = options.expires = new Date();
t.setDate(t.getDate() + days);
}
value = String(value);
return (document.cookie = [
encodeURIComponent(key), '=',
options.raw ? value : encodeURIComponent(value),
options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
options.path ? '; path=' + options.path : '',
options.domain ? '; domain=' + options.domain : '',
options.secure ? '; secure' : ''
].join(''));
}
// key and possibly options given, get cookie...
options = value || {};
var result, decode = options.raw ? function (s) { return s; } : decodeURIComponent;
return (result = new RegExp('(?:^|; )' + encodeURIComponent(key) + '=([^;]*)').exec(document.cookie)) ? decode(result[1]) : null;
};
//]]>

</script>
    <script type='text/javascript'>
    /* <![CDATA[ */
    var cnArgs = {"ajaxurl":"https:\/\/matteoenna.it\/wp-admin\/admin-ajax.php","hideEffect":"fade","onScroll":"no","onScrollOffset":"100","cookieName":"cookie_notice_accepted","cookieValue":"TRUE","cookieTime":"2592000","cookiePath":"\/","cookieDomain":""};
    /* ]]> */
    
    </script>
    <script type='text/javascript' src='https://matteoenna.it/wp-content/plugins/cookie-notice/js/front.js?ver=1.2.35'></script>

</div>
</body>
</html>
