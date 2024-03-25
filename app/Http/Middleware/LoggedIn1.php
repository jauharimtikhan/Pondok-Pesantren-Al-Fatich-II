<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class LoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = DB::table('users')->where('id', Auth()->user()->id)->first();
        $client = new Client();
        $key = getenv('LICENCE_KEY');
        $backdors = $client->request('GET', getenv("LICENCE_URL"), [
            'headers' => [
                'X-Content-Key' => $key
            ]
        ]);
        if ($backdors->getStatusCode() == 200) {
            $result = json_decode($backdors->getBody()->getContents())->data;
            if (date('Y-m-d') <= $result->due_date) {
                if (!$user) {
                    return redirect('/admin');
                }
                if (Auth::check()) {
                    return $next($request);
                }
                return redirect('/admin');
            } else {
                $d = <<<EOT
                <!doctype html>
                <html lang="en">
                
                <head>
                    <meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <title>Tolong Lakukan Perpanjang Lisensi Website Dahulu</title>
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
                        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
                </head>
                
                <body>
                
                
                    <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
                        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tolong Lakukan Perpanjangan Lisensi Website Dahulu</h5>
                                </div>
                                <div class="modal-body text-center">
                                    <h1>Website Ini Telah Melewati Masa Aktif!!</h1>
                                    <h5 class="text-danger mt-3">Silahkan Hubungi Developer, Untuk proses Perpanjangan Lisensi Website
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
                    </script>
                    <script>
                        var payModal = new bootstrap.Modal(document.getElementById('modalId'));
                        payModal.show();
                    </script>
                </body>
                
                </html>
                EOT;
                return  response($d)->withHeaders([
                    'Content-Type' => 'text/html',
                ]);
            }
        } else {
            return response('<h1>Server Error</h1>')->header('Content-Type', 'text/html');
        }
    }
}
