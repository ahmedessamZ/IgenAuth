<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\DTOs\Auth\CheckUserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CheckUserRequest;
use App\Http\Requests\Auth\VerifyOtpRequest;
use App\Responses\Api\DataResponse;
use App\Responses\Api\ErrorResponse;
use App\Services\Auth\CheckUserService;
use App\Services\Auth\SendOtpService;
use App\Services\Auth\VerifyOtpService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as HTTPResponse;
use Throwable;

class AuthenticateController extends Controller
{
    private CheckUserService $checkUserService;
    private SendOtpService $sendOtpService;
    private VerifyOtpService $verifyOtpService;


    public function __construct
    (
        CheckUserService $checkUserService,
        SendOtpService $sendOtpService,
        VerifyOtpService $verifyOtpService
    )
    {
        $this->checkUserService = $checkUserService;
        $this->sendOtpService = $sendOtpService;
        $this->verifyOtpService = $verifyOtpService;
    }


    public function checkUser(CheckUserRequest $request): JsonResponse
    {
        try {
            $dto = new CheckUserDTO($request->only('country_code','phone'));
            $user = $this->checkUserService->checkUser($dto);

            if ($user) {
                return (new DataResponse('User exists.', ['user_exists' => true]))->toJson();
            } else {
                return (new DataResponse('User does not exist.', ['user_exists' => false]))->toJson();
            }

        } catch (Throwable $exception) {
            return (new ErrorResponse(
                'Something went wrong',
                HTTPResponse::HTTP_BAD_REQUEST,
            ))->toJson($exception);
        }
    }

    public function sendOtp(CheckUserRequest $request): JsonResponse
    {
        try {
            $dto = new CheckUserDTO($request->only('country_code', 'phone'));
            $user = $this->checkUserService->checkUser($dto);

            if (!$user) {
                return (new ErrorResponse(
                    'User does not exist.',
                    HTTPResponse::HTTP_NOT_FOUND
                ))->toJson();
            }

            $otp = $this->sendOtpService->sendOtp($user);

            return (new DataResponse('OTP sent successfully.', ['otp' => $otp]))->toJson();

        } catch (Throwable $exception) {
            return (new ErrorResponse(
                'Failed to send OTP.',
                HTTPResponse::HTTP_INTERNAL_SERVER_ERROR,
            ))->toJson($exception);
        }
    }

    public function verifyOtp(VerifyOtpRequest $request): JsonResponse
    {
        try {
            $dto = new CheckUserDTO($request->only('country_code', 'phone', 'otp'));
            $user = $this->checkUserService->checkUser($dto);

            if (!$user) {
                return (new ErrorResponse(
                    'User does not exist.',
                    HTTPResponse::HTTP_NOT_FOUND
                ))->toJson();
            }

            $check = $this->verifyOtpService->verifyOtp($dto,$user);

            if ($check) {
                return (new DataResponse('Verified Successfully',))->toJson();
            } else {
                return (new DataResponse('Wrong OTP',))->toJson();
            }

        } catch (Throwable $exception) {
            return (new ErrorResponse(
                'Failed to verify OTP.',
                HTTPResponse::HTTP_INTERNAL_SERVER_ERROR,
            ))->toJson($exception);
        }
    }

}
