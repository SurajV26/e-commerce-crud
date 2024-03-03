<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Ticket;

class UserTicketController extends Controller
{
    public function index(Request $request)
    {
        $user_id = Auth::user()->id;
   
        $user = Auth::user();

        $tickets = $user->tickets()->paginate(5);

        return view('usertickets.index', compact('tickets', 'user'));
    }
    
    public function create()
    {
        return view('usertickets.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $user->tickets()->create($request->all());
        return redirect()->route('usertickets.index')->with('success', 'Ticket created successfully');
    }

    public function show($id)
    {
        $user = Auth::user();
        $ticket = $user->tickets()->find($id);

        if (!$ticket) {
            return redirect()->route('usertickets.index')->with('error', 'Ticket not found');
        }

        return view('usertickets.show', compact('ticket'));
    }

    public function edit($id)
    {
        $user = Auth::user();
        $ticket = $user->tickets()->find($id);

        if (!$ticket) {
            return redirect()->route('usertickets.index')->with('error', 'Ticket not found');
        }

        return view('usertickets.edit', compact('ticket'));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $ticket = $user->tickets()->find($id);

        if (!$ticket) {
            return redirect()->route('usertickets.index')->with('error', 'Ticket not found');
        }

        $ticket->update($request->all());

        return redirect()->route('usertickets.index')->with('success', 'Ticket updated successfully');
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $ticket = $user->tickets()->find($id);

        if ($ticket) {
            $ticket->delete();
            return redirect()->route('usertickets.index')->with('success', 'Ticket deleted successfully');
        } else {
            return redirect()->route('usertickets.index')->with('error', 'Ticket not found');
        }
    }
}

