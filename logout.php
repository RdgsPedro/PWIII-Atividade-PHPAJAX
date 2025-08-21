<?php
session_start();
session_destroy();
header("Location: index.html"); // volta para login
exit;

