<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Status;

class StatusController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the view to manage statuses.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->authorize('viewAny', Status::class);

        $statuses = Status::orderby('id')->get();

        return view('admin.statuses.index')->with('statuses', $statuses);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Status::class);

        $validatedData = $request->validate([
            'status_name' => ['required'],
            'fa_icon' => ['required', 'regex:/^fa-[a-zA-Z0-9]/'],
            'status_color' => ['required']
        ]);

        $status = new Status();
        $status->name = $request->status_name;
        $status->fa_icon = $request->fa_icon;
        $status->color = $request->status_color;
        $status->save();

        return back()->with('success', 'Status created successfully.');
    }

    public function create(Request $request)
    {
        $this->authorize('create', Status::class);

        return view('admin.statuses.create');
    }

    public function show($id)
    {
        $this->authorize('view', Status::class);

        $status = Status::find($id);

        return view('admin.statuses.show')->with('status', $status);
    }

    public function edit($id)
    {
        $this->authorize('update', Status::class);

        $status = Status::find($id);

        return view('admin.statuses.edit')->with('status', $status);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('update', Status::class);

        $validatedData = $request->validate([
            'status_name' => ['required'],
            'fa_icon' => ['required', 'regex:/^fa-[a-zA-Z0-9]/'],
            'status_color' => ['required']
        ]);

        $status = Status::find($id);

        $status->name = $request->status_name;
        $status->fa_icon = $request->fa_icon;
        $status->color = $request->status_color;
        $status->save();
        return redirect()->route('statuses.index')->with('success', 'Status updated successfully.');
    }

    public function destroy(Request $request, $id)
    {
        $this->authorize('delete', Status::class);

        $status = Status::find($id);
        $status->delete();

        Session::flash('success', 'Status deleted successfully.');
        return redirect()->route('statuses.index');
    }
}
