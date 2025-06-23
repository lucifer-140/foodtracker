<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Friendship;
use Illuminate\Http\Request;
use App\Models\Unit;
use Illuminate\Support\Carbon;

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

    public function showUserProfile(User $user)
    {
        $currentUser = auth()->user();

        if ($currentUser->id === $user->id) {
            return redirect()->route('dashboard');
        }
        if (!$currentUser->friends->contains($user)) {
            abort(403, 'You can only view the profiles of your friends.');
        }

        $units = Unit::all()->keyBy('id');
        $meals = $user->meals()->with('ingredients')->latest()->paginate(9);

        $meals->each(function ($meal) use ($units) {
            $totals = ['calories' => 0, 'protein' => 0, 'fat' => 0, 'carbs' => 0];
            foreach ($meal->ingredients as $ingredient) {
                $quantity = $ingredient->pivot->quantity;
                $unitId = $ingredient->pivot->unit_id;
                $conversionFactor = $units[$unitId]->conversion_factor ?? 1.0;
                $quantityInGrams = $quantity * $conversionFactor;
                $totals['calories'] += ($ingredient->calories_per_100g / 100) * $quantityInGrams;
                $totals['protein']  += ($ingredient->protein_per_100g / 100) * $quantityInGrams;
                $totals['fat']      += ($ingredient->fat_per_100g / 100) * $quantityInGrams;
                $totals['carbs']    += ($ingredient->carbs_per_100g / 100) * $quantityInGrams;
            }
            $meal->total_calories = $totals['calories'];
            $meal->total_protein  = $totals['protein'];
            $meal->total_fat      = $totals['fat'];
            $meal->total_carbs    = $totals['carbs'];
        });


        $friendsCount = $user->friends->count();

        $logDates = $user->meals()
            ->selectRaw('DATE(created_at) as log_date')
            ->distinct()
            ->orderBy('log_date', 'desc')
            ->pluck('log_date');

        $dayStreak = 0;
        if ($logDates->isNotEmpty()) {
            $currentDate = today();
            if ($logDates->first() == $currentDate->toDateString() || $logDates->first() == $currentDate->copy()->subDay()->toDateString()) {
                $dayStreak = 1;
                $previousDate = Carbon::parse($logDates->first())->subDay();
                foreach ($logDates->slice(1) as $date) {
                    if ($date == $previousDate->toDateString()) {
                        $dayStreak++;
                        $previousDate->subDay();
                    } else {
                        break;
                    }
                }
            }
        }

        return view('users.show-profile', [
            'user' => $user,
            'meals' => $meals,
            'friendsCount' => $friendsCount, // Pass new data to the view
            'dayStreak' => $dayStreak,       // Pass new data to the view
        ]);
    }



}
