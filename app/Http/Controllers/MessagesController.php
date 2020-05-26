<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class MessagesController extends Controller
{
    private $_authEnabled;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->_authEnabled = config('laravelmessages.authEnabled');
        if ($this->_authEnabled) {
            $this->middleware('auth');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $pagintaionEnabled = config('laravelmessages.enablePagination');

        if ($pagintaionEnabled) {
            $messages = config('laravelmessages.defaultmessageModel')::paginate(config('laravelmessages.paginateListSize'));
        } else {
            $messages = config('laravelmessages.defaultmessageModel')::all();
        }

        $data = [
            'messages' => $messages,
            'pagintaionEnabled' => $pagintaionEnabled,
        ];

        return view(config('laravelmessages.showmessagesBlade'), $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view(config('laravelmessages.createmessageBlade'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $messages = [
            'direction.required' => trans('laravelmessages::laravelmessages.messages.messageDirectionRequired'),
            'account_id.required' => 'account_id is required',
            'recipient_id.required' => trans('laravelmessages::laravelmessages.messages.recipient_idRequired'),
            'content_id.email' => trans('laravelmessages::laravelmessages.messages.content_idInvalid'),
            'source_id.required' => trans('laravelmessages::laravelmessages.messages.source_idRequired'),
        ];

        $validator = Validator::make($request->all(), $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $message = config('laravelmessages.defaultmessageModel')::create([
            'account_id' => $request->input('account_id'),
            'recipient_id' => $request->input('recipient_id'),
            'content_id' => $request->input('content_id'),
            'source_id' => bcrypt($request->input('source_id')),
        ]);

        return redirect('messages')->with('success', trans('laravelmessages::laravelmessages.messages.message-creation-success'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $message = config('laravelmessages.defaultmessageModel')::find($id);

        return view(config('laravelmessages.showIndividualmessageBlade'))->withmessage($message);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $message = config('laravelmessages.defaultmessageModel')::findOrFail($id);
        $data = [
            'message' => $message,
        ];

        return view(config('laravelmessages.editIndividualmessageBlade'))->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $message = config('laravelmessages.defaultmessageModel')::find($id);
        $validator = Validator::make($request->all());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $message->save();

        return back()->with('success', trans('laravelmessages::laravelmessages.messages.update-message-success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $currentmessage = Auth::message();
        $message = config('laravelmessages.defaultmessageModel')::findOrFail($id);

        if ($currentmessage->id != $message->id) {
            $message->delete();

            return redirect('messages')->with('success', trans('laravelmessages::laravelmessages.messages.delete-success'));
        }

        return back()->with('error', trans('laravelmessages::laravelmessages.messages.cannot-delete-yourself'));
    }

    /**
     * Method to search the messages.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function search(Request $request)
    {
        $searchTerm = $request->input('message_search_box');
        $searchRules = [
            'message_search_box' => 'required|string|max:255',
        ];
        $searchMessages = [
            'message_search_box.required' => 'Search term is required',
            'message_search_box.string' => 'Search term has invalid characters',
            'message_search_box.max' => 'Search term has too many characters - 255 allowed',
        ];

        $validator = Validator::make($request->all(), $searchRules, $searchMessages);

        if ($validator->fails()) {
            return response()->json([
                json_encode($validator),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $results = config('laravelmessages.defaultmessageModel')::where('id', 'like', $searchTerm . '%')
            ->orWhere('account_id', 'like', $searchTerm . '%')
            ->orWhere('content_id', 'like', $searchTerm . '%')
            ->orWhere('status_id', 'like', $searchTerm . '%')->get();

        return response()->json([
            json_encode($results),
        ], Response::HTTP_OK);
    }
}
