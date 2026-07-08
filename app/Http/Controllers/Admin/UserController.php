<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Anggota;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        return view('admin.users.index', [
            'users' => User::with('anggota')->orderBy('name')->paginate(15),
        ]);
    }

    public function create(): View
    {
        return view('admin.users.create', [
            'anggotaList' => Anggota::orderBy('nama_lengkap')->get(),
        ]);
    }

    public function store(UserRequest $request): RedirectResponse
    {
        $data = collect($request->validated())->except('password')->toArray();
        $data['password'] = $request->input('password');

        $user = User::create($data);

        return redirect()->route('admin.users.index')
            ->with('success', 'Akun "' . $user->name . '" berhasil dibuat.');
    }

    public function edit(User $user): View
    {
        return view('admin.users.edit', [
            'user' => $user,
            'anggotaList' => Anggota::orderBy('nama_lengkap')->get(),
        ]);
    }

    public function update(UserRequest $request, User $user): RedirectResponse
    {
        $data = collect($request->validated())->except('password')->toArray();

        if ($request->filled('password')) {
            $data['password'] = $request->input('password');
        }

        $user->update($data);

        return redirect()->route('admin.users.index')
            ->with('success', 'Akun "' . $user->name . '" berhasil diperbarui.');
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Kamu tidak bisa menghapus akunmu sendiri.');
        }

        if ($user->isSuperAdmin() && User::where('role', 'super_admin')->count() <= 1) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Minimal harus ada satu Super Admin.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Akun berhasil dihapus.');
    }
}
