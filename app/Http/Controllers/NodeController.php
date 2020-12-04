<?php

namespace App\Http\Controllers;

use App\Models\Node;
use Illuminate\Http\Request;

class NodeController extends Controller
{

    public function index()
    {

       $nodes = Node::get();

       return view('nodes.index', ['nodes' => $nodes]);

    }
    public function store(Request $request)
    {

        $request->validate([
            'id' => 'required',

        ]);
    
        Node::create($request->all());

        return redirect()->route('nodes.index')
                        ->with('success','Node created successfully.');
    }

}
