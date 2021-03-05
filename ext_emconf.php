<?php

/** @var string $_EXTKEY */
$EM_CONF[$_EXTKEY] = [
    'title' => 'Amazon Simple Email Service (AWS SES)',
    'description' => 'Send emails with AWS SES.',
    'category' => 'services',
    'version' => '1.0.0',
    'state' => 'stable',
    'author' => 'Markus Hölzle',
    'author_email' => 'typo3@markus-hoelzle.de',
    'author_company' => 'different.technology',
    'clearCacheOnLoad' => false,
    'constraints' =>
        [
            'depends' =>
                [
                    'typo3' => '10.4.0-10.4.99',
                ],
            'conflicts' => [],
            'suggests' => [],
        ],
    'autoload' => [
        'classmap' => [
            'Resources/Private/vendor'
        ]
    ],
];
