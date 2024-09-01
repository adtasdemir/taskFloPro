<?php

namespace App\Enums;

enum ProjectStatus : string {
    case ACTIVE = "active";
    case INACTIVE = "inactive";
    case INPROGRESS = "in-progress";
    case DONE = "done";
}