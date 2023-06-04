<?php

namespace App\Widgets;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Widgets\BaseDimmer;

class orders extends BaseDimmer
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
    $count = \App\Order::count();
    $string = 'bestellingen';

    return view('voyager::dimmer', array_merge($this->config, [
      'icon'   => 'voyager-bag',
      'title'  => "{$count} {$string}",
      'text'   => 'Je hebt ' . $count . ' bestellingen in je database. Klik op de knop hieronder om alle bestellingen te bekijken.',
      'button' => [
        'text' => "Bekijk alle bestellingen",
        'link' => route('voyager.orders.index'),
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
