<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMemberRequest;
use App\Http\Requests\Admin\UpdateMemberRequest;
use App\Models\Member;
use App\Models\User;

class MemberController extends Controller
{
    public function index()
    {
        // Eager-load subscriptions for status display on cards
        $members = Member::with('subscriptions')->paginate(10);

        return view('admin.members.index', compact('members'));
    }

    public function create()
    {
        $users = User::doesntHave('member')->get();

        return view('admin.members.create', compact('users'));
    }

    public function store(StoreMemberRequest $request)
    {
        Member::create($request->validated());

        return redirect()->route('admin.members.index')->with('success', 'Member created.');
    }

    public function edit(Member $member)
    {
        $users = User::doesntHave('member')->orWhere('id', $member->user_id)->get();

        return view('admin.members.edit', compact('member', 'users'));
    }

    public function update(UpdateMemberRequest $request, Member $member)
    {
        $member->update($request->validated());

        return redirect()->route('admin.members.index')->with('success', 'Member updated.');
    }

    public function destroy(Member $member)
    {
        $member->delete();

        return redirect()->route('admin.members.index')->with('success', 'Member deleted.');
    }
}
