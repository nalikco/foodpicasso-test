<?php

return [
    'env' => getenv('ENV'),
    'errors' => [
        'display_error_details' => (bool) getenv('DISPLAY_ERROR_DETAILS'),
        'log_errors' => (bool) getenv('LOG_ERRORS'),
        'log_error_details' => (bool) getenv('LOG_ERROR_DETAILS'),
    ],
];
