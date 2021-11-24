<?php

use Todo\Router;

//custom routes
Router::add('^task/(?P<id>[\d]+)/?$', ['controller' => 'Task', 'action' => 'show']);
Router::add('^task/edit/(?P<id>[\d]+)/?$', ['controller' => 'Task', 'action' => 'edit']);
Router::add('^task/update/(?P<id>[\d]+)/?$', ['controller' => 'Task', 'action' => 'update']);
Router::add('^task/create/?$', ['controller' => 'Task', 'action' => 'create']);
Router::add('^task/store/?$', ['controller' => 'Task', 'action' => 'store']);

Router::add('^login/?$', ['controller' => 'Auth', 'action' => 'login', 'prefix' => 'admin']);
Router::add('^logout/?$', ['controller' => 'Auth', 'action' => 'logout', 'prefix' => 'admin']);
Router::add('^authenticate/?$', ['controller' => 'Auth', 'action' => 'authenticate', 'prefix' => 'admin']);


// default routes
/*Router::add('^admin$', ['controller' => 'Main', 'action' => 'index', 'prefix' => 'admin']);
Router::add('^admin/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', ['prefix' => 'admin']);*/

Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');