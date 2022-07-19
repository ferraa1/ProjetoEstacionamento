<?php

spl_autoload_register(function ($nomeClasse) {
  if (file_exists("classes/".$nomeClasse.".class.php"))
    require_once("classes/".$nomeClasse.".class.php");
});

?>