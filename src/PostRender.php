<?php

namespace Vasyldorosh\PbnSatellite;

class PostRender
{
    const TEMPLATE_LIST = '[posts][/posts]';

    /**
     * @param string $content
     * @return string
     */
    public function replaceList(string $content): string
    {
        if (substr_count($content, self::TEMPLATE_LIST)) {
            $posts = (new PostStorage)->getPosts();
            $content = str_replace(self::TEMPLATE_LIST, $this->renderList($posts), $content);
        }

        return $content;
    }

    /**
     * @param array $items
     * @return string
     */
    public function renderList(array $items): string
    {
        return $this->renderFile('list', compact('items'));
    }

    /**
     * @param array $item
     * @return string
     */
    public function renderItem(array $item): string
    {
        return $this->renderFile('view', $item);
    }

    /**
     * Renders a view file.
     * This method includes the view file as a PHP script
     * and captures the display result if required.
     * @param string view file
     * @param array data to be extracted and made available to the view file
     * @return string the rendering result. Null if the rendering result is not required.
     */
    public function renderFile($_viewFile_,$_data_=null): string
    {
        // we use special variable names here to avoid conflict when extracting data
        if(is_array($_data_)) {
            extract($_data_, EXTR_PREFIX_SAME, 'data');
        } else {
            $data = $_data_;
        }
        ob_start();
        ob_implicit_flush(false);

        require(__DIR__ . '/../../../../blog/views/' . $_viewFile_ . '.php');

        return ob_get_clean();
    }
}