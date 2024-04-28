<?php

session_start();

//limpar todas as variaveis de uma sessão
session_unset();


//destruir a sessão atual
session_destroy();

header("location: ../index.php?error=none");
