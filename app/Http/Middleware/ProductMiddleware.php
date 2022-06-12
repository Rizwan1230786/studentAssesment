<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App\SmGeneralSettings;
use App\Envato\Envato;
use GuzzleHttp\Client;


class ProductMiddleware
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
        return $next($request);
        $client = new Client();
        if (\Schema::hasTable('users')) {
            $value = SmGeneralSettings::first();
            $product_info = $client->request('GET', 'http://salespanel.infixedu.com/api/verify/'.$value->system_purchase_code.'/'.$value->system_domain);
            $product_info = $product_info->getBody()->getContents();
            $product_info = json_decode($product_info);
            if($product_info->data->product_info == ""){
                Session::put('url', $request->path());
                \Session::flash("message-danger", "Ops! Purchase Code is not Valid. Please try again.");
                return redirect('verified-code');
            }
            return $next($request);
        }else{
            return redirect('install');
        }


    }
}
