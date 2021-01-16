<?php

namespace Vasyldorosh\PbnSatellite;

class PostStorage
{
    /**
     * @return array
     */
    public function getPosts(): array
    {
        return (new PostApi)->getPosts($this->getDomain());
    }

    /**
     * @param string $alias
     * @return array
     */
    public function getPost(string $alias): array
    {
        return (new PostApi)->getPost($this->getDomain(), $alias);
    }

    /**
     * @return string
     */
    private function getDomain(): string
    {
        return $_SERVER['HTTP_HOST'];
    }
}