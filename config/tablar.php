<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    | Here you can change the default title of your admin panel.
    |
    */

    'title' => 'Datos',
    'title_prefix' => '',
    'title_postfix' => '',
    'bottom_title' => 'Tablar',
    'current_version' => 'v4.8',


    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    */

    'logo' => '<b>Tab</b>LAR',
    'logo_img_alt' => 'Admin Logo',

    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    |
    | Here you can set up an alternative logo to use on your login and register
    | screens. When disabled, the admin panel logo will be used instead.
    |
    */

    'auth_logo' => [
        'enabled' => false,
        'img' => [
            'path' => 'assets/tablar-logo.png',
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 50,
            'height' => 50,
        ],
    ],

    /*
     *
     * Default path is 'resources/views/vendor/tablar' as null. Set your custom path here If you need.
     */

    'views_path' => null,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look at the layout section here:
    |
    */

    'layout' => 'combo',
    //boxed, combo, condensed, fluid, fluid-vertical, horizontal, navbar-overlap, navbar-sticky, rtl, vertical, vertical-right, vertical-transparent

    'layout_light_sidebar' => null,
    'layout_light_topbar' => true,
    'layout_enable_top_header' => false,

    /*
    |--------------------------------------------------------------------------
    | Sticky Navbar for Top Nav
    |--------------------------------------------------------------------------
    |
    | Here you can enable/disable the sticky functionality of Top Navigation Bar.
    |
    | For detailed instructions, you can look at the Top Navigation Bar classes here:
    |
    */

    'sticky_top_nav_bar' => false,

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions, you can look at the admin panel classes here:
    |
    */

    'classes_body' => '',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions, you can look at the urls section here:
    |
    */

    'use_route_url' => true,
    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password.request',
    'password_email_url' => 'password.email',
    'profile_url' => false,
    'setting_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Display Alert
    |--------------------------------------------------------------------------
    |
    | Display Alert Visibility.
    |
    */
    'display_alert' => false,

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    |
    */

'menu' => [
    // Navbar items:
    [
        'text' => 'Home',
        'icon' => 'ti ti-home',
        'url' => 'home',
        'roles' => ['admin', 'control_escolar', 'servicio_financiero'] // Excluir rol 'alumno'
    ],
    [
        'text' => 'Alumnos',
        'url' => 'alumnos',
        'icon' => 'ti ti-user',
        'roles' => ['control_escolar', 'admin'] // Excluir rol 'alumno'
    ],
    
  
   
    // Ítem de menú para el formulario de examen, visible solo para alumnos
    [
        'text' => 'Nueva solicitud de pago de examenes',
        'url' => 'formulario',
        'icon' => 'ti ti-file',
        'roles' => ['alumno']
    ],
    // Ítem de menú para los servicios, visible solo para alumnos
    [
        'text' => 'Nueva solicitud de servicios',
        'url' => 'servicios',
        'icon' => 'ti ti-file',
        'roles' => ['alumno']
    ],
    // Ítem de menú para el expediente de solicitudes, visible solo para alumnos
    [
        'text' => 'Expediente de solicitudes',
        'url' => 'expediente',
        'icon' => 'ti ti-folder',
        'roles' => ['alumno']
    ],
    // Ítem de menú para la vista de expedientes de servicios sociales, visible solo para control_escolar
    [
        'text' => 'Expedientes de Solicitudes de Servicios',
        'url' => 'control_user/expedientes-finalizados',
        'icon' => 'ti ti-folder',
        'roles' => ['control_escolar', 'admin']
    ],
    [
        'text' => 'Materias',
        'url' => 'materias',
        'icon' => 'ti ti-folder',
        'roles' => ['control_escolar','Admin']
    ],
    [
        'text' => 'Carrusel',
        'url' => 'carrusel',
        'icon' => 'ti ti-folder',
        'roles' => ['control_escolar','Admin','servicio_financiero',]
    ],
   
],




    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    |
    */
'filters' => [
    TakiElias\Tablar\Menu\Filters\GateFilter::class,
    TakiElias\Tablar\Menu\Filters\HrefFilter::class,
    TakiElias\Tablar\Menu\Filters\SearchFilter::class,
    TakiElias\Tablar\Menu\Filters\ActiveFilter::class,
    TakiElias\Tablar\Menu\Filters\ClassesFilter::class,
    TakiElias\Tablar\Menu\Filters\LangFilter::class,
    TakiElias\Tablar\Menu\Filters\DataFilter::class,
    App\Filter\RolePermissionMenuFilter::class, // Agregamos la nueva clase de filtro
],

    /*
    |--------------------------------------------------------------------------
    | Vite
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Vite support.
    |
    | For detailed instructions you can look the Vite here:
    | https://laravel-vite.dev
    |
    */

    'vite' => true,

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://livewire.laravel.com
    |
    */

    'livewire' => false,
];
