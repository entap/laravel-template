<form>
    <div class="form-group">
        <label for="name">@lang('user_groups.properties.name')</label>
        <div>
            <input type="text" id="name" class="form-control" name="name" value="{{ request()->input('name', '') }}"
                autocomplete="off" />
        </div>
    </div>
    <div class="form-group text-right">
        <input type="submit" name="search" value="@lang('Search')" class="btn btn-primary" />
    </div>
</form>
