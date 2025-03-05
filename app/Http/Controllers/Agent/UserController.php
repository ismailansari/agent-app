<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserStoreRequest;
use Illuminate\Support\Facades\Storage;
use Laravolt\Indonesia\Models\Province;
use App\Http\Requests\UserUpdateRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    protected $module;

    public function __construct()
    {
        $this->middleware(['role:admin', 'permission:create category']);
        $this->module = 'User';
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::all();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '
                    <form action="' . route('users.destroy', $row->id) . '" method="POST" class="d-inline delete-data">
                        ' . method_field('DELETE') . csrf_field() . '
                        <div class="btn-group">
                            <a href="' . route('users.edit', $row->id) . '" class="btn btn-warning">
                                <i class="fa fa-pencil-alt"></i>
                            </a>
                            <button type="submit" class="btn btn-danger" title="Delete">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </form>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $data = [
            'page_title' => 'User',
        ];

        return view('backend.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'page_title' => 'Add ' . $this->module,
            'provinces' => Province::orderBy('name')->get(),
        ];

        return view('backend.user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        try {
            $data = $request->validated();
            $data['created_by'] = auth()->id();

            if ($request->password != null) {
                $data['password'] = Hash::make($request->password);
            }

            if ($request->hasFile('profile_image')) {
                // Menyimpan file baru
                $profile_image = $request->file('profile_image');
                $profile_imageName = now()->format('YmdHis') . '_.' . $profile_image->hashName();
                $uploaded = Storage::disk('public')->put('images/users/' . $profile_imageName, file_get_contents($profile_image));
                \Log::debug('user image uploaded', [$uploaded]);
                $data['profile_image'] = $profile_imageName;
            }

            User::create($data);

            Alert::success('Success', $this->module . ' added successfully.');
        } catch (\Throwable $th) {
            create_exception_log('User Added Error: ', $th);
            Alert::error('Error!', $this->module . ' added failed.');
        }

        return redirect()->route('users.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $data = [
            'page_title' => 'Edit Data ' . $this->module,
            'users' => $user
        ];

        return view('backend.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $data = $request->validated();
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        if ($request->hasFile('profile_image')) {
            if ($user->profile_image) {
                $deleted = Storage::disk('public')->delete('images/users/' . $user->profile_image);
                \Log::debug('User Image deleted', [$deleted]);
            }

            $profile_image = $request->file('profile_image');
            $profileImageName = now()->format('YmdHis') . '_.' . $profile_image->extension();
            $uploaded = Storage::disk('public')->put('images/users/' . $profileImageName, file_get_contents($profile_image));
            \Log::debug('user image uploaded', [$uploaded]);
            if ($uploaded) {
                $data['profile_image'] = $profileImageName;
            }
        }

        $user->update($data);

        Alert::success('Success', $this->module . ' updated successfully.');
        return redirect()->route('users.index');
    }

    public function show()
    {
        $data = [
            'page_title' => 'Show ' . $this->module,
            'users' => User::getUserList(),
        ];

        if (session('message')) {
            Alert::success('Success', session('message'));
        }

        return view('user.index', $data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if (!$user) {
            return back()->with('error', $this->module . ' not found.');
        }

        $profileImage = $user->profile_image;

        if ($profileImage) {
            Storage::disk('public')->delete('images/users/' . $profileImage);
        }

        $user->delete();

        Alert::success('Success', $this->module . ' deleted successfully.');
        return redirect()->route('users.index');
    }
}
