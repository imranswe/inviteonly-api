<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Invitation;

class HasInvitation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /**
         * Only for GET requests. Otherwise, this middleware will block our registration.
         */
        if ($request->isMethod('post')) {

            /**
             * No token = Goodbye.
             */
            if (!$request->has('token')) {
                return response()->json(['status' => false, 'message'=> 'Invalid request']);
            }

            $invitation_token = $request->input('token');

            /**
             * Lets try to find invitation by its token.
             * If failed -> return to request page with error.
             */
            try {
                $invitation = Invitation::where('token', $invitation_token)->firstOrFail();
            } catch (ModelNotFoundException $e) {
                return response()->json(['status' => false, 'message'=> 'Wrong invitation token! Please check your URL.']);
            }

            /**
             * Let's check if users already registered.
             * If yes -> redirect to login with error.
             */
            if ($invitation->accepted) {
                return response()->json(['status' => false, 'message'=> 'The invitation link has already been used.']);
            }
        }
        return $next($request);
    }
}
