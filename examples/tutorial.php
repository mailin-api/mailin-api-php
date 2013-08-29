<?php

include("../mailin.php");

$mailin = new Mailin("http://api.mailinblue.com","youraccesskey","yoursecretkey");
$campaigns = $mailin->get_campaigns();

?>
