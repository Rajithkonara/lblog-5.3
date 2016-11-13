<?php

namespace App\Policies;

use App\Article;
use App\User;
use App\owns;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @param Article $article
     * @return bool
     */
    public function update(User $user,Article $article)
    {
        return $user->owns($article);
    }

    /**
     * @param  User $user
     * @param  Article $article
     * @return bool
     */
    public function delete(User $user, Article $article)
    {
       return $user->owns($article);
    }
}
