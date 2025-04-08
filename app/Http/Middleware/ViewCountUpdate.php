<?php

namespace App\Http\Middleware;

use App\Models\News;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ViewCountUpdate
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
        $new_id = $request->route('id');
        if ($new_id) {
            $model = News::find($new_id);

            if ($model) {
                $ip = $request->ip();
                $cache = "view_count_{$new_id}_ip_{$ip}";

                if (!Cache::has($cache)) {
                    $model->increment('view_count');
                    Cache::put($cache, true, now()->addMinutes(3));
                }
            }
        }
        return $next($request);

    }
}
