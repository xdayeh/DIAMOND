<?php
return [
    'template' => [
        'navbar' 			=> TEMPLATE_PATH . 'navbar.php',
        'container' 		=> TEMPLATE_PATH . 'container.php',
        ':view' 			=> ':action_view'
    ],
    'header_resources' => [
        'css' => [
            'fontawesome' 	=> CSS . 'fontawesome.min.css',
            'animate' 	=> CSS . 'animate.min.css',
            'style' 		=> CSS . 'style2.css'
        ],
        'js' => [
            'jquery' 		=> JS . 'jquery-3.6.0.min.js'
        ]
    ],
    'footer_resources' => [
        'bootstrap' 	=> JS . 'bootstrap.min.js',
        'custom' 		=> JS . 'custom.js'
    ]
];
