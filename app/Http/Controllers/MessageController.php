<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateNotificationsRequest;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = Message::where('user_id',auth()->id())->orderByDesc('updated_at')->get();
        $users = User::select('id', 'name')->where('id', '!=', 1)->get();
        return view('marktplaats.messages', ['messages' => $messages, 'users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMessageRequest $request)
    {
        //dd($request);
        $validatedData = $request->validated();
        $validatedData['writer'] = auth()->user()->name;
        //dd($validatedData);
        $message = Message::create($validatedData);
        
        if (auth()->user()->notifications) {
            $receiver = User::find($validatedData['user_id']);
            //dd($receiver);
            
            Mail::to($receiver->email)->send(new OrderShipped($message->text));
            //send mail to notify receiver
        }        
        return redirect()->route('messages.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNotificationsRequest $request, $user_id) //for message notifications toggler
    {
        $validatedData = $request->validated();
        //dd($user_id, $validatedData);
        User::findOrFail($user_id)->update($validatedData);
        return redirect()->route('messages.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
