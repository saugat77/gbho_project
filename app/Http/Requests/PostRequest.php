<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'slug' => 'nullable',
            'cover_image' => 'nullable',
            'content' => 'nullable',
            'excerpt' => [
                'nullable',
                'max:' . \App\Post::EXCERPT_LENGTH
            ],
            'published_date' => 'nullable',
            'is_draft' => 'nullable',
            'tags' => 'nullable',

            'seo_title' => 'nullable',
            'seo_description' => [
                'nullable',
                'max:' . \App\Post::SEO_DESCRIPTION_LENGTH
            ],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'excerpt' => $this->generateExcerpt(),
            'seo_title' => $this->generateSeoTitle(),
            'seo_description' => $this->generateSeoDescription()
        ]);
    }

    private function generateExcerpt()
    {
        if ($this->filled('excerpt')) {
            return $this->excerpt;
        }

        return substr(strip_tags(request('content')), 0, \App\Post::EXCERPT_LENGTH);
    }

    private function generateSeoTitle()
    {
        if ($this->filled('seo_title')) {
            return $this->seo_title;
        }

        return $this->title;
    }

    private function generateSeoDescription()
    {
        if ($this->filled('seo_description')) {
            return $this->seo_description;
        }

        if ($this->filled('excerpt')) {
            return substr($this->excerpt, 0, \App\Post::SEO_DESCRIPTION_LENGTH);
        }

        return substr(strip_tags(request('content')), 0, \App\Post::SEO_DESCRIPTION_LENGTH);
    }
}
