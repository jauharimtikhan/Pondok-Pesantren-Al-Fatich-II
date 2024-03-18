<?php

namespace Modules\Frontend\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckPayment
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $wakaf_id = $request->route()->parameters();
        $check = DB::table('transactions')->where('wakaf_id', $wakaf_id)->where('payment_id', null)->where('status', 'pending')->get();
        if ($check) {
            $results = [];
            foreach ($check as $c) {
                $check_donatur = DB::table('donaturs')->where('id', $c->donatur_id)->get();
                foreach ($check_donatur as $value) {
                    return response()->json([
                        'status' => false,
                        'statusCode' => 404,
                        'data' => $value
                    ]);
                }
            }


            // return $next($request);
        } else {
            return redirect()->name('wakaf.landing_page.id', $wakaf_id)->with('failed', 'Maaf terjadi kesalahan, Silahkan coba lagi');
        }
    }
}
