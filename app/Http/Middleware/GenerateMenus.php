<?php
namespace App\Http\Middleware;

use Closure;

class GenerateMenus {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
	public function handle($request, Closure $next) {
		\Menu::make('mainMenu', function ($menu) {
			$menu->add('Shop', ['route'  => 'shop.index']);
			$menu->add('Admin', ['route'  => 'admin.index']);
		});
		return $next($request);
	}
}
