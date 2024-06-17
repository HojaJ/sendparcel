<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class GenerateMenus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        app()->setLocale(session()->get('locale'));

        \Menu::make('admin_sidebar', function ($menu) {
            // Dashboard
            $menu->add('<i class="nav-icon fa-solid fa-cubes"></i> '.__('Dashboard' ), [
                'route' => 'backend.dashboard',
                'class' => 'nav-item',
            ])
                ->data([
                    'order' => 1,
                    'activematches' => 'admin/dashboard*',
                ])
                ->link->attr([
                    'class' => 'nav-link',
                ]);

            $menu->add('<i class="nav-icon fa-solid fa-city"></i> '.__('Cities' ), [
                'route' => 'backend.cities.index',
                'class' => 'nav-item',
            ])
                ->data([
                    'order' => 1,
                    'activematches' => 'admin/cities*',
                    'permission'    => ['view_cities'],

                ])
                ->link->attr([
                    'class' => 'nav-link',
                ]);

            $menu->add('<i class="nav-icon fa-solid fa-car"></i> '.__('Cars' ), [
                'route' => 'backend.cars.index',
                'class' => 'nav-item',
            ])
                ->data([
                    'order' => 1,
                    'activematches' => 'admin/cars*',
                    'permission'    => ['view_cars'],

                ])
                ->link->attr([
                    'class' => 'nav-link',
                ]);

            $menu->add('<i class="nav-icon fa-solid fa-box"></i> '.__('Parcel' ), [
                'route' => 'backend.parcels.index',
                'class' => 'nav-item',
            ])
                ->data([
                    'order' => 1,
                    'activematches' => 'admin/parcels*',
                    'permission'    => ['view_parcels'],

                ])
                ->link->attr([
                    'class' => 'nav-link',
                ]);



            // Separator: Access Management
            $menu->add(__('Management'), ['class' => 'nav-title',])
                ->data([
                    'order' => 101,
                    'permission' => ['edit_settings', 'view_backups', 'view_users', 'view_roles', 'view_logs'],
                ]);

            // Access Control Dropdown
            $accessControl = $menu->add('<i class="nav-icon fa-solid fa-user-gear"></i> '. __("Access Control"), [
                'class' => 'nav-group',
            ])
                ->data([
                    'order' => 104,
                    'activematches' => [
                        'admin/users*',
                        'admin/roles*',
                    ],
                    'permission' => ['view_users', 'view_roles'],
                ]);
            $accessControl->link->attr([
                'class' => 'nav-link nav-group-toggle',
                'href' => '#',
            ]);

            // Submenu: Users
            $accessControl->add('<i class="nav-icon fa-solid fa-user-group"></i> ' . __("Users"), [
                'route' => 'backend.users.index',
                'class' => 'nav-item',
            ])
                ->data([
                    'order' => 105,
                    'activematches' => 'admin/users*',
                    'permission' => ['view_users'],
                ])
                ->link->attr([
                    'class' => 'nav-link',
                ]);

            // Submenu: Roles
            $accessControl->add('<i class="nav-icon fa-solid fa-user-shield"></i> ' . __('Roles'), [
                'route' => 'backend.roles.index',
                'class' => 'nav-item',
            ])
                ->data([
                    'order' => 106,
                    'activematches' => 'admin/roles*',
                    'permission' => ['view_roles'],
                ])
                ->link->attr([
                    'class' => 'nav-link',
                ]);

            // Log Viewer

            // Access Permission Check
            $menu->filter(function ($item) {
                if ($item->data('permission')) {
                    if (auth()->check()) {
                        if (auth()->user()->hasRole('super admin')) {
                            return true;
                        }
                        if (auth()->user()->hasAnyPermission($item->data('permission'))) {
                            return true;
                        }
                    }

                    return false;
                }

                return true;
            });

            // Set Active Menu
            $menu->filter(function ($item) {
                if ($item->activematches) {
                    $activematches = is_string($item->activematches) ? [$item->activematches] : $item->activematches;
                    foreach ($activematches as $pattern) {
                        if (request()->is($pattern)) {
                            $item->active();
                            $item->link->active();
                            if ($item->hasParent()) {
                                $item->parent()->active();
                            }
                        }
                    }
                }

                return true;
            });
        })->sortBy('order');

        return $next($request);
    }
}

