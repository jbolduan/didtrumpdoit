<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the view to manage categories.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->authorize('viewAny', Category::class);

        $categories = Category::orderby('id')->get();

        return view('admin.categories.index')->with('categories', $categories);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Category::class);

        $validatedData = $request->validate([
            'category_name' => ['required'],
            'fa_icon' => ['required', 'regex:/^fa-[a-zA-Z0-9]/']
        ]);

        //$validator = Validator::make($request->all(), $rules);

        $category = new Category();
        $category->name = $request->category_name;
        $category->fa_icon = $request->fa_icon;
        $category->color = $request->color;
        $category->save();

        return back()->with('success', 'Category created successfully.');
    }

    public function create(Request $request)
    {
        $this->authorize('create', Category::class);

        return view('admin.categories.create');
    }

    public function show($id)
    {
        $this->authorize('view', Category::class);

        $category = Category::find($id);

        return view('admin.categories.show')->with('category', $category);
    }

    public function edit($id)
    {
        $this->authorize('update', Category::class);

        $category = Category::find($id);

        return view('admin.categories.edit')->with('category', $category);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('update', Category::class);

        $validatedData = $request->validate([
            'category_name' => ['required'],
            'fa_icon' => ['required', 'regex:/^fa-[a-zA-Z0-9]/']
        ]);

        $category = Category::find($id);

        $category->name = $request->category_name;
        $category->fa_icon = $request->fa_icon;
        $category->color = $request->color;
        $category->save();
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Request $request, $id)
    {
        $this->authorize('delete', Category::class);

        $category = Category::find($id);
        $category->delete();

        Session::flash('success', 'Category deleted successfully.');
        return redirect()->route('categories.index');
    }
}
