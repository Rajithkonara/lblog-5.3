<?php

namespace App\Http\Requests;
use App\Repositories\ArticleRepository;
use Illuminate\Foundation\Http\FormRequest;

class ArticlesRequest extends FormRequest
{
     private $article;

     public function __construct(ArticleRepository $article)
     {
        $this->article = $article;
     }

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
            'title' =>'required|min:3',
            'body' =>'required'
        ];
    }
}
