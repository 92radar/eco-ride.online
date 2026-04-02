<?php
session_start();
header('Content-Type: image/jpeg');

echo file_get_contents('../public/uploads/' . $_SESSION['photo']);
