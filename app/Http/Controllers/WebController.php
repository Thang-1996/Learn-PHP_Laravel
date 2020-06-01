<?php

namespace App\Http\Controllers;

use App\Category;
use App\Brand;
use App\Product;
use Carbon\Carbon;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class WebController extends Controller
{
//    public function demoRouting(){
//        return view("demo");
//    }
        public function loginPage(){
            return view("login");
        }
        public function registerPage(){
            return view("registerPage");
        }
        public function forgotpassword(){
            return view("forgotpassword");
        }
        public function index(){
            return view("home");
        }
        public function dashBoard(){
            return view("dashboard");
        }
}

