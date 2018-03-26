<?php

return [

    /*
     * Path to a json file containing the credentials of a Google Service account.
     */
    'client_secret_json' => base_path(env('GOOGLE_CREDENTIAL_JSON', 'client_secret.json')),

    /*
     *  The id of the Google Calendar that will be used by default.
     */
    'calendar_id' => env('GOOGLE_CALENDAR_ID', 'dahq1dk1fosmo69irjfr0vuj8g@group.calendar.google.com'),

];
