<?php


namespace App\Wallet\Application\Presenter;


use App\Wallet\Domain\Model\Wallet;

class WalletPresenter
{
    public static function format(Wallet $w)
    {
        return
            [
                'address' => $w->address,
                'balance' => $w->lastBalance->balance ?? null,
                'balanceCreated' => $w->lastBalance->created_at ?? null,
                'balanceUpdated' => $w->lastBalance->updated_at ?? null
            ];
    }

}
