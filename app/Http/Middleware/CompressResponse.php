<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CompressResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Check if the response is not already compressed
        if (!$response->headers->has('Content-Encoding') && $this->shouldCompress($request, $response)) {
            $response->headers->set('Content-Encoding', 'gzip');
            $response->setContent(gzencode($response->getContent(), 9));
            $response->headers->set('Content-Length', strlen($response->getContent()));
        }

        return $response;
    }

    protected function shouldCompress(Request $request, $response)
    {
        $mimeTypes = [
            'text/html',
            'text/plain',
            'text/xml',
            'text/css',
            'application/javascript',
            'application/json',
            'application/xml',
        ];

        foreach ($mimeTypes as $type) {
            if (strpos($response->headers->get('Content-Type'), $type) === 0) {
                return true;
            }
        }

        return false;
    }
}
