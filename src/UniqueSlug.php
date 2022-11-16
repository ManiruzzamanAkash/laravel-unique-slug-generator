<?php

namespace Akash\LaravelUniqueSlug;

class UniqueSlug
{
    /**
     * Generate a Unique Slug.
     *
     * @param object $model
     * @param string $value
     * @param string $field
     * @param string $separator
     *
     * @return string
     * @throws \Exception
     */
    public function generate($model, $value, $field, $separator = null): string
    {
        $separator = empty($separator) ? config('laravel-unique-slug.separator') : $separator;
        $id = 0;

        $slug =  preg_replace('/\s+/', $separator, (trim(strtolower($value))));
        $slug =  preg_replace('/\?+/', $separator, (trim(strtolower($slug))));
        $slug =  preg_replace('/\#+/', $separator, (trim(strtolower($slug))));
        $slug =  preg_replace('/\/+/', $separator, (trim(strtolower($slug))));

        // $slug = preg_replace('!['.preg_quote($separator).']+!u', $separator, $value);

        // Remove all characters that are not the separator, letters, numbers, or whitespace.
        // $slug = preg_replace('![^'.preg_quote($separator).'\pL\pN\s]+!u', '', mb_strtolower($slug));

        // Replace all separator characters and whitespace by a single separator
        $slug = preg_replace('![' . preg_quote($separator) . '\s]+!u', $separator, $slug);

        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $allSlugs = $this->getRelatedSlugs($slug, $id, $model, $field);

        // If we haven't used it before then we are all good.
        if (!$allSlugs->contains("$field", $slug)) {
            return $slug;
        }

        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= config('laravel-unique-slug.max_count'); $i++) {
            $newSlug = $slug . $separator . $i;
            if (!$allSlugs->contains("$field", $newSlug)) {
                return $newSlug;
            }
        }

        throw new \Exception('Can not create a unique slug');
    }

    private function getRelatedSlugs($slug, $id, $model, $field)
    {
        if (empty($id)) {
            $id = 0;
        }

        return $model::select("$field")
            ->where("$field", 'like', $slug . '%')
            ->where('id', '<>', $id)
            ->get();
    }
}
