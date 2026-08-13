<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MetadataFetcher
{
    /**
     * Fetch metadata (title, description, favicon) from a URL.
     *
     * @param  string  $url
     * @return array{title: string|null, description: string|null, favicon_url: string|null}
     */
    public function fetch(string $url): array
    {
        $meta = [
            'title'       => null,
            'description' => null,
            'favicon_url' => null,
        ];

        try {
            $response = Http::timeout(5)
                ->withHeaders(['User-Agent' => 'Mozilla/5.0 (compatible; DevShelf/1.0)'])
                ->get($url);

            if (! $response->successful()) {
                return $this->withFallbackFavicon($meta, $url);
            }

            $html = $response->body();

            $meta['title']       = $this->parseTitle($html);
            $meta['description'] = $this->parseDescription($html);
            $meta['favicon_url'] = $this->parseFavicon($html, $url);
        } catch (\Throwable) {
            // Network errors, timeouts, invalid URLs — silently fall back
        }

        return $this->withFallbackFavicon($meta, $url);
    }

    /**
     * Extract the <title> tag content.
     */
    protected function parseTitle(string $html): ?string
    {
        if (preg_match('/<title[^>]*>(.*?)<\/title>/is', $html, $matches)) {
            return html_entity_decode(trim($matches[1]), ENT_QUOTES, 'UTF-8') ?: null;
        }

        return null;
    }

    /**
     * Extract the <meta name="description"> content.
     */
    protected function parseDescription(string $html): ?string
    {
        // Standard meta description
        if (preg_match('/<meta[^>]+name=["\']description["\'][^>]+content=["\']([^"\']*)["\'][^>]*>/is', $html, $matches)) {
            return html_entity_decode(trim($matches[1]), ENT_QUOTES, 'UTF-8') ?: null;
        }

        // Reversed attribute order: content before name
        if (preg_match('/<meta[^>]+content=["\']([^"\']*)["\'][^>]+name=["\']description["\'][^>]*>/is', $html, $matches)) {
            return html_entity_decode(trim($matches[1]), ENT_QUOTES, 'UTF-8') ?: null;
        }

        // OpenGraph description fallback
        if (preg_match('/<meta[^>]+property=["\']og:description["\'][^>]+content=["\']([^"\']*)["\'][^>]*>/is', $html, $matches)) {
            return html_entity_decode(trim($matches[1]), ENT_QUOTES, 'UTF-8') ?: null;
        }

        return null;
    }

    /**
     * Extract the favicon URL from <link rel="icon"> or fall back to Google API.
     */
    protected function parseFavicon(string $html, string $url): ?string
    {
        // Try <link rel="icon"> or <link rel="shortcut icon">
        if (preg_match('/<link[^>]+rel=["\'](?:shortcut )?icon["\'][^>]+href=["\']([^"\']+)["\'][^>]*>/is', $html, $matches)) {
            $href = trim($matches[1]);
            return $this->resolveUrl($href, $url);
        }

        // Reversed attribute order
        if (preg_match('/<link[^>]+href=["\']([^"\']+)["\'][^>]+rel=["\'](?:shortcut )?icon["\'][^>]*>/is', $html, $matches)) {
            $href = trim($matches[1]);
            return $this->resolveUrl($href, $url);
        }

        return null;
    }

    /**
     * Resolve a potentially relative URL against a base URL.
     */
    protected function resolveUrl(string $href, string $baseUrl): string
    {
        if (str_starts_with($href, 'http://') || str_starts_with($href, 'https://')) {
            return $href;
        }

        $parsed = parse_url($baseUrl);
        $scheme = $parsed['scheme'] ?? 'https';
        $host   = $parsed['host'] ?? '';

        if (str_starts_with($href, '//')) {
            return $scheme . ':' . $href;
        }

        return $scheme . '://' . $host . '/' . ltrim($href, '/');
    }

    /**
     * Ensure there is always a favicon URL via the Google API fallback.
     */
    protected function withFallbackFavicon(array $meta, string $url): array
    {
        if (empty($meta['favicon_url'])) {
            $host = parse_url($url, PHP_URL_HOST);
            if ($host) {
                $meta['favicon_url'] = 'https://www.google.com/s2/favicons?domain=' . $host . '&sz=64';
            }
        }

        return $meta;
    }
}
