<?php
namespace App\Exceptions;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Validator;
class Handler extends ExceptionHandler
{
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
        'password',
        'password_confirmation',
    ];
    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }
    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
	public function render($request, Exception $exception)
	{
<<<<<<< Updated upstream
=======
<<<<<<< Updated upstream
		return parent::render($request, $exception);
		
>>>>>>> Stashed changes
		//exception untuk membatasi maksimum file size yg di upload
    if ($exception instanceof \Symfony\Component\HttpFoundation\File\Exception\FileException) {
        // create a validator and validate to throw a new ValidationException
        return Validator::make($request->all(), [
            'file_akta' => 'required|file|size:5000',
        ])->validate();
		}
	}

}
=======
	return parent::render($request, $exception);
	}
}
>>>>>>> Stashed changes
