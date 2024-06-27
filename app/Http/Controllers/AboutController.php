<?php

namespace App\Http\Controllers;
use App\Models\AboutModel;
use DataTables;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pageTitle = 'About';
        return view('admin.abouts.index', compact('pageTitle'));
    }

    public function ajaxList(Request $request)
    {
        $columns = ['id', 'content'];
        $length = $request->input('length');
        $start = $request->input('start');
        $searchValue = $request->input('search.value');

        $query = AboutModel::select($columns)->orderBy('content', 'desc');

        // Filter by search value
        if (!empty($searchValue)) {
            $query->where(function ($query) use ($columns, $searchValue) {
                foreach ($columns as $column) {
                    $query->orWhere($column, 'like', '%' . $searchValue . '%');
                }
            });
        }

        $totalRecords = $query->count();

        // Apply pagination
        $Abouts = $query->offset($start)->limit($length)->get();

        $data = [];
        foreach ($Abouts as $key => $About) {
            $data[] = [
                'DT_RowIndex' => $start + $key + 1, // Calculate row index
                'content' => $About->content,
                'action' => '<button type="button" data-id="' . $About->id . '" id="edit_button" class="edit-btn btn btn-primary btn-sm">Edit</button>',
            ];
        }

        $response = [
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data' => $data,
        ];

        return response()->json($response);
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|max:255',
            'body' => 'required',
        ]);

        AboutModel::create([
            'content' => $request->content,
        ]);

        return response()->json(['success' => 'About saved successfully.']);
    }
    public function edit($id)
    {
        $About = AboutModel::find($id);
        return response()->json($About);
    }

    public function update(Request $request, $id)
    {
        $About = AboutModel::find($id);
        $About->update($request->all());
        return response()->json(['success' => 'About updated successfully']);
    }
    public function destroy($id)
    {
        $About = AboutModel::findOrFail($id);
        $About->delete();

        return response()->json(['success' => 'About deleted successfully.']);
    }
}
