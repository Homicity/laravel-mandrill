<?php

return [
    /**
     * Should the mandrill emails queue.
     */
    'queue' => false,

    /**
     * The mandrill account api key.
     */

    /**
     * TODO: Remove my mandrill api key
     */
//    'api_secret' => env('MANDRILL_SECRET') ?? 'your-api-key',
    'api_secret' => 'ZT5C7uaNJDmpZa8nZTFyWQ',
    /**
     * The email address the message is sent from
     */
    'from_email' => env('MANDRILL_FROM_EMAIL') ?? '',

    /**
     * The name the message is sent from
     */
    'from_name'  => env('MANDRILL_FROM_NAME') ?? '',
];