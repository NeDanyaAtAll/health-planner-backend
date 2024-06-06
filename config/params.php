<?php

return [
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',

    'cors' => [
        // 'Access-Control-Allow-Origin' => ['http://localhost:8080'],
        'Origin' => ['*'],
        'Access-Control-Request-Method' => ['*'],
        'Access-Control-Request-Method' => ['POST', 'PUT', 'OPTIONS', 'GET', 'PATCH', 'DELETE'],
        'Access-Control-Allow-Headers' => ['X-Wsse', 'Authorization', 'content-type', 'Content-Disposition'],
        'Access-Control-Allow-Credentials' => true, // Allow credentials (cookies, authorization headers, etc.) to be exposed to the browser
        'Access-Control-Max-Age' => 1, // Allow OPTIONS caching
        'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page', 'X-Pagination-Total-Count', 'X-Pagination-Page-Count', 'Content-Disposition'],
    ],
];
