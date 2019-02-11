<?php
namespace App\Http\Controllers;
use League\Glide\ServerFactory;
use Illuminate\Support\Facades\Storage;
use League\Glide\Signatures\SignatureFactory;
use Illuminate\Contracts\Filesystem\Filesystem;
use League\Glide\Signatures\SignatureException;
use League\Glide\Responses\LaravelResponseFactory;
use File;
class ImageController extends Controller
{
    public function show(Filesystem $filesystem, $path)
    {
        try {
            // Set complicated sign key
            $signkey = env('APP_KEY');
            // Validate HTTP signature
            SignatureFactory::create($signkey)->validateRequest('images/'.$path, request()->all());
            
            $server = ServerFactory::create([
                'response'           => new LaravelResponseFactory(app('request')),
                'source'             => Storage::disk(config('voyager.storage.disk'))->getDriver(),
                'cache'              => Storage::disk(config('voyager.storage.disk'))->getDriver(),
                'source_path_prefix' => '/',
                'cache_path_prefix'  => '/.cache',
                'base_url'           => '/images',
            ]);
            $response = $server->getImageResponse($path, request()->all());
            $mimetype = Storage::disk(config('voyager.storage.disk'))->mimeType($path);
            $response->headers->set('Content-Type', $mimetype);
            $response->send();
        } catch (SignatureException $e) {
            return $e->getMessage();
        }
    }
}