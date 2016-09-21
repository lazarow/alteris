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
                                'action'     => '[0-9]+',
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
			'Task\Controller\Unit' => Controller\UnitController::class
		]
	],
	'doctrine' => [
		'driver' => [
			'TaskDriver' => [
				'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
				'cache' => 'array',
				'paths' => [__DIR__ . '/../src/Task/Entity']
			],
			'orm_default' => [
				'drivers' => ['Task\Entity' => 'TaskDriver']
			]
		]
	],    
	'view_manager' => [
        'doctype'      => 'HTML5',
        'template_map' => [
			'layout/layout' => __DIR__ . '/../view/layout/layout.phtml'
		],
        'template_path_stack' => [__DIR__ . '/../view']
	]
];