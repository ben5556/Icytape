<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;

class CommentDimmer extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $count = \App\Models\Comment::count();
        $string = 'Comments';

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-news',
            'title'  => "{$count} {$string}",
            'text'   => "You have $count comments in your database. Click on button below to view all comments.",
            'button' => [
                'text' => 'View All Comments',
                'link' => '/admin/comments',
            ],
            'image' => Voyager::image('widgets/comments.png'),
        ]));
    }
}
