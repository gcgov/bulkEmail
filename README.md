# GCGOV Email Package

Internal applications can include this package to generate bulk emails by subscribed channels or to send individual
emails via the bulk email queue.

## Installation

`composer require gcgov/bulk-email`

---

## API Configuration
Prior to calling any methods in the library, define the api url and your access token.

```php
\gcgov\framework\services\bulkEmail\config::setApiUrl( 'https://bulkemailapi.example.com' );
\gcgov\framework\services\bulkEmail\config::setApiAccessToken( '{jwt}' );
```

---

## Debug Logging
To enable debug logging, add these lines prior to using the library.

```php
\gcgov\framework\services\bulkEmail\config::setDebugLogging( true );
\gcgov\framework\services\bulkEmail\config::setDebugLogPath( 'C:/inetpub/logs' );
```

---
## Save & Subscribe Email Addresses to Channels

This method will subscribe all provided email address to all provided channel ids. If a provided email address has
existing channel subscriptions, the existing subscriptions will remain and new channels provided will be added as
additional subscriptions. If a provided email address is already subscribed to a provided channel, the user will remain
subscribed to that provided channel and new channels provided will be added as additional subscriptions.

```php
//                                             messageToChannel( string[] $emailAddresses,   string[] $channelIds=[] )
\gcgov\framework\services\bulkEmail\bulkEmail::messageToChannel( ['jdoe@garrettcounty.org'], [ '64f1e3a45d0afbf5408370cc' ] );
```

## Send a Bulk Email to Channel Subscribers

This method will queue the same message to *every* email address subscribed to a particular channel.

Actual mail sending is handled by the [Bulk Email API](https://github.com/gcgov/bulkEmailApi) and may be delayed based
on message priority and sending limits.

```php
$message            = new \gcgov\framework\services\bulkEmail\models\messageToChannel();

//wrap $message->message with this template
$message->template  = \gcgov\framework\services\bulkEmail\models\template::countyTemplate2023; 

//if the brand heading should use department information, specify the id of the department to use. To use a generic leave null)
//$message->sendingDepartmentId  = '{departmentId}';

//send this message to all subscribers to this channel
$message->channelId = '{channelId}';

//email subject line
$message->subject   = 'Subject';

//email html body - do not use full 
$message->message   = '<div>HTML message body</div>';

//a reference to the event/item that generated this message
$message->reference = 'website.article.id=1';

//send
\gcgov\framework\services\bulkEmail\bulkEmail::messageToChannel( $message );
```

## Send an Individual Email

To send an individual email, use `bulkEmail::messageToEmail()`

```php
$message            = new \gcgov\framework\services\bulkEmail\models\messageToEmail();

//wrap $message->message with this template
$message->template  = \gcgov\framework\services\bulkEmail\models\template::countyTemplate2023; 

//if the brand heading should use department information, specify the id of the department to use. To use a generic leave null)
//$message->sendingDepartmentId  = '{departmentId}';

//send this message to these email addresses
$message->to = ['jdoe@garrettcounty.org'];

//email subject line
$message->subject   = 'Subject';

//email html body - do not use full 
$message->message   = '<div>HTML message body</div>';

//a reference to the event/item that generated this message
$message->reference = 'payments.receipt.id=1';

//send
\gcgov\framework\services\bulkEmail\bulkEmail::messageToEmail( $message );
```
