<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public function redirectTo($to = null, $status = 302, $headers = [], $secure = null)
    {
        return redirect('/admin/' . trim($to, '/'), $status, $headers, $secure);
    }
}