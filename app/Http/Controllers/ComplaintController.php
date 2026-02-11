<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            $complaints = Complaint::latest()->get();
        } else {
            $complaints = $user->complaints()->latest()->get();
        }

        return view('complaints.index', compact('complaints'));
    }

    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('complaints.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'description' => 'required',
            'priority' => 'required',
            'category_id' => 'required',
            'attachment' => 'nullable|image|max:2048'
        ]);

        $fileName = null;

        if ($request->hasFile('attachment')) {
            $fileName = $request->file('attachment')->store('complaints', 'public');
        }

        Complaint::create([
            'complaint_code' => 'CMP-' . strtoupper(Str::random(6)),
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'subject' => $request->subject,
            'description' => $request->description,
            'priority' => $request->priority,
            'status' => 'pending',
            'attachment' => $fileName,
        ]);

        return redirect()->route('complaints.index')
            ->with('success', 'Complaint submitted!');
    }

    public function show(string $id)
    {
        $complaint = Complaint::findOrFail($id);
        return view('complaints.show', compact('complaint'));
    }

    public function edit(string $id)
    {
        $complaint = Complaint::findOrFail($id);
        return view('complaints.edit', compact('complaint'));
    }

    public function update(Request $request, string $id)
    {
        $complaint = Complaint::findOrFail($id);

        $complaint->update([
            'status' => $request->status
        ]);

        return redirect()->route('complaints.index')->with('success', 'Status updated!');
    }

    public function destroy(string $id)
    {
        $complaint = Complaint::findOrFail($id);
        $complaint->delete();

        return redirect()->route('complaints.index')->with('success', 'Complaint deleted!');
    }
    public function adminIndex()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $complaints = Complaint::latest()->get();

        return view('admin.index', compact('complaints'));
    }
}
