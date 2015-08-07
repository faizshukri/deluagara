<?php

namespace Katsitu\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Katsitu\Contracts\HashID;
use Katsitu\Contracts\ImageHandler;
use Katsitu\User;

class ProfileImage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'profileimage:small';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate smaller user profile image based on existing images.';

    private $filesystem;

    private $imageHandler;

    private $hashID;

    private $user;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $filesystem, ImageHandler $imageHandler, HashID $hashID, User $user)
    {
        parent::__construct();
        $this->filesystem = $filesystem;
        $this->imageHandler = $imageHandler;
        $this->hashID = $hashID;
        $this->user = $user;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $path = 'storage/app/profile_images/';

        $images = $this->filesystem->files($path);

        foreach($images as $image){

            // Proceed only if the image is an image and not small version
            if(
                preg_match('/^image\//', $this->filesystem->mimeType( $image )) !== 1 ||
                preg_match('/.*\-sm$/', $this->filesystem->name($image)) === 1
            )
                continue;

            // Small version name
            $image_sm      = $this->filesystem->name($image) . '-sm.' . $this->filesystem->extension($image);
            $image_sm_path = $path . $image_sm;

            // Check if small version is exist, if not create one
            if(!$this->filesystem->exists($image_sm_path)) {
                // From the resized image, we make the small version of it
                $this->imageHandler->make($image)
                    ->fit(80)
                    ->save($image_sm_path);
            }

            // Get user id from user hash
            preg_match('/^(.*)\-/', $this->filesystem->name($image), $m);
            $user_id = $this->hashID->decode($m[1]);

            // Get user from the id, and update it's profile image small
            $user = $this->user->find($user_id);
            $user->profile_image_sm = config('app.profile_image_prefix_url') . $image_sm;
            $user->save();
        }

        $this->comment("Profile image has been processed");
    }
}
