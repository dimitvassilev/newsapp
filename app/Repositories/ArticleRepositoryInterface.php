<?php

namespace App\Repositories;

interface ArticleRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Returns a certain number of the latest articles
     * sorted from most to least recent
     * @return mixed
     */
    public function latest();

    /**
     * Checks if an article has been saved by this user
     * @param $article
     * @param $user
     * @return mixed
     */
    public function isAuthoredBy($article, $user): bool;

    /**
     * Creates an article from the data and saves it for the user.
     * @param array $data
     * @param $user
     * @return mixed
     */
    public function write(array $data, $user);

    /**
     * @param $user
     * The user model representing the author
     * @param null $page
     * the page number of a paged list of articles
     * @return mixed
     * A paginated collection of articles.
     */
    public function authoredBy($user, $page=null);

    /**
     * @param $id
     * Article ID
     *
     * @param $file
     * The photo file
     *
     * @param $data
     * Photo model attributes
     */
    public function addPhoto($id, $file, $data);
}