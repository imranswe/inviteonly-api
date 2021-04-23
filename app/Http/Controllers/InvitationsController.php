<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\InvitationRequest;
use App\Models\Invitation;

class InvitationsController extends Controller
{
    /**
     * Show all data
     *
     * @return Json
     */
    public function index()
    {
        $invitations = Invitation::all();
        return response()->json(['invitations' => $invitations]);
    }

    /**
     * Create New entry
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function store(InvitationRequest $request)
    {
        $invite = Invitation::create($request->all());

        return response()->json(['invite' => $invite]);
    }
}
