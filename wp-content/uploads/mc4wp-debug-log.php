<?php exit; ?>
[2020-09-01 10:04:39] WARNING: Form 2706 > mc@tw**********.com is already subscribed to the selected list(s)
[2020-09-21 12:00:09] ERROR: Form 2706 > Mailchimp API error: 400 Bad Request. Invalid Resource. nore***@ga******.ru has signed up to a lot of lists very recently; we're not allowing more signups for now

Request: 
POST https://us17.api.mailchimp.com/3.0/lists/ac37ead6d1/members

{"status":"pending","email_address":"nore***@ga******.ru","interests":{},"merge_fields":{},"email_type":"html","ip_signup":"91.246.213.104","tags":[]}

Response: 
400 Bad Request
{"type":"http://developer.mailchimp.com/documentation/mailchimp/guides/error-glossary/","title":"Invalid Resource","status":400,"detail":"nore***@ga******.ru has signed up to a lot of lists very recently; we're not allowing more signups for now","instance":"cc01d868-cd8f-4c8e-8e68-2231fecbad7d"}
[2020-10-13 04:40:10] ERROR: Form 2706 > Mailchimp API error: 400 Bad Request. Invalid Resource. rael*********@ma**.ru has signed up to a lot of lists very recently; we're not allowing more signups for now

Request: 
POST https://us17.api.mailchimp.com/3.0/lists/ac37ead6d1/members

{"status":"pending","email_address":"rael*********@ma**.ru","interests":{},"merge_fields":{},"email_type":"html","ip_signup":"52.188.171.209","tags":[]}

Response: 
400 Bad Request
{"type":"http://developer.mailchimp.com/documentation/mailchimp/guides/error-glossary/","title":"Invalid Resource","status":400,"detail":"rael*********@ma**.ru has signed up to a lot of lists very recently; we're not allowing more signups for now","instance":"5b368106-6d38-44b2-a8dc-6110bebe96aa"}
