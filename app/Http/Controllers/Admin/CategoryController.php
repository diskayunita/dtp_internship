<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Notifications\ArticleCompleted;

use App\Category;
use App\CategoryTranslation;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $title = "Category List";
        return view('admin.category.index', compact('categories', 'title'));
    }
  
    public function create()
    {
        $category = new Category();
        $title = "Category Create";
        return view('admin.category.create', compact('title', 'category'));
    }
  
    public function store(Request $request)
    {
        $input = $request->all();
        $input['name'] = $input['nameTrans'][1];
        $input['description'] = $input['descriptionTrans'][1];
        
        $category = new Category();
        
        if ($category->validate($input)) {
            $category->name = $input['name'];
            $category->description = $input['description'];
            if ($category->save()) {
                foreach (config('app.languages') as $key=>$lang) {
                    $category->translation()->save(
                        new CategoryTranslation([
                            'name' => isset($input['nameTrans'][$key]) ? $input['nameTrans'][$key] : current(array_filter($input['nameTrans'])),
                            'description' => isset($input['descriptionTrans'][$key]) ? $input['descriptionTrans'][$key] : current(array_filter($input['descriptionTrans'])),
                            'language'  => $lang,
                        ])
                    );
                }
            }
            flash('Category successfully created', 'success');
            return redirect(route('admin.category.index'));
        } else {
            return redirect(route('admin.category.create'))->withErrors($category->errors())->withInput();
        }
    }
  
    public function show($id)
    {
        $category = Category::find($id);
        $title = $category ? $category->name : 'Category Details';
        return view('admin.category.show', compact('category', 'title'));
    }
  
    public function edit($id)
    {
        $category = Category::find($id);
        $title = "Category Edit";
        return view('admin.category.edit', compact('title', 'category'));
    }
  
    public function update(Request $request, $id)
    {
        $input= $request->all();

        $nameTrans = "-";
        $descTrans = "-";

        if (isset($input['nameTrans']) && !empty($input['nameTrans'])) {
            $nameTrans = isset($input['nameTrans'][1]) ? $input['nameTrans'][1] : "-";
        }

        if (isset($input['description']) && !empty($input['description'])) {
            $descTrans = isset($input['descriptionTrans'][1]) ? $input['descriptionTrans'][1] : "-";
        }

        $input['name'] = $nameTrans;
        $input['description'] = $descTrans;
    
        $category = Category::find($id);
    
        if ($category->validate($input)) {
            $category->name = $input['name'];
            $category->description = $input['description'];
            if ($category->save()) {
                foreach (config('app.languages') as $key=>$lang) {
                    if ($category->translation($lang)->first()) {
                        $category->translation($lang)->first()->update([
                            'name' => isset($input['nameTrans'][$key]) ? $input['nameTrans'][$key] : current(array_filter($input['nameTrans'])),
                            'description' => isset($input['descriptionTrans'][$key]) ? $input['descriptionTrans'][$key] : current(array_filter($input['descriptionTrans'])),
                            'language'  => $lang,
                        ]);
                    }
                }
            }
            flash('Category successfully updated', 'success');
            return redirect(route('admin.category.index'));
        } else {
            return redirect(route('admin.category.edit'))->withErrors($category->errors())->withInput();
        }
    }
  
    public function destroy($id)
    {
        $category = Category::find($id);
    
        if ($category) {
            $category->delete();
            flash('Category successfully deleted', 'success');
        } else {
            flash('Category unsuccessfully deleted', 'error');
        }
    
        return redirect(route('admin.category.index'));
    }
}
