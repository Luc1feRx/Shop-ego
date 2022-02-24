<?php

namespace App\Http\View\Composers;

use App\Models\Category;
use Illuminate\View\View;

class CategoryComposer{

    protected $users;
    public function __construct()
    {

    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $cate = Category::select('id', 'category_name', 'parent_id')->where('active', 1)->orderBy('active', 'desc')->get();
        $view->with('cate', $cate);
    }
}
