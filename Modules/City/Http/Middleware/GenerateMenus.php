<?php

namespace Modules\City\Http\Middleware;

use Closure;

class GenerateMenus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /*
         *
         * Module Menu for Admin Backend
         *
         * *********************************************************************
         */
//        \Menu::make('admin_sidebar', function ($menu) {
////            app()->setLocale(session()->get('locale'));
//
//            // Cities
//            $menu->add('<i class="nav-icon fa-regular fa-sun"></i> '.__('Cities'), [
//                'route' => 'backend.cities.index',
//                'class' => 'nav-item',
//            ])
//            ->data([
//                'order'         => 77,
//                'activematches' => ['admin/cities*'],
//                'permission'    => ['view_cities'],
//            ])
//            ->link->attr([
//                'class' => 'nav-link',
//            ]);
//        })->sortBy('order');
//
        return $next($request);
    }
}
