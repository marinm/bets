<?php

namespace App\Enums;

enum BetStatus
{
    case Pending;
    case Won;
    case Lost;
    case Void;
}
