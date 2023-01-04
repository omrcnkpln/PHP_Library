<?php
function controller($name)
{
    return CONTROLLERS . $name . ".php";
}

function view($name)
{
    return VIEWS . $name . ".php";
}