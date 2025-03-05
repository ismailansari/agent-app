<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{


    public function index()
    {
        $data = [
            'page_title'    => 'Home',
        ];

        return view('frontend.home.index', $data);
    }
}
