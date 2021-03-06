<?php
/**
 * Created by PhpStorm.
 * User: Hoang Dang
 * Date: 9/13/2016
 * Time: 4:05 PM
 */

/**
 *  // structure inside admin/www array
 * 'header' => [
 *      // Non sub-menu
 *      'link' => [
 *          'route' => 'route for link separated by dot(.)' // (ex: 'products.index')
 *          ],
 *      // With sub-menu
 *      'link2' = [
 *          'submenu' => [
 *              'sublink1' => [
 *                  'route' => 'route for sublink1'
 *                  ],
 *              'sublink2' => [
 *                  'route' => 'route for sublink2'
 *                  ],
 *              ],
 *          ],
 *      ],
 * 'other header' => []
 *
 */

return array(
    /**
     * for admin panel
     */
    'admin' => [
        'HOME' => [
            'Dashboard' => [
                'route' => 'dashboard'
            ],
            'Movies' => [
                'submenu' => [
                    'All movies' => [
                        'route' => 'movies'
                    ],
                    'Add movie' => [
                        'route' => 'movies/create'
                    ],
                    'Missing' => [
                        'route' => 'movies/missing/list'
                    ],
                ]
            ],
            'Actresses' => [
                'submenu' => [
                    'All actresses' => [
                        'route' => 'actresses'
                    ],
                    'Add actress' => [
                        'route' => 'actresses/create'
                    ],
                    'Missing' => [
                        'route' => 'actresses/missing/list'
                    ],
                ]
            ],
            'Studios' => [
                'route' => 'studios'
            ],
            'Settings' => [
                'submenu' => [
                    'Tag' => [
                        'route' => 'tags'
                    ],
                    'Series' => [
                        'route' => 'series'
                    ],
                ]
            ],
        ],
    ],
    /**
     * for www site
     */
    'www' => []
);