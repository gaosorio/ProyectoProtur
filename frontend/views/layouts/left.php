<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->

        <?php
        if(!Yii::$app->user->isGuest)
        {  
        if((Yii::$app->user->identity->nivel)==2)
        {
            echo dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menu', 'options' => ['class' => 'header']],
                    ['label' => 'Inicio', 'icon' => 'home', 'url' => ['/site/index']],
                    [
                        'label' => 'Restaurante',
                        'icon' => 'dot-circle-o',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Servicio', 'icon' => 'cutlery', 'url' => ['/servicio/index']],
                            ['label' => 'Personal','icon' => 'users', 'url' => ['/personalrestaurante/index']],
                            ['label' => 'Consumo','icon' => 'money', 'url' => ['/consumo/index']],
                            [
                                'label' => 'Gráficos',
                                'icon' => 'pie-chart',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Personas Atendidas', 'icon' => 'line-chart', 'url' => ['/graficos/personasatendidas']],
                                    ['label' => 'Consumo Promedio', 'icon' => 'line-chart', 'url' => ['/graficos/consumopromedio']],
                                    ['label' => 'Personal Contratado', 'icon' => 'line-chart', 'url' => ['/graficos/personalcontratado']],
                                ],
                            ],
                        ],
                    ],
                    [
                        'label' => 'Hotel',
                        'icon' => 'dot-circle-o',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Habitacion', 'icon' => 'square', 'url' => ['/habitacion/index']],
                            ['label' => 'Personal','icon' => 'users', 'url' => ['/personalh/index']],
                            ['label' => 'Huesped','icon' => 'bed', 'url' => ['/huesped/index']],
                            ['label' => 'Paises de origen','icon' => 'globe', 'url' => ['/origen/index']],
                            [
                                'label' => 'Gráficos',
                                'icon' => 'pie-chart',
                                'url' => '#',
                                'items' => [
                                ['label' => 'Tarifa promedio', 'icon' => 'bar-chart', 'url' => ['/graficotarifa/create']],
                                ['label' => 'Habitaciones disponibles', 'icon' => 'bar-chart', 'url' => ['/graficotarifa/cantidadhabitaciones']],
                                ['label' => 'Porcentaje ocupación', 'icon' => 'bar-chart', 'url' => ['/graficotarifa/ocupacion']],
                                ['label' => 'Composición huéspedes', 'icon' => 'bar-chart', 'url' => ['/graficohuesped/create']],
                                ['label' => 'Estadía promedio', 'icon' => 'bar-chart', 'url' => ['/graficohuesped/estadiapromedio']],
                                ['label' => 'Número de trabajadores', 'icon' => 'bar-chart', 'url' => ['/graficopersonal/create']],
				['label' => 'Origen huespedes', 'icon' => 'bar-chart', 'url' => ['/graficopais/create']],
                            ],
                            ],
                        ],
                    ],
                    [
                        'label' => 'Centro de Eventos',
                        'icon' => 'dot-circle-o',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Evento', 'icon' => 'building-o', 'url' => ['/evento/index']],
                            ['label' => 'Salon de Eventos','icon' => 'building', 'url' => ['/salondeevento/index']],
                            ['label' => 'Personal', 'icon' => 'users', 'url' => ['/personalce/index']],
                            [
                                'label' => 'Gráficos',
                                'icon' => 'pie-chart',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Tipo Evento', 'icon' => 'line-chart', 'url' => ['/indicador1/create']],
                                    ['label' => 'Persona Tipo Evento', 'icon' => 'line-chart', 'url' => ['/indicador2/create']],
                                    ['label' => 'Tasa Ocupación Salón', 'icon' => 'line-chart', 'url' => ['/indicador3/create']],
                                    ['label' => 'Personal Contratado', 'icon' => 'line-chart', 'url' => ['/indicador4/create']],
                                  ],
                            ],
                        ],
                    ],
                    
                ],
            ]
        );
        }
        else
        {
            echo dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menu', 'options' => ['class' => 'header']],
                    ['label' => 'Inicio', 'icon' => 'home', 'url' => ['/site/index']],
                    [
                        'label' => 'Restaurante',
                        'icon' => 'dot-circle-o',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Restaurante', 'icon' => 'building-o', 'url' => ['/restaurante/index']],
                            [
                                'label' => 'Gráficos',
                                'icon' => 'pie-chart',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Personas Atendidas', 'icon' => 'line-chart', 'url' => ['/graficos/personasatendidas']],
                                    ['label' => 'Consumo Promedio', 'icon' => 'line-chart', 'url' => ['/graficos/consumopromedio']],
                                    ['label' => 'Personal Contratado', 'icon' => 'line-chart', 'url' => ['/graficos/personalcontratado']],
                                ],
                            ],
                        ],
                    ],
                    [
                        'label' => 'Hotel',
                        'icon' => 'dot-circle-o',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Hotel', 'icon' => 'building-o', 'url' => ['/hotel/index']],
                            [
                                'label' => 'Gráficos',
                                'icon' => 'pie-chart',
                                'url' => '#',
                                'items' => [
                                ['label' => 'Tarifa promedio', 'icon' => 'bar-chart', 'url' => ['/graficotarifa/create']],
                                ['label' => 'Cantidad habitaciones', 'icon' => 'bar-chart', 'url' => ['/graficotarifa/cantidadhabitaciones']],
                                ['label' => 'Porcentaje ocupación', 'icon' => 'bar-chart', 'url' => ['/graficotarifa/ocupacion']],
                                ['label' => 'Composición huéspedes', 'icon' => 'bar-chart', 'url' => ['/graficohuesped/create']],
                                ['label' => 'Estadía promedio', 'icon' => 'bar-chart', 'url' => ['/graficohuesped/estadiapromedio']],
                                ['label' => 'Número de trabajadores', 'icon' => 'bar-chart', 'url' => ['/graficopersonal/create']],
                            ],
                            ],
                        ],
                    ],
                    [
                        'label' => 'Centro de Eventos',
                        'icon' => 'dot-circle-o',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Centro de Eventos','icon' => 'building', 'url' => ['/centrodeeventos/index']],
			    ['label' => 'Salón de Eventos','icon' => 'building-o', 'url' => ['/salon/index']],
                            [
                                'label' => 'Gráficos',
                                'icon' => 'pie-chart',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Tipo Evento', 'icon' => 'line-chart', 'url' => ['/indicador1/create']],
                                    ['label' => 'Persona Tipo Evento', 'icon' => 'line-chart', 'url' => ['/indicador2/create']],
                                    ['label' => 'Tasa Ocupación Salón', 'icon' => 'line-chart', 'url' => ['/indicador3/create']],
                                    ['label' => 'Personal Contratado', 'icon' => 'line-chart', 'url' => ['/indicador4/create']],
                                 ],
                            ],
                        ],
                    ],
                    [
                            'label' => 'Modificar Usuarios',
                            'icon' => 'dot-circle-o',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Username', 'icon' => 'user', 'url' => ['/changeusername/create']],
                                ['label' => 'Datos Personales', 'icon' => 'user-plus', 'url' => ['/changedatosusername/create']],
                                ['label' => 'Contraseña', 'icon' => 'lock', 'url' => ['/changepassword/changepassword']],
                            ],
                    ],
                ],
            ]
        );
        } }
        ?>
    </section>
</aside>
