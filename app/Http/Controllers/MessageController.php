<?php

namespace App\Http\Controllers;
use App\Models\MessageModel;
use DataTables;
use Illuminate\Http\Request;

class MessageController extends Controller
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
        $pageTitle = 'Message';

        return view('admin.messages.index', compact('pageTitle'));
    }

    public function ajaxList(Request $request)
    {
        $columns = ['id_message', 'body', 'subject'];
        $length = $request->input('length');
        $start = $request->input('start');
        $searchValue = $request->input('search.value');

        $query = MessageModel::select($columns)->orderBy('body', 'desc');

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
        $messages = $query->offset($start)->limit($length)->get();

        $data = [];
        foreach ($messages as $key => $message) {
            $data[] = [
                'DT_RowIndex' => $start + $key + 1, // Calculate row index
                'body' => $message->body,
                'subject' => $message->subject,
                'action' =>
                    '<button type="button" data-id="' .
                    $message->id_message .
                    '" id="edit_button" class="edit-btn btn btn-primary btn-sm">Edit</button>
                <button type="button" data-id="' .
                    $message->id_message .
                    '" id="delete_button" class="edit-btn btn btn-danger btn-sm">Delete</button>',
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

        MessageModel::create([
            'subject' => $request->subject,
            'body' => $request->body,
        ]);

        return response()->json(['success' => 'Message saved successfully.']);
    }
    public function edit($id)
    {
        $message = MessageModel::find($id);
        return response()->json($message);
    }

    public function update(Request $request, $id)
    {
        $message = MessageModel::find($id);
        $message->update($request->all());
        return response()->json(['success' => 'Message updated successfully']);
    }
    public function destroy($id)
    {
        $message = MessageModel::findOrFail($id);
        $message->delete();

        return response()->json(['success' => 'Message deleted successfully.']);
    }
}
