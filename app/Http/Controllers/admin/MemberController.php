<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Member;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::with('user')->get();
        return view('admin.member.index', compact('members'));
    }

    public function show($id)
    {
        $member = Member::with('user')->findOrFail($id);
        return view('admin.member.show', compact('member'));
    }
}
