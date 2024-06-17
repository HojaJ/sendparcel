<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Car\Models\Car;
use Modules\Parcel\Models\Parcel;

class FrontendController extends Controller
{
    /**
     * Retrieves the view for the index page of the frontend.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $cars = Car::with('from_city', 'to_city')->where('status', 1)->whereNot('user_id', auth()->id())->latest()->take(9)->get();
        return view('frontend.index', compact('cars'));
    }

    public function cars()
    {
        $cars = Car::where('status', 1)->whereNot('user_id', auth()->id())->latest()->paginate(12);
        return view('frontend.cars', compact('cars'));

    }

    public function updateParcel(Request $request)
    {

        Parcel::create([
           'user_id' => auth()->user()->id,
           'car_id' => $request->id,
            'weight' => $request->weight
        ]);
        return redirect()->route('backend.parcels.index');
    }

    /**
     * Privacy Policy Page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function privacy()
    {
        return view('frontend.privacy');
    }

    /**
     * Terms & Conditions Page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function terms()
    {
        return view('frontend.terms');
    }
}
