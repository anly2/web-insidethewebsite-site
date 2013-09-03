<?php
definitions:
{
   $_pages = array(
      "home"      => "pages/home.html",
      "services"  => "pages/home.html",
      "portfolio" => "pages/portfolio.html",
      "contact"   => "pages/contact.html",
      "shop"      => "pages/home.html",
      "quotes"    => "pages/home.html",
      "vendornfo" => "pages/home.html"
   );
   $_links = array (
      "fb" => "pages/home.html",
      "yt" => "pages/home.html",
      "tw" => "pages/home.html"
   );
   $_css = array (
      "master" => "css/master.css",
      "home"   => "css/home.css"
   );
   $_js = array (
      "hint" => "js/hint.js"
   );
}

environment:
{
   $page = "";

   if (count($_REQUEST) == 0)
      $page = "home";
   else
      foreach ($_REQUEST as $key => $value)
      {
         $k = strtolower($key);
         switch ($k)
         {
            case "home":
               $page = "home";
               break;

            case "services":
            case "service":
               $page = "services";
               break;

            case "portfolio":
            case "port":
            case "folio":
               $page = "portfolio";
               break;

            case "contact":
               $page = "contact";
               break;

            case "shop":
               $page = "shop";
               break;

            case "testimonials":
            case "quotes":
               $page = "quotes";
               break;

            case "vendorinfo":
            case "vendornfo":
            case "vendor":
            case "vendr":
            case "info":
            case "nfo":
               $page = "vendornfo";
               break;


            case "facebook":
            case "fb":
               $page = "";
               $_REQUEST['redir'] = $_links['fb'];
               break;

            case "youtube":
            case "yt":
               $page = "";
               $_REQUEST['redir'] = $_links['yt'];
               break;

            case "twitter":
            case "tw":
               $page = "";
               $_REQUEST['redir'] = $_links['tw'];
               break;
         }
      }

}

actions:
{
   if ($page != "")
   {
      $uri = $_pages[$page];

      if (!file_exists($uri))
      {
         echo 'Sorry, the page <br />'."\n";
         echo '<em><i>'.$uri.'</i> &nbsp; (<b>'.$page.'</b>)</em>'."\n";
         echo '<br /> was not found!'."\n";
         echo '<br />'."\n";
         echo '<br /> <a href="?">Homepage</a>'."\n";
         exit;
      }

      $contents = file_get_contents( $uri );

      if (strtolower(substr($uri, -4)) == ".php")
      {
         //// initial "<\?php" tag and (??) finalizing "?\>" tag  must be trimmed
         $contents = trim($contents);

         if (substr($contents, 0, 5) == "<?php")
            $contents = substr($contents, 5);
         else
         if (substr($contents, 0, 2) == "<?")
            $contents = substr($contents, 2);
         else
            $contents = "?>\n".$contents;

         eval ($contents);
      }
      else
         echo $contents;

      exit;
   }


   if (isset($_REQUEST['redir']))
   {
      echo '<a href="'.$_REQUEST['redir'].'">Proceed</a>'."\n";
      echo '<script type="text/javascript"> window.location.href="'.$_REQUEST['redir'].'"; </script>'."\n";
      exit;
   }


   if (isset($_REQUEST['message']))
   {
      ////process contact form
   }


   if (isset($_REQUEST['quote']))
   {//NOTE: note "quoteS" (not plural)

      ////return a formated(?) quote
   }


   if (isset($_REQUEST['css']))
   {
      $csscode = "";

      if (isset($_REQUEST['master']) || count($_REQUEST) == 1)
      {
         $csscode .= "\n\n /* master sheet */ \n\n";
         $csscode .= file_get_contents( $_css['master'] );
      }

      if (isset($_REQUEST['home']) || count($_REQUEST) == 1)
      {
         $csscode .= "\n\n /* home sheet */ \n\n";
         $csscode .= file_get_contents( $_css['home'] );
      }

      echo $csscode;
      exit;
   }


   if (isset($_REQUEST['js']))
   {
      $jscode = "";

      if (isset($_REQUEST['hint']))
      {
         $jscode .= "\n\n /* hint snipet */ \n\n";
         $jscode .= file_get_contents( $_js['hint'] );
      }

      echo $jscode;
      exit;
   }
}

?>