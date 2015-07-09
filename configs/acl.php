<?php
/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 5.07.2015
 * Time: 16:27
 */
define ('DEFAULT_SITE_ROLE', 'guest');

$acl=[
    'admin'=>[
        'site'=>['index', 'login', 'logout', 'err403'],
        'contacts'=>['index', 'edit', 'save', 'del'],
        'users'=>['index', 'edit', 'save', 'del', 'add', 'changepassword']
        ],
    'user'=>[
        'site'=>['index', 'login', 'logout', 'err403'],
        'users'=>['index']    
    ],
    'guest'=>[
        'site'=>['index', 'login', 'err403']
    ]
];
