<?php

namespace App\Widgets;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Widgets\BaseDimmer;

class bewijzen extends BaseDimmer
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
    $string = 'Maak hier uw bewijzen aan!';

    return view('voyager::dimmer', array_merge($this->config, [
      'icon'   => 'voyager-file-text',
      'title'  => "{$string}",
      'text'   => 'Hier maakt u de bewijzen aan voor de bestellingen.',
      'button' => [
        'text' => "naar bewijzen",
        'link' => route('deeds.index'),
      ],
      'image' => voyager_asset('images/widget-backgrounds/03.jpg'),
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
