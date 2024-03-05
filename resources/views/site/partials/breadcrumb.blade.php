
<div id="title" class="page-title">
    <div class="section-container">
        <div class="content-title-heading">
            <h1 class="text-title-heading">
                {{ $name }}
            </h1>
        </div>
        <div class="breadcrumbs">
            <a href="/{{ $local }}">   {{ $heading['home'] }}</a>
            @if(isset($cat) )
            <span class="delimiter"></span> 
            <a href="/products/{{ $local }}">   {{ $heading['products'] }}</a>
            @endif
            @if(isset($account) )
            <span class="delimiter"></span> 
            <a href="/profile/{{ $local }}">   {{ $heading['profile'] }}</a>
            @endif
            <span class="delimiter"></span>
               {{ $name}}
        </div>
    </div>
</div>
