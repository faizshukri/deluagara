<?php

namespace Katsitu\Http\Controllers;

use Katsitu\City;
use Katsitu\Contracts\GeoIP;
use Katsitu\Contracts\HashID;
use Katsitu\Contracts\ImageHandler;
use Katsitu\Contracts\Progress;
use Katsitu\Sponsor;
use Katsitu\User;
use Katsitu\UserStatus;
use Illuminate\Http\Request;
use Storage;

use Katsitu\Http\Requests;
use Katsitu\Http\Controllers\Controller;

class ProfileController extends Controller
{

    private $user;

    private $geoip;

    private $progress;

    private $request;

    public function __construct(Request $request, GeoIP $geoip, Progress $progress)
    {
        $this->user = $request->user();
        $this->geoip = $geoip;
        $this->progress = $progress;
        $this->request = $request;
    }

    // Handle /account
    public function index()
    {
        if(session()->has('flash_notification.message')){
            $level = session('flash_notification.level');
            flash()->$level(session('flash_notification.message'));
        }
        return redirect()->route('profile', $this->user->username);
    }

    // Handle /{username}
    public function profile( User $user )
    {
        $user_coord = $this->geoip->getLocation();
        $progress = $this->user ? $this->progress->getProgress() : null;

        return view('profiles/main', compact('user', 'user_coord', 'progress'));
    }

    public function edit(Sponsor $sponsor, UserStatus $status)
    {
        $user = $this->user->load('location.city', 'status');
        $statuses = $user->status ? $user->status->all() : $status->all();
        $sponsors =  $user->sponsor ? $user->sponsor->all() : $sponsor->all();
        $user_coord = $this->geoip->getLocation();
        $city_id = $this->get_city_id($user);

        return view('profiles/edit', compact('user', 'sponsors', 'statuses', 'user_coord', 'city_id'));
    }

    public function update( Requests\EditProfileRequest $request, HashID $hashID, ImageHandler $image,
                            UserStatus $status, Sponsor $sponsor, City $city )
    {
        $data = $request->all();

        if ($request->hasFile('profile_image')) {

            // Construct the image name
            $image_name = $hashID->encode($this->user->id) . '-' .
                substr(md5($data['profile_image']->getClientOriginalName() . $data['profile_image']->getClientSize()), 0, 6) . '.' .
                $data['profile_image']->guessExtension();

            // Move the image to storage folder
            $data['profile_image']->move(
                storage_path('app/profile_images'),
                $image_name
            );

            // Resize image
            $image->make(storage_path('app/profile_images/'.$image_name))
                  ->fit(250)
                  ->save();

            // Update the image path
            $prefix = config('app.profile_image_prefix_url');
            $data['profile_image'] = $prefix . $image_name;

            // Remove the current image
            if (substr($this->user->profile_image, 0, strlen($prefix)) == $prefix) {
                $old_image_name = substr($this->user->profile_image, strlen($prefix));
                $old_image_path = 'profile_images' . '/' . $old_image_name;

                if($old_image_name != $image_name && Storage::exists($old_image_path)) {
                    Storage::delete($old_image_path);
                }
            }
        }

        $this->user->fill($data);

        // If user location is not set
        if(!$this->user->location) {

            // If form is submitted with address
            if(isset($data['location']['city'])){
                $location = $this->user->location()->create( $data['location'] );
                $location->city()->associate( $city->find( array_get($data, 'location.city.id') ))->save();
            }

        // If user location is set
        } else {

            // But form is submitted without address
            if(!isset($data['location']['city'])){
                $this->user->location->delete();
            } else {
                $this->user->location->update( $data['location'] );
                $this->user->location->city()->associate( $city->find( array_get($data, 'location.city.id') ))->save();
            }
        }

        $this->user->status()->associate( $status->find( array_get($data, 'status.id') ) );
        $this->user->sponsor()->associate( $sponsor->find( array_get($data, 'sponsor.id') ) );

        $this->user->save();

        $this->progress->updateProgress($this->user->fresh());

        flash()->success('Your profile has been updated.');
        return redirect()->route('profile', [$this->user->username]);
    }

    private function get_city_id($user)
    {
        $old_city_id = $this->request->old('location.city.id');
        $city_id = null;

        if(!$old_city_id && sizeof($this->request->old()) > 0 && $user->location) {
            $city_id = null;
        } elseif(!$old_city_id  && $user->location) {
            $city_id = $user->location->city->id;
        } elseif(!$old_city_id && !$user->location) {
            $city_id = null;
        } elseif($old_city_id && $user->location) {
            $city_id = $old_city_id;
        } elseif($old_city_id && !$user->location) {
            $city_id = $old_city_id;
        }

        return $city_id;
    }
}
