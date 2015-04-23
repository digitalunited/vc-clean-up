<?php
return [
    'enabledStdModules' => [
        'vc_video',
        'vc_empty_space',
        'vc_column_text',
        'vc_column',
        'vc_column_inner',
        'vc_row',
        'vc_row_inner',
    ],
    'useBootstrapGrid' => true,
    'deregisterFrontendStyles' => true,
    'disableFrontendEditor' => false,
    'removeExtraClassNameField' => true,
    'removeDesignOptionsTab' => true,
    'enableRowLayouts' => [ //TRUE or ARRAY
        '1/1',
        '1/2 + 1/2',
        '1/3 + 1/3 + 1/3',
        '1/4 + 1/4 + 1/4 + 1/4',
        '1/6 + 1/6 + 1/6 + 1/6 + 1/6 + 1/6'
    ],
    //'newRowLayouts' => [[],[],[]]
    'setVcAsTheme' => true,
    'disableGridElements' => true,
    'keepDefaultTemplates' => [],
    'hideVcAdminButtons' => true,
];