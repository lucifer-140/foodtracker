<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Friendship;
use Illuminate\Http\Request;

class FriendshipController extends Controller
{

    public function index()
    {

        $user = auth()->user();


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
        $users = User::where('id', '!=', auth()->id())->latest()->paginate(20);

        return view('users.index', [
            'users' => $users,
        ]);
    }

    public function sendRequest(Request $request, User $user)
    {

        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot add yourself as a friend.');
        }


        if (auth()->user()->getFriendship($user)) {
            return back()->with('error', 'A friend request is already pending or you are already friends.');
        }


        Friendship::create([
            'requester_id' => auth()->id(),
            'addressee_id' => $user->id,

        ]);

        return redirect()->route('users.index')->with('success', 'Friend request sent!');
    }

    public function acceptRequest(Request $request, User $user)
    {

        $friendship = Friendship::where('requester_id', $user->id)
            ->where('addressee_id', auth()->id())
            ->where('status', 0)
            ->first();

        if (!$friendship) {
            abort(404);
        }

        $friendship->status = 1;
        $friendship->save();

        return redirect()->route('users.index')->with('success', 'Friend request accepted!');
    }

    public function declineRequest(Request $request, User $user)
    {
        $friendship = Friendship::where('requester_id', $user->id)
            ->where('addressee_id', auth()->id())
            ->where('status', 0)
            ->first();

        if (!$friendship) {
            abort(404);
        }

        $friendship->delete();

        return redirect()->route('users.index')->with('success', 'Friend request declined.');
    }

    public function removeFriend(Request $request, User $user)
    {
        $friendship = auth()->user()->getFriendship($user);

        if (!$friendship || $friendship->status !== 1) {
            abort(404);
        }

        $friendship->delete();

        return redirect()->route('users.index')->with('success', 'You are no longer friends with ' . $user->name);
    }

}
