<?php


namespace App\Reposotories\TelegramApiRepository;


use GuzzleHttp\Client;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;

class TelegramApiRepository implements TelegramApiRepositoryInterface
{
    /**
     * @var Repository|Application|mixed
     */
    private $uri;

    /**
     * @var Repository|Application|mixed
     */
    private $key;

    /**
     * @var Repository|Application|mixed
     */
    private $chatId;

    /**
     * @var Client
     */
    private $client;


    public function __construct()
    {
        $this->client = new Client();
        $this->uri    = config('app.telegram_api.uri');
        $this->key    = config('app.telegram_api.key');
        $this->chatId = config('app.telegram_api.chat_id');
    }


    public function sendMessage(string $event, object $data)
    {
        $message = $this->getMessageByEvent($event, $data);
        $uri = $this->getSendMessageUri();
        $query   = [
            'chat_id' => $this->chatId,
            'text'    => $message,
            'parse_mode' => 'HTML'
        ];
        $this->client->get($uri, ['form_params' => $query]);
    }

    private function getSendMessageUri(): string
    {
        return $this->uri . 'bot' . $this->key . '/' . 'sendMessage';
    }


    private function getMessageByEvent(string $event, object $data): ?string
    {
        if ($event == 'review') {
            return $this->getMessageAboutNewReview($data);
        }

        if ($event == 'order') {
            return $this->getMessageAboutNewOrder($data);
        }
        return null;
    }


    private function getMessageAboutNewReview(object $data): string
    {
        $uri = !is_null($data->product_id) ? route('product', ['category' => $data->product->category->slug, 'product' => $data->product->slug]) : route('getReviews');
        $title = !is_null($data->product_id) ? $data->product->name : 'Отзыв о магазине';
        $product = $title . ' (' . $uri . ')';
        return "<b>Новый отзыв</b> \n<b>Имя:</b> $data->name \n<b>Товар:</b> $product \n<b>Дата:</b> $data->created_at \n<b>Отзыв:</b> \n$data->review \n ";
    }


    private function getMessageAboutNewOrder(object $data): string
    {
        return 'new order';
    }
}
