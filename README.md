# Mailin PHP library

This is the mailinblue PHP library.It implements the various exposed APIs that you can read more about on https://apidocs.mailinblue.com.

It currently supports all the API calls for v1.0. Each call returns an Object that is documented in our API docs, here are the objects.

 * Account
 * Campaign
 * Campaign statistics
 * Folder
 * List
 * Attribute
 * User
 * SMS
 * Process

### SMTP APIs

 * File
 * Mail
 * Bounces
 * Template
 * Report
 * Statistics
 * Webhooks

## Quickstart

1. You will need to first get the Access key and Secret key from [Mailinblue](https://www.mailinblue.com).

2. Assuming that you have cloned this git repo, or downloaded mailin.php. You can use this small sample script to get started

```PHP
<?php

require('../mailin.php');
/*
 * This will initiate the API with the endpoint and your access and secret key.
 *
 */
$mailin = new Mailin('http://api.mailinblue.com/v1.0','Your access key','Your secret key');
/*
 * This will send an email to to@email.com, without any CC or BCC without any attachements.
 *
 */
$mailin->send_email({"to@email.com":"name1"},{},{},[],{"replyto@email.com":"Reply name"},"Subject","Text body","HTML body",[]);

?>
```
3. To explore more, you should visit the [Mailin API documentation](https://apidocs.mailinblue.com).
