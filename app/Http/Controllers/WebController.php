<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
//    public function demoRouting(){
//        return view("demo");
//    }
        public function loginPage(){
            return view("loginPage");
        }
        public function registerPage(){
            return view("registerPage");
        }
        public function forgotpassword(){
            return view("forgotpassword");
        }
}
