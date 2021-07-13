<?php
use yii\helpers\Html;
use app\models\UserRoles;
$userRoles = UserRoles::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
?>
<div class="col-md-3 left_col">

    <div class="left_col scroll-view">

        <div class="navbar nav_title" >
            <a href="/" class="site_title"><i class="fa fa-shopping-cart"></i> <span>Welse</span></a>
        </div>
        <div class="clearfix"></div>

        <!-- menu prile quick info -->
        <div class="profile">
            <div class="profile_pic">
                <?= Html::img($user->getImage(),['alt' => Yii::t('app','User Avatar'), 'class' => 'img-circle profile_img'])?>
            </div>
            <div class="profile_info">
                <span><?=Yii::t('app','Добро пожаловать')?>,</span>
                <h2><?=$user->fio?></h2>
            </div>
        </div>
        <!-- /menu prile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <div class="menu_section">
                <h3><?= $userRoles->role->name ?></h3>
                <?=
                \yiister\gentelella\widgets\Menu::widget(
                    [
                        "items" => [
                            ["label" => Yii::t('app', 'Home'), "url" => "/", "icon" => "home"],
                            ["label" => "Каталог", "url" => "#", "icon" => "th-list", 
                                "items" => [
                                    [
                                        "label" => 'Категории',
                                        "url" => ["#"],
                                        "badgeOptions" => ["class" => "label-success"],
                                    ],
                                    [
                                        "label" => 'Товары',
                                        "url" => ["#"],
                                        "badgeOptions" => ["class" => "label-success"],
                                    ],
                                    [
                                        "label" => 'Услуги',
                                        "url" => ["#"],
                                        "badgeOptions" => ["class" => "label-success"],
                                    ],
                                    [
                                        "label" => 'Атрибуты',
                                        "url" => "#",
                                        "badgeOptions" => ["class" => "label-success"],
                                        "items" => [
                                            [
                                                "label" => 'Группы атрибутов',
                                                "url" => ["#"],
                                                "badgeOptions" => ["class" => "label-success"],
                                            ],
                                            [
                                                "label" => 'Атрибуты',
                                                "url" => ["#"],
                                                "badgeOptions" => ["class" => "label-success"],
                                            ],
                                        ]
                                    ],
                                    [
                                        "label" => 'Опции',
                                        "url" => ["#"],
                                        "badgeOptions" => ["class" => "label-success"],
                                    ],
                                ]
                            ],
                            ["label" => "Мерчанты", "url" => ["#"], "icon" => "handshake-o"],
                            ["label" => "Слайдер", "url" => ["/sliders"], "icon" => "sliders"],
                            // ["label" => "Слайдер", "url" => "#", "icon" => "sliders", 
                            //     "items" => [
                            //         [
                            //             "label" => 'Слайдеры',
                            //             "url" => ["/sliders"],
                            //             "badgeOptions" => ["class" => "label-success"],
                            //         ],
                            //         [
                            //             "label" => 'Элемент слайдера',
                            //             "url" => ["/slider-items"],
                            //             "badgeOptions" => ["class" => "label-success"],
                            //         ],
                            //     ]
                            // ],
                            ["label" => "Баннер", "url" => ["/banners"], "icon" => "wpforms"],
                            // ["label" => "Баннер", "url" => "#", "icon" => "wpforms", 
                            //     "items" => [
                            //         [
                            //             "label" => 'Баннеры',
                            //             "url" => ["/banners"],
                            //             "badgeOptions" => ["class" => "label-success"],
                            //         ],
                            //         [
                            //             "label" => 'Комьюнити',
                            //             "url" => ["#"],
                            //             "badgeOptions" => ["class" => "label-success"],
                            //         ],
                            //     ]
                            // ],
                            // [
                            //     "label" => "Блог", 
                            //     "url" => "#", 
                            //     "icon" => "genderless", 
                            //     "items" => [
                            //         [
                            //             "label" => 'Блоги',
                            //             "url" => ["/blogs"],
                            //             "badgeOptions" => ["class" => "label-success"],
                            //         ],
                            //         [
                            //             "label" => 'Категории блогов',
                            //             "url" => ["/blog-categories"],
                            //             "badgeOptions" => ["class" => "label-success"],
                            //         ],
                            //         [
                            //             "label" => 'Блоги пользователей',
                            //             "url" => ["/user-blogs"],
                            //             "badgeOptions" => ["class" => "label-success"],
                            //         ],
                            //         [
                            //             "label" => 'Теги блога',
                            //             "url" => ["/blog-tags"],
                            //             "badgeOptions" => ["class" => "label-success"],
                            //         ],
                            //         [
                            //             "label" => 'Blog tags relations',
                            //             "url" => ["/blog-tags-relations"],
                            //             "badgeOptions" => ["class" => "label-success"],
                            //         ],
                            //         [
                            //             "label" => 'Blog categories relations',
                            //             "url" => ["/blog-categories-relations"],
                            //             "badgeOptions" => ["class" => "label-success"],
                            //         ],
                            //     ]
                            // ],
                            // ["label" => "Форум", "url" => "#", "icon" => "genderless", 
                            //     "items" => [
                            //         [
                            //             "label" => 'Вопросы форума',
                            //             "url" => ["/forum-questions"],
                            //             "badgeOptions" => ["class" => "label-success"],
                            //         ],
                            //         [
                            //             "label" => 'Теги вопросов форума',
                            //             "url" => ["/forum-question-tags"],
                            //             "badgeOptions" => ["class" => "label-success"],
                            //         ],
                            //         [
                            //             "label" => 'Вопросы на форуме комментарии',
                            //             "url" => ["/forum-questions-comments"],
                            //             "badgeOptions" => ["class" => "label-success"],
                            //         ],
                            //         [
                            //             "label" => 'Forum questions votes',
                            //             "url" => ["/forum-questions-votes"],
                            //             "badgeOptions" => ["class" => "label-success"],
                            //         ],
                            //         [
                            //             "label" => 'Forum question tags relation',
                            //             "url" => ["/forum-question-tags-relation"],
                            //             "badgeOptions" => ["class" => "label-success"],
                            //         ],
                            //     ]
                            // ],
                            // ["label" => "Событие", "url" => "#", "icon" => "genderless", 
                            //     "items" => [
                            //         [
                            //             "label" => 'Категории событий',
                            //             "url" => ["/event-categories"],
                            //             "badgeOptions" => ["class" => "label-success"],
                            //         ],
                            //         [
                            //             "label" => 'События',
                            //             "url" => ["/events"],
                            //             "badgeOptions" => ["class" => "label-success"],
                            //         ],
                            //         [
                            //             "label" => 'Event categories relation',
                            //             "url" => ["/event-categories-relation"],
                            //             "badgeOptions" => ["class" => "label-success"],
                            //         ],
                            //         [
                            //             "label" => 'Event members',
                            //             "url" => ["/event-members"],
                            //             "badgeOptions" => ["class" => "label-success"],
                            //         ],
                            //     ]
                            // ],
                            ["label" => "Клиенты", "url" => ["/users"], "icon" => "user-circle"],
                            // ["label" => "Клиенты", "url" => "#", "icon" => "user-circle", 
                            //     "items" => [
                            //         [
                            //             "label" => 'Администраторы',
                            //             "url" => ["/users/admin"],
                            //             "badgeOptions" => ["class" => "label-success"],
                            //         ],
                            //         [
                            //             "label" => 'Пользователи',
                            //             "url" => ["/users"],
                            //             "badgeOptions" => ["class" => "label-success"],
                            //         ],
                            //     ]
                            // ],
                            ["label" => "Продажи", "url" => "#", "icon" => "line-chart", 
                                "items" => [
                                    [
                                        "label" => 'Заказы',
                                        "url" => ["#"],
                                        "badgeOptions" => ["class" => "label-success"],
                                    ],
                                    [
                                        "label" => 'Пред заказы',
                                        "url" => ["#"],
                                        "badgeOptions" => ["class" => "label-success"],
                                    ],
                                ]
                            ],
                            ["label" => "Отчеты", "url" => "#", "icon" => "file-text-o ", 
                                "items" => [
                                    [
                                        "label" => 'Пользователи',
                                        "url" => ["#"],
                                        "badgeOptions" => ["class" => "label-success"],
                                    ],
                                    [
                                        "label" => 'Заказы',
                                        "url" => ["#"],
                                        "badgeOptions" => ["class" => "label-success"],
                                    ],
                                    [
                                        "label" => 'Товары',
                                        "url" => ["#"],
                                        "badgeOptions" => ["class" => "label-success"],
                                    ],
                                    [
                                        "label" => 'Маркетинг',
                                        "url" => ["#"],
                                        "badgeOptions" => ["class" => "label-success"],
                                    ],
                                ]
                            ],
                            ["label" => "Комьюнити", "url" => "#", "icon" => "users", 
                                "items" => [
                                    [
                                        "label" => "Блог", 
                                        "url" => "#", 
                                        "badgeOptions" => ["class" => "label-success"],
                                        "items" => [
                                            [
                                                "label" => 'Блоги',
                                                "url" => ["/blogs"],
                                                "badgeOptions" => ["class" => "label-success"],
                                            ],
                                            [
                                                "label" => 'Категории блогов',
                                                "url" => ["/blog-categories"],
                                                "badgeOptions" => ["class" => "label-success"],
                                            ],
                                            [
                                                "label" => 'Теги блога',
                                                "url" => ["/blog-tags"],
                                                "badgeOptions" => ["class" => "label-success"],
                                            ],
                                            [
                                                "label" => 'Блоги пользователей',
                                                "url" => ["/user-blogs"],
                                                "badgeOptions" => ["class" => "label-success"],
                                            ],
                                            // [
                                            //     "label" => 'Blog tags relations',
                                            //     "url" => ["/blog-tags-relations"],
                                            //     "badgeOptions" => ["class" => "label-success"],
                                            // ],
                                        ]
                                    ],
                                    [
                                        "label" => "Форум", 
                                        "url" => "#", 
                                        "badgeOptions" => ["class" => "label-success"],
                                        "items" => [
                                            [
                                                "label" => 'Вопросы форума',
                                                "url" => ["/forum-questions"],
                                                "badgeOptions" => ["class" => "label-success"],
                                            ],
                                            [
                                                "label" => 'Теги вопросов форума',
                                                "url" => ["/forum-question-tags"],
                                                "badgeOptions" => ["class" => "label-success"],
                                            ],
                                        ]
                                    ],
                                    ["label" => "Категории события", "url" => ["/event-categories"], "badgeOptions" => ["class" => "label-success"]],
                                    // [
                                    //     "label" => "Событие", 
                                    //     "url" => "#", 
                                    //     "badgeOptions" => ["class" => "label-success"],
                                    //     "items" => [
                                    //         [
                                    //             "label" => 'События',
                                    //             "url" => ["/events"],
                                    //             "badgeOptions" => ["class" => "label-success"],
                                    //         ],
                                    //         [
                                    //             "label" => 'Категории события',
                                    //             "url" => ["/event-categories"],
                                    //             "badgeOptions" => ["class" => "label-success"],
                                    //         ],
                                    //     ]
                                    // ],
                                ]
                            ],
                            [
                                "label" => "Настройка",
                                "url" => "#",
                                "icon" => "cogs",
                                "items" => [
                                    [
                                        "label" => "Администраторы", 
                                        "url" => ["/users/admin"], 
                                        "badgeOptions" => ["class" => "label-success"],],
                                    [
                                        "label" => Yii::t('app', 'Countries'),
                                        "url" => ["/countries"],
                                        "badgeOptions" => ["class" => "label-success"],
                                    ],
                                    [
                                        "label" => 'Язык',
                                        "url" => ["/translates"],
                                        "badgeOptions" => ["class" => "label-success"],
                                    ],
                                    // [
                                    //     "label" => 'Переводы',
                                    //     "url" => ["/translates"],
                                    //     "badgeOptions" => ["class" => "label-success"],
                                    // ],
                                    // [
                                    //     "label" => Yii::t('app', 'Роли'),
                                    //     "url" => ["/roles"],
                                    //     "badgeOptions" => ["class" => "label-success"],
                                    // ],
                                    [
                                        "label" => Yii::t('app', 'Роли пользователей'),
                                        "url" => ["/user-roles"],
                                        "badgeOptions" => ["class" => "label-success"],
                                    ],
                                ],
                            ],
                        ],
                    ]
                )
                ?>
            </div>

        </div>
    </div>
</div>