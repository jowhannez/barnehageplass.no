<?php

return [
    '*' => [
        'securityKey'                      => getenv('SECURITY_KEY'),
        'baseUrl'                          => getenv('BASE_URL'),
        'pageTrigger'                      => 'p/',
        'errorTemplatePrefix'              => 'errors/_',
        'maxUploadFileSize'                => 67108864,
        'defaultWeekStartDay'              => 1,
        'omitScriptNameInUrls'             => true,
        'limitAutoSlugsToAscii'            => true,
        'convertFilenamesToAscii'          => true,
        'generateTransformsBeforePageLoad' => true,
        'enableAnalytics'                  => false,
        'defaultSearchTermOptions'         => [
            'subLeft'  => true,
            'subRight' => true,
        ],
        /* Google tag manager config */
        'enableGTM'                        => false,
        'GTMid'                            => '',
    ],
    'dev' => [
        'devMode'               => true,
        'enableTemplateCaching' => false
    ],
    'staging' => [
        'devMode'               => true,
        'enableTemplateCaching' => false,
        'allowAdminChanges'     => false
    ],
    'production' => [
        'enableGTM' => true,
        'allowAdminChanges' => false
    ],
];
