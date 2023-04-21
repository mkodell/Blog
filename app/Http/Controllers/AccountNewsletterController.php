<?php

namespace App\Http\Controllers;

use App\Services\Newsletter;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\RedirectResponse;

class AccountNewsletterController extends Controller
{
    public function resubscribe(Newsletter $newsletter): RedirectResponse
    {
        $user = request()->user()->username;
        $email = request()->user()->email;

        try {
            $newsletter->resubscribe($email);
        } catch (ClientException $e) {
            throw $e;
        }

        return redirect('/account/' . $user)->with('success', 'You are now signed up to receive updates');
    }

    public function unsubscribe(Newsletter $newsletter): RedirectResponse
    {
        $user = request()->user()->username;
        $email = request()->user()->email;

        try {
            $newsletter->unsubscribe($email);
        } catch (ClientException $e) {
            throw $e;
        }

        return redirect('/account/' . $user)->with('success', 'You will no longer receive updates');
    }

    public function newSubscribe(Newsletter $newsletter): RedirectResponse
    {
        $user = request()->user()->username;
        $email = request()->user()->email;

        try {
            $newsletter->firstSubscribe($email);
        } catch (ClientException $e) {
            throw $e;
        }

        return redirect('/account/' . $user)->with('success', 'You are now signed up to receive updates');
    }
}
