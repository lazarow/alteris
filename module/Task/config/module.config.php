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
							'route'    => '[:controller[/:action[/:id]]]',
                            'constraints' => [
								'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'         => '[0-9]+',
							],
                            'defaults' => [
								'__NAMESPACE__' => 'Task\Controller',
								'action'        => 'index'
							]
						]
					]
				]
			]
		]
	],
	'controllers' => [
		'invokables' => [
			'Task\Controller\Index' => Controller\IndexController::class,
			'Task\Controller\Unit' => Controller\UnitController::class,
			'Task\Controller\Console' => Controller\ConsoleController::class
		]
	],
	'doctrine' => [
		'driver' => [
			'TaskEntityDriver' => [
				'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
				'cache' => 'array',
				'paths' => [__DIR__ . '/../src/Task/Entity']
			],
			'TaskModelEntityDriver' => [
				'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
				'cache' => 'array',
				'paths' => [__DIR__ . '/../src/Task/Model']
			],
			'orm_default' => [
				'drivers' => [
					'Task\Entity' => 'TaskEntityDriver',
					'Task\Model' => 'TaskModelEntityDriver',
				]
			]
		]
	],    
	'view_manager' => [
		'display_not_found_reason' => true,
		'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
		'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
		'template_path_stack'      => [__DIR__ . '/../view'],
        'template_map'             => [
			'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
			'error/404'     => __DIR__ . '/../view/error/404.phtml',
            'error/index'   => __DIR__ . '/../view/error/index.phtml'
		]
	],
	'console' => [
		'router' => [
			'routes' => [
				'fix-entities' => [
					'options' => [
						'route'    => 'fix-entities',
                        'defaults' => array(
                            'controller' => 'Task\Controller\Console',
                            'action'     => 'fix-entities'
                        )
					]
				]
			]
		]
	]
];