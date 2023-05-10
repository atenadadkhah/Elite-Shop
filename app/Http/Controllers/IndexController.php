<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use App\Models\Products;
use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;


class IndexController extends Controller
{

    public function index()
    {
        $bestProducts = Products::withAvg('opinion','stars')->orderBy('opinion_avg_stars','desc')->orderBy('production_year','desc')->limit(8)->get();
        return view("index",['bestProducts'=>$bestProducts]);
    }

    public function contact()
    {
        return view("contact");
    }

    public function about()
    {
        $team = Team::all();
        return view("about",['team'=>$team]);
    }

    public function faq()
    {
        $faq = FAQ::all();
        return view('faq', ['faq'=>$faq]);
    }

}
