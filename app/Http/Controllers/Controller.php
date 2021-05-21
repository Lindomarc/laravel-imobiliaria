<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;
use App\Support\Message;
use App\Support\Seo;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Spatie\Permission\Exceptions\UnauthorizedException;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $message;
    protected $seo;

    public function __construct()
    {
        $this->message = new Message();
        $this->seo = new Seo();

    }

    public function hasPermition(string $permition)
    {
        if (!auth()->user()->hasPermissionTo($permition)) {
            throw new UnauthorizedException('403', 'Custom Message');
        }
    }
}
