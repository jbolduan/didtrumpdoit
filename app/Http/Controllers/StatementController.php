<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\TextAreaURL;
use App\Models\Statement;
use App\Models\CategoryStatement;
use App\Models\StatementUrl;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class StatementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the view to manage statements.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->authorize('viewAny', Statement::class);

        $statements = Statement::orderby('id')->get();

        return view('admin.statements.index')->with('statements', $statements);
    }

    public function indexPublic()
    {
        $statements = Statement::orderby('id')->where('is_public', true)->get();

        return view('statements.index')->with('statements', $statements);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Statement::class);

        $validateData = $request->validate([
            'urls' => ['required', 'string', new TextAreaURL],
        ]);

        $statement = new Statement();

        $statement->title = $request->title;
        $statement->description = $request->description;
        $statement->status_id = $request->status_id;
        $statement->status_details = $request->status_details;
        $statement->is_public = $request->is_public;
        $statement->user_id = Auth::id();
        $statement->urls = $request->urls;
        $statement->save();

        foreach ($request->category as $category) {
            $categorySave = new CategoryStatement();
            $categorySave->category_id = $category;
            $categorySave->statement_id = $statement->id;
            $categorySave->save();
        }

        // $statement->categorystatement()->create([
        //     'category_id' => $request->category,
        // ]);

        return redirect()->back()->with('success', 'Statement updated successfully.');
    }

    public function storePublic(Request $request)
    {
        $validateData = $request->validate([
            'urls' => ['required', 'string', new TextAreaURL],
        ]);

        $statement = new Statement();

        $statement->title = $request->title;
        $statement->description = $request->description;
        $statement->status_id = $request->status_id;
        $statement->status_details = $request->status_details;
        if($request->is_public == null) {
            $statement->is_public = false;
        } else {
            $statement->is_public = $request->is_public;
        }
        $statement->user_id = Auth::id();
        if($statement->user_id == null) {
            $statement->user_id = -1;
        }
        $statement->urls = $request->urls;
        $statement->save();

        foreach ($request->category as $category) {
            $categorySave = new CategoryStatement();
            $categorySave->category_id = $category;
            $categorySave->statement_id = $statement->id;
            $categorySave->save();
        }

        // $statement->categorystatement()->create([
        //     'category_id' => $request->category,
        // ]);

        return redirect()->back()->with('success', 'Statement updated successfully.');
    }

    public function create(Request $request)
    {
        $this->authorize('create', Statement::class);

        return view('admin.statements.create');
    }

    public function createPublic(Request $request)
    {
        return view('statements.create');
    }

    public function show($id)
    {
        $this->authorize('view', Statement::class);

        $statement = Statement::find($id);

        return view('admin.statements.show')->with('statement', $statement);
    }

    public function showPublic($id)
    {
        $statement = Statement::find($id);
        
        return view('statements.show')->with('statement', $statement);
    }

    public function edit($id)
    {
        $this->authorize('update', Statement::class);

        $statement = Statement::find($id);

        return view('admin.statements.edit')->with('statement', $statement);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('update', Statement::class);

        $validateData = $request->validate([
            'urls' => ['required', 'string', new TextAreaURL],
        ]);

        $statement = Statement::find($id);

        $statement->title = $request->title;
        $statement->description = $request->description;
        $statement->status_id = $request->status_id;
        $statement->status_details = $request->status_details;
        if($request->is_public == null) {
            $request->is_public = false;
        }
        $statement->is_public = $request->is_public;
        $statement->category()->sync($request->category);
        $statement->urls = $request->urls;
        $statement->save();

        return redirect()->back()->with('success', 'Statement updated successfully.');
    }

    public function destroy(Request $request, $id)
    {
        $this->authorize('delete', Statement::class);

        $statement = Statement::find($id);

        CategoryStatement::where('statement_id', $statement->id)->delete();

        $statement->delete();

        Session::flash('success', 'Statement deleted successfully.');
        return redirect()->route('statements.index');
    }

    public function showMainPage()
    {
        $statements = Statement::orderby('id')->where('is_public', true)->get();

        return view('index')->with('statements', $statements);
    }
}
