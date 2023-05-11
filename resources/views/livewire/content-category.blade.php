<div>
    <div class="mb-3">
        <label>@lang('backend.categories')</label>
        <select wire:model="selectedContinent" wire:change="changeCategory" class="form-control" name="category">
            <option value="-1">@lang('backend.categories')</option>
            @foreach($continents as $continent)
                <option value="{{$continent->id}}">{{$continent->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>@lang('backend.alt-categories')</label>
        <select wire:model="selectedCountry" wire:change="changeSub" class="form-control" name="altCategory">
            <option value="-1">@lang('backend.alt-categories')</option>
            @foreach($countries as $country)
                <option value="{{$country->id}}">{{$country->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>@lang('backend.sub-categories')</label>
        <select class="form-control" name="subCategory">
            <option value="-1">@lang('backend.sub-categories')</option>
            @foreach($subs as $sub)
                <option value="{{$sub->id}}">{{$sub->name}}</option>
            @endforeach
        </select>
    </div>
</div>


