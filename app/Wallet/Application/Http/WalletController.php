<?php


namespace App\Wallet\Application\Http;

use App\Wallet\Application\Presenter\WalletPresenter;
use App\Wallet\Application\Requests\CreateWalletRequest;
use App\Wallet\Application\Requests\ListWallets;
use App\Wallet\Domain\Model\Wallet;
use App\Wallet\Domain\Repository\WalletRepository;
use App\Wallet\DTO\CreateWalletDTO;
use App\Wallet\Handler\CreateWalletHandler;
use Illuminate\Routing\Controller as BaseController;

class WalletController extends BaseController
{
    private CreateWalletHandler $handler;
    private WalletRepository $walletRepository;

    public function __construct(CreateWalletHandler $handler, WalletRepository $walletRepository)
    {
        $this->handler = $handler;
        $this->walletRepository = $walletRepository;
    }


    /**
     * @param CreateWalletRequest $request
     * @return Wallet|\Illuminate\Http\JsonResponse
     */
    public function create(CreateWalletRequest $request)
    {
        $userId = $request->get('user_id');
        try {
            return $this->handler->handle(
                new CreateWalletDTO($userId, $request->get('address'), $request->get('network'))
            );
        } catch (\Exception $e) {
            \Log::error("Can't create wallet", ['message' => $e->getMessage()]);
            return response()->json(
                [
                    'success' => 'false',
                    'message' => 'Something went wrong'
                ],
                400
            );
        }
    }

    public function list(ListWallets $request)
    {
        $userId = $request->get('userId');
        try {
            $wallets = $this->walletRepository->getByUserId($userId);
            return $wallets->map(
                function ($item) {
                    return WalletPresenter::format($item);
                }
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => 'false',
                    'message' => $e->getMessage()
                ],
                400
            );
        }
    }

    public function get($id)
    {
        try {
            return WalletPresenter::format(Wallet::with('lastBalance')->findOrFail($id));
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => 'false',
                    'message' => 'Not found'
                ],
                400
            );
        }
    }

}
