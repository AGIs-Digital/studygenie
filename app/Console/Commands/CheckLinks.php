<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class CheckLinks extends Command
{
    protected $signature = 'check:links';
    protected $description = 'Find all links in views, check their HTTP status, and return a sorted list of links by their HTTP status';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $client = new Client();
        $results = [];

        // Directory where your views are stored
        $viewPath = resource_path('views');

        // Get all view files
        $files = File::allFiles($viewPath);

        foreach ($files as $file) {
            $results = [];
            $contents = File::get($file);

            // Match all href links
            preg_match_all('/<a\s+href="([^"]+)"/i', $contents, $matches);

            $this->line($file . ' ' . count($matches[1]) . ' links');

            foreach ($matches[1] as $url) {
                $message = '';
                // ignore mailto links
                if (strpos($url, 'mailto:') === 0) {
                    continue;
                }

                // ignore empty links
                if (empty($url) || $url === '#') {
                    continue;
                }

                // Check if the link is a route
                if (preg_match('/{{\s*(route|url)\(([^}]+)\)\s*}}/', $url, $routeMatches)) {
                    $search = ['{{', "{{ ", "}}", " }}"];
                    $replace = ['', '', '', ''];

                    $command = str_replace($search, $replace, $routeMatches[0]);
                    $url = eval('return [' . $command . '];');
                    $url = $url[0];
                }

                if (strpos($url, 'http') !== 0) {
                    // if local link, add the base url
                    $url = config('app.url') . $url;
                }

                try {
                    $response = $client->request('GET', $url);
                    $status = $response->getStatusCode();
                    $message = $response->getReasonPhrase();
                } catch (RequestException $e) {
                    $status = $e->hasResponse() ? $e->getResponse()->getStatusCode() : 'Error';
                } catch (\Exception $e) {
                    $status = null;
                    $message = $e->getMessage();
                }

                $results[] = [
                    'url' => $url,
                    'status' => $status,
                    'message' => $message ?? '',
                ];
            }

            // Sort results by status
            usort($results, function ($a, $b) {
                return $a['status'] <=> $b['status'];
            });

            // Print results
            foreach ($results as $result) {
                if ($result['status'] < 200 || $result['status'] >= 400) {
                    $this->error("- {$result['url']} - {$result['status']}" . ($result['message'] ? " - {$result['message']}" : ''));
                } else {
                    $this->info("- {$result['url']} - {$result['status']}" . ($result['message'] ? " - {$result['message']}" : ''));
                }
            }
        }

        return 0;
    }
}
