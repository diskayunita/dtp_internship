<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    } 

    // public function report(Exception $e)
    // {
    //     $this->_notifyThroughSms($e);
    //     return parent::report($e);
    // }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {

        if ($exception instanceof ModelNotFoundException) {
        return response()->view('errors.404', [], 404);
        }

        if ($this->isHttpException($exception)) {
            return $this->renderHttpException($exception);
        } 

        // if ($exception instanceof \ErrorException) {
        //  return response()->view('errors.500', [], 500);
        // }

        return parent::render($request, $exception);
        
    }

    // private function _notifyThroughSms($e)
    // {
    //     foreach ($this->_notificationRecipients() as $recipient) {
    //         $this->_sendSms(
    //             $recipient->phone_number,
    //             '[This is a test] It appears the server' .
    //             ' is having issues. Exception: ' . $e->getMessage() .
    //             ' Go to http://newrelic.com for more details.'
    //         );
    //     }
    // }

    // private function _notificationRecipients()
    // {
    //     $adminsFile = base_path() .
    //         DIRECTORY_SEPARATOR .
    //         'config' . DIRECTORY_SEPARATOR .
    //         'administrators.json';
    //     try {
    //         $adminsFileContents = \File::get($adminsFile);

    //         return json_decode($adminsFileContents);
    //     } catch (FileNotFoundException $e) {
    //         Log::error(
    //             'Could not find ' .
    //             $adminsFile .
    //             ' to notify admins through SMS'
    //         );
    //         return [];
    //     }
    // }

    // private function _sendSms($to, $message)
    // {
    //     $accountSid = env('TWILIO_ACCOUNT_SID');
    //     $authToken = env('TWILIO_AUTH_TOKEN');
    //     $twilioNumber = env('TWILIO_NUMBER');

    //     $client = new Client($accountSid, $authToken);

    //     try {
    //         $client->messages->create(
    //             $to,
    //             [
    //                 "body" => $message,
    //                 "from" => $twilioNumber
    //                 //   On US phone numbers, you could send an image as well!
    //                 //  'mediaUrl' => $imageUrl
    //             ]
    //         );
    //         Log::info('Message sent to ' . $twilioNumber);
    //     } catch (TwilioException $e) {
    //         Log::error(
    //             'Could not send SMS notification.' .
    //             ' Twilio replied with: ' . $e
    //         );
    //     }
    // }
    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        $guard = array_get($exception->guards(),0);

        $login = ($guard === 'admin') ? 'admin_login' : 'login-register';

        return redirect()->guest(route($login));
    }
}
