<select name="{{ $settingKey }}" class="custom-select">
    <option value="">Select Page</option>
    @foreach(\App\Page::select(['id', 'title', 'slug'])->orderBy('title')->get(); as $page)
    <option value="{{ $page->slug }}" @if(old($settingKey, settings($settingKey) == $page->slug)) selected @endif>{{ $page->title }}</option>
    @endforeach
</select>