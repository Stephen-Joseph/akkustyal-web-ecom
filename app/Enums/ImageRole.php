<?php

namespace App\Enums;

enum ImageRole: string
{
    case Thumbnail = 'thumbnail';
    case Gallery = 'gallery';
    case Swatch = 'swatch';
    case Lifestyle = 'lifestyle';
    case SizeChart = 'size_chart';
    case DimensionDiagram = 'dimension_diagram';
    case VideoPoster = 'video_poster';
}
