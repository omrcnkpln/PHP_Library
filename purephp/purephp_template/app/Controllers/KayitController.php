<?php

if (post("kayitPost")) {
    print_r($_POST);
}

require view("Kayit");