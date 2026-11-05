<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Admin Settings Sections
    |--------------------------------------------------------------------------
    |
    | Sections listed on the admin settings page and in the settings sidebar.
    | Give an item a named 'route' to make it available; items with a null
    | route are shown as "Coming soon". 'active' is an optional route pattern
    | used to highlight the item in the sidebar. Icons live in
    | resources/views/admin/settings/partials/icon.blade.php.
    |
    */

    'groups' => [
        [
            'label' => 'Storefront',
            'description' => 'Content your customers see on the shop.',
            'items' => [
                [
                    'label' => 'Homepage Hero',
                    'description' => 'Banner image, headline, call-to-action buttons and stats on the homepage.',
                    'icon' => 'image',
                    'route' => 'admin.hero.edit',
                    'active' => 'admin.hero.*',
                ],
                [
                    'label' => 'Navigation & Menus',
                    'description' => 'Header and footer menu links for the storefront.',
                    'icon' => 'menu',
                    'route' => null,
                ],
                [
                    'label' => 'Footer & Social',
                    'description' => 'Footer text, contact details and social media profiles.',
                    'icon' => 'share',
                    'route' => null,
                ],
            ],
        ],
        [
            'label' => 'Store',
            'description' => 'How your business runs day to day.',
            'items' => [
                [
                    'label' => 'Store Details',
                    'description' => 'Store name, logo, currency and contact information.',
                    'icon' => 'store',
                    'route' => null,
                ],
                [
                    'label' => 'Payments',
                    'description' => 'Payment providers and checkout options.',
                    'icon' => 'card',
                    'route' => null,
                ],
                [
                    'label' => 'Shipping',
                    'description' => 'Shipping zones, rates and delivery options.',
                    'icon' => 'truck',
                    'route' => null,
                ],
                [
                    'label' => 'Taxes',
                    'description' => 'Tax rates and how prices are displayed.',
                    'icon' => 'percent',
                    'route' => null,
                ],
            ],
        ],
        [
            'label' => 'Account',
            'description' => 'Admin access, alerts and security.',
            'items' => [
                [
                    'label' => 'Admin Users & Roles',
                    'description' => 'Invite team members and manage their permissions.',
                    'icon' => 'users',
                    'route' => null,
                ],
                [
                    'label' => 'Notifications',
                    'description' => 'Order and stock alerts sent to admins.',
                    'icon' => 'bell',
                    'route' => null,
                ],
                [
                    'label' => 'Security',
                    'description' => 'Password policy and login protection.',
                    'icon' => 'shield',
                    'route' => null,
                ],
            ],
        ],
    ],

];
