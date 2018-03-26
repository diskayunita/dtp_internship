<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Product;
use App\ProductTranslation;
use View;

class ProductController extends Controller
{
    private $page_title = 'Events : Manage Product';

    public function __construct()
    {
        View::share('title', $this->page_title);
    }

    public function index()
    {
        $products = product::all();
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $product = new Product();
        return view('admin.product.create', compact('product'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $product = new Product();

        if ($product->save()) {
            foreach(config('app.languages') as $key=>$lang) {
                $product->translation()->save(
                    new ProductTranslation([
                        'name' => isset($input['name'][$key]) ? $input['name'][$key] : current(array_filter($input['name'])),
                        'language'  => $lang,
                    ])
                );
            }
            flash('Event product successfully created', 'success');
            return redirect(route('admin.product.index'));
        }

        return redirect(route('admin.product.create'))->withErrors($product->errors())->withInput();
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin.product.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $product = Product::find($id);

        foreach(config('app.languages') as $key=>$lang) {
            if ($product->translation($lang)->first()) {
                $product->translation($lang)->first()->update([
                    'name' => isset($input['name'][$key]) ? $input['name'][$key] : current(array_filter($input['name'])),
                    'language'  => $lang,
                ]);
            }
        }

        flash('product successfully updated', 'success');
        return redirect(route('admin.product.index'));
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product) {
            if ($product->product_translations() && $product->product_translations()->delete()) {
                $product->delete();
                flash('product successfully deleted', 'success');
            } else {
                flash('product unsuccessfully deleted', 'error');
            }
        } else {
            flash('product unsuccessfully deleted', 'error');
        }

        return redirect(route('admin.product.index'));
    }
}
