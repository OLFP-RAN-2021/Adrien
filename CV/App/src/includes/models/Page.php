<?php

namespace App\models;

use App\models\entities\PageEntity;
use App\views\Page as ViewsPage;
use DOMDocument;
use Framework\Databases\Query;
use Framework\Databases\SQL;

class Page extends PageEntity
{

    /**
     * 
     */
    function __construct(...$params)
    {

        $data['page'] = $this->getPageByUrl($params[0]->current());
        $data['menu'] = $this->getPagesList();
        new ViewsPage($data);
    }

    function getPagesList()
    {
        return Query::on()
            ->select('url, title')
            ->from('pages')
            ->join('id', 'pages_meta.id', SQL::JOIN_LEFT)
            ->join('id', 'urls.id', SQL::JOIN_LEFT)
            ->execute()
            ->fetchAll(\PDO::FETCH_ASSOC);
    }


    function getPageByUrl(string $url = 'home.html')
    {
        return Query::on()
            ->select()
            ->from('pages')
            ->join('id', 'pages_meta.id', SQL::JOIN_LEFT)
            ->nest(
                'urlid',
                Query::on()
                    ->select('id')
                    ->from('urls')
                    ->where('url', SQL::EQUAL, $url)
            )
            ->execute()
            ->fetch(\PDO::FETCH_ASSOC);
    }


    /**
     * 
     */
    function gettitle(string $title)
    {
    }

    /**
     * 
     */
    function set()
    {
    }

    /**
     * CV/App/src/includes/views/html5.html
     */
    function isset()
    {
    }

    /**
     * 
     */
    function unset()
    {
    }

    /**
     * 
     */
    function __toString()
    {

        // $loader = new \Twig\Loader\FilesystemLoader('App/src/includes/views/twig');
        // $twig = new \Twig\Environment($loader, [
        //     'cache' => 'CV/App/src/includes/views/twig/cache',
        // ]);

        // echo $twig->render('index.html', ['name' => 'Fabien']);


        // $loader = new \Twig\Loader\ArrayLoader([
        //     'index' => 'Hello {{ name }}!',
        // ]);

        // $twig = new \Twig\Environment($loader);
        // echo $twig->render('index', ['name' => 'Adrien']);
    }
}
