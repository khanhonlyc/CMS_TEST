<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
class trailingSlashes
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
   * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
   */
  public function handle(Request $request, Closure $next)
  {
    if (!preg_match('/.+\/$/', $request->getRequestUri())) {
      $base_url = Config::get('app.url');
      return Redirect::to($base_url . $request->getRequestUri() . '/');
    }
    return $next($request);
  }
}
