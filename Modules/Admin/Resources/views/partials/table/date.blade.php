<?php
if(gettype($date) == 'string') {
    $date = new Carbon\Carbon($date);
}
?>
<span data-toggle="tooltip" title="{{ is_null($date) ? '' : $date->toFormattedDateString() }}">
    {!! is_null($date) ? '&mdash;' : $date->diffForHumans() !!}
</span>

