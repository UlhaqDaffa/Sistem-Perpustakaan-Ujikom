<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::latest('id')->paginate(10);
        return view('pages.members', compact('members'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'tgl_lahir' => 'required|date',
            'tgl_daftar' => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()->route('members.index')
                ->withErrors($validator)
                ->withInput();
        }

        Member::create($request->all());

        return redirect()->route('members.index')->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function update(Request $request, Member $member)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'tgl_lahir' => 'required|date',
            'tgl_daftar' => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()->route('members.index')
                ->withErrors($validator)
                ->with('error_member_id', $member->id);
        }

        $member->update($request->all());

        return redirect()->route('members.index')->with('success', 'Data anggota berhasil diperbarui.');
    }

    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('members.index')->with('success', 'Anggota berhasil dihapus.');
    }
}
