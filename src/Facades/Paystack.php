<?php

namespace Faridibin\PaystackLaravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Faridibin\Paystack\DTOs\Response transactions()->initialize(array $data)
 * @method static \Faridibin\Paystack\DTOs\Response transactions()->verify(string $reference)
 * @method static \Faridibin\Paystack\DTOs\Response transactions()->list(array $params = [])
 * @method static \Faridibin\Paystack\DTOs\Response transactions()->fetch(string $id)
 * @method static \Faridibin\Paystack\DTOs\Response transactions()->chargeAuthorization(array $data)
 * @method static \Faridibin\Paystack\DTOs\Response transactions()->timeline(string $idOrReference)
 * @method static \Faridibin\Paystack\DTOs\Response transactions()->totals(array $params = [])
 * @method static \Faridibin\Paystack\DTOs\Response transactions()->export(array $params = [])
 *
 * @method static \Faridibin\Paystack\DTOs\Response customers()->create(array $data)
 * @method static \Faridibin\Paystack\DTOs\Response customers()->list(int $perPage = 50, int $page = 1, array $optional = [])
 * @method static \Faridibin\Paystack\DTOs\Response customers()->fetch(string $emailOrCode)
 * @method static \Faridibin\Paystack\DTOs\Response customers()->update(string $code, array $data)
 * @method static \Faridibin\Paystack\DTOs\Response customers()->validate(string $code, array $data)
 * @method static \Faridibin\Paystack\DTOs\Response customers()->setRiskAction(string $customerCode, string $riskAction)
 *
 * @method static \Faridibin\Paystack\DTOs\Response plans()->create(string $name, int $amount, string $interval, array $optional = [])
 * @method static \Faridibin\Paystack\DTOs\Response plans()->list(int $perPage = 50, int $page = 1, array $optional = [])
 * @method static \Faridibin\Paystack\DTOs\Response plans()->fetch(string $idOrCode)
 * @method static \Faridibin\Paystack\DTOs\Response plans()->update(string $idOrCode, array $data)
 *
 * @method static \Faridibin\Paystack\DTOs\Response subscriptions()->create(string $customer, string $plan, array $optional = [])
 * @method static \Faridibin\Paystack\DTOs\Response subscriptions()->list(int $perPage = 50, int $page = 1, array $optional = [])
 * @method static \Faridibin\Paystack\DTOs\Response subscriptions()->fetch(string $idOrCode)
 * @method static \Faridibin\Paystack\DTOs\Response subscriptions()->enable(array $data)
 * @method static \Faridibin\Paystack\DTOs\Response subscriptions()->disable(array $data)
 *
 * @method static \Faridibin\Paystack\DTOs\Response transfers()->initiate(array $data)
 * @method static \Faridibin\Paystack\DTOs\Response transfers()->finalize(string $transferCode, string $otp)
 * @method static \Faridibin\Paystack\DTOs\Response transfers()->bulk(array $transfers)
 * @method static \Faridibin\Paystack\DTOs\Response transfers()->list(array $params = [])
 * @method static \Faridibin\Paystack\DTOs\Response transfers()->fetch(string $transferCode)
 *
 * @method static \Faridibin\Paystack\DTOs\Response verification()->resolveAccount(string $accountNumber, string $bankCode)
 * @method static \Faridibin\Paystack\DTOs\Response verification()->validateAccount(array $data)
 * @method static \Faridibin\Paystack\DTOs\Response verification()->resolveCardBIN(string $bin)
 *
 * @method static \Faridibin\Paystack\DTOs\Response miscellaneous()->listBanks(array $params = [])
 * @method static \Faridibin\Paystack\DTOs\Response miscellaneous()->listCountries(array $params = [])
 * @method static \Faridibin\Paystack\DTOs\Response miscellaneous()->listStates(string $countryCode)
 *
 * @method static \Faridibin\Paystack\DTOs\Response disputes()->list(array $params = [])
 * @method static \Faridibin\Paystack\DTOs\Response disputes()->fetch(string $id)
 * @method static \Faridibin\Paystack\DTOs\Response disputes()->update(string $id, array $data)
 * @method static \Faridibin\Paystack\DTOs\Response disputes()->resolve(string $id, array $data)
 *
 * @method static \Faridibin\Paystack\DTOs\Response refunds()->create(string $transaction, array $optional = [])
 * @method static \Faridibin\Paystack\DTOs\Response refunds()->list(array $params = [])
 * @method static \Faridibin\Paystack\DTOs\Response refunds()->fetch(string $reference)
 *
 * @see \Faridibin\Paystack\Paystack
 */
class Paystack extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'paystack';
    }
}
