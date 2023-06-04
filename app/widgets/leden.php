<?php

namespace App\Widgets;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Widgets\BaseDimmer;

class leden extends BaseDimmer
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
    $count = \App\User::count();
    $string = 'Leden';

    return view('voyager::dimmer', array_merge($this->config, [
      'icon'   => 'voyager-bag',
      'title'  => "{$count} {$string}",
      'text'   => 'U heeft ' . $count . ' leden in uw database. Klik op de knop hieronder om de leden te bekijken.',
      'button' => [
        'text' => "Beheer leden",
        'link' => route('voyager.users.index'),
      ],
      'image' => voyager_asset('images/widget-backgrounds/02.jpg'),
    ]));
  }

  /**
   * Determine if the widget should be displayed.
   *
   * @return bool
   */
  public function shouldBeDisplayed()
  {
    return Auth::user()->can('browse', Voyager::model('User'));
  }
}
