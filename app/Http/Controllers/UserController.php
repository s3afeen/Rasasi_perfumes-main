<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::whereIn('role', ['user', 'employee'])->get();

        return view('dashboard.user.index' , ['users'=> $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view ('dashboard.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validation = $request->validate([
            'Fname' => 'required|string|min:3',
            'Lname' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email,',
            'mobile' => 'required|numeric',
            'password' => 'required|confirmed',
            'role' => 'required|string',
        ]);

        User::create([
            'Fname'=>$request->input('Fname'),
            'Lname'=>$request->input('Lname'),
            'email'=>$request->input('email'),
            'mobile'=>$request->input('mobile'),
            'password' => Hash::make($request->input('password')),
            'role'=>$request->input('role'),
        ]);



        return to_route('users.index')->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $user = User::findOrFail($id);
       return view('dashboard.user.show' , ['user'=> $user]);
    }



    public function show_profile()
    {
        $user = auth()->user();


        if ($user->role === 'user') {

            $adoptionRequests = $user->toAdoupt()->with('pet.pet_images')->get();
            $UserAppointments = $user->appointments()->with('service.service_images')->get();

            foreach ($UserAppointments as $appointment) {

                // Calculate the total time for the appointment (in minutes)
                $averageTime = $appointment->service->average_time;
                $petNumber = $appointment->pet_number;
                $totalMinutes = $averageTime * $petNumber;

                // Calculate hours and minutes
                $hours = floor($totalMinutes / 60);
                $minutes = $totalMinutes % 60;

                // Format the duration (e.g., "1h 30m")
                $appointment->formattedDuration = ($hours > 0 ? $hours . 'h ' : '') . $minutes . 'm';
            }

            return view('profile', [
                'user'=> $user ,
                'adoptionRequests'=> $adoptionRequests,
                'UserAppointments' => $UserAppointments,
            ]);

        } elseif (in_array($user->role, ['receptionist', 'store_manager', 'veterinarian', 'manager'])) {

            return redirect()->route('profile_dash.show');
        }

    }


    public function show_profile_dash()
    {
        return view('dashboard.profile.profile');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
      $user = User::findOrFail($id);
      return view ('dashboard.user.edit' , ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validation = $request->validate([
            'Fname' => 'required|string|min:3',
            'Lname' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email,' . $id,
            'mobile' => 'required|numeric',
            'role' => 'required|string',
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'Fname'=>$request->input('Fname'),
            'Lname'=>$request->input('Lname'),
            'email'=>$request->input('email'),
            'mobile'=>$request->input('mobile'),
            'password'=>$user->password,
            'role'=>$request->input('role'),
        ]);

        return to_route('users.index')->with('success', 'User updated successfully');
    }



    public function update_profile(Request $request)
    {

        $validation = $request->validate([
            'Fname' => 'required|string|min:3',
            'Lname' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email,' . auth()->id(), // Ensure unique email except for current user
            'mobile' => 'required|numeric',
        ]);

        // Get the authenticated user
        $user = auth()->user();


        $user->update([
            'Fname' => $request->input('Fname'),
            'Lname' => $request->input('Lname'),
            'email' => $request->input('email'),
            'mobile' => $request->input('mobile'),
            'password' => $user->password, // Keeps the existing password unchanged
        ]);

        return back()->with('success', 'Profile updated successfully');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return to_route('users.index')->with('success', 'User deleted');
    }




    public function trash()
{
    $deletedUsers = User::onlyTrashed()->get();
    return view('dashboard.user.trash' , ['deletedUsers' => $deletedUsers]);
}

public function restore($id)
{
    $user = User::withTrashed()->find($id);
    $user->restore();
    return redirect()->route('users.trash')->with('success', 'User restored successfully');
}


}
