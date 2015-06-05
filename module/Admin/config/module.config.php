<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Admin\Controller\Index' => 'Admin\Controller\IndexController'
        ),
    ),
      
   'router' => array(
        'routes' => array(
            'admin' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/admin[/][:controller][/][:action][/][id/:id]',
                    'constraints' => array(
                       'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'         => '[0-9]+',
                    ),
                    'defaults' => array(
                       '__NAMESPACE__' => 'Admin\Controller',
                        'controller' => 'Admin\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
   
    'view_manager' => array(       
        'template_path_stack' => array(
            'admin' => __DIR__ . '/../view',
        ),
    ),
);