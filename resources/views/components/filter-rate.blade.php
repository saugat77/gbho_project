<a class="flex items-center space-x-2 mb-" href="{{ request()->fullUrlWithQuery(['min_rating' => $minVal]) }}" style="margin-bottom: 3px;">
    @for($i = 1; $i <= $minVal; $i++)
    <svg class="h-3 text-secondary" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
    </svg>
    @endfor
    @for($i = $minVal; $i < 5; $i++)
    <svg class="h-3 text-gray-400" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
    </svg>
    @endfor
    @if($minVal < 5)
    <span class="text-dark text-xs"> and up</span>
    @endif
</a>
