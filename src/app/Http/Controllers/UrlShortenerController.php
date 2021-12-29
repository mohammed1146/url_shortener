<?php

namespace App\Http\Controllers;

use App\UrlShortener\Infrastructure\Interface\IRepository;
use App\UrlShortener\Url\Interface\IUrlShortener;
use Illuminate\Http\Request;

class UrlShortenerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(protected IRepository $repository, protected IUrlShortener $urlShortener)
    {
    }

    /**
     * url shortener listing
     *
     * @return \Illuminate\View\View|\Laravel\Lumen\Application
     */
    public function index()
    {
        $urls = $this->repository->getAll();

        //process data
        if ($urls) {
            $urls->each(function ($item) {
                $item->key = $this->urlShortener->generateKey($item->id);
            });
        }

        return view('urls-list', compact('urls'));
    }

    /**
     * showing home page
     *
     * @return \Illuminate\View\View|\Laravel\Lumen\Application
     */
    public function home()
    {
        return view('index');
    }

    /**
     * create new url shortener and store in db
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Laravel\Lumen\Application
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        //validate the request
        $this->validate($request, [
            'url' => 'required|url',
        ]);

        $url = $request->input('url');

        //check if original url exists before
        $urlObj = $this->repository->findByUrl($url);

        if (! $urlObj) {
            $urlObj = $this->repository->create([
                'original_url' => $url
            ]);
        }

        //generate unique for
        $uniqueCode = $this->urlShortener->generateKey($urlObj->id);

        return view('index', [
            'code' => $uniqueCode
        ]);
    }

    /**
     * decode url key and redirect to original url
     *
     * @param string $key
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Laravel\Lumen\Http\Redirector|\Laravel\Lumen\Http\ResponseFactory
     */
    public function process(string $key)
    {
        $id = $this->urlShortener->decodeKey($key);

        $urlObj = $this->repository->findById($id[0]);

        if ($urlObj) {
            return redirect($urlObj->original_url);
        }

        return response('not found', 404);
    }
}
