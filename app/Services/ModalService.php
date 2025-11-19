<?php
namespace App\Services;

use Illuminate\Support\Facades\View;

class ModalService
{
    public function getModalContent(string $key, array $data = []): array
    {
        $modal = config("modals.$key");

        if (! $modal) {
            throw new \Exception("Modal config for '$key' not found.");
        }

        $body = View::make($modal['body'], $data)->render();
        $footer = isset($modal['footer']) ? View::make($modal['footer'], $data)->render() : null;

        return [
            'id'    => $key,
            'title' => $modal['title'],
            'body'  => $body,
            'footer' => $footer,
            'size'  => $modal['size'] ?? '',
        ];
    }

    public function get($module, $key, $params = [])
    {
        $config = config("modals.{$module}.{$key}");

        if (!$config) {
            abort(404, 'Modal not found.');
        }

        

        $html = view($config['view'], $params)->render();

        return [
            'title' => $config['title'] ?? '',
            'size' => $config['size'] ?? 'md',
            'html'  => $html,
            'header' => $config['header'] ?? true,
        ];
    }
}
