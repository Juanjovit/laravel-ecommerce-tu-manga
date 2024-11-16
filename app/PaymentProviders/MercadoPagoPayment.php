<?php

namespace App\PaymentProviders;


use App\Models\Manga;
use Illuminate\Database\Eloquent\Collection;
use MercadoPago\Preference;

class MercadoPagoPayment
{
    protected Preference $preference;

    protected array $items = [];

    protected array $backUrls = [];

    protected string $autoReturn = "";

    protected string $publicKey;

    protected float|int $total;

    public function __construct()
    {
        \MercadoPago\SDK::setAccessToken(config('mercadopago.accessToken'));
        $this->publicKey = config('mercadopago.publicKey');
        $this->preference = new Preference();
    }

    public function addItem(Manga $manga, int $quantity): self
    {
        $item = new \MercadoPago\Item();
        $item->title = $manga->title;
        $item->unit_price = $manga->price;
        $item->quantity = $quantity; 
    
        $this->items[] = $item;
    
        return $this;
    }
    

    public function addItems(array $items): self
    {
        foreach ($items as $cartItem) {
            $this->addItem($cartItem->getProduct(), $cartItem->getQuantity());
        }
    
        return $this;
    }

    public function withBackUrls(?string $success = null, ?string $pending = null, ?string $failure = null): self
    {
        $this->backUrls = [
            'success' => $success,
            'pending' => $pending,
            'failure' => $failure,
        ];

        return $this;
    }

    public function withAutoReturn(): self
    {
        $this->autoReturn = "approved";

        return $this;
    }

    public function save()
    {
        $this->preference->items = $this->items;
        $this->preference->back_urls = $this->backUrls;
        $this->preference->auto_return = $this->autoReturn;
        $this->preference->save();
    }

    public function getPublicKey(): string
    {
        return $this->publicKey;
    }

    public function getTotal(): float|int
    {
        $total = 0;

        foreach($this->items as $item) {
            $total += $item->quantity * $item->unit_price;
        }

        return $total;
    }

    public function getPreferenceId(): string
    {
        return $this->preference->id;
    }
}
