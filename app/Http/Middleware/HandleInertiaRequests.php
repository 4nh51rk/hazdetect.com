<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        return array_merge(parent::share($request), [
            // 'auth' => [
            //     'user' => $request->user() ? $request->user()->only('id','name','email') : null,
            // ],
            'auth' => function () use ($request) {
                return [
                    // 'user' => $request->user() ? [
                    //     'id' => $request->user()->id,
                    //     'first_name' => $request->user()->first_name,
                    //     'last_name' => $request->user()->last_name,
                    //     'email' => $request->user()->email,
                    //     'owner' => $request->user()->owner,
                    //     'account' => [
                    //         'id' => $request->user()->account->id,
                    //         'name' => $request->user()->account->name,
                    //     ],
                    // ]
                    'user' => $request->user() ?
                        $request->user()->only('id', 'name', 'email')
                        : null,
                ];
            },
            'flash' => function () use ($request) {
                return [
                    'success' => $request->session()->get('success'),
                    'error' => $request->session()->get('error'),
                ];
            },
        ]);
    }
}
