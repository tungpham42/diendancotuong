<?php

/*
 * This file is part of Flarum.
 *
 * For detailed copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */

use Flarum\Extend;
use Flarum\Tags\Event\Saving;
use Illuminate\Support\Str;

return [
    (new Extend\Event())
        ->listen(Saving::class, function (Saving $event) {
            $attributes = $event->data['attributes'] ?? [];

            // If the tag name is being created or changed, automatically force a perfect transliterated slug
            if (isset($attributes['name'])) {
                $event->tag->slug = Str::slug($attributes['name']);
            }
        })
];
