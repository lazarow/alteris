<?php
namespace Task;
return [
	'router' => [
		'routes' => [
			'task' => [
				'type'    => 'Literal',
				'options' => [
					'route' => '/',
                    'defaults' => [
                        'controller' => 'Task\Controller\Index',
                        'action'     => 'index',
                    ]
				],
				'may_terminate' => true,
				'child_routes'  => [
					'default' => [
						'type'    => 'Segment',
                        'options' => [
							'route'    => '/[:controller[/:action]]',
                            'constraints' => [
								'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
							],
                            'defaults' => [ '__NAMESPACE__' => 'Task\Controller']
						]
					]
				]
			]
		]
	],
	'controllers' => [
		'invokables' => [
			'Task\Controller\Index' => Controller\IndexController::class
		]
	],
	'view_manager' => [
		'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'template_map' => [
			'layout/layout'    => __DIR__ . '/../view/layout/layout.phtml',
            'task/index/index' => __DIR__ . '/../view/task/index/index.phtml'
		],
        'template_path_stack' => [__DIR__ . '/../view']
	]
];