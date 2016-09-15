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
            'Studios' => [
                'submenu' => [
                    'List studio' => [
                        'route' => 'studios'
                    ],
                    'Add studio' => [
                        'route' => 'studios.create'
                    ],
                ],
            ]
        ],
    ],
    /**
     * for www site
     */
    'www' => []
);