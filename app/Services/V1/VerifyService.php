<?php

namespace App\Services\V1;

use App\Mail\VerifiedAccount;
use App\Repositories\V1\Account\AccountRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Vonage\Client;
use Vonage\Client\Credentials\Basic;
use Vonage\Client\Credentials\Container;
use Vonage\SMS\Message\SMS;

class VerifyService
{
    public function __construct(protected AccountRepository $accountRepository){}

    public function verificationAccountSend()
    {
        $account = Auth::user();
        $otp = mt_rand(100000, 999999);
        $token = $account->email .'|'. $account->uuid;

        if ($account) {
            if (!Cache::has("{$token}")) {
                Cache::put("{$token}" , [
                    'otp'        => $otp,
                    'expired_at' => Carbon::now()->addMinutes(5)
                ], now()->addMinutes(5));
            }

            $cache = Cache::get("{$token}");
            $cache_otp = $cache['otp'];
            Mail::to($account->email)->queue(new VerifiedAccount($account, $cache_otp));
            // Mail::to($account->email)->queue(new VerifiedAccount($account, $account->name, $cache_otp));

            return (object)[
                'statusCode' => Response::HTTP_OK,
                'code'      => 'verify_success',
                'message'   => 'Email verifikasi berhasil dikirim.'
            ];
        }

        return (object)[
            'statusCode' => Response::HTTP_BAD_REQUEST,
            'code'      => 'verify_bad_request',
            'message'   => 'Email verfikasi gagal dikirim.'
        ];
    }

    // public function verificationOTPSend()
    // {
    //     $account = Auth::user();
    //     $otp = mt_rand(100000, 999999);

    //     try {
    //         if($account->phone_verified_at != null){
    //             return [400, [
    //                 'code'    => 'phone_has_verified',
    //                 'message' => 'No. Telepon anda telah terverifikasi!'
    //             ]];
    //         }

    //         $token = "62" . substr($account->phone, 1)."|".$account->uuid;

    //         if (!Cache::has("{$token}")) {
    //             Cache::put("{$token}" , [
    //                 'otp'        => $otp,
    //                 'expired_at' => Carbon::now()->addMinutes(5)
    //             ], now()->addMinutes(5));
    //         }

    //         $cache = Cache::get("{$token}");

    //         $basic  = new Basic(env("VONAGE_APP_ID"), env("VONAGE_SECRET_KEY"));
    //         $client = new Client(new Container($basic));

    //         $response = $client->sms()->send(
    //             new SMS("62" . substr($account->phone, 1), "PROPERTREE", "ROASTKUY.ID\n\nJangan memberitahu kode rahasia ini ke siapapun. Kode Verifikasi anda {$cache['otp']} hanya berlaku selama 5 menit.")
    //         );

    //         return (object)[
    //             'statusCode' => Response::HTTP_OK,
    //             'code'      => 'verify_success',
    //             'message'   => 'OTP verifikasi berhasil dikirim.'
    //         ];
    //     } catch (\Throwable $e) {
    //         throw $e;
    //     }

    //     return (object)[
    //         'statusCode' => Response::HTTP_BAD_REQUEST,
    //         'code'      => 'verify_bad_request',
    //         'message'   => 'OTP verfikasi gagal dikirim.'
    //     ];
    // }

    public function verificationAccount(Request $request)
    {
        $account = Auth::user();
        // $token = "62" . substr($account->phone, 1)."|".$account->uuid;
        $token = $account->email .'|'. $account->uuid;
        $cache = Cache::get("{$token}");

        if (! $cache || (Carbon::now() >= $cache['expired_at'])) {
            return (object)[
                'statusCode' => Response::HTTP_BAD_REQUEST,
                'code'      => 'verify_bad_request',
                'message'   => 'Kode OTP anda telah kadaluarsa, silahkan kirim ulang!'
            ];
        }

        if ($cache['otp'] != $request->otp) {
            return (object)[
                'statusCode' => Response::HTTP_BAD_REQUEST,
                'code'      => 'verify_bad_request',
                'message'   => 'OTP yang diinput salah.'
            ];
        }

        try {
            $result = $this->accountRepository->updateActive($account->uuid);
        } catch (\Throwable $e) {
            throw $e;
        }

        return (object)[
            'statusCode' => Response::HTTP_OK,
            'code'      => 'verify_succes',
            'message'   => 'Verifikasi akun berhasil.'
        ];
    }
}
