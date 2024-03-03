<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class TicketController extends Controller
{

    public function index(Request $request)
    {
        $query = Ticket::latest();
    
        $search = $request->input('search');
        $product = $request->input('product');
        $priority = $request->input('priority');
        $ticket_status = $request->input('ticket_status');
        $assigned_to = $request->input('assigned_to');
    
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('institue_name', 'like', "%$search%")
                ->orWhere('mobile', 'like', "%$search%");
            });
        }
    
        if (!empty($product)) {
            $query->where('product', $product);
        }
    
        if (!empty($priority)) {
            $query->where('priority', $priority);
        }
    
        if (!empty($ticket_status)) {
            $query->where('ticket_status', $ticket_status);
        }

        if (!empty($assigned_to)) {
            $query->where('assigned_to', $assigned_to);
        }
    
        $tickets = $query->paginate(5);
    
        $users = User::all();
    
        return view('tickets.index', compact('tickets', 'search', 'product', 'priority', 'ticket_status', 'users'))
            ->with('i', ($tickets->currentPage() - 1) * $tickets->perPage());
    }    

    public function create()
    {
        $allUsers = User::all('id', 'name');

        return view('tickets.create', compact('allUsers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'institue_name' => 'required|string',
            'mobile' => 'required|numeric|digits:10',
            'product' => 'required|string',
            'issue' => 'nullable|string',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'assigned_to' => 'nullable|string',
            'priority' => 'required|string',
        ]);

        $ticketStatus = $request->filled('assigned_to') ? 'Assigned' : 'Open';

        if ($request->hasFile('attachment')) {
            $attachment = $request->file('attachment');
            $attachmentPath = $attachment->store('attachments', 'public');
        } else {
            $attachmentPath = null;
        }

        $ticket = new Ticket([
            'institue_name' => $request->get('institue_name'),
            'mobile' => $request->get('mobile'),
            'product' => $request->get('product'),
            'issue' => $request->get('issue'),
            'attachment' => $attachmentPath,
            'assigned_to' => $request->get('assigned_to'),
            'priority' => $request->get('priority'),
            'ticket_status' => $ticketStatus,
        ]);

        $ticket->save();

        return redirect()->route('tickets.index')
            ->with('success', 'Ticket created successfully.');
    }


    public function show($id)
    {
        $ticket = Ticket::find($id);
        return view('tickets.show', compact('ticket'));
    }

    public function edit($id)
    {
        $ticket = Ticket::find($id);
        $allUsers = User::all();

        return view('tickets.edit', compact('ticket', 'allUsers'));
        }

    public function update(Request $request, $id)
    {
        $request->validate([
            'institue_name' => 'required|string',
            'mobile' => 'required|numeric|digits:10',
            'product' => 'required|string',
            'issue' => 'nullable|string',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'assigned_to' => 'nullable|string',
            'priority' => 'required|string',
        ]);
    
        $ticketStatus = $request->filled('assigned_to') ? 'Assigned' : 'Open';
    
        if ($request->hasFile('attachment')) {
            $attachment = $request->file('attachment');
            $attachmentPath = $attachment->store('attachments', 'public');
        } else {
            $attachmentPath = $request->input('old_attachment');
        }
    
        $ticket = Ticket::find($id);
        $ticket->institue_name = $request->get('institue_name');
        $ticket->mobile = $request->get('mobile');
        $ticket->product = $request->get('product');
        $ticket->issue = $request->get('issue');
        $ticket->attachment = $attachmentPath;
        $ticket->assigned_to = $request->get('assigned_to');
        $ticket->priority = $request->get('priority');
        $ticket->ticket_status = $ticketStatus;
        $ticket->save();
    
        return redirect()->route('tickets.index')
            ->with('success', 'Ticket updated successfully.');
    }
    

    public function destroy($id)
    {
        $ticket = Ticket::find($id);
        $ticket->delete();

        return redirect()->route('tickets.index')
            ->with('success', 'Ticket deleted successfully.');
    }

}
