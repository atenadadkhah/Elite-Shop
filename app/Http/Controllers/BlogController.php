<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class BlogController extends Controller implements HasMedia
{
    use InteractsWithMedia;

    public function getAllBlogs()
    {
        $articles = Articles::orderBy("created_at","desc")->paginate(6);
        if ($articles->lastPage() < $articles->currentPage()){
            return redirect()->back();
        }
        return view("blog-grid",["articles"=>$articles]);
    }

    public function getBlogByName($slug)
    {
        if (isset($slug)) $article = Articles::where("slug",strtolower($slug))->first();
        if (isset($article->id)) {
            $media = Articles::find($article->id)->getmedia('articles')[0]->getFullUrl();
            return view("blog-single",["article"=>$article, "media" =>$media]);
        }
        return view("errors.404");
    }

}
