<?php

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            'trip' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'     => '/book',
                    'defaults'  => array(
                        'controller' => 'Application\Controller\Trip',
                        'action'     => 'search'
                    ),
                ),
            ),
            'admin' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'     => '/admin',
                    'defaults'  => array(
                        'controller' => 'Application\Controller\Admin',
                        'action'     => 'index'
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'page' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/[:action]',
                            'constraints' => array(
                                'action' => '[a-z]+'
                            )
                        )
                    ),
                )
            ),
            'manager' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'     => '/admin/manager',
                    'defaults'  => array(
                        'controller' => 'Application\Controller\Manager',
                        'action'     => 'index'
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'page' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/[:action]',
                            'constraints' => array(
                                'action' => '[a-z]+'
                            )
                        )
                    ),
                )
            ),
            'operator' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'     => '/admin/operator',
                    'defaults'  => array(
                        'controller' => 'Application\Controller\Operator',
                        'action'     => 'index'
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'page' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/[:action]',
                            'constraints' => array(
                                'action' => '[a-z]+'
                            )
                        )
                    ),
                )
            ),
            'regulation' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'     => '/admin/regulation',
                    'defaults'  => array(
                        'controller' => 'Application\Controller\Regulation',
                        'action'     => 'index'
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'page' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/[:action]',
                            'constraints' => array(
                                'action' => '[a-z]+'
                            )
                        )
                    ),
                )
            ),
            'route' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'     => '/admin/route',
                    'defaults'  => array(
                        'controller' => 'Application\Controller\Route',
                        'action'     => 'index'
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'page' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/[:action]',
                            'constraints' => array(
                                'action' => '[a-z]+'
                            )
                        )
                    ),
                )
            ),
            'car' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'     => '/admin/car',
                    'defaults'  => array(
                        'controller' => 'Application\Controller\Car',
                        'action'     => 'index'
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'page' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/[:action]',
                            'constraints' => array(
                                'action' => '[a-z]+'
                            )
                        )
                    ),
                )
            ),
            'ajax' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/syn',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Ajax',
                        'action' => 'index'
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'page' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/:action',
                            'constraints' => array(
                                'alias'  => '[a-z_]+'
                            ),
                        )
                    ),
                )
            ),
        ),
    ),

    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),

    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),

    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index'      => 'Application\Controller\IndexController',
            'Application\Controller\Trip'       => 'Application\Controller\TripController',
            'Application\Controller\Admin'      => 'Application\Controller\AdminController',
            'Application\Controller\Manager'    => 'Application\Controller\ManagerController',
            'Application\Controller\Operator'   => 'Application\Controller\OperatorController',
            'Application\Controller\Regulation' => 'Application\Controller\RegulationController',
            'Application\Controller\Route'      => 'Application\Controller\RouteController',
            'Application\Controller\Car'      => 'Application\Controller\CarController',
            'Application\Controller\Ajax'       => 'Application\Controller\AjaxController',
        ),
    ),

    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);
