<?php

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller' => 'Index',
                        'action' => 'index',
                    ), //'defaults'
                ), //'options'
            ), //'home'
            //START - Them router cho MODULE Application
            'application' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller' => 'Index',
                        'action' => 'index',
                    ), //'defaults'
                ), //'options'
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action[/]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ), //'constraints'
                            'defaults' => array(
                            ), //'defaults'
                        ), //'options'
                    ), //'default'
                ), //'child_routes'
            ), //'application'
        //END - Them router cho MODULE Application
        ), //'routes'
    ), //'router'
    //Bat buoc phai co khong thi se co loi
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            'Application\Controller\Item' => 'Application\Controller\ItemController'
        ),
    ),
    //Bat buoc phai co thì mới load duoc View
    'view_manager' => array(
        'doctype' => 'HTML5',
        'display_not_found_reason' => true,
        'not_found_template' => 'error/404',
        'template_map' => array(
            'error/404' => __DIR__ . '/../view/error/404.phtml'
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    )
);
