<?php

namespace App\Exceptions;


use App\Traits\RoleException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
	use RoleException;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }


	public function render($request, Throwable $exception) {

		if($exception instanceof UnauthorizedException) {

            $roles = $exception->getRequiredRoles();

            $roleString = implode(', ', $roles);

            return back()->with('noRights', 'This operation can be performed by the ' . $roleString);
		}


		return parent::render($request, $exception);
	}
}
