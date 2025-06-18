<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Friendship;
use Illuminate\Http\Request;

class FriendshipController extends Controller
{

    public function index()
    {
        // Get the authenticated user
        $user = auth()->user();

        // Use the relationships we defined in the User model
        $friends = $user->friends;
        $pendingRequestsFrom = $user->friendRequestsFrom;

        return view('friends.index', [
            'friends' => $friends,
            'pendingRequests' => $pendingRequestsFrom,
        ]);
    }

    /**
     * Display a listing of all users to find friends.
     */
    public function indexUsers()
    {
        // Get all users except the currently authenticated one
        $users = User::where('id', '!=', auth()->id())->latest()->paginate(20);

        return view('users.index', [
            'users' => $users,
        ]);
    }

    public function sendRequest(Request $request, User $user)
    {
        // --- VALIDATION ---
        // 1. You cannot send a request to yourself.
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot add yourself as a friend.');
        }

        // 2. You cannot send a request if a relationship already exists.
        // We use the helper method we created on the User model.
        if (auth()->user()->getFriendship($user)) {
            return back()->with('error', 'A friend request is already pending or you are already friends.');
        }

        // --- CREATE THE FRIENDSHIP RECORD ---
        Friendship::create([
            'requester_id' => auth()->id(),
            'addressee_id' => $user->id,
            // 'status' will default to 0 (Pending) as defined in our migration.
        ]);

        return redirect()->route('users.index')->with('success', 'Friend request sent!');
    }

    public function acceptRequest(Request $request, User $user)
    {
        // Find the pending friendship request sent FROM the given $user TO the logged-in user.
        $friendship = Friendship::where('requester_id', $user->id)
            ->where('addressee_id', auth()->id())
            ->where('status', 0) // Ensure it's a pending request
            ->first();

        // --- VALIDATION ---
        // If no such request exists, abort.
        if (!$friendship) {
            abort(404);
        }

        // --- UPDATE THE FRIENDSHIP RECORD ---
        $friendship->status = 1; // 1 = Accepted
        $friendship->save();

        return redirect()->route('users.index')->with('success', 'Friend request accepted!');
    }

    public function declineRequest(Request $request, User $user)
    {
        // Find the pending friendship request sent FROM the given $user TO the logged-in user.
        $friendship = Friendship::where('requester_id', $user->id)
            ->where('addressee_id', auth()->id())
            ->where('status', 0) // Ensure it's a pending request
            ->first();

        // If no such request exists, abort.
        if (!$friendship) {
            abort(404);
        }

        // --- DELETE THE FRIENDSHIP RECORD ---
        // Instead of updating the status, we'll just remove the request entirely.
        $friendship->delete();

        return redirect()->route('users.index')->with('success', 'Friend request declined.');
    }

    public function removeFriend(Request $request, User $user)
    {
        // Use our helper method to find the friendship, regardless of who was the requester.
        $friendship = auth()->user()->getFriendship($user);

        // --- VALIDATION ---
        // If they aren't friends, we can't unfriend them.
        if (!$friendship || $friendship->status !== 1) {
            abort(404); // Or redirect back with an error.
        }

        // --- DELETE THE FRIENDSHIP RECORD ---
        $friendship->delete();

        return redirect()->route('users.index')->with('success', 'You are no longer friends with ' . $user->name);
    }

    // We will implement the other methods (sendRequest, acceptRequest, etc.) later
}
